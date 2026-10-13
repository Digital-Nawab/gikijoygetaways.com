@extends('admin.layout.master')

@section('content')

<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-4xl font-bold text-slate-800">
            Marquee Management
        </h2>
        <p class="text-slate-500 mt-2">
            Manage all marquee texts
        </p>
    </div>

    <a href="{{ route('admin.marquee.create') }}"
        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-2xl shadow-lg transition">
        + Add New
    </a>
</div>

{{-- Success Message --}}
@if(session('success'))
    <div class="bg-green-100 text-green-700 px-4 py-3 rounded-2xl mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-3xl shadow-lg p-6">

    <div class="space-y-4">

        @forelse($marquees as $marquee)

        <div class="border border-slate-200 rounded-2xl p-4 flex justify-between items-center">

            {{-- Title --}}
            <div>
                <h3 class="font-semibold text-slate-800 text-lg">
                    {{ $marquee->title }}
                </h3>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-3">

                {{-- Status --}}
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                    Active
                </span>

                {{-- Edit --}}
                <a href="{{ route('admin.marquee.edit', $marquee->id) }}"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-xl transition">
                    Edit
                </a>

                {{-- Delete --}}
                <form action="{{ route('admin.marquee.delete', $marquee->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this marquee?')">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl transition">
                        Delete
                    </button>
                </form>

            </div>

        </div>

        @empty

        <div class="text-center text-slate-500 py-10 text-xl">
            No marquee found
        </div>

        @endforelse

    </div>

</div>

@endsection