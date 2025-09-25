<?php use \App\Models\Setting; ?>
<?php use \App\Models\User; ?>
<?php use \App\Helpers\Helpers; ?>
<?php
    $notifications = [];
    if (Auth::check()) {
        $user = User::findOrFail(Auth::user()->id);
        $notifications = $user->notifications()->latest('created_at');
    }
    $settings = Setting::first()->values;
?>
<!-- Page Header Start-->



    <?php if(Request::is('backend/booking/create')): ?>
    <div class="page-main-header open">
    <?php else: ?>
    <div class="page-main-header">
    <?php endif; ?>
    <div class="main-header-right row">
        
        <div class="d-flex align-items-center w-auto gap-sm-3 gap-2 p-0">
            <div class="mobile-sidebar w-auto d-lg-none">
                <div class="media-body text-end switch-sm">
                    <label class="switch h-auto">
                        <span class="cursor-pointer">
                            <i data-feather="menu" id="sidebar-toggle"></i>
                        </span>
                    </label>
                </div>
            </div>
            <a href="<?php echo e(route('backend.dashboard')); ?>" class="d-lg-none d-flex mobile-logo">
                <img class="blur-up lazyloaded img-fluid dark-logo"
                    src="<?php echo e(asset($settings['general']['light_logo']) ?? asset('admin/images/logo-dark.png')); ?>"
                    alt="site-logo">
                <img class="blur-up lazyloaded img-fluid light-logo"
                    src="<?php echo e(asset($settings['general']['light_logo']) ?? asset('admin/images/Logo-Light.png')); ?>"
                    alt="site-logo">
            </a>
            <button class="btn form-control search-input-btn d-lg-block d-none" data-bs-toggle="modal"
                data-bs-target="#searchModal"><i data-feather="search"></i>
                <?php echo e(__('static.search_here')); ?>

                <span>CTRL + M</span>
            </button>
            
        </div>

        <div class="nav-right col">
            <ul class="nav-menus">
                <li class="onhover-dropdown quick-onhover-dropdown">
                    <div class="quick-dropdown-box">
                        <a href="<?php echo e(route('backend.booking.create')); ?>" class="new-btn">
                            <span class="d-xl-block d-lg-none d-md-block d-none"><?php echo e(__('static.POS')); ?></span>
                            <i class="ri-add-line add d-xl-block d-lg-none d-md-block d-none"></i>
                            <i class="ri-shopping-cart-line d-xl-none d-lg-block d-md-none"></i>
                        </a>
                    </div>
                </li>
                <li class="onhover-dropdown quick-onhover-dropdown">
                    <div class="quick-dropdown-box">
                        <div class="new-btn">
                            <span class="d-xl-block d-lg-none d-md-block d-none"><?php echo e(__('static.quick_links')); ?></span>
                            <i class="ri-add-line add d-xl-block d-lg-none d-md-block d-none"></i>
                            <i class="ri-links-line d-xl-none d-lg-block d-md-none"></i>
                        </div>
                        <div class="onhover-show-div">
                            <ul class="h-custom-scrollbar dropdown-list">
                                <li>
                                    <a href="<?php echo e(route('backend.booking.index')); ?>">
                                        <div class="svg-box">
                                            <i class="ri-book-line"></i>
                                        </div>
                                        <span><?php echo e(__('static.bookings')); ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('backend.service.index')); ?>">
                                        <div class="svg-box">
                                            <i class="ri-customer-service-line"></i>
                                        </div>
                                        <span><?php echo e(__('static.service.services')); ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('backend.zone.create')); ?>">
                                        <div class="svg-box">
                                            <i class="ri-map-pin-line"></i>
                                        </div>
                                        <span><?php echo e(__('static.zone.create')); ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('backend.provider.create')); ?>">
                                        <div class="svg-box">
                                            <i class="ri-user-add-line"></i>
                                        </div>
                                        <span><?php echo e(__('static.provider.add')); ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('backend.serviceman-location.index')); ?>">
                                        <div class="svg-box">
                                            <i class="ri-user-line"></i>
                                        </div>
                                        <span><?php echo e(__('static.serviceman.serviceman_location')); ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('backend.review.index')); ?>">
                                        <div class="svg-box">
                                            <i class="ri-star-line"></i>
                                        </div>
                                        <span><?php echo e(__('static.review.review')); ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('backend.theme_options.index')); ?>">
                                        <div class="svg-box">
                                            <i class="ri-brush-4-line"></i>
                                        </div>
                                        <span><?php echo e(__('static.theme_options.theme_options')); ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('backend.settings.index')); ?>">
                                        <div class="svg-box">
                                            <i class="ri-settings-3-line"></i>
                                        </div>
                                        <span><?php echo e(__('static.settings.settings')); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>

                <li class="d-lg-none d-sm-inline-block d-none header-search cursor-pointer" data-bs-toggle="modal"
                    data-bs-target="#searchModal">
                    <i data-feather="search" class="light-mode"></i>
                </li>

                <li class="cache-button d-sm-block d-none">
                    <a href="<?php echo e(route('backend.clear-cache')); ?>">
                        <i class="ri-brush-line"></i>
                    </a>
                </li>

                

                <li class="onhover-dropdown">
                    <a class="txt-dark" href="javascript:void(0)">
                        <h6><?php echo e(strtoupper(Session::get('locale', Helpers::getDefaultLanguageLocale()))); ?></h6>
                    </a>
                    <ul class="language-dropdown onhover-show-div p-20  language-dropdown-hover">
                        <?php $__empty_1 = true; $__currentLoopData = \App\Helpers\Helpers::getLanguages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li>
                                <a href="<?php echo e(route('lang', @$lang?->locale)); ?>" data-lng="<?php echo e(@$lang?->locale); ?>"><img
                                        class="active-icon"
                                        src="<?php echo e(@$lang?->flag ?? asset('admin/images/No-image-found.jpg')); ?>"><span><?php echo e(@$lang?->name); ?>

                                        (<?php echo e(@$lang?->locale); ?>)
                                    </span></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li>
                                <a href="<?php echo e(route('lang', Helpers::getDefaultLanguageLocale())); ?>" data-lng="en"><img class="active-icon"
                                        src="<?php echo e(asset('admin/images/flags/LR.png')); ?>"><a href="javascript:void(0)"
                                        data-lng="en">English</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
                
                <li class="onhover-dropdown">
                    <i data-feather="bell"></i>
                    <span
                        class="badge badge-pill badge-primary pull-right notification-badge"><?php echo e(count(auth()->user()->unreadNotifications)); ?></span>
                    </span>
                    <ul class="notification-dropdown onhover-show-div">
                        <li>
                            <h4><?php echo e(__('static.contact_mails')); ?>

                                <span
                                    class="badge badge-pill badge-primary pull-right"><?php echo e(count(auth()->user()->unreadNotifications)); ?></span>
                            </h4>
                        </li>
                        <?php $__empty_1 = true; $__currentLoopData = auth()->user()->notifications()->latest()->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li>
                                <i data-feather="disc"></i>
                                <p><?php echo e($notification->data['message'] ?? ''); ?></p>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="d-flex flex-column no-data-detail">
                                <img class="mx-auto d-flex" src="<?php echo e(asset('admin/images/svg/no-data.svg')); ?>"
                                    alt="no-image">
                                <div class="data-not-found">
                                    <span><?php echo e(__('static.data_not_found')); ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <li>
                            <a href="<?php echo e(route('backend.list-notification')); ?>" class="btn btn-primary">View All</a>
                        </li>
                    </ul>
                </li>
                <li class="onhover-dropdown">
                    <a href="<?php echo e(route('backend.account.profile')); ?>" class="media profile-box">
                        <?php if(Auth::user()->getFirstMediaUrl('image')): ?>
                            <img class="align-self-center profile-image pull-right img-fluid rounded-circle blur-up lazyloaded"
                                src="<?php echo e(Auth::user()->getFirstMediaUrl('image')); ?>" alt="header-user">
                        <?php else: ?>
                            <div class="initial-letter"><?php echo e(substr(Auth::user()->name, 0, 1)); ?></div>
                        <?php endif; ?>
                        <span class="d-md-flex d-none"><?php echo e(Auth::user()->name); ?></span>
                    </a>
                    <ul class="profile-dropdown onhover-show-div p-20 profile-dropdown-hover">
                        <li><a href="<?php echo e(route('backend.account.profile')); ?>">
                                <i data-feather="user"></i><span><?php echo e(__('static.edit_profile')); ?></span></a></li>
                        <li>
                            <a href="<?php echo e(route('frontend.logout')); ?>"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i data-feather="log-out"></i><span><?php echo e(__('static.logout')); ?></span>
                            </a>
                            <form action="<?php echo e(route('frontend.logout')); ?>" method="POST" class="d-none"
                                id="logout-form">
                                <?php echo csrf_field(); ?>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Page Header Ends -->

<!-- Search modal start -->

<div class="modal fade search-modal" id="searchModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Search box</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <i class="ri-close-line"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="from-group">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Enter your search"
                            id="menu-item-search" autofocus>
                        <i class="ri-search-line"></i>
                    </div>
                </div>

                <div class="search-suggestion-box">
                    <div class="search-input-box" id="recent-search">
                        <h6>Recent Searches</h6>
                        <div class="search-list" id="recent-searches">
                            <h4>No recent searches</h4>
                        </div>
                    </div>

                    <div class="search-input-box d-none" id="search-result">
                        <h6>Search Results</h6>
                        <ul class="search-list d-none" id="search-results"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php $__env->startPush('js'); ?>
    <script>
        $(document).on('keydown', function(e) {
            if ((e.metaKey || e.ctrlKey) && (String.fromCharCode(e.which).toLowerCase() === 'm')) {
                $("#searchModal").modal('show');
            }
        });

        function saveRecentSearch(text, url) {
            if (!text || !url) return;

            let recentSearches = JSON.parse(localStorage.getItem('recentSearches')) || [];

            recentSearches = recentSearches.filter(item => item.url !== url);

            recentSearches.unshift({
                text,
                url
            });

            if (recentSearches.length > 5) recentSearches.pop();

            localStorage.setItem('recentSearches', JSON.stringify(recentSearches));
            displayRecentSearches();
        }

        function displayRecentSearches() {
            let recentSearches = JSON.parse(localStorage.getItem('recentSearches')) || [];
            let container = document.getElementById('recent-searches');

            container.innerHTML = '';
            if (recentSearches.length === 0) {
                container.innerHTML = '<h4>No recent searches</h4>';
                return;
            }

            recentSearches.forEach(search => {
                let li = document.createElement('li');
                li.innerHTML = `<a href="${search.url}"><i class="ri-history-line"></i> ${search.text}</a>`;
                container.appendChild(li);
            });
        }

         function menuItemSearch() {
            var input = document.getElementById('menu-item-search');
            var filter = input.value.toUpperCase();
            var ul = document.getElementById("sidebar-menu");
            var li = ul.getElementsByTagName('li');
            var resultsContainer = document.getElementById("search-results");
            $("#recent-search").removeClass("d-none");

            if (filter !== '') {
                $("#recent-search").addClass("d-none");
                $("#search-result").removeClass("d-none");
                $("#search-results").removeClass("d-none").addClass("d-block"); // Updated to use d-block for consistent display

                resultsContainer.innerHTML = '';
                var hasMatches = false;

                for (var i = 0; i < li.length; i++) {
                    var a = li[i].getElementsByTagName("a")[0];
                    if (a) {
                        var txtValue = a.textContent || a.innerText;
                        var href = a.getAttribute('href');

                        if (href !== "javascript:void(0);" && txtValue.toUpperCase().indexOf(filter) > -1) {
                            var highlightedText = txtValue.replace(new RegExp(`(${filter})`, "gi"), "<b>$1</b>");
                            var clone = document.createElement("li");
                            clone.innerHTML =
                                `<a href="${href}" onclick="saveRecentSearch('${txtValue}', '${href}')"><i class="ri-article-line"></i> ${highlightedText}</a>`;

                            resultsContainer.appendChild(clone);
                            hasMatches = true;
                        }
                    }
                }

                if (!hasMatches) {
                    resultsContainer.innerHTML = '<li class="no-data">No result found</li>';
                    $("#recent-search").addClass("d-none");
                    $("#search-results").removeClass("d-none").addClass("d-block");
                    $("#search-result").removeClass("d-none");
                }
            } else {
                $("#search-results").removeClass("d-flex").addClass("d-none");
                $("#search-result").addClass("d-none");
            }
        }

        (function($) {
            "use strict";
            document.getElementById('menu-item-search').addEventListener('keyup', menuItemSearch);
            displayRecentSearches();
        })(jQuery);

        $('#searchModal').on('shown.bs.modal', function() {
            $(this).find('[autofocus]').focus();
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /Users/haykshahinyan/Projects/Direlli/Full/fixit_laravel/resources/views/backend/layouts/partials/header.blade.php ENDPATH**/ ?>