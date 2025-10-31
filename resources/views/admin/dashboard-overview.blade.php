 <!-- Platform Stats -->
        <div class="section">
            <h2>Platform Stats</h2>
            <p>Active Users (Last 30 Days): <?php echo $activeUsers; ?></p>
            <p>New Signups (Last 30 Days): <?php echo $newSignups; ?></p>
            <p>Total Moods: <?php echo $totalMoods; ?></p>
            <p>Total Journals: <?php echo $totalJournals; ?></p>
            <div class="chart-container">
                <canvas id="signupChart"></canvas>
            </div>
            <script>
                new Chart(document.getElementById('signupChart'), {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode(array_keys($signupTrends)); ?>,
                        datasets: [{
                            label: 'New Signups per Month',
                            data: <?php echo json_encode(array_values($signupTrends)); ?>,
                            backgroundColor: '#4b0082',
                        }]
                    },
                    options: {
                        scales: {
                            y: { beginAtZero: true, title: { display: true, text: 'Signups' } },
                            x: { title: { display: true, text: 'Month' } }
                        }
                    }
                });
            </script>
        </div>