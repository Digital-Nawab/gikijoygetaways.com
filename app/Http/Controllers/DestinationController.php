<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destination;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::latest()->get();
        return view('admin.pages.Destination.index', compact('destinations'));
    }

    public function create()
    {
        return view('admin.pages.destination.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'country' => 'nullable',
            'tour_count' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp'
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('admin-assets/home/destinations'), $imageName);

        Destination::create([
            'title' => $request->title,
            'country' => $request->country,
            'tour_count' => $request->tour_count,
            'image' => $imageName,
            'status' => 1,
        ]);

        return redirect()->route('admin.destination.index')
            ->with('success', 'Destination added successfully.');
    }

    public function edit($id)
    {
        $destination = Destination::findOrFail($id);
        return view('admin.pages.Destination.edit', compact('destination'));
    }

    public function update(Request $request, $id)
    {
        $destination = Destination::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'country' => 'nullable',
            'tour_count' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('admin-assets/home/destinations'), $imageName);
        } else {
            $imageName = $destination->image;
        }

        $destination->update([
            'title' => $request->title,
            'country' => $request->country,
            'tour_count' => $request->tour_count,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.destination.index')
            ->with('success', 'Destination updated successfully.');
    }

    public function delete($id)
    {
        $destination = Destination::findOrFail($id);
        $destination->delete();

        return redirect()->route('admin.destination.index')
            ->with('success', 'Destination deleted successfully.');
    }
}
