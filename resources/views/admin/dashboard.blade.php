@extends('layouts.app')

@section('content')
    <h1>MindBloom Admin Dashboard</h1>
    <p>Welcome, {{ Auth::user()->name }}!</p>
@endsection