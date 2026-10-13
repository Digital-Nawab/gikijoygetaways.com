@extends('admin.layout.master')

@section('content')

<h2 class="text-3xl font-bold mb-6">Edit Tourist Place</h2>

<form action="{{ route('admin.tourist.update', $place->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="bg-white p-6 rounded-3xl shadow-lg">

        {{-- Name --}}
        <div class="mb-4">
            <label class="block mb-1 font-medium">Place Name</label>
            <input type="text" name="name" value="{{ $place->name }}" class="w-full border p-3 rounded-xl">
        </div>

        {{-- Location --}}
        <div class="mb-4">
            <label class="block mb-1 font-medium">Location</label>
            <input type="text" name="location" value="{{ $place->location }}" class="w-full border p-3 rounded-xl">
        </div>

        {{-- Current Image --}}
        <div class="mb-4">
            <label class="block mb-1 font-medium">Current Image</label><br>
            <img src="{{ asset('admin-assets/home/tourist/' . $place->image) }}"
                class="w-40 h-28 object-cover rounded-xl">
        </div>

        {{-- New Image --}}
        <div class="mb-4">
            <label class="block mb-1 font-medium">Change Image</label>
            <input type="file" name="image" class="w-full border p-3 rounded-xl">
        </div>

        <button class="bg-green-600 text-white px-6 py-3 rounded-xl">
            Update
        </button>

    </div>
</form>

@endsection