<div class="content-card">
    <h3 class="mb-4">My Profile</h3>

    <div class="row g-4">
        <div class="col-12 col-lg-6">
            <div class="p-4 bg-white shadow-sm rounded-3">
                <h5 class="mb-3">Profile Information</h5>
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="p-4 bg-white shadow-sm rounded-3">
                <h5 class="mb-3">Update Password</h5>
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="col-12">
            <div class="p-4 bg-white shadow-sm rounded-3 border border-danger-subtle">
                <h5 class="mb-3 text-danger">Delete Account</h5>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>

<script>
document.querySelector('#profile-form')?.addEventListener('submit', function(e) {
    e.preventDefault();

    let form = this;
    let formData = new FormData(form);

    fetch('/profile', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert(data.message);

            // 🔥 reload using YOUR system
            loadContent('/profile/edit');
        }
    })
    .catch(err => console.error(err));
});
</script>