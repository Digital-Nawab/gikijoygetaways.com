<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::latest()->get();

        return view('admin.pages.Offer.index', compact('offers'));
    }

    public function create()
    {
        return view('admin.pages.Offer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'url' => 'nullable|url', // optional URL validation
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move('admin-assets/home/offer', $imageName);
        }

        Offer::create([
            'image' => $imageName,
            'status' => 1,
            'url' => $request->url, // save optional URL
        ]);

        return redirect()->route('admin.offer.index')
            ->with('success', 'Offer added successfully.');
    }

    public function edit($id)
    {
        $offer = Offer::findOrFail($id);

        return view('admin.pages.Offer.edit', compact('offer'));
    }

    public function update(Request $request, $id)
    {
        $offer = Offer::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'url' => 'nullable|url',
        ]);

        $imageName = $offer->image;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move('admin-assets/home/offer', $imageName);
        }

        $offer->update([
            'image' => $imageName,
            'url' => $request->url,
        ]);

        return redirect()->route('admin.offer.index')
            ->with('success', 'Offer updated successfully.');
    }

    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);

        if ($offer->image && file_exists('admin-assets/home/offer/' . $offer->image)) {
            unlink('admin-assets/home/offer/' . $offer->image);
        }

        $offer->delete();

        return redirect()->route('admin.offer.index')
            ->with('success', 'Offer deleted successfully.');
    }
}
