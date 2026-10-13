@extends('frontend.layout.master')
@section('css')
<style>
    /* ── Meta ─────────────────────────────── */
    .blog-detail-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
        margin-bottom: 10px;
    }

    .bd-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        color: #666;
    }

    .bd-meta-item svg {
        fill: var(--primary-color, #ff6b35);
    }

    /* ── Main image ───────────────────────── */
    .inspiration-image img {
        border-radius: 12px;
        width: 100%;
        object-fit: cover;
        max-height: 480px;
    }

    /* ── Full content ─────────────────────── */
    .blog-full-content {
        font-size: 15px;
        line-height: 1.85;
        color: #444;
    }

    .blog-full-content p {
        margin-bottom: 18px;
    }

    .blog-full-content h2,
    .blog-full-content h3,
    .blog-full-content h4 {
        margin: 28px 0 12px;
        font-weight: 700;
        color: #1a1a2e;
    }

    .blog-full-content img {
        max-width: 100%;
        border-radius: 8px;
        margin: 18px 0;
    }

    .blog-full-content ul,
    .blog-full-content ol {
        padding-left: 22px;
        margin-bottom: 18px;
    }

    .blog-full-content a {
        color: var(--primary-color, #ff6b35);
    }

    /* ── Related blog desc clamp ──────────── */
    .related-desc {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* ── Recent post widget ───────────────── */
    .recent-post-widget {
        display: flex;
        gap: 14px;
        align-items: flex-start;
    }

    .recent-post-img {
        flex-shrink: 0;
        width: 75px;
        height: 62px;
        border-radius: 8px;
        overflow: hidden;
    }

    .recent-post-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .recent-post-img:hover img {
        transform: scale(1.08);
    }

    .recent-post-content {
        flex: 1;
    }

    .recent-post-content>a {
        font-size: 12px;
        color: #aaa;
        display: block;
        margin-bottom: 4px;
        text-decoration: none;
    }

    .recent-post-content h6 {
        font-size: 14px;
        font-weight: 600;
        line-height: 1.45;
        margin: 0;
    }

    .recent-post-content h6 a {
        color: #1a1a2e;
        text-decoration: none;
        transition: color 0.2s;
    }

    .recent-post-content h6 a:hover {
        color: var(--primary-color, #ff6b35);
    }
</style>
@endsection
@section('content')
<!-- Breadcrumb section Start-->
<div class="breadcrumb-section" style="background-image:linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)), url({{ asset('assets/img/innerpages/breadcrumb-bg2.jpg') }});">
    <div class="container">
        <div class="banner-content">
            <h1>{{ Str::limit($blog->title, 60) }}</h1>
            <ul class="breadcrumb-list">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/blog-list') }}">Travel Inspiration</a></li>
                <li>{{ Str::limit($blog->title, 40) }}</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb section End-->

<!-- Inspiration Details Page Start-->
<div class="inspiration-details-page pt-100 mb-100">
    <div class="container">
        <div class="row g-lg-4 gy-5 justify-content-between">

            {{-- ===================== LEFT: Blog Detail ===================== --}}
            <div class="col-xl-8 col-lg-8">
                <div class="inspiration-details">

                    {{-- Title --}}
                    <h2>{{ $blog->title }}</h2>
                    <span class="line-break"></span>

                    {{-- Meta: Location + Date --}}
                    <div class="blog-detail-meta">
                        <span class="bd-meta-item">
                            <svg width="15" height="15" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.81273 0C4.31731 0 1.47302 2.84433 1.47302 6.34163C1.47302 9.07242 5.28467 13.5258 6.92353 15.3136C7.15049 15.5628 7.47603 15.7042 7.81273 15.7042C8.14943 15.7042 8.47497 15.5628 8.70193 15.3136C10.3408 13.5258 14.1524 9.07238 14.1524 6.34163C14.1524 2.84433 11.3081 0 7.81273 0Z" />
                            </svg>
                            {{ $blog->location ?? 'Travel' }}
                        </span>
                        <span class="bd-meta-item">
                            <svg width="15" height="15" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.833313 13.0002V4.3335C0.833666 3.67056 1.09717 3.03488 1.56594 2.56612C2.0347 2.09735 2.67038 1.83385 3.33331 1.8335H5.49998V3.66683C5.49998 3.93205 5.71476 4.16683 5.99998 4.16683C6.2852 4.16683 6.49998 3.93205 6.49998 3.66683V1.8335H10.8333V3.66683C10.8333 3.93205 11.0481 4.16683 11.3333 4.16683C11.6185 4.16683 11.8333 3.93205 11.8333 3.66683V1.8335H12.6666C13.3296 1.83385 13.9653 2.09735 14.434 2.56612C14.9028 3.03488 15.1663 3.67056 15.1666 4.3335V13.0002C15.1663 13.6631 14.9028 14.2988 14.434 14.7675C13.9653 15.2363 13.3296 15.4998 12.6666 15.5002H3.33331C2.67038 15.4998 2.0347 15.2363 1.56594 14.7675C1.09717 14.2988 0.833666 13.6631 0.833313 13.0002ZM1.83331 6.50016V13.0002C1.83331 13.7366 2.59696 14.5002 3.33331 14.5002H12.6666C13.403 14.5002 14.1666 13.7366 14.1666 13.0002V6.50016H1.83331Z" />
                            </svg>
                            {{ \Carbon\Carbon::parse($blog->date)->format('d F, Y') }}
                        </span>
                    </div>
                    <span class="line-break"></span>

                    {{-- Short Description --}}
                    <p>{{ $blog->short_description }}</p>
                    <span class="line-break"></span>
                    <span class="line-break"></span>

                    {{-- Main Image --}}
                    <div class="inspiration-image mb-50">
                        <img src="{{ asset('admin-assets/home/Blog/' . $blog->image) }}"
                            alt="{{ $blog->title }}"
                            style="width:100%; border-radius:12px; object-fit:cover; max-height:480px;">
                    </div>

                    {{-- Full Description --}}
                     <div class="blog-full-content">
                        @php
                        echo $blog->description;
                        @endphp
                    </div>

                    <span class="line-break"></span>
                    <span class="line-break"></span>

                    {{-- Tag & Share --}}
                    <div class="tag-and-social-area">
                        <div class="tag-area">
                            <h6>Tag:</h6>
                            <ul class="tag-list">
                                <li><a href="{{ url('/blog-list') }}">{{ $blog->location ?? 'Travel' }}</a></li>
                                <li><a href="{{ url('/blog-list') }}">Travel</a></li>
                                <li><a href="{{ url('/blog-list') }}">Explore</a></li>
                            </ul>
                        </div>
                        <div class="social-area">
                            <h6>Share:</h6>
                            <ul class="social-list">
                                <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"><i class="bx bxl-facebook"></i></a></li>
                                <li><a href="https://x.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($blog->title) }}" target="_blank"><i class="bi bi-twitter-x"></i></a></li>
                                <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}" target="_blank"><i class="bx bxl-linkedin"></i></a></li>
                                <li><a href="https://www.instagram.com/" target="_blank"><i class="bx bxl-instagram-alt"></i></a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ===================== RIGHT: Sidebar ===================== --}}
            <div class="col-lg-4">
                <div class="blog-sidebar-area">

                    {{-- Search Widget --}}
                    <div class="search-widget mb-40">
                        <form action="{{ url('/blog-list') }}" method="GET">
                            <div class="search-box">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.8044 14.8845L13.0544 12.197L12.9901 12.0992C12.8689 11.9797 12.7055 11.9127 12.5354 11.9127C12.3652 11.9127 12.2018 11.9797 12.0807 12.0992C9.74349 14.2433 6.14318 14.3595 3.66568 12.3714C1.18818 10.3833 0.604738 6.90545 2.30068 4.24732C3.99661 1.5892 7.44661 0.572634 10.3632 1.87232C13.2797 3.17201 14.7551 6.38638 13.8126 9.38138C13.7793 9.48804 13.7754 9.60167 13.8012 9.71037C13.827 9.81907 13.8815 9.91883 13.9591 9.9992C14.0375 10.081 14.1358 10.1411 14.2444 10.1736C14.3529 10.2061 14.468 10.21 14.5785 10.1848C14.6884 10.1606 14.79 10.108 14.8732 10.0322C14.9564 9.95643 15.0183 9.86013 15.0526 9.75295C16.1776 6.19888 14.4782 2.37388 11.0526 0.752946C7.62693 -0.867991 3.50474 0.199821 1.3513 3.26763C-0.802137 6.33545 -0.339949 10.4808 2.43911 13.0229C5.21818 15.5651 9.47974 15.7398 12.4688 13.4367L14.9038 15.8173C15.026 15.9348 15.189 16.0004 15.3585 16.0004C15.528 16.0004 15.6909 15.9348 15.8132 15.8173C15.9349 15.6953 16.0035 15.5306 16.0016 15.3595L15.8044 14.8845Z" fill="#110F0F" />
                                </svg>
                                <input type="text" name="search" placeholder="Search blogs...">
                            </div>
                        </form>
                    </div>

                    {{-- Recent Posts Widget --}}
                    <div class="single-widget mb-40">
                        <h5 class="widget-title">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.9688 11C20.9726 12.1773 20.9019 13.3538 20.7569 14.5221C20.1691 19.1327 18.5625 20.9688 18.5625 20.9688H1.03125V18.9062C14.1316 17.7671 11.6596 7.89809 10.4264 4.54609C10.1607 4.50672 9.89326 4.48091 9.625 4.46875C9.625 4.46875 4.46875 4.125 4.8125 8.25C4.8125 8.25 2.0625 7.5625 2.75 4.8125C3.4375 2.0625 6.1875 2.75 6.1875 2.75C6.1875 2.75 6.875 1.03125 9.28125 1.03125C11.6875 1.03125 12.7188 3.09375 12.7188 3.09375C14.4375 1.03125 20.9688 3.78125 20.9688 11Z" />
                            </svg>
                            Recent Post
                        </h5>

                        @forelse($recentBlogs as $recent)
                        <div class="recent-post-widget mb-30">
                            <div class="recent-post-img">
                                <a href="{{ url('blog-details', $recent->id) }}">
                                    <img src="{{ asset('admin-assets/home/Blog/' . $recent->image) }}"
                                        alt="{{ $recent->title }}">
                                </a>
                            </div>
                            <div class="recent-post-content">
                                <a href="{{ url('blog-details', $recent->id) }}">
                                    {{ \Carbon\Carbon::parse($recent->date)->format('d F, Y') }}
                                </a>
                                <h6>
                                    <a href="{{ url('blog-details', $recent->id) }}">
                                        {{ Str::limit($recent->title, 50) }}
                                    </a>
                                </h6>
                            </div>
                        </div>
                        @empty
                        <p class="text-muted small">No recent posts.</p>
                        @endforelse
                    </div>

                    {{-- Tags Widget --}}
                    <div class="single-widget">
                        <h5 class="widget-title">Discover By Tags</h5>
                        <ul class="tag-list">
                            <li><a href="{{ url('/blog-list') }}">Adventure</a></li>
                            <li><a href="{{ url('/blog-list') }}">Family Travel</a></li>
                            <li><a href="{{ url('/blog-list') }}">Activities</a></li>
                            <li><a href="{{ url('/blog-list') }}">Wildlife</a></li>
                            <li><a href="{{ url('/blog-list') }}">Historical</a></li>
                            <li><a href="{{ url('/blog-list') }}">Cruises</a></li>
                            <li><a href="{{ url('/blog-list') }}">Cultural</a></li>
                            <li><a href="{{ url('/blog-list') }}">Beach & Island</a></li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- Inspiration Details Page End-->

<!-- Related Blogs Section Start-->
@if($relatedBlogs->count() > 0)
<div class="related-inspiration-section pt-100 mb-100">
    <div class="container">
        <div class="row justify-content-center mb-50 wow animate fadeInDown" data-wow-delay="200ms" data-wow-duration="1500ms">
            <div class="col-xl-6 col-lg-8">
                <div class="section-title text-center">
                    <h2>You May Also Like</h2>
                    <p>A curated list of the most popular travel packages based on different destinations.</p>
                </div>
            </div>
        </div>
        <div class="swiper home7-blog-slider">
            <div class="swiper-wrapper">
                @foreach($relatedBlogs as $related)
                <div class="swiper-slide">
                    <div class="blog-card2 two">
                        <div class="blog-img-wrap">
                            <a href="{{ url('blog-details', $related->id) }}" class="blog-img">
                                <img src="{{ asset('admin-assets/home/Blog/' . $related->image) }}"
                                    alt="{{ $related->title }}">
                            </a>
                            <a href="{{ url('blog-details', $related->id) }}" class="location">
                                <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <path d="M6.83615 0C3.77766 0 1.28891 2.48879 1.28891 5.54892C1.28891 7.93837 4.6241 11.8351 6.05811 13.3994C6.25669 13.6175 6.54154 13.7411 6.83615 13.7411C7.13076 13.7411 7.41561 13.6175 7.6142 13.3994C9.04821 11.8351 12.3834 7.93833 12.3834 5.54892C12.3834 2.48879 9.89464 0 6.83615 0Z" />
                                </svg>
                                {{ $related->location ?? 'Travel' }}
                            </a>
                        </div>
                        <div class="blog-content">
                            <a href="{{ url('blog-details', $related->id) }}" class="blog-date">
                                {{ \Carbon\Carbon::parse($related->date)->format('d F, Y') }}
                            </a>
                            <h4>
                                <a href="{{ url('blog-details', $related->id) }}">
                                    {{ $related->title }}
                                </a>
                            </h4>
                            <p class="related-desc">{{ $related->short_description }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
@endsection