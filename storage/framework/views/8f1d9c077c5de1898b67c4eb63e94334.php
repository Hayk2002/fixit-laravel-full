
<?php $__env->startSection('title', __('static.roles.create')); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="m-auto col-xl-10 col-xxl-8">
            <form id="role-form" action="<?php echo e(route('backend.role.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo $__env->make('backend.role.fields', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/haykshahinyan/Projects/Direlli/Full/fixit_laravel/resources/views/backend/role/create.blade.php ENDPATH**/ ?>