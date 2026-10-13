<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TouristPlace;

class TouristPlaceController extends Controller
{
    public function index()
    {
        $places = TouristPlace::latest()->get();
        return view('admin.pages.tourist.index', compact('places'));
    }

    public function create()
    {
        return view('admin.pages.tourist.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image'
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move('admin-assets/home/tourist', $imageName);

        TouristPlace::create([
            'name' => $request->name,
            'location' => $request->location,
            'image' => $imageName
        ]);

        // ✅ FIXED ROUTE
        return redirect()->route('admin.tourist.index')->with('success','Created');
    }

    public function edit($id)
    {
        $place = TouristPlace::findOrFail($id);

        // ✅ FIXED VIEW PATH
        return view('admin.pages.tourist.edit', compact('place'));
    }

    public function update(Request $request, $id)
    {
        $place = TouristPlace::findOrFail($id);

        if ($request->hasFile('image')) {

            if ($place->image && file_exists(public_path('admin-assets/home/tourist/'.$place->image))) {
                unlink(public_path('admin-assets/home/tourist/'.$place->image));
            }

            $imageName = time().'.'.$request->image->extension();
            $request->image->move('admin-assets/home/tourist', $imageName);

            $place->image = $imageName;
        }

        $place->update([
            'name' => $request->name,
            'location' => $request->location
        ]);

        return redirect()->route('admin.tourist.index')->with('success','Updated');
    }

    public function destroy($id)
    {
        $place = TouristPlace::findOrFail($id);

        if ($place->image && file_exists('admin-assets/home/tourist/'.$place->image)) {
            unlink('admin-assets/home/tourist/'.$place->image);
        }

        $place->delete();

        return back()->with('success','Deleted');
    }
}