<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = 'THÊM TÀI KHOẢN TPBANK | '.$NNL->site('title');
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

                <!-- END: Top Bar -->
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="intro-y col-span-12 lg:col-span-6">

                        <!-- BEGIN: Form Validation -->
                        <div class="intro-y box">
                            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                <h2 class="font-medium text-base mr-auto">
                                Thêm tài khoản TPBank </h2>
                            </div>

                            <div id="form-validation" class="p-5">
                                <form class="form-horizontal mb-lg" action="" method="post">
                                    <div class="input-form">
                                        <label for="phone" class="form-label w-full flex flex-col sm:flex-row"> Tài khoản đăng nhập TPBank: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Nhập chính xác tên đăng nhập tại TPBank</span> </label>
                                        <input class="form-control t14 RoM" id="phonetpbank" placeholder="Nhập Username TPBank" type="text" />
                                    </div>
                                    <div class="input-form mt-3">
                                        <label for="phone" class="form-label w-full flex flex-col sm:flex-row"> Mật khẩu đăng nhập TPBank: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Nhập chính xác mật khẩu đăng nhập tại TPBank</span> </label>
                                        <input class="form-control" id="passtpbank" placeholder="Nhập Password TPBank" type="password" />
                                    </div>
                                    <div class="input-form mt-3">
                                        <label for="phone" class="form-label w-full flex flex-col sm:flex-row"> Số tài khoản TPBank: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Nhập chính xác số tài khoản tại TPBank</span> </label>
                                        <input class="form-control" id="stktpbank" placeholder="Nhập số tài khoản TPBank" type="text" />
                                    </div>
                                    <div class="text-left mt-5">
                                        <button type="button" id="Xacnhan" class="btn btn-primary w-40">Thêm tài khoản</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <!-- END: Form Validation -->
                </div>
            </div>
            <!-- END: Content -->
        </div>
    </div>
    <script type="text/javascript">
          var Noti = function(type, msg) {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 1500
            };
            if (type == 2)
                toastr.success(msg, 'Thông báo');
            else
                toastr.error(msg, 'Thông báo');
        };
        $("#Xacnhan").on("click", function() {
            $.LoadingOverlay("show");
            var myOTPData = {
                type: 'Login',
                phonetpbank: $("#phonetpbank").val(),
                passtpbank: $("#passtpbank").val(),
                stktpbank: $("#stktpbank").val()
            };
            $.post("<?= BASE_URL("assets/ajaxs/Tpbank.php"); ?>", myOTPData,
                function(data) {
                    $.LoadingOverlay("hide");
                    Noti(data.status, data.msg);
                    if (data.status == "1") {
                      
                    } else {
                        setTimeout(function() {
                            window.location = "<?= BASE_URL('tpbank/Listtpbank') ?>"
                        }, 1000);
                    }
                }, "json");
        });
    </script>
    <?php
    require_once("../../public/Footer.php");
    ?>