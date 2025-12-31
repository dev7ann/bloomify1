<div class="row">
    <div class="col-12">
        <div class="mb-4">
            <h2 class="fw-bold text-primary-custom mb-2">
                <i class="fas fa-leaf me-2"></i>Wellness Tips
            </h2>
            <p class="text-muted mb-0">Daily inspiration for your mental wellbeing</p>
        </div>

        @if($wellnessTip)
            <div class="row g-4">
                <div class="col-12 col-lg-8 mx-auto">
                    <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #A8D5BA 0%, #6B9A82 100%);">
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-4">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-white shadow" 
                                     style="width: 80px; height: 80px;">
                                    <i class="fas fa-leaf text-success" style="font-size: 2.5rem;"></i>
                                </div>
                            </div>
                            
                            <h3 class="text-white text-center fw-bold mb-4">
                                {{ $wellnessTip->title }}
                            </h3>
                            
                            <p class="text-white text-center lead mb-0" style="font-size: 1.1rem; line-height: 1.8;">
                                {{ $wellnessTip->content }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12">
                    <div class="alert alert-light border-0 shadow-sm">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-lightbulb text-warning me-3 mt-1" style="font-size: 1.5rem;"></i>
                            <div>
                                <h5 class="fw-bold mb-2">Quick Wellness Practices</h5>
                                <ul class="mb-0 text-secondary">
                                    <li>Take 5 deep breaths when feeling stressed</li>
                                    <li>Step outside for a 10-minute walk</li>
                                    <li>Write down 3 things you're grateful for</li>
                                    <li>Reach out to a friend or loved one</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <div class="mb-3">
                    <i class="fas fa-seedling" style="font-size: 4rem; color: #A8D5BA; opacity: 0.4;"></i>
                </div>
                <h5 class="text-secondary">No wellness tips available yet</h5>
                <p class="text-muted">Check back soon for daily wellness inspiration 🌱</p>
            </div>
        @endif
    </div>
</div>
