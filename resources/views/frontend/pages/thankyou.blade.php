@extends('frontend.layout.master')

@section('css')
  <style>
    :root {
      --primary:        #F0A500;
      --primary-dark:   #C47F00;
      --primary-deep:   #D4950A;
      --primary-light:  #FFF8E7;
      --primary-border: #F0C96A;
      --primary-mid:    #F5BC40;

      --surface-dark:   #1E1C1C;
      --surface-char:   #2E2B2B;
      --text-body:      #525252;
      --text-heading:   #110F0F;
      --borders:        #E8E8E8;
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(22px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .thankyou-wrapper {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: #F5F3EE;
      padding: 2.5rem 1rem;
    }

    .card {
      background: #fff;
      border-radius: 24px;
      max-width: 800px;
      width: 100%;
      overflow: hidden;
      box-shadow: 0 20px 60px rgba(240,165,0,0.18);
      animation: fadeUp .55s cubic-bezier(.22,.68,0,1.2) both;
    }

    /* HERO */
    .card-hero {
      background: var(--surface-dark);
      padding: 2.8rem 2rem 2.2rem;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    .card-hero::before {
      content: '';
      position: absolute; top: -60px; right: -60px;
      width: 200px; height: 200px;
      background: rgba(240,165,0,0.08);
      border-radius: 50%;
    }
    .card-hero::after {
      content: '';
      position: absolute; bottom: -50px; left: -50px;
      width: 160px; height: 160px;
      background: rgba(240,165,0,0.05);
      border-radius: 50%;
    }
    .card-hero .dot1 {
      position: absolute; top: 28px; left: 32px;
      width: 8px; height: 8px; border-radius: 50%;
      background: rgba(240,165,0,0.35);
    }
    .card-hero .dot2 {
      position: absolute; bottom: 28px; right: 40px;
      width: 12px; height: 12px; border-radius: 50%;
      background: rgba(240,165,0,0.20);
    }

    @keyframes popIn {
      0%   { transform: scale(0.4); opacity: 0; }
      70%  { transform: scale(1.12); }
      100% { transform: scale(1);   opacity: 1; }
    }
    .check-ring {
      width: 80px; height: 80px;
      border-radius: 50%;
      background: rgba(240,165,0,0.18);
      border: 2.5px solid rgba(240,165,0,0.55);
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 1.3rem;
      animation: popIn .6s .2s cubic-bezier(.22,.68,0,1.3) both;
    }
    .check-ring svg { width: 36px; height: 36px; }

    .card-hero h1 {
      color: #FFF8E7;
      font-size: 1.9rem;
      font-weight: 800;
      letter-spacing: -0.3px;
      line-height: 1.15;
    }
    .card-hero .subtitle {
      color: rgba(255,248,231,0.72);
      font-size: 0.92rem;
      margin-top: .45rem;
    }
    .booking-id-pill {
      display: inline-flex; align-items: center; gap: 6px;
      background: rgba(240,165,0,0.14);
      border: 1px solid rgba(240,165,0,0.40);
      color: var(--primary);
      font-size: 0.75rem; font-weight: 700;
      letter-spacing: 1.1px;
      padding: 5px 18px;
      border-radius: 20px;
      margin-top: 1rem;
    }
    .booking-id-pill span { opacity: .7; }

    /* BODY */
    .card-body { padding: 2rem; }

    .flash-success {
      background: var(--primary-light);
      border: 1px solid var(--primary-border);
      border-radius: 12px;
      padding: .9rem 1.2rem;
      font-size: .88rem; font-weight: 700;
      color: var(--primary-dark);
      margin-bottom: 1.5rem;
      display: flex; align-items: center; gap: 8px;
    }
    .flash-error {
      background: #FEE2E2;
      border: 1px solid #FCA5A5;
      border-radius: 12px;
      padding: .9rem 1.2rem;
      font-size: .88rem; font-weight: 700;
      color: #991B1B;
      margin-bottom: 1.5rem;
      display: flex; align-items: center; gap: 8px;
    }

    .sec-label {
      font-size: 0.7rem; font-weight: 700;
      text-transform: uppercase; letter-spacing: 1.4px;
      color: var(--primary-dark);
      margin-bottom: .9rem;
      display: flex; align-items: center; gap: 6px;
    }
    .sec-label::after {
      content: ''; flex: 1; height: 1px; background: var(--primary-border);
    }

    .detail-table {
      background: var(--primary-light);
      border-radius: 14px;
      border: 1px solid var(--primary-border);
      overflow: hidden;
      margin-bottom: 1.6rem;
    }
    .detail-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: .72rem 1.1rem;
      border-bottom: 1px solid #F0D990;
      font-size: 0.88rem;
    }
    .detail-row:last-child { border-bottom: none; }
    .detail-label { color: #7a6030; font-weight: 500; }
    .detail-value { font-weight: 700; color: var(--text-heading); text-align: right; }

    .badge {
      display: inline-block;
      font-size: 0.72rem; font-weight: 800;
      padding: 3px 13px; border-radius: 20px;
      letter-spacing: .5px;
    }
    .badge-unpaid    { background: #FFF3E0; color: #B45309; }
    .badge-paid      { background: #D1FAE5; color: #065F46; }
    .badge-pending   { background: var(--primary-light); color: var(--primary-dark); }
    .badge-confirmed { background: #D1FAE5; color: #065F46; }
    .badge-cancelled { background: #FEE2E2; color: #991B1B; }

    /* ── PAYMENT BOX ── */
    .pay-box {
      background: linear-gradient(145deg, #FFF8E7 0%, #FFF0C0 100%);
      border: 2px solid var(--primary-border);
      border-radius: 18px;
      padding: 1.8rem 1.5rem;
      text-align: center;
      margin-bottom: 1.5rem;
      position: relative;
      overflow: hidden;
    }
    .pay-box::before {
      content: '';
      position: absolute; top: -30px; right: -30px;
      width: 100px; height: 100px;
      background: rgba(240,165,0,0.10);
      border-radius: 50%;
    }
    .pay-box .pay-label {
      font-size: .78rem; font-weight: 700;
      text-transform: uppercase; letter-spacing: 1px;
      color: #7a6030; margin-bottom: .3rem;
    }
    .pay-box .amount {
      font-size: 2.6rem; font-weight: 800;
      color: var(--primary-dark);
      line-height: 1; margin: .4rem 0 .2rem;
    }
    .pay-box .per-person {
      font-size: .78rem; color: #a08040;
      margin-bottom: 1rem;
    }

    .price-breakdown {
      background: rgba(255,255,255,0.7);
      border: 1px solid var(--primary-border);
      border-radius: 12px;
      padding: .9rem 1.1rem;
      margin-bottom: 1.3rem;
      text-align: left;
    }
    .price-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: .84rem;
      padding: .3rem 0;
    }
    .price-row:not(:last-child) {
      border-bottom: 1px dashed #F0D990;
    }
    .price-row .pr-label { color: #7a6030; font-weight: 500; }
    .price-row .pr-value { font-weight: 700; color: var(--text-heading); }
    .price-row.highlight .pr-label { color: var(--primary-dark); font-weight: 700; }
    .price-row.highlight .pr-value { color: var(--primary-dark); font-size: .95rem; }
    .price-row.balance .pr-label { color: #16a34a; font-weight: 700; }
    .price-row.balance .pr-value { color: #16a34a; font-weight: 800; }

    .pay-info-note {
      background: rgba(255,255,255,0.65);
      border-left: 3px solid var(--primary);
      border-radius: 0 8px 8px 0;
      padding: .7rem 1rem;
      font-size: .78rem;
      color: #7a6030;
      line-height: 1.6;
      margin-bottom: 1.3rem;
      text-align: left;
    }
    .pay-info-note strong { color: var(--primary-dark); }

    .btn-razorpay {
      display: flex; align-items: center; justify-content: center; gap: 10px;
      background: var(--primary);
      color: var(--surface-dark);
      border: none; border-radius: 12px;
      padding: 15px 1.5rem;
      font-size: 1rem; font-weight: 800;
      width: 100%; cursor: pointer;
      letter-spacing: .2px;
      transition: background .18s, transform .12s;
      position: relative; z-index: 1;
    }
    .btn-razorpay:hover  { background: var(--primary-dark); color: #fff; }
    .btn-razorpay:active { transform: scale(.98); }
    .btn-razorpay .rzp-icon { width: 22px; height: 22px; flex-shrink: 0; }

    .rzp-secure {
      display: flex; align-items: center; justify-content: center; gap: 5px;
      font-size: .73rem; color: #a08040;
      margin-top: .7rem;
    }

    .paid-banner {
      background: linear-gradient(135deg, #D1FAE5, #ecfdf5);
      border: 1.5px solid #6EE7B7;
      border-radius: 14px;
      padding: 1.2rem 1.5rem;
      text-align: center;
      margin-bottom: 1.5rem;
    }
    .paid-banner .tick { font-size: 2rem; }
    .paid-banner p { color: #065F46; font-weight: 700; font-size: .92rem; margin-top: .3rem; }

    .footer-row {
      display: flex; gap: .7rem; justify-content: center; flex-wrap: wrap;
    }
    .footer-row a {
      display: inline-flex; align-items: center; gap: 5px;
      font-size: .83rem; font-weight: 700;
      color: var(--primary-dark);
      border: 1.5px solid var(--primary-border);
      background: var(--primary-light);
      padding: 9px 20px; border-radius: 10px;
      text-decoration: none;
      transition: background .15s;
    }
    .footer-row a:hover { background: #F5D980; }

    .divider { height: 1px; background: var(--primary-border); margin: 1.5rem 0; }

    @media (max-width: 500px) {
      .card-hero h1 { font-size: 1.5rem; }
      .pay-box .amount { font-size: 2rem; }
      .footer-row a { padding: 8px 14px; font-size: .78rem; }
      .card-body { padding: 1.4rem; }
    }
  </style>
@endsection

@section('content')

  <div class="thankyou-wrapper">
    <div class="card">

      <!-- HERO -->
      <div class="card-hero">
        <div class="dot1"></div>
        <div class="dot2"></div>

        <div class="check-ring">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M5 13l4 4L19 7" stroke="#F0A500" stroke-width="2.8"
                  stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>

        @if($booking->payment_status === 'paid')
          <h1>🎉 Payment Successful!</h1>
          <p class="subtitle">Your booking is confirmed and payment received</p>
        @else
          <h1>✈️ Booking Confirmed!</h1>
          <p class="subtitle">Your travel Getaways has been successfully reserved</p>
        @endif

        <div class="booking-id-pill">
          <span>BOOKING ID</span> &nbsp;·&nbsp; #BK-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}
        </div>
      </div>

      <!-- BODY -->
      <div class="card-body">

        @if(session('success'))
          <div class="flash-success">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
          <div class="flash-error">❌ {{ session('error') }}</div>
        @endif

        <div class="sec-label">📋 Booking Summary</div>

        <div class="detail-table">
          <div class="detail-row">
            <span class="detail-label">Getaways</span>
            <span class="detail-value">{{ $booking->package->name ?? '—' }}</span>
          </div>
          <div class="detail-row">
            <span class="detail-label">Guest Name</span>
            <span class="detail-value">{{ $booking->name }}</span>
          </div>
          <div class="detail-row">
            <span class="detail-label">Email</span>
            <span class="detail-value">{{ $booking->email }}</span>
          </div>
          <div class="detail-row">
            <span class="detail-label">Check-in</span>
            <span class="detail-value">{{ \Carbon\Carbon::parse($booking->checkin)->format('d M, Y') }}</span>
          </div>
          <div class="detail-row">
            <span class="detail-label">Check-out</span>
            <span class="detail-value">{{ \Carbon\Carbon::parse($booking->checkout)->format('d M, Y') }}</span>
          </div>
          <div class="detail-row">
            <span class="detail-label">Guests</span>
            <span class="detail-value">
              {{ $booking->adult }} Adult{{ $booking->adult != 1 ? 's' : '' }}
              @if($booking->child > 0)
                &nbsp;·&nbsp; {{ $booking->child }} Child{{ $booking->child != 1 ? 'ren' : '' }}
              @endif
            </span>
          </div>
          @if($booking->message)
            <div class="detail-row">
              <span class="detail-label">Message</span>
              <span class="detail-value" style="max-width:60%;word-break:break-word;">{{ $booking->message }}</span>
            </div>
          @endif
          <div class="detail-row">
            <span class="detail-label">Booking Status</span>
            <span class="detail-value">
              <span class="badge badge-{{ $booking->booking_status }}">
                {{ ucfirst($booking->booking_status) }}
              </span>
            </span>
          </div>
          <div class="detail-row">
            <span class="detail-label">Payment Status</span>
            <span class="detail-value">
              <span class="badge badge-{{ $booking->payment_status }}">
                {{ ucfirst($booking->payment_status) }}
              </span>
            </span>
          </div>
          @if($booking->razorpay_payment_id)
            <div class="detail-row">
              <span class="detail-label">Payment ID</span>
              <span class="detail-value" style="font-size:.78rem;color:#7a6030;">
                {{ $booking->razorpay_payment_id }}
              </span>
            </div>
          @endif
        </div>

        <!-- PAYMENT SECTION -->
        @if($booking->payment_status === 'paid')

          @php
            $advancePerDay   = $booking->package->advance_price ?? 1000;
            $totalPerDay     = $booking->package->total_price ?? $advancePerDay;
            $checkin         = \Carbon\Carbon::parse($booking->checkin);
            $checkout        = \Carbon\Carbon::parse($booking->checkout);
            $nights          = max(1, $checkin->diffInDays($checkout));
            $advanceAmount   = $advancePerDay * $nights;
            $totalAmount     = $totalPerDay   * $nights;
            $remainingAmount = $totalAmount   - $advanceAmount;
          @endphp

          <div class="paid-banner">
            <div class="tick">✅</div>
            <p>Payment received! Your booking is fully confirmed.</p>
          </div>

          <div class="price-breakdown" style="margin-bottom:1.5rem;">
            <div class="price-row">
              <span class="pr-label">Nights</span>
              <span class="pr-value">{{ $nights }} night{{ $nights > 1 ? 's' : '' }}</span>
            </div>
            <div class="price-row">
              <span class="pr-label">Total Getaways (₹{{ number_format($totalPerDay, 0) }}/night × {{ $nights }})</span>
              <span class="pr-value">₹ {{ number_format($totalAmount, 0) }}</span>
            </div>
            <div class="price-row highlight">
              <span class="pr-label">✅ Advance Paid (₹{{ number_format($advancePerDay, 0) }}/night × {{ $nights }})</span>
              <span class="pr-value">₹ {{ number_format($advanceAmount, 0) }}</span>
            </div>
            @if($remainingAmount > 0)
              <div class="price-row balance">
                <span class="pr-label">🏨 Pay at Property</span>
                <span class="pr-value">₹ {{ number_format($remainingAmount, 0) }}</span>
              </div>
            @endif
          </div>

        @elseif($razorpayOrderId)

          @php
            $advancePerDay   = $booking->package->advance_price ?? 1000;
            $totalPerDay     = $booking->package->total_price ?? $advancePerDay;
            $checkin         = \Carbon\Carbon::parse($booking->checkin);
            $checkout        = \Carbon\Carbon::parse($booking->checkout);
            $nights          = max(1, $checkin->diffInDays($checkout));
            $advanceAmount   = $advancePerDay * $nights;
            $totalAmount     = $totalPerDay   * $nights;
            $remainingAmount = $totalAmount   - $advanceAmount;
          @endphp

          <div class="sec-label">💳 Complete Payment</div>
          <div class="pay-box">

            <div class="pay-label">Pay Now to Confirm Your Booking</div>
            <div class="amount">₹ {{ number_format($advanceAmount, 0) }}</div>
            <div class="per-person">Advance payment · Book now, pay rest on arrival</div>

            <div class="price-breakdown">
              <div class="price-row">
                <span class="pr-label">Nights</span>
                <span class="pr-value">{{ $nights }} night{{ $nights > 1 ? 's' : '' }}</span>
              </div>
              <div class="price-row">
                <span class="pr-label">Total Getaways (₹{{ number_format($totalPerDay, 0) }}/night × {{ $nights }})</span>
                <span class="pr-value">₹ {{ number_format($totalAmount, 0) }}</span>
              </div>
              <div class="price-row highlight">
                <span class="pr-label">⚡ Pay Now (₹{{ number_format($advancePerDay, 0) }}/night × {{ $nights }})</span>
                <span class="pr-value">₹ {{ number_format($advanceAmount, 0) }}</span>
              </div>
              @if($remainingAmount > 0)
                <div class="price-row balance">
                  <span class="pr-label">🏨 Pay at Property</span>
                  <span class="pr-value">₹ {{ number_format($remainingAmount, 0) }}</span>
                </div>
              @endif
            </div>

            <div class="pay-info-note">
              <strong>How it works:</strong> Pay the advance of
              <strong>₹ {{ number_format($advanceAmount, 0) }}</strong> now to secure your booking.
              The remaining amount of
              <strong>₹ {{ number_format($remainingAmount, 0) }}</strong>
              will be collected directly at the property upon your arrival.
              No hidden charges apply.
            </div>

            <button class="btn-razorpay" id="rzp-btn" onclick="openRazorpay()">
              <svg class="rzp-icon" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="40" height="40" rx="8" fill="white" fill-opacity="0.2"/>
                <path d="M10 28L17 12H22L18 22H28L14 36L17 26H10V28Z" fill="#1E1C1C"/>
              </svg>
              Pay ₹ {{ number_format($advanceAmount, 0) }} with Razorpay
            </button>
            <div class="rzp-secure">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                <path d="M12 2L4 6v6c0 5.5 3.5 10.7 8 12 4.5-1.3 8-6.5 8-12V6l-8-4z"
                      stroke="#a08040" stroke-width="2" fill="none"/>
              </svg>
              100% Secure &amp; Encrypted &nbsp;·&nbsp; Powered by Razorpay
            </div>
          </div>
        @endif

        <div class="divider"></div>

        <div class="footer-row">
          <a href="{{ url('/') }}">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
              <path d="M3 12L12 3l9 9M5 10v9a1 1 0 001 1h4v-5h4v5h4a1 1 0 001-1v-9"
                    stroke="#C47F00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Home
          </a>
          <a href="{{ url('/contact') }}">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
              <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.82 19.79 19.79 0 01.0 1.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92v2z"
                    stroke="#C47F00" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Support
          </a>
        </div>

      </div>{{-- /card-body --}}
    </div>{{-- /card --}}
  </div>{{-- /thankyou-wrapper --}}

@endsection

@section('js')
  @if($booking->payment_status !== 'paid' && $razorpayOrderId)
    @php
      $advancePerDay = $booking->package->advance_price ?? 1000;
      $checkin       = \Carbon\Carbon::parse($booking->checkin);
      $checkout      = \Carbon\Carbon::parse($booking->checkout);
      $nights        = max(1, $checkin->diffInDays($checkout));
      $advanceAmount = $advancePerDay * $nights;
    @endphp
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
      function openRazorpay() {
        var options = {
          key:         "{{ config('services.razorpay.key') }}",
          amount:      {{ $advanceAmount * 100 }},
          currency:    "INR",
          name:        "Travel Hostel",
          description: "Package Booking #BK-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}",
          order_id:    "{{ $razorpayOrderId }}",

          handler: function(response) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("razorpay.callback") }}';

            var fields = {
              '_token':            '{{ csrf_token() }}',
              razorpay_payment_id: response.razorpay_payment_id,
              razorpay_order_id:   response.razorpay_order_id,
              razorpay_signature:  response.razorpay_signature,
              booking_id:          '{{ $booking->id }}'
            };

            Object.entries(fields).forEach(function([k, v]) {
              var inp = document.createElement('input');
              inp.type = 'hidden'; inp.name = k; inp.value = v;
              form.appendChild(inp);
            });

            document.body.appendChild(form);
            form.submit();
          },

          prefill: {
            name:  "{{ $booking->name }}",
            email: "{{ $booking->email }}"
          },

          modal: {
            ondismiss: function() {
              document.getElementById('rzp-btn').textContent = 'Retry Payment';
            }
          },

          theme: { color: "#F0A500" }
        };

        var rzp = new Razorpay(options);
        rzp.open();
      }
    </script>
  @endif
@endsection