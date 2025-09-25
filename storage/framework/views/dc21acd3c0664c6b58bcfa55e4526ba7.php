

<?php $__env->startSection('title', __('static.language.languages')); ?>

<?php $__env->startSection('content'); ?>
    <div class="row g-sm-4 g-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5><?php echo e(__('static.language.languages')); ?></h5>
                    <div class="btn-action ms-auto">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('backend.language.create')): ?>
                            <div class="btn-popup mb-0">
                                <a href="<?php echo e(route('backend.systemLang.create')); ?>"
                                    class="btn"><?php echo e(__('static.language.create')); ?>

                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <a href="#!" class="btn btn-sm btn-secondary deleteConfirmationBtn" style="display: none;"
                        data-url="<?php echo e(route('backend.delete.systemLang')); ?>">
                        <span id="count-selected-rows">0</span><?php echo e(__('static.deleted_selected')); ?></a>
                </div>
                <div class="card-body common-table">
                    <div class="language-table">
                        <div class="table-responsive">
                            <?php echo $dataTable->table(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <?php echo $dataTable->scripts(); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/haykshahinyan/Projects/Direlli/Full/fixit_laravel/resources/views/backend/language/index.blade.php ENDPATH**/ ?>