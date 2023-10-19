<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = 'DANH SÁCH TÀI KHOẢN MOMO | '.$NNL->site('title');
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
                <h2 class="intro-y text-lg font-medium mt-10">
                    Danh sách tài khoản Ví Momo </h2>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                        <button onclick="window.location.href='<?= BASE_URL('momo/Addmomo') ?>'"
                            class="btn btn-primary shadow-md mr-2" type="button">Thêm tài khoản mới</button>
                            <button
                            class="btn btn-primary shadow-md mr-2" type="button">Max: <?=$getUser['port_momo']?> Tài khoản</button>
                    </div>
                    <!-- BEGIN: Data List -->
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table class="table table-report -mt-2" id="mytable">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">TÊN TÀI KHOẢN</th>
                                    <th class="whitespace-nowrap">SỐ ĐIỆN THOẠI</th>
                                    <th class="text-center whitespace-nowrap">SỐ DƯ</th>
                                    <th class="text-center whitespace-nowrap">THỜI GIAN THÊM</th>
                                    <th class="text-center whitespace-nowrap">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $getData = $NNL->get_list("SELECT * FROM `cron_momo` where `user_id`='" . $getUser['username'] . "'");
                                foreach ($getData as $momo) { ?>
                                <tr class="intro-x">
                                    <td>
                                        <div class="font-medium whitespace-nowrap"><?=$momo['Name'] ?></div>
                                    </td>
                                    <td class="text-center"><?= $momo['phone'] ?></td>
                                   
                                     <td class="w-40" style="color:green">
                                        <div class="flex items-center justify-center">
                                            <?= format_cash(getMoney_momo($momo['setupKeyDecrypt'])) ?><sup>đ</sup></div>
                                    </td>
                                    <td class="flex items-center justify-center" style="color:green">
                                        <div class="flex items-center justify-center">
                                            <?= date("H:i:s d-m-Y",$momo['TimeLogin']) ?></div>
                                    </td>
                                    <td>
                                        <div class="flex justify-center items-center">
                                            <a class="flex items-center mr-3"
                                                href="<?= BASE_URL('anti-theft/') ?><?= $momo['phone'] ?>"> <i
                                                    data-feather="edit" class="w-4 h-4 mr-1"></i> Chống trộm </a>
                                            <a class="flex items-center mr-3"
                                                href="<?= BASE_URL('dashboard/') ?><?= $momo['phone'] ?>"> <i
                                                    data-feather="list" class="w-4 h-4 mr-1"></i> Lịch sử nhận tiền </a>
                                            <a class="flex items-center mr-3"
                                                href="<?= BASE_URL('transfermomo/') ?><?= $momo['phone'] ?>"> <i
                                                    data-feather="dollar-sign" class="w-4 h-4 mr-1"></i> Chuyển tiền </a>
                                            <a class="flex items-center mr-3"
                                                href="<?= BASE_URL('sendbank/') ?><?= $momo['phone'] ?>"> <i
                                                    data-feather="download" class="w-4 h-4 mr-1"></i> Rút về Bank </a>
                                            <a class="flex items-center mr-3" href="#"
                                                onclick="GetToken(<?= $momo['id'] ?>)"> <i data-feather="mail"
                                                    class="w-4 h-4 mr-1"></i> Gửi token </a>
                                            <a class="flex items-center" style="color:red" href="#"
                                                onclick="DeleteMomo(<?= $momo['id'] ?>)"> <i
                                                    data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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

        function DeleteMomo(id) {
            cuteAlert({
                type: "question",
                title: "Xác nhận xóa tài khoản",
                message: "Bạn có chắc chắn muốn xóa không ?",
                confirmText: "Đồng Ý",
                cancelText: "Huỷ"
            }).then((e) => {
                if (e) {
                    $.LoadingOverlay("show");
                    $.ajax({
                        type: "post",
                        url: "<?= BASE_URL("assets/ajaxs/DeleteAccountAPI.php"); ?>",
                        dataType: "json",
                        data: {
                            action: "MOMO",
                            id: id
                        },
                        success: function(data) {
                            $.LoadingOverlay("hide");
                            Noti(data.status, data.msg);
                            if (data.status == '2') {
                                setTimeout("location.href = ' ';", 1000);
                            } else {

                            }
                        }
                    });
                }
            })
        }

        function GetToken(id) {
            cuteAlert({
                type: "question",
                title: "Xác nhận lấy token",
                message: "Bạn có chắc chắn muốn lấy token qua Email không ?",
                confirmText: "Đồng Ý",
                cancelText: "Huỷ"
            }).then((e) => {
                if (e) {
                    $.LoadingOverlay("show");
                    $.ajax({
                        type: "post",
                        url: "<?= BASE_URL("assets/ajaxs/SendToken.php"); ?>",
                        dataType: "json",
                        data: {
                            action: "TOKENMOMO",
                            id: id
                        },
                        success: function(data) {
                            $.LoadingOverlay("hide");
                            Noti(data.status, data.msg);
                        },
                    });
                }
            })
        }
        </script>


        <?php
        require_once("../../public/Footer.php");
        ?>