@extends('admin.layout.master')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">

  {{-- Header --}}
  <div class="flex items-center justify-between mb-8">
    <div>
      <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Package Bookings</h1>
      <p class="text-sm text-gray-400 mt-1">Manage and track all travel booking requests</p>
    </div>
    <div class="flex items-center gap-3">
      <span class="inline-flex items-center gap-2 bg-blue-50 text-blue-600 text-sm font-semibold px-4 py-2 rounded-full border border-blue-100">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
        </svg>
        {{ $bookings->count() }} Total
      </span>
      <a href="{{ route('admin.package.booking.create') }}"
        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Add New Booking
      </a>
    </div>
  </div>

  {{-- Flash --}}
  @if(session('success'))
  <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 text-sm font-medium px-4 py-3 rounded-xl mb-6">
    <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
    </svg>
    {{ session('success') }}
  </div>
  @endif

  {{-- Stats --}}
  @php
  $totalAdults = $bookings->sum('adult');
  $totalChildren = $bookings->sum('child');
  $totalPeople = $bookings->sum('total_people');
  $confirmedCount = $bookings->where('booking_status','confirmed')->count();
  $pendingCount = $bookings->where('booking_status','pending')->count();
  $cancelledCount = $bookings->where('booking_status','cancelled')->count();
  $paidCount = $bookings->where('payment_status','paid')->count();
  $unpaidCount = $bookings->where('payment_status','unpaid')->count();
  $adminCount = $bookings->where('source','admin')->count();
  $websiteCount = $bookings->where('source','website')->count();
  @endphp

  <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
      <div class="flex items-center justify-between mb-3">
        <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Bookings</span>
        <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center">
          <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
        </div>
      </div>
      <div class="text-3xl font-bold text-gray-900 mb-1">{{ $bookings->count() }}</div>
      <div class="flex gap-2 flex-wrap">
        <span class="text-xs bg-green-50 text-green-600 px-2 py-0.5 rounded-full font-medium">{{ $confirmedCount }} confirmed</span>
        <span class="text-xs bg-amber-50 text-amber-600 px-2 py-0.5 rounded-full font-medium">{{ $pendingCount }} pending</span>
      </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
      <div class="flex items-center justify-between mb-3">
        <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Travelers</span>
        <div class="w-9 h-9 bg-indigo-50 rounded-xl flex items-center justify-center">
          <svg class="w-4 h-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0" />
          </svg>
        </div>
      </div>
      <div class="text-3xl font-bold text-gray-900 mb-1">{{ $totalPeople }}</div>
      <div class="flex gap-2 flex-wrap">
        <span class="text-xs bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full font-medium">{{ $totalAdults }} adults</span>
        <span class="text-xs bg-purple-50 text-purple-600 px-2 py-0.5 rounded-full font-medium">{{ $totalChildren }} children</span>
      </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
      <div class="flex items-center justify-between mb-3">
        <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Paid</span>
        <div class="w-9 h-9 bg-green-50 rounded-xl flex items-center justify-center">
          <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
      </div>
      <div class="text-3xl font-bold text-green-600 mb-1">{{ $paidCount }}</div>
      <div class="flex gap-2">
        <span class="text-xs bg-red-50 text-red-500 px-2 py-0.5 rounded-full font-medium">{{ $unpaidCount }} unpaid</span>
      </div>
    </div>

    {{-- ✅ Source stat --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
      <div class="flex items-center justify-between mb-3">
        <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Source</span>
        <div class="w-9 h-9 bg-violet-50 rounded-xl flex items-center justify-center">
          <svg class="w-4 h-4 text-violet-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
          </svg>
        </div>
      </div>
      <div class="text-3xl font-bold text-gray-900 mb-1">{{ $websiteCount }}</div>
      <div class="flex gap-2 flex-wrap">
        <span class="text-xs bg-violet-50 text-violet-600 px-2 py-0.5 rounded-full font-medium">🌐 {{ $websiteCount }} web</span>
        <span class="text-xs bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full font-medium">🛠 {{ $adminCount }} admin</span>
      </div>
    </div>

  </div>

  {{-- Table --}}
  <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
      <h2 class="text-base font-bold text-gray-800">All Bookings</h2>
    </div>
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead>
          <tr class="bg-gray-50 border-b border-gray-100">
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 py-3">#</th>
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 py-3">Source</th>
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 py-3">Guest</th>
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 py-3">Package</th>
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 py-3">Dates</th>
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 py-3">Phone</th>
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 py-3">Booking</th>
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 py-3">Payment</th>
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 py-3">Transaction</th>
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 py-3">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
          @forelse($bookings as $key => $b)
          <tr class="hover:bg-gray-50 transition-colors">

            <td class="px-4 py-4 text-xs text-gray-300 font-medium">{{ $key + 1 }}</td>
            {{-- ✅ Source --}}
            <td class="px-4 py-4">
              @if($b->source === 'admin')
              <span class="inline-flex items-center gap-1 bg-blue-50 text-blue-700 border border-blue-100 text-xs font-bold px-2.5 py-1 rounded-full">🛠 Admin</span>
              @else
              <span class="inline-flex items-center gap-1 bg-violet-50 text-violet-700 border border-violet-100 text-xs font-bold px-2.5 py-1 rounded-full">🌐 Website</span>
              @endif
            </td>

            {{-- Guest --}}
            <td class="px-4 py-4">
              <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                  {{ strtoupper(substr($b->name, 0, 1)) }}
                </div>
                <div>
                  <div class="font-semibold text-gray-800 text-sm leading-tight">{{ $b->name }}</div>
                  <div class="text-xs text-gray-400 mt-0.5">{{ $b->email }}</div>
                </div>
              </div>
            </td>

            {{-- Package --}}
            <td class="px-4 py-4">
              <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 text-xs font-semibold px-3 py-1.5 rounded-lg border border-blue-100 whitespace-nowrap">
                {{ $b->package->name ?? 'N/A' }}
              </span>
            </td>


            {{-- Dates --}}
            <td class="px-4 py-4 whitespace-nowrap">
              <div class="flex flex-col gap-0.5">
                <div class="flex items-center gap-2">
                  <span class="text-xs text-gray-400">In</span>
                  <span class="text-sm font-bold text-gray-800">{{ \Carbon\Carbon::parse($b->checkin)->format('d M Y') }}</span>
                </div>
                <div class="flex items-center gap-2">
                  <span class="text-xs text-gray-400">Out</span>
                  <span class="text-sm font-bold text-gray-800">{{ \Carbon\Carbon::parse($b->checkout)->format('d M Y') }}</span>
                </div>

              </div>
            </td>
            <td class="px-4 py-4">{{ $b->phone ?? 'N/A' }}</td>

            {{-- Booking Status --}}
            <td class="px-4 py-4">
              <form action="{{ route('admin.package.booking.updateStatus', $b->id) }}" method="POST">
                @csrf
                <input type="hidden" name="payment_status" value="{{ $b->payment_status }}">
                <select name="booking_status" onchange="this.form.submit()"
                  class="text-xs font-bold px-3 py-1.5 rounded-lg border cursor-pointer outline-none
                  {{ $b->booking_status === 'confirmed' ? 'bg-green-50 text-green-700 border-green-200' : ($b->booking_status === 'cancelled' ? 'bg-red-50 text-red-600 border-red-200' : 'bg-amber-50 text-amber-700 border-amber-200') }}">
                  <option value="pending" {{ $b->booking_status === 'pending'   ? 'selected' : '' }}>⏳ Pending</option>
                  <option value="confirmed" {{ $b->booking_status === 'confirmed' ? 'selected' : '' }}>✅ Confirmed</option>
                  <option value="cancelled" {{ $b->booking_status === 'cancelled' ? 'selected' : '' }}>❌ Cancelled</option>
                </select>
              </form>
            </td>

            {{-- Payment Status --}}
            <td class="px-4 py-4">
              <form action="{{ route('admin.package.booking.updateStatus', $b->id) }}" method="POST">
                @csrf
                <input type="hidden" name="booking_status" value="{{ $b->booking_status }}">
                <select name="payment_status" onchange="this.form.submit()"
                  class="text-xs font-bold px-3 py-1.5 rounded-lg border cursor-pointer outline-none
                  {{ $b->payment_status === 'paid' ? 'bg-green-50 text-green-700 border-green-200' : 'bg-amber-50 text-amber-600 border-amber-200' }}">
                  <option value="unpaid" {{ $b->payment_status === 'unpaid' ? 'selected' : '' }}>💳 Unpaid</option>
                  <option value="paid" {{ $b->payment_status === 'paid'   ? 'selected' : '' }}>✅ Paid</option>
                </select>
              </form>
            </td>
            {{-- ✅ Transaction Info --}}
            <td class="px-4 py-4">
              @if($b->razorpay_payment_id)
              <div class="flex flex-col gap-1">
                <div class="flex items-center gap-1.5">
                  <span class="text-sm font-bold text-emerald-600">
                    ₹{{ number_format($b->package->advance_price ?? 0) }}
                  </span>
                  <span class="text-[10px] bg-emerald-50 text-emerald-600 px-1.5 py-0.5 rounded font-semibold">PAID</span>
                </div>
                <div class="flex items-center gap-1">
                  <code class="text-[10px] font-mono bg-gray-50 text-gray-600 px-1.5 py-0.5 rounded border border-gray-100">
                    {{ \Illuminate\Support\Str::limit($b->razorpay_payment_id, 14, '..') }}
                  </code>
                  <button type="button"
                    onclick="navigator.clipboard.writeText('{{ $b->razorpay_payment_id }}'); this.innerText='✓'"
                    class="text-gray-300 hover:text-gray-600 text-[10px]" title="Copy">📋</button>
                </div>
              </div>
              @else
              <span class="inline-flex items-center gap-1 bg-gray-50 text-gray-400 text-[10px] font-semibold px-2 py-1 rounded-full border border-gray-100">
                — No Txn —
              </span>
              @endif
            </td>
            {{-- Actions --}}
            <td class="px-4 py-4">
              <div class="flex items-center gap-2">
                <a href="{{ route('admin.package.booking.show', $b->id) }}"
                  class="inline-flex items-center gap-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 border border-blue-100 text-xs font-semibold px-3 py-1.5 rounded-lg transition-colors whitespace-nowrap">
                  <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                  View
                </a>
                <form action="{{ route('admin.package.booking.delete', $b->id) }}" method="POST"
                  onsubmit="return confirm('Are you sure?')">
                  @csrf @method('DELETE')
                  <button type="submit"
                    class="inline-flex items-center gap-1.5 bg-red-50 hover:bg-red-100 text-red-600 border border-red-100 text-xs font-semibold px-3 py-1.5 rounded-lg transition-colors whitespace-nowrap">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Delete
                  </button>
                </form>
              </div>
            </td>

          </tr>
          @empty
          <tr>
            <td colspan="10" class="text-center py-16">
              <div class="flex flex-col items-center gap-3">
                <div class="w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center">
                  <svg class="w-7 h-7 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                  </svg>
                </div>
                <div class="text-sm font-medium text-gray-400">No bookings found</div>
                <div class="text-xs text-gray-300">Bookings will appear here once submitted</div>
              </div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection