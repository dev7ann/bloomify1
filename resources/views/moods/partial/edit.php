<?php
$mood = isset($mood) ? $mood : new stdClass();
$mood->mood = isset($mood->mood) ? $mood->mood : '';
$mood->note = isset($mood->note) ? $mood->note : '';
?>

<div class="container">
    <h2>Edit Mood</h2>

    <form action="/moods/<?php echo $mood->id; ?>" method="POST">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
            <label for="mood">Mood</label>
            <input type="text" name="mood" id="mood" class="form-control" value="<?php echo htmlspecialchars($mood->mood); ?>" required>
        </div>

        <div class="form-group">
            <label for="note">Note (optional)</label>
            <textarea name="note" id="note" class="form-control"><?php echo htmlspecialchars($mood->note); ?></textarea>
        </div>

        <button class="btn btn-primary">Update Mood</button>
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