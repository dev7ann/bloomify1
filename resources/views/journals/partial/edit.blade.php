    <div class="row">
    <div class="col-12 col-lg-10 col-xl-8 mx-auto">

    <h2 class="fw-bold text-primary-custom mb-4">
        <i class="fas fa-edit me-2"></i>Edit Journal Entry
    </h2>

    <form method="POST" action="/journals/<?php echo $journal->id; ?>" id="edit-journal-form">

        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <input type="hidden" name="_method" value="PUT">

        <div class="mb-4">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control"
            value="<?php echo htmlspecialchars($journal->title); ?>" required>
        </div>

        <div class="mb-4">
            <label class="form-label">Content</label>
            <textarea name="content" rows="10" class="form-control" required><?php echo htmlspecialchars($journal->content); ?></textarea>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <button type="button" class="ajax-link btn btn-outline-secondary" data-url="/journals/partial/index">
            Cancel
            </button>

            <button type="submit" class="btn btn-primary-custom">
            <i class="fas fa-save me-1"></i>Update Entry
            </button>
        </div>

    </form>

    </div>
    </div>

 <script>
const form = document.querySelector('#edit-journal-form');

if (form) {
    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = new FormData(form);

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (response.ok) {

                const indexResponse = await fetch('/journals/partial/index', {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });

                const html = await indexResponse.text();

                document.getElementById('content-area').innerHTML = html;

            } else {
                alert('Update failed.');
            }

        } catch (error) {
            console.error(error);
        }
    });
}
</script>