@extends('frontend.layout.master')
@section('css')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap');

    :root {
        --gold: #EF9F27;
        --gold-light: #FAC775;
        --white: #FFFFFF;
        --off: #F7F9FC;
        --muted: #6B7A8D;
        --border: #DDE6F0;
        --pale: #E6F1FB;
        --radius: 14px;
        --radius-sm: 8px;
        --shadow: 0 4px 24px rgba(0, 0, 0, 0.10);
        --shadow-lg: 0 12px 48px rgba(0, 0, 0, 0.16);
    }

    /* ── Base ── */
    .contact-wrap * {
        box-sizing: border-box;
    }

    .contact-wrap {
        font-family: 'DM Sans', sans-serif;
        color: #1a2a3a;
        background: var(--white);
    }

    /* ── Stats bar ── */
    .stats-bar {
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow-lg);
        padding: 0;
        margin-top: -44px;
        position: relative;
        z-index: 10;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        overflow: hidden;
        border: 1px solid var(--border);
    }

    .stat-cell {
        padding: 24px 20px;
        text-align: center;
        border-right: 1px solid var(--border);
    }

    .stat-cell:last-child {
        border-right: none;
    }

    .stat-cell .num {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        font-weight: 700;
        color: var(--primary-color1);
        line-height: 1;
    }

    .stat-cell .lbl {
        font-size: 12px;
        color: var(--muted);
        margin-top: 4px;
        font-weight: 500;
    }

    /* ── Section ── */
    .contact-section {
        padding: 60px 0 70px;
        background: var(--off);
    }

    /* ── Info Card ── */
    .info-card {
        background-color: var(--primary-color1);
        border-radius: var(--radius);
        padding: 2rem 1.75rem;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .info-card::after {
        content: '✈';
        font-size: 120px;
        line-height: 1;
        position: absolute;
        right: -20px;
        bottom: -10px;
        opacity: 0.08;
        pointer-events: none;
        color: #fff;
    }

    .info-card-title {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.6);
        margin-bottom: 1.5rem;
    }

    .info-item {
        display: flex;
        gap: 14px;
        align-items: flex-start;
        margin-bottom: 1.5rem;
    }

    .info-icon {
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .info-icon svg {
        width: 18px;
        height: 18px;
        stroke: #fff;
    }

    .info-label {
        font-size: 11px;
        font-weight: 600;
        color: var(--gold-light);
        margin-bottom: 3px;
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }

    .info-value {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.88);
        line-height: 1.55;
    }

    .divider-info {
        border: none;
        border-top: 1px solid rgba(255, 255, 255, 0.15);
        margin: 1.5rem 0;
    }

    .social-row {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .social-btn {
        width: 38px;
        height: 38px;
        border-radius: var(--radius-sm);
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.22);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.2s, border-color 0.2s;
        text-decoration: none;
    }

    .social-btn:hover {
        background: rgba(255, 255, 255, 0.22);
        border-color: rgba(255, 255, 255, 0.4);
    }

    .social-btn svg {
        width: 16px;
        height: 16px;
        stroke: #fff;
        fill: none;
    }

    .social-btn.fill svg {
        fill: #fff;
        stroke: none;
    }

    /* ── Form Card ── */
    .form-card {
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 2rem 2rem;
        border: 1px solid var(--border);
    }

    .form-card-title {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        font-weight: 700;
        color: var(--primary-color1);
        margin-bottom: 4px;
    }

    .form-card-sub {
        font-size: 13px;
        color: var(--muted);
        margin-bottom: 1.5rem;
    }

    .contact-form-label {
        font-size: 12px;
        font-weight: 600;
        color: #3a4a5a;
        margin-bottom: 6px;
        letter-spacing: 0.03em;
        display: block;
    }

    .contact-form-control {
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        color: #1a2a3a;
        background: var(--off);
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 10px 14px;
        width: 100%;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .contact-form-control:focus {
        background: #fff;
        border-color: var(--primary-color1);
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.07);
        outline: none;
    }

    .contact-form-control::placeholder {
        color: #a0aab4;
    }

    textarea.contact-form-control {
        height: 120px;
        resize: none;
    }

    .contact-form-control.is-invalid {
        border-color: #E24B4A !important;
    }

    /* Trip type pills */
    .trip-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 1rem;
    }

    .trip-pill {
        padding: 6px 14px;
        border-radius: 30px;
        border: 1.5px solid var(--border);
        font-size: 13px;
        font-weight: 500;
        color: var(--muted);
        cursor: pointer;
        background: var(--off);
        transition: all 0.18s;
        user-select: none;
    }

    .trip-pill:hover {
        border-color: var(--primary-color1);
        color: var(--primary-color1);
        background: var(--pale);
    }

    .trip-pill.active {
        border-color: var(--primary-color1);
        color: var(--primary-color1);
        background: var(--pale);
        font-weight: 600;
    }

    /* Submit button */
    .btn-send {
        background-color: var(--primary-color1);
        color: #fff;
        font-family: 'DM Sans', sans-serif;
        font-size: 15px;
        font-weight: 600;
        border: none;
        border-radius: var(--radius-sm);
        padding: 13px 20px;
        width: 100%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: opacity 0.2s, transform 0.15s;
    }

    .btn-send:hover {
        opacity: 0.88;
        transform: translateY(-1px);
    }

    .btn-send:active {
        transform: translateY(0);
    }

    .btn-send:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }

    .btn-send svg {
        width: 17px;
        height: 17px;
    }

    /* Alert messages */
    .alert-success-custom {
        background: #EAF3DE;
        border: 1px solid #97C459;
        color: #3B6D11;
        border-radius: var(--radius-sm);
        padding: 12px 16px;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 1rem;
    }

    .alert-error-custom {
        background: #FCEBEB;
        border: 1px solid #F09595;
        color: #A32D2D;
        border-radius: var(--radius-sm);
        padding: 12px 16px;
        font-size: 14px;
        margin-bottom: 1rem;
    }

    /* Validation */
    .contact-invalid-feedback {
        font-size: 12px;
        color: #A32D2D;
        margin-top: 4px;
        display: block;
    }

    /* Map */
    .map-wrap {
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow: hidden;
        border: 1px solid var(--border);
    }

    .map-header {
        padding: 18px 24px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .map-header-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: var(--pale);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .map-header-icon svg {
        width: 18px;
        height: 18px;
        stroke: var(--primary-color1);
    }

    .map-header-text .map-title {
        font-size: 14px;
        font-weight: 600;
        color: var(--primary-color1);
    }

    .map-header-text .map-sub {
        font-size: 12px;
        color: var(--muted);
    }

    .map-wrap iframe {
        display: block;
        width: 100%;
        height: 340px;
        border: none;
    }

    /* ── Animations ── */
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-up {
        animation: fadeUp 0.5s ease both;
    }

    .delay-1 {
        animation-delay: 0.1s;
    }

    .delay-2 {
        animation-delay: 0.2s;
    }

    .delay-3 {
        animation-delay: 0.3s;
    }

    .delay-4 {
        animation-delay: 0.4s;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* ── Traveler Dropdown ── */
    .traveler-wrapper {
        position: relative;
    }

    .traveler-trigger {
        width: 100%;
        background: var(--off);
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 10px 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        transition: border-color 0.2s;
        font-family: 'DM Sans', sans-serif;
    }

    .traveler-trigger:hover {
        border-color: var(--primary-color1);
    }

    .tv-icon {
        font-size: 18px;
        color: var(--primary-color1);
    }

    .tv-content {
        flex: 1;
        text-align: left;
    }

    .tv-value {
        font-size: 14px;
        font-weight: 500;
        color: #1a2a3a;
        display: block;
    }

    .tv-sub {
        font-size: 11px;
        color: var(--muted);
        display: block;
    }

    .tv-arrow {
        font-size: 13px;
        color: var(--muted);
        transition: transform 0.2s;
    }

    .traveler-trigger[aria-expanded="true"] .tv-arrow {
        transform: rotate(180deg);
    }

    .traveler-dropdown {
        position: absolute;
        top: calc(100% + 6px);
        left: 0;
        right: 0;
        background: #fff;
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        box-shadow: var(--shadow);
        z-index: 100;
        padding: 12px;
    }

    .traveler-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid var(--border);
    }

    .traveler-row:last-child {
        border-bottom: none;
    }

    .traveler-row-info strong {
        font-size: 14px;
        color: #1a2a3a;
        display: block;
    }

    .traveler-row-info small {
        font-size: 11px;
        color: var(--muted);
    }

    .traveler-counter {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .traveler-counter button {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 1.5px solid var(--border);
        background: var(--off);
        font-size: 16px;
        line-height: 1;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.15s;
        color: #1a2a3a;
    }

    .traveler-counter button:hover:not(:disabled) {
        border-color: var(--primary-color1);
        color: var(--primary-color1);
        background: var(--pale);
    }

    .traveler-counter button:disabled {
        opacity: 0.35;
        cursor: not-allowed;
    }

    .count-val {
        font-size: 15px;
        font-weight: 600;
        color: #1a2a3a;
        min-width: 20px;
        text-align: center;
    }

    /* Total Display */
    .total-display {
        display: flex;
        align-items: center;
        gap: 12px;
        background: var(--pale);
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 10px 14px;
    }

    .total-display-icon {
        font-size: 22px;
        color: var(--primary-color1);
    }

    .total-display-number {
        font-size: 20px;
        font-weight: 700;
        color: var(--primary-color1);
        line-height: 1;
    }

    .total-display-label {
        font-size: 11px;
        color: var(--muted);
        margin-top: 2px;
    }
</style>
@endsection
@section('content')
<div class="contact-wrap">

    {{-- ══════════════ BREADCRUMB BANNER — THEME ORIGINAL, DO NOT CHANGE ══════════════ --}}
    <div class="breadcrumb-section" style="background-image:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('assets/img/innerpages/breadcrumb-bg2.jpg');">
        <div class="container">
            <div class="banner-content">
                <h1>Contact Us</h1>
                <ul class="breadcrumb-list">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Contact Us</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- ══════════════ STATS BAR ══════════════ --}}
    <div class="container animate-up delay-3">
        <div class="stats-bar">
            <div class="stat-cell">
                <div class="num">10K+</div>
                <div class="lbl">Happy Travelers</div>
            </div>
            <div class="stat-cell">
                <div class="num">50+</div>
                <div class="lbl">Destinations</div>
            </div>
            <div class="stat-cell">
                <div class="num">4.9★</div>
                <div class="lbl">Average Rating</div>
            </div>
        </div>
    </div>

    {{-- ══════════════ MAIN CONTENT ══════════════ --}}
    <section class="contact-section">
        <div class="container">
            <div class="row g-4 align-items-stretch animate-up delay-4">

                {{-- ── Left: Info Card ── --}}
                <div class="col-lg-4 col-md-5">
                    <div class="info-card">

                        <div class="info-card-title">Contact Information</div>

                        <div class="info-item">
                            <div class="info-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                                    <circle cx="12" cy="9" r="2.5" />
                                </svg>
                            </div>
                            <div>
                                <div class="info-label">Address</div>
                                <div class="info-value">
                                    1/523 JiaMau, Hazratganj Lucknow,<br>
                                    Uttar Pradesh — 226001
                                </div>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8">
                                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .99h3a2 2 0 012 1.72 12.83 12.83 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 8.85a16 16 0 006.06 6.06l1.22-1.16a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" />
                                </svg>
                            </div>
                            <div>
                                <div class="info-label">Phone</div>
                                <div class="info-value">+91 91940 21976</div>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                    <polyline points="22,6 12,13 2,6" />
                                </svg>
                            </div>
                            <div>
                                <div class="info-label">Email</div>
                                <div class="info-value">contact@GikiJoy.com</div>
                            </div>
                        </div>

                        <hr class="divider-info">

                        <div class="info-label mb-2" style="color: var(--gold-light);">Follow Us</div>
                        <div class="social-row">
                            <a href="https://www.facebook.com/gikijoy" class="social-btn fill" title="Facebook">
                                <svg viewBox="0 0 24 24">
                                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" />
                                </svg>
                            </a>
                            <a href="https://www.instagram.com/gikijoy/" class="social-btn" title="Instagram">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8">
                                    <rect x="2" y="2" width="20" height="20" rx="5" />
                                    <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" />
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                                </svg>
                            </a>
                            <a href="#" class="social-btn" title="YouTube">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8">
                                    <path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.95 1.96A29 29 0 001 12a29 29 0 00.46 5.58A2.78 2.78 0 003.4 19.54C5.12 20 12 20 12 20s6.88 0 8.6-.46a2.78 2.78 0 001.95-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58z" />
                                    <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="currentColor" stroke="none" />
                                </svg>
                            </a>
                            <a href="https://wa.me/917817821976" class="social-btn" title="WhatsApp">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8">
                                    <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z" />
                                </svg>
                            </a>
                        </div>

                    </div>
                </div>

                {{-- ── Right: Form Card ── --}}
                <div class="col-lg-8 col-md-7">
                    <div class="form-card">

                        <div class="form-card-title">Send a Message</div>
                        <div class="form-card-sub">Fill out the form below and our team will get back to you within 24 hours.</div>

                        {{-- Success Message --}}
                        @if(session('success'))
                        <div class="alert-success-custom">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#3B6D11" stroke-width="2">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            {{ session('success') }}
                        </div>
                        @endif

                        {{-- Error Summary --}}
                        @if($errors->any())
                        <div class="alert-error-custom">
                            <strong>Please fix the following errors:</strong>
                            <ul class="mb-0 mt-1 ps-3">
                                @foreach($errors->all() as $error)
                                <li style="font-size:13px">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf

                            @if (session('success'))
                            <div class="alert alert-success mb-3">
                                {{ session('success') }}
                            </div>
                            @endif

                            {{-- Error Messages --}}
                            @if ($errors->any())
                            <div class="alert alert-danger mb-3">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <div class="row g-4">

                                {{-- First Name --}}
                                <div class="col-md-6">
                                    <label class="contact-form-label">
                                        First Name <span style="color:#E24B4A">*</span>
                                    </label>

                                    <input type="text"
                                        name="first_name"
                                        class="contact-form-control @error('first_name') is-invalid @enderror"
                                        placeholder="Rahul"
                                        value="{{ old('first_name') }}"
                                        required>

                                    @error('first_name')
                                    <span class="contact-invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Last Name --}}
                                <div class="col-md-6">
                                    <label class="contact-form-label">
                                        Last Name <span style="color:#E24B4A">*</span>
                                    </label>

                                    <input type="text"
                                        name="last_name"
                                        class="contact-form-control @error('last_name') is-invalid @enderror"
                                        placeholder="Sharma"
                                        value="{{ old('last_name') }}"
                                        required>

                                    @error('last_name')
                                    <span class="contact-invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div class="col-md-6">
                                    <label class="contact-form-label">
                                        Email Address <span style="color:#E24B4A">*</span>
                                    </label>

                                    <input type="email"
                                        name="email"
                                        class="contact-form-control @error('email') is-invalid @enderror"
                                        placeholder="rahul@email.com"
                                        value="{{ old('email') }}"
                                        required>

                                    @error('email')
                                    <span class="contact-invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Phone --}}
                                <div class="col-md-6">
                                    <label class="contact-form-label">Phone Number</label>

                                    <input type="tel"
                                        name="phone"
                                        class="contact-form-control @error('phone') is-invalid @enderror"
                                        placeholder="+91 98765 43210"
                                        value="{{ old('phone') }}">

                                    @error('phone')
                                    <span class="contact-invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Traveler Selector --}}
                                <div class="col-md-6">
                                    <label class="contact-form-label">Select Travelers</label>

                                    <div class="traveler-wrapper" id="travelerWrapper">

                                        <button type="button"
                                            class="traveler-trigger"
                                            id="travelerTrigger"
                                            aria-haspopup="listbox"
                                            aria-expanded="false"
                                            onclick="toggleTravelerDropdown()">

                                            <i class="bi bi-people tv-icon"></i>

                                            <span class="tv-content">
                                                <span class="tv-value" id="travelerDisplay">1 Adult</span>
                                                <span class="tv-sub">Adults &amp; Children</span>
                                            </span>

                                            <i class="bi bi-chevron-down tv-arrow"></i>
                                        </button>

                                        <input type="hidden" name="adult" id="adultHidden" value="1">
                                        <input type="hidden" name="child" id="childHidden" value="0">

                                        <div class="traveler-dropdown"
                                            id="travelerDropdown"
                                            role="listbox"
                                            style="display:none;">

                                            {{-- Adults --}}
                                            <div class="traveler-row">
                                                <div class="traveler-row-info">
                                                    <strong>Adults</strong>
                                                    <small>16+ years</small>
                                                </div>

                                                <div class="traveler-counter">
                                                    <button type="button"
                                                        id="adultMinus"
                                                        onclick="changeCount('adult', -1)"
                                                        disabled>−</button>

                                                    <span class="count-val" id="adultCount">1</span>

                                                    <button type="button"
                                                        id="adultPlus"
                                                        onclick="changeCount('adult', 1)">+</button>
                                                </div>
                                            </div>

                                            {{-- Children --}}
                                            <div class="traveler-row">
                                                <div class="traveler-row-info">
                                                    <strong>Children</strong>
                                                    <small>0 – 16 years</small>
                                                </div>

                                                <div class="traveler-counter">
                                                    <button type="button"
                                                        id="childMinus"
                                                        onclick="changeCount('child', -1)"
                                                        disabled>−</button>

                                                    <span class="count-val" id="childCount">0</span>

                                                    <button type="button"
                                                        id="childPlus"
                                                        onclick="changeCount('child', 1)">+</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                {{-- Total People --}}
                                <div class="col-md-6">
                                    <label class="contact-form-label">Total People</label>

                                    <div class="total-display">
                                        <i class="bi bi-person-check-fill total-display-icon"></i>

                                        <div class="total-display-content">
                                            <div class="total-display-number" id="travelerTotal">1</div>
                                            <div class="total-display-label">People selected</div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="total_people" id="totalPeopleHidden" value="1">
                                </div>

                                {{-- Message --}}
                                <div class="col-12">
                                    <label class="contact-form-label">Message</label>

                                    <textarea name="message"
                                        rows="4"
                                        class="contact-form-control @error('message') is-invalid @enderror"
                                        placeholder="Tell us about your travel plans, preferred dates, budget, number of travelers, and any special requirements...">{{ old('message') }}</textarea>

                                    @error('message')
                                    <span class="contact-invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Submit --}}
                                <div class="col-12">
                                    <button type="submit" class="btn-send" id="submitBtn">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                            <line x1="22" y1="2" x2="11" y2="13" />
                                            <polygon points="22 2 15 22 11 13 2 9 22 2" />
                                        </svg>

                                        Send Message
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div>

            {{-- ══════════════ MAP ══════════════ --}}
            <div class="mt-4 animate-up delay-4">
                <div class="map-wrap">
                    <div class="map-header">
                        <div class="map-header-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                                <circle cx="12" cy="9" r="2.5" />
                            </svg>
                        </div>
                        <div class="map-header-text">
                            <div class="map-title">Our Location</div>
                            <div class="map-sub">
                                1/523 JiaMau, Hazratganj Lucknow, Uttar Pradesh — 226001
                            </div>
                        </div>
                    </div>
                    <iframe
                        src="https://www.google.com/maps?q=1/523+JiaMau,+Hazratganj+Lucknow,+Uttar+Pradesh+226001&output=embed"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

        </div>
    </section>

</div>
@endsection
@section('js')
<script>
    function selectTripType(el, value) {
        document.querySelectorAll('.trip-pill').forEach(p => p.classList.remove('active'));
        el.classList.add('active');
        document.getElementById('tripTypeInput').value = value;
    }

    document.getElementById('contactForm').addEventListener('submit', function() {
        const btn = document.getElementById('submitBtn');
        btn.innerHTML = `
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                style="animation: spin 0.8s linear infinite">
                <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
            </svg>
            Sending...
        `;
        btn.disabled = true;
    });
</script>
<script>
    function toggleTravelerDropdown() {
        const dd = document.getElementById('travelerDropdown');
        const trigger = document.getElementById('travelerTrigger');
        const isOpen = dd.style.display === 'block';
        dd.style.display = isOpen ? 'none' : 'block';
        trigger.setAttribute('aria-expanded', !isOpen);
    }

    function changeCount(type, delta) {
        const countEl = document.getElementById(type + 'Count');
        const hiddenEl = document.getElementById(type + 'Hidden');
        const minusBtn = document.getElementById(type + 'Minus');

        let current = parseInt(countEl.textContent);
        let newVal = Math.max(type === 'adult' ? 1 : 0, current + delta);

        countEl.textContent = newVal;
        hiddenEl.value = newVal;
        minusBtn.disabled = (newVal <= (type === 'adult' ? 1 : 0));

        const adults = parseInt(document.getElementById('adultCount').textContent);
        const children = parseInt(document.getElementById('childCount').textContent);
        const total = adults + children;

        document.getElementById('travelerTotal').textContent = total;
        document.getElementById('totalPeopleHidden').value = total;

        let displayText = adults + ' Adult' + (adults > 1 ? 's' : '');
        if (children > 0) displayText += ', ' + children + ' Child' + (children > 1 ? 'ren' : '');
        document.getElementById('travelerDisplay').textContent = displayText;
    }

    // Bahar click pe dropdown band
    document.addEventListener('click', function(e) {
        const wrapper = document.getElementById('travelerWrapper');
        if (wrapper && !wrapper.contains(e.target)) {
            document.getElementById('travelerDropdown').style.display = 'none';
            document.getElementById('travelerTrigger').setAttribute('aria-expanded', 'false');
        }
    });

    // Checkin change pe checkout min update
    document.getElementById('checkinInput').addEventListener('change', function() {
        const checkin = new Date(this.value);
        checkin.setDate(checkin.getDate() + 1);
        const minCheckout = checkin.toISOString().split('T')[0];
        const checkoutEl = document.getElementById('checkoutInput');
        checkoutEl.min = minCheckout;
        if (checkoutEl.value < minCheckout) checkoutEl.value = '';
    });
</script>
@endsection