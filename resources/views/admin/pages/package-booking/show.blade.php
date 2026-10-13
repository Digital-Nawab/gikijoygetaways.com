@extends('admin.layout.master')

@section('content')

@php
  $nights  = \Carbon\Carbon::parse($booking->checkin)->diffInDays($booking->checkout);
  $initial = strtoupper(substr($booking->name, 0, 1));

  /* ─── PRICE CALCULATION (sirf package table se) ────────────────────
     Aapke DB me total_price / advance_price / remaining_price nahi hai.
     Seedha package se le rahe hain aur calculate kar rahe hain.
  ──────────────────────────────────────────────────────────────────── */
  $totalAmt   = (float) ($booking->package->total_price   ?? 0);
  $advanceAmt = (float) ($booking->package->advance_price ?? 0);

  // Agar Razorpay payment ho chuka hai → advance paid hua hai
  // Agar admin booking + payment_status=paid → full paid maano
  // warna 0
  if ($booking->razorpay_payment_id) {
      $paidAmt = $advanceAmt;
  } elseif ($booking->source === 'admin' && $booking->payment_status === 'paid') {
      $paidAmt = $totalAmt;
  } else {
      $paidAmt = 0;
  }

  $remainingAmt = max(0, $totalAmt - $paidAmt);
  $paidPercent  = $totalAmt > 0 ? min(100, round(($paidAmt / $totalAmt) * 100)) : 0;

  $bookingColor = match($booking->booking_status) {
    'confirmed' => ['bg'=>'bg-emerald-50','text'=>'text-emerald-700','border'=>'border-emerald-200','dot'=>'bg-emerald-500'],
    'cancelled' => ['bg'=>'bg-red-50',    'text'=>'text-red-600',    'border'=>'border-red-200',    'dot'=>'bg-red-500'],
    default     => ['bg'=>'bg-amber-50',  'text'=>'text-amber-600',  'border'=>'border-amber-200',  'dot'=>'bg-amber-400'],
  };
  $paymentColor = $booking->payment_status === 'paid'
    ? ['bg'=>'bg-emerald-50','text'=>'text-emerald-700','border'=>'border-emerald-200','dot'=>'bg-emerald-500']
    : ['bg'=>'bg-amber-50',  'text'=>'text-amber-600',  'border'=>'border-amber-200',  'dot'=>'bg-amber-400'];

  $sourceColor = $booking->source === 'admin'
    ? ['bg'=>'bg-blue-50',  'text'=>'text-blue-700',  'border'=>'border-blue-200',  'label'=>'Admin Entry']
    : ['bg'=>'bg-violet-50','text'=>'text-violet-700','border'=>'border-violet-200','label'=>'Website'];
@endphp

<style>
  @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap');
  .booking-show * { font-family:'DM Sans',sans-serif; }
  .booking-show .font-display { font-family:'Syne',sans-serif; }
  .avatar-ring { background:conic-gradient(from 0deg,#6366f1,#8b5cf6,#06b6d4,#6366f1); padding:3px; border-radius:50%; }
  .section-card { background:#fff; border:1px solid #f1f5f9; border-radius:20px; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.04),0 4px 16px rgba(0,0,0,0.03); transition:box-shadow 0.2s; }
  .section-card:hover { box-shadow:0 4px 20px rgba(0,0,0,0.08); }
  .detail-row { display:flex; align-items:flex-start; gap:14px; padding:14px 0; border-bottom:1px solid #f8fafc; }
  .detail-row:last-child { border-bottom:none; }
  .icon-box { width:36px; height:36px; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
  .hero-bg { background:linear-gradient(135deg,#0f172a 0%,#1e293b 50%,#0f172a 100%); position:relative; overflow:hidden; }
  .hero-bg::before { content:''; position:absolute; top:-40%; right:-10%; width:400px; height:400px; background:radial-gradient(circle,rgba(99,102,241,0.18) 0%,transparent 70%); pointer-events:none; }
  .hero-bg::after { content:''; position:absolute; bottom:-30%; left:-5%; width:300px; height:300px; background:radial-gradient(circle,rgba(6,182,212,0.12) 0%,transparent 70%); pointer-events:none; }
  .fade-up { animation:fadeUp 0.5s ease both; }
  @keyframes fadeUp { from{opacity:0;transform:translateY(16px)} to{opacity:1;transform:translateY(0)} }
  .delay-1{animation-delay:0.05s} .delay-2{animation-delay:0.10s} .delay-3{animation-delay:0.15s} .delay-4{animation-delay:0.20s}
  .stat-pill { background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.12); border-radius:12px; padding:12px 16px; }
  .action-btn { display:inline-flex; align-items:center; gap:8px; padding:10px 20px; border-radius:12px; font-size:0.8rem; font-weight:600; transition:all 0.18s; cursor:pointer; border:none; text-decoration:none; }
  .btn-back { background:rgba(255,255,255,0.1); color:rgba(255,255,255,0.85); border:1px solid rgba(255,255,255,0.18); }
  .btn-back:hover { background:rgba(255,255,255,0.18); color:#fff; }
  .btn-delete { background:rgba(239,68,68,0.15); color:#fca5a5; border:1px solid rgba(239,68,68,0.25); }
  .btn-delete:hover { background:rgba(239,68,68,0.25); color:#fecaca; }
  .pay-hero { background:linear-gradient(135deg,#ECFDF5 0%,#F0FDF4 100%); border:1.5px dashed #86EFAC; border-radius:14px; padding:16px; text-align:center; margin-bottom:16px; }
  .pay-row { display:flex; align-items:center; justify-content:space-between; padding:10px 0; border-bottom:1px solid #F8FAFC; }
  .pay-row:last-of-type { border-bottom:none; }
  .pay-row-left { display:flex; align-items:center; gap:10px; }
  .pay-progress-track { width:100%; height:8px; background:#F1F5F9; border-radius:99px; overflow:hidden; }
  .pay-progress-bar { height:100%; border-radius:99px; transition:width 0.6s cubic-bezier(0.4,0,0.2,1); }
</style>

<div class="booking-show min-h-screen bg-gray-50">

  {{-- HERO --}}
  <div class="hero-bg px-6 pt-8 pb-10">
    <div class="mx-auto">

      <div class="flex items-center justify-between mb-8 fade-up">
        <a href="{{ route('admin.package.booking.index') }}" class="action-btn btn-back">
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
          All Bookings
        </a>
        <form action="{{ route('admin.package.booking.delete', $booking->id) }}" method="POST" onsubmit="return confirm('Delete this booking permanently?')">
          @csrf @method('DELETE')
          <button type="submit" class="action-btn btn-delete">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            Delete Booking
          </button>
        </form>
      </div>

      <div class="flex items-center gap-5 mb-8 fade-up delay-1">
        <div class="avatar-ring">
          <div class="w-16 h-16 rounded-full bg-gradient-to-br from-indigo-500 to-cyan-500 flex items-center justify-center text-white text-2xl font-display font-bold">
            {{ $initial }}
          </div>
        </div>
        <div>
          <h1 class="font-display text-2xl font-bold text-white leading-tight">{{ $booking->name }}</h1>
          <div class="flex items-center gap-3 mt-1.5 flex-wrap">
            <span class="flex items-center gap-1.5 text-slate-400 text-sm">
              <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
              {{ $booking->email }}
            </span>
            @if($booking->phone)
            <span class="text-slate-600">·</span>
            <span class="flex items-center gap-1.5 text-slate-400 text-sm">
              <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
              {{ $booking->phone }}
            </span>
            @endif
            <span class="text-slate-600">·</span>
            <span class="inline-flex items-center gap-1.5 text-xs font-bold px-2.5 py-1 rounded-full {{ $booking->source === 'admin' ? 'bg-blue-500/20 text-blue-300' : 'bg-violet-500/20 text-violet-300' }}">
              {{ $booking->source === 'admin' ? '🛠 Admin Entry' : '🌐 Website' }}
            </span>
          </div>
        </div>
      </div>

      {{-- Stats — Duration HATA DIYA, Total Amount aaya --}}
      <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 fade-up delay-2">
        <div class="stat-pill">
          <div class="text-slate-400 text-xs font-medium mb-1 uppercase tracking-widest">Package</div>
          <div class="text-white font-display font-semibold text-sm leading-tight">{{ $booking->package->name ?? 'N/A' }}</div>
        </div>
        <div class="stat-pill">
          <div class="text-slate-400 text-xs font-medium mb-1 uppercase tracking-widest">Travelers</div>
          <div class="text-white font-display font-bold text-xl">{{ $booking->total_people }}<span class="text-slate-400 text-xs font-normal"> people</span></div>
        </div>
        <div class="stat-pill">
          <div class="text-slate-400 text-xs font-medium mb-1 uppercase tracking-widest">Total Amount</div>
          <div class="text-white font-display font-bold text-xl">₹{{ number_format($totalAmt) }}</div>
        </div>
        <div class="stat-pill">
          <div class="text-slate-400 text-xs font-medium mb-1 uppercase tracking-widest">Booked On</div>
          <div class="text-white font-semibold text-sm">{{ $booking->created_at->format('d M Y') }}</div>
        </div>
      </div>

    </div>
  </div>

  {{-- MAIN --}}
  <div class="mx-auto px-6 -mt-4 pb-10">

    @if(session('success'))
    <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium px-4 py-3 rounded-xl mb-5 fade-up">
      <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
      {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

      {{-- LEFT --}}
      <div class="lg:col-span-2 flex flex-col gap-5">

        {{-- Travel Dates --}}
        <div class="section-card fade-up delay-2">
          <div class="px-6 py-4 border-b border-gray-50 flex items-center gap-2.5">
            <div class="icon-box bg-indigo-50"><svg class="w-4 h-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></div>
            <h3 class="font-display font-bold text-gray-800 text-sm uppercase tracking-wider">Travel Dates</h3>
            <span class="ml-auto text-xs text-gray-400 font-semibold">{{ $nights }} {{ $nights === 1 ? 'Night' : 'Nights' }}</span>
          </div>
          <div class="px-6 py-5">
            <div class="flex items-stretch gap-4">
              <div class="flex-1 bg-indigo-50 rounded-2xl p-4 text-center">
                <div class="text-xs font-semibold text-indigo-400 uppercase tracking-widest mb-2">Check-in</div>
                <div class="font-display font-bold text-indigo-700 text-2xl leading-none">{{ \Carbon\Carbon::parse($booking->checkin)->format('d') }}</div>
                <div class="text-indigo-500 font-semibold text-sm mt-1">{{ \Carbon\Carbon::parse($booking->checkin)->format('M Y') }}</div>
                <div class="text-xs text-indigo-400 mt-0.5">{{ \Carbon\Carbon::parse($booking->checkin)->format('l') }}</div>
              </div>
              <div class="flex flex-col items-center justify-center gap-1 px-2">
                <div class="flex items-center gap-1">
                  <div class="w-12 h-px bg-gray-200"></div>
                  <svg class="w-4 h-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </div>
                <span class="bg-gray-100 text-gray-500 text-xs font-bold px-2.5 py-1 rounded-full">{{ $nights }}N</span>
              </div>
              <div class="flex-1 bg-cyan-50 rounded-2xl p-4 text-center">
                <div class="text-xs font-semibold text-cyan-400 uppercase tracking-widest mb-2">Check-out</div>
                <div class="font-display font-bold text-cyan-700 text-2xl leading-none">{{ \Carbon\Carbon::parse($booking->checkout)->format('d') }}</div>
                <div class="text-cyan-500 font-semibold text-sm mt-1">{{ \Carbon\Carbon::parse($booking->checkout)->format('M Y') }}</div>
                <div class="text-xs text-cyan-400 mt-0.5">{{ \Carbon\Carbon::parse($booking->checkout)->format('l') }}</div>
              </div>
            </div>
          </div>
        </div>

        {{-- ✅ PAYMENT DETAILS --}}
        <div class="section-card fade-up delay-3">
          <div class="px-6 py-4 border-b border-gray-50 flex items-center gap-2.5">
            <div class="icon-box bg-emerald-50">
              <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 class="font-display font-bold text-gray-800 text-sm uppercase tracking-wider">Payment Details</h3>
            <span class="ml-auto inline-flex items-center gap-1.5 text-[10px] font-bold px-2.5 py-1 rounded-full border {{ $paymentColor['bg'] }} {{ $paymentColor['text'] }} {{ $paymentColor['border'] }}">
              <span class="w-1.5 h-1.5 rounded-full {{ $paymentColor['dot'] }}"></span>
              {{ strtoupper($booking->payment_status) }}
            </span>
          </div>

          <div class="px-6 py-5">

            {{-- Hero Total --}}
            <div class="pay-hero">
              <div class="text-xs font-bold text-emerald-700 uppercase tracking-widest mb-1">Total Booking Amount</div>
              <div class="font-display font-bold text-4xl text-emerald-800">₹{{ number_format($totalAmt, 2) }}</div>
              <div class="text-[11px] text-emerald-600 mt-1.5 font-medium">
                Package: {{ $booking->package->name ?? 'N/A' }}
              </div>
            </div>

            {{-- 3-col Stats --}}
            <div class="grid grid-cols-3 gap-3 mb-4">
              <div class="text-center bg-emerald-50 border border-emerald-100 rounded-xl py-3 px-2">
                <div class="text-[10px] font-bold text-emerald-500 uppercase tracking-wider mb-1">Paid</div>
                <div class="font-display font-bold text-emerald-700 text-xl">₹{{ number_format($paidAmt) }}</div>
                <div class="text-[10px] text-emerald-500 mt-0.5">{{ $paidPercent }}% done</div>
              </div>

              <div class="text-center {{ $remainingAmt > 0 ? 'bg-amber-50 border-amber-100' : 'bg-emerald-50 border-emerald-100' }} border rounded-xl py-3 px-2">
                <div class="text-[10px] font-bold {{ $remainingAmt > 0 ? 'text-amber-500' : 'text-emerald-500' }} uppercase tracking-wider mb-1">Remaining</div>
                <div class="font-display font-bold {{ $remainingAmt > 0 ? 'text-amber-700' : 'text-emerald-700' }} text-xl">₹{{ number_format($remainingAmt) }}</div>
                <div class="text-[10px] {{ $remainingAmt > 0 ? 'text-amber-500' : 'text-emerald-500' }} mt-0.5">
                  {{ $remainingAmt > 0 ? 'To collect' : 'Cleared ✓' }}
                </div>
              </div>

              <div class="text-center bg-gray-900 rounded-xl py-3 px-2">
                <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Total</div>
                <div class="font-display font-bold text-white text-xl">₹{{ number_format($totalAmt) }}</div>
                <div class="text-[10px] text-gray-500 mt-0.5">Full amount</div>
              </div>
            </div>

            {{-- Progress Bar --}}
            @if($totalAmt > 0)
            <div class="mb-4">
              <div class="flex items-center justify-between mb-2">
                <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Payment Progress</span>
                <span class="text-xs font-bold {{ $paidPercent >= 100 ? 'text-emerald-600' : 'text-blue-600' }}">{{ $paidPercent }}% Collected</span>
              </div>
              <div class="pay-progress-track">
                <div class="pay-progress-bar {{ $paidPercent >= 100 ? 'bg-gradient-to-r from-emerald-400 to-emerald-500' : ($paidPercent > 0 ? 'bg-gradient-to-r from-blue-400 to-blue-500' : 'bg-gray-200') }}" style="width: {{ $paidPercent }}%;"></div>
              </div>
              <div class="flex justify-between mt-1.5 text-[10px] text-gray-400">
                <span>₹0</span>
                <span>₹{{ number_format($totalAmt) }}</span>
              </div>
            </div>
            @endif

            {{-- Breakdown --}}
            <div class="bg-gray-50 rounded-xl px-4 py-2">
              <div class="pay-row">
                <div class="pay-row-left">
                  <div class="icon-box bg-white border border-gray-100" style="width:30px;height:30px;">
                    <svg class="w-3.5 h-3.5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8"/></svg>
                  </div>
                  <span class="text-xs font-semibold text-gray-600">Package Total Price</span>
                </div>
                <span class="text-sm font-bold text-gray-800">₹{{ number_format($totalAmt, 2) }}</span>
              </div>

              <div class="pay-row">
                <div class="pay-row-left">
                  <div class="icon-box bg-emerald-50" style="width:30px;height:30px;">
                    <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                  </div>
                  <div>
                    <div class="text-xs font-semibold text-gray-600">Advance Paid</div>
                    @if($booking->razorpay_payment_id)
                      <div class="text-[10px] text-gray-400">via Razorpay 💳</div>
                    @elseif($booking->source === 'admin' && $booking->payment_status === 'paid')
                      <div class="text-[10px] text-gray-400">Manual (admin marked paid)</div>
                    @else
                      <div class="text-[10px] text-gray-400">Not received yet</div>
                    @endif
                  </div>
                </div>
                <span class="text-sm font-bold text-emerald-600">− ₹{{ number_format($paidAmt, 2) }}</span>
              </div>

              <div class="pay-row" style="border-top:1.5px dashed #CBD5E1; padding-top:12px; margin-top:4px;">
                <div class="pay-row-left">
                  <div class="icon-box {{ $remainingAmt > 0 ? 'bg-amber-50' : 'bg-emerald-50' }}" style="width:30px;height:30px;">
                    <svg class="w-3.5 h-3.5 {{ $remainingAmt > 0 ? 'text-amber-500' : 'text-emerald-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                  </div>
                  <div>
                    <div class="text-xs font-bold text-gray-700">Remaining Balance</div>
                    <div class="text-[10px] {{ $remainingAmt > 0 ? 'text-amber-500' : 'text-emerald-500' }} font-medium">
                      {{ $remainingAmt > 0 ? 'To collect at check-in' : 'Fully cleared ✓' }}
                    </div>
                  </div>
                </div>
                <span class="text-base font-display font-bold {{ $remainingAmt > 0 ? 'text-amber-600' : 'text-emerald-600' }}">
                  ₹{{ number_format($remainingAmt, 2) }}
                </span>
              </div>
            </div>

            {{-- State note --}}
            @if($booking->razorpay_payment_id)
            <div class="mt-4 bg-violet-50 border border-violet-100 rounded-xl p-3 flex items-start gap-2.5">
              <span class="text-base flex-shrink-0">💳</span>
              <div class="text-[11px] text-violet-700 leading-relaxed">
                <strong>Advance ₹{{ number_format($paidAmt) }} paid online via Razorpay.</strong>
                Remaining <strong>₹{{ number_format($remainingAmt) }}</strong> to be collected at check-in.
              </div>
            </div>
            @elseif($booking->source === 'admin')
            <div class="mt-4 bg-blue-50 border border-blue-100 rounded-xl p-3 flex items-start gap-2.5">
              <span class="text-base flex-shrink-0">🛠</span>
              <div class="text-[11px] text-blue-700 leading-relaxed">
                <strong>Admin-entered booking.</strong> Payment collected offline.
                Status: <strong>{{ ucfirst($booking->payment_status) }}</strong>.
              </div>
            </div>
            @else
            <div class="mt-4 bg-amber-50 border border-amber-100 rounded-xl p-3 flex items-start gap-2.5">
              <span class="text-base flex-shrink-0">⏳</span>
              <div class="text-[11px] text-amber-700 leading-relaxed">
                <strong>Payment pending.</strong> Customer hasn't completed online payment yet.
              </div>
            </div>
            @endif

          </div>
        </div>

        {{-- Travelers --}}
        <div class="section-card fade-up delay-3">
          <div class="px-6 py-4 border-b border-gray-50 flex items-center gap-2.5">
            <div class="icon-box bg-violet-50"><svg class="w-4 h-4 text-violet-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg></div>
            <h3 class="font-display font-bold text-gray-800 text-sm uppercase tracking-wider">Travelers</h3>
          </div>
          <div class="px-6 py-5">
            <div class="grid grid-cols-3 gap-4">
              <div class="text-center bg-blue-50 rounded-2xl py-4 px-3">
                <div class="font-display font-bold text-blue-700 text-3xl">{{ $booking->adult }}</div>
                <div class="text-xs font-semibold text-blue-400 uppercase tracking-widest mt-1">Adults</div>
              </div>
              <div class="text-center bg-orange-50 rounded-2xl py-4 px-3">
                <div class="font-display font-bold text-orange-600 text-3xl">{{ $booking->child }}</div>
                <div class="text-xs font-semibold text-orange-400 uppercase tracking-widest mt-1">Children</div>
              </div>
              <div class="text-center bg-gray-900 rounded-2xl py-4 px-3">
                <div class="font-display font-bold text-white text-3xl">{{ $booking->total_people }}</div>
                <div class="text-xs font-semibold text-gray-400 uppercase tracking-widest mt-1">Total</div>
              </div>
            </div>
          </div>
        </div>

        @if($booking->message)
        <div class="section-card fade-up delay-4">
          <div class="px-6 py-4 border-b border-gray-50 flex items-center gap-2.5">
            <div class="icon-box bg-amber-50"><svg class="w-4 h-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg></div>
            <h3 class="font-display font-bold text-gray-800 text-sm uppercase tracking-wider">Guest Message</h3>
          </div>
          <div class="px-6 py-5">
            <div class="bg-amber-50 border border-amber-100 rounded-xl p-4 relative">
              <div class="absolute top-3 left-4 text-amber-200 font-display font-black text-4xl leading-none select-none">"</div>
              <p class="text-gray-600 text-sm leading-relaxed pt-4 pl-4">{{ $booking->message }}</p>
            </div>
          </div>
        </div>
        @endif

      </div>

      {{-- RIGHT --}}
      <div class="flex flex-col gap-5">

        <div class="section-card fade-up delay-2">
          <div class="px-5 py-4 border-b border-gray-50 flex items-center gap-2.5">
            <div class="icon-box bg-gray-100"><svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg></div>
            <h3 class="font-display font-bold text-gray-800 text-sm uppercase tracking-wider">Manage Status</h3>
          </div>
          <div class="px-5 py-5 flex flex-col gap-4">
            <div class="flex gap-2 flex-wrap">
              <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-full border {{ $bookingColor['bg'] }} {{ $bookingColor['text'] }} {{ $bookingColor['border'] }}">
                <span class="w-1.5 h-1.5 rounded-full {{ $bookingColor['dot'] }}"></span>
                Booking: {{ ucfirst($booking->booking_status) }}
              </span>
              <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-full border {{ $paymentColor['bg'] }} {{ $paymentColor['text'] }} {{ $paymentColor['border'] }}">
                <span class="w-1.5 h-1.5 rounded-full {{ $paymentColor['dot'] }}"></span>
                Payment: {{ ucfirst($booking->payment_status) }}
              </span>
            </div>
            <form action="{{ route('admin.package.booking.updateStatus', $booking->id) }}" method="POST" class="flex flex-col gap-3">
              @csrf
              <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Booking Status</label>
                <select name="booking_status" class="w-full text-sm font-semibold px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-700 outline-none focus:ring-2 focus:ring-indigo-200 transition-all cursor-pointer">
                  <option value="pending"   {{ $booking->booking_status === 'pending'   ? 'selected' : '' }}>⏳ Pending</option>
                  <option value="confirmed" {{ $booking->booking_status === 'confirmed' ? 'selected' : '' }}>✅ Confirmed</option>
                  <option value="cancelled" {{ $booking->booking_status === 'cancelled' ? 'selected' : '' }}>❌ Cancelled</option>
                </select>
              </div>
              <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Payment Status</label>
                <select name="payment_status" class="w-full text-sm font-semibold px-3 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-700 outline-none focus:ring-2 focus:ring-indigo-200 transition-all cursor-pointer">
                  <option value="unpaid" {{ $booking->payment_status === 'unpaid' ? 'selected' : '' }}>💳 Unpaid</option>
                  <option value="paid"   {{ $booking->payment_status === 'paid'   ? 'selected' : '' }}>✅ Paid</option>
                </select>
              </div>
              <button type="submit" class="w-full bg-gray-900 hover:bg-gray-800 text-white text-sm font-bold py-2.5 px-4 rounded-xl transition-all flex items-center justify-center gap-2 mt-1">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                Update Status
              </button>
            </form>
          </div>
        </div>

        <div class="section-card fade-up delay-3">
          <div class="px-5 py-4 border-b border-gray-50 flex items-center gap-2.5">
            <div class="icon-box bg-slate-100"><svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
            <h3 class="font-display font-bold text-gray-800 text-sm uppercase tracking-wider">Booking Info</h3>
          </div>
          <div class="px-5 py-4">

            <div class="detail-row">
              <div class="icon-box bg-gray-100"><svg class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg></div>
              <div>
                <div class="text-xs text-gray-400 font-medium">Booking ID</div>
                <div class="text-sm font-mono font-bold text-gray-700 mt-0.5">#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</div>
              </div>
            </div>

            <div class="detail-row">
              <div class="icon-box {{ $booking->source === 'admin' ? 'bg-blue-50' : 'bg-violet-50' }}">
                <svg class="w-3.5 h-3.5 {{ $booking->source === 'admin' ? 'text-blue-500' : 'text-violet-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
              </div>
              <div>
                <div class="text-xs text-gray-400 font-medium">Booking Source</div>
                <div class="mt-0.5">
                  <span class="inline-flex items-center gap-1 text-xs font-bold px-2 py-0.5 rounded-full border {{ $sourceColor['bg'] }} {{ $sourceColor['text'] }} {{ $sourceColor['border'] }}">
                    {{ $sourceColor['label'] }}
                  </span>
                </div>
              </div>
            </div>

            @if($booking->razorpay_payment_id)
            <div class="detail-row">
              <div class="icon-box bg-emerald-50">
                <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
              </div>
              <div class="overflow-hidden">
                <div class="text-xs text-gray-400 font-medium">Razorpay Payment ID</div>
                <div class="text-xs font-mono font-bold text-emerald-600 mt-0.5 break-all">{{ $booking->razorpay_payment_id }}</div>
              </div>
            </div>
            @endif

            <div class="detail-row">
              <div class="icon-box bg-gray-100"><svg class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
              <div>
                <div class="text-xs text-gray-400 font-medium">Created At</div>
                <div class="text-sm font-semibold text-gray-700 mt-0.5">{{ $booking->created_at->format('d M Y, h:i A') }}</div>
              </div>
            </div>

            <div class="detail-row">
              <div class="icon-box bg-gray-100"><svg class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg></div>
              <div>
                <div class="text-xs text-gray-400 font-medium">Last Updated</div>
                <div class="text-sm font-semibold text-gray-700 mt-0.5">{{ $booking->updated_at->format('d M Y, h:i A') }}</div>
              </div>
            </div>

          </div>
        </div>

        {{-- Package Info with prices --}}
        <div class="section-card fade-up delay-4">
          <div class="px-5 py-4 border-b border-gray-50 flex items-center gap-2.5">
            <div class="icon-box bg-blue-50"><svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg></div>
            <h3 class="font-display font-bold text-gray-800 text-sm uppercase tracking-wider">Package Info</h3>
          </div>
          <div class="px-5 py-4">
            <div class="detail-row">
              <div class="icon-box bg-blue-50"><svg class="w-3.5 h-3.5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg></div>
              <div>
                <div class="text-xs text-gray-400 font-medium">Package Name</div>
                <div class="text-sm font-bold text-gray-800 mt-0.5">{{ $booking->package->name ?? 'N/A' }}</div>
              </div>
            </div>

            <div class="detail-row">
              <div class="icon-box bg-emerald-50"><svg class="w-3.5 h-3.5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
              <div>
                <div class="text-xs text-gray-400 font-medium">Total Price</div>
                <div class="text-sm font-bold text-emerald-600 mt-0.5">₹{{ number_format($totalAmt) }}</div>
              </div>
            </div>

            <div class="detail-row">
              <div class="icon-box bg-violet-50"><svg class="w-3.5 h-3.5 text-violet-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg></div>
              <div>
                <div class="text-xs text-gray-400 font-medium">Advance Price</div>
                <div class="text-sm font-bold text-violet-600 mt-0.5">₹{{ number_format($advanceAmt) }}</div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

</div>
@endsection