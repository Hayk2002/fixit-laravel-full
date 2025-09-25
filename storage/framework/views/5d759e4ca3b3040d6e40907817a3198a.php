

<?php $__env->startSection('title', __('static.plan.subscriptions')); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-sm-4 g-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5><?php echo e(__('static.plan.subscriptions')); ?></h5>
            </div>
            <div class="card-body common-table">
                <div class="subscription-table">
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

<?php echo $__env->make('backend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/haykshahinyan/Projects/Direlli/Full/fixit_laravel/Modules/Subscription/Resources/views/subscription.blade.php ENDPATH**/ ?>