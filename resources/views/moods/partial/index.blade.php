<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 fw-bold text-primary-custom">
                <i class="fas fa-smile me-2"></i>My Moods
            </h2>
            <button class="ajax-link btn btn-primary-custom" data-url="/moods/partial/create">
                <i class="fas fa-plus me-2"></i>Log New Mood
            </button>
        </div>

        @if ($moods->isEmpty())
            <div class="text-center py-5">
                <div class="mb-3">
                    <i class="fas fa-smile-beam" style="font-size: 4rem; color: #A8D5BA; opacity: 0.4;"></i>
                </div>
                <h5 class="text-secondary">No moods logged yet</h5>
                <p class="text-muted">Start tracking your emotional journey by logging your first mood 🌸</p>
                <button class="ajax-link btn btn-primary-custom mt-3" data-url="/moods/partial/create">
                    <i class="fas fa-plus me-2"></i>Log Your First Mood
                </button>
            </div>
        @else
            <div class="row g-3">
                @foreach ($moods as $mood)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card card-custom h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="me-3">
                                        @switch($mood->feeling)
                                            @case('happy') 
                                                <span style="font-size: 2.5rem;">😁</span>
                                                @break
                                            @case('calm') 
                                                <span style="font-size: 2.5rem;">😊</span>
                                                @break
                                            @case('excited') 
                                                <span style="font-size: 2.5rem;">😃</span>
                                                @break
                                            @case('anxious') 
                                                <span style="font-size: 2.5rem;">😰</span>
                                                @break
                                            @case('sad') 
                                                <span style="font-size: 2.5rem;">😞</span>
                                                @break
                                            @default 
                                                <span style="font-size: 2.5rem;">😶</span>
                                        @endswitch
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1 fw-bold text-capitalize">{{ $mood->feeling }}</h5>
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>{{ \Carbon\Carbon::parse($mood->mood_date)->format('M d, Y') }}
                                        </small>
                                    </div>
                                </div>
                                <p class="text-secondary mb-3">{{ $mood->note ?? 'No note added' }}</p>
                                <div class="d-flex gap-2">
                                    <a href="#" class="ajax-link btn btn-sm btn-outline-primary" 
                                       data-url="/moods/partial/edit/{{ $mood->id }}">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    <form method="POST" 
                                         action="{{ route('moods.destroy', $mood->id) }}" 
                                         class="delete-mood-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash me-1"></i>Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('submit', async function(e) {
    const form = e.target.closest('.delete-mood-form');
    if (!form) return;

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



