<!doctype html>
<html lang="en">


<!-- Mirrored from demo.egenslab.com//html/gofly/preview/travel-agency-02.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Feb 2026 10:37:45 GMT -->

<head>
 <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Title -->
<title>{{ $meta->meta_title ?? 'GikiJoy - Tour & Travel Booking Website.' }}</title>
<!-- Meta -->
<meta name="description" content="{{ $meta->meta_description ?? 'Tour & Travel Booking Website' }}">
<meta name="keywords" content="{{ $meta->meta_keywords ?? '' }}">

<!-- Favicon -->
@if(!empty($meta?->shortcut_icon))
<link rel="icon" type="image/jpeg" href="{{ asset('admin-assets/home/Meta/' . $meta->shortcut_icon) }}">
<link rel="shortcut icon" type="image/jpeg" href="{{ asset('admin-assets/home/Meta/' . $meta->shortcut_icon) }}">
<link rel="apple-touch-icon" href="{{ asset('admin-assets/home/Meta/' . $meta->shortcut_icon) }}">
@else
<link rel="icon" type="image/jpeg" sizes="32x32" href="https://gikijoygetaways.com/assets/img/shortcut.jpeg">
<link rel="shortcut icon" type="image/jpeg" href="https://gikijoygetaways.com/assets/img/shortcut.jpeg">
@endif

<!-- Open Graph / WhatsApp / Facebook Share -->
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $meta->meta_title ?? 'GikiJoy - Tour & Travel Booking Website.' }}">
<meta property="og:description" content="{{ $meta->meta_description ?? 'Tour & Travel Booking Website' }}">
<meta property="og:url" content="{{ url()->current() }}">

<meta property="og:image" content="{{ !empty($meta?->shortcut_icon) ? asset('admin-assets/home/Meta/' . $meta->shortcut_icon) : 'https://gikijoygetaways.com/assets/img/shortcut.jpeg' }}">
<meta property="og:image:secure_url" content="{{ !empty($meta?->shortcut_icon) ? asset('admin-assets/home/Meta/' . $meta->shortcut_icon) : 'https://gikijoygetaways.com/assets/img/shortcut.jpeg' }}">
<meta property="og:image:type" content="image/jpeg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $meta->meta_title ?? 'GikiJoy - Tour & Travel Booking Website.' }}">
<meta name="twitter:description" content="{{ $meta->meta_description ?? 'Tour & Travel Booking Website' }}">
<meta name="twitter:image" content="{{ !empty($meta?->shortcut_icon) ? asset('admin-assets/home/Meta/' . $meta->shortcut_icon) : 'https://gikijoygetaways.com/assets/img/shortcut.jpeg' }}">

<!-- CSS and JS (Theme untouched) -->
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/jquery-ui.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/jquery.fancybox.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/slick-theme.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">
<link href="{{ asset('assets/css/boxicons.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    @yield('css')
    <style>
        @media (max-width: 576px) {
            .footer-section.two .footer-menu-wrap {
                padding: 30px 0 50px !important;
            }
        }

        .float-contact-wrap {
            position: fixed;
            bottom: 28px;
            right: 24px;
            z-index: 99999;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 14px;
        }

        .float-btn {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none !important;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.18);
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative;
        }

        .float-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 32px rgba(0, 0, 0, 0.25);
        }

        .float-btn-wa {
            background: linear-gradient(135deg, #25D366, #128C7E);
        }

        .float-btn-call {
            background: linear-gradient(135deg, #22c55e, #16a34a);
        }

        .float-btn-wa::before {
            content: '';
            position: absolute;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: rgba(37, 211, 102, 0.35);
            animation: float-pulse 2s ease-out infinite;
            pointer-events: none;
        }

        .float-btn-call::before {
            content: '';
            position: absolute;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: rgba(34, 197, 94, 0.35);
            animation: float-pulse 2s ease-out infinite 0.5s;
            pointer-events: none;
        }

        @keyframes float-pulse {
            0% {
                transform: scale(1);
                opacity: 0.7;
            }

            100% {
                transform: scale(1.9);
                opacity: 0;
            }
        }

        @media (max-width: 576px) {
            .float-contact-wrap {
                bottom: 16px;
                right: 14px;
                gap: 12px;
            }

            .float-btn {
                width: 50px;
                height: 50px;
            }
        }
    </style>

   
</head>

<body class="tt-magic-cursor">

    <div id="magic-cursor">
        <div id="ball"></div>
    </div>

    <!-- Back To Top -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
        <svg class="arrow" width="22" height="25" viewBox="0 0 24 23" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M0.556131 11.4439L11.8139 0.186067L13.9214 2.29352L13.9422 20.6852L9.70638 20.7061L9.76793 8.22168L3.6064 14.4941L0.556131 11.4439Z" />
            <path d="M23.1276 11.4999L16.0288 4.40105L15.9991 10.4203L20.1031 14.5243L23.1276 11.4999Z" />
        </svg>
    </div>

    @include('frontend.includes.header')
    @yield('content')
    @include('frontend.includes.footer')

    <div class="float-contact-wrap">

        <a href="https://wa.me/919194021976" target="_blank" rel="noopener" class="float-btn float-btn-wa" title="Chat on WhatsApp">
            <svg width="26" height="26" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill="#fff" d="M16 2C8.268 2 2 8.268 2 16c0 2.47.664 4.788 1.822 6.782L2 30l7.418-1.795A13.93 13.93 0 0016 30c7.732 0 14-6.268 14-14S23.732 2 16 2zm0 25.6a11.56 11.56 0 01-5.892-1.608l-.422-.25-4.4 1.065 1.1-4.28-.276-.44A11.56 11.56 0 014.4 16C4.4 9.593 9.593 4.4 16 4.4S27.6 9.593 27.6 16 22.407 27.6 16 27.6zm6.338-8.674c-.347-.174-2.056-1.014-2.375-1.13-.318-.116-.55-.174-.781.174-.23.347-.898 1.13-1.1 1.362-.202.231-.404.26-.75.087-.347-.174-1.463-.54-2.786-1.72-1.03-.92-1.726-2.056-1.928-2.403-.202-.347-.022-.534.152-.707.156-.155.347-.405.52-.608.174-.202.231-.347.347-.578.116-.231.058-.434-.029-.608-.087-.174-.781-1.883-1.07-2.578-.282-.677-.569-.585-.781-.596l-.665-.012c-.231 0-.608.087-.927.434-.318.347-1.215 1.188-1.215 2.896s1.244 3.357 1.418 3.588c.174.231 2.45 3.74 5.936 5.244.83.358 1.477.572 1.982.732.832.265 1.59.228 2.188.138.668-.1 2.056-.84 2.347-1.652.29-.812.29-1.508.202-1.652-.087-.144-.318-.231-.665-.405z" />
            </svg>
        </a>

        <a href="tel:+919194021976" class="float-btn float-btn-call" title="Call Us">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 10.8 19.79 19.79 0 01.12 2.18 2 2 0 012.11 0h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 14.92z" />
            </svg>
        </a>

    </div>
    <!--  Main jQuery  -->
    <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/daterangepicker.min.js') }}"></script>

    <!-- Popper and Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <!-- Swiper slider JS -->
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.js') }}"></script>
    <!-- Waypoints JS -->
    <script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
    <!-- Counterup JS -->
    <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
    <!-- Wow JS -->
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <!-- Gsap  JS -->
    <script src="{{ asset('assets/js/gsap.min.js') }}"></script>
    <script src="{{ asset('assets/js/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('assets/js/select-dropdown.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"version":"2024.11.0","token":"70834e4b23964a2eaf7cf4ec0e5e9a84","r":1,"server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}' crossorigin="anonymous"></script>
    @yield('js')

</body>


<!-- Mirrored from demo.egenslab.com//html/gofly/preview/travel-agency-02.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Feb 2026 10:37:54 GMT -->

</html>