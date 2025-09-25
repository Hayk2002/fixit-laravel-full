<?php use \App\Models\Setting; ?>
<?php
    $settings = Setting::pluck('values')?->first();
?>

<!-- footer start-->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center justify-content-center justify-content-md-start">
                <div class="footer-copyright">
                    <p class="mb-0"><?php echo e($settings['general']['copyright'] ?? ''); ?></p>
                </div>
            </div>
            <?php if(env('APP_VERSION')): ?>
                <div class="col-md-6">
                    <div class="app-version-box"
                        
                        >
                        <span class="badge d-flex badge-version-primary"><?php echo e(__('static.version')); ?>:
                            <?php echo e(env('APP_VERSION')); ?></span>
                        <span class="badge d-flex badge-version-primary"><?php echo e(__('static.load_time')); ?>:
                            <?php echo e(round(microtime(true) - LARAVEL_START, 2)); ?>s.</span>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</footer>
<!-- footer end-->
<?php /**PATH /Users/haykshahinyan/Projects/Direlli/Full/fixit_laravel/resources/views/backend/layouts/partials/footer.blade.php ENDPATH**/ ?>