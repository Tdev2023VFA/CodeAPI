<?php
require_once(__DIR__."/config/config.php");
require_once(__DIR__."/config/function.php");
$title = 'API THANH TOÁN | '.$NNL->site('title');
require_once(__DIR__."/public/Header.php");
CheckLogin();
?>
<!-- END: Head -->

<body class="main">
    <?php require_once(__DIR__."/public/Sidebar.php");?>
    <!-- BEGIN: Top Bar -->
    <?php require_once(__DIR__."/public/Navbar.php");?>
    <!-- END: Top Bar -->
    <div class="wrapper">
        <div class="wrapper-box">
            <!-- BEGIN: Side Menu -->
            <?php require_once(__DIR__."/public/SidebarPc.php");?>
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 2xl:col-span-9">
                        <div class="grid grid-cols-12 gap-6">
                            <!-- BEGIN: General Report -->
                            <div class="col-span-12 mt-8">
                                <div class="alert alert-warning alert-dismissible show flex items-center mb-2"
                                    role="alert"> <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i>
                                    <p><b>Ra mắt api vietcombank giá ổn định</b></p>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <i data-feather="x" class="w-4 h-4"></i> </button>
                                </div>
                                <div class="intro-y flex items-center h-10">
                                    <h2 class="text-lg font-medium truncate mr-5">
                                        Thống kê tài khoản
                                    </h2>
                                    <a href="" class="ml-auto flex items-center text-theme-26 dark:text-theme-33"> <i
                                            data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Tải lại trang </a>
                                </div>
                                <div class="grid grid-cols-12 gap-6 mt-5">
                                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y" onclick="window.location='/momo/Listmomo';">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5">
                                                <div class="flex">
                                                    <img src="<?=BASE_URL('')?>images/momo.svg" style="width: 40px;">
                                                    <div class="ml-auto">
                                                        <?=status_api($NNL->site('display_api_momo'))?>
                                                    </div>
                                                </div>
                                                <div class="text-3xl font-medium leading-8 mt-6">
                                                    <?=format_cash($NNL->num_rows("SELECT * FROM `cron_momo` where `user_id`='".$_SESSION['username']."' "));?>
                                                </div>
                                                <div class="text-base text-gray-600 mt-1">MOMO</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y" onclick="window.location='/tpbank/Listtpbank';">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5">
                                                <div class="flex">
                                                    <img src="<?=BASE_URL('')?>images/tpbank.svg" style="width: 40px;">
                                                    <div class="ml-auto">
                                                        <?=status_api($NNL->site('display_api_tpbank'))?>
                                                    </div>
                                                </div>
                                                <div class="text-3xl font-medium leading-8 mt-6">
                                                    <?=format_cash($NNL->num_rows("SELECT * FROM `account_tpbank` where `username`='".$_SESSION['username']."' "));?>
                                                </div>
                                                <div class="text-base text-gray-600 mt-1">TPBANK</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y" onclick="window.location='/thesieure/Listthesieure';">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5">
                                                <div class="flex">
                                                    <img src="<?=BASE_URL('')?>images/tsr.png" style="width: 40px;">
                                                    <div class="ml-auto">
                                                        <?=status_api($NNL->site('display_api_tsr'))?>
                                                    </div>
                                                </div>
                                                <div class="text-3xl font-medium leading-8 mt-6">
                                                    <?=format_cash($NNL->num_rows("SELECT * FROM `account_thesieure` where `user_id`='".$getUser['id']."' "));?>
                                                </div>
                                                <div class="text-base text-gray-600 mt-1">THESIEURE</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y" onclick="window.location='/zalopay/Listzalopay';">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5">
                                                <div class="flex">
                                                    <img src="<?=BASE_URL('')?>images/zalopay.svg" style="width: 40px;">
                                                    <div class="ml-auto">
                                                        <?=status_api($NNL->site('display_api_zalopay'))?>
                                                    </div>
                                                </div>
                                                <div class="text-3xl font-medium leading-8 mt-6">
                                                   <?=format_cash($NNL->num_rows("SELECT * FROM `account_zalopay` where `username`='".$getUser['username']."' "));?>
                                                </div>
                                                <div class="text-base text-gray-600 mt-1">ZALOPAY</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y" onclick="window.location='/mbbank/Listmbbank';">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5">
                                                <div class="flex">
                                                    <img src="<?=BASE_URL('')?>images/mbbank.svg" style="width: 40px;">
                                                    <div class="ml-auto">
                                                        <?=status_api($NNL->site('display_api_mbbank'))?>
                                                    </div>
                                                </div>
                                                <div class="text-3xl font-medium leading-8 mt-6">
                                                  <?=format_cash($NNL->num_rows("SELECT * FROM `account_mbbank` where `username`='".$getUser['username']."' "));?>
                                                </div>
                                                <div class="text-base text-gray-600 mt-1">MBBANK</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y" onclick="window.location='/vcb/listvcb';">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5">
                                                <div class="flex">
                                                    <img src="<?=BASE_URL('')?>images/vietcombank.svg" style="width: 40px;">
                                                    <div class="ml-auto">
                                                        <?=status_api($NNL->site('display_api_vcb'))?>
                                                    </div>
                                                </div>
                                                <div class="text-3xl font-medium leading-8 mt-6">
                                                 <?=format_cash($NNL->num_rows("SELECT * FROM `vietcombank` where `user_id`='".$getUser['id']."' "));?>
                                                </div>
                                                <div class="text-base text-gray-600 mt-1">VIETCOMBANK</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5">
                                                <div class="flex">
                                                    <img src="<?=BASE_URL('')?>images/acb.svg" style="width: 40px;">
                                                    <div class="ml-auto">
                                                        <div class="report-box__indicator bg-theme-24 tooltip cursor-pointer" title="Bảo trì">Sắp ra mắt</div>
                                                    </div>
                                                </div>
                                                <div class="text-3xl font-medium leading-8 mt-6">
                                                 0
                                                </div>
                                                <div class="text-base text-gray-600 mt-1">ACB</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5">
                                                <div class="flex">
                                                    <img src="<?=BASE_URL('')?>images/viettelpay.svg" style="width: 40px;">
                                                    <div class="ml-auto">
                                                        <div class="report-box__indicator bg-theme-24 tooltip cursor-pointer" title="Bảo trì">Sắp ra mắt</div>
                                                    </div>
                                                </div>
                                                <div class="text-3xl font-medium leading-8 mt-6">
                                                 0
                                                </div>
                                                <div class="text-base text-gray-600 mt-1">VIETTELPAY</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END: General Report -->


                            <!-- BEGIN: Ads 1 -->
                            <div class="col-span-12 lg:col-span-6 mt-6">
                                <div class="ads-box box p-8 relative overflow-hidden bg-theme-17 intro-y">
                                    <div class="ads-box__title w-full sm:w-72 text-white text-xl -mt-3">Thời gian hỗ trợ
                                        API System</div>
                                    <div
                                        class="w-full sm:w-82 leading-relaxed text-white text-opacity-70 dark:text-gray-600 dark:text-opacity-100 mt-3">
                                        Phục vụ bạn Từ 9:00 - 19:00 Thứ 2 - Thứ 7. (Không tính lễ -tết)</div>

                                    <a class="btn w-42 bg-white dark:bg-dark-2 dark:text-white mt-6 sm:mt-10" href="">
                                        <i data-feather="corner-down-left" class="w-4 h-4 mr-2"></i>Liên hệ ngay</a>
                                    <img class="hidden sm:block absolute top-0 right-0 w-2/5 -mt-3 mr-2"
                                        alt="cho thuê api bank momo"
                                        src="https://apigiare.com/dist/images/woman-illustration.svg">
                                </div>
                            </div>
                            <!-- END: Ads 1 -->

                            <!-- BEGIN: Ads 2 -->
                            <div class="col-span-12 lg:col-span-6 mt-6">
                                <div class="ads-box box p-8 relative overflow-hidden intro-y">
                                    <div
                                        class="ads-box__title w-full sm:w-72 text-theme-17 dark:text-white text-xl -mt-3">
                                        Với hệ thống api tự động</div>
                                    <div class="w-full sm:w-60 leading-relaxed text-gray-600 mt-2">Sẽ giúp bạn tích hợp
                                        nạp tiền auto cho web của bạn một cách dễ dàng, nhanh chóng và tiện lợi</div>
                                    <a class="btn w-42 btn-primary dark:bg-dark-2 dark:text-white mt-2" href=""> <i
                                            data-feather="corner-down-left" class="w-4 h-4 mr-2"></i>Sử dụng ngay</a>
                                    <img class="hidden sm:block absolute top-0 right-0 w-1/2 mt-1 -mr-12"
                                        alt="cho thuê api bank momo"
                                        src="https://apigiare.com/dist/images/phone-illustration.svg">
                                </div>
                            </div>
                            <!-- END: Ads 2 -->


                        </div>
                    </div>
                    <!-- BEGIN: thongtin -->

                    <!-- END: thongtin -->
                    <div class="col-span-12 2xl:col-span-3">
                        <div class="2xl:border-l border-theme-25 -mb-10 pb-10">
                            <div class="2xl:pl-6 grid grid-cols-12 gap-6">
                                <!-- BEGIN: Important Notes -->
                                <div class="col-span-12 md:col-span-6 xl:col-span-12 mt-3 2xl:mt-8">
                                    <div class="intro-x flex items-center h-10">
                                        <h2 class="text-lg font-medium truncate mr-auto">
                                            Thông báo
                                        </h2>
                                        <button data-carousel="important-notes" data-target="prev"
                                            class="tiny-slider-navigator btn px-2 border-gray-400 text-gray-700 dark:text-gray-300 mr-2">
                                            <i data-feather="chevron-left" class="w-4 h-4"></i> </button>
                                        <button data-carousel="important-notes" data-target="next"
                                            class="tiny-slider-navigator btn px-2 border-gray-400 text-gray-700 dark:text-gray-300 mr-2">
                                            <i data-feather="chevron-right" class="w-4 h-4"></i> </button>
                                    </div>
                                    <div class="mt-5 intro-x">
                                        <div class="box zoom-in">
                                            <div class="tiny-slider" id="important-notes">
                                                <?php foreach($NNL->get_list("SELECT * FROM `noti` WHERE `status`='1' ") as $row){?>
                                                <div class="p-5">
                                                    <div class="text-base font-medium truncate">Thông báo</div>
                                                    <div class="text-gray-500 mt-1"><?=$row['create_date']?></div>
                                                    <div class="text-gray-600 text-justify mt-1"><?=$row['title']?></div>
                                                </div>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END: Important Notes -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Content -->

        </div>
    </div>
    <?php
        if(isset($_SESSION['username']))
        {
            $time=time();
            $row = $NNL->get_row(" SELECT * FROM `users` WHERE `username` = '" . $_SESSION['username'] . "' ");
            if($row['time_api'] < $time)
            {
        ?>
    <script>
    $(document).ready(function() {
        Swal.fire({
            title: "Thông báo",
            text: "Tài khoản của Quý khách đã hết hạn. Vui lòng gia hạn để tiếp tục sử dụng",
            icon: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#DD6B55',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })
    });
    </script>
    <?php }}?>
    <?php
            require_once(__DIR__."/public/Footer.php");
    ?>