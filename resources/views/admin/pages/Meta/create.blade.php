@extends('admin.layout.master')

@section('content')

<div class="w-full mx-auto">

    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-8">
        <div>
            <h2 class="text-3xl font-bold text-slate-800 tracking-tight">
                Add Meta SEO
            </h2>
            <p class="text-slate-500 mt-1 text-sm">
                Create new SEO meta page
            </p>
        </div>

        <a href="{{ route('admin.meta.index') }}"
            class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 px-5 py-3 rounded-xl font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back
        </a>
    </div>

    @if ($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-600 p-4 rounded-xl mb-6">
        <ul class="list-disc pl-5 space-y-1 text-sm">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <form action="{{ route('admin.meta.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Page Title</label>
                    <input type="text" name="page_title"
                        value="{{ old('page_title') }}"
                        placeholder="Page title"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Page URL</label>
                    <input type="text" name="page_url"
                        value="{{ old('page_url') }}"
                        placeholder="Page URL"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Meta Title</label>
                <input type="text" name="meta_title"
                    value="{{ old('meta_title') }}"
                    class="w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
            </div>

            <div class="mt-6">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Meta Description</label>
                <textarea name="meta_description" rows="5"
                    class="w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">{{ old('meta_description') }}</textarea>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Meta Keywords</label>
                <textarea name="meta_keywords" rows="4"
                    placeholder="seo, marketing, web"
                    class="w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">{{ old('meta_keywords') }}</textarea>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Shortcut Icon</label>
                <input type="file" name="shortcut_icon"
                    class="w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-600 file:font-medium hover:file:bg-indigo-100 transition cursor-pointer">
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl shadow-md hover:shadow-lg transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Save Meta SEO
                </button>
            </div>
        </form>
    </div>

</div>

@endsection