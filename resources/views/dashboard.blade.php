<?php
$userName = isset(Auth::user()->name) ? Auth::user()->name : 'User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard - Bloomify</title>
  <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    :root {
      --purple-dark: #4b0082;
      --purple-light: #a78bfa;
      --lavender: #ede9fe;
      --accent: #9333ea;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f9fafb;
      color: #333;
      height: 100vh;
      display: flex;
    }

    /* Sidebar */
    .sidebar {
      width: 256px;
      background: var(--purple-dark);
      color: #fff;
      display: flex;
      flex-direction: column;
      padding: 16px;
      transition: width 0.3s ease;
      position: relative;
      box-shadow: 2px 0 6px rgba(0,0,0,0.1);
    }
    .sidebar.collapsed {
      width: 64px;
    }
    .logo {
      display: flex;
      align-items: center;
      margin-bottom: 24px;
    }
    .logo img {
      height: 40px;
      margin-right: 8px;
    }
    .logo .brand-name {
      font-size: 18px;
      font-weight: bold;
      color: #fff;
      white-space: nowrap;
    }
    .toggle-btn {
      position: absolute;
      top: 16px;
      right: -12px;
      background: var(--accent);
      border: none;
      color: #fff;
      width: 28px;
      height: 28px;
      border-radius: 50%;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.3s ease;
    }
    .sidebar.collapsed .toggle-btn {
      transform: rotate(180deg);
    }

    nav {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 6px;
    }
    nav a {
      display: flex;
      align-items: center;
      padding: 10px 16px;
      color: #fff;
      text-decoration: none;
      border-radius: 6px;
      transition: all 0.3s ease;
      font-size: 15px;
    }
    nav a:hover {
      background: var(--accent);
      transform: translateX(4px);
    }
    nav a.active {
      background: var(--purple-light);
      font-weight: 600;
    }
    nav a i {
      margin-right: 10px;
      font-size: 16px;
    }
    .sidebar.collapsed nav a span {
      display: none;
    }
    .sidebar.collapsed nav a {
      justify-content: center;
    }

    .logout-form {
      padding-top: 16px;
      border-top: 1px solid var(--purple-light);
    }
    .logout-btn {
      width: 100%;
      padding: 10px;
      background-color: #dc3545;
      color: #fff;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
      transition: background 0.3s;
    }
    .logout-btn:hover {
      background-color: #b91c1c;
    }

    /* Main Content */
    .main-content {
      flex: 1;
      padding: 40px;
      overflow-y: auto;
      background: #f9fafb;
      transition: margin-left 0.3s ease;
    }
    .sidebar.collapsed + .main-content {
      margin-left: 64px;
    }

    h1 {
      font-size: 24px;
      font-weight: 600;
      color: var(--purple-dark);
      margin-bottom: 8px;
    }
    p {
      color: #555;
      margin-bottom: 16px;
    }

    /* Content Area */
    .content-area {
      margin-top: 24px;
      background: #fff;
      padding: 24px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      animation: fadeIn 0.4s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .text-red-600 {
      color: #dc2626;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <div class="logo">
      <img src="{{ asset('assets/bloomify-logo.png') }}" alt="Bloomify Logo">
      <span class="brand-name">Bloomify</span>
    </div>
    <button class="toggle-btn"><i class="fas fa-chevron-left"></i></button>
    <nav>
      <a data-feature="moods" data-url="/moods/partial/index" class="active"><i class="fas fa-smile"></i><span>Mood Tracker</span></a>
      <a data-feature="journals" data-url="/journals/partial/index"><i class="fas fa-book"></i><span>Journal</span></a>
      <a data-feature="trends" data-url="/trends/partial/index"><i class="fas fa-chart-line"></i><span>Mood Trends</span></a>
      <a data-feature="wellness" data-url="/wellness/partial"><i class="fas fa-leaf"></i><span>Wellness Tips</span></a>
      <a data-feature="support" data-url="/support/partial"><i class="fas fa-question-circle"></i><span>Support</span></a>
    </nav>
    <div class="logout-form">
      <form method="POST" action="/logout">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <button type="submit" class="logout-btn">Logout</button>
      </form>
    </div>
  </div>

  <div class="main-content">
    <h1>Welcome, <?php echo htmlspecialchars($userName); ?> 👋</h1>
    <p>This is your personalized dashboard. Use the sidebar to navigate to different features.</p>
    <div class="content-area" id="content-area">
      <h2 class="text-xl font-semibold text-purple-700 mb-2">Quick Overview</h2>
      <p class="text-gray-700">Track your moods, write journals, view mood trends, read wellness tips, or reach out for support.</p>
    </div>
  </div>

  <script>
async function loadContent(url) {
  const contentArea = document.getElementById('content-area');
  try {
    const response = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
    if (response.ok) {
      contentArea.innerHTML = await response.text();
      attachAllHandlers(); // reattach everything for new content
    } else {
      contentArea.innerHTML = '<p class="text-red-600">Error loading content. Try again later.</p>';
    }
  } catch (error) {
    contentArea.innerHTML = '<p class="text-red-600">Error: ' + error.message + '</p>';
  }
}

// Sidebar navigation
document.querySelectorAll('nav a').forEach(link => {
  link.addEventListener('click', async (e) => {
    e.preventDefault();
    document.querySelectorAll('nav a').forEach(a => a.classList.remove('active'));
    link.classList.add('active');
    loadContent(link.getAttribute('data-url'));
  });
});

// Handles any dynamic links (buttons inside partials)
function attachDynamicLinks() {
  document.querySelectorAll('.ajax-link').forEach(btn => {
    btn.addEventListener('click', async (e) => {
      e.preventDefault();
      const url = btn.getAttribute('data-url');
      if (!url) return;
      const response = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
      const html = await response.text();
      document.getElementById('content-area').innerHTML = html;
      attachAllHandlers();
    });
  });
}

// Mood form handler
function attachMoodFormHandler() {
  const form = document.querySelector('#mood-form');
  if (!form) return;

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
        const html = await response.text();
        document.getElementById('content-area').innerHTML = html;
        attachAllHandlers();
      }
    } catch (error) {
      console.error('Mood form error:', error);
    }
  });
}

// Journal Create + Save handlers
function attachJournalHandlers() {
  // Handle "Write New Journal" button
  document.querySelectorAll('[data-feature="journals-create"]').forEach(btn => {
    btn.addEventListener('click', async (e) => {
      e.preventDefault();
      const url = btn.getAttribute('data-url');
      const contentArea = document.getElementById('content-area');
      try {
        const response = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
        if (response.ok) {
          contentArea.innerHTML = await response.text();
          attachAllHandlers(); // when journal form loads
        } else {
          contentArea.innerHTML = '<p class="text-red-600">Error loading journal form.</p>';
        }
      } catch (error) {
        console.error('Error loading journal form:', error);
      }
    });
  });
}

function attachJournalFormHandler() {
  const form = document.querySelector('form[action="/journals"]');
  if (!form) return;

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
        // Reload journal list after saving
        const indexResponse = await fetch('/journals/partial/index', {
          headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        const html = await indexResponse.text();
        document.getElementById('content-area').innerHTML = html;
        attachAllHandlers();
      } else {
        alert('Failed to save journal entry.');
      }
    } catch (error) {
      console.error('Error submitting journal form:', error);
    }
  });
}

// Delete mood handler
function attachDeleteHandlers() {
  document.querySelectorAll('form.delete-mood-form').forEach(form => {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      if (!confirm('Are you sure you want to delete this mood?')) return;

      const formData = new FormData(form);
      try {
        const response = await fetch(form.action, {
          method: 'POST',
          body: formData,
          headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });

        if (response.ok) {
          const indexResponse = await fetch('/moods/partial/index', {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
          });
          const html = await indexResponse.text();
          document.getElementById('content-area').innerHTML = html;
          attachAllHandlers();
        }
      } catch (error) {
        console.error('Error deleting mood:', error);
      }
    });
  });
}

// Attach all handlers after loading new content
function attachAllHandlers() {
  attachDynamicLinks();
  attachMoodFormHandler();
  attachDeleteHandlers();
  attachJournalHandlers();
  attachJournalFormHandler();
}

// Initial run
attachAllHandlers();

// Sidebar toggle
const sidebar = document.querySelector('.sidebar');
const toggleBtn = document.querySelector('.toggle-btn');
toggleBtn.addEventListener('click', () => {
  sidebar.classList.toggle('collapsed');
});
</script>


</body>
</html>
