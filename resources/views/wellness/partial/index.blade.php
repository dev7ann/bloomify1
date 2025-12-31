<div class="row">
    <div class="col-12">
        <div class="text-center mb-5">
            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" 
                 style="width: 70px; height: 70px; background: linear-gradient(135deg, #A8D5BA 0%, #6B9A82 100%); box-shadow: 0 4px 15px rgba(107, 154, 130, 0.3);">
                <i class="fas fa-spa text-white" style="font-size: 2rem;"></i>
            </div>
            <h2 class="fw-bold text-primary-custom mb-2">Daily Wellness</h2>
            <p class="text-muted mb-0">Nurture your mind, body, and spirit</p>
        </div>

        @if($wellnessTip)
            <div class="row g-4 mb-5">
                <div class="col-12 col-xl-10 mx-auto">
                    <div class="position-relative">
                        <div class="card border-0 overflow-hidden" style="background: linear-gradient(135deg, #ffffff 0%, #f8fdf9 100%); box-shadow: 0 20px 60px rgba(107, 154, 130, 0.15);">
                            <div class="card-body p-5 p-md-6">
                                <div class="row">
                                    <div class="col-lg-10 mx-auto text-center">
                                        <div class="mb-4">
                                            <span class="badge px-4 py-2 text-white" style="background: linear-gradient(135deg, #A8D5BA 0%, #6B9A82 100%); font-size: 0.85rem; letter-spacing: 1px; box-shadow: 0 4px 12px rgba(107, 154, 130, 0.3);">
                                                TODAY'S INSIGHT
                                            </span>
                                        </div>
                                        
                                        <h3 class="fw-bold mb-4 text-primary-custom" style="font-size: 2rem; line-height: 1.4;">
                                            {{ $wellnessTip->title }}
                                        </h3>
                                        
                                        <div class="mb-4">
                                            <div style="width: 80px; height: 4px; background: linear-gradient(90deg, #A8D5BA 0%, #6B9A82 100%); margin: 0 auto; border-radius: 2px;"></div>
                                        </div>
                                        
                                        <p class="text-secondary mb-0" style="font-size: 1.2rem; line-height: 2; font-weight: 400;">
                                            {{ $wellnessTip->content }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="position-absolute top-0 start-0 w-100 h-100 pe-none" style="opacity: 0.025;">
                            <i class="fas fa-leaf position-absolute text-success" style="font-size: 18rem; top: -4rem; right: -4rem; transform: rotate(-15deg);"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card border-0 h-100 wellness-card" style="background: linear-gradient(135deg, #E8F5E9 0%, #C8E6C9 100%);">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-white shadow-sm" 
                                     style="width: 60px; height: 60px;">
                                    <i class="fas fa-wind" style="font-size: 1.8rem; color: #6B9A82;"></i>
                                </div>
                            </div>
                            <h6 class="fw-bold mb-2 text-primary-custom">Breathe</h6>
                            <p class="small text-secondary mb-0" style="line-height: 1.6;">Practice mindful breathing</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card border-0 h-100 wellness-card" style="background: linear-gradient(135deg, #FFF9C4 0%, #FFF59D 100%);">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-white shadow-sm" 
                                     style="width: 60px; height: 60px;">
                                    <i class="fas fa-walking" style="font-size: 1.8rem; color: #F9A825;"></i>
                                </div>
                            </div>
                            <h6 class="fw-bold mb-2" style="color: #F57F17;">Move</h6>
                            <p class="small text-secondary mb-0" style="line-height: 1.6;">Take a mindful walk</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card border-0 h-100 wellness-card" style="background: linear-gradient(135deg, #E1F5FE 0%, #B3E5FC 100%);">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-white shadow-sm" 
                                     style="width: 60px; height: 60px;">
                                    <i class="fas fa-heart" style="font-size: 1.8rem; color: #0277BD;"></i>
                                </div>
                            </div>
                            <h6 class="fw-bold mb-2" style="color: #01579B;">Gratitude</h6>
                            <p class="small text-secondary mb-0" style="line-height: 1.6;">Count your blessings</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card border-0 h-100 wellness-card" style="background: linear-gradient(135deg, #F3E5F5 0%, #E1BEE7 100%);">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-white shadow-sm" 
                                     style="width: 60px; height: 60px;">
                                    <i class="fas fa-users" style="font-size: 1.8rem; color: #7B1FA2;"></i>
                                </div>
                            </div>
                            <h6 class="fw-bold mb-2" style="color: #4A148C;">Connect</h6>
                            <p class="small text-secondary mb-0" style="line-height: 1.6;">Reach out to loved ones</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-seedling" style="font-size: 5rem; color: #A8D5BA; opacity: 0.3;"></i>
                </div>
                <h4 class="fw-bold text-secondary mb-3">No wellness tips available</h4>
                <p class="text-muted">Add wellness tips through the admin panel to inspire users</p>
            </div>
        @endif
    </div>
</div>

<style>
.wellness-card {
    transition: all 0.3s ease;
    cursor: default;
}

.wellness-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
}
</style>
