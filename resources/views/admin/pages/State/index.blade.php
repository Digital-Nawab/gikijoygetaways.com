@extends('admin.layout.master')

@section('content')

{{-- Header --}}
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
    <div class="flex items-center gap-3">
        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-200">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-slate-800">State Management</h2>
            <p class="text-slate-500 text-sm mt-0.5">Manage all states / destinations</p>
        </div>
    </div>

    <a href="{{ route('admin.state.create') }}"
       class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white px-5 py-3 rounded-2xl shadow-lg shadow-blue-200 transition font-semibold">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Add New State
    </a>
</div>

{{-- Success Alert --}}
@if(session('success'))
<div class="bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-2xl mb-6 flex items-center gap-3 shadow-sm">
    <div class="w-8 h-8 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
    </div>
    <p class="font-semibold text-sm">{{ session('success') }}</p>
    <button onclick="this.parentElement.remove()" class="ml-auto text-green-400 hover:text-green-600">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
</div>
@endif

{{-- Stats Bar --}}
<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100 flex items-center gap-3">
        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
            </svg>
        </div>
        <div>
            <p class="text-2xl font-bold text-slate-800">{{ $states->count() }}</p>
            <p class="text-slate-500 text-xs">Total States</p>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100 flex items-center gap-3">
        <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div>
            <p class="text-2xl font-bold text-slate-800">{{ $states->where('status', 1)->count() }}</p>
            <p class="text-slate-500 text-xs">Active</p>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100 flex items-center gap-3">
        <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center">
            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div>
            <p class="text-2xl font-bold text-slate-800">{{ $states->where('status', 0)->count() }}</p>
            <p class="text-slate-500 text-xs">Inactive</p>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100 flex items-center gap-3">
        <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
        <div>
            <p class="text-2xl font-bold text-slate-800">{{ $states->whereNotNull('state_image')->count() }}</p>
            <p class="text-slate-500 text-xs">With Image</p>
        </div>
    </div>
</div>

{{-- Table Card --}}
<div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">

    {{-- Table Toolbar --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 px-6 py-4 border-b border-slate-100">
        <p class="text-slate-600 text-sm font-medium">
            Showing <span class="text-blue-600 font-bold">{{ $states->count() }}</span> states
        </p>
        {{-- Search (visual only — add JS filter if needed) --}}
        <div class="relative">
            <input type="text" id="tableSearch" placeholder="Search states..."
                   onkeyup="searchTable()"
                   class="pl-9 pr-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-slate-50 w-60">
            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left" id="stateTable">
            <thead>
                <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider font-semibold">
                    <th class="px-6 py-4">#</th>
                    <th class="px-6 py-4">Destination</th>
                    <th class="px-6 py-4">Slug</th>
                    <th class="px-6 py-4">Country</th>
                    <th class="px-6 py-4">Description</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse($states as $key => $state)
                <tr class="border-t border-slate-100 hover:bg-blue-50/30 transition-colors duration-150 group">

                    {{-- Serial --}}
                    <td class="px-6 py-4">
                        <span class="w-7 h-7 bg-slate-100 text-slate-600 rounded-lg text-xs font-bold flex items-center justify-center">
                            {{ $key + 1 }}
                        </span>
                    </td>

                    {{-- Image + Name --}}
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            @if($state->state_image)
                                <img src="{{ asset($state->state_image) }}"
                                     alt="{{ $state->state_name }}"
                                     class="w-14 h-10 object-cover rounded-xl shadow-sm border border-slate-200 group-hover:scale-105 transition-transform duration-200">
                            @else
                                <div class="w-14 h-10 bg-gradient-to-br from-slate-100 to-slate-200 rounded-xl flex items-center justify-center border border-slate-200">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            <div>
                                <p class="font-semibold text-slate-800 text-sm">{{ $state->state_name }}</p>
                                <p class="text-slate-400 text-xs mt-0.5">ID: {{ $state->id }}</p>
                            </div>
                        </div>
                    </td>

                    {{-- Slug --}}
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-600 px-3 py-1.5 rounded-lg text-xs font-mono">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                            {{ $state->slug ?? '—' }}
                        </span>
                    </td>

                    {{-- Country --}}
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1.5 bg-indigo-50 text-indigo-700 border border-indigo-100 px-3 py-1.5 rounded-xl text-xs font-semibold">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064"/>
                            </svg>
                            {{ $state->country->name ?? 'N/A' }}
                        </span>
                    </td>

                    {{-- Description --}}
                    <td class="px-6 py-4 max-w-xs">
                        @if($state->description)
                            <p class="text-slate-500 text-sm truncate" title="{{ $state->description }}">
                                {{ \Illuminate\Support\Str::limit($state->description, 45) }}
                            </p>
                        @else
                            <span class="text-slate-300 text-sm">—</span>
                        @endif
                    </td>

                    {{-- Status --}}
                    <td class="px-6 py-4">
                        @if($state->status)
                            <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 border border-green-200 px-3 py-1.5 rounded-xl text-xs font-semibold">
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                                Active
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 bg-red-50 text-red-600 border border-red-200 px-3 py-1.5 rounded-xl text-xs font-semibold">
                                <span class="w-1.5 h-1.5 bg-red-400 rounded-full"></span>
                                Inactive
                            </span>
                        @endif
                    </td>

                    {{-- Actions --}}
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.state.edit', $state->id) }}"
                               title="Edit State"
                               class="w-9 h-9 bg-amber-50 hover:bg-amber-500 text-amber-600 hover:text-white border border-amber-200 hover:border-amber-500 rounded-xl flex items-center justify-center transition-all duration-200 shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>

                            <form action="{{ route('admin.state.destroy', $state->id) }}"
                                  method="POST"
                                  onsubmit="return confirmDelete(event, '{{ $state->state_name }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Delete State"
                                        class="w-9 h-9 bg-red-50 hover:bg-red-500 text-red-500 hover:text-white border border-red-200 hover:border-red-500 rounded-xl flex items-center justify-center transition-all duration-200 shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="7" class="text-center py-20">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-20 h-20 bg-slate-100 rounded-3xl flex items-center justify-center">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-slate-600 font-semibold text-lg">No states found</p>
                                <p class="text-slate-400 text-sm mt-1">Start by adding your first destination</p>
                            </div>
                            <a href="{{ route('admin.state.create') }}"
                               class="mt-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition">
                                + Add First State
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($states->count() > 0)
    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 text-slate-500 text-sm flex items-center justify-between">
        <p>Total <strong class="text-slate-700">{{ $states->count() }}</strong> records</p>
        <p class="text-xs text-slate-400">Last updated: {{ now()->format('d M Y, h:i A') }}</p>
    </div>
    @endif
</div>

{{-- Delete Confirm Modal --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-3xl shadow-2xl p-8 max-w-sm w-full mx-4 transform transition-all">
        <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-slate-800 text-center mb-2">Delete State?</h3>
        <p class="text-slate-500 text-center text-sm mb-1">You are about to delete</p>
        <p id="deleteStateName" class="text-blue-600 font-bold text-center mb-6"></p>
        <p class="text-red-400 text-xs text-center mb-6">This action cannot be undone.</p>
        <div class="flex gap-3">
            <button onclick="closeDeleteModal()"
                    class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-700 py-3 rounded-2xl font-semibold transition">
                Cancel
            </button>
            <button id="confirmDeleteBtn"
                    class="flex-1 bg-red-500 hover:bg-red-600 text-white py-3 rounded-2xl font-semibold transition shadow-lg shadow-red-200">
                Yes, Delete
            </button>
        </div>
    </div>
</div>

<script>
// Live search
function searchTable() {
    const input  = document.getElementById('tableSearch').value.toLowerCase();
    const rows   = document.querySelectorAll('#tableBody tr');
    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(input) ? '' : 'none';
    });
}

// Delete modal
let pendingForm = null;

function confirmDelete(e, name) {
    e.preventDefault();
    pendingForm = e.target.closest('form');
    document.getElementById('deleteStateName').textContent = '"' + name + '"';
    const modal = document.getElementById('deleteModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    return false;
}

document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
    if (pendingForm) pendingForm.submit();
});

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    pendingForm = null;
}

// Close on backdrop click
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
});
</script>

@endsection