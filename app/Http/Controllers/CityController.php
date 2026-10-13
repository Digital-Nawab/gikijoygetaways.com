<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\State;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::with('state')->latest()->get();
        return view('admin.pages.City.index', compact('cities'));
    }

    public function create()
    {
        $states = State::with('country')->get();
        return view('admin.pages.City.create', compact('states'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'state_id' => 'required',
            'name' => 'required'
        ]);

        City::create([
            'state_id' => $request->state_id,
            'name' => $request->name,
            'status' => 1
        ]);

        return redirect()->route('admin.city.index')
            ->with('success', 'City added successfully');
    }

    public function edit($id)
    {
        $city = City::findOrFail($id);
        $states = State::with('country')->get();

        return view('admin.pages.City.edit', compact('city', 'states'));
    }

    public function update(Request $request, $id)
    {
        $city = City::findOrFail($id);

        $city->update([
            'state_id' => $request->state_id,
            'name' => $request->name
        ]);

        return redirect()->route('admin.city.index')
            ->with('success', 'City updated successfully');
    }

    public function destroy($id)
    {
        City::findOrFail($id)->delete();

        return redirect()->route('admin.city.index')
            ->with('success', 'City deleted successfully');
    }
}