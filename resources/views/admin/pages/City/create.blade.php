@extends('admin.layout.master')

@section('content')

<div class="bg-white rounded-3xl shadow-lg p-6">

    <form action="{{ route('admin.city.store') }}" method="POST">
        @csrf

        {{-- State Dropdown --}}
        <div class="mb-5">
            <label class="block font-semibold mb-2">Select State</label>
            <select name="state_id" class="w-full border rounded-2xl px-4 py-3" required>
                <option value="">Select State</option>

                @foreach($states as $state)
                <option value="{{ $state->id }}">
                    {{ $state->state_name }} ({{ $state->country->name }}) {{-- name → state_name --}}
                </option>
                @endforeach
            </select>
        </div>

        {{-- City Name --}}
        <div class="mb-5">
            <label class="block font-semibold mb-2">City Name</label>
            <input type="text" name="name"
                class="w-full border rounded-2xl px-4 py-3" required>
        </div>

        <button type="submit"
            class="bg-green-600 text-white px-6 py-3 rounded-2xl">
            Save City
        </button>

    </form>

</div>

@endsection