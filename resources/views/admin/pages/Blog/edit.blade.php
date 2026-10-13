@extends('admin.layout.master')

@section('content')

<div class="flex justify-between items-center mb-8">
    <h2 class="text-3xl font-bold">Edit Blog</h2>
    <a href="{{ route('admin.blog.index') }}"
       class="bg-gray-600 text-white px-5 py-2 rounded-xl">
        Back
    </a>
</div>

<div class="bg-white p-6 rounded-xl shadow">

<form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
@csrf

{{-- Title --}}
<div class="mb-5">
    <label class="block mb-1 font-medium">Title</label>
    <input type="text" name="title" id="title"
        value="{{ $blog->title }}"
        class="w-full border rounded px-4 py-3" required>
</div>

{{-- Slug --}}
<div class="mb-5">
    <label class="block mb-1 font-medium">Slug</label>
    <input type="text" name="slug" id="slug"
        value="{{ $blog->slug }}"
        class="w-full border rounded px-4 py-3 bg-gray-100" readonly>
</div>

{{-- Date --}}
<div class="mb-4">
    <label class="block mb-1 font-medium">Date</label>
    <input type="date" name="date"
        value="{{ $blog->date }}"
        class="w-full border p-3 rounded">
</div>

{{-- Short Description --}}
<div class="mb-4">
    <label class="block mb-1 font-medium">Short Description</label>
    <textarea name="short_description" class="w-full border p-3 rounded" rows="3">{{ $blog->short_description }}</textarea>
</div>

{{-- Description --}}
<div class="mb-4">
    <label class="block mb-1 font-medium">Description</label>
    <textarea name="description" id="description" rows="10" class="w-full border p-3 rounded">{{ $blog->description }}</textarea>
</div>

{{-- Current Image --}}
<div class="mb-4">
    <label class="block mb-1 font-medium">Current Image</label>
    <img src="{{ asset('admin-assets/home/Blog/'.$blog->image) }}" width="150" class="rounded">
</div>

{{-- New Image --}}
<div class="mb-6">
    <label class="block mb-1 font-medium">New Image</label>
    <input type="file" name="image" class="w-full border p-3 rounded">
</div>

<button class="bg-green-600 text-white px-6 py-2 rounded">
    Update Blog
</button>

</form>
</div>

{{-- CKEditor 4 CDN --}}
<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script>
    // CKEditor 4 - Full toolbar with lists, headings, tables etc.
    CKEDITOR.replace('description', {
        toolbar: [
            { name: 'styles',      items: ['Format', 'Font', 'FontSize'] },
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat'] },
            { name: 'colors',      items: ['TextColor', 'BGColor'] },
            { name: 'paragraph',   items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
            { name: 'align',       items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
            { name: 'links',       items: ['Link', 'Unlink'] },
            { name: 'insert',      items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar'] },
            { name: 'tools',       items: ['Maximize', 'Source'] },
        ],
        height: 400,
    });

    // Slug auto-generate from Title
    document.getElementById('title').addEventListener('keyup', function() {
        let slug = this.value
            .toLowerCase()
            .replace(/ /g, '-')
            .replace(/[^\w-]+/g, '');
        document.getElementById('slug').value = slug;
    });
</script>

@endsection