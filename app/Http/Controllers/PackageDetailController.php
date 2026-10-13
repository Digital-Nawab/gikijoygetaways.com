<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PackageDetail;
use App\Models\Package;
use App\Models\SubPackage;
use App\Models\Review;

class PackageDetailController extends Controller
{
    private string $uploadPath = 'admin-assets/home/package';

    public function show($package_id)
    {
        $package     = Package::findOrFail($package_id);
        $detail      = PackageDetail::where('package_id', $package_id)->first();
        $subPackages = SubPackage::where('package_id', $package_id)->orderBy('sort_order')->get();
        $reviews     = Review::where('package_id', $package_id)->orderBy('sort_order')->get();

        $highlights = [];
        $amenities  = [];

        if ($detail) {
            $highlights = is_string($detail->highlights)
                ? (json_decode($detail->highlights, true) ?? [])
                : (is_array($detail->highlights) ? $detail->highlights : []);

            $amenities = is_string($detail->amenities)
                ? (json_decode($detail->amenities, true) ?? [])
                : (is_array($detail->amenities) ? $detail->amenities : []);
        }

        return view(
            'admin.pages.package-detail.show',
            compact('package', 'detail', 'highlights', 'amenities', 'subPackages', 'reviews')
        );
    }

    public function create($package_id)
    {
        $existing = PackageDetail::where('package_id', $package_id)->first();
        if ($existing) {
            return redirect()->route('admin.package.detail.edit', $package_id)
                ->with('info', 'Detail already exists. Edit it here.');
        }
        $package = Package::findOrFail($package_id);
        return view('admin.pages.package-detail.create', compact('package'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'email'      => 'nullable|email',
            'mobile'     => 'nullable|string|max:20',
        ]);

        // Banner Image
        $bannerImage = null;
        if ($request->hasFile('banner_image')) {
            $file        = $request->file('banner_image');
            $bannerImage = time() . '_banner.' . $file->extension();
            $file->move($this->uploadPath, $bannerImage);
        }

        // Highlights
        $highlights = [];
        if ($request->highlights) {
            $decoded    = json_decode($request->highlights, true);
            $highlights = is_array($decoded) ? $decoded : [];
        }

        // Amenities
        $amenities = [];
        if ($request->amenities) {
            $decoded   = json_decode($request->amenities, true);
            $amenities = is_array($decoded) ? $decoded : [];
        }

        // Save Package Detail
        PackageDetail::create([
            'package_id'       => $request->package_id,
            'hero_badge'       => $request->hero_badge,
            'banner_image'     => $bannerImage,
            'description'      => $request->description,
            'highlights'       => json_encode($highlights),
            'amenities'        => json_encode($amenities),
            'offer_badge_text' => $request->offer_badge_text,
            'email'            => $request->email,
            'mobile'           => $request->mobile,
            'address'          => $request->address,
            'map_url'          => $request->map_url,
        ]);

        // Save Sub Packages
        $this->syncSubPackages($request->sub_packages_json, $request->package_id);

        // Save Reviews
        $this->syncReviews($request->reviews_json, $request->package_id);

        return redirect()->route('admin.package.detail.show', $request->package_id)
            ->with('success', 'Package Detail Added Successfully');
    }

    public function edit($id)
    {
        $package     = Package::findOrFail($id);
        $detail      = PackageDetail::where('package_id', $id)->firstOrFail();
        $subPackages = SubPackage::where('package_id', $id)->orderBy('sort_order')->get();
        $reviews     = Review::where('package_id', $id)->orderBy('sort_order')->get();

        $existingHighlights = is_string($detail->highlights)
            ? (json_decode($detail->highlights, true) ?? [])
            : (is_array($detail->highlights) ? $detail->highlights : []);

        $existingAmenities = is_string($detail->amenities)
            ? (json_decode($detail->amenities, true) ?? [])
            : (is_array($detail->amenities) ? $detail->amenities : []);

        $existingBannerUrl = $detail->banner_image
            ? asset($this->uploadPath . '/' . $detail->banner_image)
            : null;

        // Prepare sub packages for JS
        $existingSubPackages = $subPackages->map(function ($sp) {
            return [
                'id'           => $sp->id,
                'badge'        => $sp->badge,
                'editor_badge' => $sp->editor_badge,
                'name'         => $sp->name,
                'features'     => is_array($sp->features)
                    ? $sp->features
                    : (json_decode($sp->features ?? '[]', true) ?? []),
                'price'        => $sp->price,
                'is_featured'  => (bool) $sp->is_featured,
                'sort_order'   => $sp->sort_order,
            ];
        })->toArray();

        // Prepare reviews for JS
        $existingReviews = $reviews->map(function ($rv) {
            return [
                'id'          => $rv->id,
                'name'        => $rv->name,
                'location'    => $rv->location,
                'review_date' => $rv->review_date,
                'rating'      => (int) $rv->rating,
                'review'      => $rv->review,
                'sort_order'  => $rv->sort_order,
            ];
        })->toArray();

        return view('admin.pages.package-detail.edit', [
            'detail'              => $detail,
            'package'             => $package,
            'existingHighlights'  => $existingHighlights,
            'existingAmenities'   => $existingAmenities,
            'existingBannerUrl'   => $existingBannerUrl,
            'existingSubPackages' => $existingSubPackages,
            'existingReviews'     => $existingReviews,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email'  => 'nullable|email',
            'mobile' => 'nullable|string|max:20',
        ]);

        $detail = PackageDetail::findOrFail($id);

        // Banner
        $bannerImage = $detail->banner_image;
        if ($request->hasFile('banner_image')) {
            if ($bannerImage && file_exists(public_path($this->uploadPath . '/' . $bannerImage))) {
                unlink(public_path($this->uploadPath . '/' . $bannerImage));
            }
            $file        = $request->file('banner_image');
            $bannerImage = time() . '_banner.' . $file->extension();
            $file->move($this->uploadPath, $bannerImage);
        }

        // Highlights
        $highlights = [];
        if ($request->highlights) {
            $decoded    = json_decode($request->highlights, true);
            $highlights = is_array($decoded) ? $decoded : [];
        }

        // Amenities
        $amenities = [];
        if ($request->amenities) {
            $decoded   = json_decode($request->amenities, true);
            $amenities = is_array($decoded) ? $decoded : [];
        }

        $detail->update([
            'hero_badge'       => $request->hero_badge,
            'banner_image'     => $bannerImage,
            'description'      => $request->description,
            'highlights'       => json_encode($highlights),
            'amenities'        => json_encode($amenities),
            'offer_badge_text' => $request->offer_badge_text,
            'email'            => $request->email,
            'mobile'           => $request->mobile,
            'address'          => $request->address,
            'map_url'          => $request->map_url,
        ]);

        // Sync Sub Packages — delete old, re-insert
        SubPackage::where('package_id', $detail->package_id)->delete();
        $this->syncSubPackages($request->sub_packages_json, $detail->package_id);

        // Sync Reviews — delete old, re-insert
        Review::where('package_id', $detail->package_id)->delete();
        $this->syncReviews($request->reviews_json, $detail->package_id);

        return back()->with('success', 'Package Detail Updated Successfully');
    }

    public function destroy($id)
    {
        $detail    = PackageDetail::findOrFail($id);
        $packageId = $detail->package_id;

        if ($detail->banner_image && file_exists(public_path($this->uploadPath . '/' . $detail->banner_image))) {
            unlink(public_path($this->uploadPath . '/' . $detail->banner_image));
        }

        $detail->delete();

        return redirect()->route('admin.package.detail.show', $packageId)
            ->with('success', 'Deleted Successfully');
    }

    /**
     * Helper — Sub Packages insert
     */
    private function syncSubPackages($json, $packageId): void
    {
        if (!$json) return;
        $subPackages = json_decode($json, true);
        if (!is_array($subPackages)) return;

        foreach ($subPackages as $index => $sp) {
            if (empty($sp['name'])) continue;
            SubPackage::create([
                'package_id'   => $packageId,
                'badge'        => $sp['badge']        ?? null,
                'editor_badge' => $sp['editor_badge'] ?? null,
                'name'         => $sp['name'],
                'features'     => json_encode($sp['features'] ?? []),
                'price'        => isset($sp['price']) && $sp['price'] !== '' ? $sp['price'] : null,
                'is_featured'  => $sp['is_featured']  ?? false,
                'sort_order'   => $sp['sort_order']   ?? $index,
            ]);
        }
    }

    /**
     * Helper — Reviews insert
     */
    private function syncReviews($json, $packageId): void
    {
        if (!$json) return;
        $reviews = json_decode($json, true);
        if (!is_array($reviews)) return;

        foreach ($reviews as $index => $rv) {
            if (empty($rv['name']) || empty($rv['review'])) continue;
            Review::create([
                'package_id'  => $packageId,
                'name'        => $rv['name'],
                'location'    => $rv['location']    ?? null,
                'review_date' => $rv['review_date'] ?? null,
                'rating'      => $rv['rating']      ?? 5,
                'review'      => $rv['review'],
                'status'      => 1,
                'sort_order'  => $rv['sort_order']  ?? $index,
            ]);
        }
    }
}