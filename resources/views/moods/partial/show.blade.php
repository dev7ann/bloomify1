<!-- resources/views/moods/partial/show.blade.php -->
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-purple-800 mb-4">Mood Details</h2>

    <div class="card bg-white border border-gray-200 p-4 rounded-md shadow-sm">
        <div class="card-body">
            <h4 class="text-xl font-semibold text-gray-800 mb-2">
                {!! $this->getMoodEmoji($mood->feeling) !!} {{ $mood->feeling }}
            </h4>
            <p class="text-gray-600 mb-2">{{ $mood->note ?: 'No additional notes.' }}</p>
            <small class="text-gray-500">Logged: {{ $mood->created_at->format('D, M d, Y, h:i A') }}</small>
        </div>
    </div>

    <div class="mt-4">
        <a href="#" class="ajax-link bg-yellow-400 text-black px-4 py-2 rounded-md mr-2" data-url="/moods/partial/edit/{{ $mood->id }}">
            Edit
        </a>
        <form action="{{ route('moods.destroy', $mood->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
            @csrf
            @method('DELETE')
            <button class="bg-red-600 text-white px-4 py-2 rounded-md">Delete</button>
        </form>
        <a href="#" class="ajax-link bg-gray-200 text-gray-800 px-4 py-2 rounded-md ml-2" data-url="/moods/partial/index">
            Back
        </a>
    </div>
</div>

@php
    // Same helper as in index
    private function getMoodEmoji($feeling) {
        $emojis = [
           'happy' => '<span class="text-2xl" style="color: orange;">😁</span>',
            'calm' => '<span class="text-2xl" style="color: green;">😊</span>',
            'excited' => '<span class="text-2xl" style="color: purple;">🤩</span>',
            'anxious' => '<span class="text-2xl" style="color: blue;">😟</span>',
            'sad' => '<span class="text-2xl" style="color: gray;">😞</span>',

        ];
        return $emojis[$feeling] ?? '<span class="text-2xl">😶</span>';
    }
@endphp

<script>
    // AJAX for buttons, similar to others
    document.querySelectorAll('.ajax-link').forEach(link => {
        link.addEventListener('click', async (e) => {
            e.preventDefault();
            const url = link.getAttribute('data-url');
            const contentArea = document.getElementById('content-area');
            try {
                const response = await fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                if (response.ok) {
                    contentArea.innerHTML = await response.text();
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });
    });

    // For delete
    document.querySelector('form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        try {
            const response = await fetch(e.target.action, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            if (response.ok) {
                const contentArea = document.getElementById('content-area');
                const indexResponse = await fetch('/moods/partial/index');
                contentArea.innerHTML = await indexResponse.text();
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });
</script>