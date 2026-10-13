@extends('admin.layout.master')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    .pkg-wrap * {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .stat-card {
        background: white;
        border: 1.5px solid #f1f5f9;
        border-radius: 16px;
        padding: 1.1rem 1.4rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .pkg-card {
        background: white;
        border: 1.5px solid #f1f5f9;
        border-radius: 20px;
        overflow: visible !important;
        display: flex;
        flex-direction: column;
        transition: all 0.25s;
        position: relative;
    }

    .pkg-card:hover {
        border-color: #e2e8f0;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }

    .pkg-img-wrap {
        position: relative;
        border-radius: 18px 18px 0 0;
        overflow: hidden;
    }

    .pkg-img-wrap img {
        width: 100%;
        height: 190px;
        object-fit: cover;
        display: block;
        transition: transform 0.5s;
    }

    .pkg-card:hover .pkg-img-wrap img {
        transform: scale(1.04);
    }

    .pkg-tag {
        position: absolute;
        top: 10px;
        right: 10px;
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        font-size: 0.65rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        padding: 0.3rem 0.7rem;
        border-radius: 50px;
        box-shadow: 0 2px 8px rgba(220, 38, 38, 0.4);
    }

    .detail-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 0.28rem 0.7rem;
        border-radius: 50px;
    }

    .slug-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        font-size: 0.65rem;
        font-weight: 600;
        color: #6366f1;
        background: #eef2ff;
        border: 1px solid #c7d2fe;
        border-radius: 6px;
        padding: 0.18rem 0.55rem;
        font-family: 'Courier New', monospace;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .pkg-action-btn {
        display: inline-flex !important;
        align-items: center !important;
        gap: 0.35rem !important;
        padding: 0.4rem 0.75rem !important;
        border-radius: 10px !important;
        font-size: 0.72rem !important;
        font-weight: 700 !important;
        transition: all 0.15s !important;
        border: none !important;
        cursor: pointer !important;
        text-decoration: none !important;
        white-space: nowrap !important;
        line-height: 1 !important;
    }

    .pkg-btn-edit {
        background: #fef3c7 !important;
        color: #d97706 !important;
    }

    .pkg-btn-edit:hover {
        background: #fde68a !important;
        color: #d97706 !important;
    }

    .pkg-btn-detail {
        background: #eef2ff !important;
        color: #6366f1 !important;
    }

    .pkg-btn-detail:hover {
        background: #e0e7ff !important;
        color: #6366f1 !important;
    }

    .pkg-btn-delete {
        background: #fef2f2 !important;
        color: #ef4444 !important;
    }

    .pkg-btn-delete:hover {
        background: #fee2e2 !important;
        color: #ef4444 !important;
    }

    /* =====================================================
       DROPDOWN — completely isolated styles, no conflicts
       ===================================================== */
    #pkg-detail-portal {
        position: fixed !important;
        z-index: 999999 !important;
        display: none;
        min-width: 190px;
        background: #ffffff !important;
        border: 1.5px solid #e2e8f0 !important;
        border-radius: 14px !important;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.13) !important;
        overflow: hidden !important;
        padding: 0 !important;
        margin: 0 !important;
        list-style: none !important;
    }

    #pkg-detail-portal a {
        display: flex !important;
        align-items: center !important;
        gap: 0.6rem !important;
        padding: 0.7rem 1rem !important;
        font-size: 0.78rem !important;
        font-weight: 600 !important;
        color: #475569 !important;
        text-decoration: none !important;
        border-bottom: 1px solid #f1f5f9 !important;
        transition: all 0.15s !important;
        background: white !important;
        white-space: nowrap !important;
    }

    #pkg-detail-portal a:last-child {
        border-bottom: none !important;
    }

    #pkg-detail-portal a:hover {
        padding-left: 1.3rem !important;
    }

    #pkg-detail-portal a.pkg-dd-add:hover {
        background: #eef2ff !important;
        color: #6366f1 !important;
    }

    #pkg-detail-portal a.pkg-dd-edit:hover {
        background: #fffbeb !important;
        color: #d97706 !important;
    }

    #pkg-detail-portal a.pkg-dd-view:hover {
        background: #f0fdf4 !important;
        color: #16a34a !important;
    }

    #pkg-detail-portal a.pkg-dd-gallery:hover {
        background: #fdf4ff !important;
        color: #9333ea !important;
    }

    .add-pkg-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: white !important;
        font-size: 0.85rem;
        font-weight: 700;
        padding: 0.65rem 1.4rem;
        border-radius: 12px;
        text-decoration: none !important;
        transition: all 0.2s;
        box-shadow: 0 4px 14px rgba(99, 102, 241, 0.3);
    }

    .add-pkg-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
        color: white !important;
    }

    .pkg-search-box {
        background: white;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.6rem 1rem 0.6rem 2.6rem;
        font-size: 0.85rem;
        color: #1e293b;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 500;
        outline: none;
        transition: all 0.2s;
        width: 240px;
    }

    .pkg-search-box:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
</style>

{{-- ✅ PORTAL: Single dropdown div appended to BODY — zero CSS conflict --}}
<div id="pkg-detail-portal">
    <a href="#" id="pkg-dd-link-add" class="pkg-dd-add">
        <svg class="w-3.5 h-3.5" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <line x1="12" y1="5" x2="12" y2="19" />
            <line x1="5" y1="12" x2="19" y2="12" />
        </svg>
        Add Detail
    </a>
    <a href="#" id="pkg-dd-link-edit" class="pkg-dd-edit">
        <svg class="w-3.5 h-3.5" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
            <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
        </svg>
        Edit Detail
    </a>
    <a href="#" id="pkg-dd-link-view" class="pkg-dd-view">
        <svg class="w-3.5 h-3.5" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
            <circle cx="12" cy="12" r="3" />
        </svg>
        View Detail
    </a>
    <a href="#" id="pkg-dd-link-gallery" class="pkg-dd-gallery">
        <svg class="w-3.5 h-3.5" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <rect x="3" y="3" width="18" height="18" rx="2" />
            <circle cx="8.5" cy="8.5" r="1.5" />
            <path d="M21 15l-5-5L5 21" />
        </svg>
        Add Gallery
    </a>
</div>

<div class="pkg-wrap">

    {{-- Header --}}
    <div class="flex flex-wrap justify-between items-start gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <div class="w-2 h-7 rounded-full bg-indigo-500"></div>
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Hotel Management</h2>
            </div>
            <p class="text-slate-400 text-sm ml-4">Manage and organize all your travel Hotels</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="relative">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                </svg>
                <input type="text" id="pkgSearch" class="pkg-search-box" placeholder="Search packages...">
            </div>
            <a href="{{ route('admin.package.create') }}" class="add-pkg-btn">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Add Hotel
            </a>
        </div>
    </div>

    {{-- Stats Row --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-7">
        <div class="stat-card">
            <div class="stat-icon" style="background:#eef2ff;">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="2" y="7" width="20" height="14" rx="2" />
                    <path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2" />
                </svg>
            </div>
            <div>
                <p class="text-slate-400 text-xs font-semibold">Total</p>
                <p class="text-xl font-extrabold text-slate-800">{{ $packages->count() }}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#f0fdf4;">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="20 6 9 17 4 12" />
                </svg>
            </div>
            <div>
                <p class="text-slate-400 text-xs font-semibold">With Details</p>
                <p class="text-xl font-extrabold text-slate-800">{{ $packages->where('details_count', '>', 0)->count() }}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#fff1f2;">
                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </div>
            <div>
                <p class="text-slate-400 text-xs font-semibold">No Details</p>
                <p class="text-xl font-extrabold text-slate-800">{{ $packages->where('details_count', 0)->count() }}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#fffbeb;">
                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="12" y1="1" x2="12" y2="23" />
                    <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" />
                </svg>
            </div>
            <div>
                <p class="text-slate-400 text-xs font-semibold">Avg Price</p>
                <p class="text-xl font-extrabold text-slate-800">₹{{ $packages->count() ? number_format($packages->avg('total_price'), 0) : '0' }}</p>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-5 text-sm font-semibold">
        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <polyline points="20 6 9 17 4 12" />
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- Package Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5" id="packagesGrid">

        @forelse($packages as $package)
        <div class="pkg-card" data-name="{{ strtolower($package->name) }}">

            {{-- Image --}}
            <div class="pkg-img-wrap">
                <img src="{{ asset('admin-assets/home/package/' . $package->image) }}" alt="{{ $package->name }}">
                @if($package->tag)
                <span class="pkg-tag">{{ $package->tag }}</span>
                @endif
            </div>

            <div class="p-4 flex flex-col flex-1">

                {{-- Name + Detail Badge --}}
                <div class="flex items-start justify-between gap-2 mb-2">
                    <h3 class="text-base font-bold text-slate-800 leading-tight">{{ $package->name }}</h3>
                    @if(isset($package->details_count) && $package->details_count > 0)
                    <span class="detail-badge bg-green-50 text-green-700 border border-green-100 flex-shrink-0">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                        Detail
                    </span>
                    @else
                    <span class="detail-badge bg-red-50 text-red-500 border border-red-100 flex-shrink-0">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                        No Detail
                    </span>
                    @endif
                </div>

                {{-- Slug --}}
                <div class="mb-2">
                    <span class="slug-pill" title="/packages/{{ $package->slug }}">
                        <svg class="w-2.5 h-2.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71" />
                            <path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71" />
                        </svg>
                        {{ $package->slug }}
                    </span>
                </div>

                {{-- Location --}}
                <div class="flex items-center gap-1.5 text-xs text-slate-500 font-medium mb-3">
                    <svg class="w-3.5 h-3.5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                    {{ $package->city->name ?? 'N/A' }}, {{ $package->state->name ?? 'N/A' }}, {{ $package->country->name ?? 'N/A' }}
                </div>
                <div class="flex items-center gap-1.5 text-xs text-slate-500 font-medium mb-3">
                    {{ $package->short_description ?? 'N/A' }}
                </div>

                {{-- Pricing --}}
                <div class="bg-slate-50 rounded-xl px-3 py-2.5 flex justify-between items-center mb-4">
                    <div>
                        <p class="text-xs text-slate-400 font-semibold mb-0.5">Total</p>
                        <p class="text-lg font-extrabold text-slate-800">₹{{ number_format($package->total_price, 0) }}</p>
                    </div>
                    <div class="w-px h-8 bg-slate-200"></div>
                    <div class="text-right">
                        <p class="text-xs text-slate-400 font-semibold mb-0.5">Advance</p>
                        <p class="text-base font-bold text-green-600">₹{{ number_format($package->advance_price ?? 0, 0) }}</p>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-2 mt-auto flex-wrap">

                    {{-- Edit --}}
                    <a href="{{ route('admin.package.edit', $package->id) }}" class="pkg-action-btn pkg-btn-edit">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                            <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                        </svg>
                        Edit
                    </a>

                    {{-- Detail Dropdown Trigger --}}
                    {{-- ✅ FIX: data-has-detail properly set from Blade, all 4 routes passed --}}
                    <button type="button"
                        class="pkg-action-btn pkg-btn-detail pkg-detail-trigger"
                        data-pkg-id="{{ $package->id }}"
                        data-has-detail="{{ ($package->details_count ?? 0) > 0 ? '1' : '0' }}"
                        data-url-add="{{ route('admin.package.detail.create', $package->id) }}"
                        data-url-edit="{{ route('admin.package.detail.edit', $package->id) }}"
                        data-url-view="{{ route('admin.package.detail.show', $package->id) }}"
                        data-url-gallery="{{ route('admin.package.gallery.create', $package->id) }}">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="9" y="9" width="13" height="13" rx="2" />
                            <path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1" />
                        </svg>
                        Detail
                        <svg width="12" height="12" class="pkg-arrow-icon" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="transition:transform 0.2s;">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </button>

                    {{-- Delete --}}
                    <form action="{{ route('admin.package.destroy', $package->id) }}" method="POST"
                        onsubmit="return confirm('Delete \'{{ addslashes($package->name) }}\'? This cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="pkg-action-btn pkg-btn-delete">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <polyline points="3 6 5 6 21 6" />
                                <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                                <path d="M10 11v6M14 11v6" />
                            </svg>
                            Delete
                        </button>
                    </form>

                </div>
            </div>
        </div>

        @empty
        <div class="col-span-3">
            <div class="bg-white border border-dashed border-slate-200 rounded-2xl p-16 text-center">
                <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <rect x="2" y="7" width="20" height="14" rx="2" />
                        <path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2" />
                    </svg>
                </div>
                <p class="text-slate-600 font-bold text-lg">No packages yet</p>
                <p class="text-slate-400 text-sm mt-1 mb-5">Start by creating your first travel package</p>
                <a href="{{ route('admin.package.create') }}" class="add-pkg-btn inline-flex">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Add First Package
                </a>
            </div>
        </div>
        @endforelse

    </div>
</div>

@endsection

@section('scripts')
<script>
    (function () {
        'use strict';

        var portal    = document.getElementById('pkg-detail-portal');
        var activeBtn = null;
        document.body.appendChild(portal);

        function openPortal(btn) {
            // ✅ Sab routes button ke data attributes se lo
            var urlAdd  = btn.getAttribute('data-url-add');
            var urlEdit = btn.getAttribute('data-url-edit');
            var urlView = btn.getAttribute('data-url-view');
            var urlGall = btn.getAttribute('data-url-gallery');

            // ✅ Sirf hrefs update karo — koi bhi option hide nahi hoga
            document.getElementById('pkg-dd-link-add').href     = urlAdd;
            document.getElementById('pkg-dd-link-edit').href    = urlEdit;
            document.getElementById('pkg-dd-link-view').href    = urlView;
            document.getElementById('pkg-dd-link-gallery').href = urlGall;

            // ✅ Sabhi 4 options hamesha visible rahenge
            document.getElementById('pkg-dd-link-add').style.display     = 'flex';
            document.getElementById('pkg-dd-link-edit').style.display    = 'flex';
            document.getElementById('pkg-dd-link-view').style.display    = 'flex';
            document.getElementById('pkg-dd-link-gallery').style.display = 'flex';

            // Position calculate karo
            portal.style.visibility = 'hidden';
            portal.style.display    = 'block';

            var rect       = btn.getBoundingClientRect();
            var pH         = portal.offsetHeight;
            var pW         = portal.offsetWidth;
            var spaceBelow = window.innerHeight - rect.bottom;

            var top, left;

            if (spaceBelow < pH + 10) {
                top = rect.top - pH - 6;   // upar open karo
            } else {
                top = rect.bottom + 6;     // neeche open karo
            }

            left = rect.left;
            if (left + pW > window.innerWidth - 10) {
                left = rect.right - pW;
            }

            portal.style.top        = top + 'px';
            portal.style.left       = left + 'px';
            portal.style.visibility = 'visible';

            var arrow = btn.querySelector('.pkg-arrow-icon');
            if (arrow) arrow.style.transform = spaceBelow < pH + 10 ? 'rotate(0deg)' : 'rotate(180deg)';

            activeBtn = btn;
        }

        function closePortal() {
            portal.style.display = 'none';
            if (activeBtn) {
                var arrow = activeBtn.querySelector('.pkg-arrow-icon');
                if (arrow) arrow.style.transform = 'rotate(0deg)';
                activeBtn = null;
            }
        }

        document.querySelectorAll('.pkg-detail-trigger').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                if (activeBtn === btn) {
                    closePortal();
                } else {
                    closePortal();
                    openPortal(btn);
                }
            });
        });

        document.addEventListener('click', function (e) {
            if (!e.target.closest('#pkg-detail-portal') && !e.target.closest('.pkg-detail-trigger')) {
                closePortal();
            }
        });

        window.addEventListener('scroll', closePortal, true);
        window.addEventListener('resize', closePortal);

        var searchBox = document.getElementById('pkgSearch');
        if (searchBox) {
            searchBox.addEventListener('input', function () {
                var q = this.value.toLowerCase();
                document.querySelectorAll('#packagesGrid .pkg-card').forEach(function (card) {
                    card.style.display = card.dataset.name.includes(q) ? '' : 'none';
                });
            });
        }
    })();
</script>
@endsection