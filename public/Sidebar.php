<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="<?=BASE_URL('')?>" class="flex mr-auto">
            <img alt="Icewall Tailwind HTML Admin Template" class="w-6" src="<?=BASE_URL('')?>template/images/logo.svg">
            <span class="text-white text-lg ml-3"> Api<span class="font-medium">Bank</span> </span>
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2"
                class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-theme-2 py-5 hidden">
        <li>
            <a href="<?=BASE_URL('')?>" class="menu menu--active">
                <div class="menu__icon"> <i data-feather="home"></i> </div>
                <div class="menu__title"> Trang chủ </div>
            </a>
        </li>
        <li>
            <a href="javascript:;.html" class="menu menu--active">
                <div class="menu__icon"> <i data-feather="home"></i> </div>
                <div class="menu__title"> Cổng thanh toán <i data-feather="chevron-down"
                        class="menu__sub-icon transform rotate-180"></i> </div>
            </a>
            <ul class="menu__sub-open">
                <li>
                    <a href="<?=BASE_URL('momo/Listmomo')?>" class="menu menu--active">
                        <div class="menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="menu__title"> Ví Momo </div>
                    </a>
                </li>
                <li>
                    <a href="<?=BASE_URL('vcb/listvcb')?>" class="menu menu--active">
                        <div class="menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="menu__title"> Vietcombank </div>
                    </a>
                </li>
                 <li>
                    <a href="<?=BASE_URL('acb/listacb')?>" class="menu menu--active">
                        <div class="menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="menu__title"> ACB </div>
                    </a>
                </li>
                <li>
                    <a href="<?=BASE_URL('mbbank/Listmbbank')?>" class="menu menu--active">
                        <div class="menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="menu__title"> MBBank </div>
                    </a>
                </li>
                <li>
                    <a href="<?=BASE_URL('tpbank/Listtpbank')?>" class="menu menu--active">
                        <div class="menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="menu__title"> Tpbank </div>
                    </a>
                </li>
                 <li>
                    <a href="<?=BASE_URL('zalopay/Listzalopay')?>" class="menu menu--active">
                        <div class="menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="menu__title"> ZaloPay </div>
                    </a>
                </li>
                <li>
                    <a href="<?=BASE_URL('thesieure/Listthesieure')?>" class="menu menu--active">
                        <div class="menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="menu__title"> Thẻ siêu rẻ </div>
                    </a>
                </li>
               
            </ul>
        </li>
        <li>
            <a href="<?=BASE_URL('Docs')?>" class="menu menu--active">
                <div class="menu__icon"> <i data-feather="share-2"></i> </div>
                <div class="menu__title"> Tài liệu kết nối </div>
            </a>
        </li>
        <li>
            <a href="<?=BASE_URL('info/profile')?>" class="menu menu--active">
                <div class="menu__icon"> <i data-feather="users"></i> </div>
                <div class="menu__title"> Hồ sơ</div>
            </a>
        </li>
        <li>
            <a href="<?=BASE_URL('recharge')?>" class="menu menu--active">
                <div class="menu__icon"> <i data-feather="dollar-sign"></i> </div>
                <div class="menu__title">
                    Nạp tiền
                </div>
            </a>
        </li>
        <li>
            <a href="<?=BASE_URL('upgrade')?>" class="menu menu--active">
                <div class="side-menu__icon"> <i data-feather="edit"></i> </div>
                <div class="menu__title">
                    Nâng cấp gói API
                </div>
            </a>
        </li>
        <?php if(isset($_SESSION['username']) && $getUser['level'] == 'admin') { ?>
        <li>
            <a href="<?=BASE_URL('admin')?>" class="menu menu--active">
                <div class="menu__icon"> <i data-feather="settings"></i> </div>
                <div class="menu__title">Quản trị website</div>
            </a>
        </li>
        <?php }?>
        

    </ul>
    </li>
    </ul>
</div>