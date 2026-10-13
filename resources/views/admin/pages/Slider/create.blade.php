@extends('admin.layout.master')

@section('content')

<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-4xl font-bold text-slate-800">Add Slider</h2>
        <p class="text-slate-500 mt-2">Create new homepage slider</p>
    </div>

    <a href="{{ route('admin.slider.index') }}"
        class="bg-slate-600 hover:bg-slate-700 text-white px-5 py-3 rounded-2xl shadow-lg transition">
        Back
    </a>
</div>

@if ($errors->any())
<div class="bg-red-100 text-red-600 p-4 rounded-2xl mb-6">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="bg-white rounded-3xl shadow-lg p-6">
    <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-5">
            <label class="block font-semibold mb-2">Heading</label>
            <input type="text" name="heading" class="w-full border rounded-2xl px-4 py-3" required>
        </div>

        <div class="mb-5">
            <label class="block font-semibold mb-2">Sub Heading</label>
            <textarea name="subheading" class="w-full border rounded-2xl px-4 py-3"></textarea>
        </div>

        <div class="mb-5">
            <label class="block font-semibold mb-2">Slider Image</label>
            <input type="file" name="image" class="w-full border rounded-2xl px-4 py-3" >
        </div>
        <div class="mb-5">
            <label class="block font-semibold mb-2">Slider Video</label>
            <input type="file" name="video" class="w-full border rounded-2xl px-4 py-3">
        </div>
        <button type="submit"
            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-2xl shadow-lg transition">
            Save Slider
        </button>
    </form>
</div>

@endsection