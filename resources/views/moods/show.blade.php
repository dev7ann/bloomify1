@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mood Details</h2>

    <div class="card mb-3">
        <div class="card-body">
            <h4 class="card-title">{{ $mood->mood }}</h4>
            <p class="card-text">{{ $mood->note ?? 'No additional notes.' }}</p>
            <small class="text-muted">Logged: {{ $mood->created_at->toDayDateTimeString() }}</small>
        </div>
    </div>

    <a href="{{ route('moods.edit', $mood) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('moods.destroy', $mood) }}" method="POST" style="display:inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">Delete</button>
    </form>
    <a href="{{ route('moods.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
