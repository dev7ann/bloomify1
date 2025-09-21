<?php
$moods = isset($moods) ? $moods : [];
$success = session('success');
?>

<div class="container">
    <h2>My Moods</h2>

    <a data-feature="moods-create" data-url="/moods/partial/create" class="btn btn-primary">Log New Mood</a>

    <?php if ($success): ?>
        <div class="alert-success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <ul class="list-group">
        <?php if (count($moods) > 0): ?>
            <?php foreach ($moods as $mood): ?>
                <li class="list-group-item">
                    <span>
                        <strong><?php echo htmlspecialchars($mood->mood); ?></strong> - <?php echo htmlspecialchars($mood->note); ?>
                        <br><small><?php echo (new DateTime($mood->created_at))->format('M d, Y, H:i'); ?></small>
                    </span>
                    <span>
                        <a data-feature="moods-edit" data-url="/moods/partial/edit/<?php echo $mood->id; ?>" class="btn btn-warning">Edit</a>
                        <form action="/moods/<?php echo $mood->id; ?>" method="POST" style="display:inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <button class="btn btn-danger">Delete</button>
                        </form>
                        <a data-feature="moods-show" data-url="/moods/partial/show/<?php echo $mood->id; ?>" class="btn btn-info">View</a>
                    </span>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li class="list-group-item">No moods logged yet.</li>
        <?php endif; ?>
    </ul>
</div>

<script>
    document.querySelectorAll('[data-feature="moods-create"], [data-feature="moods-edit"], [data-feature="moods-show"]').forEach(link => {
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