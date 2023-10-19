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
                            </div>
                        </div>
                    </div>
                    <!-- BEGIN: thongtin -->

                    <!-- END: thongtin -->
                    <div class="col-span-12 2xl:col-span-3">
                        <div class="2xl:border-l border-theme-25 -mb-10 pb-10">
                            <div class="2xl:pl-6 grid grid-cols-12 gap-6">
                                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                                    <table class="table table-report -mt-2" id="mytable">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>USERNAME</th>
                                                <th>SỐ DƯ</th>
                                                <th>TỔNG NẠP</th>
                                                <th>NGÀY TẠO</th>
                                                <th>TRẠNG THÁI</th>
                                                <th>THAO TÁC</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach($NNL->get_list(" SELECT * FROM `users` WHERE `username` IS NOT NULL ORDER BY id DESC ") as $row){
                                            ?>
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$row['username'];?></td>
                                                <td><?=format_cash($row['money']);?></td>
                                                <td><?=format_cash($row['total_money']);?></td>
                                                <td><span class="badge badge-dark"><?=$row['createdate'];?></span></td>
                                                <td><?=display_banned($row['banned']);?></td>
                                                <td>
                                                    <a type="button"
                                                        href="<?=BASE_URL('admin/Users/Edit/');?><?=$row['id']?>"
                                                        class="btn btn-primary"><i class="fas fa-edit"></i>
                                                        <span>EDIT</span></a>
                                                </td>
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