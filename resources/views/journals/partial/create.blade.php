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
  

<script>
document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('form');

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
        // After saving, reload the journals index partial dynamically
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
});
</script>

