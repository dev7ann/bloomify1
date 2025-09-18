@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4">My Journal Entries 📔</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @forelse ($journals as $journal)
        <div class="mb-4 border-b pb-4">
            <h3 class="text-xl font-semibold">{{ $journal->title }}</h3>
            <p class="text-gray-600 text-sm">Written on {{ $journal->created_at->format('M d, Y') }}</p>
            <p class="mt-2">{{ Str::limit($journal->content, 150) }}</p>
        </div>
    @empty
        <p class="text-gray-600">No journal entries yet. Start writing one!</p>
    @endforelse
</div>
@endsection
