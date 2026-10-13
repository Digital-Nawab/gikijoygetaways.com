@extends('frontend.layout.master')
@section('css')
<style>
    /* ── Section Header ─────────────────────────────── */
    .blog-section-tag {
        display: inline-block;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--primary-color, #F0A500);
        margin-bottom: 10px;
    }

    .blog-section-title {
        font-size: clamp(26px, 3.5vw, 38px);
        font-weight: 800;
        color: #1a1a2e;
        margin-bottom: 14px;
        line-height: 1.25;
    }

    .blog-section-sub {
        font-size: 15px;
        color: #777;
        max-width: 500px;
        margin: 0 auto;
    }

    /* ── Card ───────────────────────────────────────── */
    .bl-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 16px rgba(0, 0, 0, 0.07);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .bl-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.13);
    }

    /* ── Card Image ─────────────────────────────────── */
    .bl-card-img {
        position: relative;
        overflow: hidden;
        height: 220px;
    }

    .bl-card-img a {
        display: block;
        height: 100%;
    }

    .bl-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .bl-card:hover .bl-card-img img {
        transform: scale(1.06);
    }

    /* ── Location Badge ─────────────────────────────── */
    .bl-location-badge {
        position: absolute;
        bottom: 14px;
        left: 14px;
        background: rgba(255, 255, 255, 0.95);
        color: #333;
        font-size: 12px;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        backdrop-filter: blur(4px);
    }

    .bl-location-badge svg {
        fill: var(--primary-color, #F0A500);
    }

    /* ── Card Body ──────────────────────────────────── */
    .bl-card-body {
        padding: 22px 24px 24px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    /* ── Meta ───────────────────────────────────────── */
    .bl-meta {
        margin-bottom: 10px;
    }

    .bl-date {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 13px;
        color: #999;
    }

    .bl-date svg {
        fill: var(--primary-color, #F0A500);
    }

    /* ── Title ──────────────────────────────────────── */
    .bl-title {
        font-size: 17px;
        font-weight: 700;
        line-height: 1.45;
        margin-bottom: 10px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .bl-title a {
        color: #1a1a2e;
        text-decoration: none;
        transition: color 0.2s;
    }

    .bl-title a:hover {
        color: var(--primary-color, #F0A500);
    }

    /* ── Description — 2 lines ──────────────────────── */
    .bl-desc {
        font-size: 14px;
        color: #777;
        line-height: 1.7;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 18px;
        flex: 1;
    }

    /* ── Read More ──────────────────────────────────── */
    .bl-read-more {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 700;
        color: var(--primary-color, #F0A500);
        text-decoration: none;
        letter-spacing: 0.3px;
        margin-top: auto;
        transition: gap 0.25s ease;
    }

    .bl-read-more svg {
        fill: currentColor;
        transition: transform 0.25s ease;
    }

    .bl-read-more:hover {
        gap: 10px;
        color: var(--primary-color, #F0A500);
    }

    .bl-read-more:hover svg {
        transform: translateX(3px);
    }
</style>
@endsection
@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb-section" style="background-image:linear-gradient(rgba(0,0,0,0.45),rgba(0,0,0,0.45)), url({{ asset('assets/img/innerpages/breadcrumb-bg2.jpg') }});">
        <div class="container">
            <div class="banner-content">
                <h1>Travel Inspiration</h1>
                <ul class="breadcrumb-list">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Travel Inspiration</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Blog List Page -->
    <div class="blog-listing-page pt-80 mb-100">
        <div class="container">

            <!-- Section Header -->
            <div class="row justify-content-center mb-50">
                <div class="col-lg-7 text-center">
                    <span class="blog-section-tag">Our Stories</span>
                    <h2 class="blog-section-title">Travel Inspiration & Guides</h2>
                    <p class="blog-section-sub">Discover destinations, tips and travel stories from across India and beyond.</p>
                </div>
            </div>

            <!-- Blog Cards Grid -->
            <div class="row g-4">
                @forelse($blogs as $index => $blog)
                <div class="col-lg-4 col-md-6 wow animate fadeInUp"
                    data-wow-delay="{{ ($index % 3) * 150 }}ms"
                    data-wow-duration="1000ms">
                    <div class="bl-card">

                        <!-- Image -->
                        <div class="bl-card-img">
                            <a href="{{ url('blog-details', $blog->id) }}">
                                <img src="{{ asset('admin-assets/home/Blog/' . $blog->image) }}" alt="{{ $blog->title }}">
                            </a>
                            <!-- Location Badge -->
                            <span class="bl-location-badge">
                                <svg width="12" height="12" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.81273 0C4.31731 0 1.47302 2.84433 1.47302 6.34163C1.47302 9.07242 5.28467 13.5258 6.92353 15.3136C7.15049 15.5628 7.47603 15.7042 7.81273 15.7042C8.14943 15.7042 8.47497 15.5628 8.70193 15.3136C10.3408 13.5258 14.1524 9.07238 14.1524 6.34163C14.1524 2.84433 11.3081 0 7.81273 0Z" />
                                </svg>
                                {{ $blog->location ?? 'Travel' }}
                            </span>
                        </div>

                        <!-- Content -->
                        <div class="bl-card-body">
                            <div class="bl-meta">
                                <span class="bl-date">
                                    <svg width="13" height="13" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.833313 13.0002V4.3335C0.833666 3.67056 1.09717 3.03488 1.56594 2.56612C2.0347 2.09735 2.67038 1.83385 3.33331 1.8335H5.49998V3.66683C5.49998 3.93205 5.71476 4.16683 5.99998 4.16683C6.2852 4.16683 6.49998 3.93205 6.49998 3.66683V1.8335H10.8333V3.66683C10.8333 3.93205 11.0481 4.16683 11.3333 4.16683C11.6185 4.16683 11.8333 3.93205 11.8333 3.66683V1.8335H12.6666C13.3296 1.83385 13.9653 2.09735 14.434 2.56612C14.9028 3.03488 15.1663 3.67056 15.1666 4.3335V13.0002C15.1663 13.6631 14.9028 14.2988 14.434 14.7675C13.9653 15.2363 13.3296 15.4998 12.6666 15.5002H3.33331C2.67038 15.4998 2.0347 15.2363 1.56594 14.7675C1.09717 14.2988 0.833666 13.6631 0.833313 13.0002ZM1.83331 6.50016V13.0002C1.83331 13.7366 2.59696 14.5002 3.33331 14.5002H12.6666C13.403 14.5002 14.1666 13.7366 14.1666 13.0002V6.50016H1.83331Z" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($blog->date)->format('d M, Y') }}
                                </span>
                            </div>

                            <h4 class="bl-title">
                                <a href="{{ url('blog-details', $blog->id) }}">{{ $blog->title }}</a>
                            </h4>

                            <p class="bl-desc">{{ $blog->short_description }}</p>

                            <a href="{{ url('blog-details', $blog->id) }}" class="bl-read-more">
                                Read More
                                <svg width="14" height="14" viewBox="0 0 10 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.73535 1.14746C9.57033 1.97255 9.32924 3.26406 9.24902 4.66797C9.16817 6.08312 9.25559 7.5453 9.70214 8.73633C9.84754 9.12406 9.65129 9.55659 9.26367 9.70215C8.9001 9.83849 8.4969 9.67455 8.32812 9.33398L8.29785 9.26367L8.19921 8.98438C7.73487 7.5758 7.67054 5.98959 7.75097 4.58203C7.77875 4.09598 7.82525 3.62422 7.87988 3.17969L1.53027 9.53027C1.23738 9.82317 0.762615 9.82317 0.469722 9.53027C0.176829 9.23738 0.176829 8.76262 0.469722 8.46973L6.83593 2.10254C6.3319 2.16472 5.79596 2.21841 5.25 2.24902C3.8302 2.32862 2.2474 2.26906 0.958003 1.79102L0.704097 1.68945L0.635738 1.65527C0.303274 1.47099 0.157578 1.06102 0.310542 0.704102C0.463655 0.347333 0.860941 0.170391 1.22363 0.28418L1.29589 0.310547L1.48828 0.387695C2.47399 0.751207 3.79966 0.827571 5.16601 0.750977C6.60111 0.670504 7.97842 0.428235 8.86132 0.262695L9.95312 0.0585938L9.73535 1.14746Z" />
                                </svg>
                            </a>
                        </div>

                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No blogs found.</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($blogs->hasPages())
            <div class="pagination-area mt-60 wow animate fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                <div class="paginations-button">
                    @if($blogs->onFirstPage())
                    <span class="disabled">
                        <svg width="10" height="10" viewBox="0 0 10 10" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.86133 9.28516C7.14704 7.49944 3.57561 5.71373 1.43276 4.99944C3.57561 4.28516 6.7899 3.21373 7.86133 0.713728" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        Prev
                    </span>
                    @else
                    <a href="{{ $blogs->previousPageUrl() }}">
                        <svg width="10" height="10" viewBox="0 0 10 10" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.86133 9.28516C7.14704 7.49944 3.57561 5.71373 1.43276 4.99944C3.57561 4.28516 6.7899 3.21373 7.86133 0.713728" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        Prev
                    </a>
                    @endif
                </div>

                <ul class="paginations">
                    @for($i = 1; $i <= $blogs->lastPage(); $i++)
                        <li class="page-item {{ $blogs->currentPage() == $i ? 'active' : '' }}">
                            <a href="{{ $blogs->url($i) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</a>
                        </li>
                        @endfor
                </ul>

                <div class="paginations-button">
                    @if($blogs->hasMorePages())
                    <a href="{{ $blogs->nextPageUrl() }}">
                        Next
                        <svg width="10" height="10" viewBox="0 0 10 10" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.42969 9.28613C2.14397 7.50042 5.7154 5.7147 7.85826 5.00042C5.7154 4.28613 2.50112 3.21471 1.42969 0.714705" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </a>
                    @else
                    <span class="disabled">
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
@endsection