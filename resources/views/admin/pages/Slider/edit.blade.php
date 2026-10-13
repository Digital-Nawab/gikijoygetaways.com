@extends('admin.layout.master')

@section('content')

<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-4xl font-bold text-slate-800">Edit Slider</h2>
        <p class="text-slate-500 mt-2">Update homepage slider</p>
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

    <form action="{{ route('admin.slider.update', $slider->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
      
        {{-- Heading --}}
        <div class="mb-5">
            <label class="block font-semibold mb-2">Heading</label>
            <input type="text"
                   name="heading"
                   value="{{ old('heading', $slider->heading) }}"
                   class="w-full border rounded-2xl px-4 py-3"
                   required>
        </div>

        {{-- Sub Heading --}}
        <div class="mb-5">
            <label class="block font-semibold mb-2">Sub Heading</label>
            <textarea name="subheading"
                      class="w-full border rounded-2xl px-4 py-3"
                      rows="4">{{ old('subheading', $slider->subheading) }}</textarea>
        </div>

        {{-- Current Image --}}
        @if($slider->image)
            <div class="mb-5">
                <label class="block font-semibold mb-2">Current Image</label>
                <img src="{{ asset('admin-assets/home/slider/' . $slider->image) }}"
                     class="w-64 h-40 object-cover rounded-2xl border">
            </div>
        @endif

        {{-- Upload New Image --}}
        <div class="mb-5">
            <label class="block font-semibold mb-2">Change Slider Image</label>
            <input type="file"
                   name="image"
                   class="w-full border rounded-2xl px-4 py-3">
        </div>

        {{-- Current Video --}}
        @if($slider->video)
            <div class="mb-5">
                <label class="block font-semibold mb-2">Current Video</label>

                <video class="w-64 h-40 rounded-2xl border object-cover"
                       autoplay muted loop controls>
                    <source src="{{ asset('admin-assets/home/slider/' . $slider->video) }}"
                            type="video/mp4">
                </video>
            </div>
        @endif

        {{-- Upload New Video --}}
        <div class="mb-5">
            <label class="block font-semibold mb-2">Change Slider Video</label>
            <input type="file"
                   name="video"
                   class="w-full border rounded-2xl px-4 py-3">
        </div>

        <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-2xl shadow-lg transition">
            Update Slider
        </button>

    </form>

</div>

@endsection