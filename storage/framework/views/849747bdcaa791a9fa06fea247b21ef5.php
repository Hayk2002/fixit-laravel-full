

<?php $__env->startSection('title', __('static.plan.all')); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-sm-4 g-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5><?php echo e(__('static.plan.all')); ?></h5>
                <div class="btn-action">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('backend.plan.create')): ?>
                    <div class="btn-popup mb-0">
                        <a href="<?php echo e(route('backend.plan.create')); ?>" class="btn"><?php echo e(__('static.plan.create')); ?>

                        </a>
                    </div>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('backend.plan.destroy')): ?>
                    <a href="javascript:void(0);" class="btn btn-sm btn-secondary deleteConfirmationBtn" style="display: none;" data-url="<?php echo e(route('backend.delete.plans')); ?>">
                        <span id="count-selected-rows">0</span><?php echo e(__('static.delete_selected')); ?>

                    </a>
                </div>
                <?php endif; ?>
            </div>

            <div class="card-body common-table">
                <div class="customer-table">
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

    <script>
         $(document).ready(function() {
            $('.toggle-status').click(function() {
                var toggleId = $(this).data('id');
                $('#ConfirmationModal' + toggleId).modal('show');
                return false;
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/haykshahinyan/Projects/Direlli/Full/fixit_laravel/Modules/Subscription/Resources/views/index.blade.php ENDPATH**/ ?>