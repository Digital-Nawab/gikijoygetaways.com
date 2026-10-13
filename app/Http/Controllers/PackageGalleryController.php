<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackageGallery;

class PackageGalleryController extends Controller
{
    // 📸 CREATE PAGE
    public function create($id)
    {
        $package = Package::findOrFail($id);
        $galleries = PackageGallery::where('package_id', $id)->latest()->get();

        return view('admin.pages.package-gallery.create', compact('package', 'galleries'));
    }

    // 💾 STORE — single image with optional caption
    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'image'      => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'caption'    => 'nullable|string|max:255',
        ]);

        $imageName = time() . '_' . $request->image->getClientOriginalName();
        $request->image->move('admin-assets/home/package-gallery', $imageName);

        PackageGallery::create([
            'package_id' => $request->package_id,
            'image'      => $imageName,
            'caption'    => $request->caption,
        ]);

        return back()->with('success', '✅ Image uploaded successfully.');
    }

    // ✏️ EDIT PAGE
    public function edit($id)
    {
        $gallery = PackageGallery::findOrFail($id);
        return view('admin.pages.package-gallery.edit', compact('gallery'));
    }

    // 🔄 UPDATE
    public function update(Request $request, $id)
    {
        $gallery = PackageGallery::findOrFail($id);

        $request->validate([
            'image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            if ($gallery->image && file_exists('admin-assets/home/package-gallery/' . $gallery->image)) {
                unlink('admin-assets/home/package-gallery/' . $gallery->image);
            }

            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move('admin-assets/home/package-gallery', $imageName);

            $gallery->image = $imageName;
        }

        $gallery->caption = $request->caption;
        $gallery->save();

        return redirect()->route('admin.package.gallery.create', $gallery->package_id)
            ->with('success', '✅ Image updated successfully.');
    }

    // 🗑 DELETE
    public function destroy($id)
    {
        $gallery = PackageGallery::findOrFail($id);

        if ($gallery->image && file_exists('admin-assets/home/package-gallery/' . $gallery->image)) {
            unlink('admin-assets/home/package-gallery/' . $gallery->image);
        }

        $gallery->delete();

        return back()->with('success', '🗑 Image deleted successfully.');
    }
}