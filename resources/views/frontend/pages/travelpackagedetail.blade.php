@extends('frontend.layout.master')

@section('css')
<style>
    :root {
        --primary: #F0A500;
        --primary-dark: #C47F00;
        --primary-light: #FFF3D6;
        --gold: #D4950A;
        --dark: #110F0F;
        --text: #2E2B2B;
        --muted: #7a7a6a;
        --border: #E8E4DC;
        --bg: #F5F3EE;
        --white: #ffffff;
        --shadow-sm: 0 2px 12px rgba(0, 0, 0, 0.06);
        --shadow-md: 0 8px 32px rgba(0, 0, 0, 0.10);
        --shadow-lg: 0 20px 60px rgba(0, 0, 0, 0.13);
        --radius: 16px;
        --radius-sm: 10px;
    }

    /* ── HERO ── */
    .hero {
        height: 92vh;
        min-height: 600px;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: flex-end;
    }

    .hero-bg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(10, 10, 20, 0.85) 0%, rgba(10, 10, 20, 0.3) 55%, transparent 100%);
    }

    .hero-content {
        position: relative;
        z-index: 2;
        padding-bottom: 64px;
    }

    .breadcrumb-hero {
        font-size: .78rem;
        font-weight: 500;
        color: rgba(255, 255, 255, 0.65);
        letter-spacing: .5px;
        margin-bottom: 12px;
    }

    .breadcrumb-hero a {
        color: rgba(255, 255, 255, 0.65);
        text-decoration: none;
    }

    .breadcrumb-hero a:hover {
        color: #fff;
    }

    .hero-title {
        font-size: clamp(2.6rem, 6vw, 4.5rem);
        font-weight: 600;
        color: #fff;
        line-height: 1.1;
        letter-spacing: -1px;
    }

    .hero-tagline {
        font-size: 1.05rem;
        color: rgba(255, 255, 255, 0.78);
        margin-top: 12px;
        font-weight: 300;
        max-width: 520px;
        line-height: 1.6;
    }

    .hero-address {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: .82rem;
        font-weight: 400;
        color: rgba(255, 255, 255, 0.60);
        margin-top: 10px;
        max-width: 520px;
        line-height: 1.5;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15);
        padding: 5px 12px;
        border-radius: 50px;
        backdrop-filter: blur(4px);
        letter-spacing: .2px;
    }

    .hero-address svg {
        width: 13px;
        height: 13px;
        flex-shrink: 0;
        opacity: 0.70;
    }

    .hero-badge {
        display: inline-block;
        background: var(--gold);
        color: #fff;
        border-radius: 50px;
        font-size: .72rem;
        font-weight: 700;
        padding: 4px 14px;
        letter-spacing: .6px;
        text-transform: uppercase;
        margin-bottom: 16px;
    }

    /* ── INFO BAR ── */
    .info-bar {
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow-md);
        padding: 24px 32px;
        margin-top: -36px;
        position: relative;
        z-index: 10;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        flex: 1;
        border-right: 1px solid var(--border);
        padding: 0 20px;
    }

    .info-item:last-child {
        border-right: none;
    }

    .info-icon {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: var(--primary-light);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1.1rem;
    }

    .info-label {
        font-size: .7rem;
        text-transform: uppercase;
        letter-spacing: .8px;
        color: var(--muted);
        font-weight: 600;
    }

    .info-value {
        font-size: .95rem;
        font-weight: 600;
        color: var(--text);
        text-align: center;
    }

    /* ── ORIGINAL GALLERY GRID ── */
    .gallery-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        grid-template-rows: 220px 220px;
        gap: 10px;
        border-radius: var(--radius);
        overflow: hidden;
    }

    .gallery-item {
        overflow: hidden;
        cursor: pointer;
        position: relative;
        background: #ddd;
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .5s cubic-bezier(.25, .8, .25, 1);
    }

    .gallery-item:hover img {
        transform: scale(1.06);
    }

    .gallery-item:first-child {
        grid-row: 1 / 3;
    }

    .gallery-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.0);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background .3s;
    }

    .gallery-item:hover .gallery-overlay {
        background: rgba(0, 0, 0, 0.15);
    }

    .gallery-zoom-icon {
        color: #fff;
        font-size: 1.6rem;
        opacity: 0;
        transition: opacity .3s;
    }

    .gallery-item:hover .gallery-zoom-icon {
        opacity: 1;
    }

    .gallery-more {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.55);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
    }

    /* ── SECTION ── */
    .section-label {
        font-size: .72rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--primary);
        font-weight: 700;
        margin-bottom: 8px;
    }

    .section-title {
        font-size: clamp(1.8rem, 3vw, 2.4rem);
        font-weight: 600;
        color: var(--dark);
        line-height: 1.2;
    }

    .section-divider {
        width: 48px;
        height: 3px;
        background: var(--primary);
        border-radius: 4px;
        margin: 16px 0 24px;
    }

    .desc-text {
        font-size: 1rem;
        line-height: 1.85;
        color: #4a4a62;
        font-weight: 300;
    }

    /* ── HIGHLIGHTS ── */
    .highlights-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .highlight-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 16px 18px;
        transition: border-color .2s, box-shadow .2s, transform .2s;
    }

    .highlight-item:hover {
        border-color: var(--primary);
        box-shadow: 0 4px 20px rgba(240, 165, 0, 0.10);
        transform: translateY(-2px);
    }

    .highlight-icon-wrap {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: var(--primary-light);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1rem;
        flex-shrink: 0;
    }

    .highlight-text {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .highlight-text strong {
        font-size: .88rem;
        font-weight: 600;
        color: var(--dark);
        line-height: 1.3;
    }

    .highlight-text span {
        font-size: .78rem;
        color: var(--muted);
        line-height: 1.4;
    }

    /* ── PACKAGES CARDS ── */
    .packages-scroll {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .pkg-detail-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: transform .25s, box-shadow .25s, border-color .25s;
        display: flex;
        flex-direction: column;
    }

    .pkg-detail-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
        border-color: rgba(240, 165, 0, 0.25);
    }

    .pkg-detail-card.featured {
        border-color: var(--primary);
        box-shadow: 0 0 0 1px var(--primary), var(--shadow-md);
        position: relative;
    }

    .pkg-featured-badge {
        position: absolute;
        top: 14px;
        right: 14px;
        background: var(--primary);
        color: #fff;
        font-size: .65rem;
        font-weight: 700;
        letter-spacing: .8px;
        text-transform: uppercase;
        padding: 4px 10px;
        border-radius: 50px;
    }

    .pkg-detail-header {
        padding: 18px 22px 0;
    }

    .pkg-detail-tag {
        font-size: .68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--primary);
        background: var(--primary-light);
        padding: 3px 10px;
        border-radius: 50px;
        display: inline-block;
        margin-bottom: 10px;
    }

    .pkg-detail-name {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 4px;
        line-height: 1.25;
    }

    .pkg-detail-duration {
        font-size: .78rem;
        color: var(--muted);
        display: flex;
        align-items: center;
        gap: 5px;
        margin-bottom: 16px;
    }

    .pkg-detail-divider {
        height: 1px;
        background: var(--border);
        margin: 0 22px;
    }

    .pkg-detail-body {
        padding: 16px 22px 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .pkg-detail-footer {
        margin-top: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 16px;
        border-top: 1px solid var(--border);
    }

    .pkg-detail-price {
        display: flex;
        flex-direction: column;
    }

    .pkg-detail-price .from {
        font-size: .68rem;
        text-transform: uppercase;
        letter-spacing: .5px;
        color: var(--muted);
    }

    .pkg-detail-price .amount {
        font-size: 1.55rem;
        font-weight: 700;
        color: var(--dark);
        line-height: 1;
    }

    .pkg-detail-price .per {
        font-size: .72rem;
        color: var(--muted);
    }

    .btn-pkg {
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 9px 18px;
        font-size: .82rem;
        font-weight: 700;
        transition: all .2s;
        white-space: nowrap;
        cursor: pointer;
    }

    .btn-pkg:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(240, 165, 0, 0.3);
        color: #fff;
    }

    /* ── AMENITIES ── */
    .amenities-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
    }

    .amenity-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 10px;
        padding: 20px 14px;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        transition: border-color .2s, box-shadow .2s, transform .2s;
    }

    .amenity-item:hover {
        border-color: var(--primary);
        box-shadow: 0 4px 18px rgba(240, 165, 0, 0.10);
        transform: translateY(-3px);
    }

    .amenity-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        background: var(--primary-light);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1.2rem;
    }

    .amenity-label {
        font-size: .82rem;
        font-weight: 600;
        color: var(--text);
        line-height: 1.3;
    }

    /* ── PKG HIGHLIGHT LIST ── */
    .pkg-highlight-list {
        list-style: none;
        padding: 0;
        margin: 0 0 18px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .pkg-highlight-list li {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        font-size: .85rem;
        color: #4a4a62;
        line-height: 1.45;
    }

    .pkg-highlight-list li i {
        color: var(--primary);
        font-size: .75rem;
        margin-top: 3px;
        flex-shrink: 0;
    }

    .btn-pkg-outline {
        background: transparent;
        color: var(--primary);
        border: 1.5px solid var(--primary);
        border-radius: 50px;
        padding: 8px 18px;
        font-size: .82rem;
        font-weight: 700;
        transition: all .2s;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        white-space: nowrap;
    }

    .btn-pkg-outline:hover {
        background: var(--primary-light);
        color: var(--primary);
    }

    /* ── STICKY PRICING ── */
    .pricing-sticky {
        position: sticky;
        top: 88px;
    }

    .pricing-card {
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        border: 1px solid var(--border);
    }

    .pricing-header {
        background: #110F0F;
        border-top: 3px solid #F0A500;
        padding: 24px;
        color: #fff;
    }

    .price-section-label {
        font-size: .68rem;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: rgba(255, 255, 255, 0.5);
        font-weight: 600;
        margin-bottom: 4px;
    }

    .price-main-amount {
        font-size: 2.6rem;
        font-weight: 800;
        color: #F0A500;
        line-height: 1;
        letter-spacing: -1px;
    }

    .price-main-note {
        font-size: .78rem;
        color: rgba(255, 255, 255, 0.5);
        margin-top: 3px;
    }

    .price-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.08);
        margin: 16px 0;
    }

    .advance-box {
        background: rgba(240, 165, 0, 0.10);
        border: 1px solid rgba(240, 165, 0, 0.28);
        border-radius: 12px;
        padding: 14px 16px;
    }

    .advance-box-label {
        font-size: .68rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(240, 165, 0, 0.75);
        font-weight: 700;
        margin-bottom: 4px;
    }

    .advance-box-amount {
        font-size: 1.9rem;
        font-weight: 800;
        color: #F0A500;
        line-height: 1;
    }

    .advance-box-note {
        font-size: .7rem;
        color: rgba(255, 255, 255, 0.45);
        margin-top: 5px;
    }

    .price-badge {
        background: rgba(240, 165, 0, 0.15);
        border: 1px solid rgba(240, 165, 0, 0.3);
        color: #F0A500;
        border-radius: 50px;
        padding: 3px 12px;
        font-size: .72rem;
        font-weight: 700;
        display: inline-block;
        margin-top: 10px;
    }

    .pricing-body {
        padding: 24px;
    }

    .btn-book {
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 14px 0;
        width: 100%;
        font-size: 1rem;
        font-weight: 700;
        letter-spacing: .3px;
        transition: all .25s;
    }

    .btn-book:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(240, 165, 0, 0.35);
        color: #fff;
    }

    .price-feature {
        display: flex;
        align-items: center;
        gap: 9px;
        font-size: .82rem;
        color: var(--muted);
        padding: 6px 0;
    }

    .price-feature i {
        color: #22c55e;
        font-size: .9rem;
    }

    /* ── REVIEWS ── */
    .review-card {
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        padding: 24px;
        height: 100%;
        border: 1px solid var(--border);
        transition: transform .25s, box-shadow .25s;
    }

    .review-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
    }

    .reviewer-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--primary-light);
    }

    .reviewer-name {
        font-size: .93rem;
        font-weight: 700;
    }

    .reviewer-date {
        font-size: .75rem;
        color: var(--muted);
    }

    .review-stars {
        color: #FFB800;
        font-size: .85rem;
    }

    .review-text {
        font-size: .88rem;
        color: #555;
        line-height: 1.7;
        margin-top: 12px;
    }

    /* ── FORM ── */
    .form-card {
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow-md);
        padding: 40px;
    }

    .form-control-giki {
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 14px 18px;
        font-size: .92rem;
        color: var(--text);
        transition: border .2s, box-shadow .2s;
        background: #fafafa;
        width: 100%;
    }

    .form-control-giki:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(240, 165, 0, 0.12);
        outline: none;
        background: var(--white);
    }

    .form-label-giki {
        font-size: .78rem;
        text-transform: uppercase;
        letter-spacing: .8px;
        font-weight: 700;
        color: var(--muted);
        margin-bottom: 6px;
        display: block;
    }

    .btn-submit {
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 15px 40px;
        font-size: 1rem;
        font-weight: 700;
        transition: all .25s;
        cursor: pointer;
    }

    .btn-submit:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 8px 28px rgba(240, 165, 0, 0.35);
    }

    /* ── TRAVELER ── */
    .traveler-wrapper {
        position: relative;
    }

    .traveler-trigger {
        width: 100%;
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 12px 16px;
        font-size: .92rem;
        color: var(--text);
        background: #fafafa;
        cursor: pointer;
        text-align: left;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: border .2s, box-shadow .2s;
        user-select: none;
        font-family: inherit;
        min-height: 52px;
    }

    .traveler-trigger:focus,
    .traveler-trigger.open {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(240, 165, 0, 0.12);
        background: var(--white);
        outline: none;
    }

    .tv-icon {
        color: var(--primary);
        font-size: .95rem;
        flex-shrink: 0;
    }

    .tv-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 1px;
        min-width: 0;
    }

    .tv-value {
        font-size: .88rem;
        font-weight: 600;
        color: var(--text);
        line-height: 1.25;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .tv-value.placeholder {
        color: #9a9ab5;
        font-weight: 400;
    }

    .tv-sub {
        font-size: .68rem;
        color: var(--muted);
    }

    .tv-arrow {
        color: var(--muted);
        font-size: .7rem;
        transition: transform .2s ease;
        flex-shrink: 0;
    }

    .traveler-trigger.open .tv-arrow {
        transform: rotate(180deg);
    }

    .traveler-dropdown {
        display: none;
        position: absolute;
        top: calc(100% + 5px);
        left: 0;
        right: 0;
        background: var(--white);
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        box-shadow: var(--shadow-md);
        z-index: 9999;
        overflow: hidden;
        animation: tvDrop .15s ease;
    }

    @keyframes tvDrop {
        from {
            opacity: 0;
            transform: translateY(-5px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .traveler-dropdown.open {
        display: block;
    }

    .traveler-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 16px;
        border-bottom: 1px solid var(--border);
    }

    .traveler-row:last-child {
        border-bottom: none;
    }

    .traveler-row-info strong {
        display: block;
        font-size: .85rem;
        font-weight: 600;
        color: var(--dark);
        line-height: 1.3;
    }

    .traveler-row-info small {
        font-size: .71rem;
        color: var(--muted);
    }

    .traveler-counter {
        display: flex;
        align-items: center;
        border: 1.5px solid var(--border);
        border-radius: 50px;
        overflow: hidden;
        background: #fafafa;
        flex-shrink: 0;
    }

    .traveler-counter button {
        width: 30px;
        height: 30px;
        border: none;
        background: transparent;
        color: var(--primary);
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background .15s;
        padding: 0;
        line-height: 1;
    }

    .traveler-counter button:hover:not(:disabled) {
        background: var(--primary-light);
    }

    .traveler-counter button:disabled {
        color: #c8c8d8;
        cursor: not-allowed;
    }

    .traveler-counter .count-val {
        min-width: 26px;
        text-align: center;
        font-size: .88rem;
        font-weight: 700;
        color: var(--dark);
        padding: 0 2px;
    }

    .total-display {
        width: 100%;
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 12px 16px;
        background: var(--primary-light);
        display: flex;
        align-items: center;
        gap: 12px;
        min-height: 52px;
        cursor: default;
    }

    .total-display-icon {
        color: var(--primary);
        font-size: .95rem;
        flex-shrink: 0;
    }

    .total-display-content {
        flex: 1;
    }

    .total-display-number {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--primary);
        line-height: 1;
    }

    .total-display-label {
        font-size: .68rem;
        color: var(--primary);
        font-weight: 500;
        opacity: .75;
    }

    /* ── LIGHTBOX ── */
    .lightbox {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.92);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .lightbox.active {
        display: flex;
    }

    .lightbox img {
        max-width: 88vw;
        max-height: 80vh;
        border-radius: 12px;
        object-fit: contain;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
    }

    .lightbox-close {
        position: absolute;
        top: 20px;
        right: 28px;
        color: #fff;
        font-size: 2rem;
        cursor: pointer;
        opacity: .7;
        transition: opacity .2s;
        z-index: 10000;
    }

    .lightbox-close:hover {
        opacity: 1;
    }

    .lightbox-nav {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-top: 18px;
    }

    .lightbox-nav-btn {
        background: rgba(255, 255, 255, 0.10);
        border: 1px solid rgba(255, 255, 255, 0.18);
        color: #fff;
        border-radius: 50px;
        padding: 8px 22px;
        font-size: .85rem;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .lightbox-nav-btn:hover {
        background: rgba(255, 255, 255, 0.20);
    }

    .lightbox-counter {
        color: rgba(255, 255, 255, 0.55);
        font-size: .82rem;
        min-width: 50px;
        text-align: center;
    }

    /* ── LIGHTBOX CAPTION ── */
    .lightbox-caption {
        position: relative;
        max-width: 88vw;
        margin-top: 16px;
        padding: 14px 22px;
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.10);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border-radius: 12px;
        color: #fff;
        text-align: center;
        font-size: .95rem;
        font-weight: 500;
        line-height: 1.5;
        letter-spacing: .2px;
        animation: captionFade .3s ease;
    }

    .lightbox-caption.empty {
        display: none;
    }

    .lightbox-caption .caption-icon {
        color: var(--primary);
        margin-right: 8px;
        font-size: .9rem;
    }

    @keyframes captionFade {
        from {
            opacity: 0;
            transform: translateY(8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ── PROPERTY STATS ROW ── */
    .property-stats-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 8px;
        padding: 60px 0;
        border-bottom: 1px solid var(--border);
        border-top: 1px solid var(--border);
        margin-bottom: 28px;
    }

    .stats-left {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
        font-size: 1.15rem;
        color: var(--text);
        font-weight: 500;
    }

    .stats-right {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
        font-size: 1.15rem;
    }

    .rating-pill {
        display: flex;
        align-items: center;
        gap: 6px;
        background: #fffbf0;
        border: 1.5px solid #F0A500;
        border-radius: 50px;
        padding: 5px 14px;
    }

    .rating-score {
        font-size: 1rem;
        font-weight: 800;
        color: var(--dark);
        line-height: 1;
    }

    .rating-stars {
        color: #FFB800;
        font-size: .8rem;
        letter-spacing: 1px;
    }

    .reviews-pill {
        display: flex;
        align-items: center;
        gap: 5px;
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 50px;
        padding: 5px 14px;
        font-size: .82rem;
        color: var(--muted);
        font-weight: 500;
    }

    .reviews-pill strong {
        color: var(--dark);
        font-weight: 700;
    }

    /* ── POST-AMENITIES MASONRY GALLERY ── */
    .masonry-photo-wrap {
        column-count: 3;
        column-gap: 10px;
    }

    .masonry-photo-item {
        break-inside: avoid;
        -webkit-column-break-inside: avoid;
        page-break-inside: avoid;
        margin-bottom: 10px;
        cursor: pointer;
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        display: inline-block;
        width: 100%;
    }

    .masonry-photo-item img {
        width: 100%;
        height: auto;
        display: block;
        transition: transform .5s cubic-bezier(.25, .8, .25, 1);
        vertical-align: bottom;
    }

    .masonry-photo-item:hover img {
        transform: scale(1.05);
    }

    .masonry-photo-item .gallery-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background .3s;
    }

    .masonry-photo-item:hover .gallery-overlay {
        background: rgba(0, 0, 0, 0.25);
    }

    .masonry-photo-item .gallery-zoom-icon {
        opacity: 0;
        color: #fff;
        font-size: 1.5rem;
        transition: opacity .3s;
    }

    .masonry-photo-item:hover .gallery-zoom-icon {
        opacity: 1;
    }

    /* ── UTILS ── */
    .section-gap {
        padding: 80px 0;
    }

    /* ── Flatpickr Override ── */
    .flatpickr-input {
        width: 100% !important;
        border: 1.5px solid var(--border) !important;
        border-radius: var(--radius-sm) !important;
        padding: 14px 18px !important;
        font-size: .92rem !important;
        color: var(--text) !important;
        background: #fafafa !important;
        font-family: inherit !important;
        cursor: pointer !important;
    }

    .flatpickr-input:not(.active)[value=""] {
        color: #9a9ab5 !important;
    }

    .flatpickr-input:focus {
        border-color: var(--primary) !important;
        box-shadow: 0 0 0 3px rgba(240, 165, 0, 0.12) !important;
        outline: none !important;
        background: #fff !important;
    }

    .flatpickr-day.booked-date {
        background: #fff0f0 !important;
        color: #e53e3e !important;
        text-decoration: line-through !important;
        cursor: not-allowed !important;
        border-color: transparent !important;
    }

    .flatpickr-day.booked-date:hover {
        background: #fff0f0 !important;
        color: #e53e3e !important;
    }

    .flatpickr-day.selected,
    .flatpickr-day.startRange,
    .flatpickr-day.endRange {
        background: var(--primary) !important;
        border-color: var(--primary) !important;
    }

    .flatpickr-day.inRange {
        background: var(--primary-light) !important;
        border-color: var(--primary-light) !important;
        color: var(--primary) !important;
    }

    .date-legend {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-top: 8px;
        font-size: .72rem;
        color: var(--muted);
    }

    .date-legend-dot {
        width: 12px;
        height: 12px;
        border-radius: 3px;
        display: inline-block;
        margin-right: 4px;
    }

    /* ════════════════════════════════════════════
           CENTER MODAL POPUP
        ════════════════════════════════════════════ */
    .enquiry-modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        z-index: 10000;
        align-items: center;
        justify-content: center;
        padding: 20px;
        backdrop-filter: blur(3px);
    }

    .enquiry-modal-overlay.active {
        display: flex;
    }

    .enquiry-modal {
        background: #fff;
        border-radius: 20px;
        width: 100%;
        max-width: 680px;
        max-height: 90vh;
        display: flex;
        flex-direction: column;
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3);
        animation: modalPop .3s cubic-bezier(.22, .68, 0, 1.2) both;
        overflow: hidden;
    }

    @keyframes modalPop {
        from {
            opacity: 0;
            transform: scale(0.92) translateY(20px);
        }

        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    .modal-header {
        background: #110F0F;
        border-top: 3px solid #F0A500;
        padding: 20px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-shrink: 0;
    }

    .modal-header-left {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .modal-title {
        font-size: 1.2rem;
        font-weight: 800;
        color: #fff;
    }

    .modal-subtitle {
        font-size: .75rem;
        color: rgba(255, 255, 255, 0.5);
    }

    .modal-close-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background .2s;
        flex-shrink: 0;
    }

    .modal-close-btn:hover {
        background: rgba(255, 255, 255, 0.22);
    }

    .modal-body {
        overflow-y: auto;
        padding: 28px;
        flex: 1;
    }

    .modal-body::-webkit-scrollbar {
        width: 5px;
    }

    .modal-body::-webkit-scrollbar-track {
        background: #f5f5f5;
    }

    .modal-body::-webkit-scrollbar-thumb {
        background: var(--primary-light);
        border-radius: 4px;
    }

    .modal-footer {
        padding: 16px 28px;
        border-top: 1px solid var(--border);
        background: #fff;
        flex-shrink: 0;
    }

    .btn-modal-submit {
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 15px 0;
        width: 100%;
        font-size: 1rem;
        font-weight: 700;
        letter-spacing: .3px;
        cursor: pointer;
        transition: all .25s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-modal-submit:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(240, 165, 0, 0.35);
    }

    /* ── TABLET (max 991px) ── */
    @media (max-width: 991px) {
        .packages-scroll {
            grid-template-columns: 1fr 1fr;
        }

        .amenities-grid {
            grid-template-columns: repeat(4, 1fr);
        }

        .enquiry-modal {
            max-width: 600px;
        }
    }

    /* ── MOBILE (max 767px) ── */
    @media (max-width: 767px) {

        .container {
            padding-left: 16px !important;
            padding-right: 16px !important;
        }

        .form-card {
            margin-left: 0;
            margin-right: 0;
        }

        .info-bar {
            margin-left: 0;
            margin-right: 0;
        }

        .hero {
            height: 72vh;
            min-height: 400px;
        }

        .hero-title {
            font-size: 1.9rem;
            letter-spacing: -.3px;
            line-height: 1.15;
        }

        .hero-tagline {
            font-size: .9rem;
            margin-top: 8px;
        }

        .hero-address {
            font-size: .72rem;
            padding: 4px 10px;
            max-width: 100%;
        }

        .hero-badge {
            font-size: .65rem;
            padding: 3px 11px;
        }

        .hero-content {
            padding-bottom: 40px;
        }

        .info-bar {
            padding: 14px 16px;
            margin-top: -16px;
            flex-wrap: wrap;
            gap: 8px !important;
        }

        .info-item {
            flex-direction: row;
            align-items: center;
            gap: 8px;
            padding: 6px 8px;
            border-right: none;
            border-bottom: 1px solid var(--border);
            flex: 1 1 100%;
            min-width: 0;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-icon {
            width: 34px;
            height: 34px;
            flex-shrink: 0;
            font-size: .85rem;
        }

        .info-label {
            font-size: .62rem;
            margin-bottom: 0;
        }

        .info-value {
            font-size: .82rem;
            text-align: left;
        }

        .gallery-grid {
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 150px 150px;
        }

        .gallery-item:first-child {
            grid-row: auto;
        }

        .section-gap {
            padding: 44px 0;
        }

        .section-title {
            font-size: 1.45rem;
        }

        .section-divider {
            margin: 12px 0 18px;
        }

        .property-stats-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .stats-left {
            flex-wrap: wrap;
            gap: 6px;
            font-size: .82rem;
        }

        .stats-right {
            flex-wrap: wrap;
            gap: 6px;
        }

        .rating-pill {
            padding: 4px 10px;
        }

        .reviews-pill {
            padding: 4px 10px;
            font-size: .75rem;
        }

        .highlights-grid {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .highlight-item {
            padding: 13px 14px;
        }

        .packages-scroll {
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .pkg-detail-name {
            font-size: 1.1rem;
        }

        .amenities-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .amenity-item {
            padding: 16px 10px;
        }

        .amenity-icon {
            width: 40px;
            height: 40px;
        }

        .amenity-label {
            font-size: .78rem;
        }

        .masonry-photo-wrap {
            column-count: 2;
            column-gap: 8px;
        }

        .form-card {
            padding: 20px 16px;
            border-radius: 14px;
        }

        .form-control-giki {
            padding: 12px 14px;
            font-size: .88rem;
        }

        .form-label-giki {
            font-size: .7rem;
            margin-bottom: 5px;
        }

        .btn-submit {
            padding: 13px 32px;
            font-size: .92rem;
            width: 100%;
        }

        .traveler-trigger {
            padding: 10px 14px;
            min-height: 48px;
            font-size: .88rem;
        }

        .tv-value {
            font-size: .82rem;
        }

        .tv-sub {
            font-size: .62rem;
        }

        .total-display {
            padding: 10px 14px;
            min-height: 48px;
        }

        .total-display-number {
            font-size: 1.2rem;
        }

        .pricing-sticky {
            position: relative;
            top: 0;
        }

        .pricing-card {
            border-radius: 14px;
        }

        .pricing-header {
            padding: 18px 18px;
        }

        .price-section-label {
            font-size: .62rem;
        }

        .price-main-amount {
            font-size: 2.1rem;
        }

        .price-main-note {
            font-size: .72rem;
        }

        .advance-box {
            padding: 12px 14px;
        }

        .advance-box-label {
            font-size: .62rem;
        }

        .advance-box-amount {
            font-size: 1.6rem;
        }

        .advance-box-note {
            font-size: .65rem;
        }

        .pricing-body {
            padding: 18px;
        }

        .btn-book {
            padding: 13px 0;
            font-size: .92rem;
        }

        .review-card {
            padding: 18px 16px;
        }

        .reviewer-name {
            font-size: .88rem;
        }

        .reviewer-date {
            font-size: .7rem;
        }

        .review-text {
            font-size: .82rem;
        }

        .enquiry-modal-overlay {
            padding: 0;
            align-items: flex-end;
        }

        .enquiry-modal {
            width: 100%;
            max-width: 100%;
            max-height: 93vh;
            border-radius: 20px 20px 0 0;
        }

        .modal-header {
            padding: 16px 18px;
        }

        .modal-title {
            font-size: 1rem;
        }

        .modal-subtitle {
            font-size: .7rem;
        }

        .modal-body {
            padding: 16px 18px;
        }

        .modal-footer {
            padding: 12px 18px;
        }

        .btn-modal-submit {
            padding: 13px 0;
            font-size: .92rem;
        }

        #enquiryModal .row>[class*="col-md-6"] {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .lightbox-caption {
            font-size: .85rem;
            padding: 10px 16px;
            margin-top: 12px;
            max-width: 92vw;
        }
    }

    /* ── SMALL MOBILE (max 480px) ── */
    @media (max-width: 480px) {
        .hero {
            height: 65vh;
            min-height: 360px;
        }

        .hero-title {
            font-size: 1.6rem;
        }

        .hero-tagline {
            display: none;
        }

        .gallery-grid {
            grid-template-columns: 1fr;
            grid-template-rows: 220px;
        }

        .gallery-item:nth-child(n+2) {
            display: none;
        }

        .section-title {
            font-size: 1.3rem;
        }

        .info-bar {
            margin-top: -12px;
            border-radius: 12px;
        }

        .amenities-grid {
            gap: 8px;
        }

        .masonry-photo-wrap {
            column-count: 1;
        }

        .pkg-detail-card {
            border-radius: 12px;
        }

        .price-main-amount {
            font-size: 1.8rem;
        }

        .advance-box-amount {
            font-size: 1.4rem;
        }

        .form-card {
            padding: 16px 14px;
        }

        .review-card {
            padding: 14px;
        }
    }
</style>
@endsection

@section('content')

@php
$detail = $package->detail;
$highlights = [];
$amenities = [];

if ($detail) {
$highlights = is_array($detail->highlights)
? $detail->highlights
: (json_decode($detail->highlights ?? '[]', true) ?? []);

$amenities = is_array($detail->amenities)
? $detail->amenities
: (json_decode($detail->amenities ?? '[]', true) ?? []);
}

$heroBg = null;
if ($detail && $detail->banner_image) {
$heroBg = asset('admin-assets/home/package/' . $detail->banner_image);
} elseif ($package->image) {
$heroBg = asset('admin-assets/home/package/' . $package->image);
}

$locationDisplay = '';
if ($detail && $detail->address) {
$locationDisplay = $detail->address;
} else {
$parts = [];
if ($package->city) $parts[] = $package->city->name;
if ($package->state) $parts[] = $package->state->name;
$locationDisplay = implode(', ', $parts);
}
@endphp

{{-- ── HERO ── --}}
<section class="hero">
    @if($heroBg)
    <img class="hero-bg" src="{{ $heroBg }}" alt="{{ $package->name }}">
    @else
    <div style="position:absolute;inset:0;background:linear-gradient(135deg,#0d2b55,#1a5276);"></div>
    @endif
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <div class="row">
            <div class="col-lg-8">
                @if($detail && $detail->hero_badge)
                <span class="hero-badge"><i class="bi bi-award-fill me-1"></i> {{ $detail->hero_badge }}</span>
                @endif

                <div class="breadcrumb-hero mb-2">
                    <a href="{{ url('/') }}">Home</a> &nbsp;/&nbsp;
                    <a href="#">Packages</a> &nbsp;/&nbsp;
                    @if($package->state)
                    <a href="#">{{ $package->state->name }}</a> &nbsp;/&nbsp;
                    @endif
                    {{ $package->name }}
                </div>

                <h1 class="hero-title">{{ $package->name }}</h1>

                @if($package->short_description)
                <p class="hero-tagline">{{ $package->short_description }}</p>
                @endif

                @if($locationDisplay)
                <p class="hero-address">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                    {{ $locationDisplay }}
                </p>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ── QUICK INFO BAR ── --}}
<div class="container">
    <div class="info-bar d-flex flex-wrap justify-content-between align-items-center gap-3">

        @if($locationDisplay)
        <div class="info-item">
            <div class="info-icon"><i class="bi bi-geo-alt"></i></div>
            <span class="info-label">Location</span>
            <span class="info-value">{{ $locationDisplay }}</span>
        </div>
        @endif

        <div class="info-item">
            <div class="info-icon"><i class="bi bi-currency-rupee"></i></div>
            <span class="info-label">Starting From</span>
            <span class="info-value">₹{{ number_format($package->total_price, 0) }}</span>
        </div>

        @if($package->capacity)
        <div class="info-item">
            <div class="info-icon"><i class="bi bi-people"></i></div>
            <span class="info-label">Capacity</span>
            <span class="info-value">{{ $package->capacity }} People</span>
        </div>
        @endif

        @if($detail && $detail->offer_badge_text)
        <div class="info-item">
            <div class="info-icon"><i class="bi bi-tag"></i></div>
            <span class="info-label">Offer</span>
            <span class="info-value" style="color:var(--primary);">{{ $detail->offer_badge_text }}</span>
        </div>
        @endif

    </div>
</div>

{{-- ── MAIN CONTENT ── --}}
<div class="container section-gap">
    <div class="row g-5">

        {{-- ══ LEFT COLUMN ══ --}}
        <div class="col-lg-8">

            {{-- GALLERY --}}
            @if($galleries && $galleries->count() > 0)
            <div class="mb-3">
                <div class="section-label">Visual Journey</div>
                <h2 class="section-title mb-4">A Glimpse of {{ $package->name }}</h2>
                <div class="gallery-grid" id="gallery">
                    @foreach($galleries as $index => $img)
                    @if($loop->index < 4)
                        <div class="gallery-item" onclick="openLightbox({{ $loop->index }})">
                        <img src="{{ asset('admin-assets/home/package-gallery/'.$img->image) }}"
                            alt="{{ $img->caption ?? $package->name }}">
                        <div class="gallery-overlay">
                            <i class="bi bi-zoom-in gallery-zoom-icon"></i>
                        </div>
                    </div>
                    @elseif($loop->index === 4)
                    <div class="gallery-item" onclick="openLightbox({{ $loop->index }})">
                        <img src="{{ asset('admin-assets/home/package-gallery/'.$img->image) }}"
                            alt="{{ $img->caption ?? $package->name }}">
                        <div class="gallery-overlay">
                            <i class="bi bi-zoom-in gallery-zoom-icon"></i>
                        </div>
                        @if($galleries->count() > 5)
                        <div class="gallery-more"
                            onclick="event.stopPropagation(); openLightbox({{ $loop->index }})">
                            +{{ $galleries->count() - 5 }} More
                        </div>
                        @endif
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @endif

            {{-- PROPERTY STATS + RATING --}}
            @php
            $hasStats = $package->guests || $package->bedrooms || $package->beds || $package->bathrooms;
            $hasRating = ($package->rating ?? 0) > 0 || ($package->reviews_count ?? 0) > 0;
            @endphp

            @if($hasStats || $hasRating)
            <div class="property-stats-row">
                <div class="stats-left">
                    @if($package->guests)
                    <span><i class="bi bi-people-fill me-1" style="color:var(--primary);"></i>{{ $package->guests }} guests</span>
                    @endif
                    @if($package->guests && ($package->bedrooms || $package->beds || $package->bathrooms))
                    <span style="color:#ccc;">·</span>
                    @endif
                    @if($package->bedrooms)
                    <span><i class="bi bi-door-closed-fill me-1" style="color:var(--primary);"></i>{{ $package->bedrooms }} bedroom{{ $package->bedrooms > 1 ? 's' : '' }}</span>
                    @endif
                    @if($package->bedrooms && ($package->beds || $package->bathrooms))
                    <span style="color:#ccc;">·</span>
                    @endif
                    @if($package->beds)
                    <span><i class="bi bi-house-fill me-1" style="color:var(--primary);"></i>{{ $package->beds }} bed{{ $package->beds > 1 ? 's' : '' }}</span>
                    @endif
                    @if($package->beds && $package->bathrooms)
                    <span style="color:#ccc;">·</span>
                    @endif
                    @if($package->bathrooms)
                    <span><i class="bi bi-droplet-fill me-1" style="color:var(--primary);"></i>{{ $package->bathrooms }} bathroom{{ $package->bathrooms > 1 ? 's' : '' }}</span>
                    @endif
                </div>

                @if($hasRating)
                <div class="stats-right">
                    <img src="https://cdn.trustindex.io/assets/platform/Google/logo.svg" alt="Google" style="height:18px;object-fit:contain;">
                    @if(($package->rating ?? 0) > 0)
                    <div class="rating-pill">
                        <span class="rating-score">{{ number_format($package->rating, 1) }}</span>
                        <span class="rating-stars">
                            @for($i = 1; $i <= 5; $i++){{ $i <= round($package->rating) ? '★' : '☆' }}@endfor
                        </span>
                    </div>
                    @endif
                    @if(($package->reviews_count ?? 0) > 0)
                    <div class="reviews-pill">
                        <i class="bi bi-chat-dots" style="color:var(--primary);font-size:.8rem;"></i>
                        <strong>{{ $package->reviews_count }}</strong> Reviews
                    </div>
                    @endif
                </div>
                @endif
            </div>
            @endif

            {{-- DESCRIPTION --}}
            @if(($detail && $detail->description) || $package->short_description)
            <div class="mb-5">
                <h2 class="section-title">Overview</h2>
                <div class="section-divider"></div>

                @if($detail && $detail->description)
                <div class="desc-text">
                    @php
                        echo $detail->description;
                    @endphp
                </div>
                @elseif($package->short_description)
                <p class="desc-text">
                    {{ $package->short_description }}
                </p>
                @endif

                <hr style="border-color:#E8E4DC;margin:20px 0;">
            </div>
            @endif

            {{-- HIGHLIGHTS --}}
            @if(count($highlights) > 0)
            <div class="mb-5">
                <h3 class="section-title mb-3" style="font-size:1.6rem;">Highlights</h3>
                <div class="highlights-grid">
                    @foreach($highlights as $hl)
                    <div class="highlight-item">
                        <div class="highlight-icon-wrap">
                            <i class="bi {{ $hl['icon'] ?? 'bi-star-fill' }}"></i>
                        </div>
                        <div class="highlight-text">
                            <strong>{{ $hl['title'] ?? '' }}</strong>
                            @if(!empty($hl['subtitle']))
                            <span>{{ $hl['subtitle'] }}</span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- AVAILABLE PACKAGES --}}
            @if($subPackages->count() > 0)
            <div class="mb-5">
                <div class="section-label">Choose Your Stay</div>
                <h2 class="section-title">Available Packages at {{ $package->name }}</h2>
                <div class="section-divider"></div>
                <div class="packages-scroll">

                    @forelse($subPackages as $sp)
                    <div class="pkg-detail-card {{ $sp->is_featured ? 'featured' : '' }}">

                        @if($sp->is_featured && $sp->editor_badge)
                        <span class="pkg-featured-badge">✦ {{ $sp->editor_badge }}</span>
                        @endif

                        <div class="pkg-detail-header">
                            @if($sp->badge)
                            <span class="pkg-detail-tag">{{ $sp->badge }}</span>
                            @endif
                            <div class="pkg-detail-name">{{ $sp->name }}</div>
                        </div>
                        <div class="pkg-detail-divider"></div>
                        <div class="pkg-detail-body">
                            <ul class="pkg-highlight-list">
                                @foreach($sp->features as $feature)
                                <li><i class="bi bi-check-circle-fill"></i>{{ $feature }}</li>
                                @endforeach
                            </ul>
                            <div class="pkg-detail-footer">
                                <div class="pkg-detail-price">
                                    @if($sp->price)
                                    <span class="from">From</span>
                                    <span class="amount">₹{{ number_format($sp->price, 0) }}</span>
                                    @endif
                                </div>
                                <a href="#enquiry"
                                    onclick="document.getElementById('enquiry').scrollIntoView({behavior:'smooth'})"
                                    class="btn-pkg">
                                    Book Now <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted">No packages available.</p>
                    @endforelse

                </div>
            </div>
            @endif

            {{-- AMENITIES --}}
           {{-- AMENITIES --}}
@if(count($amenities) > 0)
@php
$amenitySvgs = [
    'tv'                => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="12" rx="1.5"/><path d="M8 21h8M12 17v4"/></svg>',
    'ac'                => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="8" rx="1.5"/><path d="M6 9h12M6 11.5h12M7 16v1.5m4-1.5v3m4-3v1.5m4-1.5v2.5"/></svg>',
    'housekeeping'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 4l-9 9 3 3 9-9z"/><path d="M14 4l3 3"/><circle cx="19" cy="19" r="2"/><path d="M17.5 17.5l-2-2"/></svg>',
    'cctv'              => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l13-3 1.5 4-13 3z"/><path d="M5 13l1 4"/><path d="M16 8l3 1"/><path d="M19 9v4a2 2 0 01-2 2"/></svg>',
    'bed_linen'         => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="8" width="18" height="9" rx="1.5"/><path d="M3 12h18M3 14h18"/></svg>',
    'wardrobe'          => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="3" width="14" height="18" rx="1"/><path d="M12 3v18"/><circle cx="10" cy="12" r=".6" fill="currentColor"/><circle cx="14" cy="12" r=".6" fill="currentColor"/></svg>',
    'ceiling_fan'       => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1.8"/><path d="M12 10.2C12 6.5 9 5 5.5 6 5.5 9.5 8.5 11 12 10.2z"/><path d="M13.8 12C17.5 12 19 9 18 5.5 14.5 5.5 13 8.5 13.8 12z"/><path d="M12 13.8C12 17.5 15 19 18.5 18 18.5 14.5 15.5 13 12 13.8z"/><path d="M10.2 12C6.5 12 5 15 6 18.5 9.5 18.5 11 15.5 10.2 12z"/></svg>',
    'wifi'              => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5a10 10 0 0114 0"/><path d="M8.5 15.5a5 5 0 017 0"/><circle cx="12" cy="18.5" r=".9" fill="currentColor"/></svg>',
    'kettle'            => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M7 9h10l-1 10a2 2 0 01-2 2H10a2 2 0 01-2-2L7 9z"/><path d="M17 11l3-1.5V13"/><path d="M9 6c0-1 1-2 3-2s3 1 3 2H9z"/></svg>',
    'kitchen'           => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 11h16l-1 8a1 1 0 01-1 1H6a1 1 0 01-1-1l-1-8z"/><path d="M4 11V9a1 1 0 011-1h14a1 1 0 011 1v2"/><path d="M8 8V6m8 2V6"/></svg>',
    'cutlery'           => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3v8a2 2 0 002 2v8"/><path d="M8 3v6M10 3v6"/><path d="M16 3c-1.5 0-3 1.5-3 4s1.5 4 3 4v10"/></svg>',
    'utensils'          => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 4h6l-1 7a2 2 0 01-2 2 2 2 0 01-2-2L6 4z"/><path d="M9 13v8"/><path d="M7 21h4"/><path d="M16 4c-1.5 0-2 2-2 4s1 4 2 4v9"/></svg>',
    'hot_water'         => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3c0 4-5 6-5 11a5 5 0 0010 0c0-5-5-7-5-11z"/></svg>',
    'lift'              => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="3" width="14" height="18" rx="1"/><path d="M12 3v18"/><path d="M9 9l1.5-2L12 9M15 15l-1.5 2L12 15"/></svg>',
    'fridge'            => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="3" width="14" height="18" rx="1.5"/><path d="M5 10h14"/><path d="M8 6v2M8 13v3"/></svg>',
    'microwave'         => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="6" width="18" height="12" rx="1.5"/><rect x="5" y="8" width="10" height="8" rx="0.5"/><circle cx="18" cy="10" r=".7" fill="currentColor"/><circle cx="18" cy="13" r=".7" fill="currentColor"/><path d="M18 15.5v1"/></svg>',
    'induction'         => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8 7c0-2 4-2 4 0s-4 1-4 3 4 2 4 0"/><rect x="3" y="13" width="18" height="7" rx="1.5"/><circle cx="7" cy="16.5" r=".7" fill="currentColor"/><circle cx="11" cy="16.5" r=".7" fill="currentColor"/><circle cx="15" cy="16.5" r=".7" fill="currentColor"/></svg>',
    'no_smoking'        => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="13" width="18" height="4" rx="0.5"/><path d="M7 13v4M11 13v4"/><circle cx="12" cy="12" r="9"/><path d="M5.5 5.5l13 13"/></svg>',
    'parking'           => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="1.5"/><path d="M10 16V8h3a2.5 2.5 0 010 5h-3"/></svg>',
    'dining_table'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11h18"/><path d="M5 11v9M19 11v9"/><path d="M7 11V6h3v5M14 11V6h3v5"/><path d="M7 14h3M14 14h3"/></svg>',
    'shower_gel'        => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="8" y="9" width="8" height="12" rx="1.5"/><path d="M10 9V6h4v3"/><path d="M11 4h2"/><path d="M10 13h4M10 16h4"/></svg>',
    'shampoo'           => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="8" width="6" height="13" rx="1"/><path d="M10 8V5h4v3"/><path d="M11 3h2"/><path d="M10 13h4"/></svg>',
    'towels'            => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 4l8 4-8 4-8-4z"/><path d="M4 12l8 4 8-4"/><path d="M4 16l8 4 8-4"/></svg>',
    'outdoor_furniture' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 12h16l-1 4H5z"/><path d="M5 16v4M19 16v4"/><path d="M7 12V8a5 5 0 0110 0v4"/></svg>',
    'caretaker'         => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="7" r="3.5"/><path d="M5 21c0-4 3-7 7-7s7 3 7 7"/><path d="M9 4l-3-1M15 4l3-1"/></svg>',
    'patio'             => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11l9-7 9 7"/><path d="M5 11v9h14v-9"/><path d="M9 20v-5h6v5"/></svg>',
    'balcony'           => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12h18"/><path d="M3 12v8h18v-8"/><path d="M6 12v8M10 12v8M14 12v8M18 12v8"/><path d="M5 12V7h14v5"/></svg>',
    'hair_dryer'        => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9c0-2 2-4 5-4h7a4 4 0 010 8H8c-3 0-5-2-5-4z"/><path d="M11 13l-1 7"/><path d="M13 13l1 4"/><circle cx="8" cy="9" r="1.5"/></svg>',
    'washing_machine'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="3" width="16" height="18" rx="1.5"/><circle cx="12" cy="14" r="4.5"/><circle cx="12" cy="14" r="2"/><circle cx="8" cy="6" r=".6" fill="currentColor"/><circle cx="10.5" cy="6" r=".6" fill="currentColor"/></svg>',
];
@endphp
<div class="mb-5">
    <div class="section-label">Property Facilities</div>
    <h2 class="section-title">Amenities</h2>
    <div class="section-divider"></div>
    <div class="amenities-grid">
        @foreach($amenities as $am)
        <div class="amenity-item">
            <div class="amenity-icon">
                @if(isset($amenitySvgs[$am['icon'] ?? '']))
                    {!! $amenitySvgs[$am['icon']] !!}
                @else
                    <i class="bi bi-check-circle"></i>
                @endif
            </div>
            <span class="amenity-label">{{ $am['label'] ?? '' }}</span>
        </div>
        @endforeach
    </div>
</div>
@endif

            {{-- MASONRY GALLERY --}}
            @if($galleries && $galleries->count() > 5)
            <div class="mb-5">
                <div class="section-label">Explore More</div>
                <h2 class="section-title mb-4">Photo Gallery</h2>
                <div class="masonry-photo-wrap">
                    @foreach($galleries->skip(5) as $img)
                    @php $globalIndex = $galleries->search(fn($g) => $g->id === $img->id); @endphp
                    <div class="masonry-photo-item"
                        onclick="openLightbox({{ $globalIndex !== false ? $globalIndex : ($loop->index + 5) }})">
                        <img src="{{ asset('admin-assets/home/package-gallery/'.$img->image) }}"
                            alt="{{ $img->caption ?? $package->name }} photo">
                        <div class="gallery-overlay">
                            <i class="bi bi-zoom-in gallery-zoom-icon"></i>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- CONTACT & LOCATION --}}
            @if($detail && ($detail->email || $detail->mobile || $detail->address || $detail->map_url))
            <div class="mb-5">
                <div class="section-label">Get In Touch</div>
                <h2 class="section-title">Contact & Location</h2>
                <div class="section-divider"></div>

                <div class="row g-3 mb-4">
                    @if($detail->email)
                    <div class="col-md-6">
                        <div class="highlight-item">
                            <div class="highlight-icon-wrap"><i class="bi bi-envelope-fill"></i></div>
                            <div class="highlight-text">
                                <strong>Email</strong>
                                <span><a href="mailto:{{ $detail->email }}" style="color:var(--primary);text-decoration:none;">{{ $detail->email }}</a></span>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($detail->mobile)
                    <div class="col-md-6">
                        <div class="highlight-item">
                            <div class="highlight-icon-wrap"><i class="bi bi-telephone-fill"></i></div>
                            <div class="highlight-text">
                                <strong>Mobile</strong>
                                <span><a href="tel:{{ $detail->mobile }}" style="color:var(--primary);text-decoration:none;">{{ $detail->mobile }}</a></span>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($detail->address)
                    <div class="col-12">
                        <div class="highlight-item">
                            <div class="highlight-icon-wrap"><i class="bi bi-geo-alt-fill"></i></div>
                            <div class="highlight-text">
                                <strong>Address</strong>
                                <span>{{ $detail->address }}</span>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                @if($detail->map_url)
                <div style="border-radius:var(--radius);overflow:hidden;border:1px solid var(--border);">
                    <iframe src="{{ $detail->map_url }}" width="100%" height="320"
                        style="border:0;display:block;" allowfullscreen loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                @endif
            </div>
            @endif

            {{-- ── ENQUIRY FORM ── --}}
            <div id="enquiry" class="mb-5">
                <div class="section-label">Get In Touch</div>
                <h2 class="section-title">Send an Enquiry</h2>
                <div class="section-divider"></div>

                <div class="form-card">
                    <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
                        @csrf
                        <input type="hidden" name="package_id" value="{{ $package->id }}">
                        <input type="hidden" name="package_name" value="{{ $package->name }}">
                        <input type="hidden" name="source" value="website">

                        @if ($errors->any())
                        <div class="alert alert-danger mb-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label-giki">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name"
                                    class="form-control-giki @error('name') is-invalid @enderror"
                                    placeholder="Your full name" value="{{ old('name') }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-giki">Email Address <span class="text-danger">*</span></label>
                                <input type="email" name="email"
                                    class="form-control-giki @error('email') is-invalid @enderror"
                                    placeholder="you@email.com" value="{{ old('email') }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-giki">Phone Number</label>
                                <input type="tel" name="phone"
                                    class="form-control-giki @error('phone') is-invalid @enderror"
                                    placeholder="+91 98765 43210" value="{{ old('phone') }}">
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-giki">Getaways</label>
                                <input type="text" class="form-control-giki bg-light" value="{{ $package->name }}" readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-giki">Check In Date <span class="text-danger">*</span></label>
                                <input type="text" name="checkin" id="checkinInput"
                                    class="form-control-giki @error('checkin') is-invalid @enderror"
                                    value="{{ old('checkin') }}"
                                    placeholder="Select check-in date"
                                    readonly required>
                                @error('checkin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-giki">Check Out Date <span class="text-danger">*</span></label>
                                <input type="text" name="checkout" id="checkoutInput"
                                    class="form-control-giki @error('checkout') is-invalid @enderror"
                                    value="{{ old('checkout') }}"
                                    placeholder="Select check-out date"
                                    readonly required>
                                @error('checkout')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-giki">Select Travelers <span class="text-danger">*</span></label>
                                <div class="traveler-wrapper" id="travelerWrapper">
                                    <button type="button" class="traveler-trigger" id="travelerTrigger"
                                        aria-haspopup="listbox" aria-expanded="false"
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
                                    <div class="traveler-dropdown" id="travelerDropdown" role="listbox" style="display:none;">
                                        <div class="traveler-row">
                                            <div class="traveler-row-info">
                                                <strong>Adults</strong><small>16+ years</small>
                                            </div>
                                            <div class="traveler-counter">
                                                <button type="button" id="adultMinus" onclick="changeCount('adult', -1)" disabled>−</button>
                                                <span class="count-val" id="adultCount">1</span>
                                                <button type="button" id="adultPlus" onclick="changeCount('adult', 1)">+</button>
                                            </div>
                                        </div>
                                        <div class="traveler-row">
                                            <div class="traveler-row-info">
                                                <strong>Children</strong><small>0 – 16 years</small>
                                            </div>
                                            <div class="traveler-counter">
                                                <button type="button" id="childMinus" onclick="changeCount('child', -1)" disabled>−</button>
                                                <span class="count-val" id="childCount">0</span>
                                                <button type="button" id="childPlus" onclick="changeCount('child', 1)">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-giki">Total People</label>
                                <div class="total-display">
                                    <i class="bi bi-person-check-fill total-display-icon"></i>
                                    <div class="total-display-content">
                                        <div class="total-display-number" id="travelerTotal">1</div>
                                        <div class="total-display-label">People selected</div>
                                    </div>
                                </div>
                                <input type="hidden" name="total_people" id="totalPeopleHidden" value="1">
                            </div>

                            <div class="col-12">
                                <label class="form-label-giki">Your Message</label>
                                <textarea name="message" class="form-control-giki" rows="4"
                                    placeholder="Tell us about your travel preferences or special requirements…">{{ old('message') }}</textarea>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn-submit" id="submitBtn">
                                    Send Enquiry <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- REVIEWS --}}
             @if($reviews->count() > 0)
            <div class="mb-5">
                <div class="section-label">What Travelers Say</div>
                <h2 class="section-title">Reviews &amp; Experiences</h2>
                <div class="section-divider"></div>
                <div class="row g-4">
                    @foreach($reviews as $rv)
                    <div class="col-md-6">
                        <div class="review-card">
                            <div class="d-flex align-items-center gap-3">
                                @if($rv->image)
                                <img src="{{ asset('admin-assets/home/package/' . $rv->image) }}" class="reviewer-avatar" alt="{{ $rv->name }}">
                                @else
                                <div class="reviewer-avatar d-flex align-items-center justify-content-center bg-secondary text-white fw-bold" style="font-size:1.1rem;">
                                    {{ strtoupper(substr($rv->name, 0, 1)) }}
                                </div>
                                @endif
                                <div>
                                    <div class="reviewer-name">{{ $rv->name }}</div>
                                    <div class="reviewer-date">
                                        {{ $rv->review_date }}{{ $rv->review_date && $rv->location ? ' · ' : '' }}{{ $rv->location }}
                                    </div>
                                    <div class="review-stars">
                                        {{ str_repeat('★', (int) $rv->rating) }}{{ str_repeat('☆', 5 - (int) $rv->rating) }}
                                    </div>
                                </div>
                            </div>
                            <p class="review-text">{{ $rv->review }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        {{-- ══ RIGHT COLUMN (STICKY PRICING) ══ --}}
        <div class="col-lg-4">
            <div class="pricing-sticky">
                <div class="pricing-card">
                    <div class="pricing-header">

                        @if($package->advance_price && $package->advance_price < $package->total_price)
                            <div class="price-section-label">Total Price</div>
                            <div class="price-main-amount">₹{{ number_format($package->total_price, 0) }}</div>
                            <div class="price-main-note">total price · all inclusive</div>
                            <div class="price-divider"></div>
                            <div class="advance-box">
                                <div class="advance-box-label">
                                    <i class="bi bi-lightning-charge-fill me-1"></i>Advance Payment
                                </div>
                                <div class="advance-box-amount">₹{{ number_format($package->advance_price, 0) }}</div>
                                <div class="advance-box-note">Book now &nbsp;·&nbsp; pay remaining on arrival</div>
                            </div>
                        @else
                        <div class="price-section-label">Total Price</div>
                        <div class="price-main-amount">₹{{ number_format($package->total_price, 0) }}</div>
                        <div class="price-main-note">per person · all inclusive</div>
                        @endif

                        @if($detail && $detail->offer_badge_text)
                        <span class="price-badge"><i class="bi bi-tag-fill me-1"></i>{{ $detail->offer_badge_text }}</span>
                        @endif
                    </div>

                    <div class="pricing-body">
                        <div class="mb-3">
                            <label class="form-label-giki">Select Date</label>
                            <input type="date" class="form-control-giki mb-3">
                            <label class="form-label-giki">Travelers</label>
                            <select class="form-control-giki">
                                <option>2 People</option>
                                <option>3–4 People</option>
                                <option>5+ People</option>
                            </select>
                        </div>

                        <button class="btn-book" onclick="openEnquiryModal()">
                            Book Now <i class="bi bi-arrow-right"></i>
                        </button>

                        <div class="mt-3 p-3 rounded-3" style="background:#f8f6f0;border:1px solid var(--border);font-size:.82rem;color:var(--muted);">
                            <div class="mb-2" style="font-weight:700;color:var(--dark);font-size:.85rem;">Package Summary</div>

                            @if($locationDisplay)
                            <div class="d-flex justify-content-between mb-1 align-items-start gap-2">
                                <span style="flex-shrink:0;">Location</span>
                                <span style="color:var(--dark);font-weight:600;text-align:right;">{{ $locationDisplay }}</span>
                            </div>
                            @endif

                            @if($package->capacity)
                            <div class="d-flex justify-content-between mb-1">
                                <span>Max Group</span>
                                <span style="color:var(--dark);font-weight:600;">{{ $package->capacity }} pax</span>
                            </div>
                            @endif

                            <div class="d-flex justify-content-between pt-2 mt-1" style="border-top:1px dashed var(--border);">
                                <span style="font-weight:600;color:var(--dark);">Total Price</span>
                                <span style="color:var(--primary);font-weight:800;font-size:.95rem;">₹{{ number_format($package->total_price, 0) }}</span>
                            </div>

                            @if($package->advance_price && $package->advance_price < $package->total_price)
                                <div class="d-flex justify-content-between mt-1">
                                    <span style="color:#22c55e;font-weight:600;">Pay Now (Advance)</span>
                                    <span style="color:#22c55e;font-weight:800;">₹{{ number_format($package->advance_price, 0) }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-3">
                    <button class="btn w-100 d-flex align-items-center justify-content-center gap-2"
                        onclick="sharePackage()"
                        style="border:1.5px solid var(--border);border-radius:50px;font-size:.85rem;font-weight:600;padding:10px;background:#fff;">
                        <i class="bi bi-share"></i> Share
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- ── RELATED PACKAGES SECTION ── --}}
@if($packages->count() > 0)
<div class="home3-travel-package-section mb-100">
    <div class="container">
        <div class="row justify-content-center mb-50">
            <div class="col-xl-6 col-lg-8">
                <div class="section-title text-center">
                    <h2>Similar Escapes</h2>
                    <p>You May Also Like</p>
                </div>
            </div>
        </div>
        <div class="swiper related-package-slider mb-40">
            <div class="swiper-wrapper">
                @foreach($packages as $pkg)
                <div class="swiper-slide">
                    <div class="package-card">
                        <div class="package-img-wrap">
                            <a href="{{ url('travel-package-detail', $pkg->slug) }}" class="package-img">
                                <img src="{{ asset('admin-assets/home/package/' . $pkg->image) }}"
                                    alt="{{ $pkg->name }}"
                                    style="width:100%; height:220px; object-fit:cover; border-radius:10px;">
                            </a>
                            @if($pkg->tag)
                            <div class="batch"><span>{{ $pkg->tag }}</span></div>
                            @endif
                            <div style="position:absolute;bottom:12px;left:12px;background:rgba(0,0,0,0.55);color:#fff;font-size:12px;font-weight:600;padding:5px 12px;border-radius:20px;display:flex;align-items:center;gap:5px;z-index:1;backdrop-filter:blur(4px);">
                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" />
                                    <polyline points="12 6 12 12 16 14" />
                                </svg>
                                {{ $pkg->days }} Days
                            </div>
                        </div>
                        <div class="package-content">
                            <h5><a href="{{ url('travel-package-detail', $pkg->slug) }}">{{ $pkg->name }}</a></h5>
                            <div class="location-and-time">
                                <div class="location">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:3px;">
                                        <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    <a href="#">
                                        {{ $pkg->country->name ?? '' }}
                                        @if($pkg->state?->state_name)
                                        , {{ $pkg->state->state_name }}
                                        @endif
                                        @if($pkg->city?->name)
                                        , {{ $pkg->city->name }}
                                        @endif
                                    </a>
                                </div>
                                <span>{{ $pkg->days }} Days</span>
                            </div>
                            @if($pkg->short_description)
                            <p style="font-size:13.5px;color:#64748b;line-height:1.65;margin:10px 0 14px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                                {{ $pkg->short_description }}
                            </p>
                            @endif
                            <div class="btn-and-price-area">
                                <a href="{{ url('travel-package-detail', $pkg->slug) }}" class="primary-btn1">
                                    <span>Book Now</span>
                                </a>
                                <div class="price-area">
                                    <span>₹{{ number_format($pkg->total_price, 0) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="slider-btn-grp two d-flex justify-content-center gap-3 mb-40">
            <div class="slider-btn related-package-slider-prev" tabindex="0" role="button">
                <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 5.31421H16V6.68564H0V5.31421Z" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.685714 6.68569C3.9104 6.68569 6.54629 3.84958 6.54629 0.825119V0.139404H5.17486V0.825119C5.17486 3.12181 3.12412 5.31426 0.685714 5.31426H0V6.68569H0.685714Z" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.685714 5.31421C3.9104 5.31421 6.54629 8.15032 6.54629 11.1748V11.8605H5.17486V11.1748C5.17486 8.87901 3.12412 6.68564 0.685714 6.68564H0V5.31421H0.685714Z" />
                </svg>
            </div>
            <div class="slider-btn related-package-slider-next" tabindex="0" role="button">
                <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16 7.31421H-3.8147e-06V8.68564H16V7.31421Z" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.3143 8.68569C12.0896 8.68569 9.45371 5.84958 9.45371 2.82512V2.1394H10.8251V2.82512C10.8251 5.12181 12.8759 7.31426 15.3143 7.31426H16V8.68569H15.3143Z" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.3143 7.31421C12.0896 7.31421 9.45371 10.1503 9.45371 13.1748V13.8605H10.8251V13.1748C10.8251 10.879 12.8759 8.68564 15.3143 8.68564H16V7.31421H15.3143Z" />
                </svg>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <a href="{{ url('/travel-package') }}" class="primary-btn1 two black-bg">
                    <span>View All Packages
                        <svg width="10" height="10" viewBox="0 0 10 10" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.73535 1.14746C9.57033 1.97255 9.32924 3.26406 9.24902 4.66797C9.16817 6.08312 9.25559 7.5453 9.70214 8.73633C9.84754 9.12406 9.65129 9.55659 9.26367 9.70215C8.9001 9.83849 8.4969 9.67455 8.32812 9.33398L8.29785 9.26367L8.19921 8.98438C7.73487 7.5758 7.67054 5.98959 7.75097 4.58203C7.77875 4.09598 7.82525 3.62422 7.87988 3.17969L1.53027 9.53027C1.23738 9.82317 0.762615 9.82317 0.469722 9.53027C0.176829 9.23738 0.176829 8.76262 0.469722 8.46973L6.83593 2.10254C6.3319 2.16472 5.79596 2.21841 5.25 2.24902C3.8302 2.32862 2.2474 2.26906 0.958003 1.79102L0.704097 1.68945L0.635738 1.65527C0.303274 1.47099 0.157578 1.06102 0.310542 0.704102C0.463655 0.347333 0.860941 0.170391 1.22363 0.28418L1.29589 0.310547L1.48828 0.387695C2.47399 0.751207 3.79966 0.827571 5.16601 0.750977C6.60111 0.670504 7.97842 0.428235 8.86132 0.262695L9.95312 0.0585938L9.73535 1.14746Z" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('.related-package-slider', {
            slidesPerView: 1,
            spaceBetween: 24,
            loop: true,
            navigation: {
                nextEl: '.related-package-slider-next',
                prevEl: '.related-package-slider-prev',
            },
            breakpoints: {
                576: { slidesPerView: 1 },
                768: { slidesPerView: 2 },
                1200: { slidesPerView: 3 },
            }
        });
    });
</script>
@endif

{{-- ── LIGHTBOX ── --}}
<div class="lightbox" id="lightbox">
    <span class="lightbox-close" onclick="closeLightbox()"><i class="bi bi-x-lg"></i></span>
    <img id="lightbox-img" src="" alt="">

    <div class="lightbox-caption empty" id="lightboxCaption">
        <i class="bi bi-card-text caption-icon"></i>
        <span id="lightboxCaptionText"></span>
    </div>

    <div class="lightbox-nav" id="lightboxNav" style="display:none;">
        <button class="lightbox-nav-btn" onclick="lightboxPrev()">
            <i class="bi bi-chevron-left"></i> Prev
        </button>
        <span class="lightbox-counter" id="lightboxCounter">1 / 1</span>
        <button class="lightbox-nav-btn" onclick="lightboxNext()">
            Next <i class="bi bi-chevron-right"></i>
        </button>
    </div>
</div>

{{-- ── ENQUIRY MODAL ── --}}
<div class="enquiry-modal-overlay" id="enquiryModalOverlay" onclick="handleOverlayClick(event)">
    <div class="enquiry-modal" id="enquiryModal">

        <div class="modal-header">
            <div class="modal-header-left">
                <div class="modal-title">Send an Enquiry</div>
                <div class="modal-subtitle">{{ $package->name }} · Fill your details below</div>
            </div>
            <button class="modal-close-btn" onclick="closeEnquiryModal()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <div class="modal-body">
            <form action="{{ route('booking.store') }}" method="POST" id="modalBookingForm">
                @csrf
                <input type="hidden" name="package_id" value="{{ $package->id }}">
                <input type="hidden" name="package_name" value="{{ $package->name }}">
                <input type="hidden" name="source" value="website">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-giki">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control-giki" placeholder="Your full name" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-giki">Email Address <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control-giki" placeholder="you@email.com" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-giki">Phone Number</label>
                        <input type="tel" name="phone" class="form-control-giki" placeholder="+91 98765 43210">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-giki">Getaways</label>
                        <input type="text" class="form-control-giki" value="{{ $package->name }}" readonly style="background:#f0f0f0;">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-giki">Check In Date <span class="text-danger">*</span></label>
                        <input type="text" name="checkin" id="modalCheckinInput" class="form-control-giki" placeholder="Select check-in date" readonly required>
                        <div class="date-legend">
                            <span><span class="date-legend-dot" style="background:#fff0f0;border:1px solid #feb2b2;"></span>Booked</span>
                            <span><span class="date-legend-dot" style="background:var(--primary);"></span>Selected</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-giki">Check Out Date <span class="text-danger">*</span></label>
                        <input type="text" name="checkout" id="modalCheckoutInput" class="form-control-giki" placeholder="Select check-out date" readonly required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-giki">Select Travelers <span class="text-danger">*</span></label>
                        <div class="traveler-wrapper" id="modalTravelerWrapper">
                            <button type="button" class="traveler-trigger" id="modalTravelerTrigger"
                                aria-haspopup="listbox" aria-expanded="false"
                                onclick="toggleModalTravelerDropdown()">
                                <i class="bi bi-people tv-icon"></i>
                                <span class="tv-content">
                                    <span class="tv-value" id="modalTravelerDisplay">1 Adult</span>
                                    <span class="tv-sub">Adults &amp; Children</span>
                                </span>
                                <i class="bi bi-chevron-down tv-arrow"></i>
                            </button>
                            <input type="hidden" name="adult" id="modalAdultHidden" value="1">
                            <input type="hidden" name="child" id="modalChildHidden" value="0">
                            <div class="traveler-dropdown" id="modalTravelerDropdown" role="listbox" style="display:none;">
                                <div class="traveler-row">
                                    <div class="traveler-row-info">
                                        <strong>Adults</strong><small>16+ years</small>
                                    </div>
                                    <div class="traveler-counter">
                                        <button type="button" id="modalAdultMinus" onclick="modalChangeCount('adult', -1)" disabled>−</button>
                                        <span class="count-val" id="modalAdultCount">1</span>
                                        <button type="button" onclick="modalChangeCount('adult', 1)">+</button>
                                    </div>
                                </div>
                                <div class="traveler-row">
                                    <div class="traveler-row-info">
                                        <strong>Children</strong><small>0 – 16 years</small>
                                    </div>
                                    <div class="traveler-counter">
                                        <button type="button" id="modalChildMinus" onclick="modalChangeCount('child', -1)" disabled>−</button>
                                        <span class="count-val" id="modalChildCount">0</span>
                                        <button type="button" onclick="modalChangeCount('child', 1)">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-giki">Total People</label>
                        <div class="total-display">
                            <i class="bi bi-person-check-fill total-display-icon"></i>
                            <div class="total-display-content">
                                <div class="total-display-number" id="modalTravelerTotal">1</div>
                                <div class="total-display-label">People selected</div>
                            </div>
                        </div>
                        <input type="hidden" name="total_people" id="modalTotalPeopleHidden" value="1">
                    </div>

                    <div class="col-12">
                        <label class="form-label-giki">Your Message</label>
                        <textarea name="message" class="form-control-giki" rows="3"
                            placeholder="Tell us about your travel preferences or special requirements…"></textarea>
                    </div>
                </div>
            </form>
        </div>

        <div class="modal-footer">
            <button class="btn-modal-submit" onclick="submitModalForm()">
                <i class="bi bi-send-fill"></i> Send Enquiry
            </button>
        </div>

    </div>
</div>

@endsection

@section('js')
<script>
/* ════════════════════════════════════════════
   GALLERY DATA — built directly from PHP
   src and caption are JSON-encoded so all
   special characters, quotes, newlines etc.
   are safely escaped automatically.
════════════════════════════════════════════ */
var galleryImages = [
    @if($galleries && $galleries->count() > 0)
        @foreach($galleries as $img)
        {
            src:     {{ Js::from(asset('admin-assets/home/package-gallery/' . $img->image)) }},
            caption: {{ Js::from($img->caption ?? '') }}
        }{{ !$loop->last ? ',' : '' }}
        @endforeach
    @endif
];

/* ════════════════════════════════════════════
   LIGHTBOX
════════════════════════════════════════════ */
var _lbIndex = 0;

function openLightbox(index) {
    _lbIndex = index || 0;
    if (!galleryImages[_lbIndex]) return;

    document.getElementById('lightbox-img').src = galleryImages[_lbIndex].src;
    _setCaption(galleryImages[_lbIndex].caption);
    document.getElementById('lightbox').classList.add('active');
    document.body.style.overflow = 'hidden';

    if (galleryImages.length > 1) {
        document.getElementById('lightboxNav').style.display = 'flex';
        _updateCounter();
    } else {
        document.getElementById('lightboxNav').style.display = 'none';
    }
}

function closeLightbox() {
    document.getElementById('lightbox').classList.remove('active');
    document.body.style.overflow = '';
}

document.getElementById('lightbox').addEventListener('click', function(e) {
    if (e.target === this) closeLightbox();
});

function lightboxPrev() {
    _lbIndex = (_lbIndex - 1 + galleryImages.length) % galleryImages.length;
    document.getElementById('lightbox-img').src = galleryImages[_lbIndex].src;
    _setCaption(galleryImages[_lbIndex].caption);
    _updateCounter();
}

function lightboxNext() {
    _lbIndex = (_lbIndex + 1) % galleryImages.length;
    document.getElementById('lightbox-img').src = galleryImages[_lbIndex].src;
    _setCaption(galleryImages[_lbIndex].caption);
    _updateCounter();
}

function _updateCounter() {
    document.getElementById('lightboxCounter').textContent =
        (_lbIndex + 1) + ' / ' + galleryImages.length;
}

function _setCaption(text) {
    var box  = document.getElementById('lightboxCaption');
    var span = document.getElementById('lightboxCaptionText');
    if (!box || !span) return;
    var clean = (text || '').trim();
    var packageName = {{ Js::from($package->name) }};
    span.textContent = clean ? clean : packageName;
    box.classList.remove('empty');
}


document.addEventListener('keydown', function(e) {
    var lb = document.getElementById('lightbox');
    if (lb.classList.contains('active')) {
        if (e.key === 'Escape')      { closeLightbox(); return; }
        if (e.key === 'ArrowLeft')   { lightboxPrev();  return; }
        if (e.key === 'ArrowRight')  { lightboxNext();  return; }
    }
    if (e.key === 'Escape') closeEnquiryModal();
});

/* ════════════════════════════════════════════
   SHARE
════════════════════════════════════════════ */
function sharePackage() {
    if (navigator.share) {
        navigator.share({ title: document.title, url: window.location.href });
    } else {
        navigator.clipboard.writeText(window.location.href)
            .then(function() { alert('Link copied to clipboard!'); });
    }
}

/* ════════════════════════════════════════════
   PAGE TRAVELER SELECTOR
════════════════════════════════════════════ */
(function () {
    var adults   = 1;
    var children = 0;

    window.toggleTravelerDropdown = function () {
        var dd      = document.getElementById('travelerDropdown');
        var trigger = document.getElementById('travelerTrigger');
        var isOpen  = dd.style.display === 'block';
        dd.style.display = isOpen ? 'none' : 'block';
        trigger.setAttribute('aria-expanded', !isOpen);
        trigger.classList.toggle('open', !isOpen);
    };

    document.addEventListener('click', function (e) {
        var w = document.getElementById('travelerWrapper');
        if (w && !w.contains(e.target)) {
            document.getElementById('travelerDropdown').style.display = 'none';
            var t = document.getElementById('travelerTrigger');
            t.setAttribute('aria-expanded', 'false');
            t.classList.remove('open');
        }
    });

    window.changeCount = function (type, delta) {
        if (type === 'adult')  adults   = Math.max(1, adults   + delta);
        else                   children = Math.max(0, children + delta);
        var total = adults + children;
        document.getElementById('adultCount').textContent           = adults;
        document.getElementById('childCount').textContent           = children;
        document.getElementById('adultHidden').value                = adults;
        document.getElementById('childHidden').value                = children;
        document.getElementById('adultMinus').disabled              = (adults   <= 1);
        document.getElementById('childMinus').disabled              = (children <= 0);
        document.getElementById('travelerTotal').textContent        = total;
        document.getElementById('totalPeopleHidden').value          = total;
        document.getElementById('travelerDisplay').textContent      =
            adults + ' Adult' + (adults !== 1 ? 's' : '') +
            (children > 0 ? ', ' + children + ' Child' + (children !== 1 ? 'ren' : '') : '');
        document.getElementById('travelerDisplay').classList.remove('placeholder');
    };
})();

/* ════════════════════════════════════════════
   MODAL TRAVELER SELECTOR
════════════════════════════════════════════ */
(function () {
    var mAdults   = 1;
    var mChildren = 0;

    window.toggleModalTravelerDropdown = function () {
        var dd      = document.getElementById('modalTravelerDropdown');
        var trigger = document.getElementById('modalTravelerTrigger');
        var isOpen  = dd.style.display === 'block';
        dd.style.display = isOpen ? 'none' : 'block';
        trigger.setAttribute('aria-expanded', !isOpen);
        trigger.classList.toggle('open', !isOpen);
    };

    document.addEventListener('click', function (e) {
        var w = document.getElementById('modalTravelerWrapper');
        if (w && !w.contains(e.target)) {
            var dd = document.getElementById('modalTravelerDropdown');
            var tr = document.getElementById('modalTravelerTrigger');
            if (dd) dd.style.display = 'none';
            if (tr) { tr.setAttribute('aria-expanded', 'false'); tr.classList.remove('open'); }
        }
    });

    window.modalChangeCount = function (type, delta) {
        if (type === 'adult')  mAdults   = Math.max(1, mAdults   + delta);
        else                   mChildren = Math.max(0, mChildren + delta);
        var total = mAdults + mChildren;
        document.getElementById('modalAdultCount').textContent      = mAdults;
        document.getElementById('modalChildCount').textContent      = mChildren;
        document.getElementById('modalAdultHidden').value           = mAdults;
        document.getElementById('modalChildHidden').value           = mChildren;
        document.getElementById('modalAdultMinus').disabled         = (mAdults   <= 1);
        document.getElementById('modalChildMinus').disabled         = (mChildren <= 0);
        document.getElementById('modalTravelerTotal').textContent   = total;
        document.getElementById('modalTotalPeopleHidden').value     = total;
        document.getElementById('modalTravelerDisplay').textContent =
            mAdults + ' Adult' + (mAdults !== 1 ? 's' : '') +
            (mChildren > 0 ? ', ' + mChildren + ' Child' + (mChildren !== 1 ? 'ren' : '') : '');
    };
})();

/* ════════════════════════════════════════════
   MODAL OPEN / CLOSE
════════════════════════════════════════════ */
var modalCheckinPicker  = null;
var modalCheckoutPicker = null;

function openEnquiryModal() {
    document.getElementById('enquiryModalOverlay').classList.add('active');
    document.body.style.overflow = 'hidden';
    if (!modalCheckinPicker) { initModalPickers(); }
}

function closeEnquiryModal() {
    document.getElementById('enquiryModalOverlay').classList.remove('active');
    document.body.style.overflow = '';
}

function handleOverlayClick(e) {
    if (e.target === document.getElementById('enquiryModalOverlay')) {
        closeEnquiryModal();
    }
}

function submitModalForm() {
    var ci = document.getElementById('modalCheckinInput').value;
    var co = document.getElementById('modalCheckoutInput').value;
    if (!ci) { alert('Please select a check-in date.');  return; }
    if (!co) { alert('Please select a check-out date.'); return; }
    document.getElementById('modalBookingForm').submit();
}

/* ════════════════════════════════════════════
   DATE PICKER — PAGE + MODAL
════════════════════════════════════════════ */
(function () {
    var packageId   = {{ $package->id }};
    var today       = new Date().toISOString().split('T')[0];
    var bookedDates = [];

    fetch('/travel-tour/api/package/' + packageId + '/booked-dates')
        .then(function(r) { return r.json(); })
        .then(function(dates) { bookedDates = dates; initPagePickers(); })
        .catch(function()    { initPagePickers(); });

    function isBooked(dateStr) { return bookedDates.includes(dateStr); }

    function formatDate(d) {
        var y   = d.getFullYear();
        var m   = String(d.getMonth() + 1).padStart(2, '0');
        var day = String(d.getDate()).padStart(2, '0');
        return y + '-' + m + '-' + day;
    }

    function rangeHasBookedDate(from, to) {
        var cur = new Date(from);
        cur.setDate(cur.getDate() + 1);
        var end = new Date(to);
        while (cur < end) {
            if (isBooked(formatDate(cur))) return true;
            cur.setDate(cur.getDate() + 1);
        }
        return false;
    }

    function dayCreateFn(dObj, dStr, fp, dayElem) {
        if (isBooked(formatDate(dayElem.dateObj))) {
            dayElem.classList.add('booked-date');
            dayElem.title = 'Already booked';
        }
    }

    function disableFn(date) { return isBooked(formatDate(date)); }

    function addLegend(inputEl) {
        if (inputEl.parentNode.querySelector('.date-legend')) return;
        var legend = document.createElement('div');
        legend.className = 'date-legend';
        legend.innerHTML =
            '<span><span class="date-legend-dot" style="background:#fff0f0;border:1px solid #feb2b2;"></span>Booked / Unavailable</span>' +
            '<span><span class="date-legend-dot" style="background:var(--primary);"></span>Selected</span>';
        inputEl.parentNode.appendChild(legend);
    }

    var checkinPicker  = null;
    var checkoutPicker = null;

    function initPagePickers() {
        checkinPicker = flatpickr('#checkinInput', {
            dateFormat:    'Y-m-d',
            minDate:       today,
            disableMobile: false,
            defaultDate:   document.getElementById('checkinInput').value || null,
            onDayCreate:   dayCreateFn,
            disable:       [disableFn],
            onChange: function (selectedDates, dateStr) {
                if (!dateStr) return;
                var next = new Date(selectedDates[0]);
                next.setDate(next.getDate() + 1);
                if (checkoutPicker) {
                    checkoutPicker.set('minDate', formatDate(next));
                    var coVal = checkoutPicker.selectedDates[0];
                    if (coVal && coVal <= selectedDates[0]) checkoutPicker.clear();
                }
                clearDateError('checkin');
            }
        });

        checkoutPicker = flatpickr('#checkoutInput', {
            dateFormat:    'Y-m-d',
            minDate:       new Date(new Date(today).getTime() + 86400000),
            disableMobile: false,
            defaultDate:   document.getElementById('checkoutInput').value || null,
            onDayCreate:   dayCreateFn,
            disable:       [disableFn],
            onChange: function (selectedDates, dateStr) {
                if (!dateStr) return;
                var ci = checkinPicker ? checkinPicker.selectedDates[0] : null;
                if (ci && rangeHasBookedDate(formatDate(ci), dateStr)) {
                    showDateError('checkout', 'Some dates in this range are already booked. Please choose different dates.');
                    checkoutPicker.clear();
                    return;
                }
                clearDateError('checkout');
            }
        });

        addLegend(document.getElementById('checkinInput'));
        addLegend(document.getElementById('checkoutInput'));
    }

    window.initModalPickers = function () {
        modalCheckinPicker = flatpickr('#modalCheckinInput', {
            dateFormat:    'Y-m-d',
            minDate:       today,
            disableMobile: false,
            onDayCreate:   dayCreateFn,
            disable:       [disableFn],
            onChange: function (selectedDates, dateStr) {
                if (!dateStr) return;
                var next = new Date(selectedDates[0]);
                next.setDate(next.getDate() + 1);
                if (modalCheckoutPicker) {
                    modalCheckoutPicker.set('minDate', formatDate(next));
                    var coVal = modalCheckoutPicker.selectedDates[0];
                    if (coVal && coVal <= selectedDates[0]) modalCheckoutPicker.clear();
                }
            }
        });

        modalCheckoutPicker = flatpickr('#modalCheckoutInput', {
            dateFormat:    'Y-m-d',
            minDate:       new Date(new Date(today).getTime() + 86400000),
            disableMobile: false,
            onDayCreate:   dayCreateFn,
            disable:       [disableFn],
            onChange: function (selectedDates, dateStr) {
                if (!dateStr) return;
                var ci = modalCheckinPicker ? modalCheckinPicker.selectedDates[0] : null;
                if (ci && rangeHasBookedDate(formatDate(ci), dateStr)) {
                    alert('Some dates in this range are already booked. Please choose different dates.');
                    modalCheckoutPicker.clear();
                }
            }
        });
    };

    window.showDateError = function (field, msg) {
        var el = document.getElementById(field + 'Input');
        el.classList.add('is-invalid');
        var old = el.parentNode.querySelector('.date-error-msg');
        if (old) old.remove();
        var fb = document.createElement('div');
        fb.className     = 'invalid-feedback date-error-msg';
        fb.style.display = 'block';
        fb.textContent   = msg;
        el.parentNode.insertBefore(fb, el.nextSibling);
    };

    window.clearDateError = function (field) {
        var el = document.getElementById(field + 'Input');
        el.classList.remove('is-invalid');
        var fb = el.parentNode.querySelector('.date-error-msg');
        if (fb) fb.remove();
    };

    document.getElementById('bookingForm').addEventListener('submit', function (e) {
        var ci = document.getElementById('checkinInput').value;
        var co = document.getElementById('checkoutInput').value;
        if (!ci) { e.preventDefault(); showDateError('checkin',  'Please select a check-in date.');  return; }
        if (!co) { e.preventDefault(); showDateError('checkout', 'Please select a check-out date.'); return; }
        if (isBooked(ci) || isBooked(co)) {
            e.preventDefault();
            showDateError('checkin', 'Selected dates are already booked.');
            return;
        }
        if (rangeHasBookedDate(ci, co)) {
            e.preventDefault();
            showDateError('checkout', 'Some dates in this range are already booked.');
        }
    });
})();
</script>
@endsection