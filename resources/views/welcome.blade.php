<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Bloomify - Nurture Your Mind</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon-16x16.png') }}">

    <style>
        /* 🌿 Design Tokens */
        :root {
            --mint-light: #EAF6EF;
            --mint: #A8D5BA;
            --mint-deep: #6B9A82;
            --mint-dark: #4F7F69;
            --lavender: #EDE9FE;
            --text-dark: #1c2c25;
            --radius-lg: 22px;
            --radius-md: 14px;
            --shadow-soft: 0 12px 30px rgba(0,0,0,0.08);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Nunito', sans-serif;
            color: var(--text-dark);
            background: linear-gradient(180deg, #F5F7F5, #EEF5F1);
            line-height: 1.7;
        }

        /* 🌸 Header */
        header {
            background: linear-gradient(135deg, var(--mint), var(--mint-deep));
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2.5rem;
            box-shadow: var(--shadow-soft);
        }

        .logo img {
            height: 42px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
    }

/* Screen-reader only (accessible, invisible visually) */
        .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
        }


        nav a {
            margin-left: 1rem;
            text-decoration: none;
            background: rgba(255,255,255,0.2);
            color: #fff;
            padding: 10px 20px;
            border-radius: 999px;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        nav a:hover {
            background: #ffffff;
            color: var(--mint-deep);
        }

        /* 🌿 Hero */
        .hero {
            display: flex;
            flex-direction: column;
            gap: 3rem;
            padding: 6rem 2rem;
            background: radial-gradient(circle at top left, #ffffff, var(--mint-light));
        }

        @media (min-width: 768px) {
            .hero {
                flex-direction: row;
                align-items: center;
                padding: 5rem 6rem;
                min-height: 85vh;
            }
        }

        .hero-text {
            max-width: 560px;
        }

        .hero h1 {
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            color: var(--mint-deep);
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.15rem;
            margin-bottom: 2rem;
        }

        .cta {
            display: inline-block;
            background: linear-gradient(135deg, var(--mint-deep), var(--mint-dark));
            color: #fff;
            padding: 14px 32px;
            border-radius: 999px;
            font-weight: 700;
            text-decoration: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .cta:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-soft);
        }

        .hero-image {
            flex: 1;
            position: relative;
            min-height: 420px;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-soft);
            display: none;
        }

        @media (min-width: 768px) {
            .hero-image {
                display: block;
            }
        }

        .hero-image::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: url('{{ asset('assets/heroimage.png') }}');
            background-size: cover;
            background-position: center;
            opacity: 0.85;
        }

        /* 🌊 Wave */
        .wave {
            display: block;
        }

        /* 🌸 Explore */
        .explore-features {
            text-align: center;
            padding: 4rem 2rem 2rem;
            background: var(--mint-light);
        }

        .explore-features h2 {
            font-size: 2.2rem;
            color: var(--mint-deep);
        }

        /* 🌿 Features */
        .features {
            background: #ffffff;
            padding: 4rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2rem;
            max-width: 1100px;
            margin: -40px auto 4rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-soft);
        }

        .feature {
            background: linear-gradient(180deg, #ffffff, var(--mint-light));
            border-radius: var(--radius-md);
            padding: 2.5rem 2rem;
            text-align: center;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .feature:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 45px rgba(0,0,0,0.12);
        }

        .feature div {
            font-size: 2.4rem;
        }

        .feature h3 {
            margin-top: 1rem;
            color: var(--mint-deep);
        }

        /* 🌿 How It Works */
        .how-it-works {
            text-align: center;
            padding: 5rem 2rem;
            background: var(--mint-light);
        }

        .how-it-works h2 {
            font-size: 2.2rem;
            color: var(--mint-deep);
            margin-bottom: 2rem;
        }

        .steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2rem;
            max-width: 1100px;
            margin: auto;
        }

        .step {
            background: #ffffff;
            border-radius: var(--radius-md);
            padding: 2.5rem;
            box-shadow: var(--shadow-soft);
            transition: transform 0.2s ease;
        }

        .step:hover {
            transform: translateY(-4px);
        }

        .step h3 {
            color: var(--mint-deep);
        }

        /* 🌸 Testimonial */
        .testimonial {
            background: linear-gradient(135deg, var(--lavender), #ffffff);
            padding: 5rem 2rem;
            text-align: center;
        }

        .testimonial p {
            max-width: 600px;
            margin: auto;
            font-style: italic;
            font-size: 1.2rem;
        }

        .trust {
            margin-top: 1rem;
            font-size: 0.95rem;
        }

        /* 🌿 Final CTA */
        .final-cta {
            text-align: center;
            padding: 5rem 2rem;
            background: linear-gradient(135deg, var(--mint-light), #ffffff);
        }

        .final-cta h2 {
            font-size: 2.2rem;
            color: var(--mint-deep);
            margin-bottom: 1.5rem;
        }

        /* 🌸 Footer */
        footer {
            background: var(--mint-deep);
            color: #fff;
            text-align: center;
            padding: 1.2rem;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>

<header>
    <div class="logo">
    <img src="{{ asset('assets/bloomify-logo.png') }}" alt="Bloomify Logo">
</div>
<span class="sr-only">Bloomify</span>


    <nav>
        <a href="/login">Login</a>
        <a href="/register">Join Free</a>
    </nav>
</header>

<section class="hero">
    <div class="hero-text">
        <h1>Grow Your Mind Daily 🌿</h1>
        <p>
            Your safe space to track moods, journal your thoughts,
            and bloom into your best self — one day at a time.
        </p>
        <a href="/register" class="cta">Get Started</a>
    </div>
    <div class="hero-image"></div>
</section>

<svg class="wave" viewBox="0 0 1440 320">
    <path fill="#ffffff" d="M0,160L1440,64L1440,320L0,320Z"></path>
</svg>

<section class="explore-features">
    <h2>Explore Features</h2>
</section>

<section class="features">
    <div class="feature">
        <div>😊</div>
        <h3>Mood Check-In</h3>
        <p>Record your daily emotions and discover patterns over time.</p>
    </div>
    <div class="feature">
        <div>📓</div>
        <h3>Journal</h3>
        <p>Write reflections, gratitude notes, or private thoughts.</p>
    </div>
    <div class="feature">
        <div>📈</div>
        <h3>Trends</h3>
        <p>Visualize your growth with simple, calming charts.</p>
    </div>
    <div class="feature">
        <div>🌿</div>
        <h3>Wellness Tips</h3>
        <p>Gentle reminders that support your mental wellbeing.</p>
    </div>
</section>

<section class="how-it-works">
    <h2>How It Works</h2>
    <div class="steps">
        <div class="step">
            <h3>1️⃣ Check In</h3>
            <p>Log your mood daily in seconds.</p>
        </div>
        <div class="step">
            <h3>2️⃣ Write</h3>
            <p>Capture thoughts in your private journal.</p>
        </div>
        <div class="step">
            <h3>3️⃣ Reflect</h3>
            <p>Understand your emotional patterns.</p>
        </div>
        <div class="step">
            <h3>4️⃣ Bloom</h3>
            <p>Grow with mindful wellness tips.</p>
        </div>
    </div>
</section>



<section class="final-cta">
    <h2>Ready to Grow Your Mind?</h2>
    <a href="/register" class="cta">Join Free Today</a>
</section>

<footer>
    🌸 Bloomify &copy; {{ date('Y') }} — Privacy | Terms
</footer>

</body>
</html>
