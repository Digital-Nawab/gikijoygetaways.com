<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('admin.pages.Blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.pages.Blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image',
            'date' => 'required',
            'short_description' => 'required',
            'description' => 'required',
        ]);

        // Image Upload
        $imageName = time().'.'.$request->image->extension();
        $request->image->move('admin-assets/home/Blog', $imageName);


        $slug = Str::slug($request->title);
        $count = Blog::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        Blog::create([
            'title' => $request->title,
            'slug' => $slug,
            'image' => $imageName,
            'date' => $request->date,
            'short_description' => $request->short_description,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.blog.index')->with('success','Blog Added');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.pages.Blog.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image',
            'date' => 'required',
            'short_description' => 'required',
            'description' => 'required',
        ]);

        // Image Update
        $imageName = $blog->image;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move('admin-assets/home/Blog', $imageName);
        }

        $slug = Str::slug($request->title);
        $count = Blog::where('slug', 'LIKE', "{$slug}%")
                    ->where('id', '!=', $id)
                    ->count();

        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        $blog->update([
            'title' => $request->title,
            'slug' => $slug,
            'image' => $imageName,
            'date' => $request->date,
            'short_description' => $request->short_description,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.blog.index')->with('success','Updated');
    }
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.pages.Blog.show', compact('blog'));
    }
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        // Image delete (optional but best practice)
        if ($blog->image && 'admin-assets/home/Blog/'.$blog->image) {
            unlink('admin-assets/home/Blog/'.$blog->image);
        }

        $blog->delete();

        return back()->with('success','Deleted');
    }
}