<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Bloomify - Nurture Your Mind')</title>
    
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-green: #6B9A82;
            --primary-dark: #4F7F69;
            --primary-light: #A8D5BA;
            --accent-purple: #9b87f5;
            --bg-soft: #F5F7F5;
            --bg-card: #ffffff;
            --text-primary: #1c2c25;
            --text-secondary: #6B7280;
            --border-color: #E5E7EB;
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.06);
            --shadow-md: 0 4px 16px rgba(0,0,0,0.08);
            --shadow-lg: 0 8px 24px rgba(0,0,0,0.12);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: var(--bg-soft);
            color: var(--text-primary);
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            background: linear-gradient(180deg, var(--primary-dark) 0%, var(--primary-green) 100%);
            padding: 1.5rem;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
            z-index: 1040;
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .sidebar-header img {
            height: 40px;
            width: 40px;
            border-radius: 8px;
        }

        .sidebar-header .brand-name {
            color: white;
            font-size: 1.3rem;
            font-weight: 600;
            white-space: nowrap;
            transition: opacity 0.3s;
        }

        .sidebar.collapsed .brand-name {
            opacity: 0;
            display: none;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.85rem 1rem;
            margin-bottom: 0.5rem;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-link-custom:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(5px);
        }

        .nav-link-custom.active {
            background: rgba(255, 255, 255, 0.25);
            color: white;
            font-weight: 600;
        }

        .nav-link-custom i {
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }

        .sidebar.collapsed .nav-link-custom {
            justify-content: center;
            padding: 0.85rem 0.5rem;
        }

        .sidebar.collapsed .nav-link-custom span {
            display: none;
        }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logout-btn {
            width: 100%;
            background: rgba(220, 53, 69, 0.9);
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: #dc3545;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .toggle-sidebar {
            position: absolute;
            top: 1.5rem;
            right: -15px;
            width: 30px;
            height: 30px;
            background: var(--accent-purple);
            border: none;
            border-radius: 50%;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
        }

        .toggle-sidebar:hover {
            transform: scale(1.1);
        }

        .sidebar.collapsed .toggle-sidebar i {
            transform: rotate(180deg);
        }

        /* Main Content Area */
        .main-content {
            margin-left: 260px;
            padding: 2rem;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
        }

        .sidebar.collapsed + .main-content {
            margin-left: 80px;
        }

        .welcome-header {
            background: white;
            padding: 1.5rem 2rem;
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 2rem;
        }

        .welcome-header h1 {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 0.25rem;
        }

        .welcome-header p {
            color: var(--text-secondary);
            margin: 0;
        }

        .content-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--shadow-sm);
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar.collapsed + .main-content {
                margin-left: 0;
            }

            .mobile-menu-btn {
                position: fixed;
                top: 1rem;
                left: 1rem;
                z-index: 1030;
                background: var(--primary-green);
                color: white;
                border: none;
                width: 45px;
                height: 45px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: var(--shadow-md);
            }
        }

        @media (min-width: 993px) {
            .mobile-menu-btn {
                display: none;
            }
        }

        /* Utility Classes */
        .text-primary-custom {
            color: var(--primary-green);
        }

        .bg-primary-custom {
            background-color: var(--primary-green);
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-green), var(--primary-dark));
            border: none;
            color: white;
            padding: 0.65rem 1.5rem;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            color: white;
        }

        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }

        .card-custom:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-3px);
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn d-lg-none" id="mobile-menu-toggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <button class="toggle-sidebar d-none d-lg-block" id="toggle-sidebar">
            <i class="fas fa-chevron-left"></i>
        </button>

        <div class="sidebar-header">
            <img src="{{ asset('assets/bloomify-logo.png') }}" alt="Bloomify">
            <span class="brand-name">Bloomify</span>
        </div>

        <nav class="flex-grow-1">
            @yield('navigation')
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt me-2"></i>
                    <span class="d-inline">Logout</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggle-sidebar');
        const mobileToggle = document.getElementById('mobile-menu-toggle');

        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');
            });
        }

        if (mobileToggle) {
            mobileToggle.addEventListener('click', () => {
                sidebar.classList.toggle('show');
            });
        }

        // Close sidebar on mobile when clicking outside
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 993) {
                if (!sidebar.contains(e.target) && !mobileToggle.contains(e.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
