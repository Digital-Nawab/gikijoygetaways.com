<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::latest()->get();
        return view('admin.pages.Country.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.pages.Country.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        Country::create([
            'name' => $request->name,
            'status' => 1
        ]);

        return redirect()->route('admin.country.index')
            ->with('success', 'Country added successfully');
    }

    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('admin.pages.Country.edit', compact('country'));
    }

    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);

        $country->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.country.index')
            ->with('success', 'Country updated successfully');
    }

    public function destroy($id)
    {
        Country::findOrFail($id)->delete();

        return redirect()->route('admin.Country.index')
            ->with('success', 'Country deleted successfully');
    }
}