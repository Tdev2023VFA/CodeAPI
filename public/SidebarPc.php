<nav class="side-nav">
    <ul>
        <li>
            <a href="<?=BASE_URL('')?>" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                <div class="side-menu__title">
                    Trang chủ
                    <div class="side-menu__sub-icon transform rotate-180"> </div>
                </div>
            </a>
        </li>
        <li>
            <a href="#" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="box"></i> </div>
                <div class="side-menu__title">
                    Cổng thanh toán
                    <div class="side-menu__sub-icon "> <i data-feather="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="<?=BASE_URL('momo/Listmomo')?>" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Ví Momo </div>
                    </a>
                </li>
                <li>
                    <a href="<?=BASE_URL('vcb/listvcb')?>" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Vietcombank </div>
                    </a>
                </li>
                 <li>
                    <a href="<?=BASE_URL('acb/listacb')?>" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> ACB </div>
                    </a>
                </li>
                 <li>
                    <a href="<?=BASE_URL('mbbank/Listmbbank')?>" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> MBBank </div>
                    </a>
                </li>
                <li>
                    <a href="<?=BASE_URL('tpbank/Listtpbank')?>" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Tpbank </div>
                    </a>
                </li>
                <li>
                    <a href="<?=BASE_URL('zalopay/Listzalopay')?>" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> ZaloPay </div>
                    </a>
                </li>
                <li>
                    <a href="<?=BASE_URL('thesieure/Listthesieure')?>" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Thẻ siêu rẻ </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="<?=BASE_URL('Docs')?>" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="share-2"></i> </div>
                <div class="side-menu__title">
                    Tài liệu kết nối
                </div>
            </a>
        </li>
        <div class="side-nav__devider my-6"></div>
        <li>
            <a href="<?=BASE_URL('info/profile')?>" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                <div class="side-menu__title">
                    Hồ sơ
                    <div class="side-menu__sub-icon transform rotate-180"> </div>
                </div>
            </a>
        </li>
        <li>
            <a href="<?=BASE_URL('recharge')?>" class="side-menu">
                <div class="menu__icon"> <i data-feather="dollar-sign"></i> </div>
                <div class="side-menu__title">
                    Nạp tiền
                </div>
            </a>
        </li>
        <li>
            <a href="<?=BASE_URL('upgrade')?>" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="edit"></i> </div>
                <div class="side-menu__title">
                    Nâng cấp gói API
                </div>
            </a>
        </li>
        <?php if(isset($_SESSION['username']) && $getUser['level'] == 'admin') { ?>
        <div class="side-nav__devider my-6"></div>
        <li>
            <a href="<?=BASE_URL('admin')?>" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="settings"></i> </div>
                <div class="side-menu__title">
                    Quản trị website
                </div>
            </a>
        </li>
        <?php }?>
    </ul>
</nav>