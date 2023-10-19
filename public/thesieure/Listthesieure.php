<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = 'DANH SÁCH TÀI KHOẢN THẺ SIÊU RẺ | ' . $NNL->site('title');
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
                    Danh sách tài khoản thẻ siêu rẻ </h2>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                        <button onclick="window.location.href='<?= BASE_URL('thesieure/Addthesieure') ?>'" class="btn btn-primary shadow-md mr-2" type="button">Thêm tài khoản mới</button>
                    </div>
                    <!-- BEGIN: Data List -->
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table class="table table-report -mt-2" id="mytable">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">TÊN TÀI KHOẢN</th>
                                    <th class="whitespace-nowrap">SỐ DƯ</th>
                                    <th class="whitespace-nowrap">TRẠNG THÁI</th>
                                    <th class="text-center whitespace-nowrap">THỜI GIAN THÊM</th>
                                    <th class="text-center whitespace-nowrap">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $getData = $NNL->get_list("SELECT * FROM `account_thesieure` where `user_id`='" . $getUser['id'] . "'");
                                foreach ($getData as $tsr) { ?>
                                    <tr class="intro-x">
                                        <td>
                                            <?= $tsr['username']; ?>
                                        </td>
                                        <td>
                                            <?= format_cash(getMoney_thesieure($tsr['token'])); ?>đ
                                        </td>
                                        <td class="font-medium whitespace-nowrap">
                                            <?= status_tsr($tsr['status']) ?>

                                        </td>
                                        <td class="font-medium whitespace-nowrap" style="color:green">
                                            <?= date('d-m-Y H:i:s', $tsr['time']) ?>
                                        </td>
                                        <td class="font-medium whitespace-nowrap">
                                            <div class="flex justify-center items-center">
                                                <a class="btn btn-success mr-1 mb-2" onclick="GetToken(<?= $tsr['id'] ?>)"><i data-feather="mail" class="w-4 h-4 mr-1"></i> Lấy Token </a>
                                                <a class="flex items-center" style="color:red" href="#" onclick="DeleteTsr('<?= $tsr['id'] ?>')"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Xóa tài khoản </a>
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

            function DeleteTsr(id) {
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
                                action: "TSR",
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
                                action: "TOKENTSR",
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