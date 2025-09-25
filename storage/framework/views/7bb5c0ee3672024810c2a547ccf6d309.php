<script>
    $(document).ready(function() {
        <?php if(Session::has('message')): ?>
        toastr.options = {
            "closeButton": false,
            "progressBar": false,
        }
        toastr.success('<svg><use xlink:href="<?php echo e(asset('frontend/images/svg/toster-check.svg#check')); ?>"></use></svg> <?php echo e(session('message')); ?>');
        <?php endif; ?>

        <?php if(Session::has('error')): ?>
        toastr.options = {
            "closeButton": false,
            "progressBar": false,
        }
        toastr.error("<?php echo e(session('error')); ?>");
        <?php endif; ?>

        <?php if(Session::has('info')): ?>
        toastr.options = {
            "closeButton": false,
            "progressBar": false,
        }
        toastr.info("<?php echo e(session('info')); ?>");
        <?php endif; ?>

        <?php if(Session::has('warning')): ?>
        toastr.options = {
            "closeButton": false,
            "progressBar": false,
        }
        toastr.warning("<?php echo e(session('warning')); ?>");
        <?php endif; ?>
    });
</script><?php /**PATH /Users/haykshahinyan/Projects/Direlli/Full/fixit_laravel/resources/views/frontend/inc/alerts.blade.php ENDPATH**/ ?>