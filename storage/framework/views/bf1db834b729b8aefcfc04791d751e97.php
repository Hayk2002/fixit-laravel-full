<?php use \app\Helpers\Helpers; ?>
<?php use \App\Enums\SymbolPositionEnum; ?>

<?php $__env->startSection('title', __('static.payment_methods.payment_methods')); ?>
<?php $__env->startSection('content'); ?>

    <div class="contentbox bg-transparent">
        <div class="inside p-0">
            <div class="contentbox-title">
                <div class="contentbox-subtitle">
                    <h3><?php echo e(__('static.payment_methods.payment_methods')); ?></h3>
                </div>
            </div>
            <div class="row g-sm-4 g-3">
                <?php $__empty_1 = true; $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paymentMethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-md-4">
                        <div class="card tab2-card h-100 payment-card" >
                            <div class="card-header">
                                <div class="header-img">
                                    <img src="<?php echo e($paymentMethod['image']); ?>" alt="" class="img-fluid">
                                    <div class="header-name">
                                        <h5><?php echo e(@$paymentMethod['title']); ?></h5>

                                    </div>
                                </div>
                                <div class="status-div">
                                    <label for="<?php echo e($paymentMethod['name']); ?>"><?php echo e(__('static.booking.status')); ?>:</label>
                                    <div class="editor-space">
                                        <label class="switch">
                                            <input class="form-check-input" type="checkbox" name="status" id=""
                                                value="1" <?php if($paymentMethod['status']): echo 'checked'; endif; ?>
                                                onchange="paymentStatus('<?php echo e($paymentMethod['slug']); ?>', this.checked)">
                                            <span class="switch-state"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" data-bs-toggle="modal"
                            data-bs-target="#paymentModal<?php echo e($paymentMethod['slug']); ?>">
                                <ul class="payment-keys">
                                    <?php $__currentLoopData = $paymentMethod['fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fieldKey => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $fieldValue = env(strtoupper($fieldKey));
                                        ?>
                                        <?php if($field['type'] === 'password'): ?>
                                            <li>
                                                <i class="ri-key-2-line"></i> <?php echo e($field['label']); ?> : <span>
                                                    <?php if(!empty($fieldValue)): ?>
                                                        *****<?php echo e(substr($fieldValue, strlen($fieldValue) - 4)); ?>

                                                    <?php else: ?>
                                                        N/A
                                                    <?php endif; ?>
                                                </span>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($field['type'] === 'number'): ?>
                                            <?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>
                                                <li>
                                                    <i class="ri-coin-line"></i> <?php echo e($field['label']); ?> :
                                                    <span><?php echo e(Helpers::getDefaultCurrencySymbol()); ?><?php echo e(@$paymentMethod['processing_fee']); ?></span>
                                                </li>
                                            <?php else: ?>
                                                <li>
                                                    <i class="ri-coin-line"></i> <?php echo e($field['label']); ?> :
                                                    <span><?php echo e(@$paymentMethod['processing_fee']); ?> <?php echo e(Helpers::getDefaultCurrencySymbol()); ?></span>
                                                </li>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if($field['type'] === 'select'): ?>
                                            <div class="vertical-left-animate">
                                                <div class="ribbon-wrapper">
                                                    <?php $__currentLoopData = $field['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionValue => $optionLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(!is_null($fieldValue) && $optionValue == $fieldValue): ?>
                                                            <div class="ribbon ribbon-theme ribbon-bookmark ribbon-orange">
                                                                <span>
                                                                    <?php echo e($optionLabel); ?>

                                                                </span>
                                                                <i class="ri-bookmark-3-line"></i>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div>
                        <h4>Payment method not found</h4>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php $__empty_1 = true; $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paymentMethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="modal fade payment-modal-box" id="paymentModal<?php echo e($paymentMethod['slug']); ?>">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fs-5" id="paymentModalLabel">
                            <?php echo e(__('static.edit')); ?></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                <i class="ri-close-line"></i>
                            </button>
                    </div>
                    <form action="<?php echo e(route('backend.paymentmethods.update', $paymentMethod['slug'])); ?>" id=""
                        method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('POST'); ?>
                    <div class="modal-body">
                            <?php $__currentLoopData = $paymentMethod['fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fieldKey => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $fieldValue = env(strtoupper($fieldKey));
                                ?>
                                <div class="form-group row">
                                    <label class="col-xxl-4" for="<?php echo e($fieldKey); ?>"><?php echo e($field['label']); ?></label>
                                    <div class="col-xxl-8">
                                        <?php if($field['type'] === 'select'): ?>
                                            <select class="form-control select-2" name="<?php echo e($fieldKey); ?>"
                                                id="<?php echo e($fieldKey); ?>" data-placeholder="<?php echo e($field['label']); ?>">
                                                <option class="select-placeholder" value=""></option>
                                                <?php $__currentLoopData = $field['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionValue => $optionLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($optionValue); ?>"
                                                        <?php if(!is_null($fieldValue)): ?> <?php if($optionValue == $fieldValue): echo 'selected'; endif; ?> <?php endif; ?>>
                                                        <?php echo e($optionLabel); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        <?php elseif($field['type'] === 'textarea'): ?>
                                            <textarea class="form-control" name="<?php echo e($fieldKey); ?>" id="<?php echo e($fieldKey); ?>"
                                                placeholder="<?php echo e($field['label']); ?>"></textarea>
                                        <?php elseif($field['type'] === 'password'): ?>
                                            <input class="form-control" type="password" name="<?php echo e($fieldKey); ?>"
                                                id="<?php echo e($fieldKey); ?>" placeholder="<?php echo e($field['label']); ?>"
                                                value="<?php echo e(Helpers::encryptKey($fieldValue)); ?>">
                                        <?php elseif($field['type'] === 'text'): ?>
                                            <input class="form-control" type="text" name="<?php echo e($fieldKey); ?>"
                                                id="<?php echo e($fieldKey); ?>" placeholder="<?php echo e($field['label']); ?>"
                                                value="<?php echo e(@$paymentMethod['title']); ?>">
                                        <?php elseif($field['type'] === 'number'): ?>
                                            <input class="form-control" type="number" name="<?php echo e($fieldKey); ?>"
                                                id="<?php echo e($fieldKey); ?>" placeholder="<?php echo e($field['label']); ?>"
                                                value="<?php echo e(@$paymentMethod['processing_fee']); ?>">
                                        <?php elseif($field['type'] === 'checkbox'): ?>
                                            <label class="switch">
                                                <input class="form-check-input" type="checkbox" name="<?php echo e($fieldKey); ?>"
                                                    id="<?php echo e($fieldKey); ?>" value="1"
                                                    <?php if(!empty($paymentMethod['subscription']) && $paymentMethod['subscription'] == 1): ?> checked <?php endif; ?>>
                                                <span class="switch-state"></span>
                                            </label>
                                        <?php else: ?>
                                            <input class="form-control" type="<?php echo e($field['type']); ?>"
                                                name="<?php echo e($fieldKey); ?>" id="<?php echo e($fieldKey); ?>"
                                                value="<?php echo e(Helpers::encryptKey($fieldValue)); ?>"
                                                placeholder="<?php echo e($field['label']); ?>">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="modal-footer">
                            <button id="submitBtn"
                                class="btn btn-primary spinner-btn"><?php echo e(__('static.submit')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <li class="no-notifications">
            <div class="payment">
                <div class="no-data mt-3">
                    <img src="<?php echo e(url('/images/no-data.png')); ?>" alt="">
                    <h6 class="mt-2"><?php echo e(__('static.payment_methods.not_found')); ?></h6>
                </div>
            </div>
        </li>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        (function() {
            "use strict";

            document.addEventListener("DOMContentLoaded", () => {
                const ribbons = document.querySelectorAll('.ribbon');

                ribbons.forEach(ribbon => {
                    const span = ribbon.querySelector('span');
                    if (span && span.textContent.trim() === "Live") {
                        ribbon.classList.add('ribbon-success');
                    }
                });
            });

            function paymentStatus(slug, status) {
                fetch(`<?php echo e(url('/backend/payment-methods/status')); ?>/${slug}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        },
                        body: JSON.stringify({
                            status: status ? 1 : 0
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            toastr.success(data.message);
                        } else {
                            toastr.error(data.error);
                        }
                    })
                    .catch(error => {
                        toastr.error(error.message || "An error occurred");
                    });
            }

            window.paymentStatus = paymentStatus;
        })();
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/haykshahinyan/Projects/Direlli/Full/fixit_laravel/resources/views/backend/payment-methods/index.blade.php ENDPATH**/ ?>