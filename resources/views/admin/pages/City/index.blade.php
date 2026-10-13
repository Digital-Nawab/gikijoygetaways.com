@extends('admin.layout.master')

@section('content')

<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-4xl font-bold text-slate-800">City Management</h2>
        <p class="text-slate-500 mt-2">Manage all cities</p>
    </div>

    <a href="{{ route('admin.city.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-2xl shadow-lg transition">
        + Add City
    </a>
</div>

@if(session('success'))
<div class="bg-green-100 text-green-700 px-4 py-3 rounded-2xl mb-6">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-3xl shadow-lg overflow-hidden">

    <div class="overflow-x-auto">
        <table class="w-full text-left">

            {{-- Table Head --}}
            <thead class="bg-slate-100 text-slate-700">
                <tr>
                    <th class="p-4">#</th>
                    <th class="p-4">City Name</th>
                    <th class="p-4">State</th>
                    <th class="p-4">Country</th>
                    <th class="p-4 text-center">Action</th>
                </tr>
            </thead>

            {{-- Table Body --}}
            <tbody>

                @forelse($cities as $key => $city)
                <tr class="border-t hover:bg-slate-50 transition">

                    {{-- Serial --}}
                    <td class="p-4">{{ $key + 1 }}</td>

                    {{-- City --}}
                    <td class="p-4 font-semibold text-slate-800">
                        {{ $city->name }}
                    </td>

                    {{-- State --}}
                    <td class="p-4 text-indigo-600">
                        {{ $city->state->state_name ?? 'N/A' }}
                    </td>

                    {{-- Country --}}
                    <td class="p-4 text-purple-600">
                        {{ $city->state->country->name ?? 'N/A' }}
                    </td>

                    {{-- Actions --}}
                    <td class="p-4 text-center">
                        <div class="flex justify-center gap-2">

                            <a href="{{ route('admin.city.edit', $city->id) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-xl text-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.city.destroy', $city->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this city?')">
                                @csrf
                                @method('DELETE')

                                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-sm">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="5" class="text-center py-10 text-slate-500 text-lg">
                        No cities found
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>
    </div>

</div>

@endsection