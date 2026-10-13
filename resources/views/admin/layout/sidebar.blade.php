@extends('layouts.admin')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')

{{-- ===== STAT CARDS ===== --}}
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 mb-6">

    {{-- Total Contacts --}}
    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <p class="text-sm font-medium text-slate-500">Total Contacts</p>
            </div>
            <span class="text-xs text-green-600 bg-green-50 border border-green-200 px-2 py-0.5 rounded-full font-medium">+2.57%</span>
        </div>
        <p class="text-3xl font-bold text-slate-800">5,758</p>
        <p class="text-xs text-slate-400 mt-2 flex items-center gap-1">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
            </svg>
            Vs last month: 1,195
        </p>
    </div>

    {{-- Lead Analytics --}}
    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-violet-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <p class="text-sm font-medium text-slate-500">Lead Analytics</p>
            </div>
            <span class="text-xs text-red-600 bg-red-50 border border-red-200 px-2 py-0.5 rounded-full font-medium">-2.57%</span>
        </div>
        <p class="text-3xl font-bold text-slate-800">70</p>
        <p class="text-xs text-slate-400 mt-2 flex items-center gap-1">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
            </svg>
            Compared to last month
        </p>
    </div>

    {{-- Active Deals --}}
    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="text-sm font-medium text-slate-500">Active Deals</p>
            </div>
            <span class="text-xs text-green-600 bg-green-50 border border-green-200 px-2 py-0.5 rounded-full font-medium">+2.57%</span>
        </div>
        <p class="text-3xl font-bold text-slate-800">1,249</p>
        <p class="text-xs text-slate-400 mt-2 flex items-center gap-1">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
            </svg>
            Vs last month: 1,195
        </p>
    </div>

</div>

{{-- ===== CHARTS ROW ===== --}}
<div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

    {{-- Revenue Chart --}}
    <div class="xl:col-span-2 bg-white rounded-2xl p-5 border border-slate-200 shadow-sm">
        <div class="flex items-start justify-between mb-4">
            <div>
                <p class="text-sm font-medium text-slate-500 mb-1">Revenue</p>
                <p class="text-2xl font-bold text-slate-800">
                    $2,56,054.50
                    <span class="text-sm text-green-500 font-medium ml-1">+20% vs last month</span>
                </p>
            </div>
            <div class="flex gap-1.5 text-xs">
                <button class="px-3 py-1.5 rounded-lg bg-indigo-600 text-white font-medium transition">Today</button>
                <button class="px-3 py-1.5 rounded-lg text-slate-500 hover:bg-slate-100 transition">Week</button>
                <button class="px-3 py-1.5 rounded-lg text-slate-500 hover:bg-slate-100 transition">Month</button>
            </div>
        </div>
        <div class="h-36 flex items-end gap-2">
            @foreach([30,70,100,55,80,45,60,90,65,40,75,50] as $h)
            <div class="flex-1 rounded-t-md transition-all duration-300"
                style="height:{{ $h }}%; background: {{ $loop->iteration % 2 == 0 ? '#818cf8' : '#4f46e5' }}; opacity: {{ $loop->iteration % 2 == 0 ? '0.6' : '1' }}">
            </div>
            @endforeach
        </div>
        <div class="flex justify-between mt-2">
            @foreach(['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'] as $m)
            <span class="text-xs text-slate-400">{{ $m }}</span>
            @endforeach
        </div>
    </div>

    {{-- Retention Rate --}}
    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm">
        <p class="text-sm font-medium text-slate-500 mb-3">Retention Rate</p>

        {{-- Donut-style percentage display --}}
        <div class="flex flex-col items-center justify-center my-4">
            <div class="relative w-28 h-28">
                <svg viewBox="0 0 36 36" class="w-28 h-28 -rotate-90">
                    <circle cx="18" cy="18" r="15.9" fill="none" stroke="#e2e8f0" stroke-width="3" />
                    <circle cx="18" cy="18" r="15.9" fill="none" stroke="#7c3aed" stroke-width="3"
                        stroke-dasharray="92, 100" stroke-linecap="round" />
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="text-2xl font-bold text-slate-800">92%</span>
                </div>
            </div>
            <p class="text-xs text-green-500 mt-2 font-medium">+15% vs last month</p>
        </div>

        <div class="h-20 flex items-end gap-1.5 mt-2">
            @foreach([60,90,70,100,50,80,65,45,75,55,85,70] as $h)
            <div class="flex-1 bg-violet-500 rounded-t-sm" style="height:{{ $h }}%; opacity:0.7"></div>
            @endforeach
        </div>
    </div>

</div>

{{-- ===== RECENT ACTIVITY ROW ===== --}}
<div class="grid grid-cols-1 xl:grid-cols-2 gap-5 mt-5">

    {{-- Recent Leads --}}
    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <p class="text-sm font-semibold text-slate-700">Recent Leads</p>
            <a href="#" class="text-xs text-indigo-600 hover:text-indigo-800 font-medium transition">View all →</a>
        </div>
        <div class="space-y-3">
            @foreach([
            ['name' => 'Arjun Sharma', 'email' => 'arjun@email.com', 'status' => 'New', 'color' => 'blue'],
            ['name' => 'Priya Mehta', 'email' => 'priya@email.com', 'status' => 'Follow Up', 'color' => 'amber'],
            ['name' => 'Rahul Gupta', 'email' => 'rahul@email.com', 'status' => 'Converted', 'color' => 'green'],
            ['name' => 'Sneha Joshi', 'email' => 'sneha@email.com', 'status' => 'Lost', 'color' => 'red'],
            ] as $lead)
            <div class="flex items-center justify-between py-2 border-b border-slate-100 last:border-0">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-xs font-semibold">
                        {{ strtoupper(substr($lead['name'], 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-700">{{ $lead['name'] }}</p>
                        <p class="text-xs text-slate-400">{{ $lead['email'] }}</p>
                    </div>
                </div>
                <span class="text-xs px-2 py-1 rounded-full font-medium
                    {{ $lead['color'] === 'blue' ? 'bg-blue-50 text-blue-600 border border-blue-200' : '' }}
                    {{ $lead['color'] === 'amber' ? 'bg-amber-50 text-amber-600 border border-amber-200' : '' }}
                    {{ $lead['color'] === 'green' ? 'bg-green-50 text-green-600 border border-green-200' : '' }}
                    {{ $lead['color'] === 'red' ? 'bg-red-50 text-red-600 border border-red-200' : '' }}
                ">{{ $lead['status'] }}</span>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Quick Stats --}}
    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <p class="text-sm font-semibold text-slate-700">Quick Overview</p>
            <span class="text-xs text-slate-400">This Month</span>
        </div>
        <div class="space-y-4">
            @foreach([
            ['label' => 'Packages Sold', 'value' => 84, 'max' => 100, 'color' => 'bg-indigo-500'],
            ['label' => 'Destinations Active', 'value' => 62, 'max' => 100, 'color' => 'bg-violet-500'],
            ['label' => 'Offers Running', 'value' => 45, 'max' => 100, 'color' => 'bg-emerald-500'],
            ['label' => 'Slider Banners', 'value' => 30, 'max' => 100, 'color' => 'bg-amber-500'],
            ] as $stat)
            <div>
                <div class="flex justify-between text-xs mb-1.5">
                    <span class="text-slate-600 font-medium">{{ $stat['label'] }}</span>
                    <span class="text-slate-400">{{ $stat['value'] }}%</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2">
                    <div class="{{ $stat['color'] }} h-2 rounded-full transition-all duration-500"
                        style="width: {{ $stat['value'] }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>

@endsection