
<?php $__env->startSection('content'); ?>
    <?php use \App\Models\Setting; ?>
    <?php
        $settings = Setting::first()->values;
    ?>
    <div class="login-title">
        <h2><?php echo e(__('frontend::auth.login_now')); ?></h2>
        <p><?php echo e(__('frontend::auth.title')); ?></p>
    </div>
    <div class="login-detail mb-0">
        <?php if(session()->has('error')): ?>
            <div class="alert alert-danger">
                <?php echo e(session()->get('error')); ?>

            </div>
        <?php endif; ?>
        <form action="<?php echo e(route('frontend.login')); ?>" method="POST" id="loginForm">
            <?php echo csrf_field(); ?>
            <?php echo method_field('POST'); ?>
            <div class="form-group">
                <label for="email"><?php echo e(__('frontend::auth.email')); ?></label>
                <div class="position-relative">
                    <i class="iconsax" icon-name="mail"></i>
                    <input class="form-control form-control-white" id="email" placeholder="<?php echo e(__('frontend::auth.enter_email')); ?>" name="email" type="email">
                </div>
                <?php $__errorArgs = ['email'];
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
            <div class="form-group">
                <label for="password"><?php echo e(__('frontend::auth.password')); ?></label>
                <div class="position-relative">
                    <i class="iconsax" icon-name="lock-2"></i>
                    <input class="form-control form-control-white pr-45" id="password" placeholder="<?php echo e(__('frontend::auth.enter_your_password')); ?>" name="password" type="password">
                    <div class="toggle-password">
                        <i class="iconsax eye" icon-name="eye"></i>
                        <i class="iconsax eye-slash" icon-name="eye-slash"></i>
                    </div>
                </div>
                <?php $__errorArgs = ['password'];
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
            <div class="forgot-pass">
                <a href="<?php echo e(route('frontend.forgot.index')); ?>"><?php echo e(__('frontend::auth.forgot_password')); ?> </a>
            </div>

            <button type="submit" class="btn btn-solid submit spinner-btn"><?php echo e(__('frontend::auth.login_now')); ?>

                <span class="spinner-border spinner-border-sm" style="display: none;"></span>
            </button>

            <div class="not-member">
                <span><?php echo e(__('frontend::auth.not_member')); ?></span>
                <a href="<?php echo e(route('frontend.register.index')); ?>"><?php echo e(__('frontend::auth.signup')); ?></a>
            </div>
        </form>
        <?php if(isset($settings['activation']['default_credentials'])): ?>
            <?php if($settings['activation']['default_credentials']): ?>
                <div class="demo-credential">
                    <button class="btn btn-outline default-credentials" data-email="user@example.com">User</button>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="other-options">
        <span class="options"><?php echo e(__('frontend::auth.or_continue_with')); ?></span>
        <ul class="social-media">
            <?php if($settings['activation']['social_login_enable'] == 1): ?>
                <li>
                    <a href="<?php echo e(route('frontend.redirectToProvider', ['provider' => 'google'])); ?>" target="_blank"
                        class="social-icon">
                        <img src="<?php echo e(asset('frontend/images/social/google.png')); ?>" alt="google">
                    </a>
                </li>
            <?php endif; ?>
            <li>
                <a href="<?php echo e(route('frontend.login.number')); ?>" target="_blank" class="social-icon">
                    <img src="<?php echo e(asset('frontend/images/social/mobile.png')); ?>" alt="mobile">
                </a>
            </li>
        </ul>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $("#loginForm").validate({
                    ignore: [],
                    rules: {
                        "email": {
                            required: true,
                            email: true
                        },
                        "password": {
                            required: true
                        },
                    }
                });

                $(".default-credentials").click(function() {
                    $("#email").val("");
                    $("#password").val("");
                    var email = $(this).data("email");
                    $("#email").val(email);
                    $("#password").val("123456789");
                });

            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.auth.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/haykshahinyan/Projects/Direlli/Full/fixit_laravel/resources/views/frontend/auth/login.blade.php ENDPATH**/ ?>