@extends('admin.layout.master')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">

  {{-- Header --}}
  <div class="flex items-center justify-between mb-8">
    <div>
      <h1 class="text-2xl font-bold text-gray-900 tracking-tight">
        📸 Package Gallery
      </h1>
      <p class="text-sm text-gray-400 mt-1">
        {{ $package->name ?? 'Package' }} — {{ $galleries->count() }} images uploaded
      </p>
    </div>
    <a href="{{ route('admin.package.index') }}"
      class="inline-flex items-center gap-2 bg-white border border-gray-200 text-gray-700 text-sm font-semibold px-4 py-2 rounded-xl hover:bg-gray-50">
      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
      </svg>
      Back
    </a>
  </div>

  {{-- Flash --}}
  @if(session('success'))
    <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 text-sm font-medium px-4 py-3 rounded-xl mb-6">
      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
      </svg>
      {{ session('success') }}
    </div>
  @endif

  @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 text-sm font-medium px-4 py-3 rounded-xl mb-6">
      @foreach($errors->all() as $err)
        <div>⚠️ {{ $err }}</div>
      @endforeach
    </div>
  @endif

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- ═══════════════ LEFT: Upload Form ═══════════════ --}}
    <div class="lg:col-span-1">
      <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sticky top-6">

        <div class="flex items-center gap-2 mb-5">
          <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center">
            <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4v16m8-8H4"/>
            </svg>
          </div>
          <h2 class="text-base font-bold text-gray-800">Add New Image</h2>
        </div>

        <form action="{{ route('admin.package.gallery.store') }}"
              method="POST"
              enctype="multipart/form-data"
              id="uploadForm">
          @csrf
          <input type="hidden" name="package_id" value="{{ $package->id }}">

          {{-- Drop Zone --}}
          <label for="imageInput"
            class="block cursor-pointer border-2 border-dashed border-gray-200 hover:border-blue-400 hover:bg-blue-50/30 rounded-2xl p-6 text-center transition-all"
            id="dropZone">

            {{-- Preview (hidden initially) --}}
            <div id="previewWrap" class="hidden">
              <img id="previewImg" src="" class="w-full h-44 object-cover rounded-xl mb-3">
              <div class="text-xs text-gray-500" id="fileName"></div>
              <button type="button" onclick="clearPreview(event)"
                class="text-xs text-red-500 hover:text-red-700 font-semibold mt-1">
                ✕ Remove
              </button>
            </div>

            {{-- Placeholder --}}
            <div id="placeholder">
              <div class="w-14 h-14 mx-auto bg-blue-50 rounded-2xl flex items-center justify-center mb-3">
                <svg class="w-7 h-7 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
              </div>
              <div class="text-sm font-semibold text-gray-700">Click to select image</div>
              <div class="text-xs text-gray-400 mt-1">JPG, PNG, WEBP · Max 2MB</div>
            </div>
          </label>

          <input type="file" id="imageInput" name="image"
                 accept="image/*" class="hidden" onchange="showPreview(event)">

          {{-- Caption --}}
          <div class="mt-4">
            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">
              Caption <span class="text-gray-300 normal-case font-normal">(Optional)</span>
            </label>
            <input type="text" name="caption"
              placeholder="e.g. Hotel pool view, Bedroom, Reception..."
              class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400">
          </div>

          <button type="submit"
            class="w-full mt-4 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-3 rounded-xl transition-all flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
            </svg>
            Upload Image
          </button>
        </form>

      </div>
    </div>

    {{-- ═══════════════ RIGHT: Gallery Grid ═══════════════ --}}
    <div class="lg:col-span-2">
      <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
          <h2 class="text-base font-bold text-gray-800">Uploaded Images</h2>
          <span class="text-xs bg-blue-50 text-blue-600 px-3 py-1 rounded-full font-semibold">
            {{ $galleries->count() }} total
          </span>
        </div>

        <div class="p-6">
          @if($galleries->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
              @foreach($galleries as $img)
                <div class="group bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 hover:shadow-lg transition-all">

                  {{-- Image --}}
                  <div class="relative overflow-hidden">
                    <img src="{{ asset('admin-assets/home/package-gallery/' . $img->image) }}"
                         alt="{{ $img->caption ?? 'Gallery' }}"
                         class="w-full h-44 object-cover group-hover:scale-105 transition-transform duration-300">

                    {{-- Action Overlay --}}
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100">
                      <a href="{{ route('admin.package.gallery.edit', $img->id) }}"
                        class="bg-white text-gray-800 text-xs font-bold px-3 py-1.5 rounded-lg hover:bg-yellow-50 hover:text-yellow-700">
                        ✏️ Edit
                      </a>
                      <form action="{{ route('admin.package.gallery.delete', $img->id) }}"
                            method="POST"
                            onsubmit="return confirm('Delete this image?')">
                        @csrf @method('DELETE')
                        <button class="bg-white text-red-600 text-xs font-bold px-3 py-1.5 rounded-lg hover:bg-red-50">
                          🗑 Delete
                        </button>
                      </form>
                    </div>
                  </div>

                  {{-- Caption --}}
                  <div class="p-3">
                    @if($img->caption)
                      <div class="text-sm font-semibold text-gray-800 line-clamp-2" title="{{ $img->caption }}">
                        {{ $img->caption }}
                      </div>
                    @else
                      <div class="text-xs text-gray-300 italic">No caption</div>
                    @endif
                    <div class="text-[10px] text-gray-400 mt-1">
                      {{ $img->created_at->format('d M Y') }}
                    </div>
                  </div>

                </div>
              @endforeach
            </div>
          @else
            {{-- Empty State --}}
            <div class="text-center py-16">
              <div class="w-16 h-16 mx-auto bg-gray-100 rounded-2xl flex items-center justify-center mb-3">
                <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
              </div>
              <div class="text-sm font-medium text-gray-400">No images yet</div>
              <div class="text-xs text-gray-300 mt-1">Upload your first image from the left</div>
            </div>
          @endif
        </div>

      </div>
    </div>

  </div>
</div>

{{-- ═══════════════ Preview Script ═══════════════ --}}
<script>
function showPreview(e) {
  const file = e.target.files[0];
  if (!file) return;

  const reader = new FileReader();
  reader.onload = (ev) => {
    document.getElementById('previewImg').src = ev.target.result;
    document.getElementById('fileName').innerText = file.name;
    document.getElementById('previewWrap').classList.remove('hidden');
    document.getElementById('placeholder').classList.add('hidden');
  };
  reader.readAsDataURL(file);
}

function clearPreview(e) {
  e.preventDefault();
  document.getElementById('imageInput').value = '';
  document.getElementById('previewWrap').classList.add('hidden');
  document.getElementById('placeholder').classList.remove('hidden');
}
</script>
@endsection