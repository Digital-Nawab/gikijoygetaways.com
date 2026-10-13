@extends('admin.layout.master')

@section('content')

<style>
  @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

  .bk-page { min-height:100vh; background:#F2F4F7; padding:0; font-family:'Plus Jakarta Sans',sans-serif; }

  /* HERO */
  .bk-hero {
    background:linear-gradient(135deg,#1A1F2E 0%,#2D3550 60%,#3B4068 100%);
    padding:2rem 2.5rem 4.5rem; position:relative; overflow:hidden;
  }
  .bk-hero::before { content:''; position:absolute; top:-60px; right:-60px; width:220px; height:220px; border-radius:50%; background:rgba(255,255,255,0.03); }
  .bk-hero::after  { content:''; position:absolute; bottom:-40px; left:30%; width:300px; height:300px; border-radius:50%; background:rgba(99,132,255,0.06); }
  .bk-hero-inner   { display:flex; align-items:center; justify-content:space-between; gap:1rem; position:relative; z-index:1; }
  .bk-hero-left    { display:flex; align-items:center; gap:1rem; }
  .bk-back-btn {
    width:40px; height:40px; border-radius:10px;
    background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.15);
    display:grid; place-items:center; text-decoration:none; transition:background .2s; flex-shrink:0;
  }
  .bk-back-btn:hover { background:rgba(255,255,255,0.18); }
  .bk-back-btn svg  { width:16px; height:16px; color:#fff; }
  .bk-hero-badge {
    display:inline-flex; align-items:center; gap:5px;
    background:rgba(99,132,255,0.2); border:1px solid rgba(99,132,255,0.3);
    color:#A5B4FC; font-size:0.7rem; font-weight:600; letter-spacing:0.08em;
    text-transform:uppercase; padding:3px 10px; border-radius:20px; margin-bottom:0.5rem;
  }
  .bk-hero-badge::before { content:''; width:5px; height:5px; border-radius:50%; background:#818CF8; }
  .bk-hero-titles h1 { font-size:1.6rem; font-weight:700; color:#fff; margin:0; line-height:1.2; }
  .bk-hero-titles p  { font-size:0.8125rem; color:rgba(255,255,255,0.45); margin:0.3rem 0 0; }
  .bk-hero-stats {
    display:flex; gap:1px; background:rgba(255,255,255,0.08);
    border:1px solid rgba(255,255,255,0.1); border-radius:12px; overflow:hidden;
  }
  .bk-hero-stat     { padding:0.75rem 1.25rem; text-align:center; background:rgba(255,255,255,0.04); }
  .bk-hero-stat-val { font-size:1.25rem; font-weight:700; color:#fff; line-height:1; }
  .bk-hero-stat-lbl { font-size:0.7rem; color:rgba(255,255,255,0.4); margin-top:3px; text-transform:uppercase; letter-spacing:0.05em; }

  /* BODY */
  .bk-body { padding:0 2rem 3rem; margin-top:-2.5rem; position:relative; z-index:2; }
  .bk-grid { display:grid; grid-template-columns:1fr 310px; gap:1.25rem; align-items:start; }
  @media(max-width:900px) {
    .bk-grid { grid-template-columns:1fr; }
    .bk-hero { padding:1.5rem 1.25rem 4rem; }
    .bk-body { padding:0 1rem 3rem; }
    .bk-hero-stats { display:none; }
  }

  /* CARDS */
  .bk-card { background:#fff; border:1px solid #E8EBF0; border-radius:14px; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.04); }
  .bk-card + .bk-card { margin-top:1rem; }
  .bk-card-head {
    padding:0.875rem 1.375rem; border-bottom:1px solid #F0F2F6;
    display:flex; align-items:center; gap:0.75rem; background:#FAFBFC;
  }
  .bk-icon { width:32px; height:32px; border-radius:8px; display:grid; place-items:center; flex-shrink:0; }
  .bk-icon svg { width:15px; height:15px; }
  .ic-blue   { background:#EEF4FF; color:#3B6FE8; }
  .ic-orange { background:#FFF4EC; color:#D4731A; }
  .ic-teal   { background:#EDFAF5; color:#0E9070; }
  .ic-violet { background:#F3F0FF; color:#6040C2; }
  .ic-slate  { background:#F0F3F8; color:#4A5A7A; }
  .ic-green  { background:#EDFAF3; color:#1A8A52; }
  .ic-red    { background:#FFF0F0; color:#C53030; }
  .ic-pink   { background:#FFF0F8; color:#C0307A; }
  .bk-card-head h3   { font-size:0.8125rem; font-weight:700; color:#1A2035; margin:0; }
  .bk-card-head span { margin-left:auto; font-size:0.7rem; color:#9BA5B8; font-weight:500; }
  .bk-card-body { padding:1.25rem 1.375rem; }

  /* FIELDS */
  .frow { display:grid; gap:1rem; margin-bottom:1rem; }
  .frow:last-child { margin-bottom:0; }
  .frow.c2 { grid-template-columns:1fr 1fr; }
  .frow.c3 { grid-template-columns:1fr 1fr 1fr; }
  @media(max-width:560px) { .frow.c2,.frow.c3 { grid-template-columns:1fr; } }
  .fg { display:flex; flex-direction:column; gap:0.3rem; }
  .fg label { font-size:0.72rem; font-weight:700; color:#6B7A9A; text-transform:uppercase; letter-spacing:0.055em; }
  .fg label em { color:#E05454; font-style:normal; font-size:0.65rem; }
  .fi,.fs,.fta {
    font-family:'Plus Jakarta Sans',sans-serif; font-size:0.875rem; color:#1A2035;
    background:#F8F9FB; border:1.5px solid #E8EBF0; border-radius:10px;
    padding:0.6rem 0.9rem; outline:none; width:100%; box-sizing:border-box;
    transition:border-color .15s,background .15s,box-shadow .15s;
  }
  .fi::placeholder,.fta::placeholder { color:#BEC6D6; }
  .fi:focus,.fs:focus,.fta:focus { border-color:#6084E8; background:#fff; box-shadow:0 0 0 3px rgba(96,132,232,0.1); }
  .fi.disabled { background:#F0F3F8; color:#8A96AA; cursor:not-allowed; border-style:dashed; font-weight:700; }
  .fi.calc-field { background:#F0FDF4; color:#15803D; border:1.5px dashed #86EFAC; font-weight:700; cursor:default; }
  .fi.calc-field:focus { box-shadow:none; border-color:#86EFAC; }
  .fs {
    appearance:none; cursor:pointer;
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='11' viewBox='0 0 24 24' fill='none' stroke='%239BA5B8' stroke-width='2.5' stroke-linecap='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat:no-repeat; background-position:right 0.875rem center; background-color:#F8F9FB; padding-right:2.25rem;
  }
  .fta { resize:none; line-height:1.65; }

  /* PRICE WRAP */
  .price-wrap { position:relative; display:flex; }
  .price-wrap .p-sym {
    position:absolute; left:0.75rem; top:50%; transform:translateY(-50%);
    font-size:0.875rem; font-weight:700; color:#3B6FE8; pointer-events:none; z-index:1;
  }
  .price-wrap .fi { padding-left:1.75rem; }
  .price-wrap .calc-field .p-sym,
  .price-wrap .fi.calc-field { color:#15803D; }

  .calc-note {
    font-size:0.69rem; color:#86EFAC; font-weight:600;
    display:flex; align-items:center; gap:4px; margin-top:0.2rem;
  }
  .calc-note svg { width:10px; height:10px; flex-shrink:0; }

  /* LIVE BREAKDOWN */
  .breakdown-box {
    display:none; margin-top:1rem;
    background:linear-gradient(135deg,#F0FDF4,#ECFDF5);
    border:1.5px solid #86EFAC; border-radius:12px; padding:1rem 1.125rem;
  }
  .breakdown-box.show { display:block; }
  .bd-title {
    font-size:0.7rem; font-weight:700; color:#065F46; text-transform:uppercase;
    letter-spacing:0.07em; margin-bottom:0.625rem;
    display:flex; align-items:center; gap:5px;
  }
  .bd-row { display:flex; justify-content:space-between; align-items:center; padding:0.375rem 0; border-bottom:1px dashed rgba(16,185,129,0.2); }
  .bd-row:last-child { border-bottom:none; padding-top:0.5rem; }
  .bd-lbl { font-size:0.775rem; color:#4B7C6A; font-weight:500; }
  .bd-val { font-size:0.85rem; color:#065F46; font-weight:700; }
  .bd-row.bd-rem .bd-val { color:#D97706; font-size:0.9rem; }
  .bd-row.bd-tot .bd-val { color:#059669; }

  /* SOURCE BADGE */
  .source-badge {
    display:inline-flex; align-items:center; gap:6px; padding:0.5rem 0.9rem;
    border-radius:8px; font-size:0.8rem; font-weight:700; margin-top:0.5rem;
    background:#EEF4FF; color:#2B55C9; border:1px solid #C7D9FF;
    width:100%; box-sizing:border-box;
  }
  .source-badge svg { width:14px; height:14px; }

  /* STATUS BADGE */
  .status-badge {
    display:inline-flex; align-items:center; gap:6px; padding:0.45rem 0.875rem;
    border-radius:8px; font-size:0.8rem; font-weight:600; margin-top:0.5rem;
    width:100%; box-sizing:border-box;
  }
  .status-badge .bdot { width:7px; height:7px; border-radius:50%; flex-shrink:0; }
  .sb-pending   { background:#FFF8ED; color:#92600A; border:1px solid #FDE8B0; }
  .sb-pending   .bdot { background:#D97706; }
  .sb-confirmed { background:#EDFAF3; color:#145C38; border:1px solid #A7F0C9; }
  .sb-confirmed .bdot { background:#16A34A; }
  .sb-cancelled { background:#FFF0F0; color:#9B1B1B; border:1px solid #FECACA; }
  .sb-cancelled .bdot { background:#EF4444; }
  .sb-paid      { background:#EDFAF3; color:#145C38; border:1px solid #A7F0C9; }
  .sb-paid      .bdot { background:#16A34A; }
  .sb-unpaid    { background:#FFFBEB; color:#92600A; border:1px solid #FDE68A; }
  .sb-unpaid    .bdot { background:#F59E0B; }
  .sb-partial   { background:#EFF6FF; color:#1D4ED8; border:1px solid #BFDBFE; }
  .sb-partial   .bdot { background:#3B82F6; }

  /* SUMMARY */
  .sum-item { display:flex; align-items:flex-start; justify-content:space-between; gap:0.5rem; padding:0.55rem 0; border-bottom:1px solid #F2F4F7; }
  .sum-item:last-child { border-bottom:none; }
  .sum-lbl  { font-size:0.74rem; color:#9BA5B8; font-weight:500; flex-shrink:0; display:flex; align-items:center; gap:5px; }
  .sum-lbl svg { width:11px; height:11px; }
  .sum-val  { font-size:0.8rem; color:#1A2035; font-weight:600; text-align:right; }
  .sum-val.empty   { color:#BEC6D6; font-weight:400; font-style:italic; }
  .sum-val.c-green { color:#059669; }
  .sum-val.c-amber { color:#D97706; }

  /* ERRORS */
  .bk-errors { background:#FEF2F2; border:1.5px solid #FECACA; border-radius:10px; padding:0.875rem 1.125rem; margin-bottom:1.25rem; }
  .bk-errors p  { font-size:0.8rem; font-weight:700; color:#991B1B; margin:0 0 0.375rem; }
  .bk-errors ul { margin:0; padding:0 0 0 1rem; font-size:0.75rem; color:#B91C1C; line-height:1.8; }

  /* BUTTONS */
  .btn-submit {
    font-family:'Plus Jakarta Sans',sans-serif; font-size:0.875rem; font-weight:700;
    color:#fff; background:#2B3BAD; border:none; border-radius:10px;
    padding:0.8rem 1.25rem; cursor:pointer; display:flex; align-items:center;
    justify-content:center; gap:0.5rem; width:100%;
    transition:background .15s,transform .1s,box-shadow .15s;
    box-shadow:0 4px 12px rgba(43,59,173,0.25);
  }
  .btn-submit:hover  { background:#3445C4; box-shadow:0 6px 16px rgba(43,59,173,0.32); }
  .btn-submit:active { transform:scale(0.98); }
  .btn-submit svg    { width:15px; height:15px; }
  .btn-cancel-link {
    display:flex; align-items:center; justify-content:center; gap:0.4rem;
    font-family:'Plus Jakarta Sans',sans-serif; font-size:0.8125rem; font-weight:600;
    color:#8A96AA; text-decoration:none; padding:0.7rem; border-radius:10px;
    border:1.5px solid #E8EBF0; margin-top:0.625rem; transition:background .15s,color .15s;
  }
  .btn-cancel-link:hover { background:#F2F4F7; color:#3D4A68; }

  /* TIP */
  .tip-card {
    background:#FFFBEB; border:1px solid #FDE68A; border-radius:12px;
    padding:1rem 1.125rem; margin-top:1rem; display:flex; gap:0.75rem; align-items:flex-start;
  }
  .tip-text { font-size:0.775rem; color:#78500A; line-height:1.65; }
  .tip-text strong { color:#5C3A06; font-weight:700; }
</style>

<div class="bk-page">

  {{-- ── HERO ── --}}
  <div class="bk-hero">
    <div class="bk-hero-inner">
      <div class="bk-hero-left">
        <a href="{{ route('admin.package.booking.index') }}" class="bk-back-btn">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div class="bk-hero-titles">
          <div class="bk-hero-badge">Admin Panel</div>
          <h1>Add New Booking</h1>
          <p>Manually create a booking — confirmed &amp; paid by default</p>
        </div>
      </div>
      <div class="bk-hero-stats">
        <div class="bk-hero-stat">
          <div class="bk-hero-stat-val" id="hero-people">1</div>
          <div class="bk-hero-stat-lbl">Travelers</div>
        </div>
        <div class="bk-hero-stat">
          <div class="bk-hero-stat-val" id="hero-total">—</div>
          <div class="bk-hero-stat-lbl">Total (₹)</div>
        </div>
        <div class="bk-hero-stat">
          <div class="bk-hero-stat-val" id="hero-status">Confirmed</div>
          <div class="bk-hero-stat-lbl">Status</div>
        </div>
      </div>
    </div>
  </div>

  {{-- ── BODY ── --}}
  <div class="bk-body">
    <form action="{{ route('admin.package.booking.adminStore') }}" method="POST">
      @csrf

      <input type="hidden" name="source"         value="admin">
      <input type="hidden" name="booking_status" id="bkStatusHidden" value="{{ old('booking_status', 'confirmed') }}">
      <input type="hidden" name="payment_status" id="pyStatusHidden" value="{{ old('payment_status', 'paid') }}">

      @if($errors->any())
      <div class="bk-errors">
        <p>Please fix the following errors:</p>
        <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
      </div>
      @endif

      <div class="bk-grid">

        {{-- ════ LEFT ════ --}}
        <div>

          {{-- Guest Info --}}
          <div class="bk-card">
            <div class="bk-card-head">
              <div class="bk-icon ic-blue">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
              </div>
              <h3>Guest Information</h3><span>Required</span>
            </div>
            <div class="bk-card-body">
              <div class="frow c2">
                <div class="fg">
                  <label>Full Name <em>*</em></label>
                  <input type="text" name="name" value="{{ old('name') }}" placeholder="Guest full name" required class="fi">
                </div>
                <div class="fg">
                  <label>Email Address <em>*</em></label>
                  <input type="email" name="email" value="{{ old('email') }}" placeholder="guest@example.com" required class="fi">
                </div>
              </div>
              <div class="frow">
                <div class="fg">
                  <label>Phone Number</label>
                  <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+91 98765 43210" class="fi">
                </div>
              </div>
            </div>
          </div>

          {{-- Package --}}
          <div class="bk-card">
            <div class="bk-card-head">
              <div class="bk-icon ic-orange">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/></svg>
              </div>
              <h3>Package</h3><span>Select one</span>
            </div>
            <div class="bk-card-body">
              <div class="fg">
                <label>Select Package <em>*</em></label>
                <select name="package_id" required class="fs" id="pkgSel" onchange="syncSummaryPkg()">
                  <option value="">— Choose a package —</option>
                  @foreach($packages as $pkg)
                    <option value="{{ $pkg->id }}" {{ old('package_id') == $pkg->id ? 'selected' : '' }}>
                      {{ $pkg->name }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          {{-- Travelers --}}
          <div class="bk-card">
            <div class="bk-card-head">
              <div class="bk-icon ic-teal">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg>
              </div>
              <h3>Travelers</h3><span id="traveler-head-count">1 person</span>
            </div>
            <div class="bk-card-body">
              <div class="frow c3">
                <div class="fg">
                  <label>Adults</label>
                  <input type="number" name="adult" id="admin_adult" value="{{ old('adult', 1) }}" min="0" oninput="updateTotal()" class="fi">
                </div>
                <div class="fg">
                  <label>Children</label>
                  <input type="number" name="child" id="admin_child" value="{{ old('child', 0) }}" min="0" oninput="updateTotal()" class="fi">
                </div>
                <div class="fg">
                  <label>Total People <em>*</em></label>
                  <input type="number" name="total_people" id="admin_total_people" value="{{ old('total_people', 1) }}" min="1" readonly required class="fi disabled">
                </div>
              </div>
            </div>
          </div>

          {{-- Travel Dates --}}
          <div class="bk-card">
            <div class="bk-card-head">
              <div class="bk-icon ic-violet">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
              </div>
              <h3>Travel Dates</h3><span id="dates-head-info">Not set</span>
            </div>
            <div class="bk-card-body">
              <div class="frow c2">
                <div class="fg">
                  <label>Check-in Date <em>*</em></label>
                  <input type="date" name="checkin" id="admin_checkin" value="{{ old('checkin') }}" required class="fi">
                </div>
                <div class="fg">
                  <label>Check-out Date <em>*</em></label>
                  <input type="date" name="checkout" id="admin_checkout" value="{{ old('checkout') }}" required class="fi">
                </div>
              </div>
            </div>
          </div>

          {{-- ══ PRICE CARD ══ --}}
          <div class="bk-card">
            <div class="bk-card-head">
              <div class="bk-icon ic-green">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
              </div>
              <h3>Price Details</h3><span>Enter manually</span>
            </div>
            <div class="bk-card-body">

              <div class="frow c3">

                {{-- Total Amount --}}
                <div class="fg">
                  <label>Total Amount (₹) <em>*</em></label>
                  <div class="price-wrap">
                    <span class="p-sym">₹</span>
                    <input type="number" name="total_price" id="inp_total"
                      value="{{ old('total_price') }}"
                      min="0" step="0.01" placeholder="0.00" required class="fi"
                      oninput="recalcRemaining()">
                  </div>
                </div>

                {{-- Advance --}}
                <div class="fg">
                  <label>Advance Payment (₹)</label>
                  <div class="price-wrap">
                    <span class="p-sym">₹</span>
                    <input type="number" name="advance_price" id="inp_advance"
                      value="{{ old('advance_price') }}"
                      min="0" step="0.01" placeholder="0.00" class="fi"
                      oninput="recalcRemaining()">
                  </div>
                </div>

                {{-- Remaining (auto-calc) --}}
                <div class="fg">
                  <label>Remaining (₹)</label>
                  <div class="price-wrap">
                    <span class="p-sym" style="color:#059669;">₹</span>
                    <input type="number" name="remaining_price" id="inp_remaining"
                      value="{{ old('remaining_price') }}"
                      min="0" step="0.01" placeholder="Auto" readonly
                      class="fi calc-field">
                  </div>
                  <span class="calc-note">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Total − Advance
                  </span>
                </div>

              </div>

              {{-- Live Breakdown (shows when total > 0) --}}
              <div class="breakdown-box" id="breakdownBox">
                <div class="bd-title">
                  <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:12px;height:12px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 11h.01M12 11h.01M15 11h.01M9 14h.01M12 14h.01M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                  Price Breakdown
                </div>
                <div class="bd-row bd-tot">
                  <span class="bd-lbl">Total Amount</span>
                  <span class="bd-val" id="bd_total">₹0</span>
                </div>
                <div class="bd-row">
                  <span class="bd-lbl">Advance Paid</span>
                  <span class="bd-val" id="bd_advance">₹0</span>
                </div>
                <div class="bd-row bd-rem">
                  <span class="bd-lbl">Remaining Balance</span>
                  <span class="bd-val" id="bd_remaining">₹0</span>
                </div>
              </div>

            </div>
          </div>

          {{-- Notes --}}
          <div class="bk-card">
            <div class="bk-card-head">
              <div class="bk-icon ic-slate">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
              </div>
              <h3>Additional Notes</h3><span>Optional</span>
            </div>
            <div class="bk-card-body">
              <div class="fg">
                <label>Message / Notes</label>
                <textarea name="message" rows="3" placeholder="Special requirements, notes…" class="fta">{{ old('message') }}</textarea>
              </div>
            </div>
          </div>

        </div>

        {{-- ════ RIGHT SIDEBAR ════ --}}
        <div>

          {{-- Source --}}
          <div class="bk-card">
            <div class="bk-card-head">
              <div class="bk-icon ic-pink">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
              </div>
              <h3>Booking Source</h3>
            </div>
            <div class="bk-card-body">
              <div class="source-badge">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Admin — Manual Entry
              </div>
              <p style="font-size:0.72rem;color:#9BA5B8;margin:0.6rem 0 0;line-height:1.6;">
                Source set to <strong style="color:#2B55C9;">admin</strong>. No online payment gateway needed.
              </p>
            </div>
          </div>

          {{-- Status --}}
          <div class="bk-card" style="margin-top:1rem;">
            <div class="bk-card-head">
              <div class="bk-icon ic-red">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
              </div>
              <h3>Booking Status</h3><span>Editable</span>
            </div>
            <div class="bk-card-body">
              <div class="fg" style="margin-bottom:1rem;">
                <label>Booking Status</label>
                <select id="bkStatusSel" class="fs" onchange="updateBadge('bk')">
                  <option value="confirmed" {{ old('booking_status','confirmed')==='confirmed'?'selected':'' }}>Confirmed</option>
                  <option value="pending"   {{ old('booking_status')==='pending'  ?'selected':'' }}>Pending</option>
                  <option value="cancelled" {{ old('booking_status')==='cancelled'?'selected':'' }}>Cancelled</option>
                </select>
                <div class="status-badge sb-confirmed" id="bkBadge">
                  <span class="bdot"></span><span id="bkBadgeText">Confirmed</span>
                </div>
              </div>
              <div class="fg">
                <label>Payment Status</label>
                <select id="pyStatusSel" class="fs" onchange="updateBadge('py')">
                  <option value="paid"    {{ old('payment_status','paid')==='paid'   ?'selected':'' }}>Paid</option>
                  <option value="partial" {{ old('payment_status')==='partial'       ?'selected':'' }}>Partial</option>
                  <option value="unpaid"  {{ old('payment_status')==='unpaid'        ?'selected':'' }}>Unpaid</option>
                </select>
                <div class="status-badge sb-paid" id="pyBadge">
                  <span class="bdot"></span><span id="pyBadgeText">Paid</span>
                </div>
              </div>
            </div>
          </div>

          {{-- Summary --}}
          <div class="bk-card" style="margin-top:1rem;">
            <div class="bk-card-head">
              <div class="bk-icon ic-green">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
              </div>
              <h3>Booking Summary</h3>
            </div>
            <div class="bk-card-body">

              <div class="sum-item">
                <span class="sum-lbl">
                  <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/></svg>Package
                </span>
                <span class="sum-val empty" id="sum-pkg">Not selected</span>
              </div>

              <div class="sum-item">
                <span class="sum-lbl">
                  <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg>Travelers
                </span>
                <span class="sum-val" id="sum-travelers">1 adult</span>
              </div>

              <div class="sum-item">
                <span class="sum-lbl">
                  <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>Check-in
                </span>
                <span class="sum-val empty" id="sum-checkin">—</span>
              </div>

              <div class="sum-item">
                <span class="sum-lbl">
                  <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>Check-out
                </span>
                <span class="sum-val empty" id="sum-checkout">—</span>
              </div>

              <div class="sum-item">
                <span class="sum-lbl">
                  <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Total
                </span>
                <span class="sum-val c-green empty" id="sum-total">—</span>
              </div>

              <div class="sum-item">
                <span class="sum-lbl">
                  <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Advance
                </span>
                <span class="sum-val empty" id="sum-advance">—</span>
              </div>

              <div class="sum-item">
                <span class="sum-lbl">
                  <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Remaining
                </span>
                <span class="sum-val c-amber empty" id="sum-remaining">—</span>
              </div>

            </div>
          </div>

          {{-- Actions --}}
          <div style="margin-top:1rem;">
            <button type="submit" class="btn-submit">
              <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
              Save Booking
            </button>
            <a href="{{ route('admin.package.booking.index') }}" class="btn-cancel-link">
              <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:13px;height:13px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
              Cancel
            </a>
          </div>

          <div class="tip-card">
            <span style="font-size:1rem;flex-shrink:0;margin-top:1px;">💡</span>
            <div class="tip-text">
              Enter <strong>Total</strong> and <strong>Advance</strong> yourself. <strong>Remaining</strong> calculates automatically. No online payment needed.
            </div>
          </div>

        </div>
      </div>
    </form>
  </div>
</div>

<script>
  /* ─ Helpers ─ */
  function fmtINR(n) {
    return '₹' + Number(n).toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
  }
  function fmtDate(d) {
    return new Date(d + 'T00:00:00').toLocaleDateString('en-IN', { day:'2-digit', month:'short', year:'numeric' });
  }
  function setEl(id, val, active) {
    const el = document.getElementById(id);
    el.textContent = val;
    active ? el.classList.remove('empty') : el.classList.add('empty');
  }

  /* ─ Recalculate Remaining ─ */
  function recalcRemaining() {
    const tot = parseFloat(document.getElementById('inp_total').value)   || 0;
    const adv = parseFloat(document.getElementById('inp_advance').value) || 0;
    const rem = Math.max(0, tot - adv);

    // Set remaining field
    document.getElementById('inp_remaining').value = (tot > 0) ? rem.toFixed(2) : '';

    // Breakdown box
    const box = document.getElementById('breakdownBox');
    if (tot > 0) {
      box.classList.add('show');
      document.getElementById('bd_total').textContent     = fmtINR(tot);
      document.getElementById('bd_advance').textContent   = fmtINR(adv);
      document.getElementById('bd_remaining').textContent = fmtINR(rem);
    } else {
      box.classList.remove('show');
    }

    // Summary sidebar
    setEl('sum-total',     tot > 0 ? fmtINR(tot) : '—', tot > 0);
    setEl('sum-advance',   adv > 0 ? fmtINR(adv) : '—', adv > 0);
    setEl('sum-remaining', tot > 0 ? fmtINR(rem) : '—', tot > 0);

    // Hero
    document.getElementById('hero-total').textContent = tot > 0
      ? '₹' + Number(tot).toLocaleString('en-IN') : '—';
  }

  /* ─ Package Summary ─ */
  function syncSummaryPkg() {
    const sel = document.getElementById('pkgSel');
    sel.value
      ? setEl('sum-pkg', sel.options[sel.selectedIndex].text, true)
      : setEl('sum-pkg', 'Not selected', false);
  }

  /* ─ Travelers ─ */
  function updateTotal() {
    const a = parseInt(document.getElementById('admin_adult').value) || 0;
    const c = parseInt(document.getElementById('admin_child').value) || 0;
    const t = a + c;
    document.getElementById('admin_total_people').value         = t;
    document.getElementById('traveler-head-count').textContent  = t + (t === 1 ? ' person' : ' people');
    document.getElementById('hero-people').textContent          = t;
    const txt = a + ' adult' + (a !== 1 ? 's' : '') + (c > 0 ? ', ' + c + ' child' + (c !== 1 ? 'ren' : '') : '');
    setEl('sum-travelers', txt, true);
  }

  /* ─ Dates ─ */
  function calcDates() {
    const cin  = document.getElementById('admin_checkin').value;
    const cout = document.getElementById('admin_checkout').value;
    if (cin)  setEl('sum-checkin',  fmtDate(cin),  true);
    if (cout) setEl('sum-checkout', fmtDate(cout), true);
    if (cin && cout) {
      const n = Math.round((new Date(cout) - new Date(cin)) / 86400000);
      if (n > 0) document.getElementById('dates-head-info').textContent = n + ' night' + (n !== 1 ? 's' : '');
    }
  }
  document.getElementById('admin_checkin').addEventListener('change', function () {
    const next = new Date(this.value);
    next.setDate(next.getDate() + 1);
    document.getElementById('admin_checkout').min = next.toISOString().split('T')[0];
    calcDates();
  });
  document.getElementById('admin_checkout').addEventListener('change', calcDates);

  /* ─ Status Badges ─ */
  function updateBadge(type) {
    if (type === 'bk') {
      const v = document.getElementById('bkStatusSel').value;
      document.getElementById('bkStatusHidden').value    = v;
      document.getElementById('bkBadge').className       = 'status-badge sb-' + v;
      document.getElementById('bkBadgeText').textContent = v.charAt(0).toUpperCase() + v.slice(1);
      document.getElementById('hero-status').textContent = v.charAt(0).toUpperCase() + v.slice(1);
    } else {
      const v = document.getElementById('pyStatusSel').value;
      document.getElementById('pyStatusHidden').value    = v;
      document.getElementById('pyBadge').className       = 'status-badge sb-' + v;
      document.getElementById('pyBadgeText').textContent = v.charAt(0).toUpperCase() + v.slice(1);
    }
  }

  /* ─ Init ─ */
  document.addEventListener('DOMContentLoaded', function () {
    updateTotal();
    calcDates();
    syncSummaryPkg();
    updateBadge('bk');
    updateBadge('py');
    recalcRemaining(); // restore old() values after validation error
  });
</script>

@endsection