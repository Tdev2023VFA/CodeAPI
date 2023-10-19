<?php
require_once("../config/config.php");
require_once("../config/function.php");
$title = 'ĐĂNG KÝ | '.$NNL->site('title');
require_once("../public/Header.php");
?>

<body class="login">
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="" class="w-6" src="<?= BASE_URL('') ?>template/images/logo.svg">
                    <span class="text-white text-lg ml-3"> Api<span class="font-medium">Bank</span> </span>
                </a>
                <div class="my-auto">
                    <img alt="Hệ thống API cổng thanh toán trực tuyến" class="-intro-x w-1/2 -mt-16" src="<?= BASE_URL('') ?>template/images/illustration.svg">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                        Hệ thống API

                        <br>
                        thanh toán.
                    </div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-gray-500">Tích hợp thanh toán tự động dễ dàng hơn</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <!-- BEGIN: Register Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                        Đăng ký tài khoản mới
                    </h2>
                    <div class="intro-x mt-8">
                        <input type="text" id="username" class="intro-x login__input form-control py-3 px-4 border-gray-300 block" placeholder="Tên đăng nhập" required="">
                        <input type="password" id="password" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" placeholder="Mật khẩu" required="">
                        <input type="password" id="repassword" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" placeholder="Nhập lại mật khẩu" required="">
                        <input type="email" id="email" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" placeholder="Email" required="">
                    </div>
                    <div class="intro-x flex items-center text-gray-700 dark:text-gray-600 mt-4 text-xs sm:text-sm">
                         <div class="g-recaptcha" data-sitekey="6LcjungbAAAAAHSv_cIc5BvYGCZ9UswsngRb73Id"></div>
                    </div>
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button type="button" id="Register" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Đăng ký</button>

                        <a class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top" href="<?= BASE_URL('dang-nhap') ?>">Đăng nhập</a>
                    </div>
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>
    <script>
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
        $("#Register").on("click", function() {
            $.LoadingOverlay("show");
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: "<?= BASE_URL("assets/ajaxs/Auth.php"); ?>",
                data: {
                    type: 'Register',
                    username: $("#username").val(),
                    password: $("#password").val(),
                    repassword: $("#repassword").val(),
                    email: $("#email").val(),
                    captcha: grecaptcha.getResponse()
                },
                success: function(res) {
                    $.LoadingOverlay("hide");
                    Noti(res.status, res.msg);
                    if (res.status == 2) {
                        setTimeout(function() {
                            window.location.href = "<?= BASE_URL(''); ?>";
                        }, 1800);
                    } else if (res.status == 1) {


                    }
                }
            });
        });
    </script>
    <?php
    require_once("../public/Footer.php");
    ?>