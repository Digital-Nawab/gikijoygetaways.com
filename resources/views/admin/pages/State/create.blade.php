@extends('admin.layout.master')

@section('content')

{{-- Page Header --}}
<div class="flex justify-between items-center mb-8">
    <div>
        <div class="flex items-center gap-3 mb-1">
            <div class="w-10 h-10 bg-blue-600 rounded-2xl flex items-center justify-center shadow-lg">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-slate-800">Add New State</h2>
        </div>
        <p class="text-slate-500 ml-13 pl-1">Fill in all details for the new state / destination</p>
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

<form action="{{ route('admin.state.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- LEFT COLUMN - Main Info --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- Basic Info Card --}}
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
                            class="w-full border border-slate-200 rounded-2xl px-4 py-3 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-slate-50 appearance-none text-slate-700" required>
                        <option value="">— Select Country —</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
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
                @error('country_id') <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p> @enderror
            </div>

            {{-- State Name + Slug in grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- State Name --}}
                <div>
                    <label class="block font-semibold text-slate-700 text-sm mb-2">
                        State Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="state_name" id="state_name"
                           value="{{ old('state_name') }}"
                           placeholder="e.g. Norway, Switzerland"
                           oninput="autoSlug(this.value)"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-slate-50 text-slate-700" required>
                    @error('state_name') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                {{-- Slug --}}
                <div>
                    <label class="block font-semibold text-slate-700 text-sm mb-2">
                        Slug
                        <span class="text-slate-400 font-normal text-xs ml-1">(auto-generated)</span>
                    </label>
                    <div class="relative">
                        <input type="text" name="slug" id="slug_field"
                               value="{{ old('slug') }}"
                               placeholder="e.g. norway-tours"
                               class="w-full border border-slate-200 rounded-2xl px-4 py-3 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-slate-50 text-slate-600 font-mono text-sm">
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

        {{-- Description Card --}}
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
                      placeholder="Write an attractive description about this state/destination for travellers..."
                      class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-slate-50 resize-none text-slate-700 text-sm leading-relaxed">{{ old('description') }}</textarea>
            <p class="text-slate-400 text-xs mt-2">This will appear on the destination listing page</p>
            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

    </div>

    {{-- RIGHT COLUMN - Image & Settings --}}
    <div class="space-y-6">

        {{-- Image Upload Card --}}
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6">
            <div class="flex items-center gap-2 mb-5 pb-4 border-b border-slate-100">
                <div class="w-7 h-7 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-slate-700 text-lg">Cover Image</h3>
            </div>

            {{-- Drop Zone --}}
            <div id="dropZone"
                 onclick="document.getElementById('state_image').click()"
                 class="border-2 border-dashed border-slate-300 rounded-2xl p-8 text-center bg-gradient-to-b from-slate-50 to-white hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 cursor-pointer group">

                <div id="uploadIcon" class="mb-3">
                    <div class="w-14 h-14 bg-slate-100 group-hover:bg-blue-100 rounded-2xl flex items-center justify-center mx-auto transition-colors duration-300">
                        <svg class="w-7 h-7 text-slate-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                    </div>
                </div>

                <p class="text-slate-600 font-semibold text-sm group-hover:text-blue-600 transition-colors">
                    Click to upload image
                </p>
                <p class="text-slate-400 text-xs mt-1">JPG, PNG, WEBP — Max 2MB</p>
                <p class="text-slate-400 text-xs mt-0.5">Recommended: 800×600px</p>

                <input type="file" id="state_image" name="state_image"
                       accept="image/*" class="hidden" onchange="previewImage(this)">
            </div>

            {{-- Preview --}}
            <div id="previewContainer" class="mt-4 hidden">
                <div class="relative rounded-2xl overflow-hidden shadow-md">
                    <img id="imagePreview" src="#" alt="Preview"
                         class="w-full h-44 object-cover">
                    <button type="button" onclick="removeImage()"
                            class="absolute top-2 right-2 w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-xl flex items-center justify-center shadow-lg transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <p id="fileName" class="text-slate-500 text-xs mt-2 text-center truncate"></p>
            </div>

            @error('state_image') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
        </div>

        {{-- Status Card --}}
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
                              {{ old('status', '1') == '1' ? 'border-green-400 bg-green-50' : 'border-slate-200 bg-slate-50 hover:border-slate-300' }}"
                       id="activeLabel">
                    <input type="radio" name="status" value="1"
                           {{ old('status', '1') == '1' ? 'checked' : '' }}
                           onchange="toggleStatus(this)"
                           class="w-4 h-4 accent-green-600">
                    <div>
                        <p class="font-semibold text-green-700 text-sm">Active</p>
                        <p class="text-green-600 text-xs">Visible on website</p>
                    </div>
                    <div class="ml-auto w-2 h-2 rounded-full bg-green-500"></div>
                </label>

                <label class="flex items-center gap-3 p-3 rounded-2xl border-2 cursor-pointer transition-all duration-200
                              {{ old('status') == '0' ? 'border-red-300 bg-red-50' : 'border-slate-200 bg-slate-50 hover:border-slate-300' }}"
                       id="inactiveLabel">
                    <input type="radio" name="status" value="0"
                           {{ old('status') == '0' ? 'checked' : '' }}
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

        {{-- Action Buttons --}}
        <div class="space-y-3">
            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white py-3.5 rounded-2xl font-bold shadow-lg shadow-blue-200 transition-all duration-200 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Save State
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
// Auto generate slug from state name
function autoSlug(value) {
    const slugField = document.getElementById('slug_field');
    // Only auto-fill if user hasn't manually edited slug
    if (!slugField.dataset.manual) {
        slugField.value = value
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
    }
}

// Mark slug as manually edited
document.getElementById('slug_field').addEventListener('input', function () {
    this.dataset.manual = 'true';
    if (!this.value) delete this.dataset.manual;
});

// Image preview
function previewImage(input) {
    if (input.files && input.files[0]) {
        const file   = input.files[0];
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('imagePreview').src = e.target.result;
            document.getElementById('fileName').textContent = file.name;
            document.getElementById('previewContainer').classList.remove('hidden');
            document.getElementById('dropZone').classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }
}

// Remove image preview
function removeImage() {
    document.getElementById('state_image').value = '';
    document.getElementById('previewContainer').classList.add('hidden');
    document.getElementById('dropZone').classList.remove('hidden');
}

// Status card highlight toggle
function toggleStatus(radio) {
    const activeLabel   = document.getElementById('activeLabel');
    const inactiveLabel = document.getElementById('inactiveLabel');
    if (radio.value === '1') {
        activeLabel.classList.add('border-green-400', 'bg-green-50');
        activeLabel.classList.remove('border-slate-200', 'bg-slate-50');
        inactiveLabel.classList.remove('border-red-300', 'bg-red-50');
        inactiveLabel.classList.add('border-slate-200', 'bg-slate-50');
    } else {
        inactiveLabel.classList.add('border-red-300', 'bg-red-50');
        inactiveLabel.classList.remove('border-slate-200', 'bg-slate-50');
        activeLabel.classList.remove('border-green-400', 'bg-green-50');
        activeLabel.classList.add('border-slate-200', 'bg-slate-50');
    }
}
</script>

@endsection