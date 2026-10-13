@extends('admin.layout.master')

@section('content')

<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-4xl font-bold text-slate-800">Offer Management</h2>
    </div>

    <a href="{{ route('admin.offer.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-2xl">
        + Add Offer
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 text-green-700 px-4 py-3 rounded-2xl mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-3xl shadow-lg p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($offers as $offer)
            <div class="border rounded-3xl overflow-hidden shadow">
                <img src="{{ asset('admin-assets/home/offer/' . $offer->image) }}"
                     class="w-full rounded-t-3xl">

                <div class="p-5 flex gap-3">
                    <a href="{{ route('admin.offer.edit', $offer->id) }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-xl">
                        Edit
                    </a>

                    <a href="{{ route('admin.offer.delete', $offer->id) }}"
                       onclick="return confirm('Are you sure you want to delete this offer?')"
                       class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl">
                        Delete
                    </a>
                </div>
            </div>
        @empty
            <div class="text-slate-500">No offers found</div>
        @endforelse
    </div>
</div>

@endsection