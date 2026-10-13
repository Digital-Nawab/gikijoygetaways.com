@extends('admin.layout.master')

@section('content')

<h2 class="text-3xl font-bold mb-6">Add Tourist Place</h2>

<form action="{{ route('admin.tourist.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="bg-white p-6 rounded-3xl shadow-lg">

        {{-- Name --}}
        <div class="mb-4">
            <label class="block mb-1 font-medium">Place Name</label>
            <input type="text" name="name" class="w-full border p-3 rounded-xl" required>
        </div>

        {{-- Location --}}
        <div class="mb-4">
            <label class="block mb-1 font-medium">Location</label>
            <input type="text" name="location" class="w-full border p-3 rounded-xl">
        </div>

        {{-- Image --}}
        <div class="mb-4">
            <label class="block mb-1 font-medium">Image</label>
            <input type="file" name="image" class="w-full border p-3 rounded-xl" required>
        </div>

        <button class="bg-blue-600 text-white px-6 py-3 rounded-xl">
            Save
        </button>

    </div>
</form>

@endsection