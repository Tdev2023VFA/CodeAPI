<div class="top-bar-boxed border-b border-theme-2 -mt-7 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 md:pt-0 mb-12">
    <div class="h-full flex items-center">
        <!-- BEGIN: Logo -->
        <a href="<?=BASE_URL('')?>" class="-intro-x hidden md:flex">
            <img alt="Thuê api gia re" class="w-6" src="<?=BASE_URL('')?>template/images/logo.svg">
            <span class="text-white text-lg ml-3"> Api<span class="font-medium">Bank</span> </span>
        </a>
        <!-- END: Logo -->
        <!-- BEGIN: Breadcrumb -->
        <div class="-intro-x breadcrumb mr-auto"> <a href="/">Trang chủ</a> <i data-feather="chevron-right"
                class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Tổng Quan </a> </div>
        <!-- END: Breadcrumb -->
        <!-- BEGIN: Notifications -->
        <div class="intro-x dropdown mr-4 sm:mr-6">
            <div class="dropdown-toggle notification cursor-pointer" role="button" aria-expanded="false">
                <i data-feather="credit-card" class="notification__icon dark:text-gray-100"></i> Số dư:
                <?=format_cash($getUser['money'])?>đ <br>
                <i data-feather="inbox" class="notification__icon dark:text-gray-100"></i> HSD:
                <?=date('d-m-Y H:i:s',$getUser['time_api'])?>
            </div>
        </div>
        <!-- END: Notifications -->
        <!-- BEGIN: Account Menu -->
        <div class="intro-x dropdown w-8 h-8">
            <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110"
                role="button" aria-expanded="false">
                <img alt="Thông tin tài khoản" src="<?=BASE_URL('images/avt.jpg')?>">
            </div>
            <div class="dropdown-menu w-56">
                <div class="dropdown-menu__content box bg-theme-11 dark:bg-dark-6 text-white">
                    <div class="p-4 border-b border-theme-12 dark:border-dark-3">
                        <div class="font-medium">Xin chào: <?=$getUser['username']?></div>
                    </div>
                    <div class="p-2">
                        <a href="<?=BASE_URL('info/profile')?>"
                            class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                            <i data-feather="user" class="w-4 h-4 mr-2"></i> Thông tin tài khoản </a>
                        <a href="<?=BASE_URL('recharge')?>"
                            class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                            <i data-feather="edit" class="w-4 h-4 mr-2"></i> Nạp tiền </a>
                    </div>
                    <div class="p-2 border-t border-theme-12 dark:border-dark-3">
                        <a href="<?=BASE_URL('Logout')?>"
                            class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                            <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Đăng xuất </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Account Menu -->
    </div>
</div>