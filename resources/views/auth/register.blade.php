<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Account | Bloomify</title>

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

        .register-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow);
            max-width: 950px;
            width: 100%;
        }

        @media (max-width: 768px) {
            .register-wrapper {
                grid-template-columns: 1fr;
            }
        }

        /* 🌿 Brand Side */
        .register-brand {
            background: linear-gradient(135deg, var(--mint), var(--mint-deep));
            color: #ffffff;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-logo {
         max-width: 200px;      /* bigger than before */
        width: 100%;           /* scales down on smaller screens */
        height: auto;           /* keeps aspect ratio */
        object-fit: contain;    /* ensures logo fits nicely */
        margin-bottom: 2rem;   /* more space below the logo */
    }

        .register-brand img {
            height: 48px;
            margin-bottom: 1.5rem;
        }

        .register-brand h1 {
            font-size: 2.2rem;
            margin-bottom: 1rem;
        }

        .register-brand p {
            font-size: 1rem;
            opacity: 0.9;
        }

        /* 🌸 Form Side */
        .register-form {
            padding: 3rem;
        }

        .register-form h2 {
            color: var(--mint-deep);
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 700;
            font-size: 0.9rem;
        }

        input {
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

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.8rem;
        }

        .login-link {
            font-size: 0.85rem;
            color: var(--mint-deep);
            text-decoration: none;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        .register-btn {
            background: linear-gradient(135deg, var(--mint-deep), var(--mint-dark));
            color: #ffffff;
            border: none;
            padding: 12px 30px;
            border-radius: 999px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }
    </style>
</head>
<body>

<div class="register-wrapper">

    <!-- 🌿 Brand -->
    <div class="register-brand">
    <img src="{{ asset('assets/bloomify-logo.png') }}" alt="Bloomify Logo" class="brand-logo">
    <h1>Join Bloomify 🌱</h1>
    <p>Create an account to start tracking your moods, journaling your thoughts, and growing emotionally.</p>
</div>

    <!-- 🌸 Register Form -->
    <div class="register-form">
        <h2>Create Account</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name">Full Name</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                >
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
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

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                >
                @error('password_confirmation')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Actions -->
            <div class="actions">
                <a href="{{ route('login') }}" class="login-link">
                    Already registered?
                </a>

                <button type="submit" class="register-btn">
                    Register
                </button>
            </div>

        </form>
    </div>
</div>

</body>
</html>
