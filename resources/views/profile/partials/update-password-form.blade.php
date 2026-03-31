<section class="bloomify-password-card">
    <header class="mb-5">
        <h4 class="text-primary-custom" style="font-weight: 600; color: #6B9A82;">
            <i class="fas fa-key me-2"></i> {{ __('Update Password') }}
        </h4>

        <p class="text-secondary" style="font-size: 0.9rem; opacity: 0.8;">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

   <form id="profile-form" method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-4">
            <label for="update_password_current_password" class="form-label text-secondary" style="font-weight: 500;">
                {{ __('Current Password') }}
            </label>
            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                <span class="input-group-text border-0 bg-light"><i class="fas fa-lock text-muted"></i></span>
                <input id="update_password_current_password" name="current_password" type="password" 
                       class="form-control border-0 bg-light p-3" 
                       style="border-left: 4px solid #e0e0e0 !important;"
                       autocomplete="current-password" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-danger small" />
        </div>

        <div class="mb-4">
            <label for="update_password_password" class="form-label text-secondary" style="font-weight: 500;">
                {{ __('New Password') }}
            </label>
            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                <span class="input-group-text border-0 bg-light"><i class="fas fa-shield-alt text-muted"></i></span>
                <input id="update_password_password" name="password" type="password" 
                       class="form-control border-0 bg-light p-3" 
                       style="border-left: 4px solid #6B9A82 !important;"
                       autocomplete="new-password" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-danger small" />
        </div>

        <div class="mb-4">
            <label for="update_password_password_confirmation" class="form-label text-secondary" style="font-weight: 500;">
                {{ __('Confirm New Password') }}
            </label>
            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                <span class="input-group-text border-0 bg-light"><i class="fas fa-check-double text-muted"></i></span>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                       class="form-control border-0 bg-light p-3" 
                       style="border-left: 4px solid #6B9A82 !important;"
                       autocomplete="new-password" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-danger small" />
        </div>

        <div class="d-flex align-items-center gap-3 pt-2">
            <button type="submit" class="btn btn-primary-custom px-4 py-2 rounded-3 shadow-sm" 
                    style="background-color: #6B9A82; border: none; color: white; font-weight: 600;">
                <i class="fas fa-shield-virus me-1"></i> {{ __('Update Security') }}
            </button>

            @if (session('status') === 'password-updated')
                <span class="text-success small animate__animated animate__fadeIn">
                    <i class="fas fa-check-circle"></i> {{ __('Password updated.') }}
                </span>
            @endif
        </div>
    </form>
</section>