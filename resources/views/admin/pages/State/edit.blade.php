@extends('admin.layout.master')

@section('content')

{{-- Header --}}
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
    <div class="flex items-center gap-3">
        <div class="w-12 h-12 bg-gradient-to-br from-amber-400 to-amber-600 rounded-2xl flex items-center justify-center shadow-lg shadow-amber-200">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-slate-800">Edit State</h2>
            <p class="text-slate-500 text-sm mt-0.5">Editing: <span class="text-blue-600 font-semibold">{{ $state->state_name }}</span></p>
        </div>
    </div>
    <a href="{{ route('admin.state.index') }}"
       class="flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 px-5 py-3 rounded-2xl transition font-semibold border border-slate-200">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to List
    </a>
</div>

{{-- Validation Errors --}}
@if($errors->any())
<div class="bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-2xl mb-6 flex items-start gap-3">
    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
    </svg>
    <ul class="list-disc ml-2 text-sm space-y-1">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.state.update', $state->id) }}" method="POST" enctype="multipart/form-data">
@csrf
<!--@method('PUT')-->

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- LEFT COLUMN --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- Basic Info --}}
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6">
            <div class="flex items-center gap-2 mb-6 pb-4 border-b border-slate-100">
                <div class="w-7 h-7 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-slate-700 text-lg">Basic Information</h3>
            </div>

            {{-- Country --}}
            <div class="mb-5">
                <label class="block font-semibold text-slate-700 text-sm mb-2">
                    Select Country <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <select name="country_id"
                            class="w-full border border-slate-200 rounded-2xl px-4 py-3 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-slate-50 appearance-none text-slate-700" required>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}"
                                {{ (old('country_id', $state->country_id) == $country->id) ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
                @error('country_id') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
            </div>

            {{-- State Name + Slug --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block font-semibold text-slate-700 text-sm mb-2">
                        State Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="state_name" id="state_name"
                           value="{{ old('state_name', $state->state_name) }}"
                           oninput="autoSlug(this.value)"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-slate-50 text-slate-700" required>
                    @error('state_name') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 text-sm mb-2">
                        Slug
                        <span class="text-slate-400 font-normal text-xs ml-1">(editable)</span>
                    </label>
                    <div class="relative">
                        <input type="text" name="slug" id="slug_field"
                               value="{{ old('slug', $state->slug) }}"
                               class="w-full border border-slate-200 rounded-2xl px-4 py-3 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-slate-50 text-slate-600 font-mono text-sm">
                        <div class="absolute inset-y-0 right-4 flex items-center">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                        </div>
                    </div>
                    @error('slug') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Description --}}
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6">
            <div class="flex items-center gap-2 mb-5 pb-4 border-b border-slate-100">
                <div class="w-7 h-7 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-slate-700 text-lg">Description</h3>
            </div>
            <textarea name="description" rows="5"
                      placeholder="Write an attractive description..."
                      class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-slate-50 resize-none text-slate-700 text-sm leading-relaxed">{{ old('description', $state->description) }}</textarea>
            <p class="text-slate-400 text-xs mt-2">This appears on the destination listing page</p>
            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

    </div>

    {{-- RIGHT COLUMN --}}
    <div class="space-y-6">

        {{-- Image Upload --}}
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6">
            <div class="flex items-center gap-2 mb-5 pb-4 border-b border-slate-100">
                <div class="w-7 h-7 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-slate-700 text-lg">Cover Image</h3>
            </div>

            {{-- Current Image --}}
            @if($state->state_image)
            <div id="currentImageBox" class="mb-4">
                <p class="text-slate-500 text-xs font-semibold uppercase tracking-wide mb-2">Current Image</p>
                <div class="relative rounded-2xl overflow-hidden shadow-md border border-slate-200">
                    <img src="{{ asset($state->state_image) }}"
                         alt="{{ $state->state_name }}"
                         class="w-full h-40 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                    <div class="absolute bottom-2 left-3">
                        <span class="text-white text-xs font-semibold bg-black/40 px-2 py-1 rounded-lg backdrop-blur-sm">
                            Current Image
                        </span>
                    </div>
                </div>
                <p class="text-slate-400 text-xs mt-2 text-center">Upload new image below to replace</p>
            </div>
            @endif

            {{-- Drop Zone --}}
            <div id="dropZone"
                 onclick="document.getElementById('state_image').click()"
                 class="border-2 border-dashed border-slate-300 rounded-2xl p-6 text-center bg-gradient-to-b from-slate-50 to-white hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 cursor-pointer group">
                <div class="w-12 h-12 bg-slate-100 group-hover:bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-3 transition-colors">
                    <svg class="w-6 h-6 text-slate-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                </div>
                <p class="text-slate-600 font-semibold text-sm group-hover:text-blue-600">Click to upload new image</p>
                <p class="text-slate-400 text-xs mt-1">JPG, PNG, WEBP — Max 2MB</p>
                <input type="file" id="state_image" name="state_image" accept="image/*"
                       class="hidden" onchange="previewImage(this)">
            </div>

            {{-- New Preview --}}
            <div id="previewContainer" class="mt-4 hidden">
                <p class="text-slate-500 text-xs font-semibold uppercase tracking-wide mb-2">New Image Preview</p>
                <div class="relative rounded-2xl overflow-hidden shadow-md border-2 border-blue-300">
                    <img id="imagePreview" src="#" alt="Preview" class="w-full h-40 object-cover">
                    <button type="button" onclick="removeImage()"
                            class="absolute top-2 right-2 w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-xl flex items-center justify-center shadow-lg transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <div class="absolute bottom-2 left-3">
                        <span class="text-white text-xs font-semibold bg-blue-500/70 px-2 py-1 rounded-lg backdrop-blur-sm">
                            New Image
                        </span>
                    </div>
                </div>
                <p id="fileName" class="text-slate-400 text-xs mt-2 text-center truncate"></p>
            </div>

            @error('state_image') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
        </div>

        {{-- Status --}}
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6">
            <div class="flex items-center gap-2 mb-5 pb-4 border-b border-slate-100">
                <div class="w-7 h-7 bg-orange-100 rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-slate-700 text-lg">Status</h3>
            </div>

            <div class="space-y-3">
                <label class="flex items-center gap-3 p-3 rounded-2xl border-2 cursor-pointer transition-all duration-200
                              {{ old('status', $state->status) == 1 ? 'border-green-400 bg-green-50' : 'border-slate-200 bg-slate-50' }}"
                       id="activeLabel">
                    <input type="radio" name="status" value="1"
                           {{ old('status', $state->status) == 1 ? 'checked' : '' }}
                           onchange="toggleStatus(this)"
                           class="w-4 h-4 accent-green-600">
                    <div>
                        <p class="font-semibold text-green-700 text-sm">Active</p>
                        <p class="text-green-600 text-xs">Visible on website</p>
                    </div>
                    <div class="ml-auto w-2 h-2 rounded-full bg-green-500 {{ old('status', $state->status) == 1 ? 'animate-pulse' : '' }}"></div>
                </label>

                <label class="flex items-center gap-3 p-3 rounded-2xl border-2 cursor-pointer transition-all duration-200
                              {{ old('status', $state->status) == 0 ? 'border-red-300 bg-red-50' : 'border-slate-200 bg-slate-50' }}"
                       id="inactiveLabel">
                    <input type="radio" name="status" value="0"
                           {{ old('status', $state->status) == 0 ? 'checked' : '' }}
                           onchange="toggleStatus(this)"
                           class="w-4 h-4 accent-red-500">
                    <div>
                        <p class="font-semibold text-red-600 text-sm">Inactive</p>
                        <p class="text-red-400 text-xs">Hidden from website</p>
                    </div>
                    <div class="ml-auto w-2 h-2 rounded-full bg-red-400"></div>
                </label>
            </div>
        </div>

        {{-- Meta Info --}}
        <div class="bg-slate-50 rounded-3xl border border-slate-200 p-5">
            <p class="text-slate-500 text-xs font-semibold uppercase tracking-wide mb-3">Record Info</p>
            <div class="space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">State ID</span>
                    <span class="font-mono font-semibold text-slate-700">#{{ $state->id }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Created</span>
                    <span class="text-slate-700">{{ $state->created_at->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Last Updated</span>
                    <span class="text-slate-700">{{ $state->updated_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>

        {{-- Buttons --}}
        <div class="space-y-3">
            <button type="submit"
                    class="w-full bg-amber-500 hover:bg-amber-600 active:bg-amber-700 text-white py-3.5 rounded-2xl font-bold shadow-lg shadow-amber-200 transition-all flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Update State
            </button>
            <a href="{{ route('admin.state.index') }}"
               class="w-full bg-slate-100 hover:bg-slate-200 text-slate-700 py-3.5 rounded-2xl font-semibold transition flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Cancel
            </a>
        </div>

    </div>
</div>

</form>

<script>
// Auto slug (only if not manually set)
function autoSlug(value) {
    const slugField = document.getElementById('slug_field');
    if (!slugField.dataset.manual) {
        slugField.value = value.toLowerCase().trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
    }
}

document.getElementById('slug_field').addEventListener('input', function () {
    this.dataset.manual = 'true';
    if (!this.value) delete this.dataset.manual;
});

// Image preview
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('imagePreview').src = e.target.result;
            document.getElementById('fileName').textContent = input.files[0].name;
            document.getElementById('previewContainer').classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function removeImage() {
    document.getElementById('state_image').value = '';
    document.getElementById('previewContainer').classList.add('hidden');
}

// Status toggle
function toggleStatus(radio) {
    const a = document.getElementById('activeLabel');
    const b = document.getElementById('inactiveLabel');
    if (radio.value === '1') {
        a.classList.add('border-green-400','bg-green-50');
        a.classList.remove('border-slate-200','bg-slate-50');
        b.classList.remove('border-red-300','bg-red-50');
        b.classList.add('border-slate-200','bg-slate-50');
    } else {
        b.classList.add('border-red-300','bg-red-50');
        b.classList.remove('border-slate-200','bg-slate-50');
        a.classList.remove('border-green-400','bg-green-50');
        a.classList.add('border-slate-200','bg-slate-50');
    }
}
</script>

@endsection