@extends('admin.layout.master')

@section('content')
    <div class="w-full px-6 pb-10">

        {{-- ═══ HEADER ═══ --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">📋 Hotel Detail</h2>
                <p class="text-slate-500 text-sm mt-1">
                    Hotel: <span class="font-semibold text-blue-600">{{ $package->name }}</span>
                </p>
            </div>
            <div class="flex gap-3">
                @if($detail)
                    <a href="{{ route('admin.package.detail.edit', $detail->id) }}"
                       class="bg-amber-400 hover:bg-amber-500 text-white px-4 py-2.5 rounded-xl text-sm font-semibold transition flex items-center gap-2">
                        ✏️ Edit Detail
                    </a>
                @else
                    <a href="{{ route('admin.package.detail.create', $package->id) }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl text-sm font-semibold transition flex items-center gap-2">
                        + Add Detail
                    </a>
                @endif
                <a href="{{ route('admin.package.index') }}"
                   class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2.5 rounded-xl text-sm font-semibold transition flex items-center gap-2">
                    ← Back
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-5 text-sm font-medium">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- ═══ EMPTY STATE ═══ --}}
        @if(!$detail)
            <div class="bg-white rounded-3xl border border-slate-200 p-20 text-center">
                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-700 mb-2">No Detail Added Yet</h3>
                <p class="text-slate-400 text-sm mb-5">Add detail info to help travelers plan better.</p>
                <a href="{{ route('admin.package.detail.create', $package->id) }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl font-semibold text-sm transition inline-block">
                    + Add Detail Now
                </a>
            </div>

        @else

            <div class="space-y-6">

                {{-- ═══ BANNER IMAGE (HERO) ═══ --}}
                @if($detail->banner_image)
                    <div class="relative w-full rounded-2xl overflow-hidden shadow-sm border border-slate-200" style="height: 320px;">
                        <img src="{{ asset('admin-assets/home/package/' . $detail->banner_image) }}"
                             alt="Package Banner" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                            @if($detail->hero_badge)
                                <span class="inline-flex items-center gap-1.5 bg-amber-400 text-amber-900 px-3 py-1.5 rounded-full text-xs font-bold shadow">
                        🏆 {{ $detail->hero_badge }}
                    </span>
                            @endif
                            @if($detail->offer_badge_text)
                                <span class="inline-flex items-center gap-1.5 bg-red-500 text-white px-3 py-1.5 rounded-full text-xs font-bold shadow">
                        {{ $detail->offer_badge_text }}
                    </span>
                            @endif
                        </div>
                        <div class="absolute bottom-5 left-5 right-5">
                            <h3 class="text-white text-xl font-bold drop-shadow-sm">{{ $package->name }}</h3>
                            <p class="text-slate-300 text-sm mt-1 flex items-center gap-1.5">
                                <span>📍</span>
                                <span>{{ $package->city->name ?? '' }}{{ isset($package->state->name) ? ', ' . $package->state->name : '' }}</span>
                                <span class="mx-2 text-slate-500">•</span>
                                <span>🗓️ {{ $package->days }} Days / {{ $package->nights }} Nights</span>
                            </p>
                        </div>
                        <a href="{{ route('admin.package.detail.edit', $detail->id) }}"
                           class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm hover:bg-white/40 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition border border-white/30">
                            ✏️ Edit
                        </a>
                    </div>
                @endif

                {{-- ═══ ROW: Hero Badges + Package Summary (no banner fallback) ═══ --}}
                @if(!$detail->banner_image)
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 p-6">
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-4">Hero Section</p>
                            <div class="flex flex-wrap gap-3 mb-5">
                                @if($detail->hero_badge)
                                    <span class="inline-flex items-center gap-1.5 bg-amber-100 text-amber-700 border border-amber-200 px-3 py-1.5 rounded-full text-xs font-bold">
                            🏆 Hero Badge: {{ $detail->hero_badge }}
                        </span>
                                @else
                                    <span class="inline-flex items-center bg-slate-100 text-slate-400 px-3 py-1.5 rounded-full text-xs">No hero badge set</span>
                                @endif
                                @if($detail->offer_badge_text)
                                    <span class="inline-flex items-center gap-1.5 bg-red-50 text-red-600 border border-red-200 px-3 py-1.5 rounded-full text-xs font-bold">
                            {{ $detail->offer_badge_text }}
                        </span>
                                @else
                                    <span class="inline-flex items-center bg-slate-100 text-slate-400 px-3 py-1.5 rounded-full text-xs">No offer badge set</span>
                                @endif
                            </div>
                            <div class="bg-slate-50 border border-dashed border-slate-300 rounded-xl flex flex-col items-center justify-center py-10 text-slate-400 text-sm">
                                <svg class="w-10 h-10 text-slate-300 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M13.5 12h.008v.008H13.5V12zm0 0a2.25 2.25 0 110-4.5 2.25 2.25 0 010 4.5z"/>
                                </svg>
                                No banner image uploaded.
                                <a href="{{ route('admin.package.detail.edit', $detail->id) }}" class="text-blue-500 hover:underline mt-1 text-xs">Upload one →</a>
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl p-6 text-white flex flex-col justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-widest text-blue-200 mb-4">Package Summary</p>
                                <div class="space-y-3 text-sm">
                                    <div class="flex justify-between pb-2 border-b border-blue-500/40">
                                        <span class="text-blue-200">📍 Location</span>
                                        <span class="font-semibold text-right">{{ $package->city->name ?? 'N/A' }}, {{ $package->state->name ?? '' }}</span>
                                    </div>
                                    <div class="flex justify-between pb-2 border-b border-blue-500/40">
                                        <span class="text-blue-200">🗓️ Duration</span>
                                        <span class="font-semibold">{{ $package->days }} Days / {{ $package->nights }} Nights</span>
                                    </div>
                                    <div class="flex justify-between pb-2 border-b border-blue-500/40">
                                        <span class="text-blue-200">💰 Total Price</span>
                                        <span class="font-bold text-lg">₹{{ number_format($package->total_price, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-blue-200">🟢 Advance</span>
                                        <span class="font-semibold">₹{{ number_format($package->advance_price ?? 0, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('admin.package.detail.edit', $detail->id) }}"
                               class="mt-6 bg-white/20 hover:bg-white/30 text-white text-sm font-semibold px-4 py-2.5 rounded-xl text-center transition flex items-center justify-center gap-2">
                                ✏️ Edit This Detail
                            </a>
                        </div>
                    </div>
                @endif

                {{-- ═══ PACKAGE SUMMARY STRIP (when banner exists) ═══ --}}
                @if($detail->banner_image)
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-white rounded-2xl border border-slate-200 p-4 flex items-center gap-3">
                            <div class="w-9 h-9 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center flex-shrink-0 text-base">📍</div>
                            <div>
                                <p class="text-xs text-slate-400">Location</p>
                                <p class="text-sm font-semibold text-slate-700">{{ $package->city->name ?? 'N/A' }}, {{ $package->state->name ?? '' }}</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-2xl border border-slate-200 p-4 flex items-center gap-3">
                            <div class="w-9 h-9 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center flex-shrink-0 text-base">🗓️</div>
                            <div>
                                <p class="text-xs text-slate-400">Duration</p>
                                <p class="text-sm font-semibold text-slate-700">{{ $package->days }}D / {{ $package->nights }}N</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-2xl border border-slate-200 p-4 flex items-center gap-3">
                            <div class="w-9 h-9 bg-green-100 text-green-600 rounded-lg flex items-center justify-center flex-shrink-0 text-base">💰</div>
                            <div>
                                <p class="text-xs text-slate-400">Total Price</p>
                                <p class="text-sm font-semibold text-slate-700">₹{{ number_format($package->total_price, 2) }}</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-2xl border border-slate-200 p-4 flex items-center gap-3">
                            <div class="w-9 h-9 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center flex-shrink-0 text-base">🟢</div>
                            <div>
                                <p class="text-xs text-slate-400">Advance</p>
                                <p class="text-sm font-semibold text-slate-700">₹{{ number_format($package->advance_price ?? 0, 2) }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- ═══ DESCRIPTION ═══ --}}
                @if($detail->description)
                    <div class="bg-white rounded-2xl border border-slate-200 p-6">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-3">📝 Overview / Description</p>
                        <div class="text-sm text-slate-600 leading-relaxed prose max-w-none">
                            {!! $detail->description !!}
                        </div>
                    </div>
                @endif

                {{-- ═══ HIGHLIGHTS ═══ --}}
                @php
                    $highlights = is_array($detail->highlights)
                        ? $detail->highlights
                        : (json_decode($detail->highlights ?? '[]', true) ?? []);
                @endphp
                <div class="bg-white rounded-2xl border border-slate-200 p-6">
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">
                            ⭐ Highlights Grid
                            <span class="ml-2 bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full text-xs font-bold">{{ count($highlights) }} items</span>
                        </p>
                    </div>
                    @if(count($highlights) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                            @foreach($highlights as $hl)
                                <div class="flex items-start gap-3 border border-slate-200 rounded-xl p-4 bg-slate-50 hover:border-blue-300 hover:bg-blue-50 transition">
                                    <div class="w-9 h-9 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="bi {{ $hl['icon'] ?? 'bi-star' }}"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-semibold text-slate-700 leading-tight">{{ $hl['title'] ?? '—' }}</p>
                                        <p class="text-xs text-slate-400 mt-0.5">{{ $hl['subtitle'] ?? '' }}</p>
                                        <p class="text-xs text-blue-400 mt-1 font-mono">{{ $hl['icon'] ?? '' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-10 border-2 border-dashed border-slate-200 rounded-xl text-slate-400 text-sm">
                            No highlights added yet.
                            <a href="{{ route('admin.package.detail.edit', $detail->id) }}" class="text-blue-500 hover:underline ml-1">Add now →</a>
                        </div>
                    @endif
                </div>

                {{-- ═══ AMENITIES ═══ --}}
                @php
                    $amenities = is_array($detail->amenities)
                        ? $detail->amenities
                        : (json_decode($detail->amenities ?? '[]', true) ?? []);
                @endphp
                <div class="bg-white rounded-2xl border border-slate-200 p-6">
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">
                            🏠 Amenities Grid
                            <span class="ml-2 bg-green-100 text-green-600 px-2 py-0.5 rounded-full text-xs font-bold">{{ count($amenities) }} items</span>
                        </p>
                    </div>
                    @if(count($amenities) > 0)
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                            @foreach($amenities as $am)
                                <div class="flex flex-col items-center text-center gap-2 border border-slate-200 rounded-xl p-4 bg-slate-50 hover:border-green-300 hover:bg-green-50 transition">
                                    <div class="w-10 h-10 bg-green-100 text-green-600 rounded-xl flex items-center justify-center text-lg">
                                        <i class="bi {{ $am['icon'] ?? 'bi-check' }}"></i>
                                    </div>
                                    <p class="text-xs font-semibold text-slate-700 leading-tight">{{ $am['label'] ?? '—' }}</p>
                                    <p class="text-xs text-slate-300 font-mono">{{ $am['icon'] ?? '' }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-10 border-2 border-dashed border-slate-200 rounded-xl text-slate-400 text-sm">
                            No amenities added yet.
                            <a href="{{ route('admin.package.detail.edit', $detail->id) }}" class="text-blue-500 hover:underline ml-1">Add now →</a>
                        </div>
                    @endif
                </div>

                {{-- ═══ CONTACT & LOCATION ═══ --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-6">
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">
                            📍 Contact & Location
                        </p>
                        <a href="{{ route('admin.package.detail.edit', $detail->id) }}"
                           class="text-xs text-blue-500 hover:underline">Edit →</a>
                    </div>

                    @if($detail->email || $detail->mobile || $detail->address || $detail->map_url)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">

                            {{-- Email --}}
                            @if($detail->email)
                                <div class="flex items-center gap-3 border border-slate-200 rounded-xl p-4 bg-slate-50">
                                    <div class="w-9 h-9 bg-orange-100 text-orange-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-400">Email</p>
                                        <a href="mailto:{{ $detail->email }}" class="text-sm font-semibold text-blue-600 hover:underline">{{ $detail->email }}</a>
                                    </div>
                                </div>
                            @endif

                            {{-- Mobile --}}
                            @if($detail->mobile)
                                <div class="flex items-center gap-3 border border-slate-200 rounded-xl p-4 bg-slate-50">
                                    <div class="w-9 h-9 bg-green-100 text-green-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-400">Mobile</p>
                                        <a href="tel:{{ $detail->mobile }}" class="text-sm font-semibold text-slate-700">{{ $detail->mobile }}</a>
                                    </div>
                                </div>
                            @endif

                            {{-- Address --}}
                            @if($detail->address)
                                <div class="flex items-start gap-3 border border-slate-200 rounded-xl p-4 bg-slate-50 md:col-span-2">
                                    <div class="w-9 h-9 bg-red-100 text-red-500 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-400">Address</p>
                                        <p class="text-sm font-semibold text-slate-700 leading-relaxed">{{ $detail->address }}</p>
                                    </div>
                                </div>
                            @endif

                        </div>

                        {{-- Google Map Embed --}}
                        @if($detail->map_url)
                            <div class="rounded-xl overflow-hidden border border-slate-200">
                                <iframe
                                        src="{{ $detail->map_url }}"
                                        width="100%"
                                        height="280"
                                        style="border:0;display:block;"
                                        allowfullscreen
                                        loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        @endif

                    @else
                        <div class="text-center py-10 border-2 border-dashed border-slate-200 rounded-xl text-slate-400 text-sm">
                            No contact info added yet.
                            <a href="{{ route('admin.package.detail.edit', $detail->id) }}" class="text-blue-500 hover:underline ml-1">Add now →</a>
                        </div>
                    @endif
                </div>

                {{-- ═══ SUB PACKAGES ═══ --}}
                @php
                    $subPackagesData = $subPackages ?? collect([]);
                @endphp
                <div class="bg-white rounded-2xl border border-slate-200 p-6">
                    <div class="flex justify-between items-center mb-5">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide flex items-center gap-2">
                            📦 Sub Packages
                            <span class="bg-amber-100 text-amber-600 px-2 py-0.5 rounded-full text-xs font-bold">
                        {{ $subPackagesData->count() }} items
                    </span>
                        </p>
                        <a href="{{ route('admin.package.detail.edit', $detail->id) }}"
                           class="text-xs bg-amber-500 hover:bg-amber-600 text-white px-3 py-1.5 rounded-lg font-semibold transition">
                            ✏️ Edit Sub Packages
                        </a>
                    </div>

                    @if($subPackagesData->isEmpty())
                        <div class="text-center py-12 border-2 border-dashed border-slate-200 rounded-xl text-slate-400 text-sm">
                            <div class="text-4xl mb-2">📦</div>
                            No sub-packages added yet.
                            <a href="{{ route('admin.package.detail.edit', $detail->id) }}" class="text-amber-500 hover:underline ml-1">Add now →</a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach($subPackagesData as $sp)
                                @php
                                    $feats = is_array($sp->features)
                                        ? $sp->features
                                        : (json_decode($sp->features ?? '[]', true) ?? []);
                                @endphp
                                <div class="border-2 rounded-2xl p-5 flex flex-col
                            {{ $sp->is_featured ? 'border-amber-400 bg-amber-50' : 'border-slate-200 bg-slate-50' }}">

                                    {{-- Badges --}}
                                    <div class="flex flex-wrap items-center gap-2 mb-3">
                                        @if($sp->badge)
                                            <span class="text-xs bg-amber-100 text-amber-700 px-2.5 py-1 rounded-full font-semibold uppercase tracking-wide">
                                        {{ $sp->badge }}
                                    </span>
                                        @endif
                                        @if($sp->editor_badge)
                                            <span class="text-xs bg-amber-500 text-white px-2.5 py-1 rounded-full font-semibold">
                                        {{ $sp->editor_badge }}
                                    </span>
                                        @endif
                                        @if($sp->is_featured)
                                            <span class="text-xs bg-yellow-200 text-yellow-800 px-2 py-0.5 rounded-full font-semibold">⭐ Featured</span>
                                        @endif
                                    </div>

                                    <h4 class="font-bold text-slate-800 text-base mb-3">{{ $sp->name }}</h4>

                                    <ul class="space-y-1.5 mb-4 flex-1">
                                        @foreach($feats as $feat)
                                            <li class="flex items-start gap-2 text-sm text-slate-600">
                                                <span class="text-amber-500 mt-0.5 flex-shrink-0">✔</span>
                                                {{ $feat }}
                                            </li>
                                        @endforeach
                                    </ul>

                                    @if($sp->price)
                                        <div class="mb-3">
                                            <p class="text-xs text-slate-400 uppercase tracking-wide font-semibold">From</p>
                                            <p class="text-xl font-bold text-slate-800">₹{{ number_format($sp->price) }}</p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- ═══ REVIEWS / TESTIMONIALS ═══ --}}
                @php
                    $reviewsData = $reviews ?? collect([]);
                @endphp
                <div class="bg-white rounded-2xl border border-slate-200 p-6">
                    <div class="flex justify-between items-center mb-5">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide flex items-center gap-2">
                            💬 Reviews & Experiences
                            <span class="bg-rose-100 text-rose-600 px-2 py-0.5 rounded-full text-xs font-bold">
                        {{ $reviewsData->count() }} items
                    </span>
                        </p>
                        <a href="{{ route('admin.package.detail.edit', $package->id) }}"
                           class="text-xs bg-rose-500 hover:bg-rose-600 text-white px-3 py-1.5 rounded-lg font-semibold transition">
                            ✏️ Edit Reviews
                        </a>
                    </div>

                    @if($reviewsData->isEmpty())
                        <div class="text-center py-12 border-2 border-dashed border-slate-200 rounded-xl text-slate-400 text-sm">
                            <div class="text-4xl mb-2">💬</div>
                            No reviews added yet.
                            <a href="{{ route('admin.package.detail.edit', $detail->id) }}" class="text-rose-500 hover:underline ml-1">Add now →</a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($reviewsData as $rv)
                                <div class="border border-slate-200 rounded-2xl p-5 bg-slate-50">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-11 h-11 bg-rose-100 text-rose-600 rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0">
                                                {{ strtoupper(substr($rv->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-slate-700">{{ $rv->name }}</p>
                                                <p class="text-xs text-slate-400">
                                                    {{ $rv->location ? $rv->location : '' }}{{ $rv->location && $rv->review_date ? ' • ' : '' }}{{ $rv->review_date ?? '' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="text-amber-400 text-sm flex-shrink-0">
                                            {{ str_repeat('★', (int) $rv->rating) }}{{ str_repeat('☆', 5 - (int) $rv->rating) }}
                                        </div>
                                    </div>
                                    <p class="text-sm text-slate-600 leading-relaxed">{{ $rv->review }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- ═══ DELETE ═══ --}}
                <div class="flex justify-end pb-4">
                    <form action="{{ route('admin.package.detail.delete', $detail->id) }}" method="POST"
                          onsubmit="return confirm('Permanently delete this detail?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition flex items-center gap-2">
                            🗑 Delete Detail
                        </button>
                    </form>
                </div>

            </div>
        @endif

    </div>
@endsection