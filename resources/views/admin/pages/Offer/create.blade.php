@extends('admin.layout.master')

@section('content')

<div class="flex justify-between items-center mb-8">
    <h2 class="text-4xl font-bold text-slate-800">Add Offer</h2>

    <a href="{{ route('admin.offer.index') }}"
        class="bg-slate-600 hover:bg-slate-700 text-white px-5 py-3 rounded-2xl">
        Back
    </a>
</div>

<div class="bg-white rounded-3xl shadow-lg p-6">
    <form action="{{ route('admin.offer.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-5">
            <label class="block font-semibold mb-2">Offer Image</label>
            <input type="file" name="image" class="w-full border rounded-2xl px-4 py-3" required>
        </div>
        <div class="mb-5">
            <label class="block font-semibold mb-2">Redirect URL (Optional)</label>
            <input type="url" name="url"
                class="w-full border rounded-2xl px-4 py-3"
                value="{{ old('url') }}"
                placeholder="https://example.com">
        </div>
        <button type="submit"
            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-2xl">
            Save Offer
        </button>
    </form>
</div>

@endsection