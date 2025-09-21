<?php
$userName = isset(Auth::user()->name) ? Auth::user()->name : 'User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Bloomify</title>
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            height: 100vh;
            display: flex;
        }
        .sidebar {
            width: 256px;
            background-color: #4b0082;
            color: #fff;
            display: flex;
            flex-direction: column;
            padding: 16px;
        }
        .logo img {
            height: 40px;
            margin-bottom: 16px;
        }
        .logo .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
        }
        nav {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        nav a {
            display: block;
            padding: 8px 16px;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
        }
        nav a:hover {
            background-color: #6a0dad;
        }
        .logout-form {
            padding-top: 16px;
            border-top: 1px solid #a78bfa;
        }
        .logout-btn {
            width: 100%;
            padding: 8px 16px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
        .main-content {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
        }
        .main-content h1 {
            color: #1f2937;
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 16px;
        }
        .main-content p {
            color: #4b5563;
            font-size: 16px;
        }
        .content-area {
            margin-top: 24px;
            background-color: #fff;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .text-red-600 {
            color: #dc2626;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="/assets/bloomify-logo.png" alt="Bloomify Logo">
            <span class="sr-only">Bloomify</span>
        </div>
        <nav>
            <a data-feature="moods" data-url="/moods/partial/index">Mood Tracker</a>
            <a data-feature="journals" data-url="/journals/partial/index">Journal</a>
            <a data-feature="wellness" data-url="/wellness/partial">Wellness Tips</a>
            <a data-feature="support" data-url="/support/partial">Support</a>
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
            <p class="text-gray-700">Track your moods, write journals, read wellness tips, or reach out for support.</p>
        </div>
    </div>

    <script>
        document.querySelectorAll('nav a').forEach(link => {
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
</body>
</html>