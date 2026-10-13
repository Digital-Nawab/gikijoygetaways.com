<!-- header Section Start-->
@php
$states = \App\Models\State::where('status', 1)->latest()->take(5)->get();
@endphp
<header class="header-area style-2">
    <div class="container d-flex flex-nowrap align-items-center justify-content-between">
        <div class="logo-and-menu-area">
            <a href="{{url('/')}}" class="header-logo">
                <img src="{{asset('assets/img/logo.png')}}" alt="">
            </a>
            <div class="main-menu">
                <div class="mobile-logo-area d-xl-none d-flex align-items-center justify-content-between">
                    <a href="{{url('/')}}" class="mobile-logo-wrap">
                        <img src="{{asset('assets/img/logo.png')}}" alt="">
                    </a>
                    <div class="menu-close-btn">
                        <i class="bi bi-x"></i>
                    </div>
                </div>
                <ul class="menu-list">
                    <li class="menu-item-has-children active">
                        <a href="{{url('/')}}" class="drop-down">
                            Home
                        </a>
                    </li>
                    <li><a href="{{url('/about')}}">About</a></li>
                   
                    <li class="menu-item-has-children">
                        <a href="{{url('/travel-package')}}" class="drop-down">
                            Our State
                            <i class="bi bi-caret-down-fill"></i>
                        </a>

                        <i class="bi bi-plus dropdown-icon"></i>

                         <ul class="sub-menu">
                            @foreach($states as $state)
                            <li>
                                <a href="{{ url('/travel-package/' . $state->slug) }}">
                                    {{ $state->state_name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                     <li class="menu-item-has-children">
                        <a href="{{url('/travel-package')}}" class="drop-down">
                            Travel Package
                            <i class="bi bi-caret-down-fill"></i>
                        </a>
                        <i class="bi bi-plus dropdown-icon"></i>
                        <ul class="sub-menu">
                            <li><a href="{{url('/travel-package')}}">Travel Package </a></li>

                        </ul>
                    </li>
                 <li><a href="{{url('/blog-list')}}">Blog</a></li>
                </ul>
                <div class="contact-area d-xl-none d-flex">
                    <div class="icon">
                        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <path
                                    d="M15.5646 11.7424L13.3317 9.50954C12.5343 8.7121 11.1786 9.03111 10.8596 10.0678C10.6204 10.7855 9.82296 11.1842 9.10526 11.0247C7.51037 10.626 5.35726 8.55261 4.95854 6.87797C4.71931 6.16024 5.19778 5.36279 5.91548 5.12359C6.95216 4.80461 7.27113 3.44895 6.47369 2.65151L4.24084 0.418659C3.60288 -0.139553 2.64595 -0.139553 2.08774 0.418659L0.572591 1.93381C-0.942555 3.5287 0.73208 7.75516 4.48007 11.5032C8.22807 15.2512 12.4545 17.0056 14.0494 15.4106L15.5646 13.8955C16.1228 13.2575 16.1228 12.3006 15.5646 11.7424Z" />
                            </g>
                        </svg>
                    </div>
                    <div class="content">
                        <span>Need Help?</span>
                        <a href="tel:+91 91940 21976">+91 91940 21976</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="nav-right">
            <div class="contact-and-search-area">
                <div class="contact-area d-xl-flex d-none">
                    <div class="icon">
                        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <path
                                    d="M15.5646 11.7424L13.3317 9.50954C12.5343 8.7121 11.1786 9.03111 10.8596 10.0678C10.6204 10.7855 9.82296 11.1842 9.10526 11.0247C7.51037 10.626 5.35726 8.55261 4.95854 6.87797C4.71931 6.16024 5.19778 5.36279 5.91548 5.12359C6.95216 4.80461 7.27113 3.44895 6.47369 2.65151L4.24084 0.418659C3.60288 -0.139553 2.64595 -0.139553 2.08774 0.418659L0.572591 1.93381C-0.942555 3.5287 0.73208 7.75516 4.48007 11.5032C8.22807 15.2512 12.4545 17.0056 14.0494 15.4106L15.5646 13.8955C16.1228 13.2575 16.1228 12.3006 15.5646 11.7424Z" />
                            </g>
                        </svg>
                    </div>
                    <div class="content">
                        <span>Need Help?</span>
                        <a href="tel:+91 91940 21976">+91 91940 21976</a>
                    </div>
                </div>

            </div>

            <div class="sidebar-button mobile-menu-btn">
                <svg width="20" height="18" viewBox="0 0 20 18" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.29445 2.8421H10.5237C11.2389 2.8421 11.8182 2.2062 11.8182 1.42105C11.8182 0.635903 11.2389 0 10.5237 0H1.29445C0.579249 0 0 0.635903 0 1.42105C0 2.2062 0.579249 2.8421 1.29445 2.8421Z"></path>
                    <path d="M1.23002 10.421H18.77C19.4496 10.421 20 9.78506 20 8.99991C20 8.21476 19.4496 7.57886 18.77 7.57886H1.23002C0.550421 7.57886 0 8.21476 0 8.99991C0 9.78506 0.550421 10.421 1.23002 10.421Z"></path>
                    <path d="M18.8052 15.1579H10.2858C9.62563 15.1579 9.09094 15.7938 9.09094 16.5789C9.09094 17.3641 9.62563 18 10.2858 18H18.8052C19.4653 18 20 17.3641 20 16.5789C20 15.7938 19.4653 15.1579 18.8052 15.1579Z"></path>
                </svg>
            </div>
        </div>
    </div>
</header>

<!-- header Section End-->