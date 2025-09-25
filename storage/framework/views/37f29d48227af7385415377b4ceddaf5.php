<div class="row g-sm-4 g-3">
    <div class="col-12">
        <div class="card tab2-card">
            <div class="card-header">
                <h5><?php echo e(isset($role) ? __('static.roles.edit') : __('static.roles.create')); ?></h5>
            </div>
            <div class="card-body">
                <div class="roles">
                    <div class="form-group row">
                        <label class="col-md-2" for="name"><?php echo e(__('static.name')); ?><span> *</span></label>
                        <div class="col-md-10">
                            <input class='form-control' type="text" name="name" id="name"
                                value="<?php echo e(isset($role->name) ? $role->name : old('name')); ?>"
                                placeholder="<?php echo e(__('static.roles.enter_name')); ?>">
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>
                <div class="permission">
                    <div class="card-header">
                        <div class="form-group row">
                            <label class="col-md-2 m-0" for="name"><?php echo e(__('static.roles.permissions')); ?><span>
                                    *</span></label>
                            <div class="col-md-10">
                                <?php $__errorArgs = ['permissions'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="permission-section">
                            <ul>
                                <li>
                                    <label for="all_permissions">
                                        <h5><?php echo e(__('static.roles.select_all_permissions')); ?> &nbsp;<input type="checkbox"
                                                id="all_permissions" class="checkbox_animated"></h5>
                                    </label>
                                </li>
                            </ul>
                            <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <ul>
                                    <li>
                                        <h5 class="text-truncate module-name" data-tooltip-title="<?php echo e(ucwords(str_replace('_', ' ', $module->name))); ?>"><?php echo e(ucwords(str_replace('_', ' ', $module->name))); ?>:</h5>
                                    </li>

                                    <?php
                                        $permissions = isset($role)
                                            ? $role->getAllPermissions()->pluck('name')->toArray()
                                            : [];
                                        $isAllSelected =
                                            count(array_diff(array_values($module->actions), $permissions)) === 0;
                                    ?>
                                    <li>
                                        <div class="form-group m-checkbox-inline mb-0 d-flex">
                                            <label class="d-block" for="all<?php echo e($module->name); ?>">

                                                <input type="checkbox"
                                                    class="checkbox_animated select-all-permission select-all-for-<?php echo e($module->name); ?>"
                                                    id="all-<?php echo e($module->name); ?>" value="<?php echo e($module->name); ?>"
                                                    <?php echo e($isAllSelected ? 'checked' : ''); ?>><?php echo e(__('static.roles.all')); ?>


                                            </label>
                                        </div>
                                    </li>
                                    <?php $__currentLoopData = $module->actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action => $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <label class="d-block" for="<?php echo e($permission); ?>"
                                                data-action="<?php echo e($action); ?>" data-module="<?php echo e($module->name); ?>">
                                                <input type="checkbox" name="permissions[]"
                                                    class="checkbox_animated module_<?php echo e($module->name); ?> module_<?php echo e($module->name); ?>_<?php echo e($action); ?>"
                                                    value="<?php echo e($permission); ?>" id="<?php echo e($permission); ?>"
                                                    <?php echo e(in_array($permission, $permissions) ? 'checked' : ''); ?>><?php echo e($action); ?>

                                            </label>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button id='submitBtn' type="submit"
                        class="btn btn-primary spinner-btn ms-auto"><?php echo e(__('static.submit')); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function() {
            'use strict';

            function initializeTooltips() {
                $('.module-name').each(function() {
                    const $element = $(this);
                    const isTruncated = $element[0].scrollWidth > $element[0].offsetWidth;

                    if (isTruncated) {
                        if (!$element.data('bs.tooltip')) {
                            $element.tooltip({
                                trigger: 'hover',
                                placement: 'bottom',
                                title: $element.attr('data-tooltip-title')
                            });
                        }
                    } else {
                        if ($element.data('bs.tooltip')) {
                            $element.tooltip('dispose');
                        }
                    }
                });
            }

            initializeTooltips();

            $(window).resize(function() {
                initializeTooltips();
            });

            $(document).on('click', '.select-all-permission', function() {
                let value = $(this).prop('value');
                $('.module_' + value).prop('checked', $(this).prop('checked'));
                updateGlobalSelectAll();
            });
            $('.checkbox_animated').not('.select-all-permission').on('change', function() {
                let $this = $(this);
                let $label = $this.closest('label');
                let module = $label.data('module');
                let action = $label.data('action');
                let total_permissions = $('.module_' + module).length;
                let $selectAllCheckBox = $this.closest('.' + module + '-permission-list').find(
                    '.select-all-permission');
                let total_checked = $('.module_' + module).filter(':checked').length;
                let isAllChecked = total_checked === total_permissions;
                if ($this.prop('checked')) {
                    $('.module_' + module + '_index').prop('checked', true);

                } else {
                    let moduleCheckboxes = $(`input[type="checkbox"][data-module="${module}"]:checked`);
                    if (moduleCheckboxes.length === 0) {
                        if (action === 'index') {
                            $('.module_' + module).prop('checked', false);
                        }
                        $(`.module_${module}_${action}`).prop('checked', false);
                        $('.select-all-for-' + module).prop('checked', false);
                    }
                }

                $('.select-all-for-' + module).prop('checked', isAllChecked);
                updateGlobalSelectAll();
            });

            $('#roleForm').validate({});
        });

        $('#all_permissions').on('change', function() {
            $('.checkbox_animated').prop('checked', $(this).prop('checked'));
        });

        function updateGlobalSelectAll() {
            let allChecked = true;
            $('.select-all-permission').each(function() {
                if (!$(this).prop('checked')) {
                    allChecked = false;
                }
            });
            $('#all_permissions').prop('checked', allChecked);
        }

        $("#role-form").validate({
            ignore: [],
            rules: {
                "name": {
                    required: true
                },
                "permissions[]": {
                    required: true
                }
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") === "permissions[]") {
                    error.appendTo(element.closest('.permission').find('.col-md-10'));
                } else {
                    error.insertAfter(element);
                }
            }
        });

        $('#submitBtn').on('click', function(e) {
            $("#role-form").valid();
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /Users/haykshahinyan/Projects/Direlli/Full/fixit_laravel/resources/views/backend/role/fields.blade.php ENDPATH**/ ?>