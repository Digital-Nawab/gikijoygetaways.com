@extends('admin.layout.master')

@section('content')

<div class="flex justify-between items-center mb-8">
    <h2 class="text-4xl font-bold text-slate-800">Edit Marquee</h2>

    <a href="{{ route('admin.marquee') }}"
        class="bg-slate-600 text-white px-5 py-3 rounded-2xl">
        Back
    </a>
</div>

<div class="bg-white rounded-3xl shadow-lg p-6">

<form action="{{ route('admin.marquee.update', $marquee->id) }}" method="POST">
@csrf

<div class="mb-6">
    <label class="block font-semibold mb-2">Marquee Text</label>

    <input type="text"
        name="title"
        value="{{ $marquee->title }}"
        class="w-full border rounded-2xl px-5 py-4"
        required>
</div>

<button type="submit"
    class="bg-green-600 text-white px-6 py-3 rounded-2xl">
    Update
</button>

</form>

</div>

@endsection