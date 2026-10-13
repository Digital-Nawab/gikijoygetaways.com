@extends('admin.layout.master')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">

  {{-- Header --}}
  <div class="flex items-center justify-between mb-8">
    <div>
      <h1 class="text-2xl font-bold text-gray-900 tracking-tight">✏️ Edit Gallery Image</h1>
      <p class="text-sm text-gray-400 mt-1">Update image and caption</p>
    </div>
    <a href="{{ route('admin.package.gallery.create', $gallery->package_id) }}"
      class="inline-flex items-center gap-2 bg-white border border-gray-200 text-gray-700 text-sm font-semibold px-4 py-2 rounded-xl hover:bg-gray-50">
      ← Back to Gallery
    </a>
  </div>

  @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 text-sm font-medium px-4 py-3 rounded-xl mb-6">
      @foreach($errors->all() as $err)
        <div>⚠️ {{ $err }}</div>
      @endforeach
    </div>
  @endif

  <div class="max-w-2xl">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

      <form action="{{ route('admin.package.gallery.update', $gallery->id) }}"
            method="POST"
            enctype="multipart/form-data">
        @csrf

        {{-- Current Image --}}
        <div class="mb-5">
          <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
            Current Image
          </label>
          <img id="currentImg"
               src="{{ asset('admin-assets/home/package-gallery/' . $gallery->image) }}"
               class="w-full max-w-sm h-56 object-cover rounded-2xl border border-gray-100">
        </div>

        {{-- Upload New --}}
        <div class="mb-5">
          <label for="newImage"
            class="block cursor-pointer border-2 border-dashed border-gray-200 hover:border-blue-400 hover:bg-blue-50/30 rounded-2xl p-5 text-center transition-all">
            <div class="text-sm font-semibold text-gray-700">📤 Click to replace image</div>
            <div class="text-xs text-gray-400 mt-1">Leave empty to keep current · Max 2MB</div>
          </label>
          <input type="file" id="newImage" name="image" accept="image/*" class="hidden"
                 onchange="previewNew(event)">
        </div>

        {{-- Caption --}}
        <div class="mb-5">
          <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">
            Caption <span class="text-gray-300 normal-case font-normal">(Optional)</span>
          </label>
          <input type="text" name="caption" value="{{ old('caption', $gallery->caption) }}"
            placeholder="e.g. Hotel pool view, Bedroom, Reception..."
            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400">
        </div>

        <div class="flex gap-3">
          <button type="submit"
            class="bg-green-600 hover:bg-green-700 text-white text-sm font-bold py-2.5 px-6 rounded-xl">
            ✅ Update Image
          </button>
          <a href="{{ route('admin.package.gallery.create', $gallery->package_id) }}"
            class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-bold py-2.5 px-6 rounded-xl">
            Cancel
          </a>
        </div>

      </form>

    </div>
  </div>
</div>

<script>
function previewNew(e) {
  const file = e.target.files[0];
  if (!file) return;
  const reader = new FileReader();
  reader.onload = (ev) => {
    document.getElementById('currentImg').src = ev.target.result;
  };
  reader.readAsDataURL(file);
}
</script>
@endsection