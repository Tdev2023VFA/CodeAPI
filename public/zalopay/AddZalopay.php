<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = 'THÊM TÀI KHOẢN ZALOPAY | '.$NNL->site('title');
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
                                Thêm tài khoản ZALOPAY </h2>
                            </div>

                            <div id="form-validation" class="p-5">
                                <form class="form-horizontal mb-lg" action="" method="post">
                                    <div class="input-form">
                                        <label for="phone" class="form-label w-full flex flex-col sm:flex-row"> Tài khoản đăng nhập ZALOPAY: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Nhập chính xác tên đăng nhập tại ZALOPAY</span> </label>
                                        <input class="form-control t14 RoM" id="phonezalopay" placeholder="Nhập Username ZALOPAY" type="text" />
                                    </div>
                                    <div class="input-form mt-3">
                                        <label for="phone" class="form-label w-full flex flex-col sm:flex-row"> Mật khẩu đăng nhập ZALOPAY: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Nhập chính xác mật khẩu đăng nhập tại ZALOPAY</span> </label>
                                        <input class="form-control" id="passzalopay" placeholder="Nhập Password ZALOPAY" type="password" />
                                    </div>
                                    <div class="input-form mt-3" style="display:none" id="otpinput">
                                        <label for="phone" class="form-label w-full flex flex-col sm:flex-row"> OTP
                                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Mã otp gửi về
                                                điện thoại</span> </label>
                                        <input class="form-control" id="otp" placeholder="Nhập otp" type="password" value="" />
                                    </div>
                                    <div class="mt-5">
                                        <button type="button" id="GetOTP" class="btn btn-primary">Lấy OTP</button>
                                        <button style="display:none" type="button" id="btnCheckOTP" class="btn btn-primary">Xác thực OTP</button>
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
        $("#GetOTP").on("click", function() {
             $.LoadingOverlay("show");
            var myData = {
                type: 'GetOTP',
                phonezalopay: $("#phonezalopay").val(),
                passzalopay: $("#passzalopay").val()
            };
            $.post("<?= BASE_URL("assets/ajaxs/Zalopay.php"); ?>", myData,
                function(res) {
                    $.LoadingOverlay("hide");
                    Noti(res.status, res.msg);
                    if (res.status == "2") {
                        document.getElementById("otpinput").style.display = 'block';
                        document.getElementById("GetOTP").style.display = 'none';
                        document.getElementById("btnCheckOTP").style.display = 'block';
                    } else {
                      
                    }
                }, "json");

        });
        $("#btnCheckOTP").on("click", function() {
            $.LoadingOverlay("show");
            var myOTPData = {
                type: 'Login',
                phonezalopay: $("#phonezalopay").val(),
                passzalopay: $("#passzalopay").val(),
                otp: $("#otp").val(),
            };
            $.post("<?= BASE_URL("assets/ajaxs/Zalopay.php"); ?>", myOTPData,
                function(data) {
                    $.LoadingOverlay("hide");
                    Noti(data.status, data.msg);
                    if (data.status == "1") {
                      
                    } else {
                        setTimeout(function() {
                            window.location = "<?= BASE_URL('zalopay/Listzalopay') ?>"
                        }, 1000);
                    }
                }, "json");
        });
    </script>
    <?php
    require_once("../../public/Footer.php");
    ?>