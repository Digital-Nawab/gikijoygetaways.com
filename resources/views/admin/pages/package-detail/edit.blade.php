@extends('admin.layout.master')

@section('content')
<div class="w-full px-6 pb-10">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">✏️ Edit Hotel Detail</h2>
            <p class="text-slate-500 text-sm mt-1">
                Hotel: <span class="font-semibold text-blue-600">{{ $package->name }}</span>
            </p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.package.detail.show', $package->id) }}"
                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2.5 rounded-xl text-sm font-semibold transition">👁 View</a>
            <a href="{{ route('admin.package.index') }}"
                class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2.5 rounded-xl text-sm font-semibold transition">← Back</a>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-5 text-sm font-medium">✅ {{ session('success') }}</div>
    @endif
    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl mb-5 text-sm">
        @foreach($errors->all() as $error)<div>• {{ $error }}</div>@endforeach
    </div>
    @endif

    <form action="{{ route('admin.package.detail.update', $detail->id) }}" method="POST"
        enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')
        <input type="hidden" name="package_id" value="{{ $package->id }}">

        {{-- ═══ HERO SECTION ═══ --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-6">
            <h3 class="font-bold text-slate-700 mb-5 flex items-center gap-2">
                <span class="w-7 h-7 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center">🏔️</span>
                Hero Section
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5 block">Hero Badge</label>
                    <input type="text" name="hero_badge" value="{{ old('hero_badge', $detail->hero_badge) }}"
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="e.g. Editor's Pick">
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5 block">Offer Badge Text</label>
                    <input type="text" name="offer_badge_text" value="{{ old('offer_badge_text', $detail->offer_badge_text) }}"
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="e.g. 🔥 Save ₹3,000 — Limited Offer">
                </div>
            </div>
        </div>

        {{-- ═══ BANNER IMAGE ═══ --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-6">
            <h3 class="font-bold text-slate-700 mb-5 flex items-center gap-2">
                <span class="w-7 h-7 bg-pink-100 text-pink-600 rounded-lg flex items-center justify-center">🖼️</span>
                Banner / Hero Image
            </h3>
            <div id="dropZone" onclick="document.getElementById('bannerInput').click()"
                class="relative border-2 border-dashed border-slate-300 rounded-2xl p-8 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition group">
                <div id="bannerPreviewWrap" class="{{ $existingBannerUrl ? '' : 'hidden' }} mb-4">
                    <img id="bannerPreviewImg" class="mx-auto max-h-48 rounded-xl object-cover shadow" src="{{ $existingBannerUrl ?? '' }}" alt="Banner Preview">
                </div>
                <div id="bannerPlaceholder" class="{{ $existingBannerUrl ? 'hidden' : '' }}">
                    <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-100 transition">
                        <svg class="w-7 h-7 text-slate-400 group-hover:text-blue-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-slate-600">Click to upload banner image</p>
                    <p class="text-xs text-slate-400 mt-1">PNG, JPG, WEBP up to 5MB</p>
                </div>
                @if($existingBannerUrl)<p class="text-xs text-slate-400 mt-2">Click to change image</p>@endif
                <input type="file" id="bannerInput" name="banner_image" accept="image/*" class="hidden" onchange="previewBanner(event)">
            </div>
        </div>

        {{-- ═══ DESCRIPTION ═══ --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-6">
            <h3 class="font-bold text-slate-700 mb-5 flex items-center gap-2">
                <span class="w-7 h-7 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center">📝</span>
                Overview / Description
            </h3>
            <textarea name="description" id="description" rows="5"
                class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="Describe the package experience...">{{ old('description', $detail->description) }}</textarea>
        </div>

        {{-- ═══ HIGHLIGHTS REPEATER ═══ --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-6">
            <div class="flex justify-between items-center mb-5">
                <h3 class="font-bold text-slate-700 flex items-center gap-2">
                    <span class="w-7 h-7 bg-yellow-100 text-yellow-600 rounded-lg flex items-center justify-center">⭐</span>
                    Highlights Grid <span class="text-xs font-normal text-slate-400">(icon + title + subtitle)</span>
                </h3>
                <button type="button" onclick="addHighlight()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded-lg text-sm font-medium transition flex items-center gap-1">+ Add</button>
            </div>
            <div id="hlEmpty" class="text-center py-10 text-slate-400 text-sm border-2 border-dashed border-slate-200 rounded-xl {{ count($existingHighlights)>0?'hidden':'' }}">
                No highlights yet. Click <strong>+ Add</strong> to start.
            </div>
            <div id="hlWrapper" class="space-y-3 {{ count($existingHighlights)>0?'':'hidden' }}"></div>
            <input type="hidden" name="highlights" id="highlights_json">
        </div>

        {{-- ═══ AMENITIES (CLICK TO SELECT FROM FIXED LIST) ═══ --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-6">
            <div class="flex justify-between items-center mb-5">
                <h3 class="font-bold text-slate-700 flex items-center gap-2">
                    <span class="w-7 h-7 bg-green-100 text-green-600 rounded-lg flex items-center justify-center">🏠</span>
                    Amenities
                    <span class="text-xs font-normal text-slate-400">(click to select / deselect)</span>
                </h3>
                <span class="text-xs font-semibold text-green-600">
                    Selected: <span id="amSelectedCount">0</span>
                </span>
            </div>

            <div id="amenitiesGrid" class="grid grid-cols-2 md:grid-cols-3 gap-2.5">
                {{-- amenities populate here via JS --}}
            </div>

            <input type="hidden" name="amenities" id="amenities_json">
        </div>

        {{-- ═══ CONTACT & LOCATION ═══ --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-6">
            <h3 class="font-bold text-slate-700 mb-5 flex items-center gap-2">
                <span class="w-7 h-7 bg-orange-100 text-orange-600 rounded-lg flex items-center justify-center">📍</span>
                Contact & Location
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5 block">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-slate-400"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg></span>
                        <input type="email" name="email" value="{{ old('email', $detail->email) }}"
                            class="w-full border border-slate-200 rounded-xl pl-9 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="info@example.com">
                    </div>
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5 block">Mobile No.</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-slate-400"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg></span>
                        <input type="text" name="mobile" value="{{ old('mobile', $detail->mobile) }}"
                            class="w-full border border-slate-200 rounded-xl pl-9 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="+91 98765 43210">
                    </div>
                </div>
                <div class="md:col-span-2">
                    <label class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5 block">Address</label>
                    <div class="relative">
                        <span class="absolute top-3 left-3 text-slate-400"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg></span>
                        <textarea name="address" rows="2"
                            class="w-full border border-slate-200 rounded-xl pl-9 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="Full address of the property...">{{ old('address', $detail->address) }}</textarea>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <label class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5 block">Google Map Embed URL</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-slate-400"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z" />
                            </svg></span>
                        <input type="url" name="map_url" value="{{ old('map_url', $detail->map_url) }}" id="mapUrlInput"
                            class="w-full border border-slate-200 rounded-xl pl-9 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="https://www.google.com/maps/embed?pb=...">
                    </div>
                    <p class="text-xs text-slate-400 mt-1.5">Google Maps → Share → Embed a map → Copy the <code class="bg-slate-100 px-1 rounded">src</code> URL only</p>
                    <div id="mapPreviewWrap" class="{{ $detail->map_url ? '' : 'hidden' }} mt-3">
                        <iframe id="mapPreviewFrame" class="w-full h-48 rounded-xl border border-slate-200"
                            style="border:0" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            src="{{ $detail->map_url ?? '' }}"></iframe>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══ SUB PACKAGES ═══ --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-6">
            <div class="flex justify-between items-center mb-5">
                <h3 class="font-bold text-slate-700 flex items-center gap-2">
                    <span class="w-7 h-7 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center">📦</span>
                    Sub Packages
                    <span class="text-xs font-normal text-slate-400">(e.g. Weekend Retreat, Couples…)</span>
                </h3>
                <button type="button" onclick="addSubPackage()"
                    class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-1.5 rounded-lg text-sm font-medium transition flex items-center gap-1">
                    + Add Package
                </button>
            </div>
            <div id="spEmpty" class="text-center py-10 text-slate-400 text-sm border-2 border-dashed border-slate-200 rounded-xl {{ count($existingSubPackages)>0?'hidden':'' }}">
                No sub-packages yet. Click <strong>+ Add Package</strong> to start.
            </div>
            <div id="spWrapper" class="space-y-4 {{ count($existingSubPackages)>0?'':'hidden' }}"></div>
            <input type="hidden" name="sub_packages_json" id="sub_packages_json">
        </div>

        {{-- ═══ REVIEWS / TESTIMONIALS ═══ --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-6">
            <div class="flex justify-between items-center mb-5">
                <h3 class="font-bold text-slate-700 flex items-center gap-2">
                    <span class="w-7 h-7 bg-rose-100 text-rose-600 rounded-lg flex items-center justify-center">💬</span>
                    Reviews & Experiences
                    <span class="text-xs font-normal text-slate-400">(traveler testimonials)</span>
                </h3>
                <button type="button" onclick="addReview()"
                    class="bg-rose-500 hover:bg-rose-600 text-white px-4 py-1.5 rounded-lg text-sm font-medium transition flex items-center gap-1">
                    + Add Review
                </button>
            </div>
            <div id="rvEmpty" class="text-center py-10 text-slate-400 text-sm border-2 border-dashed border-slate-200 rounded-xl {{ count($existingReviews)>0?'hidden':'' }}">
                No reviews yet. Click <strong>+ Add Review</strong> to start.
            </div>
            <div id="rvWrapper" class="space-y-4 {{ count($existingReviews)>0?'':'hidden' }}"></div>
            <input type="hidden" name="reviews_json" id="reviews_json">
        </div>

        {{-- ═══ SUBMIT ═══ --}}
        <div class="flex gap-3">
            <button type="submit" onclick="prepareData()"
                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3.5 rounded-xl font-semibold text-sm transition shadow">
                💾 Update Package Detail
            </button>
            <a href="{{ route('admin.package.detail.show', $package->id) }}"
                class="px-6 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl font-semibold text-sm transition flex items-center">
                Cancel
            </a>
        </div>
    </form>
</div>

{{-- ═══ ICON PICKER MODAL (Highlights only) ═══ --}}
<div id="iconPickerModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[85vh] flex flex-col">
        <div class="flex items-center justify-between p-5 border-b border-slate-200">
            <h4 class="font-bold text-slate-700">🎨 Pick an Icon</h4>
            <button onclick="closeIconPicker()" class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-slate-100 text-slate-400 hover:text-slate-600 text-xl">×</button>
        </div>
        <div class="px-5 py-3 border-b border-slate-100">
            <input type="text" id="iconSearch" oninput="filterIcons(this.value)"
                class="w-full border border-slate-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="Type to search — e.g. wifi, sun, star...">
        </div>
        <div id="iconGrid" class="flex-1 overflow-y-auto p-4">
            <div class="text-center py-12 text-slate-400 text-sm">
                <div class="text-3xl mb-2">🔍</div>Type above to search icons
            </div>
        </div>
    </div>
</div>

<script>
    const existingHighlights = @json($existingHighlights ?? []);
    const existingAmenities = @json($existingAmenities ?? []);
    const existingSubPackages = @json($existingSubPackages ?? []);
    const existingReviews = @json($existingReviews ?? []);

    // ─────────────────────────────────────────────────
    // ICON PICKER (for Highlights only)
    // ─────────────────────────────────────────────────
    const ALL_ICONS = [
        'bi-activity', 'bi-airplane', 'bi-alarm', 'bi-apple', 'bi-archive', 'bi-arrow-left', 'bi-arrow-right',
        'bi-award', 'bi-award-fill', 'bi-bag', 'bi-balloon', 'bi-ban', 'bi-bar-chart', 'bi-battery', 'bi-bicycle',
        'bi-binoculars', 'bi-bookmark', 'bi-briefcase', 'bi-building', 'bi-bus-front', 'bi-camera', 'bi-camera-fill',
        'bi-car-front', 'bi-cash', 'bi-chat', 'bi-check-circle', 'bi-check-circle-fill', 'bi-clock', 'bi-cloud',
        'bi-cloud-rain', 'bi-compass', 'bi-cup', 'bi-cup-hot', 'bi-cup-hot-fill', 'bi-currency-rupee', 'bi-droplet',
        'bi-droplet-fill', 'bi-emoji-smile', 'bi-envelope', 'bi-eye', 'bi-fire', 'bi-flag', 'bi-flower1', 'bi-flower2',
        'bi-geo-alt', 'bi-geo-alt-fill', 'bi-gift', 'bi-globe', 'bi-globe2', 'bi-graph-up', 'bi-grid', 'bi-heart',
        'bi-heart-fill', 'bi-house', 'bi-house-fill', 'bi-image', 'bi-info-circle', 'bi-key', 'bi-lamp', 'bi-layers',
        'bi-leaf', 'bi-lightning', 'bi-lightning-charge-fill', 'bi-list', 'bi-location', 'bi-lock', 'bi-luggage',
        'bi-map', 'bi-map-fill', 'bi-mic', 'bi-moon', 'bi-moon-stars', 'bi-moon-stars-fill', 'bi-mountains',
        'bi-music-note', 'bi-p-circle', 'bi-palette', 'bi-patch-check', 'bi-people', 'bi-people-fill', 'bi-person',
        'bi-person-fill', 'bi-phone', 'bi-pin-map', 'bi-pin-map-fill', 'bi-play-circle', 'bi-plus-circle',
        'bi-receipt', 'bi-rocket', 'bi-search', 'bi-send', 'bi-shield', 'bi-shield-check', 'bi-shop', 'bi-signpost',
        'bi-snow', 'bi-snow2', 'bi-star', 'bi-star-fill', 'bi-sun', 'bi-sunrise', 'bi-sunset', 'bi-tag', 'bi-telephone',
        'bi-ticket', 'bi-train-front', 'bi-translate', 'bi-trash', 'bi-tree', 'bi-tree-fill', 'bi-tv', 'bi-umbrella',
        'bi-water', 'bi-wifi', 'bi-wind', 'bi-x-circle',
    ];

    let currentIconCallback = null;

    function openIconPicker(callback) {
        currentIconCallback = callback;
        document.getElementById('iconSearch').value = '';
        document.getElementById('iconGrid').innerHTML = '<div class="text-center py-12 text-slate-400 text-sm"><div class="text-3xl mb-2">🔍</div>Type above to search icons</div>';
        document.getElementById('iconPickerModal').classList.remove('hidden');
        document.getElementById('iconPickerModal').classList.add('flex');
        setTimeout(() => document.getElementById('iconSearch').focus(), 100);
    }

    function closeIconPicker() {
        document.getElementById('iconPickerModal').classList.add('hidden');
        document.getElementById('iconPickerModal').classList.remove('flex');
        currentIconCallback = null;
    }

    function selectIcon(icon) {
        if (currentIconCallback) currentIconCallback(icon);
        closeIconPicker();
    }

    function filterIcons(q) {
        const grid = document.getElementById('iconGrid');
        const trimmed = q.trim().toLowerCase();
        if (!trimmed) {
            grid.innerHTML = '<div class="text-center py-12 text-slate-400 text-sm"><div class="text-3xl mb-2">🔍</div>Type above to search icons</div>';
            return;
        }
        const filtered = ALL_ICONS.filter(i => i.includes(trimmed));
        if (!filtered.length) {
            grid.innerHTML = `<div class="text-center py-10 text-slate-400 text-sm">No icons found for "<strong>${trimmed}</strong>"</div>`;
            return;
        }
        grid.innerHTML = `<div class="grid grid-cols-6 gap-2">${filtered.map(icon=>`
        <button type="button" onclick="selectIcon('${icon}')" title="${icon}"
            class="flex flex-col items-center justify-center gap-1 p-2 rounded-xl border border-transparent hover:border-blue-300 hover:bg-blue-50 transition group">
            <i class="bi ${icon} text-xl text-slate-600 group-hover:text-blue-600"></i>
            <span class="text-[9px] text-slate-400 truncate w-full text-center">${icon.replace('bi-','')}</span>
        </button>`).join('')}</div>`;
    }
    document.getElementById('iconPickerModal').addEventListener('click', function(e) {
        if (e.target === this) closeIconPicker();
    });

    // ─────────────────────────────────────────────────
    // HIGHLIGHTS
    // ─────────────────────────────────────────────────
    function addHighlight(icon = 'bi-star', title = '', subtitle = '') {
        const wrapper = document.getElementById('hlWrapper');
        document.getElementById('hlEmpty').classList.add('hidden');
        wrapper.classList.remove('hidden');
        const rowId = 'hl_' + Date.now() + '_' + Math.random().toString(36).slice(2, 7);
        const row = document.createElement('div');
        row.className = 'hl-row border border-slate-200 rounded-xl p-4 bg-slate-50';
        row.id = rowId;
        row.innerHTML = `
        <div class="flex items-center gap-3">
            <button type="button" onclick="openIconPicker(function(ic){ setHlIcon('${rowId}',ic) })"
                class="flex-shrink-0 w-14 h-14 rounded-xl border-2 border-dashed border-slate-300 hover:border-blue-400 bg-white flex flex-col items-center justify-center gap-1 transition group cursor-pointer">
                <i id="hlIconPreview_${rowId}" class="bi ${icon} text-2xl text-blue-500"></i>
                <span class="text-[9px] text-slate-400" id="hlIconLabel_${rowId}">${icon.replace('bi-','')}</span>
            </button>
            <input type="hidden" class="hl-icon" id="hlIconVal_${rowId}" value="${icon}">
            <div class="flex-1 flex flex-col gap-2">
                <input type="text" class="hl-title w-full border border-slate-200 rounded-lg px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-300" value="${title}" placeholder="Title — e.g. Himalayan Sunrise Views">
                <input type="text" class="hl-subtitle w-full border border-slate-200 rounded-lg px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-300" value="${subtitle}" placeholder="Subtitle — e.g. From Chauli ki Jali viewpoint">
            </div>
            <button type="button" onclick="removeRow('${rowId}','hl-row','hlWrapper','hlEmpty')"
                class="flex-shrink-0 w-8 h-8 flex items-center justify-center text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg text-xl">×</button>
        </div>`;
        wrapper.appendChild(row);
    }

    function setHlIcon(rowId, icon) {
        document.getElementById('hlIconVal_' + rowId).value = icon;
        document.getElementById('hlIconPreview_' + rowId).className = 'bi ' + icon + ' text-2xl text-blue-500';
        document.getElementById('hlIconLabel_' + rowId).textContent = icon.replace('bi-', '');
    }

    // ─────────────────────────────────────────────────
    // AMENITIES — fixed list with custom inline SVG icons
    // ─────────────────────────────────────────────────
    const AMENITY_SVGS = {
        tv: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="12" rx="1.5"/><path d="M8 21h8M12 17v4"/></svg>`,
        ac: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="8" rx="1.5"/><path d="M6 9h12M6 11.5h12M7 16v1.5m4-1.5v3m4-3v1.5m4-1.5v2.5"/></svg>`,
        housekeeping: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 4l-9 9 3 3 9-9z"/><path d="M14 4l3 3"/><circle cx="19" cy="19" r="2"/><path d="M17.5 17.5l-2-2"/></svg>`,
        cctv: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l13-3 1.5 4-13 3z"/><path d="M5 13l1 4"/><path d="M16 8l3 1"/><path d="M19 9v4a2 2 0 01-2 2"/></svg>`,
        bed_linen: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="8" width="18" height="9" rx="1.5"/><path d="M3 12h18M3 14h18"/></svg>`,
        wardrobe: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="3" width="14" height="18" rx="1"/><path d="M12 3v18"/><circle cx="10" cy="12" r=".6" fill="currentColor"/><circle cx="14" cy="12" r=".6" fill="currentColor"/></svg>`,
        ceiling_fan: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1.8"/><path d="M12 10.2C12 6.5 9 5 5.5 6 5.5 9.5 8.5 11 12 10.2z"/><path d="M13.8 12C17.5 12 19 9 18 5.5 14.5 5.5 13 8.5 13.8 12z"/><path d="M12 13.8C12 17.5 15 19 18.5 18 18.5 14.5 15.5 13 12 13.8z"/><path d="M10.2 12C6.5 12 5 15 6 18.5 9.5 18.5 11 15.5 10.2 12z"/></svg>`,
        wifi: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5a10 10 0 0114 0"/><path d="M8.5 15.5a5 5 0 017 0"/><circle cx="12" cy="18.5" r=".9" fill="currentColor"/></svg>`,
        kettle: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M7 9h10l-1 10a2 2 0 01-2 2H10a2 2 0 01-2-2L7 9z"/><path d="M17 11l3-1.5V13"/><path d="M9 6c0-1 1-2 3-2s3 1 3 2H9z"/></svg>`,
        kitchen: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 11h16l-1 8a1 1 0 01-1 1H6a1 1 0 01-1-1l-1-8z"/><path d="M4 11V9a1 1 0 011-1h14a1 1 0 011 1v2"/><path d="M8 8V6m8 2V6"/></svg>`,
        cutlery: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3v8a2 2 0 002 2v8"/><path d="M8 3v6M10 3v6"/><path d="M16 3c-1.5 0-3 1.5-3 4s1.5 4 3 4v10"/></svg>`,
        utensils: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 4h6l-1 7a2 2 0 01-2 2 2 2 0 01-2-2L6 4z"/><path d="M9 13v8"/><path d="M7 21h4"/><path d="M16 4c-1.5 0-2 2-2 4s1 4 2 4v9"/></svg>`,
        hot_water: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3c0 4-5 6-5 11a5 5 0 0010 0c0-5-5-7-5-11z"/></svg>`,
        lift: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="3" width="14" height="18" rx="1"/><path d="M12 3v18"/><path d="M9 9l1.5-2L12 9M15 15l-1.5 2L12 15"/></svg>`,
        fridge: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="3" width="14" height="18" rx="1.5"/><path d="M5 10h14"/><path d="M8 6v2M8 13v3"/></svg>`,
        microwave: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="6" width="18" height="12" rx="1.5"/><rect x="5" y="8" width="10" height="8" rx="0.5"/><circle cx="18" cy="10" r=".7" fill="currentColor"/><circle cx="18" cy="13" r=".7" fill="currentColor"/><path d="M18 15.5v1"/></svg>`,
        induction: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8 7c0-2 4-2 4 0s-4 1-4 3 4 2 4 0"/><rect x="3" y="13" width="18" height="7" rx="1.5"/><circle cx="7" cy="16.5" r=".7" fill="currentColor"/><circle cx="11" cy="16.5" r=".7" fill="currentColor"/><circle cx="15" cy="16.5" r=".7" fill="currentColor"/></svg>`,
        no_smoking: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="13" width="18" height="4" rx="0.5"/><path d="M7 13v4M11 13v4"/><circle cx="12" cy="12" r="9"/><path d="M5.5 5.5l13 13"/></svg>`,
        parking: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="1.5"/><path d="M10 16V8h3a2.5 2.5 0 010 5h-3"/></svg>`,
        dining_table: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11h18"/><path d="M5 11v9M19 11v9"/><path d="M7 11V6h3v5M14 11V6h3v5"/><path d="M7 14h3M14 14h3"/></svg>`,
        shower_gel: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="8" y="9" width="8" height="12" rx="1.5"/><path d="M10 9V6h4v3"/><path d="M11 4h2"/><path d="M10 13h4M10 16h4"/></svg>`,
        shampoo: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="8" width="6" height="13" rx="1"/><path d="M10 8V5h4v3"/><path d="M11 3h2"/><path d="M10 13h4"/></svg>`,
        towels: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 4l8 4-8 4-8-4z"/><path d="M4 12l8 4 8-4"/><path d="M4 16l8 4 8-4"/></svg>`,
        outdoor_furniture: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 12h16l-1 4H5z"/><path d="M5 16v4M19 16v4"/><path d="M7 12V8a5 5 0 0110 0v4"/></svg>`,
        caretaker: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="7" r="3.5"/><path d="M5 21c0-4 3-7 7-7s7 3 7 7"/><path d="M9 4l-3-1M15 4l3-1"/></svg>`,
        patio: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11l9-7 9 7"/><path d="M5 11v9h14v-9"/><path d="M9 20v-5h6v5"/></svg>`,
        balcony: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12h18"/><path d="M3 12v8h18v-8"/><path d="M6 12v8M10 12v8M14 12v8M18 12v8"/><path d="M5 12V7h14v5"/></svg>`,
        hair_dryer: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9c0-2 2-4 5-4h7a4 4 0 010 8H8c-3 0-5-2-5-4z"/><path d="M11 13l-1 7"/><path d="M13 13l1 4"/><circle cx="8" cy="9" r="1.5"/></svg>`,
        washing_machine: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="3" width="16" height="18" rx="1.5"/><circle cx="12" cy="14" r="4.5"/><circle cx="12" cy="14" r="2"/><circle cx="8" cy="6" r=".6" fill="currentColor"/><circle cx="10.5" cy="6" r=".6" fill="currentColor"/></svg>`,
    };

    const AMENITIES_LIST = [{
            key: 'tv',
            label: 'TV'
        },
        {
            key: 'ac',
            label: 'Air Conditioning'
        },
        {
            key: 'housekeeping',
            label: 'Daily Housekeeping'
        },
        {
            key: 'cctv',
            label: 'CCTV (Exterior)'
        },
        {
            key: 'bed_linen',
            label: 'Bed Linen'
        },
        {
            key: 'wardrobe',
            label: 'Wardrobe'
        },
        {
            key: 'ceiling_fan',
            label: 'Ceiling Fan'
        },
        {
            key: 'wifi',
            label: 'Wifi'
        },
        {
            key: 'kettle',
            label: 'Electric Kettle'
        },
        {
            key: 'kitchen',
            label: 'Kitchen'
        },
        {
            key: 'cutlery',
            label: 'Cutlery'
        },
        {
            key: 'utensils',
            label: 'Basic Utensils'
        },
        {
            key: 'hot_water',
            label: 'Hot Water'
        },
        {
            key: 'lift',
            label: 'Lift'
        },
        {
            key: 'fridge',
            label: 'Fridge'
        },
        {
            key: 'microwave',
            label: 'Microwave'
        },
        {
            key: 'induction',
            label: 'Induction Stove'
        },
        {
            key: 'no_smoking',
            label: 'No Smoking Indoors'
        },
        {
            key: 'parking',
            label: 'Free Parking on Premises'
        },
        {
            key: 'dining_table',
            label: 'Dining Table'
        },
        {
            key: 'shower_gel',
            label: 'Shower Gel'
        },
        {
            key: 'shampoo',
            label: 'Shampoo'
        },
        {
            key: 'towels',
            label: 'Towels'
        },
        {
            key: 'outdoor_furniture',
            label: 'Outdoor Furniture'
        },
        {
            key: 'caretaker',
            label: 'Full Time Caretaker'
        },
        {
            key: 'patio',
            label: 'Patio'
        },
        {
            key: 'balcony',
            label: 'Balcony'
        },
        {
            key: 'hair_dryer',
            label: 'Hair Dryer'
        },
        {
            key: 'washing_machine',
            label: 'Washing Machine'
        },
    ];

    const selectedAmenities = new Set();

    // Map old bootstrap-icon names (legacy data) → new keys
    const LEGACY_ICON_MAP = {
        'bi-tv': 'tv',
        'bi-wind': 'ac',
        'bi-stars': 'housekeeping',
        'bi-camera-video': 'cctv',
        'bi-layers': 'bed_linen',
        'bi-door-closed': 'wardrobe',
        'bi-fan': 'ceiling_fan',
        'bi-wifi': 'wifi',
        'bi-cup-hot': 'kettle',
        'bi-basket': 'kitchen',
        'bi-fork-knife': 'cutlery',
        'bi-cup': 'utensils',
        'bi-droplet-half': 'hot_water',
        'bi-building-up': 'lift',
        'bi-box': 'fridge',
        'bi-microwave': 'microwave',
        'bi-fire': 'induction',
        'bi-slash-circle': 'no_smoking',
        'bi-p-square': 'parking',
        'bi-cup-straw': 'dining_table',
        'bi-droplet': 'shower_gel',
        'bi-droplet-fill': 'shampoo',
        'bi-grid-3x3': 'towels',
        'bi-tree': 'outdoor_furniture',
        'bi-person-badge': 'caretaker',
        'bi-house-door': 'patio',
        'bi-building': 'balcony',
        'bi-water': 'washing_machine',
    };

    function findAmenityIndex(item) {
        if (!item) return -1;
        let idx = AMENITIES_LIST.findIndex(a => a.key === item.icon);
        if (idx >= 0) return idx;
        const mappedKey = LEGACY_ICON_MAP[item.icon];
        if (mappedKey) {
            idx = AMENITIES_LIST.findIndex(a => a.key === mappedKey);
            if (idx >= 0) return idx;
        }
        if (item.label) {
            const lbl = String(item.label).toLowerCase().trim();
            idx = AMENITIES_LIST.findIndex(a => a.label.toLowerCase().trim() === lbl);
            if (idx >= 0) return idx;
        }
        return -1;
    }

    function renderAmenitiesGrid() {
        const grid = document.getElementById('amenitiesGrid');
        grid.innerHTML = AMENITIES_LIST.map((a, idx) => {
            const active = selectedAmenities.has(idx);
            const svg = AMENITY_SVGS[a.key] || '';
            return `
                    <button type="button"
                        data-am-idx="${idx}"
                        onclick="toggleAmenity(${idx})"
                        class="am-card flex items-center gap-3 px-3 py-2.5 rounded-xl border transition text-left
                            ${active
                                ? 'border-green-500 bg-green-50 ring-2 ring-green-200'
                                : 'border-slate-200 bg-white hover:border-green-300 hover:bg-green-50/40'}">
                        <span class="flex-shrink-0 w-10 h-10 rounded-lg flex items-center justify-center
                            ${active ? 'bg-green-500 text-white' : 'bg-slate-100 text-slate-600'}">
                            <span class="block w-6 h-6">${svg}</span>
                        </span>
                        <span class="text-sm font-medium flex-1 ${active ? 'text-green-700' : 'text-slate-700'}">${a.label}</span>
                        ${active ? '<span class="flex-shrink-0 text-green-600 text-lg">✓</span>' : ''}
                    </button>
                `;
        }).join('');
        document.getElementById('amSelectedCount').textContent = selectedAmenities.size;
    }

    function toggleAmenity(idx) {
        if (selectedAmenities.has(idx)) selectedAmenities.delete(idx);
        else selectedAmenities.add(idx);
        renderAmenitiesGrid();
    }

    // ─────────────────────────────────────────────────
    // REMOVE ROW (used by Highlights)
    // ─────────────────────────────────────────────────
    function removeRow(rowId, rowClass, wrapperId, emptyId) {
        document.getElementById(rowId)?.remove();
        const w = document.getElementById(wrapperId);
        if (!w.querySelector('.' + rowClass)) {
            w.classList.add('hidden');
            document.getElementById(emptyId).classList.remove('hidden');
        }
    }

    // ─────────────────────────────────────────────────
    // BANNER PREVIEW
    // ─────────────────────────────────────────────────
    function previewBanner(e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = ev => {
            document.getElementById('bannerPreviewImg').src = ev.target.result;
            document.getElementById('bannerPreviewWrap').classList.remove('hidden');
            document.getElementById('bannerPlaceholder').classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }

    // ─────────────────────────────────────────────────
    // MAP PREVIEW
    // ─────────────────────────────────────────────────
    document.getElementById('mapUrlInput').addEventListener('input', function() {
        const url = this.value.trim(),
            wrap = document.getElementById('mapPreviewWrap'),
            frame = document.getElementById('mapPreviewFrame');
        if (url.startsWith('https://www.google.com/maps')) {
            frame.src = url;
            wrap.classList.remove('hidden');
        } else {
            wrap.classList.add('hidden');
            frame.src = '';
        }
    });

    // ─────────────────────────────────────────────────
    // SUB PACKAGES
    // ─────────────────────────────────────────────────
    function addSubPackage(data = {}) {
        const wrapper = document.getElementById('spWrapper');
        document.getElementById('spEmpty').classList.add('hidden');
        wrapper.classList.remove('hidden');
        const rowId = 'sp_' + Date.now() + '_' + Math.random().toString(36).slice(2, 7);
        const isFeat = data.is_featured ? 'checked' : '';
        const row = document.createElement('div');
        row.id = rowId;
        row.className = 'sp-row border-2 rounded-2xl p-5 ' + (data.is_featured ? 'border-amber-400 bg-amber-50' : 'border-slate-200 bg-slate-50');
        row.innerHTML = `
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-semibold text-slate-600">📦 Sub Package</span>
            <div class="flex items-center gap-3">
                <label class="flex items-center gap-1.5 text-xs font-semibold text-amber-600 cursor-pointer">
                    <input type="checkbox" class="sp-featured w-3.5 h-3.5 accent-amber-500" ${isFeat}
                        onchange="toggleSpBorder('${rowId}',this.checked)"> ⭐ Featured
                </label>
                <button type="button" onclick="removeSpRow('${rowId}')"
                    class="w-7 h-7 flex items-center justify-center text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg text-lg">×</button>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3">
            <div>
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1 block">Badge</label>
                <input type="text" class="sp-badge w-full border border-slate-200 rounded-xl px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-amber-300" value="${data.badge??''}" placeholder="Most Popular">
            </div>
            <div>
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1 block">Editor Badge</label>
                <input type="text" class="sp-editor-badge w-full border border-slate-200 rounded-xl px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-amber-300" value="${data.editor_badge??''}" placeholder="✦ Editor's Pick">
            </div>
            <div>
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1 block">Sort Order</label>
                <input type="number" class="sp-sort w-full border border-slate-200 rounded-xl px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-amber-300" value="${data.sort_order??0}" min="0">
            </div>
        </div>
        <div class="mb-3">
            <label class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1 block">Package Name *</label>
            <input type="text" class="sp-name w-full border border-slate-200 rounded-xl px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-amber-300" value="${data.name??''}" placeholder="e.g. Weekend Retreat">
        </div>
        <div class="mb-3">
            <div class="flex justify-between items-center mb-2">
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wide">Features</label>
                <button type="button" onclick="addSpFeature('${rowId}')"
                    class="text-xs bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-1 rounded-lg font-semibold transition">+ Feature</button>
            </div>
            <div id="spFeat_${rowId}" class="space-y-2">${(data.features??[]).map(f=>spFeatureHtml(f)).join('')}</div>
        </div>
        <div>
            <label class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1 block">Price (₹)</label>
            <input type="number" class="sp-price w-full border border-slate-200 rounded-xl px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-amber-300" value="${data.price??''}" placeholder="e.g. 20000" min="0">
        </div>`;
        wrapper.appendChild(row);
    }

    function spFeatureHtml(value = '') {
        return `<div class="flex items-center gap-2">
        <span class="text-amber-500 flex-shrink-0">✔</span>
        <input type="text" class="spfeat-input flex-1 border border-slate-200 rounded-lg px-3 py-1.5 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-amber-200"
            value="${String(value).replace(/"/g,'&quot;')}" placeholder="e.g. All meals included">
        <button type="button" onclick="this.parentElement.remove()"
            class="flex-shrink-0 w-7 h-7 flex items-center justify-center text-red-400 hover:text-red-600 rounded-lg text-lg">×</button>
    </div>`;
    }

    function addSpFeature(rowId) {
        const div = document.createElement('div');
        div.innerHTML = spFeatureHtml();
        document.getElementById('spFeat_' + rowId).appendChild(div.firstElementChild);
    }

    function toggleSpBorder(rowId, checked) {
        const row = document.getElementById(rowId);
        row.classList.toggle('border-amber-400', checked);
        row.classList.toggle('bg-amber-50', checked);
        row.classList.toggle('border-slate-200', !checked);
        row.classList.toggle('bg-slate-50', !checked);
    }

    function removeSpRow(rowId) {
        document.getElementById(rowId)?.remove();
        const w = document.getElementById('spWrapper');
        if (!w.querySelector('.sp-row')) {
            w.classList.add('hidden');
            document.getElementById('spEmpty').classList.remove('hidden');
        }
    }

    // ─────────────────────────────────────────────────
    // REVIEWS / TESTIMONIALS
    // ─────────────────────────────────────────────────
    function addReview(data = {}) {
        const wrapper = document.getElementById('rvWrapper');
        document.getElementById('rvEmpty').classList.add('hidden');
        wrapper.classList.remove('hidden');
        const rowId = 'rv_' + Date.now() + '_' + Math.random().toString(36).slice(2, 7);
        const row = document.createElement('div');
        row.id = rowId;
        row.className = 'rv-row border border-slate-200 rounded-2xl p-5 bg-slate-50';

        const rating = data.rating ?? 5;
        let starOptions = '';
        for (let i = 5; i >= 1; i--) {
            starOptions += `<option value="${i}" ${i == rating ? 'selected' : ''}>${'★'.repeat(i)}${'☆'.repeat(5 - i)} (${i})</option>`;
        }

        row.innerHTML = `
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-semibold text-slate-600">💬 Review</span>
            <button type="button" onclick="removeRvRow('${rowId}')"
                class="w-7 h-7 flex items-center justify-center text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg text-lg">×</button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3">
            <div>
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1 block">Name *</label>
                <input type="text" class="rv-name w-full border border-slate-200 rounded-xl px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-rose-300"
                    value="${data.name ?? ''}" placeholder="e.g. Priya Sharma">
            </div>
            <div>
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1 block">Date</label>
                <input type="text" class="rv-date w-full border border-slate-200 rounded-xl px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-rose-300"
                    value="${data.review_date ?? ''}" placeholder="e.g. March 2025">
            </div>
            <div>
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1 block">Location</label>
                <input type="text" class="rv-location w-full border border-slate-200 rounded-xl px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-rose-300"
                    value="${data.location ?? ''}" placeholder="e.g. Delhi">
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-3">
            <div>
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1 block">Rating</label>
                <select class="rv-rating w-full border border-slate-200 rounded-xl px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-rose-300">
                    ${starOptions}
                </select>
            </div>
         
        </div>
        <div>
            <label class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1 block">Review Text *</label>
            <textarea class="rv-review w-full border border-slate-200 rounded-xl px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-rose-300" rows="3"
                placeholder="Write the traveler's experience...">${data.review ?? ''}</textarea>
        </div>`;
        wrapper.appendChild(row);
    }

    function removeRvRow(rowId) {
        document.getElementById(rowId)?.remove();
        const w = document.getElementById('rvWrapper');
        if (!w.querySelector('.rv-row')) {
            w.classList.add('hidden');
            document.getElementById('rvEmpty').classList.remove('hidden');
        }
    }

    function collectReviews() {
        const reviews = [];
        document.querySelectorAll('.rv-row').forEach(row => {
            const name = row.querySelector('.rv-name')?.value?.trim();
            const review = row.querySelector('.rv-review')?.value?.trim();
            if (!name || !review) return;
            reviews.push({
                name,
                review,
                review_date: row.querySelector('.rv-date')?.value?.trim() ?? '',
                location: row.querySelector('.rv-location')?.value?.trim() ?? '',
                rating: parseInt(row.querySelector('.rv-rating')?.value) || 5,
                sort_order: parseInt(row.querySelector('.rv-sort')?.value) || 0,
            });
        });
        document.getElementById('reviews_json').value = JSON.stringify(reviews);
    }

    // ─────────────────────────────────────────────────
    // PREPARE ALL JSON BEFORE SUBMIT
    // ─────────────────────────────────────────────────
    function prepareData() {
        const highlights = [];
        document.querySelectorAll('.hl-row').forEach(row => {
            const icon = row.querySelector('.hl-icon')?.value,
                title = row.querySelector('.hl-title')?.value?.trim(),
                subtitle = row.querySelector('.hl-subtitle')?.value?.trim();
            if (title) highlights.push({
                icon,
                title,
                subtitle
            });
        });
        document.getElementById('highlights_json').value = JSON.stringify(highlights);

        const amenities = [];
        selectedAmenities.forEach(idx => {
            const a = AMENITIES_LIST[idx];
            if (a) amenities.push({
                icon: a.key,
                label: a.label
            });
        });
        document.getElementById('amenities_json').value = JSON.stringify(amenities);

        const subPackages = [];
        document.querySelectorAll('.sp-row').forEach(row => {
            const name = row.querySelector('.sp-name')?.value?.trim();
            if (!name) return;
            const features = [];
            row.querySelectorAll('.spfeat-input').forEach(inp => {
                const v = inp.value.trim();
                if (v) features.push(v);
            });
            subPackages.push({
                badge: row.querySelector('.sp-badge')?.value?.trim() ?? '',
                editor_badge: row.querySelector('.sp-editor-badge')?.value?.trim() ?? '',
                name,
                features,
                price: row.querySelector('.sp-price')?.value ?? '',
                is_featured: row.querySelector('.sp-featured')?.checked ?? false,
                sort_order: parseInt(row.querySelector('.sp-sort')?.value) || 0,
            });
        });
        document.getElementById('sub_packages_json').value = JSON.stringify(subPackages);

        collectReviews();
    }

    // ─────────────────────────────────────────────────
    // LOAD EXISTING DATA ON PAGE LOAD
    // ─────────────────────────────────────────────────
    window.addEventListener('DOMContentLoaded', () => {
        // Highlights
        existingHighlights.forEach(h => addHighlight(h.icon ?? 'bi-star', h.title ?? '', h.subtitle ?? ''));

        // Amenities — pre-select matching items in the fixed grid
        existingAmenities.forEach(a => {
            const idx = findAmenityIndex(a);
            if (idx >= 0) selectedAmenities.add(idx);
        });
        renderAmenitiesGrid();

        // Sub Packages
        existingSubPackages.forEach(sp => addSubPackage(sp));

        // Reviews
        existingReviews.forEach(rv => addReview(rv));
    });
</script>
{{-- CKEditor 4 --}}
<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description', {
        toolbar: [
            { name: 'styles',     items: ['Format', 'Font', 'FontSize'] },
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat'] },
            { name: 'colors',     items: ['TextColor', 'BGColor'] },
            { name: 'paragraph',  items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
            { name: 'align',      items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
            { name: 'links',      items: ['Link', 'Unlink'] },
            { name: 'insert',     items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar'] },
            { name: 'tools',      items: ['Maximize', 'Source'] },
        ],
        height: 300,
    });
</script>
@endsection