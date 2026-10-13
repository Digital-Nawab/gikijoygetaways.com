@extends('admin.layout.master')

@section('content')

<div class="bg-white rounded-3xl shadow-lg p-6">
    <form action="{{ route('admin.destination.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-5">
            <label class="block font-semibold mb-2">Title</label>
            <input type="text" name="title" class="w-full border rounded-2xl px-4 py-3" required>
        </div>

        <div class="mb-5">
            <label class="block font-semibold mb-2">Country</label>
            <input type="text" name="country" class="w-full border rounded-2xl px-4 py-3">
        </div>

        <div class="mb-5">
            <label class="block font-semibold mb-2">Tour Count</label>
            <input type="text" name="tour_count" class="w-full border rounded-2xl px-4 py-3" required>
        </div>

        <div class="mb-5">
            <label class="block font-semibold mb-2">Image</label>
            <input type="file" name="image" class="w-full border rounded-2xl px-4 py-3" required>
        </div>

        <button type="submit"
            class="bg-green-600 text-white px-6 py-3 rounded-2xl">
            Save Destination
        </button>
    </form>
</div>

@endsection