@extends('admin.layout.master')

@section('content')

<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-4xl font-bold text-slate-800">
            Add Marquee
        </h2>
        <p class="text-slate-500 mt-2">
            Create new marquee text
        </p>
    </div>

    <a href="{{ route('admin.marquee') }}"
        class="bg-slate-600 hover:bg-slate-700 text-white px-5 py-3 rounded-2xl shadow-lg transition">
        Back
    </a>
</div>

@if ($errors->any())
    <div class="bg-red-100 text-red-600 p-4 rounded-2xl mb-6">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white rounded-3xl shadow-lg p-6">
    <form action="{{ route('admin.marquee.store') }}" method="POST">
        @csrf

        <div class="mb-6">
            <label class="block text-slate-700 font-semibold mb-2">
                Marquee Text
            </label>

            <input type="text"
                name="title"
                value="{{ old('title') }}"
                placeholder="Enter marquee text..."
                class="w-full border border-slate-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-2xl shadow-lg transition">
                Save Marquee
            </button>
        </div>
    </form>
</div>

@endsection