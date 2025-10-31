<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>   Admin Dashboard - Bloomify</title>
  <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background-color: #f4f4f9;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #4b0082;
            color: white;
            height: 100vh;
            padding: 20px;
            display: flex;
            flex-direction: column;
            transition: width 0.3s ease;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 40px;
        }

        .logo img {
            width: 40px;
            height: 40px;
        }

        .logo span {
            font-size: 20px;
            font-weight: bold;
            white-space: nowrap;
        }

        .toggle-btn {
            background: none;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
            margin-bottom: 20px;
            text-align: left;
        }

        .nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
        }

        .nav-links li {
            margin: 15px 0;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            display: block;
            transition: background 0.2s ease;
            padding: 10px;
            border-radius: 6px;
        }

        .nav-links a:hover,
        .nav-links a.active {
            background-color: #6a0dad;
        }

        /* Main content */
        .main-content {
            flex-grow: 1;
            padding: 30px;
            overflow-y: auto;
            background-color: #f3f4f6;
        }

        .header {
            font-size: 24px;
            font-weight: 600;
            color: #4b0082;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
   <div class="sidebar">
    <div class="logo">
      <img src="{{ asset('assets/bloomify-logo.png') }}" alt="Bloomify Logo">
      <span class="brand-name">Bloomify</span>
    </div>

        <button class="toggle-btn" id="toggle-btn">☰</button>

        <ul class="nav-links">
            <li><a href="#" class="active" data-section="dashboard-overview">Dashboard Overview</a></li>
            <li><a href="#" data-section="mood-analytics">Mood Analytics</a></li>
            <li><a href="#" data-section="user-management">User Management</a></li>
            <li><a href="#" data-section="wellness-tips">Wellness Tips</a></li>
        </ul>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <div id="content">
           @include('admin.dashboard-overview', [
])

        </div>
    </div>

    <script>
        // Sidebar toggle
        document.getElementById("toggle-btn").addEventListener("click", function() {
            document.getElementById("sidebar").classList.toggle("collapsed");
        });

        // Dynamic content loading
        document.querySelectorAll(".nav-links a").forEach(link => {
            link.addEventListener("click", function(e) {
                e.preventDefault();

                document.querySelectorAll(".nav-links a").forEach(l => l.classList.remove("active"));
                this.classList.add("active");

                const section = this.getAttribute("data-section");

                fetch(`/admin/${section}`)
                    .then(res => res.text())
                    .then(html => {
                        document.getElementById("content").innerHTML = html;
                    })
                    .catch(err => {
                        document.getElementById("content").innerHTML = "<p>Error loading content.</p>";
                        console.error(err);
                    });
            });
        });

        // Load Dashboard Overview by default
        window.addEventListener("DOMContentLoaded", () => {
            fetch(`/admin/dashboard-overview`)
                .then(res => res.text())
                .then(html => {
                    document.getElementById("content").innerHTML = html;
                });
        });
    </script>

</body>
</html>
