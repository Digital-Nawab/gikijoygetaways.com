@extends('admin.layout.master')

@section('content')

<div class="bg-white rounded-3xl shadow-lg p-6">

    <form action="{{ route('admin.country.update', $country->id) }}" method="POST">
        @csrf

        <div class="mb-5">
            <label class="block font-semibold mb-2">Country Name</label>
            <input type="text" name="name"
                value="{{ $country->name }}"
                class="w-full border rounded-2xl px-4 py-3" required>
        </div>

        <button type="submit"
            class="bg-blue-600 text-white px-6 py-3 rounded-2xl">
            Update Country
        </button>

    </form>

</div>

@endsection