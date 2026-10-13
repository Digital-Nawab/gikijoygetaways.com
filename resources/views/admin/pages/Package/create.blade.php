@extends('admin.layout.master')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    .pkg-wrap * {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .field-label {
        display: block;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        color: #64748b;
        margin-bottom: 0.4rem;
    }

    .field-input {
        width: 100%;
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.72rem 1rem;
        font-size: 0.875rem;
        color: #1e293b;
        font-weight: 500;
        transition: all 0.2s;
        outline: none;
        appearance: none;
        -webkit-appearance: none;
    }

    .field-input:focus {
        background: #fff;
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .field-input::placeholder {
        color: #94a3b8;
        font-weight: 400;
    }

    .field-input:disabled {
        background: #f1f5f9;
        color: #94a3b8;
        cursor: not-allowed;
        border-color: #e2e8f0;
    }

    select.field-input {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' stroke='%2394a3b8' stroke-width='2' viewBox='0 0 24 24'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.9rem center;
        background-size: 1rem;
        padding-right: 2.5rem;
    }

    .select-wrapper {
        position: relative;
    }

    .select-spinner {
        display: none;
        position: absolute;
        right: 2.5rem;
        top: 50%;
        transform: translateY(-50%);
        width: 14px;
        height: 14px;
        border: 2px solid #e2e8f0;
        border-top-color: #6366f1;
        border-radius: 50%;
        animation: spin 0.6s linear infinite;
    }

    .select-spinner.active {
        display: block;
    }

    @keyframes spin {
        to {
            transform: translateY(-50%) rotate(360deg);
        }
    }

    .cascade-hint {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.68rem;
        font-weight: 600;
        color: #94a3b8;
        margin-top: 0.35rem;
        transition: color 0.2s;
    }

    .cascade-hint.ready {
        color: #10b981;
    }

    .cascade-hint.loading {
        color: #6366f1;
    }

    .slug-wrapper {
        position: relative;
    }

    .slug-prefix {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 0.8rem;
        font-weight: 600;
        pointer-events: none;
        white-space: nowrap;
    }

    .slug-input {
        padding-left: 5.5rem !important;
        font-family: 'Courier New', monospace !important;
        font-size: 0.82rem !important;
        color: #6366f1 !important;
        background: #eef2ff !important;
        border-color: #c7d2fe !important;
    }

    .slug-input:focus {
        border-color: #6366f1 !important;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.12) !important;
    }

    .slug-hint {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        margin-top: 0.4rem;
        font-size: 0.7rem;
        color: #94a3b8;
        font-weight: 500;
    }

    .slug-hint span {
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 0.1rem 0.5rem;
        font-family: 'Courier New', monospace;
        color: #6366f1;
        font-size: 0.68rem;
    }

    .save-btn {
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 0.85rem 2.2rem;
        font-size: 0.9rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 4px 14px rgba(99, 102, 241, 0.35);
        letter-spacing: 0.02em;
    }

    .save-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(99, 102, 241, 0.45);
    }

    .section-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        border-radius: 8px;
        padding: 0.3rem 0.75rem;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        margin-bottom: 1.25rem;
    }

    .price-prefix {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-weight: 700;
        font-size: 0.85rem;
        pointer-events: none;
    }

    .price-input {
        padding-left: 2rem !important;
    }

    .file-drop {
        border: 2px dashed #c7d2fe;
        border-radius: 14px;
        background: #eef2ff;
        transition: all 0.25s;
        cursor: pointer;
    }

    .file-drop:hover {
        border-color: #6366f1;
        background: #e0e7ff;
    }

    .preview-img {
        width: 100%;
        height: 160px;
        object-fit: cover;
        border-radius: 12px;
        display: none;
    }

    .location-chain {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.6rem 1rem;
        margin-bottom: 1rem;
        font-size: 0.75rem;
        font-weight: 600;
        color: #94a3b8;
        flex-wrap: wrap;
    }

    .location-chain .chain-item {
        color: #1e293b;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 0.15rem 0.6rem;
        transition: all 0.2s;
    }

    .location-chain .chain-item.empty {
        color: #cbd5e1;
        background: transparent;
        border-color: #f1f5f9;
        font-style: italic;
    }

    .location-chain .chain-arrow {
        color: #cbd5e1;
        font-size: 0.7rem;
    }

    /* ── Counter ── */
    .counter-wrap {
        display: flex;
        align-items: center;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        background: #f8fafc;
    }

    .counter-btn {
        width: 36px;
        height: 42px;
        background: #f1f5f9;
        border: none;
        font-size: 1.1rem;
        font-weight: 700;
        color: #64748b;
        cursor: pointer;
        transition: background 0.15s, color 0.15s;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .counter-btn:hover {
        background: #e0e7ff;
        color: #6366f1;
    }

    .counter-input {
        border: none !important;
        border-radius: 0 !important;
        background: transparent !important;
        box-shadow: none !important;
        text-align: center !important;
        flex: 1;
        padding-left: 0 !important;
        padding-right: 0 !important;
        min-width: 0;
    }

    .counter-input::-webkit-inner-spin-button,
    .counter-input::-webkit-outer-spin-button {
        -webkit-appearance: none;
    }

    /* ── Toggle ── */
    .toggle-track {
        width: 44px;
        height: 24px;
        background: #e2e8f0;
        border-radius: 999px;
        position: relative;
        transition: background 0.2s;
        flex-shrink: 0;
        cursor: pointer;
    }

    .toggle-track.on {
        background: #6366f1;
    }

    .toggle-thumb {
        position: absolute;
        top: 3px;
        left: 3px;
        width: 18px;
        height: 18px;
        background: white;
        border-radius: 50%;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.18);
        transition: transform 0.2s;
    }

    .toggle-track.on .toggle-thumb {
        transform: translateX(20px);
    }

    /* ── Description Rich Editor ── */
    .editor-toolbar {
        display: flex;
        align-items: center;
        gap: 2px;
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-bottom: none;
        border-radius: 12px 12px 0 0;
        padding: 0.4rem 0.6rem;
        flex-wrap: wrap;
    }

    .editor-toolbar button {
        width: 28px;
        height: 28px;
        border: none;
        background: transparent;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        font-size: 0.78rem;
        font-weight: 700;
        transition: background 0.15s, color 0.15s;
    }

    .editor-toolbar button:hover {
        background: #e0e7ff;
        color: #6366f1;
    }

    .editor-toolbar .sep {
        width: 1px;
        height: 18px;
        background: #e2e8f0;
        margin: 0 3px;
    }

    .editor-area {
        min-height: 200px;
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-top: none;
        border-radius: 0 0 12px 12px;
        padding: 0.9rem 1rem;
        font-size: 0.875rem;
        color: #1e293b;
        font-weight: 500;
        outline: none;
        line-height: 1.75;
        transition: background 0.2s, border-color 0.2s, box-shadow 0.2s;
    }

    .editor-area:focus {
        background: #fff;
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.08);
    }

    .editor-area:empty:before {
        content: attr(data-placeholder);
        color: #94a3b8;
        font-weight: 400;
        pointer-events: none;
    }

    .editor-area ul {
        list-style: disc;
        padding-left: 1.4rem;
    }

    .editor-area ol {
        list-style: decimal;
        padding-left: 1.4rem;
    }
</style>

<div class="pkg-wrap">

    {{-- Header --}}
    <div class="flex justify-between items-start mb-8">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <div class="w-2 h-6 rounded-full bg-indigo-500"></div>
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Add New Hotel</h2>
            </div>
            <p class="text-slate-400 text-sm ml-4">Create a new travel hotel for your customers</p>
        </div>
        <a href="{{ route('admin.package.index') }}"
            class="flex items-center gap-2 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 px-4 py-2.5 rounded-xl text-sm font-semibold transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <polyline points="15 18 9 12 15 6" />
            </svg>
            Back to Hotels
        </a>
    </div>

    @if ($errors->any())
    <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-5">
        <div class="flex items-center gap-2 mb-1.5">
            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <line x1="12" y1="8" x2="12" y2="12" />
                <line x1="12" y1="16" x2="12.01" y2="16" />
            </svg>
            <p class="text-red-600 text-sm font-semibold">Please fix the following errors:</p>
        </div>
        <ul class="text-red-500 text-xs space-y-0.5 ml-6 list-disc">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.package.store') }}" method="POST" enctype="multipart/form-data" id="packageForm">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ════════════════════════════════════════
                     LEFT COLUMN
                ════════════════════════════════════════ --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- ① Basic Info --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
                    <div class="section-chip" style="background:#eef2ff;color:#6366f1;">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <rect x="2" y="7" width="20" height="14" rx="2" />
                            <path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2" />
                        </svg>
                        Basic Info
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- Name --}}
                        <div class="md:col-span-2">
                            <label class="field-label">Hotel Name <span class="text-red-400">*</span></label>
                            <input type="text" name="name" id="packageName"
                                value="{{ old('name') }}"
                                class="field-input" placeholder="e.g. The Grand Himalaya Resort" required>
                        </div>

                        {{-- Slug --}}
                        <div class="md:col-span-2">
                            <label class="field-label">
                                URL Slug
                                <span class="normal-case font-normal text-slate-400 ml-1">(auto-generated from name)</span>
                            </label>
                            <div class="slug-wrapper">
                                <span class="slug-prefix">/hotels/</span>
                                <input type="text" name="slug" id="packageSlug"
                                    value="{{ old('slug') }}"
                                    class="field-input slug-input"
                                    placeholder="the-grand-himalaya-resort">
                            </div>
                            <div class="slug-hint">
                                <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="12" y1="8" x2="12" y2="12" />
                                    <line x1="12" y1="16" x2="12.01" y2="16" />
                                </svg>
                                Auto-generated from name. Example: "Manali Tour" →
                                <span>manali-tour</span>
                                — Edit manually if needed.
                            </div>
                        </div>

                        {{-- Location --}}
                        <div class="md:col-span-2">
                            <label class="field-label">Location / Landmark</label>
                            <input type="text" name="location" value="{{ old('location') }}"
                                class="field-input" placeholder="e.g. Rohtang Pass, Solang Valley">
                        </div>

                        {{-- Short Description --}}
                        <div class="md:col-span-2">
                            <label class="field-label">
                                Short Description
                                <span class="normal-case font-normal text-slate-400 ml-1">(shown on listing cards)</span>
                            </label>
                            <textarea name="short_description" rows="2"
                                class="field-input resize-none"
                                placeholder="One-liner shown on listing cards...">{{ old('short_description') }}</textarea>
                        </div>

                        {{-- ✅ Full Description --}}
                        <div class="md:col-span-2">
                            <label class="field-label">
                                Full Description
                                <span class="normal-case font-normal text-slate-400 ml-1">(shown on detail page)</span>
                            </label>

                            {{-- Toolbar --}}
                            <textarea name="description" id="description"
                                class="field-input" rows="10">{!! old('description') !!}</textarea>
                        </div>

                    </div>
                </div>

                {{-- ② Location Cascade --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
                    <div class="section-chip" style="background:#f0fdf4;color:#16a34a;">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        Location
                    </div>

                    <div class="location-chain" id="locationChain">
                        <svg class="w-3 h-3 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        <span class="chain-item empty" id="chainCountry">Country</span>
                        <span class="chain-arrow">›</span>
                        <span class="chain-item empty" id="chainState">State</span>
                        <span class="chain-arrow">›</span>
                        <span class="chain-item empty" id="chainCity">City</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        <div>
                            <label class="field-label">Country <span class="text-red-400">*</span></label>
                            <div class="select-wrapper">
                                <select name="country_id" id="countrySelect" class="field-input" required>
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id }}"
                                        data-name="{{ $country->name }}"
                                        {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="field-label">State <span class="text-red-400">*</span></label>
                            <div class="select-wrapper">
                                <select name="state_id" id="stateSelect" class="field-input" required disabled>
                                    <option value="">— Select Country First —</option>
                                </select>
                                <div class="select-spinner" id="stateSpinner"></div>
                            </div>
                            <div class="cascade-hint" id="stateHint">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <polyline points="9 18 15 12 9 6" />
                                </svg>
                                Select a country to load states
                            </div>
                        </div>

                        <div>
                            <label class="field-label">City <span class="text-red-400">*</span></label>
                            <div class="select-wrapper">
                                <select name="city_id" id="citySelect" class="field-input" required disabled>
                                    <option value="">— Select State First —</option>
                                </select>
                                <div class="select-spinner" id="citySpinner"></div>
                            </div>
                            <div class="cascade-hint" id="cityHint">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <polyline points="9 18 15 12 9 6" />
                                </svg>
                                Select a state to load cities
                            </div>
                        </div>

                    </div>
                </div>

                {{-- ③ Property Details --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
                    <div class="section-chip" style="background:#f0f9ff;color:#0284c7;">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                        Property Details
                    </div>

                    {{-- Counters --}}
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-5">

                        <div>
                            <label class="field-label">
                                <svg class="w-3 h-3 inline-block mr-1 -mt-0.5 text-sky-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M23 21v-2a4 4 0 00-3-3.87" />
                                    <path d="M16 3.13a4 4 0 010 7.75" />
                                </svg>
                                Guests
                            </label>
                            <div class="counter-wrap">
                                <button type="button" class="counter-btn" onclick="changeCounter('guests',-1)">−</button>
                                <input type="number" name="guests" id="guests"
                                    value="{{ old('guests', 1) }}" min="1" max="255"
                                    class="field-input counter-input">
                                <button type="button" class="counter-btn" onclick="changeCounter('guests',1)">+</button>
                            </div>
                        </div>

                        <div>
                            <label class="field-label">
                                <svg class="w-3 h-3 inline-block mr-1 -mt-0.5 text-sky-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                    <polyline points="9 22 9 12 15 12 15 22" />
                                </svg>
                                Bedrooms
                            </label>
                            <div class="counter-wrap">
                                <button type="button" class="counter-btn" onclick="changeCounter('bedrooms',-1)">−</button>
                                <input type="number" name="bedrooms" id="bedrooms"
                                    value="{{ old('bedrooms', 1) }}" min="1" max="255"
                                    class="field-input counter-input">
                                <button type="button" class="counter-btn" onclick="changeCounter('bedrooms',1)">+</button>
                            </div>
                        </div>

                        <div>
                            <label class="field-label">
                                <svg class="w-3 h-3 inline-block mr-1 -mt-0.5 text-sky-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M2 9h20M2 9v9a2 2 0 002 2h16a2 2 0 002-2V9M2 9l2-5h16l2 5" />
                                </svg>
                                Beds
                            </label>
                            <div class="counter-wrap">
                                <button type="button" class="counter-btn" onclick="changeCounter('beds',-1)">−</button>
                                <input type="number" name="beds" id="beds"
                                    value="{{ old('beds', 1) }}" min="1" max="255"
                                    class="field-input counter-input">
                                <button type="button" class="counter-btn" onclick="changeCounter('beds',1)">+</button>
                            </div>
                        </div>

                        <div>
                            <label class="field-label">
                                <svg class="w-3 h-3 inline-block mr-1 -mt-0.5 text-sky-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M4 12h16M4 12a8 8 0 0116 0M4 12v6a1 1 0 001 1h14a1 1 0 001-1v-6" />
                                </svg>
                                Bathrooms
                            </label>
                            <div class="counter-wrap">
                                <button type="button" class="counter-btn" onclick="changeCounter('bathrooms',-1)">−</button>
                                <input type="number" name="bathrooms" id="bathrooms"
                                    value="{{ old('bathrooms', 1) }}" min="1" max="255"
                                    class="field-input counter-input">
                                <button type="button" class="counter-btn" onclick="changeCounter('bathrooms',1)">+</button>
                            </div>
                        </div>

                    </div>

                    {{-- Rating + Reviews --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">

                        <div>
                            <label class="field-label">
                                <svg class="w-3 h-3 inline-block mr-1 -mt-0.5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.838-.197-1.539-1.118l1.286-3.957a1 1 0 00-.364-1.118L2.063 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                </svg>
                                Rating
                                <span class="normal-case font-normal text-slate-400 ml-1">(0.00 – 5.00)</span>
                            </label>
                            <div class="relative">
                                <span class="price-prefix" style="color:#f59e0b;font-size:1rem;">★</span>
                                <input type="number" name="rating"
                                    value="{{ old('rating', '0.00') }}"
                                    class="field-input price-input"
                                    step="0.01" min="0" max="5" placeholder="4.85">
                            </div>
                        </div>

                        <div>
                            <label class="field-label">
                                <svg class="w-3 h-3 inline-block mr-1 -mt-0.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
                                </svg>
                                Reviews Count
                            </label>
                            <input type="number" name="reviews_count"
                                value="{{ old('reviews_count', 0) }}"
                                class="field-input" min="0" placeholder="e.g. 128">
                        </div>

                    </div>

                    {{-- Guest Favourite Toggle --}}
                    <div class="flex items-center justify-between bg-slate-50 border border-slate-100 rounded-xl px-4 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:#fef3c7;">
                                <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.838-.197-1.539-1.118l1.286-3.957a1 1 0 00-.364-1.118L2.063 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-700">Guest Favourite</p>
                                <p class="text-xs text-slate-400 mt-0.5">Show "Guest Favourite" badge on this package card</p>
                            </div>
                        </div>
                        {{-- Hidden ensures 0 posted when unchecked --}}
                        <input type="hidden" name="is_guest_favourite" value="0">
                        <label class="flex items-center cursor-pointer">
                            <div class="toggle-track {{ old('is_guest_favourite') ? 'on' : '' }}"
                                id="toggleTrack" onclick="toggleFavourite()">
                                <div class="toggle-thumb"></div>
                            </div>
                            <input type="checkbox" name="is_guest_favourite" id="guestFavouriteCheck"
                                value="1" class="sr-only"
                                {{ old('is_guest_favourite') ? 'checked' : '' }}>
                        </label>
                    </div>

                </div>

                {{-- ④ Pricing --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
                    <div class="section-chip" style="background:#fffbeb;color:#d97706;">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <line x1="12" y1="1" x2="12" y2="23" />
                            <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" />
                        </svg>
                        Pricing
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="field-label">Total Price <span class="text-red-400">*</span></label>
                            <div class="relative">
                                <span class="price-prefix">₹</span>
                                <input type="number" name="total_price" value="{{ old('total_price') }}"
                                    class="field-input price-input" step="0.01" placeholder="0.00" required>
                            </div>
                        </div>

                        <div>
                            <label class="field-label">Advance Payment</label>
                            <div class="relative">
                                <span class="price-prefix">₹</span>
                                <input type="number" name="advance_price" value="{{ old('advance_price') }}"
                                    class="field-input price-input" step="0.01" placeholder="0.00">
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            {{-- ════════════════════════════════════════
                     RIGHT COLUMN
                ════════════════════════════════════════ --}}
            <div class="space-y-5">

                {{-- Image Upload --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
                    <div class="section-chip" style="background:#fdf4ff;color:#9333ea;">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <rect x="3" y="3" width="18" height="18" rx="2" />
                            <circle cx="8.5" cy="8.5" r="1.5" />
                            <polyline points="21 15 16 10 5 21" />
                        </svg>
                        Package Image
                    </div>
                    <label class="field-label">Upload Image <span class="text-red-400">*</span></label>
                    <div class="file-drop rounded-xl p-5 text-center" id="dropZone"
                        onclick="document.getElementById('imageInput').click()">
                        <img id="previewImg" src="" class="preview-img mb-2" alt="Preview">
                        <div id="dropPlaceholder">
                            <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                                    <polyline points="17 8 12 3 7 8" />
                                    <line x1="12" y1="3" x2="12" y2="15" />
                                </svg>
                            </div>
                            <p class="text-slate-600 text-sm font-semibold">Click to upload image</p>
                            <p class="text-slate-400 text-xs mt-1">JPG, PNG, WEBP · Max 2MB</p>
                        </div>
                        <input type="file" id="imageInput" name="image" accept="image/*" class="hidden" required>
                    </div>
                </div>

                {{-- Badge Tag --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
                    <div class="section-chip" style="background:#fff1f2;color:#e11d48;">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M20.59 13.41l-7.17 7.17a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z" />
                            <line x1="7" y1="7" x2="7.01" y2="7" />
                        </svg>
                        Badge Tag
                    </div>
                    <label class="field-label">Tag Label</label>
                    <input type="text" name="tag" value="{{ old('tag') }}"
                        class="field-input" placeholder="e.g. Hot Deal, New, Popular">
                    <p class="text-slate-400 text-xs mt-2">Shown as a badge on the package card</p>
                </div>

                {{-- Property Summary (live) --}}
                <div class="bg-gradient-to-br from-indigo-50 to-sky-50 rounded-2xl border border-indigo-100 p-4">
                    <p class="text-xs font-bold text-indigo-400 uppercase tracking-widest mb-3">Property Summary</p>
                    <div class="grid grid-cols-2 gap-2 text-xs font-semibold text-slate-600">
                        <div class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-sky-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                            </svg>
                            <span id="summaryGuests">1 Guest</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-sky-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            </svg>
                            <span id="summaryBedrooms">1 Bedroom</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-sky-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M2 9h20M2 9v9a2 2 0 002 2h16a2 2 0 002-2V9" />
                            </svg>
                            <span id="summaryBeds">1 Bed</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-sky-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M4 12h16M4 12a8 8 0 0116 0" />
                            </svg>
                            <span id="summaryBathrooms">1 Bathroom</span>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="save-btn w-full flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v14a2 2 0 01-2 2z" />
                        <polyline points="17 21 17 13 7 13 7 21" />
                        <polyline points="7 3 7 8 15 8" />
                    </svg>
                    Save Package
                </button>

            </div>

        </div>
    </form>

</div>

@endsection

@section('scripts')
<script>
    (function() {
        'use strict';

        // ══════════════════════════════════════════════
        // 1. Location Cascade  Country → State → City
        // ══════════════════════════════════════════════

        var countrySelect = document.getElementById('countrySelect');
        var stateSelect = document.getElementById('stateSelect');
        var citySelect = document.getElementById('citySelect');
        var stateSpinner = document.getElementById('stateSpinner');
        var citySpinner = document.getElementById('citySpinner');
        var stateHint = document.getElementById('stateHint');
        var cityHint = document.getElementById('cityHint');
        var chainCountry = document.getElementById('chainCountry');
        var chainState = document.getElementById('chainState');
        var chainCity = document.getElementById('chainCity');

        var oldStateId = "{{ old('state_id') }}";
        var oldCityId = "{{ old('city_id') }}";

        var GET_STATES_URL = "{{ route('admin.package.getStates', ['countryId' => '__ID__']) }}";
        var GET_CITIES_URL = "{{ route('admin.package.getCities', ['stateId'  => '__ID__']) }}";

        function statesUrl(id) {
            return GET_STATES_URL.replace('__ID__', id);
        }

        function citiesUrl(id) {
            return GET_CITIES_URL.replace('__ID__', id);
        }

        function setHint(el, text, type) {
            el.className = 'cascade-hint' + (type ? ' ' + type : '');
            var icon = type === 'ready' ?
                '<polyline points="20 6 9 17 4 12"/>' :
                type === 'loading' ?
                '<line x1="12" y1="2" x2="12" y2="6"/><line x1="12" y1="18" x2="12" y2="22"/><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"/><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"/>' :
                '<polyline points="9 18 15 12 9 6"/>';
            el.innerHTML = '<svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">' + icon + '</svg>' + text;
        }

        function updateChain(country, state, city) {
            chainCountry.textContent = country || 'Country';
            chainCountry.className = 'chain-item' + (country ? '' : ' empty');
            chainState.textContent = state || 'State';
            chainState.className = 'chain-item' + (state ? '' : ' empty');
            chainCity.textContent = city || 'City';
            chainCity.className = 'chain-item' + (city ? '' : ' empty');
        }

        function resetSelect(sel, placeholder) {
            sel.innerHTML = '<option value="">' + placeholder + '</option>';
            sel.disabled = true;
        }

        countrySelect.addEventListener('change', function() {
            var countryId = this.value;
            var countryName = this.options[this.selectedIndex].dataset.name || '';

            resetSelect(stateSelect, '— Loading… —');
            resetSelect(citySelect, '— Select State First —');
            setHint(stateHint, 'Loading states…', 'loading');
            setHint(cityHint, 'Select a state to load cities', '');
            updateChain(countryName, '', '');

            if (!countryId) {
                resetSelect(stateSelect, '— Select Country First —');
                setHint(stateHint, 'Select a country to load states', '');
                return;
            }

            stateSpinner.classList.add('active');

            fetch(statesUrl(countryId), {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(function(r) {
                    if (!r.ok) throw new Error(r.status);
                    return r.json();
                })
                .then(function(states) {
                    stateSpinner.classList.remove('active');
                    stateSelect.innerHTML = '<option value="">Select State</option>';
                    if (!states.length) {
                        setHint(stateHint, 'No states found', '');
                        return;
                    }
                    states.forEach(function(s) {
                        var o = document.createElement('option');
                        o.value = s.id;
                        o.textContent = s.state_name;
                        o.dataset.name = s.state_name;
                        if (oldStateId && String(s.id) === String(oldStateId)) o.selected = true;
                        stateSelect.appendChild(o);
                    });
                    stateSelect.disabled = false;
                    setHint(stateHint, states.length + ' states loaded', 'ready');
                    if (oldStateId && stateSelect.value) stateSelect.dispatchEvent(new Event('change'));
                })
                .catch(function(e) {
                    stateSpinner.classList.remove('active');
                    resetSelect(stateSelect, '— Error —');
                    setHint(stateHint, 'Failed to load states', '');
                    console.error(e);
                });
        });

        stateSelect.addEventListener('change', function() {
            var stateId = this.value;
            var stateName = this.options[this.selectedIndex].dataset.name || '';
            var countryName = countrySelect.options[countrySelect.selectedIndex].dataset.name || '';

            resetSelect(citySelect, '— Loading… —');
            setHint(cityHint, 'Loading cities…', 'loading');
            updateChain(countryName, stateName, '');

            if (!stateId) {
                resetSelect(citySelect, '— Select State First —');
                setHint(cityHint, 'Select a state to load cities', '');
                return;
            }

            citySpinner.classList.add('active');

            fetch(citiesUrl(stateId), {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(function(r) {
                    if (!r.ok) throw new Error(r.status);
                    return r.json();
                })
                .then(function(cities) {
                    citySpinner.classList.remove('active');
                    citySelect.innerHTML = '<option value="">Select City</option>';
                    if (!cities.length) {
                        setHint(cityHint, 'No cities found', '');
                        return;
                    }
                    cities.forEach(function(c) {
                        var o = document.createElement('option');
                        o.value = c.id;
                        o.textContent = c.name;
                        o.dataset.name = c.name;
                        if (oldCityId && String(c.id) === String(oldCityId)) o.selected = true;
                        citySelect.appendChild(o);
                    });
                    citySelect.disabled = false;
                    setHint(cityHint, cities.length + ' cities loaded', 'ready');
                    if (citySelect.value) {
                        updateChain(countryName, stateName, citySelect.options[citySelect.selectedIndex].dataset.name || '');
                        oldCityId = null;
                    }
                })
                .catch(function(e) {
                    citySpinner.classList.remove('active');
                    resetSelect(citySelect, '— Error —');
                    setHint(cityHint, 'Failed to load cities', '');
                    console.error(e);
                });
        });

        citySelect.addEventListener('change', function() {
            var cityName = this.options[this.selectedIndex].dataset.name || '';
            var stateName = stateSelect.options[stateSelect.selectedIndex].dataset.name || '';
            var countryName = countrySelect.options[countrySelect.selectedIndex].dataset.name || '';
            updateChain(countryName, stateName, cityName);
        });

        if (countrySelect.value) countrySelect.dispatchEvent(new Event('change'));

        // ══════════════════════════════════════════════
        // 2. Image Preview
        // ══════════════════════════════════════════════

        var imageInput = document.getElementById('imageInput');
        var previewImg = document.getElementById('previewImg');
        var dropPlaceholder = document.getElementById('dropPlaceholder');

        if (imageInput) {
            imageInput.addEventListener('change', function() {
                var file = this.files[0];
                if (!file) return;
                var reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewImg.style.display = 'block';
                    dropPlaceholder.style.display = 'none';
                };
                reader.readAsDataURL(file);
            });
        }

        // ══════════════════════════════════════════════
        // 3. Slug Auto-Generator
        // ══════════════════════════════════════════════

        var nameInput = document.getElementById('packageName');
        var slugInput = document.getElementById('packageSlug');
        var slugManuallyEdited = !!(slugInput && slugInput.value.trim());

        function generateSlug(text) {
            return text.toLowerCase().trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_]+/g, '-')
                .replace(/--+/g, '-')
                .replace(/^-+|-+$/g, '');
        }

        if (slugInput) {
            slugInput.addEventListener('input', function() {
                slugManuallyEdited = this.value.trim() !== '';
            });
            slugInput.addEventListener('blur', function() {
                if (this.value.trim()) this.value = generateSlug(this.value);
            });
            slugInput.addEventListener('keyup', function() {
                if (this.value.trim() === '') {
                    slugManuallyEdited = false;
                    this.value = generateSlug(nameInput.value);
                }
            });
        }

        if (nameInput) {
            nameInput.addEventListener('input', function() {
                if (!slugManuallyEdited && slugInput) slugInput.value = generateSlug(this.value);
            });
        }

        // ══════════════════════════════════════════════
        // 4. Counter Buttons  (+/−)
        // ══════════════════════════════════════════════

        window.changeCounter = function(fieldId, delta) {
            var input = document.getElementById(fieldId);
            if (!input) return;
            var val = parseInt(input.value, 10) || 1;
            var min = parseInt(input.min, 10) || 1;
            var max = parseInt(input.max, 10) || 255;
            input.value = Math.min(max, Math.max(min, val + delta));
            updateSummary();
        };

        function updateSummary() {
            var map = {
                guests: 'Guest',
                bedrooms: 'Bedroom',
                beds: 'Bed',
                bathrooms: 'Bathroom'
            };
            Object.keys(map).forEach(function(id) {
                var inp = document.getElementById(id);
                var span = document.getElementById('summary' + id.charAt(0).toUpperCase() + id.slice(1));
                if (!inp || !span) return;
                var v = parseInt(inp.value, 10) || 1;
                span.textContent = v + ' ' + map[id] + (v !== 1 ? 's' : '');
            });
        }

        ['guests', 'bedrooms', 'beds', 'bathrooms'].forEach(function(id) {
            var el = document.getElementById(id);
            if (el) el.addEventListener('input', updateSummary);
        });

        updateSummary();

        // ══════════════════════════════════════════════
        // 5. Guest Favourite Toggle
        // ══════════════════════════════════════════════

        window.toggleFavourite = function() {
            var track = document.getElementById('toggleTrack');
            var chk = document.getElementById('guestFavouriteCheck');
            if (!track || !chk) return;
            chk.checked = !chk.checked;
            track.classList.toggle('on', chk.checked);
        };

        // ══════════════════════════════════════════════
        // 6. Full Description Editor (contenteditable)
        // ══════════════════════════════════════════════


    })();
</script>

{{-- CKEditor 4 --}}
<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description', {
        toolbar: [{
                name: 'styles',
                items: ['Format', 'Font', 'FontSize']
            },
            {
                name: 'basicstyles',
                items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat']
            },
            {
                name: 'colors',
                items: ['TextColor', 'BGColor']
            },
            {
                name: 'paragraph',
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
            },
            {
                name: 'align',
                items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
            },
            {
                name: 'links',
                items: ['Link', 'Unlink']
            },
            {
                name: 'insert',
                items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar']
            },
            {
                name: 'tools',
                items: ['Maximize', 'Source']
            },
        ],
        height: 300,
    });
</script>
@endsection