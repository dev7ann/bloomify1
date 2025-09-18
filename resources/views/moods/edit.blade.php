@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Mood</h2>

    <form action="{{ route('moods.update', $mood) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="mood">Mood</label>
            <input type="text" name="mood" id="mood" class="form-control" value="{{ old('mood', $mood->mood) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="note">Note (optional)</label>
            <textarea name="note" id="note" class="form-control">{{ old('note', $mood->note) }}</textarea>
        </div>

        <button class="btn btn-primary">Update Mood</button>
        <a href="{{ route('moods.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
