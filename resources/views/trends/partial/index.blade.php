<div class="p-6 bg-gradient-to-br from-white to-purple-50 rounded-lg shadow-lg">
    <div class="flex items-center mb-4">
        <i class="fas fa-chart-line text-purple-700 mr-2"></i>
        <h2 class="text-2xl font-bold text-purple-700">This Week's Mood Trends</h2>
    </div>

    @if (empty($dailyScores) || array_sum($dailyScores) == 0)
        <p class="text-gray-600 text-center py-4">No mood data available yet for this week.</p>
    @else
        <canvas id="moodChart" class="w-full" height="300"></canvas>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('moodChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($dailyLabels),
                    datasets: [{
                        label: 'Mood Trend',
                        data: @json($dailyScores),
                        borderColor: '#6b21a8',
                        backgroundColor: 'rgba(107, 33, 168, 0.2)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 5,
                            title: {
                                display: true,
                                text: 'Mood Level'
                            }
                        }
                    }
                }
            });
        </script>
    @endif
</div>
