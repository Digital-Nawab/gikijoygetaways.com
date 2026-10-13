@extends('admin.layout.master')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">

  {{-- Header --}}
  <div class="flex items-center justify-between mb-8">
    <div>
      <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Transaction History</h1>
      <p class="text-sm text-gray-400 mt-1">All Razorpay payments received from customers</p>
    </div>
    <span class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-600 text-sm font-semibold px-4 py-2 rounded-full border border-emerald-100">
      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      ₹{{ number_format($totalRevenue) }} Total
    </span>
  </div>

  {{-- Stats --}}
  <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
      <div class="flex items-center justify-between mb-3">
        <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Total Revenue</span>
        <div class="w-9 h-9 bg-emerald-50 rounded-xl flex items-center justify-center">
          <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
      </div>
      <div class="text-3xl font-bold text-emerald-600 mb-1">₹{{ number_format($totalRevenue) }}</div>
      <div class="text-xs text-gray-400">All time advance collected</div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
      <div class="flex items-center justify-between mb-3">
        <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Today Revenue</span>
        <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center">
          <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
        </div>
      </div>
      <div class="text-3xl font-bold text-blue-600 mb-1">₹{{ number_format($todayRevenue) }}</div>
      <div class="text-xs text-gray-400">Received today</div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
      <div class="flex items-center justify-between mb-3">
        <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Total Txns</span>
        <div class="w-9 h-9 bg-violet-50 rounded-xl flex items-center justify-center">
          <svg class="w-4 h-4 text-violet-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
          </svg>
        </div>
      </div>
      <div class="text-3xl font-bold text-gray-900 mb-1">{{ $totalTxns }}</div>
      <div class="text-xs text-gray-400">Successful payments</div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
      <div class="flex items-center justify-between mb-3">
        <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Today Txns</span>
        <div class="w-9 h-9 bg-amber-50 rounded-xl flex items-center justify-center">
          <svg class="w-4 h-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
        </div>
      </div>
      <div class="text-3xl font-bold text-gray-900 mb-1">{{ $todayTxns }}</div>
      <div class="text-xs text-gray-400">Payments today</div>
    </div>

  </div>

  {{-- Filters --}}
  <form method="GET" action="{{ route('admin.transactions.index') }}"
    class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 mb-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
      <input type="text" name="search" value="{{ request('search') }}"
        placeholder="Search name, email, payment ID..."
        class="px-4 py-2.5 rounded-xl border border-gray-200 text-sm outline-none focus:ring-2 focus:ring-blue-200 md:col-span-2">

      <input type="date" name="from" value="{{ request('from') }}"
        class="px-4 py-2.5 rounded-xl border border-gray-200 text-sm outline-none focus:ring-2 focus:ring-blue-200">

      <input type="date" name="to" value="{{ request('to') }}"
        class="px-4 py-2.5 rounded-xl border border-gray-200 text-sm outline-none focus:ring-2 focus:ring-blue-200">
    </div>
    <div class="flex gap-2 mt-3">
      <button type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-2 rounded-xl">
        🔍 Apply Filter
      </button>
      <a href="{{ route('admin.transactions.index') }}"
        class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold px-5 py-2 rounded-xl">
        Reset
      </a>
    </div>
  </form>

  {{-- Table --}}
  <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
      <h2 class="text-base font-bold text-gray-800">All Transactions</h2>
      <span class="text-xs text-gray-400">{{ $transactions->total() }} records</span>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead>
          <tr class="bg-gray-50 border-b border-gray-100">
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 py-3">#</th>
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 py-3">Date</th>
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 py-3">Customer</th>
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 py-3">Package</th>
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 py-3">Payment ID</th>
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 py-3">Order ID</th>
            <th class="text-right text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 py-3">Amount</th>
            <th class="text-center text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 py-3">Status</th>
            <th class="text-center text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 py-3">Action</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
          @forelse($transactions as $key => $t)
          <tr class="hover:bg-gray-50 transition-colors">

            <td class="px-4 py-4 text-xs text-gray-300 font-medium">
              {{ $transactions->firstItem() + $key }}
            </td>

            <td class="px-4 py-4 whitespace-nowrap">
              <div class="text-sm font-semibold text-gray-800">{{ $t->created_at->format('d M Y') }}</div>
              <div class="text-xs text-gray-400">{{ $t->created_at->format('h:i A') }}</div>
            </td>

            <td class="px-4 py-4">
              <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                  {{ strtoupper(substr($t->name, 0, 1)) }}
                </div>
                <div>
                  <div class="font-semibold text-gray-800 text-sm leading-tight">{{ $t->name }}</div>
                  <div class="text-xs text-gray-400 mt-0.5">{{ $t->email }}</div>
                </div>
              </div>
            </td>

            <td class="px-4 py-4">
              <span class="inline-flex items-center bg-blue-50 text-blue-700 text-xs font-semibold px-3 py-1.5 rounded-lg border border-blue-100 whitespace-nowrap">
                {{ $t->package->name ?? 'N/A' }}
              </span>
            </td>

            <td class="px-4 py-4">
              <div class="flex items-center gap-2">
                <code class="text-xs font-mono bg-emerald-50 text-emerald-700 px-2 py-1 rounded border border-emerald-100">
                  {{ Str::limit($t->razorpay_payment_id, 18) }}
                </code>
                <button onclick="navigator.clipboard.writeText('{{ $t->razorpay_payment_id }}'); this.innerText='✅'"
                  class="text-gray-300 hover:text-gray-600 text-xs">📋</button>
              </div>
            </td>

            <td class="px-4 py-4">
              <code class="text-xs font-mono text-gray-500">
                {{ Str::limit($t->razorpay_order_id, 18) }}
              </code>
            </td>

            <td class="px-4 py-4 text-right">
              <div class="text-sm font-bold text-emerald-600">
                ₹{{ number_format($t->package->advance_price ?? 0) }}
              </div>
              <div class="text-xs text-gray-400">Advance</div>
            </td>

            <td class="px-4 py-4 text-center">
              <span class="inline-flex items-center gap-1 bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold px-2.5 py-1 rounded-full">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                Success
              </span>
            </td>

            <td class="px-4 py-4 text-center">
              <a href="{{ route('admin.package.booking.show', $t->id) }}"
                class="inline-flex items-center gap-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 border border-blue-100 text-xs font-semibold px-3 py-1.5 rounded-lg transition-colors">
                View
              </a>
            </td>

          </tr>
          @empty
          <tr>
            <td colspan="9" class="text-center py-16">
              <div class="flex flex-col items-center gap-3">
                <div class="w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center">
                  <svg class="w-7 h-7 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                  </svg>
                </div>
                <div class="text-sm font-medium text-gray-400">No transactions found</div>
                <div class="text-xs text-gray-300">Razorpay payments will appear here</div>
              </div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    @if($transactions->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">
      {{ $transactions->links() }}
    </div>
    @endif
  </div>

</div>
@endsection