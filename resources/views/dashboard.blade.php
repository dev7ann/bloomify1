<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Bloomify</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href={{ asset('assets/favicon-32x32.png') }}>
    <link rel="icon" type="image/png" sizes="16x16" href={{ asset('assets/favicon-16x16.png') }}>1
    <link rel="manifest" href="/site.webmanifest">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-purple-700 text-white flex flex-col">
        <div class="logo">
            <img src="{{ asset('assets/bloomify-logo.png') }}" alt="Bloomify Logo" class="h-10">
            <span class="sr-only">Bloomify</span>
        </div>
        <nav class="flex-1 p-4 space-y-4">
            <a href="{{ route('moods.index') }}" class="block px-4 py-2 rounded hover:bg-purple-600">Mood Tracker</a>
            <a href="{{ route('journals.index') }}" class="block px-4 py-2 rounded hover:bg-purple-600">Journal</a>
            <a href="{{ route('wellness.index') }}" class="block px-4 py-2 rounded hover:bg-purple-600">Wellness Tips</a>
            <a href="{{ route('support.index') }}" class="block px-4 py-2 rounded hover:bg-purple-600">Support</a>
        </nav>
        <div class="p-4 border-t border-purple-500">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full px-4 py-2 bg-red-500 hover:bg-red-600 rounded">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main content -->
    <div class="flex-1 p-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">
            Welcome, {{ Auth::user()->name }} 👋
        </h1>
        <p class="text-gray-600">
            This is your personalized dashboard. Use the sidebar to navigate to different features.
        </p>

        <div class="mt-6 p-6 bg-white shadow rounded-lg">
            <h2 class="text-xl font-semibold text-purple-700 mb-2">Quick Overview</h2>
            <p class="text-gray-700">Track your moods, write journals, read wellness tips, or reach out for support.</p>
        </div>
    </div>
</div>

</body>
</html>
