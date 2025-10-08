<!-- resources/views/moods/partial/edit.blade.php -->
<div class="mood-picker container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-2">EDIT YOUR MOOD</h2>
    <p class="text-purple-600 mb-6 flex items-center">
        <span class="mr-2">📅</span> {{ $mood->created_at->format('d M, H:i') }}
    </p>

    <form action="{{ route('moods.update', $mood->id) }}" method="POST" id="mood-form">
        @csrf
        @method('PUT')
        <div class="flex justify-around mb-8">
            <label class="cursor-pointer">
                <input type="radio" name="feeling" value="happy" class="hidden" {{ $mood->feeling == 'happy' ? 'checked' : '' }} required>
                <div class="text-center {{ $mood->feeling == 'happy' ? 'border-2 border-purple-600' : '' }}">
                    <span class="text-6xl block" style="color: orange;">😁</span>
                    <p class="text-gray-600">happy</p>
                </div>
            </label>
            <label class="cursor-pointer">
                <input type="radio" name="feeling" value="calm" class="hidden" {{ $mood->feeling == 'calm' ? 'checked' : '' }} required>
                <div class="text-center {{ $mood->feeling == 'calm' ? 'border-2 border-purple-600' : '' }}">
                    <span class="text-6xl block" style="color: green;">😊</span>
                    <p class="text-gray-600">calm</p>
                </div>
            </label>
            <label class="cursor-pointer">
                <input type="radio" name="feeling" value="excited" class="hidden" {{ $mood->feeling == 'excited' ? 'checked' : '' }} required>
                <div class="text-center {{ $mood->feeling == 'excited' ? 'border-2 border-purple-600' : '' }}">
                    <span class="text-6xl block" style="color: purple;">😐</span>
                    <p class="text-gray-600">excited</p>
                </div>
            </label>
            <label class="cursor-pointer">
                <input type="radio" name="feeling" value="anxious" class="hidden" {{ $mood->feeling == 'anxious' ? 'checked' : '' }} required>
                <div class="text-center {{ $mood->feeling == 'anxious' ? 'border-2 border-purple-600' : '' }}">
                    <span class="text-6xl block" style="color: blue;">☹️</span>
                    <p class="text-gray-600">anxious</p>
                </div>
            </label>
            <label class="cursor-pointer">
                <input type="radio" name="feeling" value="sad" class="hidden" {{ $mood->feeling == 'sad' ? 'checked' : '' }} required>
                <div class="text-center {{ $mood->feeling == 'sad' ? 'border-2 border-purple-600' : '' }}">
                    <span class="text-6xl block" style="color: gray;">😞</span>
                    <p class="text-gray-600">sad</p>
                </div>
            </label>
        </div>

        <div class="form-group mb-4">
            <label for="note" class="text-gray-700">Note (optional)</label>
            <textarea name="note" id="note" class="form-control w-full p-2 border rounded">{{ $mood->note }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-purple-600 text-white rounded-full p-4 mr-2">
                ➡️
            </button>
            <span class="text-purple-600 self-center">UPDATE MOOD</span>
        </div>
    </form>

    <a href="#" class="ajax-link text-purple-600 underline mt-4 block" data-url="/moods/partial/index">Cancel</a>
</div>

<script>
    // Highlight selected emoji
    document.querySelectorAll('input[name="feeling"]').forEach(input => {
        input.addEventListener('change', () => {
            document.querySelectorAll('.mood-picker label div').forEach(div => div.classList.remove('border-2', 'border-purple-600'));
            input.nextElementSibling.classList.add('border-2', 'border-purple-600');
        });
    });

    // AJAX submit and refresh index
    <script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('mood-form');

    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault(); // ✅ stop full reload

            const formData = new FormData(form);

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });

                if (response.ok) {
                    const contentArea = document.getElementById('content-area');
                    const indexResponse = await fetch('/moods/partial/index');
                    contentArea.innerHTML = await indexResponse.text();
                } else {
                    console.error('Failed to submit mood:', response.statusText);
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });
    }
});
</script>

</script>