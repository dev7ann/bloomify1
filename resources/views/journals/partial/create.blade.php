<div class="row">
    <div class="col-12 col-lg-10 col-xl-8 mx-auto">
        <div class="mb-4">
            <h2 class="fw-bold text-primary-custom mb-2">
                <i class="fas fa-pen-fancy me-2"></i>Write a New Journal Entry
            </h2>
            <p class="text-muted mb-0">
                <i class="fas fa-calendar-day me-2"></i>{{ now()->format('F d, Y') }}
            </p>
        </div>

        <form method="POST" action="/journals" id="journal-form">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <div class="mb-4">
                <label for="title" class="form-label fw-semibold text-secondary">
                    <i class="fas fa-heading me-2"></i>Title
                </label>
                <input type="text" name="title" id="title" class="form-control form-control-lg" 
                       placeholder="Give your entry a meaningful title..." required>
            </div>

            <div class="mb-4">
                <label for="content" class="form-label fw-semibold text-secondary">
                    <i class="fas fa-align-left me-2"></i>Your Thoughts
                </label>
                <textarea name="content" id="content" rows="12" class="form-control" 
                          placeholder="Pour your heart out... Write about your day, your feelings, your dreams, or anything on your mind." 
                          required></textarea>
                <div class="form-text">
                    <i class="fas fa-lock me-1"></i>Your journal is private and secure
                </div>
            </div>

            <div class="d-flex gap-3 justify-content-end">
                <button type="button" class="ajax-link btn btn-outline-secondary" data-url="/journals/partial/index">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-save me-2"></i>Save Entry
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#journal-form');

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
                    const indexResponse = await fetch('/journals/partial/index', {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });
                    const html = await indexResponse.text();
                    document.getElementById('content-area').innerHTML = html;
                } else {
                    alert('Failed to save journal entry.');
                }
            } catch (error) {
                console.error('Error submitting journal form:', error);
            }
        });
    }
});
</script>

