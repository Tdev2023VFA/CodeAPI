<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = 'NẠP TIỀN | ' . $NNL->site('title');
require_once("../../public/Header.php");
CheckLogin();
?>

<body class="main">
    <?php require_once("../../public/Sidebar.php"); ?>
    <!-- BEGIN: Top Bar -->
    <?php require_once("../../public/Navbar.php"); ?>
    <!-- END: Top Bar -->
    <div class="wrapper">
        <div class="wrapper-box">
            <!-- BEGIN: Side Menu -->
            <?php require_once("../../public/SidebarPc.php"); ?>
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Pricing Tab -->
                <div class="flex mt-10">
                    <div class="tab-content">
                        <div id="layout-1-monthly-fees" class="tab-pane flex flex-col lg:flex-row active" role="tabpanel" aria-labelledby="layout-1-monthly-fees-tab">
                           <?php foreach($NNL->get_list("SELECT * FROM `bank`") as $row){?>
                            <div class="intro-y flex-1 box py-16 lg:ml-5 mb-5 lg:mb-0">
                                <div style="height: 150px;">
                                <img src="<?=BASE_URL(''),$row['image']?>" class="mx-auto" width="100%" height="100%" >
                               </div>
                                
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td class="text-right">
                                                <strong style="color: black;">Tên tài khoản:</strong>
                                                <br>
                                            </td>
                                            <td class="text-left payment-instruction">
                                                <div>
                                                    <span style="color: black;"><?= $row['accountName'] ?></span>
                                                    <br>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="" style="background-color:#FBFBFB;">
                                            <td class="text-right">
                                                <strong style="color: black;">Số tài khoản:</strong>
                                            </td>
                                            <td class="text-left payment-instruction">
                                                <strong>
                                                    <input style="color:red; border-style: none; background-color: #FBFBFB; font-weight: bold;  padding: 0px" value="<?= $row['accountNumber'] ?>" id="input01" readonly="">
                                                </strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">
                                                <strong style="color: black;">Ví điện tử:</strong>
                                                <br>
                                            </td>
                                            <td class="text-left payment-instruction">
                                                <div>
                                                    <span style="color: black;"><?= $row['short_name'] ?></span>
                                                    <br>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">
                                                <strong style="color: black;">Nội dung chuyển khoản*:</strong>
                                            </td>
                                            <td class="text-left payment-instruction">
                                                <strong>
                                                    <input style="color:red; border-style: none; font-weight: bold;  padding: 0px" value="<?= $NNL->site('noidungnap'), $getUser['id'] ?>" id="input02" readonly="">
                                                </strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <center><i><i class="fa fa-spinner fa-spin"></i> Xử lý giao dịch tự động trong vài
                                        giây...</i></center>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>

                <!-- END: Display Information -->
                <div class="col-span-12 lg:col-span-4 xxl:col-span-3">
                    <div class="intro-y box lg:mt-5">
                        <div class="flex flex-col lg:flex-row items-center p-5">
                            <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                                <a href="" class="font-medium">HƯỚNG DẪN NẠP TIỀN</a>
                                <br /><br />
                                <div class="class=" font-medium""><strong>Bước 1:</strong> Mở App Ngân hàng hoặc Website
                                    ngân hàng để thực hiển chuyển tiền.</div>

                                <div class="class=" font-medium""><strong>Bước 2:</strong> Chọn Ngân hàng, nhập chính
                                    xác số tài khoản và số tiền muốn nạp.</div>
                                <div class="class=" font-medium""><strong>Bước 3:</strong> Nhập chính xác nội dung
                                    chuyển tiền như yêu cầu. Ví dụ: NAP323AE7.</div>
                                <div class="class=" font-medium""><strong>Bước 4:</strong> Thực hiện chuyển tiền.</div>
                                <div class="class=" font-medium""><strong>Bước 5:</strong> Giữ nguyên màn hình, không F5
                                    hoặc tải sang trang khác. Hệ thống chỉ tự động kiểm tra và cộng tiền vào khi bạn giữ
                                    nguyên trang.</div>
                                <div class="class=" font-medium""><strong>Bước 6:</strong> Sau khi kiểm tra, hệ thống sẽ
                                    hiển thị xác nhận và cộng tiền vào tài khoản cho quý khách.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Pricing Content -->
            </div>
        </div>
        <!-- END: Content -->
    </div>
    </div>
    <?php
    require_once("../../public/Footer.php");
    ?>