<div class="mood-picker container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-2">How are you?</h2>
    <p class="text-purple-600 mb-6 flex items-center">
        <span class="mr-2">📅</span> Today, {{ now()->format('d M, H:i') }}
    </p>

    <form action="{{ route('moods.store') }}" method="POST" id="mood-form">
        @csrf
        <div class="flex justify-around mb-8">
          @foreach (['happy' => '😁', 'calm' => '😊', 'excited' => '😐', 'anxious' => '☹️', 'sad' => '😞'] as $value => $emoji)
                <label class="cursor-pointer">
                    <input type="radio" name="feeling" value="{{ $value }}" class="hidden" required>
                    <div class="text-center hover:scale-110 transition-transform">
                        <span class="text-6xl block">{{ $emoji }}</span>
                        <p class="text-gray-600 capitalize">{{ $value }}</p>
                    </div>
                </label>
            @endforeach
        </div>

        <div class="form-group mb-4">
            <label for="note" class="text-gray-700">Note (optional)</label>
            <textarea name="note" id="note" class="form-control w-full p-2 border rounded"></textarea>
        </div>

        <div class="flex justify-end items-center space-x-2">
            <button type="submit" class="bg-purple-600 text-white rounded-full px-5 py-3">Log Mood</button>
        </div>
    </form>
</div>

{{-- <script>
function initMoodForm() {
    const form = document.querySelector('#mood-form');
    if (!form) return;

    const contentArea = document.getElementById('content-area');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        const response = await fetch(form.action, {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            body: formData
        });
        if (response.ok) {
            contentArea.innerHTML = await response.text();
        }
    });
}

initMoodForm();
</script> --}}
