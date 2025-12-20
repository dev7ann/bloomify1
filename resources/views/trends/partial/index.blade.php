<div class="p-6 bg-gradient-to-br from-white to-purple-50 rounded-lg shadow-lg">
    <div class="flex items-center mb-4">
        <i class="fas fa-chart-line text-purple-700 mr-2"></i>
        <h2 class="text-2xl font-bold text-purple-700">
            This Week's Mood Trends
        </h2>
    </div>
    

    <canvas
        id="moodChart"
        data-labels='@json($dailyLabels)'
        data-scores='@json($dailyScores)'
        height="300">
    </canvas>
</div>
