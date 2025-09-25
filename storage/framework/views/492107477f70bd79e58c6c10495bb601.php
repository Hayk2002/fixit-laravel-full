<?php use \app\Helpers\Helpers; ?>
<?php use \App\Enums\AdvertisementTypeEnum; ?>
<?php use \App\Enums\ServiceTypeEnum; ?>
<?php use \App\Enums\SymbolPositionEnum; ?>

<?php    
    $homePage = Helpers::getCurrentHomePage();
    $categories = $categories->paginate($themeOptions['pagination']['categories_per_page'] ?? null);
    $categoryPageAdvertiseBanners = Helpers::getCategoryPageAdvertiseBanners();
    $advertiseServices = Helpers::getCategoryPageAdvertiseServices();
?>


<?php $__env->startSection('title', __('frontend::static.categories.categories')); ?>

<?php $__env->startSection('breadcrumb'); ?>
<nav class="breadcrumb breadcrumb-icon">
    <a class="breadcrumb-item" href="<?php echo e(url('/')); ?>"><?php echo e(__('frontend::static.categories.home')); ?></a>
    <span class="breadcrumb-item active"><?php echo e(__('frontend::static.categories.categories')); ?></span>
</nav>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class=" pt-0 content-b-space">

    <!-- Today Special Offers Section Start -->
    <?php if(count($categoryPageAdvertiseBanners)): ?>    
    <section class="offer-section section-b-space">
        <div class="container-fluid-lg">
            <div class="title">
                <h2><?php echo e($homePage['special_offers_section']['banner_section_title'] ? $homePage['special_offers_section']['banner_section_title'] : __('Today special offers')); ?></h2>
            </div>

            <div class="offer-banner-slider">
                <?php $__currentLoopData = $categoryPageAdvertiseBanners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($banner->banner_type === AdvertisementTypeEnum::IMAGE): ?>
                        <?php $__currentLoopData = $banner->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('frontend.provider.details', $banner?->provider?->slug)); ?>">
                                <div>
                                    <div class="offer-banner">
                                        <img class="img-fluid banner-img" src="<?php echo e(Helpers::isFileExistsFromURL($media?->getUrl(), true)); ?>" />
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <?php if($banner->banner_type === AdvertisementTypeEnum::VIDEO): ?>
                        <iframe width="560" height="315" src="<?php echo e($banner->video_link); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <!-- Today Special Offers Section End -->

    <!-- Special Offer In Service Section Start -->
    <?php if(count($advertiseServices)): ?>
    <section class="service-list-section section-bg section-b-space">
        <div class="container-fluid-lg">
            <div class="title">
                <h2><?php echo e($homePage['special_offers_section']['service_section_title'] ? $homePage['special_offers_section']['service_section_title'] : __('Today special offers')); ?></h2>
            </div>
            <div class="service-list-content">
                <div class="feature-slider">
                    <?php $__currentLoopData = $advertiseServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advertisement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $advertisement->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div>
                                <div class="card">
                                    <?php if($service->discount): ?>
                                        <div class="discount-tag"><?php echo e($service->discount); ?>%</div>
                                    <?php endif; ?>
                                    <div class="overflow-hidden b-r-5">
                                        <a href="<?php echo e(route('frontend.service.details', $service?->slug)); ?>"
                                            class="card-img">
                                            <span class="ribbon">Trending</span>
                                            <img src="<?php echo e($service?->web_img_thumb_url); ?>"
                                                alt="<?php echo e($service?->title); ?>" class="img-fluid lozad">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <div class="service-title">
                                            <h4>
                                                <a title="<?php echo e($service?->title); ?>"
                                                    href="<?php echo e(route('frontend.service.details', $service?->slug)); ?>"><?php echo e($service?->title); ?></a>
                                            </h4>
                                            <?php if($service->price || $service->service_rate): ?>
                                                <div class="d-flex align-items-center gap-1">
                                                    <?php if(!empty($service?->discount) && $service?->discount > 0): ?>
                                                        <span>
                                                            <?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>
                                                                <del><?php echo e(Helpers::getDefaultCurrencySymbol()); ?><?php echo e(Helpers::covertDefaultExchangeRate($service->price)); ?></del>
                                                            <?php else: ?>
                                                                <del><?php echo e(Helpers::covertDefaultExchangeRate($service->price)); ?> <?php echo e(Helpers::getDefaultCurrencySymbol()); ?></del>
                                                            <?php endif; ?>                                                        
                                                        </span>
                                                        <small>
                                                             <?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>
                                                                <?php echo e(Helpers::getDefaultCurrencySymbol()); ?><?php echo e(Helpers::covertDefaultExchangeRate($service->service_rate)); ?>

                                                            <?php else: ?>
                                                                <?php echo e(Helpers::covertDefaultExchangeRate($service->service_rate)); ?> <?php echo e(Helpers::getDefaultCurrencySymbol()); ?>

                                                            <?php endif; ?>
                                                        </small>
                                                    <?php else: ?>
                                                        <small>
                                                        <?php if(Helpers::getDefaultCurrency()->symbol_position === SymbolPositionEnum::LEFT): ?>
                                                            <?php echo e(Helpers::getDefaultCurrencySymbol()); ?><?php echo e(Helpers::covertDefaultExchangeRate($service->price)); ?>

                                                        <?php else: ?>
                                                            <?php echo e(Helpers::covertDefaultExchangeRate($service->price)); ?> <?php echo e(Helpers::getDefaultCurrencySymbol()); ?>

                                                        <?php endif; ?></small>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="service-detail mt-1">
                                            <div
                                                class="d-flex align-items-center justify-content-between gap-2 flex-wrap">
                                                <ul>
                                                    <?php if($service?->duration): ?>
                                                        <li class="time">
                                                            <i class="iconsax" icon-name="clock"></i>
                                                            <span><?php echo e($service?->duration); ?><?php echo e($service?->duration_unit === 'hours' ? 'h' : 'm'); ?></span>
                                                        </li>
                                                    <?php endif; ?>
                                                    <li class="w-auto service-person">
                                                        <img src="<?php echo e(asset('frontend/images/svg/services-person.svg')); ?>"
                                                            alt="">
                                                        <span><?php echo e($service->required_servicemen); ?></span>
                                                    </li>
                                                </ul>
                                                <h6 class="service-type  mt-2"><span><?php echo e(Helpers::formatServiceType($service?->type)); ?></span>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer border-top-0">
                                        <div class="footer-detail">
                                            <img src="<?php echo e(Helpers::isFileExistsFromURL($service?->user?->media?->first()?->getURL(), true)); ?>"
                                                alt="feature" class="img-fluid lozad">
                                            <div>
                                                <a href="<?php echo e(route('frontend.provider.details', ['slug' => $service?->user?->slug])); ?>">
                                                    <p title=" <?php echo e($service?->user?->name); ?> "> <?php echo e($service?->user?->name); ?></p>
                                                </a>
                                                <div class="rate">
                                                    <img data-src="<?php echo e(asset('frontend/images/svg/star.svg')); ?>"
                                                        alt="star" class="img-fluid star lozad">
                                                    <small><?php echo e($service?->user?->review_ratings ?? 'Unrated'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn book-now-btn btn-solid w-auto"
                                            id="bookNowButton" data-bs-toggle="modal"
                                            data-bs-target="#bookServiceModal-<?php echo e($service->id); ?>"
                                            data-login-url="<?php echo e(route('frontend.login')); ?>"
                                            data-check-login-url="<?php echo e(route('frontend.check.login')); ?>"
                                            data-service-id="<?php echo e($service->id); ?>">
                                            <?php echo e(__('frontend::static.home_page.book_now')); ?>

                                            <span class="spinner-border spinner-border-sm"
                                                style="display: none;"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <!-- Special Offer In Service Section End -->
    

    <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    
    <!-- Category Section Start -->
    <section class="salon-section content-t-space2">
        <div class="container-fluid-lg">
            <div class="accordion categories-accordion" id="salon-<?php echo e($category->id); ?>">
                <div class="accordion-item">
                    <div class="accordion-header" id="salonItem">
                        <div class="title w-100" data-bs-toggle="collapse"
                                data-bs-target="#collapseSalon-<?php echo e($category->id); ?>" aria-expanded="true"
                                aria-controls="collapseSalon">
                            <h2 title=""><?php echo e($category?->title); ?></h2>
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSalon-<?php echo e($category->id); ?>" aria-expanded="true"
                                aria-controls="collapseSalon">
                            </button>
                        </div>
                    </div>
                    <div id="collapseSalon-<?php echo e($category->id); ?>" class="accordion-collapse collapse show"
                        aria-labelledby="collapseSalon" data-bs-parent="#salon-<?php echo e($category->id); ?>">
                        <div class="accordion-body">
                            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-sm-4 g-3 ratio_94">
                                <?php $__empty_2 = true; $__currentLoopData = $category->services?->whereNull('parent_id')?->where('status', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                    <div class="col">
                                        <a href="<?php echo e(route('frontend.service.details', ['slug' => $service?->slug])); ?>"
                                        class="category-img"><img src="<?php echo e($service?->web_img_thumb_url); ?>"
                                        alt="<?php echo e($service?->title); ?>" class="bg-img lozad"></a>
                                        <a href="<?php echo e(route('frontend.service.details', ['slug' => $service?->slug])); ?>"
                                            class="category-img"><span title="<?php echo e($service?->title); ?>" class="category-span"><?php echo e($service?->title); ?></span></a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                    <div class="no-data-found">
                                        <p><?php echo e(__('frontend::static.categories.services_not_found')); ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Category Section End -->
    
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="no-data-found category-no-data">
        <svg class="no-data-img">
            <use xlink:href="<?php echo e(asset('frontend/images/no-data.svg#no-data')); ?>"></use>
        </svg>
        
        <p><?php echo e(__('frontend::static.categories.categories_not_found')); ?></p>
    </div>
    <?php endif; ?>
    <?php if(count($categories ?? [])): ?>
        <?php if($categories?->lastPage() > 1): ?>
            <div class="row">
                <div class="col-12">
                    <div class="pagination-main">
                        <ul class="pagination">
                            <?php echo $categories->links(); ?>

                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</section>
<?php $__currentLoopData = $advertiseServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advertisement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php $__currentLoopData = $advertisement->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if ($__env->exists('frontend.inc.modal', ['service' => $service])) echo $__env->make('frontend.inc.modal', ['service' => $service], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/haykshahinyan/Projects/Direlli/Full/fixit_laravel/resources/views/frontend/category/index.blade.php ENDPATH**/ ?>