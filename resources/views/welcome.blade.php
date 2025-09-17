<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Bloomify - Nurture Your Mind</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href={{ asset('assets/favicon-32x32.png') }}>
    <link rel="icon" type="image/png" sizes="16x16" href={{ asset('assets/favicon-16x16.png') }}>1
    <link rel="manifest" href="/site.webmanifest">
    <style>
        body {
            margin: 0;
            font-family: 'Nunito', sans-serif;
            color: #1c2c25;
            background: #F5F7F5; /* Warm Off-White */
        }

        header {
            background: #A8D5BA; /* Mint Green */
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
        }

       .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #ffffff;
        }

        .logo img {
            height: 40px;
            width: auto;
            vertical-align: middle;
        }

        @media (max-width: 768px) {
    .logo img {
        height: 30px; /* Smaller on mobile */
    }
    }

        nav a {
            margin-left: 1rem;
            text-decoration: none;
            background: #6B9A82; /* Deep Mint */
            color: #fff;
            padding: 8px 16px;
            border-radius: 5px;
            transition: background 0.3s ease;
            font-weight: bold;
        }

        nav a:hover {
            background: #5A8A72; /* Darker Deep Mint */
        }

        .hero {
            display: flex;
            flex-direction: column;
            text-align: left;
            padding: 6rem 2rem 4rem 2rem;
            background: #F5F7F5; /* Warm Off-White */
            position: relative;
        }

        @media (min-width: 768px) {
            .hero {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                min-height: 80vh;
                padding: 4rem 6rem;
            }
        }

        .hero-text {
            max-width: 600px;
            z-index: 2;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #6B9A82; /* Deep Mint */
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #1c2c25;
        }

        .hero .cta {
            background: #6B9A82; /* Deep Mint */
            color: #fff;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .hero-image {
            flex: 1;
            position: relative;
            display: none;
            min-height: 400px;
            border-radius: 12px;
            overflow: hidden;
        }

        @media (min-width: 768px) {
            .hero-image {
                display: block;
            }
        }

       .hero-image::before {
    content: "";
    background-image: url('{{ asset('assets/heroimage.png') }}');
    background-size: cover;
    background-position: center;
    background-blend-mode: overlay; /* Merges the image with the background */
    opacity: 0.7; /* Adjusts transparency for blending; tweak as needed (0.5-0.8 works well) */
    position: absolute;
    inset: 0;
    z-index: 1;
}

        .wave {
            display: block;
            margin: 0;
            padding: 0;
        }

         .explore-features {
            text-align: center;
            padding: 4rem 2rem;
            background: #C1E1D1; /* Light Mint */
        }

        .explore-features h2 {
            font-size: 2rem;
            margin-bottom: 2rem;
            color: #6B9A82;
        }

        .features {
            background: #ffffff;
            padding: 4rem 2rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2rem;
            max-width: 1000px;
            margin: -50px auto 4rem auto;
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        .feature {
            background: #C1E1D1; /* Light Mint */
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .feature h3 {
            margin-top: 1rem;
            margin-bottom: 0.5rem;
            color: #6B9A82; /* Deep Mint */
        }

        .feature p {
            font-size: 0.95rem;
            color: #333;
        }

        .how-it-works {
            text-align: center;
            padding: 4rem 2rem;
            background: #C1E1D1; /* Light Mint */
        }

        .how-it-works h2 {
            font-size: 2rem;
            margin-bottom: 2rem;
            color: #6B9A82; /* Deep Mint */
        }

        .steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            max-width: 1000px;
            margin: 0 auto;
        }

        .step {
            background: #ffffff;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .step h3 {
            margin-top: 1rem;
            color: #6B9A82; /* Deep Mint */
        }

        .step p {
            font-size: 0.95rem;
            color: #333;
        }

        .testimonial {
            background: #E6E6FA; /* Lavender Mist */
            padding: 4rem 2rem;
            text-align: center;
        }

        .testimonial p {
            font-style: italic;
            max-width: 600px;
            margin: 0 auto 1rem auto;
            font-size: 1.1rem;
            color: #1c2c25;
        }

        .trust {
            font-size: 0.9rem;
            color: #333;
        }

        .final-cta {
            text-align: center;
            padding: 4rem 2rem;
            background: #ffffff;
        }

        .final-cta h2 {
            font-size: 2rem;
            color: #6B9A82; /* Deep Mint */
            margin-bottom: 1rem;
        }

        .final-cta a {
            background: #6B9A82; /* Deep Mint */
            color: #fff;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        footer {
            background: #6B9A82; /* Deep Mint */
            color: #fff;
            text-align: center;
            padding: 1rem;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <!-- Header -->
  <header>
        <div class="logo">
            <img src="{{ asset('assets/bloomify-logo.png') }}" alt="Bloomify Logo" class="h-10">
            <span class="sr-only">Bloomify</span>
        </div>
        <nav>
            <a href="/login">Login</a>
            <a href="/register">Join Free</a>
        </nav>
    </header>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-text">
            <h1>Grow Your Mind Daily 🌿</h1>
            <p>Your safe space to track your moods, write your thoughts, and bloom into your best self — one day at a time.</p>
            <a href="/register" class="cta">Get Started</a>
        </div>
        <div class="hero-image"></div>
    </section>

    <!-- SVG Wave -->
    <svg class="wave" viewBox="0 0 1440 320">
        <path fill="#ffffff" fill-opacity="1" d="M0,160L48,170.7C96,181,192,203,288,192C384,181,480,139,576,128C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
    </svg>

    <!-- Features -->
    <section class= "explore-features">
        <h2> Explore Features</h2>
   <section class="features">
    <div class="feature">
        <div>😊</div>
        <h3>Mood Check-In</h3>
        <p>Record your daily emotions and spot patterns in your feelings over time.</p>
    </div>
    <div class="feature">
        <div>📓</div>
        <h3>Journal</h3>
        <p>Write reflections, gratitude notes, or private thoughts to clear your mind.</p>
    </div>
    <div class="feature">
        <div>📈</div>
        <h3>Trends</h3>
        <p>See how your moods change and grow with simple, beautiful charts.</p>
    </div>
    <div class="feature">
        <div>🌿</div>
        <h3>Wellness Tips</h3>
        <p>Gentle self-care reminders and mental wellness suggestions to help you bloom.</p>
    </div>
</section>

    <!-- How It Works -->
    <section class="how-it-works">
        <h2>How It Works</h2>
        <div class="steps">
            <div class="step">
                <h3>1️⃣ Check In</h3>
                <p>Log your mood every day in seconds.</p>
            </div>
            <div class="step">
                <h3>2️⃣ Write</h3>
                <p>Jot down thoughts or gratitude in your private journal.</p>
            </div>
            <div class="step">
                <h3>3️⃣ Reflect</h3>
                <p>View your trends to see how you grow over time.</p>
            </div>
            <div class="step">
                <h3>4️⃣ Bloom</h3>
                <p>Use gentle wellness tips to support your mental wellbeing.</p>
            </div>
        </div>
    </section>

    <!-- Testimonial -->
    <section class="testimonial">
        <p>"Bloomify helps me understand myself better. I feel calmer and more in control every day.”</p>
        <div class="trust">🌱 Your data stays private & secure, always.</div>
    </section>

    <!-- Final CTA -->
    <section class="final-cta">
        <h2>Ready to Grow Your Mind?</h2>
        <a href="/register">Join Free Today</a>
    </section>

    <!-- Footer -->
    <footer>
        🌸 Bloomify &copy; {{ date('Y') }} — Privacy | Terms
    </footer>

</body>
</html>