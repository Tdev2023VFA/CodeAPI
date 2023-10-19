<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = 'THÊM TÀI KHOẢN THẺ SIÊU RẺ | '.$NNL->site('title');
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
                                    Thên tài khoản TSR </h2>
                            </div>

                            <div id="form-validation" class="p-5">
                                <form class="form-horizontal mb-lg" method="post">
                                    <div class="input-form">
                                        <label for="phone" class="form-label w-full flex flex-col sm:flex-row"> Tài khoản TSR <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">* Vui lòng nhập chính xác tài khoản TSR</span> </label>
                                        <input class="form-control t14 RoM" id="username" placeholder="Nhập tài khoản tsr" type="text"/>
                                    </div>
                                    <div class="input-form mt-3">
                                        <label for="phone" class="form-label w-full flex flex-col sm:flex-row"> Cookie TSR <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Nhập cookie thesieure</span> </label>
                                        <textarea class="form-control" id="cookie" rows="7"></textarea>
                                    </div>
                                    <div class="text-right mt-5">
                                        <a href="<?= BASE_URL('thesieure/Listthesieure') ?>" type="button" class="btn btn-outline-secondary w-24 mr-1">Quay lại</a>
                                        <button type="button" id="themtsr" class="btn btn-primary w-40">Thêm ngay</button>
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
        $("#themtsr").on("click", function() {
            $.LoadingOverlay("show");
            var myData = {
                action: 'CHECKTSR',
                username: $("#username").val(),
                cookie: $("#cookie").val()
            };
            $.post("<?= BASE_URL("assets/ajaxs/thesieure.php"); ?>", myData,
                function(data) {
                    $.LoadingOverlay("hide");
                    Noti(data.status, data.msg);
                    if (data.status == "1") {
                       
                    } else {
                        setTimeout(function() {
                            window.location = "<?= BASE_URL('thesieure/Listthesieure') ?>"
                        }, 1000);
                    }
                }, "json");
        });
    </script>
    <?php
    require_once("../../public/Footer.php");
    ?>