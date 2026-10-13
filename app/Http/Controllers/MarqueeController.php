<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marquee;

class MarqueeController extends Controller
{
    public function marquee()
    {
        $marquees = Marquee::latest()->get();

        return view('admin.pages.marquee.index', compact('marquees'));
    }

    public function create()
    {
        return view('admin.pages.marquee.create');
    }

    public function storeMarquee(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        Marquee::create([
            'title' => $request->title,
            'status' => 1,
        ]);

        return redirect()->route('admin.marquee')->with('success', 'Marquee added successfully.');
    }
    public function edit($id)
    {
        $marquee = Marquee::findOrFail($id);
        return view('admin.pages.marquee.edit', compact('marquee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $marquee = Marquee::findOrFail($id);

        $marquee->update([
            'title' => $request->title,
        ]);

        return redirect()->route('admin.marquee')->with('success', 'Marquee updated successfully.');
    }

    public function destroy($id)
    {
        $marquee = Marquee::findOrFail($id);
        $marquee->delete();

        return redirect()->route('admin.marquee')->with('success', 'Marquee deleted successfully.');
    }
}
