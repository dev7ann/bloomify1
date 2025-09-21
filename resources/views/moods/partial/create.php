<div class="container">
    <h2>Log a Mood</h2>

    <form action="/moods" method="POST">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="form-group">
            <label for="mood">Mood</label>
            <input type="text" name="mood" id="mood" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="note">Note (optional)</label>
            <textarea name="note" id="note" class="form-control"></textarea>
        </div>

        <button class="btn btn-success">Save Mood</button>
        <a data-feature="moods-index" data-url="/moods/partial/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
    document.querySelectorAll('[data-feature="moods-index"]').forEach(link => {
        link.addEventListener('click', async (e) => {
            e.preventDefault();
            const url = link.getAttribute('data-url');
            const contentArea = document.getElementById('content-area');
            try {
                const response = await fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                if (response.ok) {
                    contentArea.innerHTML = await response.text();
                } else {
                    contentArea.innerHTML = '<p class="text-red-600">Error loading content. Try again later.</p>';
                }
            } catch (error) {
                contentArea.innerHTML = '<p class="text-red-600">Error loading content: ' + error.message + '</p>';
            }
        });
    });
</script>