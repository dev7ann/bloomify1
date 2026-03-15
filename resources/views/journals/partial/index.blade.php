<?php
$journals = isset($journals) && (is_array($journals) || $journals instanceof \Illuminate\Support\Collection) ? $journals : [];
$success = session('success');

function str_limit($string, $length) {
    return strlen($string) > $length ? substr($string, 0, $length) . '...' : $string;
}
?>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 fw-bold text-primary-custom">
                <i class="fas fa-book me-2"></i>My Journal Entries
            </h2>
            <button data-feature="journals-create" data-url="/journals/partial/create" class="btn btn-primary-custom">
                <i class="fas fa-pen me-2"></i>Write New Entry
            </button>
        </div>

        <?php if ($success) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i><?php echo htmlspecialchars($success); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php } ?>

        <?php if (count($journals) > 0) { ?>
            <div class="row g-4">
                <?php foreach ($journals as $journal) { ?>
                    <div class="col-12 col-lg-6">
                        <div class="card card-custom h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h4 class="card-title fw-bold text-primary-custom mb-0">
                                        <?php echo htmlspecialchars($journal->title); ?>
                                    </h4>
                                    <span class="badge bg-success">
                                        <i class="fas fa-book-open me-1"></i>Entry
                                    </span>
                                </div>
                                <p class="text-muted small mb-3">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    <?php echo (new DateTime($journal->created_at))->format('F d, Y'); ?>
                                </p>
                                <p class="card-text text-secondary">
                                    <?php echo htmlspecialchars(str_limit($journal->content, 200)); ?>
                                </p>
                                <div class="d-flex justify-content-end gap-2 mt-3">

                                <button class="btn btn-sm btn-outline-primary ajax-link"
                                    data-url="/journals/partial/edit/<?php echo $journal->id; ?>">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </button>

                                <form method="POST" action="/journals/<?php echo $journal->id; ?>" 
                                    onsubmit="return confirm('Delete this journal entry?')" 
                                    style="display:inline;">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="_method" value="DELETE">

                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash me-1"></i>Delete
                                    </button>
                                </form>

                            </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <div class="text-center py-5">
                <div class="mb-3">
                    <i class="fas fa-book-open" style="font-size: 4rem; color: #A8D5BA; opacity: 0.4;"></i>
                </div>
                <h5 class="text-secondary">No journal entries yet</h5>
                <p class="text-muted">Start documenting your thoughts and reflections today 📝</p>
                <button data-feature="journals-create" data-url="/journals/partial/create" class="btn btn-primary-custom mt-3">
                    <i class="fas fa-pen me-2"></i>Write Your First Entry
                </button>
            </div>
        <?php } ?>
    </div>
</div>