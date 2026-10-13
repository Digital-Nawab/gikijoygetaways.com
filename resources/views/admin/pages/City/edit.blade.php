@extends('admin.layout.master')

@section('content')

<div class="bg-white rounded-3xl shadow-lg p-6">

    <form action="{{ route('admin.city.update', $city->id) }}" method="POST">
        @csrf

        {{-- State --}}
        <div class="mb-5">
            <label class="block font-semibold mb-2">Select State</label>
            <select name="state_id" class="w-full border rounded-2xl px-4 py-3">

                @foreach($states as $state)
                    <option value="{{ $state->id }}"
                        {{ $city->state_id == $state->id ? 'selected' : '' }}>
                        {{ $state->name }} ({{ $state->country->name }})
                    </option>
                @endforeach

            </select>
        </div>

        {{-- City --}}
        <div class="mb-5">
            <label class="block font-semibold mb-2">City Name</label>
            <input type="text" name="name"
                value="{{ $city->name }}"
                class="w-full border rounded-2xl px-4 py-3">
        </div>

        <button type="submit"
            class="bg-blue-600 text-white px-6 py-3 rounded-2xl">
            Update City
        </button>

    </form>

</div>

@endsection