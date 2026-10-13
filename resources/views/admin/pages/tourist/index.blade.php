@extends('admin.layout.master')

@section('content')

<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-4xl font-bold text-slate-800">Tourist Places</h2>
        <p class="text-slate-500 mt-2">Manage tourist places</p>
    </div>

    <a href="{{ route('admin.tourist.create') }}"
        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-2xl shadow-lg">
        + Add Place
    </a>
</div>

@if(session('success'))
<div class="bg-green-100 text-green-700 px-4 py-3 rounded-2xl mb-6">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-3xl shadow-lg p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse($places as $place)
        <div class="border rounded-3xl overflow-hidden shadow hover:shadow-xl transition">

            {{-- Image --}}
            <img src="{{ asset('admin-assets/home/tourist/' . $place->image) }}"
                class="w-full h-60 object-cover">

            <div class="p-5">

                {{-- Name --}}
                <h3 class="text-xl font-bold text-slate-800">
                    {{ $place->name }}
                </h3>

                {{-- Location --}}
                <p class="text-slate-500 text-sm mt-1">
                    📍 {{ $place->location }}
                </p>

                {{-- Actions --}}
                <div class="flex gap-3 mt-4">
                    <a href="{{ route('admin.tourist.edit', $place->id) }}"
                        class="bg-yellow-500 text-white px-4 py-2 rounded-xl">
                        Edit
                    </a>

                    <form action="{{ route('admin.tourist.destroy', $place->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button class="bg-red-500 text-white px-4 py-2 rounded-xl">
                            Delete
                        </button>
                    </form>
                </div>

            </div>
        </div>
        @empty
        <div class="col-span-3 text-center text-slate-500 py-10">
            No Data Found
        </div>
        @endforelse

    </div>
</div>

@endsection