<?php use \app\Helpers\Helpers; ?>
<?php use \App\Enums\SymbolPositionEnum; ?>

<?php
$isCouponEnabled = Helpers::couponIsEnable();
?>

<?php $__env->startSection('title', __('frontend::static.bookings.my_cart')); ?>

<?php $__env->startSection('breadcrumb'); ?>
<nav class="breadcrumb breadcrumb-icon">
    <a class="breadcrumb-item" href="<?php echo e(url('/')); ?>"><?php echo e(__('frontend::static.bookings.home')); ?></a>
    <span class="breadcrumb-item active"><?php echo e(__('frontend::static.bookings.my_cart')); ?></span>
</nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Service List Section Start -->
<section class="section-b-space service-list-section">
    <div class="container-fluid-lg">
        <div class="row g-3">
            <div class="col-xxl-8 col-xl-7 col-12">
                <div class="cart br-10 br-br-0 br-bl-0">
                    <div class="cart-header">
                        <h3 class="mb-0 f-w-600"><?php echo e(__('frontend::static.cart.added_items_details')); ?></h3>
                        <?php if(count($cartItems ?? [])): ?>
                        <span><?php echo e(count($cartItems ?? [])); ?> <?php echo e(__('frontend::static.cart.items_in_cart')); ?></span>
                        <?php endif; ?>
                    </div> 
                    <div class="cart-body">
                        <div class="cart-items">
                            <?php $__empty_1 = true; $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceBooking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                            $isPackageBooking = isset($serviceBooking['service_packages']);
                            $service = $isPackageBooking ? $serviceBooking['service_packages']['services'] :
                            $serviceBooking;
                            $services[] = $service;
                            ?>
                            <?php if(isset($serviceBooking['service_id'])): ?>
                            <?php
                            // Fetch service and provider details
                            $service = Helpers::getServiceById($serviceBooking['service_id']);
                            $provider = Helpers::getProviderById($service?->user_id);
                            ?>
                            <div class="cart-item">
                                <div class="cart-heading">
                                    <div class="cart-title">
                                <?php
                                    $media = $provider?->media->first();
                                ?>
                                
                                <?php if($media): ?>
                                    <img src="<?php echo e($media->getUrl()); ?>"
                                        alt="<?php echo e($provider->name); ?>" class="img-45">
                                <?php else: ?>
                                    <div class="avatar-placeholder img-45">
                                        <?php echo e(strtoupper(substr($provider?->name, 0, 1))); ?>

                                    </div>
                                <?php endif; ?>
                                        <div>
                                            <a href="<?php echo e(route('frontend.provider.details', $provider->slug)); ?>"
                                                target="_blank">
                                                <p class="mb-1"><?php echo e($provider?->name); ?></p>
                                            </a>
                                            <div class="rate">
                                                <img src="<?php echo e(asset('frontend/images/svg/star.svg')); ?>" alt="star"
                                                    class="img-fluid star">
                                                <small><?php echo e($provider?->review_ratings ?? 'Unrated'); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cart-action">
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#bookServiceModal-<?php echo e($service->id); ?>">
                                            <i class="iconsax edit d-flex" icon-name="edit-2"></i>
                                        </button>
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#deleteCartModel-<?php echo e($serviceBooking['service_id']); ?>">
                                            <i class="iconsax delete d-flex" icon-name="trash"></i>
                                        </button>
                                    </div>
                                    <?php if ($__env->exists('frontend.inc.modal', ['service' => $service])) echo $__env->make('frontend.inc.modal', ['service' => $service], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                </div>
                                <div class="cart-detail">
                                    <div class="selected-service pb-0 border-bottom-0">
                                        <img src="<?php echo e($service?->web_img_thumb_url); ?>" alt="service" class="br-10 selected-img">
                                        <div class="service-info">
                                            <div class="d-flex flex-xxl-row flex-column align-items-xxl-center align-items-start justify-content-between gap-1">
                                                <div class="d-flex align-items-center gap-2">
                                                    <h3><?php echo e($service?->title); ?></h3>
                                                    <?php if($service?->discount): ?>
                                                        <small class="discount">(<?php echo e($service?->discount); ?>%<?php echo e(__('frontend::static.cart.off')); ?>)</small>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>
                                                    <span class="price"><?php echo e(Helpers::getDefaultCurrencySymbol()); ?><?php echo e(Helpers::covertDefaultExchangeRate($service->service_rate)); ?></span>
                                                <?php else: ?>
                                                    <span class="price"><?php echo e(Helpers::covertDefaultExchangeRate($service->service_rate)); ?> <?php echo e(Helpers::getDefaultCurrencySymbol()); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap gap-2 mt-2">
                                                <p><?php echo e(__('frontend::static.bookings.date_time')); ?></p>
                                                <ul class="date">
                                                    <li class="d-flex align-items-center gap-1">
                                                        <i class="iconsax" icon-name="calendar-1"></i>
                                                        <span><?php echo e(\Carbon\Carbon::parse($serviceBooking['date_time'])->format('j F, Y')); ?></span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-1">
                                                        <i class="iconsax" icon-name="clock"></i>
                                                        <span><?php echo e(\Carbon\Carbon::parse($serviceBooking['date_time'])->format('g:i A')); ?></span>
                                                    </li>
                                                </ul>
                                            </div>

                                            <span class="addons-title"> Addons: 1 </span>

                                            <ul class="date-time pt-3">
                                                <li class="w-100 lh-1">
                                                    <span><?php echo e(__('frontend::static.cart.selected_servicemen')); ?></span>
                                                    <?php if(isset($serviceBooking['required_servicemen'])): ?>
                                                    <small
                                                        class="text-primary"><?php echo e($serviceBooking['required_servicemen']); ?>

                                                        <?php echo e(__('frontend::static.cart.servicemen')); ?></small>
                                                    <?php endif; ?>
                                                </li>
                                            </ul>
                                            <div class="dashed-border mt-3"></div>
                                            <?php if($serviceBooking['select_serviceman'] = 'as_per_my_choice'): ?>
                                            <?php if(!empty($serviceBooking['serviceman_id'])): ?>
                                            <?php
                                            $servicemenIds = explode(',', $serviceBooking['serviceman_id']);
                                            $servicemen = Helpers::getUsersByIds($servicemenIds ?? []);
                                            ?>
                                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                                <?php $__empty_2 = true; $__currentLoopData = $servicemen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceman): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                                <div class="servicemen-list-item">
                                                    <div class="list">
                                                        <img src="<?php echo e($serviceman?->media->first()->getUrl()); ?>"
                                                            alt="feature" class="img-45">
                                                        <div>
                                                            <p><?php echo e(__('frontend::static.cart.servicemen')); ?></p>
                                                            <ul>
                                                                <li>
                                                                    <h5><?php echo e($serviceman?->name); ?></h5>
                                                                </li>
                                                                <li>
                                                                    <div class="rate">
                                                                        <img src="<?php echo e(asset('frontend/images/svg/star.svg')); ?>"
                                                                            alt="star" class="img-fluid star">
                                                                        <small><?php echo e($serviceman?->review_ratings ?? 'Unrated'); ?></small>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                                <div class="no-data-found">
                                                    <p><?php echo e(__('frontend::static.cart.servicemen_not_found')); ?></p>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                            <?php endif; ?>
                                            <?php elseif($serviceBooking['select_serviceman'] = 'app_choose'): ?>
                                            <div class="note m-0">
                                                <p class="mt-1">
                                                    <?php echo e(__('frontend::static.cart.app_choose_note')); ?>

                                                </p>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <?php if(!empty($serviceBooking['additional_services'])): ?>
                                        <div class="addons">
                                            <h4><?php echo e(__('frontend::static.bookings.add_ons')); ?></h4>
                                            <ul class="addon-list">
                                                <?php $__currentLoopData = $serviceBooking['additional_services']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addOn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $additionalService = Helpers::getAdditionalServiceById($addOn['id']);
                                                        $addOnTotalPrice = $additionalService->price * $addOn['qty'];
                                                        $addonPrice = Helpers::covertDefaultExchangeRate($addOnTotalPrice);
                                                    ?>
                                                    <li class="d-flex justify-content-between">
                                                        <span><?php echo e($additionalService->title); ?> :</span>
                                                        <?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>
                                                            <span><?php echo e(Helpers::getDefaultCurrencySymbol()); ?><?php echo e(number_format($addonPrice, 2)); ?></span>
                                                        <?php else: ?>
                                                            <span><?php echo e(number_format($addonPrice, 2)); ?> <?php echo e(Helpers::getDefaultCurrencySymbol()); ?></span>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php elseif($serviceBooking['service_packages']): ?>
                            <?php if(isset($serviceBooking['service_packages']['service_package_id'])): ?>
                            <?php
                            $id = $serviceBooking['service_packages']['service_package_id'];
                            $servicePackage = Helpers::getServicePackageById($id)
                            ?>
                            <div class="cart-item">
                                <div class="cart-heading">
                                    <div class="cart-title">
                                        <img src="<?php echo e($servicePackage?->user?->media?->first()?->getUrl()); ?>"
                                            alt="<?php echo e($servicePackage?->user?->name); ?>" class="img-45">
                                        <div>
                                            <a href="<?php echo e(route('frontend.provider.details', $servicePackage?->user?->slug)); ?>"
                                                target="_blank">
                                                <p class="mb-1"><?php echo e($servicePackage?->user?->name); ?></p>
                                            </a>
                                            <div class="rate">
                                                <img src="<?php echo e(asset('frontend/images/svg/star.svg')); ?>" alt="star"
                                                    class="img-fluid star">
                                                <small><?php echo e($servicePackage?->user?->review_ratings ?? 'Unrated'); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cart-action">
                                        <a href="<?php echo e(route('frontend.booking.service-package', $servicePackage?->slug)); ?>">
                                            <i class="iconsax edit d-flex" icon-name="edit-2"></i>
                                        </a>
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#deleteCartModel-<?php echo e($servicePackage->id); ?>">
                                            <i class="iconsax delete d-flex" icon-name="trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="cart-detail">
                                    <div class="selected-service">
                                        
                                        <svg class="br-10 selected-img">
                                            <use xlink:href="<?php echo e(asset('frontend/images/svg/service-package.svg#service-package')); ?>"></use>
                                        </svg>
                                        <div class="service-info">
                                            <div
                                                class="d-flex flex-xxl-row flex-column align-items-xxl-center align-items-start justify-content-between gap-1">
                                                <div class="d-flex align-items-center gap-2">
                                                    <h3><?php echo e($servicePackage?->title); ?></h3>
                                                    <?php if($servicePackage?->discount): ?>
                                                    <small class="discount">(<?php echo e($servicePackage?->discount); ?>%
                                                        <?php echo e(__('frontend::static.cart.off')); ?>)</small>
                                                    <?php endif; ?>
                                                </div>
                                                <?php
                                                    $salePrice = Helpers::getServicePackageSalePrice($servicePackage?->id)
                                                ?>
                                                <?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>
                                                    <span class="price"><?php echo e(Helpers::getDefaultCurrencySymbol()); ?><?php echo e(Helpers::covertDefaultExchangeRate($salePrice)); ?></span>
                                                <?php else: ?>
                                                    <span class="price"><?php echo e(Helpers::covertDefaultExchangeRate($salePrice)); ?> <?php echo e(Helpers::getDefaultCurrencySymbol()); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <?php if(count($serviceBooking['service_packages']['services'])): ?>
                                                <ul class="date-time pt-1">
                                                    <li class="w-100 lh-1">
                                                        <span>Included services :</span>
                                                        <small class="text-primary"><?php echo e(count($serviceBooking['service_packages']['services'])); ?> services</small>
                                                    </li>
                                                </ul>
                                            <?php endif; ?>
                                            <h5>
                                                <?php echo e(__('frontend::static.cart.description')); ?>

                                            </h5>
                                            <p><?php echo e($servicePackage?->description); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="no-cart-found no-cart-data text-center">
                                <h3><?php echo e(__('frontend::static.cart.nothing_added')); ?></h3>
                                <p class="text-light"><?php echo e(__('frontend::static.cart.nothing_added_note')); ?></p>
                                <a href="<?php echo e(route('frontend.service.index')); ?>" class="btn btn-solid d-inline-block w-auto mt-4">Explore
                                Services</a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(count(@$cartItems?? [])): ?>
            <div class="col-xxl-4 col-xl-5 col-12">
                <div class="position-sticky mb-0">
                    <div class="cart br-10 br-br-0 br-bl-0">
                        <div class="cart-header">
                            <h3 class="mb-0 f-w-600"><?php echo e(__('frontend::static.cart.payment_summary')); ?></h3>
                        </div>
                        <div class="cart-body">
                            <?php if($isCouponEnabled): ?>
                            <?php
                                $isCouponApplied = (session()?->has('coupon') && $checkout['total']['coupon_total_discount']);
                            ?>
                            <?php if(isset($checkout['total']['coupon_total_discount'])): ?>
                            <h5 class="mb-2 d-flex align-items-center justify-content-between"><?php echo e(__('frontend::static.cart.applied_discount')); ?>

                                <a href="#couponModal" data-bs-toggle="modal" class="ms-auto"><?php echo e(__('frontend::static.cart.view_all')); ?></a>
                            </h5>
                            <form id="applyCouponForm" class="apply-coupon-form" method="POST" action="<?php echo e(route('frontend.coupon.handle')); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="input-group">
                                    <div class="coupon-input-box">
                                        <input type="text" id="couponInput" name="coupon" placeholder="Enter code"
                                        class="form-control form-control-white text-start text-muted <?php echo e(($isCouponApplied)? 'pattern-input' : ''); ?>"
                                        value="<?php echo e(session('coupon', old('coupon'))); ?>">
                                    </div>

                                    <?php if(!$isCouponApplied): ?>
                                    <button type="submit" class="pattern-btn spinner-btn" id="applyCouponBtn">
                                        <span class="text-btn"><?php echo e(__('frontend::static.cart.apply')); ?></span>
                                        <span class="spinner-border spinner-border-sm text-light" id="applySpinner" style="display:none;"></span> 
                                    </button>
                                    <?php else: ?>
                                      <!-- Remove Coupon Button -->
                                      <button type="submit" id="removeCouponBtn"  name="removeCouponBtn" class="pattern-btn-1 spinner-btn">
                                        <span><?php echo e(__('frontend::static.cart.remove')); ?></span>
                                      </button>
                                      <span class="spinner-border spinner-border-sm text-light" id="applySpinner" style="display:none;"></span> 

                                      <input type="hidden" name="remove_coupon" value="1" id="removeCouponField" style="display:none;">
                                    <?php endif; ?>
                                </div>
                                <?php $__errorArgs = ['coupon'];
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
                            </form>
                            <div id="couponMessage"></div>
                            <?php if($checkout['total']['coupon_total_discount']): ?>
                            <div class="mt-2">
                                <p class="mb-1 d-flex align-items-center gap-1 text-success">
                                    <img src="<?php echo e(asset('frontend/images/svg/coupon.svg')); ?>" alt="" class="img-20">
                                    <?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>    
                                        <?php echo e(__('frontend::static.cart.hurray_you_saved')); ?>

                                        <?php echo e(Helpers::getDefaultCurrencySymbol()); ?><?php echo e(Helpers::covertDefaultExchangeRate($checkout['total']['coupon_total_discount'])); ?> <?php echo e(__('frontend::static.cart.with_this_coupon')); ?>

                                        #<?php echo e(session('coupon')); ?>.
                                    <?php else: ?>
                                        <?php echo e(__('frontend::static.cart.hurray_you_saved')); ?>

                                        <?php echo e(Helpers::covertDefaultExchangeRate($checkout['total']['coupon_total_discount'])); ?> <?php echo e(Helpers::getDefaultCurrencySymbol()); ?> <?php echo e(__('frontend::static.cart.with_this_coupon')); ?>

                                        #<?php echo e(session('coupon')); ?>.                                        
                                    <?php endif; ?>
                                </p>
                                <p class="ps-3 text-success">(<?php echo e(__('frontend::static.cart.coupon_already_applied_in_subtotal')); ?>)</p>
                            </div>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php endif; ?>
                            <div class="bill-summary mt-4">
                                <?php if($checkout): ?>
                                <ul class="charge">
                                    <?php if(isset($checkout['services'])): ?>
                                    <?php $__currentLoopData = $checkout['services']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    $service = Helpers::getServiceById($serviceItem['service_id']);
                                    ?>
                                    <li>
                                        <p><?php echo e($service?->title); ?>

                                            <button type="button" class="service-info-modal" data-bs-toggle="modal"
                                                data-bs-target="#serviceCharge-<?php echo e($serviceItem['service_id']); ?>">
                                                <i class="iconsax" icon-name="info-circle"></i>
                                            </button>
                                        </p>
                                        <?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>
                                            <span><?php echo e(Helpers::getDefaultCurrencySymbol()); ?><?php echo e(Helpers::covertDefaultExchangeRate($service->service_rate)); ?></span>
                                        <?php else: ?>
                                            <span><?php echo e(Helpers::covertDefaultExchangeRate($service->service_rate)); ?> <?php echo e(Helpers::getDefaultCurrencySymbol()); ?></span>
                                        <?php endif; ?>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    <?php if(isset($checkout['services_package'])): ?>
                                        <?php $__currentLoopData = $checkout['services_package']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicePackageItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $servicePackage =
                                                Helpers::getServicePackageById($servicePackageItem['service_package_id']);
                                                $salePrice = Helpers::getServicePackageSalePrice($servicePackage?->id)
                                            ?>
                                            <?php if($servicePackage): ?>
                                            <li>
                                                <p><?php echo e($servicePackage?->title); ?>

                                                    <button type="button" class="service-info-modal">
                                                    </button>
                                                </p>
                                                <?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>
                                                    <span><?php echo e(Helpers::getDefaultCurrencySymbol()); ?><?php echo e(Helpers::covertDefaultExchangeRate($salePrice)); ?></span>
                                                <?php else: ?>
                                                    <span><?php echo e(Helpers::covertDefaultExchangeRate($salePrice)); ?> <?php echo e(Helpers::getDefaultCurrencySymbol()); ?></span>
                                                <?php endif; ?>
                                            </li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    <?php if($checkout['total']['coupon_total_discount']): ?>
                                        <li>
                                            <p><?php echo e(__('frontend::static.cart.coupon_discount')); ?></p>
                                            <?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>
                                                <span class="text-success">-<?php echo e(Helpers::getDefaultCurrencySymbol()); ?><?php echo e(Helpers::covertDefaultExchangeRate($checkout['total']['coupon_total_discount'])); ?></span>
                                            <?php else: ?>
                                                <span class="text-success">-<?php echo e(Helpers::covertDefaultExchangeRate($checkout['total']['coupon_total_discount'])); ?> <?php echo e(Helpers::getDefaultCurrencySymbol()); ?></span>
                                            <?php endif; ?>
                                        </li>
                                    <?php endif; ?>
                                    <li>
                                        <p><?php echo e(__('frontend::static.cart.subtotal')); ?></p>
                                        <?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>
                                            <span><?php echo e(Helpers::getDefaultCurrencySymbol()); ?><?php echo e(Helpers::covertDefaultExchangeRate($checkout['total']['subtotal'])); ?></span>
                                        <?php else: ?>
                                            <span><?php echo e(Helpers::covertDefaultExchangeRate($checkout['total']['subtotal'])); ?> <?php echo e(Helpers::getDefaultCurrencySymbol()); ?></span>
                                        <?php endif; ?>
                                    </li>
                                    <li>
                                        <p><?php echo e(__('frontend::static.cart.tax')); ?></p>
                                        <?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>
                                            <span><?php echo e(Helpers::getDefaultCurrencySymbol()); ?><?php echo e(Helpers::covertDefaultExchangeRate($checkout['total']['tax'])); ?></span>
                                        <?php else: ?>
                                            <span><?php echo e(Helpers::covertDefaultExchangeRate($checkout['total']['tax'])); ?> <?php echo e(Helpers::getDefaultCurrencySymbol()); ?></span>
                                        <?php endif; ?>
                                    </li>
                                    <li>
                                        <p><?php echo e(__('frontend::static.cart.platform_fees')); ?></p>
                                        <?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>
                                            <span><?php echo e(Helpers::getDefaultCurrencySymbol()); ?><?php echo e(Helpers::covertDefaultExchangeRate($checkout['total']['platform_fees'])); ?></span>
                                        <?php else: ?>
                                            <span><?php echo e(Helpers::covertDefaultExchangeRate($checkout['total']['platform_fees'])); ?> <?php echo e(Helpers::getDefaultCurrencySymbol()); ?></span>
                                        <?php endif; ?>
                                    </li>
                                    
                                </ul>
                                <ul class="total">
                                    <li>
                                        <p><?php echo e(__('frontend::static.cart.total_amount')); ?></p>
                                        <?php if($checkout['total']['total']): ?>
                                            <span><?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>
                                                <?php echo e(Helpers::getDefaultCurrencySymbol()); ?><?php echo e(Helpers::covertDefaultExchangeRate($checkout['total']['total'])); ?>

                                            <?php else: ?>
                                                <?php echo e(Helpers::covertDefaultExchangeRate($checkout['total']['total'])); ?><?php echo e(Helpers::getDefaultCurrencySymbol()); ?>

                                            <?php endif; ?></span>
                                        <?php elseif(isset($checkout['total']['total'])): ?>
                                            <span><?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>
                                                <?php echo e(Helpers::getDefaultCurrencySymbol()); ?>0
                                            <?php else: ?>
                                                0 <?php echo e(Helpers::getDefaultCurrencySymbol()); ?>

                                            <?php endif; ?></span>
                                        <?php endif; ?>
                                    </li>
                                </ul>
                                <?php else: ?>
                                <div class="text-center">
                                    <div class="cart-img my-5">
                                        <img src="<?php echo e(asset('frontend/images/cart/1.png')); ?>" alt="no cart">
                                    </div>
                                    <div class="no-cart-found">
                                        <h3><?php echo e(__('frontend::static.cart.nothing_added')); ?></h3>
                                        <p class="text-light"><?php echo e(__('frontend::static.cart.nothing_added_note')); ?></p>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php if(count($checkout['services'] ?? [])): ?>
                            <div class="dashed-border"></div>
                            <div class="note">
                                <label><?php echo e(__('frontend::static.cart.disclaimer')); ?></label>
                                <p class="text-danger m-0"><?php echo e(__('frontend::static.cart.disclaimer_note')); ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if(isset($checkout['total']['total'])): ?>
                    <div class="view">
                        <div class="d-flex align-items-center justify-content-between gap-1">
                            <span><?php echo e(__('frontend::static.cart.total')); ?></span>
                            <small class="value">
                                <?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>
                                    <?php echo e(Helpers::getDefaultCurrencySymbol()); ?><?php echo e(Helpers::covertDefaultExchangeRate($checkout['total']['total'])); ?>

                                <?php else: ?>
                                    <?php echo e(Helpers::covertDefaultExchangeRate($checkout['total']['total'])); ?> <?php echo e(Helpers::getDefaultCurrencySymbol()); ?>

                                <?php endif; ?>
                            </small>
                        </div>
                        <a href="<?php echo e(route('frontend.payment.index')); ?>" class="btn btn-solid mt-3">
                            <?php echo e(__('frontend::static.cart.proceed_to_checkout')); ?>

                            <i class="iconsax" icon-name="chevron-right"></i>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- Book Service Modal -->

<!-- Coupon modal -->
<?php if($isCouponEnabled): ?>
<div class="modal fade coupon-modal" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="couponModalLabel"><?php echo e(__('frontend::static.cart.coupons')); ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="coupon-list custom-scroll">
                    <?php
                    $coupons = Helpers::getCoupons();
                    ?>
                    <?php $__empty_1 = true; $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="coupon-item">
                        <div class="coupon-content">
                            <div>
                                <h5>
                                    <?php echo e(__('frontend::static.cart.spend')); ?>

                                    <?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>
                                        <?php echo e(Helpers::getDefaultCurrencySymbol()); ?><?php echo e($coupon?->min_spend); ?>

                                    <?php else: ?>
                                        <?php echo e($coupon?->min_spend); ?> <?php echo e(Helpers::getDefaultCurrencySymbol()); ?>

                                    <?php endif; ?>
                                    <?php echo e(__('frontend::static.cart.amount')); ?>

                                </h5>
                                <p>
                                    <?php echo e(__('frontend::static.cart.use_code')); ?>

                                    <span>#<?php echo e($coupon?->code); ?></span>
                                     spend 
                                     <?php if($coupon?->type == 'fixed'): ?>
                                         <?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>
                                           <?php echo e(Helpers::getDefaultCurrencySymbol()); ?><?php echo e($coupon?->amount); ?>  
                                         <?php else: ?>
                                             <?php echo e($coupon?->amount); ?> <?php echo e(Helpers::getDefaultCurrencySymbol()); ?>

                                         <?php endif; ?>
                                     <?php else: ?>
                                         <?php echo e($coupon?->amount); ?>%
                                     <?php endif; ?><?php echo e(__('frontend::static.cart.off_real_price')); ?></p>
                            </div>
                            <span class="percent">
                                <?php if($coupon?->type == 'fixed'): ?>
                                    <?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>
                                        <?php echo e(Helpers::getDefaultCurrencySymbol()); ?><?php echo e($coupon?->amount); ?>

                                    <?php else: ?>
                                        <?php echo e($coupon?->amount); ?> <?php echo e(Helpers::getDefaultCurrencySymbol()); ?>

                                    <?php endif; ?>   
                                <?php else: ?>
                                    <?php echo e($coupon?->amount); ?>%
                                <?php endif; ?><?php echo e(__('frontend::static.cart.off')); ?></span>
                        </div>
                        <div class="circle"></div>
                        <div class="coupon-footer">
                            <p><?php echo e(__('frontend::static.cart.valid_till')); ?><span><?php echo e(\Carbon\Carbon::parse($coupon?->end_date)->format('j F, Y')); ?></span>
                            </p>
                            <!-- Add data-coupon to the 'Use Code' button -->
                            <a href="javascript:void(0)" id="useCode" class="use-code"
                                data-coupon="<?php echo e($coupon?->code); ?>">
                                <span class="d-sm-inline-block d-none"><?php echo e(__('frontend::static.cart.use_code')); ?></span>
                                <i class="iconsax" icon-name="arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p> <?php echo e(__('frontend::static.cart.coupon_not_found')); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>

<?php if(isset($checkout['services'])): ?>
<!-- service info modal -->
<?php $__currentLoopData = $checkout['services']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceCheckout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
    $service = Helpers::getServiceById($serviceCheckout['service_id']);
?>
<div class="modal fade service-charge-modal" id="serviceCharge-<?php echo e($serviceCheckout['service_id']); ?>" tabindex="-1" aria-labelledby="serviceChargeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="serviceChargeLabel"><?php echo e($service?->title); ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="bill-summary">
                    <ul class="charge">
                        <?php
                            $perServicemenCharge = Helpers::covertDefaultExchangeRate($serviceCheckout['per_serviceman_charge']);
                            $reqServicemen = $checkout['total']['required_servicemen'];
                            $totalAmount = $perServicemenCharge*$reqServicemen;

                            // Calculate additional services total
                            $additionalTotal = 0;
                            $additionalCount = 0;
                            if (!empty($serviceCheckout['additional_services'])) {
                                foreach ($serviceCheckout['additional_services'] as $addOn) {
                                    $additionalService = Helpers::getAdditionalServiceById($addOn['id']);
                                    $addOnTotalPrice = $additionalService->price * $addOn['qty']; 
                                    $additionalTotal += Helpers::covertDefaultExchangeRate($addOnTotalPrice);
                                    $additionalCount++;
                                }
                            }
                        ?>
                        <li>
                            <p><?php echo e(__('frontend::static.cart.per_serviceman_charge')); ?></p>
                             <?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>
                                <?php echo e(Helpers::getDefaultCurrencySymbol()); ?><?php echo e($perServicemenCharge); ?>

                            <?php else: ?>
                                <?php echo e($perServicemenCharge); ?> <?php echo e(Helpers::getDefaultCurrencySymbol()); ?>

                            <?php endif; ?> 
                        </li>
                        <li>
                            <p><?php echo e($checkout['total']['required_servicemen']); ?> <?php echo e(__('frontend::static.cart.servicemen')); ?>

                                 ( 
                                    <?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>
                                        <?php echo e(Helpers::getDefaultCurrencySymbol()); ?><?php echo e($perServicemenCharge); ?>*<?php echo e($reqServicemen); ?>

                                    <?php else: ?>
                                        <?php echo e($perServicemenCharge); ?><?php echo e($reqServicemen); ?> <?php echo e(Helpers::getDefaultCurrencySymbol()); ?>

                                    <?php endif; ?>
                                )
                            </p>
                            <?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>
                                <?php echo e(Helpers::getDefaultCurrencySymbol()); ?><?php echo e($totalAmount); ?>

                            <?php else: ?>
                                <?php echo e($totalAmount); ?> <?php echo e(Helpers::getDefaultCurrencySymbol()); ?>

                            <?php endif; ?>
                        </li>
                        <?php if($additionalCount > 0): ?>
                            <li>
                                <p><?php echo e($additionalCount); ?> <?php echo e(__('frontend::static.cart.add_ons')); ?></p>
                                <?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>
                                    <span><?php echo e(Helpers::getDefaultCurrencySymbol()); ?><?php echo e(number_format($additionalTotal, 2)); ?></span>
                                <?php else: ?>
                                    <span><?php echo e(number_format($additionalTotal, 2)); ?> <?php echo e(Helpers::getDefaultCurrencySymbol()); ?></span>
                                <?php endif; ?> 
                            </li>
                        <?php endif; ?>
                    </ul>
                    <ul class="total">
                        <?php
                            $grandTotal = $checkout['total']['total_serviceman_charge'] + $additionalTotal;
                        ?>
                        <li>
                            <p><?php echo e(__('frontend::static.cart.total_amount')); ?></p>
                            <?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>
                                <span><?php echo e(Helpers::getDefaultCurrencySymbol()); ?><?php echo e($grandTotal); ?></span>
                            <?php else: ?>
                                <span><?php echo e($grandTotal); ?> <?php echo e(Helpers::getDefaultCurrencySymbol()); ?></span>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<?php $__currentLoopData = $serviceBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceBooking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!-- Delete service cart modal -->
<div class="modal fade delete-modal" id="deleteCartModel-<?php echo e($serviceBooking['service_id']); ?>">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            <div class="modal-body text-center">
                <i class="iconsax modal-icon" icon-name="trash"></i>
                <h3>Delete Item? </h3>
                <p class="mx-auto">
                <?php echo e(__('frontend::static.cart.remove_service_from_cart')); ?>

                </p>
            </div>
            <form action="<?php echo e(route('frontend.cart.remove')); ?>" method="post">
                <?php echo method_field('POST'); ?>
                <div class="modal-footer">
                    <input type="hidden" name="service_id" value="<?php echo e($serviceBooking['service_id']); ?>" />
                    <button type="button" class="btn btn-outline"
                        data-bs-dismiss="modal"><?php echo e(__('frontend::static.cart.no')); ?></button>
                    <button type="submit" class="btn btn-solid"
                        data-bs-toggle="modal"
                        data-bs-target="#successfullyDeleteaddressModel"><?php echo e(__('frontend::static.cart.yes')); ?>

                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>
(function($) {
    "use strict";

    $(document).ready(function() {

        // Form validation setup
        $("#applyCouponForm").validate({
        ignore: [],
        rules: {
            "coupon": {
                required: true, 
            }
        },
        messages: {
            "coupon": {
                required: "Please enter a coupon code" 
            }
        },
        errorPlacement: function(error, element) {
            $('#couponMessage').html('<span class="invalid-feedback d-block" role="alert"><strong>' + error.text() + '</strong></span>');
        },
        submitHandler: function(form) {
            applyCoupon(form);
        },
    });

    // Trigger form submission for apply coupon (AJAX)
    function applyCoupon(form) {
        
        var formData = $(form).serialize();
        var actionUrl = $(form).attr('action');

        // Show spinner and disable the button
        var $btn = $('#applyCouponBtn');
        var $spinner = $btn.find('.spinner-border');
        $btn.prop('disabled', true).text('');
        $spinner.show();

        // Send AJAX request to handle the coupon
        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            success: function(response) {
                // Toggle button visibility based on response
                if (response.status === 'success') {
                    $('#applyCouponBtn').toggle();
                    $('#removeCouponBtn').toggle();
                    $('#couponMessage').html('<div class="alert alert-success">' + response.message + '</div>');
                    location.reload();
                }else {
                    $('#couponMessage').html('<div class="text-danger">' + response.message + '</div>');
                }
            },
            error: function() {
                $('#couponMessage').html('<div class="alert alert-danger">Something went wrong. Please try again.</div>');
                $spinner.hide();
            },
            complete: function() {
                $spinner.hide();
                $btn.text($btn.data('original-text')); // Restore original text
            }
        });

        $spinner.hide();
    }

    // Store original button text for later restoration
    $('#applyCouponBtn').data('original-text', $('#applyCouponBtn').text());

        $('#couponModal').on('click', '.use-code', function() {
            var couponCode = $(this).data('coupon').replace(/^#/, ''); // Remove '#' if it exists
            $('#couponInput').val(couponCode); // Set the coupon code into the input field

            if ($("#applyCouponForm").valid()) {
                $('#applyCouponForm').submit(); // Submit the form
                $('#couponModal').modal('hide'); // Close the modal
            }
        });

    });
})(jQuery);
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/haykshahinyan/Projects/Direlli/Full/fixit_laravel/resources/views/frontend/cart/index.blade.php ENDPATH**/ ?>