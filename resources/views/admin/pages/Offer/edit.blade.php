@extends('admin.layout.master')

@section('content')

<div class="flex justify-between items-center mb-8">
    <h2 class="text-4xl font-bold text-slate-800">Edit Offer</h2>

    <a href="{{ route('admin.offer.index') }}"
        class="bg-slate-600 hover:bg-slate-700 text-white px-5 py-3 rounded-2xl">
        Back
    </a>
</div>

<div class="bg-white rounded-3xl shadow-lg p-6">
    <form action="{{ route('admin.offer.update', $offer->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-5">
            <label class="block font-semibold mb-2">Current Image</label>
            <img src="{{ asset('admin-assets/home/offer/' . $offer->image) }}"
                class="w-72 rounded-2xl mb-4">
        </div>

        <div class="mb-5">
            <label class="block font-semibold mb-2">New Image</label>
            <input type="file" name="image" class="w-full border rounded-2xl px-4 py-3">
        </div>
        <div class="mb-5">
            <label class="block font-semibold mb-2">Redirect URL (Optional)</label>
            <input type="url" name="url"
                class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-green-400 focus:outline-none transition duration-200"
                value="{{ old('url', $offer->url) }}"
                placeholder="https://example.com">
            @error('url')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit"
            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-2xl">
            Update Offer
        </button>
    </form>
</div>

@endsection