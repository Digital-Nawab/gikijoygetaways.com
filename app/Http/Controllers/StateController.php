<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Country;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class StateController extends Controller
{
    public function index()
    {
        $states = State::with('country')->latest()->get();
        return view('admin.pages.State.index', compact('states'));
    }

    public function create()
    {
        $countries = Country::where('status', 1)->get();
        return view('admin.pages.State.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_id'  => 'required|exists:countries,id',
            'state_name'  => 'required|string|max:255',
            'slug'        => 'nullable|string|unique:states,slug|max:255',
            'state_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            'description' => 'nullable|string',
            'status'      => 'required|in:0,1',
        ]);

        $imagePath = null;
        if ($request->hasFile('state_image')) {
            $file      = $request->file('state_image');
            $filename  = time() . '_' . $file->getClientOriginalName();
            // Store in public/admin-assets/home/state
            $file->move('admin-assets/home/state', $filename);
            $imagePath = 'admin-assets/home/state/' . $filename;
        }

        State::create([
            'country_id'  => $request->country_id,
            'state_name'  => $request->state_name,
            'slug'        => $request->slug
                                ? Str::slug($request->slug)
                                : Str::slug($request->state_name),
            'state_image' => $imagePath,
            'description' => $request->description,
            'status'      => $request->status,
        ]);

        return redirect()->route('admin.state.index')
            ->with('success', 'State added successfully!');
    }

    public function edit($id)
    {
        $state     = State::findOrFail($id);
        $countries = Country::where('status', 1)->get();
        return view('admin.pages.State.edit', compact('state', 'countries'));
    }

    public function update(Request $request, $id)
    {
        $state = State::findOrFail($id);

        $request->validate([
            'country_id'  => 'required|exists:countries,id',
            'state_name'  => 'required|string|max:255',
            'slug'        => 'nullable|string|unique:states,slug,' . $id . '|max:255',
            'state_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            'description' => 'nullable|string',
            'status'      => 'required|in:0,1',
        ]);

        $imagePath = $state->state_image;

        if ($request->hasFile('state_image')) {
            // Delete old image from public folder
            if ($imagePath && file_exists($imagePath)) {
                unlink($imagePath);
            }
            $file      = $request->file('state_image');
            $filename  = time() . '_' . $file->getClientOriginalName();
            $file->move('admin-assets/home/state', $filename);
            $imagePath = 'admin-assets/home/state/' . $filename;
        }

        $state->update([
            'country_id'  => $request->country_id,
            'state_name'  => $request->state_name,
            'slug'        => $request->slug
                                ? Str::slug($request->slug)
                                : Str::slug($request->state_name),
            'state_image' => $imagePath,
            'description' => $request->description,
            'status'      => $request->status,
        ]);

        return redirect()->route('admin.state.index')
            ->with('success', 'State updated successfully!');
    }

    public function destroy($id)
    {
        $state = State::findOrFail($id);
        if ($state->state_image && file_exists(public_path($state->state_image))) {
            unlink(public_path($state->state_image));
        }
        $state->delete();

        return redirect()->route('admin.state.index')
            ->with('success', 'State deleted successfully!');
    }
}