<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once("../../public/Header.php");
?>

<body class="main">
    <?php require_once("../../public/Sidebar.php");?>
    <!-- BEGIN: Top Bar -->
    <?php require_once("../../public/Navbar.php");?>
    <!-- END: Top Bar -->
    <div class="wrapper">
        <div class="wrapper-box">
            <!-- BEGIN: Side Menu -->
            <?php require_once("../../public/SidebarPc.php");?>
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 2xl:col-span-9">
                        <div class="grid grid-cols-12 gap-6">
                            <!-- BEGIN: General Report -->
                            <div class="col-span-12 mt-8">
                                <div class="intro-y flex items-center h-10">
                                    <h2 class="text-lg font-medium truncate mr-5">
                                        Thống kê
                                    </h2>
                                    <a href="" class="ml-auto flex items-center text-theme-26 dark:text-theme-33"> <i
                                            data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Tải lại trang </a>
                                </div>
                                <div class="grid grid-cols-12 gap-6 mt-5">
                                    <!-- <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5">
                                                <div class="flex">
                                                    <img src="https://apigiare.com/dist/images/iconbank/momo.svg"
                                                        style="width: 40px;">
                                                    <div class="ml-auto">
                                                        <div class="report-box__indicator bg-theme-10 tooltip cursor-pointer"
                                                            title="Hoạt động">Hoạt động</div>
                                                    </div>
                                                </div>
                                                <div class="text-3xl font-medium leading-8 mt-6"><?=$NNL->num_rows("SELECT * FROM `users` ");?></div>
                                                <div class="text-base text-gray-600 mt-1">Thành Viên</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5">
                                                <div class="flex">
                                                    <img src="https://apigiare.com/dist/images/iconbank/zalopay.svg"
                                                        style="width: 40px;">
                                                    <div class="ml-auto">
                                                        <div class="report-box__indicator bg-theme-10 tooltip cursor-pointer"
                                                            title="Hoạt động">Hoạt động</div>
                                                    </div>
                                                </div>
                                                <div class="text-3xl font-medium leading-8 mt-6">0</div>
                                                <div class="text-base text-gray-600 mt-1">Ví Zalo Pay</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5">
                                                <div class="flex">
                                                    <img src="https://apigiare.com/dist/images/iconbank/mbbank.svg"
                                                        style="width: 40px;">
                                                    <div class="ml-auto">
                                                        <div class="report-box__indicator bg-theme-10 tooltip cursor-pointer"
                                                            title="Hoạt động không ổn định">Hoạt động</div>
                                                    </div>
                                                </div>
                                                <div class="text-3xl font-medium leading-8 mt-6">0</div>
                                                <div class="text-base text-gray-600 mt-1">MB bank</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5">
                                                <div class="flex">
                                                    <img src="https://apigiare.com/dist/images/iconbank/acb.svg"
                                                        style="width: 40px;">
                                                    <div class="ml-auto">
                                                        <div class="report-box__indicator bg-theme-10 tooltip cursor-pointer"
                                                            title="Hoạt động">Hoạt động</div>
                                                    </div>
                                                </div>
                                                <div class="text-3xl font-medium leading-8 mt-6">0</div>
                                                <div class="text-base text-gray-600 mt-1">Acb bank</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5">
                                                <div class="flex">
                                                    <img src="https://apigiare.com/dist/images/iconbank/tpbank.svg"
                                                        style="width: 40px;">
                                                    <div class="ml-auto">
                                                        <div class="report-box__indicator bg-theme-10 tooltip cursor-pointer"
                                                            title="Hoạt động">Hoạt động</div>
                                                    </div>
                                                </div>
                                                <div class="text-3xl font-medium leading-8 mt-6">0</div>
                                                <div class="text-base text-gray-600 mt-1">Tp bank</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5">
                                                <div class="flex">
                                                    <img src="https://apigiare.com/dist/images/iconbank/vietcombank.svg"
                                                        style="width: 40px;">
                                                    <div class="ml-auto">
                                                        <div class="report-box__indicator bg-theme-10 tooltip cursor-pointer"
                                                            title="Hoạt động">Hoạt động</div>
                                                    </div>
                                                </div>
                                                <div class="text-3xl font-medium leading-8 mt-6">0</div>
                                                <div class="text-base text-gray-600 mt-1">Vietcombank</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5">
                                                <div class="flex">
                                                    <img src="https://apigiare.com/dist/images/iconbank/techcombank.svg"
                                                        style="width: 40px;">
                                                    <div class="ml-auto">
                                                        <div class="report-box__indicator bg-theme-10 tooltip cursor-pointer"
                                                            title="Hoạt động">Hoạt động</div>
                                                    </div>
                                                </div>
                                                <div class="text-3xl font-medium leading-8 mt-6">0</div>
                                                <div class="text-base text-gray-600 mt-1">Techcombank</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5">
                                                <div class="flex">
                                                    <img src="https://apigiare.com/dist/images/iconbank/tsr.png"
                                                        style="width: 40px;">
                                                    <div class="ml-auto">
                                                        <div class="report-box__indicator bg-theme-10 tooltip cursor-pointer"
                                                            title="1 số tài khoản không lấy được giao dịch">Thử nghiệm
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-3xl font-medium leading-8 mt-6">0</div>
                                                <div class="text-base text-gray-600 mt-1">Thesieure</div>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- BEGIN: thongtin -->

                    <!-- END: thongtin -->
                    <div class="col-span-12 2xl:col-span-3">
                        <div class="2xl:border-l border-theme-25 -mb-10 pb-10 mt-10">
                                <div class="intro-y flex items-center h-10">
                                    <h2 class="text-lg font-medium truncate mr-5">
                                        Dòng tiền
                                    </h2>
                                </div>
                            <div class="2xl:pl-6 grid grid-cols-12 gap-6">
                                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                                    <table class="table table-report -mt-2" id="mytable">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>USERNAME</th>
                                                <th>SỐ TIỀN TRƯỚC</th>
                                                <th>SỐ TIỀN THAY ĐỔI</th>
                                                <th>SỐ TIỀN HIỆN TẠI</th>
                                                <th>THỜI GIAN</th>
                                                <th>NỘI DUNG</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        $i = 0;
                                        foreach($NNL->get_list(" SELECT * FROM `dongtien` ORDER BY id DESC ") as $row){
                                        ?>
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><a
                                                        href="<?=BASE_URL('Admin/User/Edit/'.$NNL->getUser($row['username'])['id']);?>"><?=$row['username'];?></a>
                                                </td>
                                                <td><?=format_cash($row['sotientruoc']);?></td>
                                                <td><?=format_cash($row['sotienthaydoi']);?></td>
                                                <td><?=format_cash($row['sotiensau']);?></td>
                                                <td><span class="badge badge-dark"><?=$row['thoigian'];?></span></td>
                                                <td><?=$row['noidung'];?></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Content -->
        </div>
    </div>
    <?php require_once("../../public/Footer.php");?>