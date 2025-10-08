<div class="mood-tracker bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-purple-800 mb-4">My Moods</h2>

    <button class="ajax-link bg-purple-600 text-white px-4 py-2 rounded-md mb-4"
        data-url="/moods/partial/create">
        Log New Mood
    </button>

    @if ($moods->isEmpty())
        <p class="text-gray-600">No moods logged yet. Start by adding your first mood 🌸</p>
    @else
        @foreach ($moods as $mood)
            <div class="mood-entry bg-white border border-gray-200 p-4 rounded-md mb-4 shadow-sm">
                <p class="font-semibold text-gray-800">
                    @switch($mood->feeling)
    @case('happy') <span class="text-2xl" style="color: orange;">😁</span> @break
    @case('calm') <span class="text-2xl" style="color: green;">😊</span> @break
    @case('excited') <span class="text-2xl" style="color: purple;">😐</span> @break
    @case('anxious') <span class="text-2xl" style="color: blue;">☹️</span> @break
    @case('sad') <span class="text-2xl" style="color: gray;">😞</span> @break
    @default <span class="text-2xl">😶</span>
@endswitch

                    {{ ucfirst($mood->feeling) }} — {{ $mood->note ?? 'No note' }}
                </p>
                <p class="text-sm text-gray-500">{{ $mood->created_at->format('M d, Y, h:i A') }}</p>

                <div class="mt-2">
                    <a href="#" 
                       class="ajax-link bg-yellow-400 text-black px-3 py-1 rounded-md mr-2" 
                       data-url="/moods/partial/edit/{{ $mood->id }}">
                        Edit
                    </a>
                    <form method="POST" 
                         action="{{ route('moods.destroy', $mood->id) }}" 
                         class="delete-mood-form" 
                            style="display:inline;">
                          @csrf
                             @method('DELETE')
                     <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded-md">
                        Delete
                    </button>
                    </form>



                </div>
            </div>
        @endforeach
    @endif
</div>

<script>
document.addEventListener('submit', async function(e) {
    const form = e.target.closest('.delete-mood-form');
    if (!form) return; // Ignore other forms

    e.preventDefault();

    if (!confirm('Are you sure you want to delete this mood?')) return;

    const formData = new FormData(form);

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });

        if (response.ok) {
            // Fetch the updated mood list dynamically
            const refresh = await fetch('/moods/partial/index', {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const html = await refresh.text();
            document.querySelector('#content-area').innerHTML = html;
        } else {
            console.error('Failed to delete mood:', response.status);
        }
    } catch (error) {
        console.error('Error deleting mood:', error);
    }
});
</script>



