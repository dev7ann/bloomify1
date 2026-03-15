@extends('layouts.user')

@section('title', 'Dashboard - Bloomify')

@section('navigation')
    <a href="#" data-feature="moods" data-url="/moods/partial/index" class="nav-link-custom active">
        <i class="fas fa-smile"></i><span>Mood Tracker</span>
    </a>
    <a href="#" data-feature="journals" data-url="/journals/partial/index" class="nav-link-custom">
        <i class="fas fa-book"></i><span>Journal</span>
    </a>
    <a href="#" data-feature="trends" data-url="/trends/partial/index" class="nav-link-custom">
        <i class="fas fa-chart-line"></i><span>Mood Trends</span>
    </a>
    <a href="#" data-feature="wellness" data-url="/wellness/partial" class="nav-link-custom">
        <i class="fas fa-leaf"></i><span>Wellness Tips</span>
    </a>
    {{-- <a href="#" data-feature="profile" data-url="/profile/edit" class="nav-link-custom">
        <i class="fa-solid fa-user"></i><span>profile</span>
    </a> --}}
@endsection

@section('content')
    <div class="welcome-header">
        <h1>Welcome, {{ Auth::user()->name ?? 'User' }} 👋</h1>
        <p class="mb-0">Your personalized wellness dashboard. Track your journey to better mental health.</p>
    </div>

    <div class="content-card" id="content-area">
        <div class="row">
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-leaf text-primary-custom" style="font-size: 4rem; opacity: 0.3;"></i>
                    </div>
                    <h3 class="text-primary-custom mb-3">Welcome to Your Wellness Space</h3>
                    <p class="text-secondary mb-4">
                        Track your moods, write journals, view trends, and discover wellness tips.<br>
                        Use the sidebar to navigate through different features.
                    </p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <button class="btn btn-primary-custom" onclick="document.querySelector('[data-feature=moods]').click()">
                            <i class="fas fa-smile me-2"></i>Log Your Mood
                        </button>
                        <button class="btn btn-outline-success" onclick="document.querySelector('[data-feature=journals]').click()">
                            <i class="fas fa-book me-2"></i>Write Journal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function renderMoodChart() {
    const canvas = document.getElementById('moodChart');
    if (!canvas) return;

    const labels = JSON.parse(canvas.dataset.labels);
    const scores = JSON.parse(canvas.dataset.scores);
    const cleanScores = scores.map(s => s === 0 ? null : s);

    new Chart(canvas.getContext('2d'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Mood Score',
                data: cleanScores,
                borderColor: '#6B9A82',
                backgroundColor: 'rgba(107, 154, 130, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                spanGaps: false,
                fill: true,
                pointRadius: 5,
                pointBackgroundColor: '#6B9A82',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    min: 0,
                    max: 5,
                    ticks: {
                        stepSize: 1,
                        callback: function(value) {
                            const labels = ['', 'Sad', 'Anxious', 'Excited', 'Calm', 'Happy'];
                            return labels[value] || '';
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
}

async function loadContent(url) {
    const contentArea = document.getElementById('content-area');
    
    try {
        const response = await fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });

        if (!response.ok) throw new Error('Failed to load');

        contentArea.innerHTML = await response.text();
        renderMoodChart();
        attachAllHandlers();
    } catch (error) {
        contentArea.innerHTML = '<div class="alert alert-danger">Error loading content. Please try again.</div>';
    }
}

document.querySelectorAll('.nav-link-custom').forEach(link => {
    link.addEventListener('click', async (e) => {
        e.preventDefault();
        document.querySelectorAll('.nav-link-custom').forEach(a => a.classList.remove('active'));
        link.classList.add('active');
        loadContent(link.getAttribute('data-url'));
    });
});

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

function attachJournalHandlers() {
    document.querySelectorAll('[data-feature="journals-create"]').forEach(btn => {
        btn.addEventListener('click', async (e) => {
            e.preventDefault();
            const url = btn.getAttribute('data-url');
            const contentArea = document.getElementById('content-area');
            try {
                const response = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                if (response.ok) {
                    contentArea.innerHTML = await response.text();
                    attachAllHandlers();
                } else {
                    contentArea.innerHTML = '<div class="alert alert-danger">Error loading journal form.</div>';
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

function attachAllHandlers() {
    attachDynamicLinks();
    attachMoodFormHandler();
    attachDeleteHandlers();
    attachJournalHandlers();
    attachJournalFormHandler();
}

attachAllHandlers();
</script>
@endpush
