<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Sidebar collapsed state */
        .sidebar-collapsed {
            width: 64px !important;
        }
        .sidebar-collapsed .sidebar-label,
        .sidebar-collapsed .sidebar-user-info,
        .sidebar-collapsed .sidebar-section-title,
        .sidebar-collapsed .sidebar-logo-text {
            display: none !important;
        }
        .sidebar-collapsed .sidebar-nav-link {
            justify-content: center !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        .sidebar-collapsed .sidebar-user-block {
            justify-content: center !important;
            padding: 12px 0 !important;
        }
        .sidebar-collapsed .sidebar-logo-block {
            justify-content: center !important;
            padding: 12px 0 !important;
        }
        .sidebar-collapsed .sidebar-logout-text {
            display: none !important;
        }
        .sidebar-collapsed .sidebar-logout-btn {
            padding-left: 0 !important;
            padding-right: 0 !important;
            justify-content: center !important;
        }

        /* Transition */
        aside {
            transition: width 0.25s ease;
        }

        /* Main area shift */
        .main-area {
            transition: margin-left 0.25s ease;
        }
        .main-area-collapsed {
            margin-left: 64px !important;
        }

        /* Tooltip on hover when collapsed */
        .sidebar-collapsed .nav-tooltip {
            display: block !important;
        }
        .nav-tooltip {
            display: none;
            position: absolute;
            left: 70px;
            top: 50%;
            transform: translateY(-50%);
            background: #1e293b;
            color: #e2e8f0;
            font-size: 12px;
            white-space: nowrap;
            padding: 4px 10px;
            border-radius: 6px;
            pointer-events: none;
            z-index: 9999;
            border: 1px solid #334155;
        }
    </style>
</head>

<body class="bg-slate-100 text-slate-800 min-h-screen">

    <div class="flex min-h-screen">

        {{-- ===== SIDEBAR (DARK) ===== --}}
        <aside id="sidebar" class="w-64 bg-slate-900 flex flex-col shadow-2xl border-r border-slate-800 fixed top-0 left-0 h-screen z-50">

            {{-- Logo --}}
            <div class="px-6 py-5 border-b border-slate-800 flex items-center gap-3 sidebar-logo-block">
                <img src="{{ asset('assets/img/logo.png') }}" class="brightness-0 invert sidebar-logo-text" alt="">
                {{-- Toggle Button --}}
                <button onclick="toggleSidebar()" id="toggleBtn"
                    class="ml-auto w-7 h-7 rounded-lg bg-slate-800 border border-slate-700 flex items-center justify-center text-slate-400 hover:text-white hover:bg-slate-700 transition flex-shrink-0"
                    title="Toggle Sidebar">
                    <svg id="toggleIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7M18 19l-7-7 7-7" />
                    </svg>
                </button>
            </div>

            {{-- User Info --}}
            <div class="px-5 py-4 border-b border-slate-800 flex items-center gap-3 sidebar-user-block">
                <div class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-semibold text-sm flex-shrink-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="sidebar-user-info">
                    <p class="text-sm font-medium text-white leading-tight">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-slate-400 truncate max-w-[130px]">{{ Auth::user()->email }}</p>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 px-4 py-5 space-y-1 overflow-y-auto">

                <p class="text-xs text-slate-500 uppercase tracking-widest px-3 mb-2 sidebar-section-title">Dashboard</p>
                 <a href="{{ route('admin.meta.index') }}"
                    class="relative flex items-center gap-3 px-3 py-2 rounded-xl text-sm sidebar-nav-link
                    {{ request()->routeIs('admin.meta.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}">

                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12A9 9 0 1112 3a9 9 0 019 9z" />
                    </svg>

                    <span class="sidebar-label">Meta SEO</span>

                    <span class="nav-tooltip">Meta SEO</span>
                </a>
                <a href="{{ route('admin.package.booking.index') }}"
                    class="relative flex items-center gap-3 px-3 py-2 rounded-xl text-sm sidebar-nav-link
                        {{ request()->routeIs('admin.package.booking.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    <span class="sidebar-label">Hotel Bookings Enquiry</span>
                    <span class="nav-tooltip">Hotel Bookings Enquiry</span>
                </a>

                <a href="{{ route('admin.contact.index') }}"
                    class="relative flex items-center gap-3 px-3 py-2 rounded-xl text-sm sidebar-nav-link
                    {{ request()->routeIs('admin.contact.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 8V7a2 2 0 00-2-2H5a2 2 0 00-2 2v1m18 0v9a2 2 0 01-2 2H5a2 2 0 01-2-2V8m18 0l-9 6-9-6" />
                    </svg>
                    <span class="sidebar-label">Contact Enquiries</span>
                    <span class="nav-tooltip">Contact Enquiries</span>
                </a>

                <a href="{{ route('admin.transactions.index') }}"
                    class="relative flex items-center gap-3 px-3 py-2 rounded-xl text-sm sidebar-nav-link
                    {{ request()->routeIs('admin.transactions.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    <span class="sidebar-label">Transactions</span>
                    <span class="nav-tooltip">Transactions</span>
                </a>

                <a href="{{ route('admin.marquee') }}"
                    class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition duration-200 sidebar-nav-link
                    {{ request()->routeIs('admin.marquee') ? 'bg-indigo-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                    </svg>
                    <span class="sidebar-label">Marquee</span>
                    <span class="nav-tooltip">Marquee</span>
                </a>

                <a href="{{ route('admin.slider.index') }}"
                    class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition duration-200 sidebar-nav-link
                    {{ request()->routeIs('admin.slider.*') ? 'bg-indigo-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="sidebar-label">Slider</span>
                    <span class="nav-tooltip">Slider</span>
                </a>

                <a href="{{ route('admin.offer.index') }}"
                    class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition duration-200 sidebar-nav-link
                    {{ request()->routeIs('admin.offer.*') ? 'bg-indigo-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <span class="sidebar-label">Offer</span>
                    <span class="nav-tooltip">Offer</span>
                </a>

                <a href="{{ route('admin.country.index') }}"
                    class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition duration-200 sidebar-nav-link
                        {{ request()->routeIs('admin.Country.*') ? 'bg-indigo-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5h18M3 12h18M3 19h18" />
                    </svg>
                    <span class="sidebar-label">Country</span>
                    <span class="nav-tooltip">Country</span>
                </a>

                <a href="{{ route('admin.state.index') }}"
                    class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition duration-200 sidebar-nav-link
                    {{ request()->routeIs('admin.state.*') ? 'bg-indigo-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 2l4 4-4 4-4-4 4-4zM2 12l4-4 4 4-4 4-4-4zM12 22l-4-4 4-4 4 4-4 4zM22 12l-4 4-4-4 4-4 4 4z" />
                    </svg>
                    <span class="sidebar-label">State</span>
                    <span class="nav-tooltip">State</span>
                </a>

                <a href="{{ route('admin.city.index') }}"
                    class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition duration-200 sidebar-nav-link
                    {{ request()->routeIs('admin.city.*') ? 'bg-indigo-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 3l14 9-14 9V3z" />
                    </svg>
                    <span class="sidebar-label">City</span>
                    <span class="nav-tooltip">City</span>
                </a>

                <a href="{{ route('admin.package.index') }}"
                    class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition duration-200 sidebar-nav-link
                    {{ request()->routeIs('admin.package.*') ? 'bg-indigo-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span class="sidebar-label">Hotel</span>
                    <span class="nav-tooltip">Hotel</span>
                </a>

                <a href="{{ route('admin.blog.index') }}"
                    class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition duration-200 sidebar-nav-link
                    {{ request()->routeIs('admin.blog.*') ? 'bg-indigo-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z" />
                    </svg>
                    <span class="sidebar-label">Blog</span>
                    <span class="nav-tooltip">Blog</span>
                </a>

                <a href="{{ route('admin.tourist.index') }}"
                    class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition duration-200 sidebar-nav-link
                    {{ request()->routeIs('admin.tourist.*') ? 'bg-indigo-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 20l-5.447-2.724A2 2 0 013 15.382V5a2 2 0 012-2h14a2 2 0 012 2v10.382a2 2 0 01-1.553 1.894L15 20m-6 0v-6m6 6v-6m0 0l-3-3m3 3l3-3" />
                    </svg>
                    <span class="sidebar-label">Tourist Places</span>
                    <span class="nav-tooltip">Tourist Places</span>
                </a>

            </nav>

            {{-- Logout at bottom of sidebar --}}
            <div class="px-4 pb-4 border-t border-slate-800 pt-4">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="sidebar-logout-btn w-full bg-red-600 hover:bg-red-500 text-white py-2.5 rounded-xl text-sm font-medium transition duration-200 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span class="sidebar-logout-text">Logout</span>
                    </button>
                </form>
            </div>

        </aside>

        {{-- ===== MAIN AREA ===== --}}
        <div id="mainArea" class="flex-1 flex flex-col ml-64 main-area">

            {{-- ===== HEADER (DARK) ===== --}}
            <header class="sticky top-0 z-40 bg-slate-900 border-b border-slate-800 px-6 py-3 flex items-center justify-between">

                {{-- Breadcrumb --}}
                <div class="flex items-center gap-2 text-sm text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Home</span>
                    <span class="text-slate-600">›</span>
                    <span class="text-slate-200 font-medium">@yield('breadcrumb', 'Dashboard')</span>
                </div>

                {{-- Right side --}}
                <div class="flex items-center gap-3">

                    {{-- Search --}}
                    <div class="hidden md:flex items-center bg-slate-800 rounded-xl px-3 py-2 gap-2 border border-slate-700">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" placeholder="Search..."
                            class="bg-transparent text-sm text-slate-300 placeholder-slate-500 outline-none w-36">
                    </div>

                    {{-- New Leads Badge --}}
                    <span class="bg-indigo-900/60 text-indigo-300 text-xs font-medium px-3 py-1.5 rounded-full border border-indigo-700/60">
                        Today Leads &nbsp;<strong class="text-indigo-100">27</strong>
                    </span>

                    {{-- Notification Bell --}}
                    <button class="w-9 h-9 rounded-xl bg-slate-800 border border-slate-700 flex items-center justify-center text-slate-400 hover:text-white hover:bg-slate-700 transition relative">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    {{-- User Avatar --}}
                    <div class="flex items-center gap-2 pl-1">
                        <div class="w-9 h-9 rounded-full bg-indigo-600 flex items-center justify-center text-white text-sm font-semibold ring-2 ring-indigo-500/30">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="hidden md:block">
                            <p class="text-xs font-medium text-white leading-tight">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-400">Manager</p>
                        </div>
                    </div>

                </div>
            </header>

            {{-- ===== PAGE CONTENT (LIGHT) ===== --}}
            <main class="flex-1 p-6 bg-slate-100 text-slate-800">
                @yield('content')
            </main>

        </div>

    </div>

    <script>
        let isCollapsed = false;

        // On page load, check saved state
        window.addEventListener('DOMContentLoaded', function () {
            const saved = localStorage.getItem('sidebarCollapsed');
            if (saved === 'true') {
                isCollapsed = true;
                applySidebarState();
            }
        });

        function toggleSidebar() {
            isCollapsed = !isCollapsed;
            localStorage.setItem('sidebarCollapsed', isCollapsed);
            applySidebarState();
        }

        function applySidebarState() {
            const sidebar = document.getElementById('sidebar');
            const mainArea = document.getElementById('mainArea');
            const icon = document.getElementById('toggleIcon');

            if (isCollapsed) {
                sidebar.classList.add('sidebar-collapsed');
                mainArea.classList.add('main-area-collapsed');
                mainArea.classList.remove('ml-64');
                // Change icon to expand arrows
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M6 5l7 7-7 7" />';
            } else {
                sidebar.classList.remove('sidebar-collapsed');
                mainArea.classList.remove('main-area-collapsed');
                mainArea.classList.add('ml-64');
                // Change icon to collapse arrows
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7M18 19l-7-7 7-7" />';
            }
        }
    </script>

    @yield('scripts')
</body>

</html>