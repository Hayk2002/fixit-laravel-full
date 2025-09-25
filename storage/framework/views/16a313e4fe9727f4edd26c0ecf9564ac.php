<?php use \App\Models\Zone; ?>
<?php
    $zones = Zone::where('status', true)->get();
?>


<?php $__env->startSection('title', __('static.service.services')); ?>

<?php $__env->startSection('content'); ?>

    <div class="row g-sm-4 g-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5><?php echo e(__('static.service.services')); ?></h5>

                    <div class="btn-action">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('backend.service.create')): ?>
                            <div class="btn-popup mb-0">
                                <a href="<?php echo e(route('backend.service.create')); ?>"
                                    class="btn"><?php echo e(__('static.service.create')); ?></a>
                            </div>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('backend.service.destroy')): ?>
                            <a href="javascript:void(0);" class="btn btn-sm btn-secondary deleteConfirmationBtn"
                                style="display: none;" data-url="<?php echo e(route('backend.delete.services')); ?>">
                                <span id="count-selected-rows">0</span> <?php echo e(__('static.delete_selected')); ?>

                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body common-table">
                    <div class="service-table">
                        <div class="booking-select common-table-select">
                            <select class="select-2 form-control" id="zoneFilter"
                                data-placeholder="<?php echo e(__('static.notification.select_zone')); ?>">
                                <option class="select-placeholder" value=""></option>
                                <?php $__currentLoopData = $zones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($zone->id); ?>" <?php if(request()->zone == $zone->id): ?> selected <?php endif; ?>>
                                        <?php echo e($zone->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
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
        (function($) {
            "use strict";
            $(document).ready(function() {
                $('#zoneFilter').change(function() {
                    var selectedStatus = $(this).val();
                    var newUrl = "<?php echo e(route('backend.service.index')); ?>";
                    if (selectedStatus) {
                        newUrl += '?zone=' + selectedStatus;
                    }
                    // table.ajax.url(newUrl).load();
                    location.href = newUrl;
                });
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/haykshahinyan/Projects/Direlli/Full/fixit_laravel/resources/views/backend/service/index.blade.php ENDPATH**/ ?>