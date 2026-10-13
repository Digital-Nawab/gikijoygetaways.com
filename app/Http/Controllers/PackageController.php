<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Str;

class PackageController extends Controller
{

    public function index()
    {
        $packages = Package::with(['country', 'state', 'city'])
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.pages.Package.index', compact('packages'));
    }
    
    public function create()
    {
        $countries = Country::orderBy('name')->get();

        return view('admin.pages.Package.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image'             => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'name'              => 'required|max:255',
            'slug'              => 'nullable|max:255|unique:packages,slug',
            'country_id'        => 'required',
            'state_id'          => 'required',
            'city_id'           => 'required',
            //'days'              => 'required',
            //'nights'            => 'nullable',
            'location'          => 'nullable|max:255',
            'short_description' => 'nullable',
            'total_price'       => 'required|numeric',
            'advance_price'     => 'nullable|numeric',
            'tag'               => 'nullable|max:255',
            // ✅ New fields
            'guests'            => 'nullable|integer|min:1|max:255',
            'bedrooms'          => 'nullable|integer|min:1|max:255',
            'beds'              => 'nullable|integer|min:1|max:255',
            'bathrooms'         => 'nullable|integer|min:1|max:255',
            'rating'            => 'nullable|numeric|min:0|max:5',
            'reviews_count'     => 'nullable|integer|min:0',
            'is_guest_favourite' => 'nullable|boolean',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move('admin-assets/home/package', $imageName);
        }

        $slug = $request->filled('slug')
            ? Str::slug($request->slug)
            : Str::slug($request->name);

        $baseSlug = $slug;
        $count = 1;
        while (Package::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count++;
        }

        Package::create([
            'image'              => $imageName,
            'name'               => $request->name,
            'slug'               => $slug,
            'country_id'         => $request->country_id,
            'state_id'           => $request->state_id,
            'city_id'            => $request->city_id,
            //'days'               => $request->days,
            //'nights'             => $request->nights,
            'location'           => $request->location,
            'short_description'  => $request->short_description,
            'total_price'        => $request->total_price,
            'advance_price'      => $request->advance_price,
            'tag'                => $request->tag,
            'status'             => 1,
            // ✅ New fields
            'guests'             => $request->guests             ?? 1,
            'bedrooms'           => $request->bedrooms           ?? 1,
            'beds'               => $request->beds               ?? 1,
            'bathrooms'          => $request->bathrooms          ?? 1,
            'rating'             => $request->rating             ?? 0.00,
            'reviews_count'      => $request->reviews_count      ?? 0,
            'is_guest_favourite' => $request->boolean('is_guest_favourite'),
        ]);

        return redirect()->route('admin.package.index')
            ->with('success', 'Package added successfully.');
    }

    // ✅ FIX: Edit mein bhi sirf $countries — states/cities AJAX se
    public function edit($id)
    {
        $package   = Package::findOrFail($id);
        $countries = Country::orderBy('name')->get();

        return view('admin.pages.Package.edit', compact('package', 'countries'));
    }

    public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);

        $request->validate([
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'name'              => 'required|max:255',
            'slug'              => 'nullable|max:255|unique:packages,slug,' . $id,
            'country_id'        => 'required',
            'state_id'          => 'required',
            'city_id'           => 'required',
            //'days'              => 'required',
            //'nights'            => 'nullable',
            'location'          => 'nullable|max:255',
            'short_description' => 'nullable',
            'total_price'       => 'required|numeric',
            'advance_price'     => 'nullable|numeric',
            'tag'               => 'nullable|max:255',
            // ✅ New fields
            'guests'            => 'nullable|integer|min:1|max:255',
            'bedrooms'          => 'nullable|integer|min:1|max:255',
            'beds'              => 'nullable|integer|min:1|max:255',
            'bathrooms'         => 'nullable|integer|min:1|max:255',
            'rating'            => 'nullable|numeric|min:0|max:5',
            'reviews_count'     => 'nullable|integer|min:0',
            'is_guest_favourite' => 'nullable|boolean',
        ]);

        $imageName = $package->image;
        if ($request->hasFile('image')) {
            if ($package->image && file_exists('admin-assets/home/package/' . $package->image)) {
                unlink('admin-assets/home/package/' . $package->image);
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move('admin-assets/home/package', $imageName);
        }

        $slug = $request->filled('slug')
            ? Str::slug($request->slug)
            : Str::slug($request->name);

        $baseSlug = $slug;
        $count = 1;
        while (Package::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = $baseSlug . '-' . $count++;
        }

        $package->update([
            'image'              => $imageName,
            'name'               => $request->name,
            'slug'               => $slug,
            'country_id'         => $request->country_id,
            'state_id'           => $request->state_id,
            'city_id'            => $request->city_id,
            //'days'               => $request->days,
            //'nights'             => $request->nights,
            'location'           => $request->location,
            'short_description'  => $request->short_description,
            'total_price'        => $request->total_price,
            'advance_price'      => $request->advance_price,
            'tag'                => $request->tag,
            // ✅ New fields
            'guests'             => $request->guests    ?? $package->guests,
            'bedrooms'           => $request->bedrooms  ?? $package->bedrooms,
            'beds'               => $request->beds       ?? $package->beds,
            'bathrooms'          => $request->bathrooms  ?? $package->bathrooms,
            'rating'             => $request->rating     ?? $package->rating,
            'reviews_count'      => $request->reviews_count ?? $package->reviews_count,
            'is_guest_favourite' => $request->boolean('is_guest_favourite'),
        ]);

        return redirect()->route('admin.package.index')
            ->with('success', 'Package updated successfully.');
    }

    public function destroy($id)
    {
        $package = Package::findOrFail($id);

        if ($package->image && file_exists('admin-assets/home/package/' . $package->image)) {
            unlink('admin-assets/home/package/' . $package->image);
        }

        $package->delete();

        return redirect()->route('admin.package.index')
            ->with('success', 'Package deleted successfully.');
    }

    // =========================================================
    // ✅ NEW: AJAX — Country ke basis pe States return karo
    // GET /admin/package/get-states/{countryId}
    // =========================================================
    public function getStates($countryId)
    {
        $states = State::where('country_id', $countryId)
            ->where('status', 1)
            ->orderBy('state_name')
            ->get(['id', 'state_name']);

        return response()->json($states);
    }

    // =========================================================
    // ✅ NEW: AJAX — State ke basis pe Cities return karo
    // GET /admin/package/get-cities/{stateId}
    // =========================================================
    public function getCities($stateId)
    {
        $cities = City::where('state_id', $stateId)
            ->where('status', 1)        // sirf active cities
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($cities);
    }
}
