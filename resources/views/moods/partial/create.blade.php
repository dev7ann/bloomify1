<div class="row">
    <div class="col-12">
        <div class="mb-4">
            <h2 class="fw-bold text-primary-custom mb-2">
                <i class="fas fa-smile-beam me-2"></i>How are you feeling?
            </h2>
            <p class="text-muted mb-0">
                <i class="fas fa-calendar-day me-2"></i>Today, {{ now()->format('F d, Y') }}
            </p>
        </div>

        <form action="{{ route('moods.store') }}" method="POST" id="mood-form">
            @csrf
            
            <div class="mb-4">
                <label class="form-label fw-semibold text-secondary mb-3">Select your mood</label>
                <div class="row g-3">
                    @foreach (['happy' => '😁', 'calm' => '😊', 'excited' => '😃', 'anxious' => '😰', 'sad' => '😞'] as $value => $emoji)
                        <div class="col-6 col-md-4 col-lg-2">
                            <input type="radio" name="feeling" value="{{ $value }}" id="mood-{{ $value }}" class="btn-check" required>
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
                       value="{{ now()->format('Y-m-d') }}" required>
            </div>

            <div class="mb-4">
                <label for="note" class="form-label fw-semibold text-secondary">Add a note (optional)</label>
                <textarea name="note" id="note" class="form-control" rows="4" 
                          placeholder="What's on your mind? Any thoughts you'd like to capture..."></textarea>
            </div>

            <div class="d-flex gap-3 justify-content-end">
                <button type="button" class="ajax-link btn btn-outline-secondary" data-url="/moods/partial/index">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-check me-2"></i>Log Mood
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
