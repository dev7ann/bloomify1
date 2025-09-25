<!-- resources/views/moods/partial/index.blade.php -->
<div class="mood-tracker bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-purple-800 mb-4">My Moods</h2>

    <button class="ajax-link bg-purple-600 text-white px-4 py-2 rounded-md mb-4" data-url="/moods/partial/create">
        Log New Mood
    </button>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($moods->isEmpty())
        <p class="text-gray-600">No moods logged yet. Start by adding your first mood 🌸</p>
    @else
        @foreach ($moods as $mood)
            <div class="mood-entry bg-white border border-gray-200 p-4 rounded-md mb-4 shadow-sm">
                <p class="font-semibold text-gray-800">
                    {!! $this->getMoodEmoji($mood->feeling) !!} {{ $mood->feeling }} - {{ $mood->note ?? 'No note' }}
                </p>
                <p class="text-sm text-gray-500">{{ $mood->created_at->format('M d, Y, h:i A') }}</p>

                <div class="mt-2">
                    <a href="#" class="ajax-link bg-yellow-400 text-black px-3 py-1 rounded-md mr-2" data-url="/moods/partial/edit/{{ $mood->id }}">
                        Edit
                    </a>
                    <form method="POST" action="{{ route('moods.destroy', $mood->id) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this mood?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded-md">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
</div>

@php
    // Helper function to get emoji with color styling
    private function getMoodEmoji($feeling) {
        $emojis = [
            'rad' => '<span class="text-2xl" style="color: orange;">😁</span>',
            'good' => '<span class="text-2xl" style="color: green;">😊</span>',
            'meh' => '<span class="text-2xl" style="color: purple;">😐</span>',
            'bad' => '<span class="text-2xl" style="color: blue;">☹️</span>',
            'awful' => '<span class="text-2xl" style="color: gray;">😞</span>',
        ];
        return $emojis[$feeling] ?? '<span class="text-2xl">😶</span>';
    }
@endphp

<script>
    // Assuming you have global AJAX handler, but adding for delete refresh
    document.querySelectorAll('form[method="POST"]').forEach(form => {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                if (response.ok) {
                    // Refresh index partial
                    const contentArea = document.getElementById('content-area');
                    const indexResponse = await fetch('/moods/partial/index');
                    contentArea.innerHTML = await indexResponse.text();
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });
    });
</script>