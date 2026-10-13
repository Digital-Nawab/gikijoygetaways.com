@extends('frontend.layout.master')

@section('css')
<style>
    .thankyou-section {
        position: relative;
        padding: 50px 0 40px;
        background: var(--bg-warm-white, #F5F3EE);
        overflow: hidden;
    }

    /* Decorative shapes - subtle */
    .deco-circle {
        position: absolute;
        border-radius: 50%;
        z-index: 0;
        pointer-events: none;
    }
    .deco-1 {
        width: 300px; height: 300px;
        background: radial-gradient(circle, rgba(240, 165, 0, 0.12), transparent 70%);
        top: -100px; left: -100px;
    }
    .deco-2 {
        width: 350px; height: 350px;
        background: radial-gradient(circle, rgba(212, 149, 10, 0.10), transparent 70%);
        bottom: -120px; right: -100px;
    }
    .deco-dots {
        position: absolute;
        width: 100px;
        height: 100px;
        background-image: radial-gradient(circle, #F0A500 1.5px, transparent 1.5px);
        background-size: 20px 20px;
        opacity: 0.15;
        pointer-events: none;
    }
    .deco-dots-1 { top: 40px; right: 60px; }
    .deco-dots-2 { bottom: 40px; left: 50px; }

    /* WIDE WRAPPER - full width usage */
    .thankyou-wrapper {
        max-width: 1600px;
        margin: 0 auto;
        padding: 0 40px;
        position: relative;
        z-index: 2;
    }

    /* Main Card - FULL WIDTH */
    .thankyou-card {
        position: relative;
        background: #ffffff;
        border-radius: 24px;
        padding: 50px 60px 40px;
        box-shadow: 0 25px 60px rgba(30, 28, 28, 0.08);
        border-top: 5px solid #F0A500;
    }

    /* Two column layout */
    .card-content-grid {
        display: grid;
        grid-template-columns: 1.1fr 1fr;
        gap: 60px;
        align-items: center;
    }

    /* LEFT SIDE */
    .card-left {
        text-align: center;
    }

    /* Success Icon */
    .success-icon-wrap {
        position: relative;
        width: 110px;
        height: 110px;
        margin: 0 auto 20px;
    }
    .pulse-ring {
        position: absolute;
        inset: 0;
        border-radius: 50%;
        background: rgba(240, 165, 0, 0.3);
        animation: pulseRing 2.5s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
    }
    .pulse-ring:nth-child(2) { animation-delay: 0.8s; }

    .success-circle {
        position: relative;
        width: 110px;
        height: 110px;
        border-radius: 50%;
        background: linear-gradient(135deg, #F0A500 0%, #D4950A 50%, #C47F00 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 15px 40px rgba(240, 165, 0, 0.4),
                    inset 0 -5px 15px rgba(196, 127, 0, 0.3);
        animation: scaleIn 0.7s ease-out forwards;
    }
    .success-circle::before {
        content: '';
        position: absolute;
        inset: 6px;
        border-radius: 50%;
        border: 2px dashed rgba(255, 255, 255, 0.4);
        animation: rotate 20s linear infinite;
    }
    .success-circle svg {
        width: 55px;
        height: 55px;
        color: white;
        position: relative;
        z-index: 2;
    }
    .checkmark-path {
        stroke-dasharray: 100;
        stroke-dashoffset: 100;
        animation: checkmark 0.9s ease-out 0.5s forwards;
    }

    /* Badge */
    .success-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 18px;
        background: #FFF8E7;
        color: #C47F00;
        font-size: 11px;
        font-weight: 700;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 15px;
        border: 1px solid rgba(240, 165, 0, 0.2);
    }
    .success-badge i {
        font-size: 13px;
        color: #F0A500;
    }

    /* Heading */
    .thankyou-title {
        font-family: var(--font-poppins, 'Poppins', sans-serif);
        font-size: 52px;
        font-weight: 800;
        color: #110F0F;
        margin-bottom: 14px;
        line-height: 1.1;
        letter-spacing: -1px;
    }
    .thankyou-title .accent {
        color: #F0A500;
        position: relative;
        display: inline-block;
    }
    .thankyou-title .accent::after {
        content: '';
        position: absolute;
        bottom: 4px;
        left: 0;
        right: 0;
        height: 7px;
        background: rgba(240, 165, 0, 0.2);
        z-index: -1;
        border-radius: 4px;
    }

    .thankyou-subtitle {
        font-size: 17px;
        color: #110F0F;
        font-weight: 500;
        margin-bottom: 10px;
    }
    .thankyou-desc {
        font-size: 14px;
        color: #525252;
        margin: 0 auto 25px;
        line-height: 1.6;
        max-width: 480px;
    }
    .thankyou-desc strong {
        color: #C47F00;
        font-weight: 700;
    }

    /* CTA Buttons */
    .cta-wrap {
        display: flex;
        gap: 12px;
        justify-content: center;
        flex-wrap: wrap;
    }
    .btn-primary-amber {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 26px;
        background: linear-gradient(135deg, #F0A500, #C47F00);
        color: white !important;
        font-weight: 600;
        font-size: 14px;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 8px 20px rgba(240, 165, 0, 0.35);
        position: relative;
        overflow: hidden;
    }
    .btn-primary-amber::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s ease;
    }
    .btn-primary-amber:hover::before { left: 100%; }
    .btn-primary-amber:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(240, 165, 0, 0.5);
        color: white;
    }
    .btn-outline-amber {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 26px;
        background: white;
        color: #110F0F !important;
        font-weight: 600;
        font-size: 14px;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 2px solid #E8E8E8;
    }
    .btn-outline-amber:hover {
        border-color: #F0A500;
        color: #F0A500 !important;
        background: #FFF8E7;
        transform: translateY(-3px);
    }

    /* RIGHT SIDE - Info Cards */
    .info-cards {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }
    .info-card {
        padding: 20px 16px;
        border-radius: 14px;
        background: #FFF8E7;
        border: 1px solid rgba(240, 165, 0, 0.15);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        text-align: center;
    }
    .info-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, #F0A500, #C47F00);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }
    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(240, 165, 0, 0.15);
        background: white;
    }
    .info-card:hover::before {
        transform: scaleX(1);
    }
    .info-icon {
        width: 48px;
        height: 48px;
        margin: 0 auto 12px;
        background: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 6px 15px rgba(240, 165, 0, 0.15);
        font-size: 22px;
        color: #F0A500;
    }
    .info-card h3 {
        font-size: 14px;
        font-weight: 700;
        color: #110F0F;
        margin-bottom: 4px;
        font-family: var(--font-poppins, 'Poppins', sans-serif);
    }
    .info-card p {
        font-size: 12px;
        color: #525252;
        margin: 0;
        line-height: 1.4;
    }

    /* Bottom Bar */
    .bottom-bar {
        margin-top: 35px;
        padding-top: 22px;
        border-top: 1px solid #E8E8E8;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
    }
    .social-wrap {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .social-wrap > span {
        font-size: 13px;
        color: #525252;
        font-weight: 500;
    }
    .social-icons {
        display: flex;
        gap: 8px;
    }
    .social-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #F5F3EE;
        color: #2E2B2B;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 14px;
    }
    .social-icon:hover {
        transform: translateY(-3px);
        background: #F0A500;
        color: white;
        box-shadow: 0 8px 15px rgba(240, 165, 0, 0.3);
    }
    .ref-id-inline {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: #525252;
    }
    .ref-id-inline span {
        font-family: 'Courier New', monospace;
        font-weight: 700;
        color: #C47F00;
        background: #FFF8E7;
        padding: 4px 10px;
        border-radius: 6px;
        border: 1px dashed #F0A500;
        letter-spacing: 1px;
        font-size: 12px;
    }

    /* Animations */
    @keyframes scaleIn {
        0% { transform: scale(0); opacity: 0; }
        60% { transform: scale(1.15); }
        100% { transform: scale(1); opacity: 1; }
    }
    @keyframes checkmark {
        to { stroke-dashoffset: 0; }
    }
    @keyframes pulseRing {
        0% { transform: scale(0.85); opacity: 1; }
        100% { transform: scale(1.8); opacity: 0; }
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes floatPlane {
        0%, 100% { transform: translateX(-50%) translateY(0); }
        50% { transform: translateX(-50%) translateY(-8px); }
    }
    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .fade-up-1 { opacity: 0; animation: fadeInUp 0.5s ease-out 0.5s forwards; }
    .fade-up-2 { opacity: 0; animation: fadeInUp 0.5s ease-out 0.7s forwards; }
    .fade-up-3 { opacity: 0; animation: fadeInUp 0.5s ease-out 0.9s forwards; }
    .fade-up-4 { opacity: 0; animation: fadeInUp 0.5s ease-out 1.1s forwards; }

    /* Responsive */
    @media (max-width: 1199px) {
        .thankyou-wrapper { padding: 0 25px; }
        .thankyou-card { padding: 45px 40px 35px; }
        .card-content-grid { gap: 40px; }
    }

    @media (max-width: 991px) {
        .card-content-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }
        .thankyou-card { padding: 40px 30px 30px; }
    }

    @media (max-width: 768px) {
        .thankyou-section { padding: 40px 0 30px; }
        .thankyou-wrapper { padding: 0 15px; }
        .thankyou-card { padding: 35px 20px 25px; }
        .thankyou-title { font-size: 38px; }
        .thankyou-subtitle { font-size: 16px; }
        .success-icon-wrap, .success-circle { 
            width: 95px; 
            height: 95px; 
        }
        .success-circle svg { width: 48px; height: 48px; }
        .btn-primary-amber, .btn-outline-amber {
            padding: 11px 22px;
            font-size: 13px;
        }
        .bottom-bar {
            justify-content: center;
            flex-direction: column;
            text-align: center;
        }
        .info-cards { grid-template-columns: 1fr; }
    }

    @media (max-width: 480px) {
        .thankyou-title { font-size: 32px; }
        .cta-wrap { flex-direction: column; }
        .cta-wrap a { width: 100%; justify-content: center; }
    }
</style>
@endsection

@section('content')

<section class="thankyou-section">

    {{-- Subtle Decorative Background --}}
    <div class="deco-circle deco-1"></div>
    <div class="deco-circle deco-2"></div>
    <div class="deco-dots deco-dots-1"></div>
    <div class="deco-dots deco-dots-2"></div>

    <div class="thankyou-wrapper">

        <div class="thankyou-card">

            {{-- TWO COLUMN LAYOUT --}}
            <div class="card-content-grid">

                {{-- LEFT SIDE - Icon + Heading + Buttons --}}
                <div class="card-left">

                    {{-- Success Icon --}}
                    <div class="success-icon-wrap">
                        <div class="pulse-ring"></div>
                        <div class="pulse-ring"></div>
                        <div class="success-circle">
                            <svg viewBox="0 0 52 52" fill="none">
                                <path class="checkmark-path" d="M14 27l8 8 16-18" stroke="white" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                            </svg>
                        </div>
                    </div>

                    <div class="fade-up-1">
                        <span class="success-badge">
                            <i class="bi bi-check-circle-fill"></i>
                            Submission Received
                        </span>
                        <h1 class="thankyou-title">
                            Thank <span class="accent">You!</span>
                        </h1>
                    </div>

                    <p class="thankyou-subtitle fade-up-2">
                        Your inquiry has been successfully submitted.
                    </p>
                    <p class="thankyou-desc fade-up-2">
                        Our travel experts will get back to you within <strong>24 hours</strong> with the perfect itinerary tailored just for you.
                    </p>

                    <div class="cta-wrap fade-up-4">
                        <a href="{{ url('/') }}" class="btn-primary-amber">
                            <i class="bi bi-house-door-fill"></i>
                            Back to Home
                        </a>
                        <a href="{{ url('/packages') }}" class="btn-outline-amber">
                            Explore Packages
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>

                </div>

                {{-- RIGHT SIDE - 4 Info Cards in 2x2 grid --}}
                <div class="card-right fade-up-3">
                    <div class="info-cards">
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="bi bi-envelope-check-fill"></i>
                            </div>
                            <h3>Confirmation Email</h3>
                            <p>Check your inbox for details</p>
                        </div>

                        <div class="info-card">
                            <div class="info-icon">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <h3>Response Time</h3>
                            <p>Within 24 hours</p>
                        </div>

                        <div class="info-card">
                            <div class="info-icon">
                                <i class="bi bi-headset"></i>
                            </div>
                            <h3>Need Help?</h3>
                            <p>Call us anytime</p>
                        </div>

                        <div class="info-card">
                            <div class="info-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <h3>Custom Itinerary</h3>
                            <p>Personalized plan coming</p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Bottom Bar - Social + Reference ID --}}
            <div class="bottom-bar fade-up-4">
                <div class="social-wrap">
                    <span>Follow us:</span>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-whatsapp"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="ref-id-inline">
                    <i class="bi bi-hash" style="color: #F0A500;"></i>
                    Reference ID:
                    <span>INQ-{{ strtoupper(substr(md5(time()), 0, 8)) }}</span>
                </div>
            </div>

        </div>

    </div>
</section>

@endsection