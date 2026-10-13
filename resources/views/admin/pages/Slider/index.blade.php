@extends('admin.layout.master')

@section('content')

<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-4xl font-bold text-slate-800">Slider Management</h2>
        <p class="text-slate-500 mt-2">Manage homepage slider</p>
    </div>

    <a href="{{ route('admin.slider.create') }}"
        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-2xl shadow-lg transition">
        + Add Slider
    </a>
</div>

@if(session('success'))
<div class="bg-green-100 text-green-700 px-4 py-3 rounded-2xl mb-6">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-3xl shadow-lg p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        @forelse($sliders as $slider)
        <div class="border rounded-3xl overflow-hidden shadow">

            {{-- ✅ Video first --}}
            @if($slider->video)
            <video class="w-full h-64 object-cover" autoplay muted loop>
                <source src="{{ asset('admin-assets/home/slider/' . $slider->video) }}" type="video/mp4">
            </video>

            {{-- ✅ Else Image --}}
            @elseif($slider->image)
            <img src="{{ asset('admin-assets/home/slider/' . $slider->image) }}"
                class="w-full h-64 object-cover">

            {{-- ✅ Fallback --}}
            @else
            <div class="w-full h-64 flex items-center justify-center bg-gray-100 text-gray-500">
                No Media
            </div>
            @endif

            <div class="p-5">
                <h3 class="text-2xl font-bold text-slate-800 mb-2">
                    {{ $slider->heading }}
                </h3>

                <p class="text-slate-500 mb-4">
                    {{ $slider->subheading }}
                </p>

                <div class="flex gap-3 mt-4">
                    <a href="{{ route('admin.slider.edit', $slider->id) }}"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-xl">
                        Edit
                    </a>

                    {{-- ✅ Correct Delete --}}
                    <form action="{{ route('admin.slider.destroy', $slider->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

        </div>

        @empty
        <div class="text-slate-500">No sliders found</div>
        @endforelse

    </div>
</div>

@endsection