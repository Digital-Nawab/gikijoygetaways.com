@extends('admin.layout.master')

@section('content')

{{-- Header --}}
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">
        <i class="bx bx-file mr-2"></i> Blog Details
    </h2>
    <a href="{{ route('admin.blog.index') }}"
       class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm px-4 py-2 rounded-lg transition">
        <i class="bx bx-arrow-back"></i> Back
    </a>
</div>

{{-- Main Layout --}}
<div class="flex gap-6 items-start">

    {{-- LEFT: Blog Content --}}
    <div class="flex-1 min-w-0">
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

            {{-- Blog Image --}}
            <img src="{{ asset('admin-assets/home/Blog/'.$blog->image) }}"
                 alt="{{ $blog->title }}"
                 class="w-full h-72 object-cover">

            {{-- Blog Body --}}
            <div class="p-6">

                {{-- Meta --}}
                <div class="flex gap-5 mb-4 flex-wrap">
                    <span class="flex items-center gap-1.5 text-xs text-gray-500">
                        <i class="bx bx-calendar text-base"></i>
                        {{ \Carbon\Carbon::parse($blog->date)->format('d F, Y') }}
                    </span>
                    <span class="flex items-center gap-1.5 text-xs text-gray-500">
                        <i class="bx bx-map text-base"></i>
                        {{ $blog->location ?? 'Travel' }}
                    </span>
                    <span class="flex items-center gap-1.5 text-xs text-gray-500">
                        <i class="bx bx-link text-base"></i>
                        {{ $blog->slug }}
                    </span>
                </div>

                {{-- Title --}}
                <h3 class="text-xl font-semibold text-gray-800 mb-3 leading-snug">
                    {{ $blog->title }}
                </h3>

                {{-- Short Description --}}
                <p class="text-sm text-gray-500 leading-relaxed mb-5 pb-5 border-b border-gray-100">
                    {{ $blog->short_description }}
                </p>

                {{-- Full Description --}}
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3">
                    Full Description
                </p>
                <div class="blog-full-content prose max-w-none text-sm text-gray-600 leading-relaxed">
                    {!! $blog->description !!}
                </div>

            </div>

            {{-- Action Bar --}}
            <div class="flex gap-3 px-6 py-4 bg-gray-50 border-t border-gray-100">
                <a href="{{ route('admin.blog.edit', $blog->id) }}"
                   class="flex items-center gap-2 bg-amber-100 hover:bg-amber-200 text-amber-800 text-sm px-4 py-2 rounded-lg transition">
                    <i class="bx bx-edit"></i> Edit
                </a>
                <a href="{{ url('blog-details', $blog->id) }}" target="_blank"
                   class="flex items-center gap-2 bg-green-100 hover:bg-green-200 text-green-800 text-sm px-4 py-2 rounded-lg transition">
                    <i class="bx bx-link-external"></i> View Live
                </a>
                <form action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this blog?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="flex items-center gap-2 bg-red-100 hover:bg-red-200 text-red-800 text-sm px-4 py-2 rounded-lg transition">
                        <i class="bx bx-trash"></i> Delete
                    </button>
                </form>
            </div>

        </div>
    </div>

    {{-- RIGHT: Sidebar --}}
    <div class="w-64 flex-shrink-0 flex flex-col gap-4">

        {{-- Post Info --}}
        <div class="bg-white border border-gray-200 rounded-xl p-5">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4 pb-2 border-b border-gray-100">
                <i class="bx bx-info-circle mr-1"></i> Post Info
            </p>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between items-center">
                    <span class="text-gray-500 flex items-center gap-1"><i class="bx bx-calendar"></i> Date</span>
                    <span class="font-medium text-gray-700">{{ \Carbon\Carbon::parse($blog->date)->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-500 flex items-center gap-1"><i class="bx bx-show"></i> Status</span>
                    <span class="bg-green-100 text-green-800 text-xs px-2.5 py-1 rounded-full font-medium">Active</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-500 flex items-center gap-1"><i class="bx bx-map-pin"></i> Location</span>
                    <span class="font-medium text-gray-700">{{ $blog->location ?? 'Travel' }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-500 flex items-center gap-1"><i class="bx bx-hash"></i> Blog ID</span>
                    <span class="font-medium text-gray-700">#{{ $blog->id }}</span>
                </div>
            </div>
            <div class="mt-4 bg-gray-50 rounded-lg p-3">
                <p class="text-xs text-gray-400 mb-1">Slug</p>
                <p class="text-xs text-gray-600 break-all">{{ $blog->slug }}</p>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white border border-gray-200 rounded-xl p-5">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4 pb-2 border-b border-gray-100">
                <i class="bx bx-bolt-circle mr-1"></i> Quick Actions
            </p>
            <div class="flex flex-col gap-2">
                <a href="{{ route('admin.blog.edit', $blog->id) }}"
                   class="flex items-center justify-center gap-2 bg-amber-100 hover:bg-amber-200 text-amber-800 text-sm px-4 py-2.5 rounded-lg transition w-full">
                    <i class="bx bx-edit"></i> Edit Blog
                </a>
                <a href="{{ url('blog-details', $blog->id) }}" target="_blank"
                   class="flex items-center justify-center gap-2 bg-green-100 hover:bg-green-200 text-green-800 text-sm px-4 py-2.5 rounded-lg transition w-full">
                    <i class="bx bx-link-external"></i> View on Site
                </a>
                <form action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST"
                      onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="flex items-center justify-center gap-2 bg-red-100 hover:bg-red-200 text-red-800 text-sm px-4 py-2.5 rounded-lg transition w-full">
                        <i class="bx bx-trash"></i> Delete Blog
                    </button>
                </form>
            </div>
        </div>

    </div>

</div>

@endsection