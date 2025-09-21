<?php
$journals = isset($journals) && (is_array($journals) || $journals instanceof \Illuminate\Support\Collection) ? $journals : [];
$success = session('success');

function str_limit($string, $length) {
    return strlen($string) > $length ? substr($string, 0, $length) . '...' : $string;
}
?>

<div class="container">
    <h2>My Journal Entries 📔</h2>

    <a data-feature="journals-create" data-url="/journals/partial/create" class="btn btn-primary">Write New Journal</a>

    <?php if ($success) { ?>
        <div class="success-message"><?php echo htmlspecialchars($success); ?></div>
    <?php } ?>

    <?php if (count($journals) > 0) { ?>
        <?php foreach ($journals as $journal) { ?>
            <div class="journal-entry">
                <h3><?php echo htmlspecialchars($journal->title); ?></h3>
                <p class="date">Written on <?php echo (new DateTime($journal->created_at))->format('M d, Y'); ?></p>
                <p><?php echo htmlspecialchars(str_limit($journal->content, 150)); ?></p>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p class="no-entries">No journal entries yet. Start writing one!</p>
    <?php } ?>
</div>

<script>
    document.querySelectorAll('[data-feature="journals-create"]').forEach(link => {
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