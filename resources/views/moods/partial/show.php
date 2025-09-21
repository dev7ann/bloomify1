<?php
$mood = isset($mood) ? $mood : new stdClass();
$mood->mood = isset($mood->mood) ? $mood->mood : '';
$mood->note = isset($mood->note) ? $mood->note : '';
$mood->created_at = isset($mood->created_at) ? new DateTime($mood->created_at) : new DateTime();
?>

<div class="container">
    <h2>Mood Details</h2>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title"><?php echo htmlspecialchars($mood->mood); ?></h4>
            <p class="card-text"><?php echo htmlspecialchars($mood->note) ?: 'No additional notes.'; ?></p>
            <small class="text-muted">Logged: <?php echo $mood->created_at->format('D, M d, Y, h:i A'); ?></small>
        </div>
    </div>

    <a data-feature="moods-edit" data-url="/moods/partial/edit/<?php echo $mood->id; ?>" class="btn btn-warning">Edit</a>
    <form action="/moods/<?php echo $mood->id; ?>" method="POST" style="display:inline">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <input type="hidden" name="_method" value="DELETE">
        <button class="btn btn-danger">Delete</button>
    </form>
    <a data-feature="moods-index" data-url="/moods/partial/index" class="btn btn-secondary">Back</a>
</div>

<script>
    document.querySelectorAll('[data-feature="moods-edit"], [data-feature="moods-index"]').forEach(link => {
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