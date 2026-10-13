<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('admin.pages.Slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.pages.Slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required|max:255',
            'subheading' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'video' => 'nullable|mimes:mp4,webm,mov,avi|max:20240',
        ]);

        $imageName = null;
        $videoName = null;

        if ($request->hasFile('image')) {
            $imageName = time().'_img.'.$request->image->extension();
            $request->image->move(public_path('admin-assets/home/slider'), $imageName);
        }

        if ($request->hasFile('video')) {
            $videoName = time().'_vid.'.$request->video->extension();
            $request->video->move(public_path('admin-assets/home/slider'), $videoName);
        }

        Slider::create([
            'heading' => $request->heading,
            'subheading' => $request->subheading,
            'image' => $imageName,
            'video' => $videoName,
            'status' => 1,
        ]);

        return redirect()->route('admin.slider.index')
            ->with('success', 'Slider added successfully.');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        //return $sliders;
        return view('admin.pages.Slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        $request->validate([
            'heading' => 'required|max:255',
            'subheading' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'video' => 'nullable|mimes:mp4,webm,mov,avi|max:20240',
        ]);

        $imageName = $slider->image;
        $videoName = $slider->video;

        if ($request->hasFile('image')) {
            $imageName = time().'_img.'.$request->image->extension();
            $request->image->move(public_path('admin-assets/home/slider'), $imageName);
        }

        if ($request->hasFile('video')) {
            $videoName = time().'_vid.'.$request->video->extension();
            $request->video->move(public_path('admin-assets/home/slider'), $videoName);
        }

        $slider->update([
            'heading' => $request->heading,
            'subheading' => $request->subheading,
            'image' => $imageName,
            'video' => $videoName,
        ]);

        return redirect()->route('admin.slider.index')
            ->with('success', 'Slider updated successfully.');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        // delete image
        if ($slider->image && file_exists(public_path('admin-assets/home/slider/' . $slider->image))) {
            unlink(public_path('admin-assets/home/slider/' . $slider->image));
        }

        // delete video
        if ($slider->video && file_exists(public_path('admin-assets/home/slider/' . $slider->video))) {
            unlink(public_path('admin-assets/home/slider/' . $slider->video));
        }

        $slider->delete();

        return redirect()->route('admin.slider.index')
            ->with('success', 'Slider deleted successfully.');
    }
}