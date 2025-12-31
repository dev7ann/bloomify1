<div class="row">
    <div class="col-12">
        <div class="mb-4">
            <h2 class="fw-bold text-primary-custom mb-2">
                <i class="fas fa-chart-line me-2"></i>Mood Trends
            </h2>
            <p class="text-muted mb-0">Visualize your emotional journey over the past week</p>
        </div>

        <div class="row g-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0">
                                <i class="fas fa-calendar-week me-2 text-primary-custom"></i>This Week's Overview
                            </h5>
                            <span class="badge bg-success">
                                <i class="fas fa-calendar-alt me-1"></i>
                                {{ \Carbon\Carbon::now()->startOfWeek()->format('D d M') }} - {{ \Carbon\Carbon::now()->endOfWeek()->format('D d M, Y') }}
                            </span>
                        </div>
                        
                        <div style="position: relative; height: 400px;">
                            <canvas
                                id="moodChart"
                                data-labels='@json($dailyLabels)'
                                data-scores='@json($dailyScores)'>
                            </canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-3">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #FFE5B4 0%, #FFA500 100%);">
                    <div class="card-body text-center text-white">
                        <i class="fas fa-smile-beam mb-3" style="font-size: 2.5rem;"></i>
                        <h6 class="fw-bold">Happy</h6>
                        <p class="small mb-0 opacity-75">Score: 5</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #98FB98 0%, #228B22 100%);">
                    <div class="card-body text-center text-white">
                        <i class="fas fa-smile mb-3" style="font-size: 2.5rem;"></i>
                        <h6 class="fw-bold">Calm</h6>
                        <p class="small mb-0 opacity-75">Score: 4</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #DDA0DD 0%, #9370DB 100%);">
                    <div class="card-body text-center text-white">
                        <i class="fas fa-grin-stars mb-3" style="font-size: 2.5rem;"></i>
                        <h6 class="fw-bold">Excited</h6>
                        <p class="small mb-0 opacity-75">Score: 3</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #ADD8E6 0%, #4682B4 100%);">
                    <div class="card-body text-center text-white">
                        <i class="fas fa-meh mb-3" style="font-size: 2.5rem;"></i>
                        <h6 class="fw-bold">Anxious/Sad</h6>
                        <p class="small mb-0 opacity-75">Score: 1-2</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-info border-0 shadow-sm mt-4">
            <div class="d-flex align-items-start">
                <i class="fas fa-info-circle me-3 mt-1" style="font-size: 1.5rem;"></i>
                <div>
                    <h6 class="fw-bold mb-2">Understanding Your Trends</h6>
                    <p class="mb-0 small">
                        Track your mood patterns to identify what affects your wellbeing. 
                        Notice when you feel your best and what might be causing stress. 
                        This awareness is the first step to better mental health.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
