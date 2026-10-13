@extends('admin.layout.master')

@section('content')

<div class="min-h-screen bg-slate-100 py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-8xl mx-auto">

        {{-- Breadcrumb --}}
        <nav class="flex mb-4 text-sm" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2">
                <li><a href="#" class="text-slate-500 hover:text-indigo-600">Dashboard</a></li>
                <li class="text-slate-400">/</li>
                <li class="text-indigo-600 font-medium">Contact Submissions</li>
            </ol>
        </nav>

        {{-- Page Header --}}
        <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 rounded-2xl shadow-lg p-6 mb-6 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold flex items-center gap-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Contact Submissions
                    </h1>
                    <p class="text-indigo-100 mt-1 text-sm">All inquiries from your website contact form</p>
                </div>
                <button class="bg-white text-indigo-600 px-5 py-2.5 rounded-lg font-semibold hover:bg-indigo-50 transition shadow-md flex items-center gap-2 justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export CSV
                </button>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            
            {{-- Total Submissions --}}
            <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-indigo-500 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-sm font-medium">Total Inquiries</p>
                        <p class="text-3xl font-bold text-slate-800 mt-1">{{ $contacts->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Total Adults --}}
            <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-green-500 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-sm font-medium">Total Adults</p>
                        <p class="text-3xl font-bold text-slate-800 mt-1">{{ $contacts->sum('adult') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Total Children --}}
            <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-amber-500 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-sm font-medium">Total Children</p>
                        <p class="text-3xl font-bold text-slate-800 mt-1">{{ $contacts->sum('child') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Total People --}}
            <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-pink-500 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-sm font-medium">Total People</p>
                        <p class="text-3xl font-bold text-slate-800 mt-1">{{ $contacts->sum('total_people') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-pink-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

        </div>

        {{-- Main Table Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

            {{-- Toolbar --}}
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        <h2 class="text-base font-bold text-slate-800">All Submissions</h2>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
                        {{-- Filter Dropdown --}}
                        <select class="px-3 py-2 border border-slate-300 rounded-lg text-sm bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option>All Time</option>
                            <option>Today</option>
                            <option>This Week</option>
                            <option>This Month</option>
                        </select>

                        {{-- Search --}}
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Search by name, email..."
                                   class="pl-10 pr-4 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 w-full sm:w-72">
                            <svg class="w-5 h-5 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">#</th>
                            <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Contact</th>
                            <th class="px-6 py-3.5 text-center text-xs font-bold text-slate-600 uppercase tracking-wider">Travelers</th>
                            <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Message</th>
                            <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Submitted</th>
                            <th class="px-6 py-3.5 text-center text-xs font-bold text-slate-600 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse($contacts as $contact)
                        @php
                            $colors = ['from-indigo-500 to-purple-500', 'from-pink-500 to-rose-500', 'from-blue-500 to-cyan-500', 'from-green-500 to-emerald-500', 'from-amber-500 to-orange-500'];
                            $color = $colors[$contact->id % count($colors)];
                        @endphp
                        <tr class="hover:bg-slate-50 transition-colors group">

                            {{-- ID --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-slate-700 text-xs font-bold">
                                    {{ str_pad($contact->id, 2, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>

                            {{-- Customer Name with Avatar --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="flex-shrink-0 h-11 w-11 rounded-full bg-gradient-to-br {{ $color }} flex items-center justify-center text-white font-bold text-sm shadow-md ring-2 ring-white">
                                        {{ strtoupper(substr($contact->first_name, 0, 1) . substr($contact->last_name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-semibold text-slate-900">
                                            {{ $contact->first_name }} {{ $contact->last_name }}
                                        </div>
                                        <div class="text-xs text-slate-500">Customer #{{ $contact->id }}</div>
                                    </div>
                                </div>
                            </td>

                            {{-- Contact Info --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="space-y-1">
                                    <a href="mailto:{{ $contact->email }}" class="flex items-center gap-1.5 text-sm text-indigo-600 hover:text-indigo-800 hover:underline">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="truncate max-w-[180px]">{{ $contact->email }}</span>
                                    </a>
                                    <a href="tel:{{ $contact->phone }}" class="flex items-center gap-1.5 text-sm text-slate-600 hover:text-slate-900">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        {{ $contact->phone }}
                                    </a>
                                </div>
                            </td>

                            {{-- Travelers (Combined) --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center justify-center gap-2">
                                    <div class="flex flex-col items-center px-2.5 py-1 rounded-lg bg-green-50 border border-green-200" title="Adults">
                                        <span class="text-xs text-green-700 font-medium">Adult</span>
                                        <span class="text-sm font-bold text-green-800">{{ $contact->adult }}</span>
                                    </div>
                                    <div class="flex flex-col items-center px-2.5 py-1 rounded-lg bg-amber-50 border border-amber-200" title="Children">
                                        <span class="text-xs text-amber-700 font-medium">Child</span>
                                        <span class="text-sm font-bold text-amber-800">{{ $contact->child }}</span>
                                    </div>
                                    <div class="flex flex-col items-center px-2.5 py-1 rounded-lg bg-indigo-50 border border-indigo-200" title="Total">
                                        <span class="text-xs text-indigo-700 font-medium">Total</span>
                                        <span class="text-sm font-bold text-indigo-800">{{ $contact->total_people }}</span>
                                    </div>
                                </div>
                            </td>

                            {{-- Message --}}
                            <td class="px-6 py-4">
                                <div class="max-w-xs">
                                    <p class="text-sm text-slate-700 line-clamp-2" title="{{ $contact->message }}">
                                        {{ $contact->message }}
                                    </p>
                                    @if(strlen($contact->message) > 50)
                                        <button onclick="showMessage(this)" 
                                                data-message="{{ $contact->message }}"
                                                data-name="{{ $contact->first_name }} {{ $contact->last_name }}"
                                                class="text-xs text-indigo-600 hover:text-indigo-800 font-medium mt-1 inline-flex items-center gap-1">
                                            Read more
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </td>

                            {{-- Date --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-slate-800">
                                    {{ $contact->created_at->format('d M Y') }}
                                </div>
                                <div class="text-xs text-slate-500 flex items-center gap-1 mt-0.5">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $contact->created_at->diffForHumans() }}
                                </div>
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center gap-1">
                                    <a href="mailto:{{ $contact->email }}" 
                                       class="p-2 rounded-lg hover:bg-indigo-50 text-slate-400 hover:text-indigo-600 transition" 
                                       title="Reply via Email">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </a>
                                    <a href="tel:{{ $contact->phone }}" 
                                       class="p-2 rounded-lg hover:bg-green-50 text-slate-400 hover:text-green-600 transition" 
                                       title="Call">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                    </a>
                                    <button class="p-2 rounded-lg hover:bg-red-50 text-slate-400 hover:text-red-600 transition" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-20 h-20 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-800">No Submissions Yet</h3>
                                    <p class="text-sm text-slate-500 mt-1">Contact form submissions will appear here.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Footer --}}
            @if($contacts->count() > 0)
            <div class="px-6 py-4 border-t border-slate-200 bg-slate-50 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-sm text-slate-600">
                    Showing <span class="font-bold text-slate-900">1</span> to 
                    <span class="font-bold text-slate-900">{{ $contacts->count() }}</span> of 
                    <span class="font-bold text-slate-900">{{ $contacts->count() }}</span> results
                </p>
                {{-- For pagination, replace above with: {{ $contacts->links() }} --}}
            </div>
            @endif

        </div>
    </div>
</div>

{{-- Modern Message Modal --}}
<div id="messageModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 py-6">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden animate-fade-in">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-white">Full Message</h3>
                    <p id="modalName" class="text-xs text-indigo-100 mt-0.5"></p>
                </div>
                <button onclick="closeModal()" class="text-white/80 hover:text-white p-1 rounded-lg hover:bg-white/10 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="p-6">
                <p id="modalMessage" class="text-sm text-slate-700 whitespace-pre-wrap leading-relaxed"></p>
            </div>
            <div class="px-6 py-3 bg-slate-50 border-t border-slate-200 flex justify-end">
                <button onclick="closeModal()" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-300 transition">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fade-in 0.2s ease-out; }
</style>

<script>
    function showMessage(btn) {
        document.getElementById('modalMessage').innerText = btn.dataset.message;
        document.getElementById('modalName').innerText = 'From: ' + btn.dataset.name;
        document.getElementById('messageModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeModal() {
        document.getElementById('messageModal').classList.add('hidden');
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeModal();
    });

    document.getElementById('searchInput')?.addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        document.querySelectorAll('tbody tr').forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(filter) ? '' : 'none';
        });
    });
</script>

@endsection