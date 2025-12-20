<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Bloomify</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon-16x16.png') }}">

    <style>
        :root {
            --mint-light: #EAF6EF;
            --mint: #A8D5BA;
            --mint-deep: #6B9A82;
            --mint-dark: #4F7F69;
            --text-dark: #1c2c25;
            --radius: 16px;
            --shadow: 0 15px 40px rgba(0,0,0,0.1);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #F5F7F5, var(--mint-light));
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow);
            max-width: 900px;
            width: 100%;
        }

        @media (max-width: 768px) {
            .login-wrapper {
                grid-template-columns: 1fr;
            }
        }

        .brand-logo {
         max-width: 200px;      /* bigger than before */
        width: 100%;           /* scales down on smaller screens */
        height: auto;           /* keeps aspect ratio */
        object-fit: contain;    /* ensures logo fits nicely */
        margin-bottom: 2rem;   /* more space below the logo */  
    }

        /* 🌿 Left side (branding) */
        .login-brand {
            background: linear-gradient(135deg, var(--mint), var(--mint-deep));
            color: #ffffff;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-brand img {
            height: 48px;
            margin-bottom: 1.5rem;
        }

        .login-brand h1 {
            font-size: 2.2rem;
            margin-bottom: 1rem;
        }

        .login-brand p {
            font-size: 1rem;
            opacity: 0.9;
        }

        /* 🌸 Right side (form) */
        .login-form {
            padding: 3rem;
        }

        .login-form h2 {
            color: var(--mint-deep);
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.3rem;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 700;
            font-size: 0.9rem;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            border-radius: var(--radius);
            border: 1px solid #d1d5db;
            font-size: 0.95rem;
            transition: border 0.2s ease, box-shadow 0.2s ease;
        }

        input:focus {
            outline: none;
            border-color: var(--mint-deep);
            box-shadow: 0 0 0 3px rgba(107,154,130,0.2);
        }

        .error {
            color: #dc2626;
            font-size: 0.85rem;
            margin-top: 6px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .remember input {
            accent-color: var(--mint-deep);
        }

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
        }

        .forgot {
            font-size: 0.85rem;
            color: var(--mint-deep);
            text-decoration: none;
        }

        .forgot:hover {
            text-decoration: underline;
        }

        .login-btn {
            background: linear-gradient(135deg, var(--mint-deep), var(--mint-dark));
            color: #ffffff;
            border: none;
            padding: 12px 28px;
            border-radius: 999px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .status {
            background: var(--mint-light);
            color: var(--mint-dark);
            padding: 10px 14px;
            border-radius: 12px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="login-wrapper">

    <!-- 🌿 Brand Side -->
   <div class="login-brand">
    <img src="{{ asset('assets/bloomify-logo.png') }}" alt="Bloomify Logo" class="brand-logo">
    <h1>Welcome Back 🌿</h1>
    <p>Log in to continue tracking your moods, journaling your thoughts, and nurturing your wellbeing.</p>
</div>


    <!-- 🌸 Login Form -->
    <div class="login-form">

        <h2>Log in</h2>

        @if (session('status'))
            <div class="status">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                >
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember -->
            <div class="remember">
                <input id="remember" type="checkbox" name="remember">
                <label for="remember">Remember me</label>
            </div>

            <!-- Actions -->
            <div class="actions">
                @if (Route::has('password.request'))
                    <a class="forgot" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif

                <button type="submit" class="login-btn">
                    Log in
                </button>
            </div>

        </form>

    </div>
</div>

</body>
</html>
