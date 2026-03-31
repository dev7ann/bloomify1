<section class="bloomify-danger-card">
    <header class="mb-4">
        <h4 class="text-danger" style="font-weight: 600;">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ __('Delete Account') }}
        </h4>

        <p class="text-secondary" style="font-size: 0.9rem; opacity: 0.8;">
            {{ __('Once your account is deleted, all of your mental health logs, journals, and data will be permanently removed. This action cannot be undone.') }}
        </p>
    </header>

    <button 
        type="button" 
        class="btn btn-outline-danger px-4 py-2 rounded-3 shadow-sm"
        style="font-weight: 600;"
        data-bs-toggle="modal" 
        data-bs-target="#confirmUserDeletionModal">
        <i class="fas fa-trash-alt me-1"></i> {{ __('Delete Account') }}
    </button>

    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <form method="post" action="{{ route('profile.destroy') }}" class="p-4">
                    @csrf
                    @method('delete')

                    <h5 class="text-dark" style="font-weight: 700;">
                        {{ __('Are you sure you want to delete your account?') }}
                    </h5>

                    <p class="text-muted small mt-2">
                        {{ __('To confirm, please enter your password. This is a permanent action and your Bloomify data will be wiped.') }}
                    </p>

                    <div class="mt-4">
                        <label for="password" class="form-label sr-only">{{ __('Password') }}</label>
                        <input 
                            id="password"
                            name="password"
                            type="password"
                            class="form-control border-0 bg-light p-3 rounded-3"
                            style="border-left: 4px solid #dc3545 !important;"
                            placeholder="{{ __('Confirm Password') }}"
                        />
                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-danger small" />
                    </div>

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-light px-4 rounded-3" data-bs-dismiss="modal">
                            {{ __('Cancel') }}
                        </button>

                        <button type="submit" class="btn btn-danger px-4 rounded-3 shadow-sm">
                            {{ __('Delete Permanently') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>