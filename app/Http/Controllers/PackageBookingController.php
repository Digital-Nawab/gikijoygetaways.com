<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PackageBooking;
use App\Models\Package;
use Carbon\Carbon;
use Razorpay\Api\Api;

class PackageBookingController extends Controller
{
    // ─────────────────────────────────────────────
    // ADMIN: List all bookings
    // ─────────────────────────────────────────────
    public function index()
    {
        $bookings = PackageBooking::with('package')->latest()->get();
        return view('admin.pages.package-booking.index', compact('bookings'));
    }

    // ─────────────────────────────────────────────
    // ADMIN: Show create form
    // ─────────────────────────────────────────────
    public function create()
    {
        $packages = Package::all();
        return view('admin.pages.package-booking.create', compact('packages'));
    }

    // ─────────────────────────────────────────────
    // ADMIN: Store booking (auto confirmed + paid)
    // ─────────────────────────────────────────────
    public function adminStore(Request $request)
    {
        $request->validate([
            'package_id'   => 'required|exists:packages,id',
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'adult'        => 'nullable|integer|min:0',
            'child'        => 'nullable|integer|min:0',
            'total_people' => 'required|integer|min:1',
            'checkin'      => 'required|date|after_or_equal:today',
            'checkout'     => 'required|date|after:checkin',
            'message'      => 'nullable|string',
        ]);

        $package = Package::findOrFail($request->package_id);

        if (!$request->boolean('force_book') && !$package->isAvailable($request->checkin, $request->checkout)) {
            return back()
                ->withErrors(['checkin' => 'These dates are already booked. Check "Force Book" to override.'])
                ->withInput();
        }

        PackageBooking::create([
            'package_id'     => $request->package_id,
            'name'           => $request->name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'adult'          => $request->adult ?? 1,
            'child'          => $request->child ?? 0,
            'total_people'   => $request->total_people,
            'checkin'        => $request->checkin,
            'checkout'       => $request->checkout,
            'message'        => $request->message,
            'source'         => 'admin',
            'booking_status' => 'confirmed',
            'payment_status' => 'paid',
        ]);

        return redirect()->route('admin.package.booking.index')
            ->with('success', 'Booking added by admin successfully!');
    }

    // ─────────────────────────────────────────────
    // FRONTEND: Store booking (pending + unpaid)
    // ─────────────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'package_id'   => 'required|exists:packages,id',
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'phone'        => 'nullable|string|max:20',
            'adult'        => 'nullable|integer|min:0',
            'child'        => 'nullable|integer|min:0',
            'total_people' => 'required|integer|min:1',
            'checkin'      => 'required|date|after_or_equal:today',
            'checkout'     => 'required|date|after:checkin',
            'message'      => 'nullable|string',
        ]);

        $package = Package::findOrFail($request->package_id);

        if (!$package->isAvailable($request->checkin, $request->checkout)) {
            return back()
                ->withErrors(['checkin' => 'These dates are already booked. Please select different dates.'])
                ->withInput();
        }

        $booking = PackageBooking::create([
            'package_id'     => $request->package_id,
            'name'           => $request->name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'adult'          => $request->adult ?? 1,
            'child'          => $request->child ?? 0,
            'total_people'   => $request->total_people,
            'checkin'        => $request->checkin,
            'checkout'       => $request->checkout,
            'message'        => $request->message,
            'source'         => 'website',
            'booking_status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        return redirect()->route('booking.thankyou', $booking->id);
    }

    // ─────────────────────────────────────────────
    // ADMIN: Update booking & payment status
    // ─────────────────────────────────────────────
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'booking_status' => 'required|in:pending,confirmed,cancelled',
            'payment_status' => 'required|in:unpaid,paid',
        ]);

        PackageBooking::findOrFail($id)->update([
            'booking_status' => $request->booking_status,
            'payment_status' => $request->payment_status,
        ]);

        return back()->with('success', 'Status updated successfully!');
    }

    // ─────────────────────────────────────────────
    // Thank You Page + Razorpay Order Create
    // ─────────────────────────────────────────────
    public function thankYou(PackageBooking $booking)
    {
        $razorpayOrderId = null;
        $razorpayKey     = null;

        if ($booking->payment_status === 'unpaid') {
            try {
                $api = new Api(
                    config('services.razorpay.key'),
                    config('services.razorpay.secret')
                );

                // ✅ Sirf advance_price — per person multiply nahi
                $advanceAmount = $booking->package->advance_price ?? 1000;
                $amountInPaisa = $advanceAmount * 100;

                $order = $api->order->create([
                    'receipt'         => 'booking_' . $booking->id,
                    'amount'          => $amountInPaisa,
                    'currency'        => 'INR',
                    'payment_capture' => 1,
                ]);

                $razorpayOrderId = $order['id'];
                $razorpayKey     = config('services.razorpay.key');

                $booking->update([
                    'razorpay_order_id' => $razorpayOrderId
                ]);
            } catch (\Exception $e) {
                \Log::error('Razorpay order create failed: ' . $e->getMessage());
            }
        }

        return view('frontend.pages.thankyou', compact('booking', 'razorpayOrderId', 'razorpayKey'));
    }

    // ─────────────────────────────────────────────
    // Razorpay Payment Verify Callback
    // ─────────────────────────────────────────────
    public function razorpayCallback(Request $request)
    {
        try {
            $api = new Api(
                config('services.razorpay.key'),
                config('services.razorpay.secret')
            );

            $api->utility->verifyPaymentSignature([
                'razorpay_order_id'   => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature'  => $request->razorpay_signature,
            ]);

            PackageBooking::where('razorpay_order_id', $request->razorpay_order_id)
                ->update([
                    'payment_status'      => 'paid',
                    'booking_status'      => 'confirmed',
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                ]);

            return redirect()->route('booking.thankyou', $request->booking_id)
                ->with('success', '✅ Payment successful! Your booking is confirmed.');
        } catch (\Exception $e) {
            \Log::error('Razorpay verification failed: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', '❌ Payment verification failed. Please contact support.');
        }
    }

    // ─────────────────────────────────────────────
    // API: Return blocked dates for a package
    // ✅ FIXED: Sirf confirmed + paid dates block hongi
    //    Pending / unpaid bookings calendar pe show nahi hongi
    // ─────────────────────────────────────────────
    public function bookedDates($packageId)
    {
        $bookings = PackageBooking::where('package_id', $packageId)
            ->where('booking_status', 'confirmed')  // ✅
            ->where('payment_status', 'paid')        // ✅ yeh line add karo
            ->get(['checkin', 'checkout']);

        $dates = [];

        foreach ($bookings as $booking) {
            $start = Carbon::parse($booking->checkin);
            $end   = Carbon::parse($booking->checkout);

            while ($start->lte($end)) {
                $dates[] = $start->toDateString();
                $start->addDay();
            }
        }

        return response()->json(array_values(array_unique($dates)));
    }

    // ─────────────────────────────────────────────
    // ADMIN: Show single booking detail
    // ─────────────────────────────────────────────
    public function show($id)
    {
        $booking = PackageBooking::with('package')->findOrFail($id);
        return view('admin.pages.package-booking.show', compact('booking'));
    }

    // ─────────────────────────────────────────────
    // ADMIN: Delete booking
    // ─────────────────────────────────────────────
    public function destroy($id)
    {
        PackageBooking::findOrFail($id)->delete();
        return back()->with('success', 'Booking deleted successfully!');
    }

    // ─────────────────────────────────────────────
// ADMIN: Transaction History (sirf paid bookings)
// ─────────────────────────────────────────────
public function transactions(Request $request)
{
    $query = PackageBooking::with('package')
        ->whereNotNull('razorpay_payment_id')   // ✅ sirf jin ka online payment hua
        ->where('payment_status', 'paid')
        ->latest();

    // 🔍 Search by name/email/payment id
    if ($request->filled('search')) {
        $s = $request->search;
        $query->where(function ($q) use ($s) {
            $q->where('name', 'like', "%$s%")
              ->orWhere('email', 'like', "%$s%")
              ->orWhere('razorpay_payment_id', 'like', "%$s%")
              ->orWhere('razorpay_order_id', 'like', "%$s%");
        });
    }

    // 📅 Date filter
    if ($request->filled('from')) {
        $query->whereDate('created_at', '>=', $request->from);
    }
    if ($request->filled('to')) {
        $query->whereDate('created_at', '<=', $request->to);
    }

    $transactions = $query->paginate(20)->withQueryString();

    // 📊 Stats
    $totalRevenue   = PackageBooking::whereNotNull('razorpay_payment_id')
                        ->where('payment_status', 'paid')
                        ->get()
                        ->sum(fn($b) => $b->package->advance_price ?? 0);

    $todayRevenue   = PackageBooking::whereNotNull('razorpay_payment_id')
                        ->where('payment_status', 'paid')
                        ->whereDate('created_at', today())
                        ->get()
                        ->sum(fn($b) => $b->package->advance_price ?? 0);

    $totalTxns      = PackageBooking::whereNotNull('razorpay_payment_id')->count();
    $todayTxns      = PackageBooking::whereNotNull('razorpay_payment_id')
                        ->whereDate('created_at', today())->count();

    return view('admin.pages.Transactions.index', compact(
        'transactions', 'totalRevenue', 'todayRevenue', 'totalTxns', 'todayTxns'
    ));
}
}