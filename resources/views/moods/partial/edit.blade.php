<div class="row">
    <div class="col-12">
        <div class="mb-4">
            <h2 class="fw-bold text-primary-custom mb-2">
                <i class="fas fa-edit me-2"></i>Edit Your Mood
            </h2>
            <p class="text-muted mb-0">
                <i class="fas fa-clock me-2"></i>{{ $mood->created_at->format('F d, Y - h:i A') }}
            </p>
        </div>

        <form action="{{ route('moods.update', $mood->id) }}" method="POST" id="mood-form">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="form-label fw-semibold text-secondary mb-3">Update your mood</label>
                <div class="row g-3">
                    @foreach (['happy' => '😁', 'calm' => '😊', 'excited' => '😃', 'anxious' => '😰', 'sad' => '😞'] as $value => $emoji)
                        <div class="col-6 col-md-4 col-lg-2">
                            <input type="radio" name="feeling" value="{{ $value }}" id="mood-{{ $value }}" 
                                   class="btn-check" {{ $mood->feeling == $value ? 'checked' : '' }} required>
                            <label for="mood-{{ $value }}" class="btn btn-outline-success w-100 h-100 d-flex flex-column align-items-center justify-content-center py-4 mood-option">
                                <span class="d-block mb-2" style="font-size: 3rem;">{{ $emoji }}</span>
                                <span class="text-capitalize fw-semibold">{{ $value }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-4">
                <label for="mood_date" class="form-label fw-semibold text-secondary">
                    <i class="fas fa-calendar-alt me-2"></i>Date
                </label>
                <input type="date" name="mood_date" id="mood_date" class="form-control form-control-lg" 
                       value="{{ $mood->mood_date ? \Carbon\Carbon::parse($mood->mood_date)->format('Y-m-d') : now()->format('Y-m-d') }}" required>
            </div>

            <div class="mb-4">
                <label for="note" class="form-label fw-semibold text-secondary">Update note (optional)</label>
                <textarea name="note" id="note" class="form-control" rows="4" 
                          placeholder="What's on your mind?">{{ $mood->note }}</textarea>
            </div>

            <div class="d-flex gap-3 justify-content-end">
                <button type="button" class="ajax-link btn btn-outline-secondary" data-url="/moods/partial/index">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-save me-2"></i>Update Mood
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.mood-option {
    transition: all 0.3s ease;
    border-width: 2px;
}

.mood-option:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
}

.btn-check:checked + .mood-option {
    background-color: #6B9A82 !important;
    border-color: #6B9A82 !important;
    color: white !important;
    transform: scale(1.05);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('mood-form');

    if (form) {
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