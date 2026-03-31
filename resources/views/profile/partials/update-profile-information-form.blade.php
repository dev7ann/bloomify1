<section class="bloomify-profile-card">
    <header class="mb-5">
        <h4 class="text-primary-custom" style="font-weight: 600; color: #6B9A82;">
            <i class="fas fa-user-edit me-2"></i> {{ __('Profile Information') }}
        </h4>

        <p class="text-secondary" style="font-size: 0.9rem; opacity: 0.8;">
            {{ __("Keep your account details up to date for a better experience.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form id="profile-form" method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="mb-4">
            <label for="name" class="form-label text-secondary" style="font-weight: 500;">{{ __('Full Name') }}</label>
            <input id="name" name="name" type="text" 
                   class="form-control border-0 bg-light p-3 rounded-3 shadow-sm" 
                   style="border-left: 4px solid #6B9A82 !important;"
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-danger small" :messages="$errors->get('name')" />
        </div>

        <div class="mb-4">
            <label for="email" class="form-label text-secondary" style="font-weight: 500;">{{ __('Email Address') }}</label>
            <input id="email" name="email" type="email" 
                   class="form-control border-0 bg-light p-3 rounded-3 shadow-sm" 
                   style="border-left: 4px solid #6B9A82 !important;"
                   value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="mt-2 text-danger small" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning mt-3 border-0 rounded-3 p-2 small">
                    {{ __('Your email address is unverified.') }}
                    <button form="send-verification" class="btn btn-link btn-sm text-decoration-none p-0 align-baseline">
                        {{ __('Resend verification.') }}
                    </button>
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3 pt-2">
            <button type="submit" class="btn btn-primary-custom px-4 py-2 rounded-3 shadow-sm" 
                    style="background-color: #6B9A82; border: none; color: white; font-weight: 600;">
                <i class="fas fa-save me-1"></i> {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <span class="text-success small animate__animated animate__fadeIn">
                    <i class="fas fa-check-circle"></i> {{ __('Saved successfully.') }}
                </span>
            @endif
        </div>
    </form>
</section>