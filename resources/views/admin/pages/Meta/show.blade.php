@extends('admin.layout.master')

@section('content')

<div class="w-full mx-auto">

    <!-- Top bar -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
        <div class="flex items-center gap-2 text-sm text-slate-400">
            <a href="{{ route('admin.meta.index') }}" class="hover:text-slate-600 transition-colors">Meta SEO</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-slate-600 font-medium">Details</span>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('admin.meta.edit', $metaPage->id) }}"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-medium shadow-md hover:shadow-lg transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit
            </a>
            <a href="{{ route('admin.meta.index') }}"
                class="inline-flex items-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 px-5 py-2.5 rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back
            </a>
        </div>
    </div>

    <!-- Hero header -->
    <div class="relative bg-gradient-to-br from-indigo-600 to-violet-600 rounded-3xl shadow-lg overflow-hidden mb-6">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 20px 20px;"></div>
        <div class="relative px-8 py-8 flex items-center gap-5">
            @if($metaPage->shortcut_icon)
            <img src="{{ asset('admin-assets/home/Meta/' . $metaPage->shortcut_icon) }}"
                class="w-20 h-20 rounded-2xl object-cover border-4 border-white/20 shadow-lg shrink-0">
            @else
            <div class="w-20 h-20 rounded-2xl bg-white/20 flex items-center justify-center shrink-0">
                <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            @endif
            <div class="min-w-0">
                <h2 class="text-2xl sm:text-3xl font-bold text-white tracking-tight truncate">
                    {{ $metaPage->page_title ?: 'Untitled Page' }}
                </h2>
                @if($metaPage->page_url)
                <span class="inline-flex items-center gap-1.5 mt-2 bg-white/20 text-white px-3 py-1 rounded-lg text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                    /{{ $metaPage->page_url }}
                </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Detail cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Meta Title -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center gap-2 mb-3">
                <div class="w-8 h-8 rounded-lg bg-indigo-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-slate-700 uppercase tracking-wide">Meta Title</h3>
            </div>
            <p class="text-slate-800">{{ $metaPage->meta_title ?: '—' }}</p>
            @if($metaPage->meta_title)
            <p class="text-xs text-slate-400 mt-2">{{ strlen($metaPage->meta_title) }} characters</p>
            @endif
        </div>

        <!-- Meta Keywords -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center gap-2 mb-3">
                <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5a1.99 1.99 0 011.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-slate-700 uppercase tracking-wide">Meta Keywords</h3>
            </div>
            @if($metaPage->meta_keywords)
            <div class="flex flex-wrap gap-2">
                @foreach(explode(',', $metaPage->meta_keywords) as $keyword)
                    @if(trim($keyword) !== '')
                    <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-lg text-sm">{{ trim($keyword) }}</span>
                    @endif
                @endforeach
            </div>
            @else
            <p class="text-slate-400">—</p>
            @endif
        </div>

        <!-- Meta Description (full width) -->
        <div class="md:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center gap-2 mb-3">
                <div class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-slate-700 uppercase tracking-wide">Meta Description</h3>
            </div>
            <p class="text-slate-600 leading-relaxed">{{ $metaPage->meta_description ?: '—' }}</p>
            @if($metaPage->meta_description)
            <p class="text-xs text-slate-400 mt-3">{{ strlen($metaPage->meta_description) }} characters</p>
            @endif
        </div>

    </div>

</div>

@endsection