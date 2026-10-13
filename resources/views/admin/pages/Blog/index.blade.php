@extends('admin.layout.master')

@section('content')

<div class="flex justify-between items-center mb-8">
    <h2 class="text-3xl font-bold">Blog Management</h2>

    <a href="{{ route('admin.blog.create') }}"
        class="bg-blue-600 text-white px-5 py-3 rounded-2xl">
        + Add Blog
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    @foreach($blogs as $blog)

    <div class="bg-white rounded-3xl shadow p-4">

        <img src="{{ asset('admin-assets/home/Blog/'.$blog->image) }}"
            class="w-full h-56 object-cover rounded-2xl">

        <p class="text-sm text-gray-500 mt-3">
            {{ \Carbon\Carbon::parse($blog->date)->format('d F, Y') }}
        </p>

        <h3 class="text-xl font-bold mt-2">
            {{ $blog->title }}
        </h3>

        <p class="text-gray-500 mt-2">
            {{ Str::limit($blog->short_description, 80) }}
        </p>

        <div class="flex gap-3 mt-4">
            <a href="{{ route('admin.blog.edit', $blog->id) }}"
                class="bg-yellow-500 text-white px-4 py-2 rounded-xl">
                Edit
            </a>
            <a href="{{ route('admin.blog.show', $blog->id) }}"
                class="bg-green-500 text-white px-4 py-2 rounded-xl">
                View
            </a>
            <form action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <button class="bg-red-500 text-white px-4 py-2 rounded-xl">
                    Delete
                </button>
            </form>
        </div>

    </div>

    @endforeach

</div>

@endsection