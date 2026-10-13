<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetaPage;

class MetaPageController extends Controller
{
    public function index()
    {
        $metaPages = MetaPage::latest()->get();

        return view('admin.pages.Meta.index', compact('metaPages'));
    }

    public function create()
    {
        return view('admin.pages.Meta.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'page_title' => 'nullable',
            'page_url' => 'required|unique:meta_pages,page_url',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
            'shortcut_icon' => 'nullable|image|mimes:png,jpg,jpeg,ico,webp',
        ]);

        $iconName = null;

        if ($request->hasFile('shortcut_icon')) {

            $file = $request->file('shortcut_icon');

            $iconName = time() . '.' . $file->getClientOriginalExtension();

            $file->move('admin-assets/home/Meta', $iconName);
        }

        MetaPage::create([
            'page_title' => $request->page_title,
            'page_url' => $request->page_url,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'shortcut_icon' => $iconName,
            'status' => 1,
        ]);

        return redirect()->route('admin.meta.index')
            ->with('success', 'Meta page created successfully.');
    }

    public function edit($id)
    {
        $metaPage = MetaPage::findOrFail($id);

        return view('admin.pages.Meta.edit', compact('metaPage'));
    }

    public function update(Request $request, $id)
    {
        $metaPage = MetaPage::findOrFail($id);

        $request->validate([
            'page_title' => 'nullable',
            'page_url' => 'required|unique:meta_pages,page_url,' . $id,
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
            'shortcut_icon' => 'nullable|image|mimes:png,jpg,jpeg,ico,webp',
        ]);

        $iconName = $metaPage->shortcut_icon;

        if ($request->hasFile('shortcut_icon')) {

            $file = $request->file('shortcut_icon');

            $iconName = time() . '.' . $file->getClientOriginalExtension();

            $file->move('admin-assets/home/Meta', $iconName);
        }

        $metaPage->update([
            'page_title' => $request->page_title,
            'page_url' => $request->page_url,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'shortcut_icon' => $iconName,
        ]);

        return redirect()->route('admin.meta.index')
            ->with('success', 'Meta page updated successfully.');
    }
    public function show($id)
    {
        $metaPage = MetaPage::findOrFail($id);
        return view('admin.pages.Meta.show', compact('metaPage'));
    }
    public function destroy($id)
    {
        $metaPage = MetaPage::findOrFail($id);

        $metaPage->delete();

        return redirect()->route('admin.meta.index')
            ->with('success', 'Meta page deleted successfully.');
    }
}
