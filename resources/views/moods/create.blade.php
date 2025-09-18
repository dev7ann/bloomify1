@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Log a Mood</h2>

    <form action="{{ route('moods.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="mood">Mood</label>
            <input type="text" name="mood" id="mood" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="note">Note (optional)</label>
            <textarea name="note" id="note" class="form-control"></textarea>
        </div>

        <button class="btn btn-success">Save Mood</button>
    </form>
</div>
@endsection
