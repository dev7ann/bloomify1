<div class="p-6 bg-gradient-to-br from-white to-purple-50 rounded-lg shadow-lg">
    <div class="flex items-center mb-4">
        <i class="fas fa-chart-line text-purple-700 mr-2"></i>
        <h2 class="text-2xl font-bold text-purple-700">Your Daily Mood Trends</h2>
    </div>
    @if (empty($dailyScores) || array_sum($dailyScores) == 0)
        <p class="text-gray-600 text-center py-4">No mood data available yet. Start tracking your moods to see trends!</p>
        <p class="text-sm text-gray-500">Debug: Scores = <?php echo json_encode($dailyScores); ?>, Labels = <?php echo json_encode($dailyLabels); ?></p>
    @else
        <div class="relative">
            <canvas id="moodChart" class="w-full" height="300"></canvas>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('moodChart').getContext('2d');
            const moodChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($dailyLabels),
                    datasets: [{
                        label: 'Daily Mood',
                        data: @json($dailyScores),
                        borderColor: (context) => {
                            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
                            gradient.addColorStop(0, '#6b21a8');
                            gradient.addColorStop(1, '#10b981');
                            return gradient;
                        },
                        backgroundColor: (context) => {
                            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
                            gradient.addColorStop(0, 'rgba(107, 33, 168, 0.2)');
                            gradient.addColorStop(1, 'rgba(16, 185, 129, 0.2)');
                            return gradient;
                        },
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 5,
                            title: {
                                display: true,
                                text: 'Mood Score',
                                color: '#6b21a8'
                            },
                            ticks: {
                                color: '#4b5563'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Date',
                                color: '#6b21a8'
                            },
                            ticks: {
                                color: '#4b5563',
                                maxRotation: 45,
                                minRotation: 45
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                color: '#6b21a8'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `Mood: ${context.raw} (on ${context.label})`;
                                }
                            }
                        }
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeInOutQuad'
                    }
                }
            });
        </script>
    @endif
    <style>
        #moodChart {
            animation: fadeIn 1s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</div>