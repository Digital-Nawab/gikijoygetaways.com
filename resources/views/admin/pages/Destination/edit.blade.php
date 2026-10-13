
@extends('admin.layout.master')

@section('content')

<div class="bg-white rounded-3xl shadow-lg p-6">
    <form action="{{ route('admin.destination.update', $destination->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-5">
            <label class="block font-semibold mb-2">Title</label>
            <input type="text" name="title" value="{{ $destination->title }}" class="w-full border rounded-2xl px-4 py-3" required>
        </div>

        <div class="mb-5">
            <label class="block font-semibold mb-2">Country</label>
            <input type="text" name="country" value="{{ $destination->country }}" class="w-full border rounded-2xl px-4 py-3" required>
        </div>

        <div class="mb-5">
            <label class="block font-semibold mb-2">Tour Count</label>
            <input type="text" name="tour_count" value="{{ $destination->tour_count }}" class="w-full border rounded-2xl px-4 py-3" required>
        </div>

        <div class="mb-5">
            <label class="block font-semibold mb-2">Current Image</label>
            <img src="{{ asset('admin-assets/destination/' . $destination->image) }}" class="w-40 rounded-2xl mb-3">
        </div>

        <div class="mb-5">
            <label class="block font-semibold mb-2">New Image</label>
            <input type="file" name="image" class="w-full border rounded-2xl px-4 py-3">
        </div>

        <button type="submit"
            class="bg-green-600 text-white px-6 py-3 rounded-2xl">
            Update Destination
        </button>
    </form>
</div>

@endsection