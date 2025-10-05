<!-- resources/views/moods/partial/create.blade.php -->
<div class="mood-picker container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-2">HOW ARE YOU?</h2>
    <p class="text-purple-600 mb-6 flex items-center">
        <span class="mr-2">📅</span> Today, {{ now()->format('d M, H:i') }}
    </p>

    <form action="{{ route('moods.store') }}" method="POST" id="mood-form">
        @csrf
        <div class="flex justify-around mb-8">
            @foreach (['rad' => '😁', 'good' => '😊', 'meh' => '😐', 'bad' => '☹️', 'awful' => '😞'] as $value => $emoji)
                <label class="cursor-pointer">
                    <input type="radio" name="feeling" value="{{ $value }}" class="hidden" required>
                    <div class="text-center">
                        <span class="text-6xl block">{{ $emoji }}</span>
                        <p class="text-gray-600">{{ $value }}</p>
                    </div>
                </label>
            @endforeach
        </div>

        <div class="form-group mb-4">
            <label for="note" class="text-gray-700">Note (optional)</label>
            <textarea name="note" id="note" class="form-control w-full p-2 border rounded"></textarea>
        </div>

        <div class="flex justify-end items-center space-x-2">
            <button type="submit" class="bg-purple-600 text-white rounded-full p-4">
                ➡️
            </button>
            <span class="text-purple-600 font-semibold">LOG MOOD</span>
        </div>
    </form>
</div>

<script>
    // Highlight selected emoji
    document.querySelectorAll('input[name="feeling"]').forEach(input => {
        input.addEventListener('change', () => {
            document.querySelectorAll('.mood-picker label div').forEach(div => 
                div.classList.remove('border-2', 'border-purple-600')
            );
            input.nextElementSibling.classList.add('border-2', 'border-purple-600');
        });
    });

    // AJAX submit and refresh index dynamically
    document.getElementById('mood-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);

        try {
            const response = await fetch(e.target.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                }
            });

            if (response.ok) {
                const html = await response.text();
                document.getElementById('content-area').innerHTML = html;
            } else {
                console.error('Failed to log mood:', response.status);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });
</script>
