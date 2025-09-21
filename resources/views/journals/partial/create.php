 <div class="container">
        <h2>Write a New Journal Entry 📖</h2>

        <form method="POST" action="/journals">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" rows="5" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn">Save Journal</button>
        </form>
    </div><div class="container">
    <h2>Write a New Journal Entry 📖</h2>

    <form method="POST" action="/journals">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" rows="5" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn">Save Journal</button>
        <a data-feature="journals-index" data-url="/journals/partial/index" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
    document.querySelectorAll('[data-feature="journals-index"]').forEach(link => {
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