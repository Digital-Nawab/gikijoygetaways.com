@extends('frontend.layout.master')
@section('content')
    <style>
        .package-img {
            display: block;
            width: 100%;
            height: 250px;
            /* same height for all */
            overflow: hidden;
            border-radius: 10px;
        }

        .package-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* important */
        }
    </style>
    <div class="breadcrumb-section" style="background-image:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('/assets/img/innerpages/breadcrumb-bg3.jpg');">
        <div class="container">
            <div class="banner-content">
                <h1>Tour Package</h1>
                <ul class="breadcrumb-list">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Tour Package</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="package-grid-page pt-100 mb-100">
        <div class="container">
            <div class="row">

                {{-- SIDEBAR --}}
                <div class="col-lg-3">
                    <div class="package-sidebar-area">
                        <form method="GET" action="{{ url('/travel-package') }}" id="filterForm">
                            <div class="sidebar-wrapper">

                                <div class="title-area">
                                    <h5>Filter</h5>
                                    <a href="{{ url('/travel-package') }}">Clear All</a>
                                </div>

                                {{-- Destinations: Country > State > City --}}
                                <div class="single-widgets">
                                    <div class="widget-title">
                                        <h5>States</h5>
                                    </div>
                                    <div class="checkbox-container">
                                        <ul>
                                            {{-- Saare countries aur states HAMESHA dikhao (kabhi hide nahi) --}}
                                            @foreach($countries as $country)
                                                @php
                                                    $isActive = $country->states->pluck('id')->contains(request('state_id'));
                                                    $isFirst = $loop->first; // pehla country (India) default open
                                                    $shouldShow = $isActive || $isFirst;
                                                @endphp
                                                <li class="sidebar-category-dropdown">
                                                    <label class="containerss" style="cursor:pointer;" onclick="toggleCountry({{ $country->id }})">
                                                        <strong>{{ $country->name }}</strong>
                                                    </label>
                                                    <ul class="sub-category" id="country-{{ $country->id }}"
                                                        style="{{ $shouldShow ? '' : 'display:none;' }}">
                                                        @foreach($country->states as $state)
                                                            @php
                                                                $stateSelected = request('state_id') == $state->id;
                                                                // Jis state par click hua, uski cities + packages count load karo
                                                                $stateCities = $stateSelected
                                                                    ? $state->cities()->withCount('packages')->get()
                                                                    : collect();
                                                            @endphp
                                                            <li>
                                                                <label class="containerss">
                                                                    <input type="radio" name="state_id"
                                                                           value="{{ $state->id }}"
                                                                           {{ $stateSelected ? 'checked' : '' }}
                                                                           onchange="document.getElementById('filterForm').submit()">
                                                                    <span class="checkmark"></span>
                                                                    <strong>
                                                                        <span>{{ $state->state_name }}</span>
                                                                        <span>{{ $state->packages_count }}</span>
                                                                    </strong>
                                                                </label>

                                                                {{-- Selected state ke neeche uski cities expand karo --}}
                                                                @if($stateSelected && count($stateCities))
                                                                    <ul class="sub-category" style="display:block;padding-left:18px;margin-top:6px;">
                                                                        @foreach($stateCities as $city)
                                                                            <li>
                                                                                <label class="containerss">
                                                                                    <input type="radio" name="city_id"
                                                                                           value="{{ $city->id }}"
                                                                                           {{ request('city_id') == $city->id ? 'checked' : '' }}
                                                                                           onchange="document.getElementById('filterForm').submit()">
                                                                                    <span class="checkmark"></span>
                                                                                    <strong>
                                                                                        <span>{{ $city->name }}</span>
                                                                                        <span>{{ $city->packages_count ?? '' }}</span>
                                                                                    </strong>
                                                                                </label>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <i class="bi bi-caret-right-fill sidebar-category-icon {{ $shouldShow ? 'active' : '' }}"
                                                       id="icon-{{ $country->id }}"
                                                       onclick="toggleCountry({{ $country->id }})"
                                                       style="cursor:pointer;"></i>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                {{-- Price Filter --}}
                                <div class="single-widgets">
                                    <div class="widget-title">
                                        <h5>Pricing</h5>
                                    </div>
                                    <div class="range-wrap">
                                        <div id="slider-range"></div>
                                        <div class="slider-labels mt-2">
                                            <div class="caption">
                                                <span>&#8377;<span id="slider-range-value1">{{ number_format(request('min_price', 0)) }}</span></span>
                                            </div>
                                            <div class="caption">
                                                <span>&#8377;<span id="slider-range-value2">{{ number_format(request('max_price', 100000)) }}</span></span>
                                            </div>
                                        </div>
                                        <input type="hidden" name="min_price" id="min_price" value="{{ request('min_price', 0) }}">
                                        <input type="hidden" name="max_price" id="max_price" value="{{ request('max_price', 100000) }}">
                                        {{-- Apply Price ab JS se handle hota hai taaki selected state/city URL me bani rahe
                                             aur radio buttons se conflict na ho --}}
                                        <button type="button" onclick="applyPrice()" class="primary-btn1 mt-3" style="width:100%;padding:8px;border:none;cursor:pointer;">
                                            <span>Apply Price</span>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

                {{-- PACKAGES --}}
                <div class="col-lg-9">
                    <div class="package-grid-top-area">
                        <span><strong>{{ $packages->total() }}</strong> Packages Found</span>
                        <div class="selector-and-list-grid-area">
                            <div class="filter-btn d-lg-none d-flex">
                                <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_456_25)">
                                        <path d="M0.5625 3.17317H9.12674C9.38486 4.34806 10.4341 5.2301 11.6853 5.2301C12.9366 5.2301 13.9858 4.3481 14.2439 3.17317H17.4375C17.7481 3.17317 18 2.92131 18 2.61067C18 2.30003 17.7481 2.04817 17.4375 2.04817H14.2437C13.9851 0.873885 12.9344 -0.00871277 11.6853 -0.00871277C10.4356 -0.00871277 9.38545 0.873744 9.12695 2.04817H0.5625C0.251859 2.04817 0 2.30003 0 2.61067C0 2.92131 0.251859 3.17317 0.5625 3.17317ZM10.191 2.61215L10.191 2.6061C10.1935 1.78461 10.8638 1.11632 11.6853 1.11632C12.5057 1.11632 13.1761 1.78369 13.1796 2.6048L13.1797 2.61306C13.1784 3.43597 12.5086 4.10513 11.6853 4.10513C10.8625 4.10513 10.1928 3.43663 10.191 2.61422L10.191 2.61215ZM17.4375 14.8268H14.2437C13.985 13.6525 12.9344 12.7699 11.6853 12.7699C10.4356 12.7699 9.38545 13.6524 9.12695 14.8268H0.5625C0.251859 14.8268 0 15.0786 0 15.3893C0 15.7 0.251859 15.9518 0.5625 15.9518H9.12674C9.38486 17.1267 10.4341 18.0087 11.6853 18.0087C12.9366 18.0087 13.9858 17.1267 14.2439 15.9518H17.4375C17.7481 15.9518 18 15.7 18 15.3893C18 15.0786 17.7481 14.8268 17.4375 14.8268ZM11.6853 16.8837C10.8625 16.8837 10.1928 16.2152 10.191 15.3928L10.191 15.3908L10.191 15.3847C10.1935 14.5632 10.8638 13.8949 11.6853 13.8949C12.5057 13.8949 13.1761 14.5623 13.1796 15.3834L13.1797 15.3916C13.1785 16.2146 12.5086 16.8837 11.6853 16.8837ZM17.4375 8.43751H8.87326C8.61514 7.26262 7.56594 6.38062 6.31466 6.38062C5.06338 6.38062 4.01418 7.26262 3.75606 8.43751H0.5625C0.251859 8.43751 0 8.68936 0 9.00001C0 9.31068 0.251859 9.56251 0.5625 9.56251H3.75634C4.01498 10.7368 5.06559 11.6194 6.31466 11.6194C7.56439 11.6194 8.61455 10.7369 8.87305 9.56251H17.4375C17.7481 9.56251 18 9.31068 18 9.00001C18 8.68936 17.7481 8.43751 17.4375 8.43751ZM7.80901 8.99853L7.80898 9.00458C7.80652 9.82607 7.13619 10.4944 6.31466 10.4944C5.49429 10.4944 4.82393 9.82699 4.82038 9.00591L4.82027 8.99769C4.8215 8.17468 5.49141 7.50562 6.31466 7.50562C7.13753 7.50562 7.80718 8.17408 7.80905 8.99653L7.80901 8.99853Z" />
                                    </g>
                                </svg>
                                <span>Filters</span>
                            </div>
                            <div class="selector-area">
                                <span>Sort By:</span>
                                <select onchange="
                                        var params = new URLSearchParams(window.location.search);
                                        params.set('sort', this.value);
                                        params.delete('page');
                                        window.location = '{{ url('/travel-package') }}?' + params.toString();
                                        ">
                                    <option value="default" {{ request('sort','default')=='default'    ? 'selected' : '' }}>Default</option>
                                    <option value="latest" {{ request('sort')=='latest'     ? 'selected' : '' }}>Latest</option>
                                    <option value="price_high" {{ request('sort')=='price_high' ? 'selected' : '' }}>Price High</option>
                                    <option value="price_low" {{ request('sort')=='price_low'  ? 'selected' : '' }}>Price Low</option>
                                </select>
                            </div>
                            <!--<ul class="grid-view d-md-flex d-none">-->
                            <!--    <li class="column-2 active">-->
                            <!--        <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">-->
                            <!--            <path d="M4 11C5.65685 11 7 12.3431 7 14C7 15.6569 5.65685 17 4 17C2.34315 17 1 15.6569 1 14C1 12.3431 2.34315 11 4 11ZM14 11C15.6569 11 17 12.3431 17 14C17 15.6569 15.6569 17 14 17C12.3431 17 11 15.6569 11 14C11 12.3431 12.3431 11 14 11ZM4 1C5.65685 1 7 2.34315 7 4C7 5.65685 5.65685 7 4 7C2.34315 7 1 5.65685 1 4C1 2.34315 2.34315 1 4 1ZM14 1C15.6569 1 17 2.34315 17 4C17 5.65685 15.6569 7 14 7C12.3431 7 11 5.65685 11 4C11 2.34315 12.3431 1 14 1Z" />-->
                            <!--        </svg>-->
                            <!--    </li>-->
                            <!--    <li class="column-1">-->
                            <!--        <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">-->
                            <!--            <path d="M17.25 9.95007H0.75C0.336 9.95007 0 9.61407 0 9.20007C0 8.78607 0.336 8.45007 0.75 8.45007H17.25C17.664 8.45007 18 8.78607 18 9.20007C18 9.61407 17.664 9.95007 17.25 9.95007ZM17.25 4.20001H0.75C0.336 4.20001 0 3.86401 0 3.45001C0 3.03601 0.336 2.70001 0.75 2.70001H17.25C17.664 2.70001 18 3.03601 18 3.45001C18 3.86401 17.664 4.20001 17.25 4.20001ZM17.25 15.6999H0.75C0.336 15.6999 0 15.3639 0 14.9499C0 14.5359 0.336 14.1999 0.75 14.1999H17.25C17.664 14.1999 18 14.5359 18 14.9499C18 15.3639 17.664 15.6999 17.25 15.6999Z" />-->
                            <!--        </svg>-->
                            <!--    </li>-->
                            <!--</ul>-->
                        </div>
                    </div>

                    <div class="list-grid-product-wrap">
                        <div class="row gy-md-5 gy-4">
                            @forelse($packages as $package)
                                <div class="col-md-6 item wow animate fadeInDown" data-wow-delay="200ms" data-wow-duration="1500ms">
                                    <div class="package-card">
                                        <div class="package-img-wrap">
                                            <a href="{{ url('travel-package-detail', $package->slug) }}" class="package-img">
                                                <img src="{{ asset('admin-assets/home/package/' . $package->image) }}" alt="{{ $package->name }}">
                                            </a>
                                            @if($package->tag)
                                                <div class="batch">
                                                    <span>{{ $package->tag }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="package-content">
                                            <h5>
                                                <a href="{{ url('travel-package-detail', $package->slug) }}">{{ $package->name }}</a>
                                            </h5>
                                            <div class="location-and-time">
                                                <div class="location">
                                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:3px;">
                                                        <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                                                        <circle cx="12" cy="10" r="3" />
                                                    </svg>
                                                    <a href="#">
                                                        {{ $package->country->name ?? '' }}
                                                        @if($package->state?->state_name), {{ $package->state->state_name }}@endif
                                                        @if($package->city?->name), {{ $package->city->name }}@endif
                                                    </a>
                                                </div>
                                                <span>{{ $package->days }} Days</span>
                                            </div>
                                            @if($package->short_description)
                                                <p style="font-size:13.5px;color:#64748b;line-height:1.65;margin:10px 0 14px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                                                    {{ $package->short_description }}
                                                </p>
                                            @endif
                                            <div class="btn-and-price-area">
                                                <a href="{{ url('travel-package-detail', $package->slug) }}" class="primary-btn1">
                                                    <span>Book Now</span>
                                                </a>
                                                <div class="price-area">
                                                    <span>&#8377;{{ number_format($package->total_price, 0) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-5">
                                    <p class="text-muted">No packages found. <a href="{{ url('/travel-package') }}">Clear filters</a></p>
                                </div>
                            @endforelse
                        </div>

                        {{-- PAGINATION --}}
                        @if($packages->hasPages())
                            <div class="pagination-area mt-60 wow animate fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                                <div class="paginations-button">
                                    @if($packages->onFirstPage())
                                        <span style="opacity:0.4;cursor:not-allowed;">
                                <svg width="10" height="10" viewBox="0 0 10 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.86133 9.28516C7.14704 7.49944 3.57561 5.71373 1.43276 4.99944C3.57561 4.28516 6.7899 3.21373 7.86133 0.713728" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                                Prev
                            </span>
                                    @else
                                        <a href="{{ $packages->previousPageUrl() }}">
                                            <svg width="10" height="10" viewBox="0 0 10 10" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.86133 9.28516C7.14704 7.49944 3.57561 5.71373 1.43276 4.99944C3.57561 4.28516 6.7899 3.21373 7.86133 0.713728" stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                            Prev
                                        </a>
                                    @endif
                                </div>

                                <ul class="paginations">
                                    @foreach($packages->links()->elements as $element)
                                        @if(is_string($element))
                                            <li class="page-item"><span>{{ $element }}</span></li>
                                        @endif
                                        @if(is_array($element))
                                            @foreach($element as $page => $url)
                                                <li class="page-item {{ $packages->currentPage() == $page ? 'active' : '' }}">
                                                    <a href="{{ $url }}">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</a>
                                                </li>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </ul>

                                <div class="paginations-button">
                                    @if($packages->hasMorePages())
                                        <a href="{{ $packages->nextPageUrl() }}">
                                            Next
                                            <svg width="10" height="10" viewBox="0 0 10 10" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.42969 9.28613C2.14397 7.50042 5.7154 5.7147 7.85826 5.00042C5.7154 4.28613 2.50112 3.21471 1.42969 0.714705" stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                        </a>
                                    @else
                                        <span style="opacity:0.4;cursor:not-allowed;">
                                Next
                                <svg width="10" height="10" viewBox="0 0 10 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.42969 9.28613C2.14397 7.50042 5.7154 5.7147 7.85826 5.00042C5.7154 4.28613 2.50112 3.21471 1.42969 0.714705" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </span>
                                    @endif
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script>
        $(function() {
            // Price slider
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 100000,
                values: [{{ request('min_price', 0) }}, {{ request('max_price', 100000) }}],
                slide: function(event, ui) {
                    $("#slider-range-value1").text(ui.values[0].toLocaleString('en-IN'));
                    $("#slider-range-value2").text(ui.values[1].toLocaleString('en-IN'));
                    $("#min_price").val(ui.values[0]);
                    $("#max_price").val(ui.values[1]);
                }
            });
        });

        // Country toggle
        function toggleCountry(id) {
            var sub = document.getElementById('country-' + id);
            var icon = document.getElementById('icon-' + id);
            if (sub.style.display === 'none') {
                sub.style.display = 'block';
                icon.classList.add('active');
            } else {
                sub.style.display = 'none';
                icon.classList.remove('active');
            }
        }

        // Apply price: current URL ke state_id/city_id ko rakhte hue sirf price update karo
        function applyPrice() {
            var params = new URLSearchParams(window.location.search);
            params.set('min_price', document.getElementById('min_price').value);
            params.set('max_price', document.getElementById('max_price').value);
            params.delete('page');
            window.location = '{{ url('/travel-package') }}?' + params.toString();
        }
    </script>
@endsection