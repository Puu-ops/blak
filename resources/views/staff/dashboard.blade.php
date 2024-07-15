<!-- resources/views/staff/dashboard.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2">Title</th>
                                <th class="py-2">Author</th>
                                <th class="py-2">Description</th>
                                <th class="py-2">Image</th>
                                <th class="py-2">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <td class="border px-4 py-2">{{ Str::limit($book->title, 50) }}</td>
                                    <td class="border px-4 py-2">{{ $book->author }}</td>
                                    <td class="border px-4 py-2">{{ Str::limit($book->description, 50) }}</td>
                                    <td class="border px-4 py-2">
                                        @if ($book->cover_image)
                                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Book Cover" class="table-img">
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td>
                                    <td class="border px-4 py-2">{{ $book->created_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    /* Custom styles for this page */
    .table-img {
        width: 100px; /* Adjust as needed */
        height: auto;
    }
</style>
