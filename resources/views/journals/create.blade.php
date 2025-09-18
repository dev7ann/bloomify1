@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4">Write a New Journal Entry 📖</h2>

    <form method="POST" action="{{ route('journals.store') }}">
        @csrf

        <div class="mb-4">
            <label for="title" class="block text-gray-700">Title</label>
            <input type="text" name="title" id="title" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="content" class="block text-gray-700">Content</label>
            <textarea name="content" id="content" rows="5" class="w-full p-2 border rounded" required></textarea>
        </div>

        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
            Save Journal
        </button>
    </form>
</div>
@endsection
