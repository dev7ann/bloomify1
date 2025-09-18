@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Moods</h2>

    <a href="{{ route('moods.create') }}" class="btn btn-primary mb-3">Log New Mood</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul class="list-group">
        @forelse($moods as $mood)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>
                    <strong>{{ $mood->mood }}</strong> - {{ $mood->note }}
                    <br><small>{{ $mood->created_at->diffForHumans() }}</small>
                </span>
                <span>
                    <a href="{{ route('moods.edit', $mood) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('moods.destroy', $mood) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </span>
            </li>
        @empty
            <li class="list-group-item">No moods logged yet.</li>
        @endforelse
    </ul>
</div>
@endsection
