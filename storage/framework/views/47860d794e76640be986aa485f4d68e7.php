

<?php $__env->startSection('title', __('static.serviceman.servicemen')); ?>

<?php $__env->startSection('content'); ?>
    <div class="row g-sm-4 g-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5><?php echo e(__('static.serviceman.servicemen')); ?></h5>
                    <div class="btn-action">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('backend.serviceman.create')): ?>
                            <div class="btn-popup mb-0">
                                <a href="<?php echo e(route('backend.serviceman.create')); ?>"
                                    class="btn"><?php echo e(__('static.serviceman.create')); ?>

                                </a>
                            </div>
                        <?php endif; ?>
                        <a href="javascript:void(0);" class="btn btn-sm btn-secondary deleteConfirmationBtn"
                            style="display: none;" data-url="<?php echo e(route('backend.delete.users')); ?>">
                            <span id="count-selected-rows">0</span><?php echo e(__('static.delete_selected')); ?>

                        </a>
                    </div>
                </div>
                <div class="card-body common-table">
                    <div class="serviceman-table">
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

<?php echo $__env->make('backend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/haykshahinyan/Projects/Direlli/Full/fixit_laravel/resources/views/backend/serviceman/index.blade.php ENDPATH**/ ?>