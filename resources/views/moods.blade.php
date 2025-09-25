<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloomify - My Moods</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .mood-entry:hover { background-color: #f9fafb; }
        .form-section { display: none; }
        .selected-emoji { border: 2px solid #9b59b6; border-radius: 50%; }
    </style>
</head>
<body class="bg-gray-100 font-sans">
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-purple-800 mb-6">My Moods</h1>

    <!-- Flash message -->
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    <!-- Mood Form -->
    <div id="mood-form-section" class="form-section bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 id="form-title" class="text-2xl font-bold text-gray-800 mb-2">Log Mood</h2>
        <p class="text-purple-600 mb-6 flex items-center">
            <span class="mr-2">📅</span> {{ now()->format('d M, H:i') }}
        </p>

        <form method="POST" id="mood-form" action="{{ route('moods.store') }}">
            @csrf
            <input type="hidden" id="form-method" name="_method" value="POST">

            <!-- Emoji Picker -->
            <div class="mood-picker flex justify-around mb-8">
                @foreach(['rad' => '😁','good' => '😊','meh' => '😐','bad' => '☹️','awful' => '😞'] as $feeling => $emoji)
                    <label class="cursor-pointer text-center">
                        <input type="radio" name="feeling" value="{{ $feeling }}" class="hidden" required>
                        <div class="p-2">
                            <span class="text-6xl block">{{ $emoji }}</span>
                            <p class="text-gray-600">{{ $feeling }}</p>
                        </div>
                    </label>
                @endforeach
            </div>

            <div class="mb-4">
                <label for="note" class="text-gray-700">Note (optional)</label>
                <textarea name="note" id="note" class="w-full p-2 border rounded"></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-purple-600 text-white rounded-full p-4 mr-2">➡️</button>
                <span id="form-action-label" class="text-purple-600 self-center">LOG MOOD</span>
                <button type="button" id="cancel-form" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md ml-4">Cancel</button>
            </div>
        </form>
    </div>

    <!-- Mood List -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <button id="new-mood-btn" class="bg-purple-600 text-white px-4 py-2 rounded-md mb-4">Log New Mood</button>

        @if ($moods->isEmpty())
            <p class="text-gray-600">No moods logged yet 🌸</p>
        @else
            @foreach ($moods as $mood)
                <div class="mood-entry border border-gray-200 p-4 rounded-md mb-4 shadow-sm">
                    <p class="font-semibold text-gray-800">
                        {{ ['rad'=>'😁','good'=>'😊','meh'=>'😐','bad'=>'☹️','awful'=>'😞'][$mood->feeling] ?? '😶' }}
                        {{ $mood->feeling }} - {{ $mood->note ?? 'No note' }}
                    </p>
                    <p class="text-sm text-gray-500">{{ $mood->created_at->format('M d, Y, h:i A') }}</p>
                    <div class="mt-2">
                        <button class="edit-mood bg-blue-500 text-white px-3 py-1 rounded-md mr-2"
                                data-id="{{ $mood->id }}"
                                data-feeling="{{ $mood->feeling }}"
                                data-note="{{ $mood->note }}">
                            Edit
                        </button>
                        <button class="show-details bg-yellow-400 text-black px-3 py-1 rounded-md mr-2"
                                data-feeling="{{ $mood->feeling }}"
                                data-note="{{ $mood->note }}"
                                data-date="{{ $mood->created_at }}">
                            Details
                        </button>
                        <form method="POST" action="{{ route('moods.destroy', $mood->id) }}" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded-md">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Details Modal -->
    <div id="mood-details" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h3 class="text-xl font-bold text-gray-800 mb-2">Mood Details</h3>
            <p id="detail-feeling" class="text-lg"></p>
            <p id="detail-note" class="text-gray-600 mb-2"></p>
            <p id="detail-date" class="text-sm text-gray-500"></p>
            <button id="close-details" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md mt-4">Close</button>
        </div>
    </div>
</div>

<script>
    // Show new mood form
    document.getElementById('new-mood-btn').addEventListener('click', () => {
        document.getElementById('mood-form-section').style.display = 'block';
        document.getElementById('form-title').textContent = 'Log Mood';
        document.getElementById('form-action-label').textContent = 'LOG MOOD';
        document.getElementById('mood-form').action = '{{ route('moods.store') }}';
        document.getElementById('form-method').value = 'POST';
        document.getElementById('note').value = '';
    });

    // Cancel form
    document.getElementById('cancel-form').addEventListener('click', () => {
        document.getElementById('mood-form-section').style.display = 'none';
    });

    // Edit mood
    document.querySelectorAll('.edit-mood').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('mood-form-section').style.display = 'block';
            document.getElementById('form-title').textContent = 'Edit Mood';
            document.getElementById('form-action-label').textContent = 'UPDATE MOOD';
            document.getElementById('mood-form').action = `/moods/${btn.dataset.id}`;
            document.getElementById('form-method').value = 'PUT';
            document.getElementById('note').value = btn.dataset.note || '';

            // Set feeling radio
            document.querySelectorAll('input[name="feeling"]').forEach(input => {
                input.checked = (input.value === btn.dataset.feeling);
            });
        });
    });

    // Show details
    document.querySelectorAll('.show-details').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('detail-feeling').textContent = btn.dataset.feeling;
            document.getElementById('detail-note').textContent = btn.dataset.note || 'No note';
            document.getElementById('detail-date').textContent = new Date(btn.dataset.date).toLocaleString();
            document.getElementById('mood-details').classList.remove('hidden');
        });
    });

    document.getElementById('close-details').addEventListener('click', () => {
        document.getElementById('mood-details').classList.add('hidden');
    });
</script>
</body>
</html>
