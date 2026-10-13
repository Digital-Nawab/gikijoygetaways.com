@extends('admin.layout.master')

@section('content')

<div class="flex justify-between items-center mb-8">
    <h2 class="text-4xl font-bold text-slate-800">Destination Management</h2>

    <a href="{{ route('admin.destination.create') }}"
       class="bg-blue-600 text-white px-5 py-3 rounded-2xl">
        + Add Destination
    </a>
</div>

<div class="bg-white rounded-3xl shadow-lg p-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($destinations as $destination)
            <div class="border rounded-3xl overflow-hidden shadow">
                <img src="{{ asset('admin-assets/home/destinations/' . $destination->image) }}"
                     class="w-full h-72 object-cover">

                <div class="p-4 text-center">
                    <h3 class="text-2xl font-bold">
                        {{ $destination->title }}
                    </h3>

                    <p class="text-slate-500 mt-2">
                        {{ $destination->country }}
                    </p>

                    <p class="text-slate-500">
                        Tours ({{ $destination->tour_count }})
                    </p>

                    <div class="flex justify-center gap-3 mt-4">
                        <a href="{{ route('admin.destination.edit', $destination->id) }}"
                           class="bg-yellow-500 text-white px-4 py-2 rounded-xl">
                            Edit
                        </a>

                        <a href="{{ route('admin.destination.delete', $destination->id) }}"
                           onclick="return confirm('Are you sure?')"
                           class="bg-red-500 text-white px-4 py-2 rounded-xl">
                            Delete
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection