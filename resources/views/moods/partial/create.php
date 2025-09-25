<!-- resources/views/moods/partial/create.blade.php -->
<div class="mood-picker container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-2">HOW ARE YOU?</h2>
    <p class="text-purple-600 mb-6 flex items-center">
        <span class="mr-2">📅</span> Today, {{ now()->format('d M, H:i') }}
    </p>

    <form action="{{ route('moods.store') }}" method="POST" id="mood-form">
        @csrf
        <div class="flex justify-around mb-8">
            <label class="cursor-pointer">
                <input type="radio" name="feeling" value="rad" class="hidden" required>
                <div class="text-center">
                    <span class="text-6xl block" style="color: orange;">😁</span>
                    <p class="text-gray-600">rad</p>
                </div>
            </label>
            <label class="cursor-pointer">
                <input type="radio" name="feeling" value="good" class="hidden" required>
                <div class="text-center">
                    <span class="text-6xl block" style="color: green;">😊</span>
                    <p class="text-gray-600">good</p>
                </div>
            </label>
            <label class="cursor-pointer">
                <input type="radio" name="feeling" value="meh" class="hidden" required>
                <div class="text-center">
                    <span class="text-6xl block" style="color: purple;">😐</span>
                    <p class="text-gray-600">meh</p>
                </div>
            </label>
            <label class="cursor-pointer">
                <input type="radio" name="feeling" value="bad" class="hidden" required>
                <div class="text-center">
                    <span class="text-6xl block" style="color: blue;">☹️</span>
                    <p class="text-gray-600">bad</p>
                </div>
            </label>
            <label class="cursor-pointer">
                <input type="radio" name="feeling" value="awful" class="hidden" required>
                <div class="text-center">
                    <span class="text-6xl block" style="color: gray;">😞</span>
                    <p class="text-gray-600">awful</p>
                </div>
            </label>
        </div>

        <div class="form-group mb-4">
            <label for="note" class="text-gray-700">Note (optional)</label>
            <textarea name="note" id="note" class="form-control w-full p-2 border rounded"></textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-purple-600 text-white rounded-full p-4 mr-2">
                ➡️
            </button>
            <span class="text-purple-600 self-center">LOG MOOD</span> <!-- Adjusted label to make sense for create -->
        </div>
    </form>
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
    document.getElementById('mood-form').addEventListener('submit', async (e) => {
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