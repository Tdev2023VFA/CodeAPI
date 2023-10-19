<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = 'DANH SÁCH TÀI KHOẢN ZALOPAY | ' . $NNL->site('title');
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
                    Danh sách tài khoản ZALOPAY </h2>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                        <button onclick="window.location.href='<?= BASE_URL('zalopay/Addzalopay') ?>'" class="btn btn-primary shadow-md mr-2" type="button">Thêm tài khoản ZALOPAY</button>
                    </div>
                    <!-- BEGIN: Data List -->
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table class="table table-report -mt-2" id="mytable">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">TÀI KHOẢN</th>
                                    <th class="whitespace-nowrap">CHỦ TÀI KHOẢN</th>
                   
                                    <th class="whitespace-nowrap">SỐ DƯ</th>
                                    <th class="whitespace-nowrap">THỜI GIAN THÊM</th>
                                    <th class="whitespace-nowrap">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $getData = $NNL->get_list("SELECT * FROM `account_zalopay` where `username`='" . $getUser['username'] . "'");
                                foreach ($getData as $mbbank) { ?>
                                    <tr class="intro-x">
                                        <td>
                                            <div class="font-medium whitespace-nowrap"><?= $mbbank['phone'] ?></div>
                                        </td>
                                        <td class="font-medium whitespace-nowrap"><?= getName_zalopay($mbbank['token']) ?></td>
                         
                                        <td class="font-medium whitespace-nowrap"><?= format_cash(getMoney_zalopay($mbbank['token'])) ?>đ</td>
                                        <td class="font-medium whitespace-nowrap" style="color:green">
                                            <?= date('d-m-Y H:i:s', $mbbank['time']) ?>
                                        </td>
                                        <td class="font-medium whitespace-nowrap">
                                            <div class="flex">
                                                 <a class="flex items-center mr-3"
                                                href="<?= BASE_URL('historyzalopay/') ?><?= $mbbank['phone'] ?>"> <i
                                                    data-feather="list" class="w-4 h-4 mr-1"></i> Lịch sử giao dịch </a>
                                                <a class="flex items-center mr-3" href="#" onclick="GetToken(<?= $mbbank['id'] ?>)"> <i data-feather="mail" class="w-4 h-4 mr-1"></i> Gửi token </a>
                                                <a class="flex items-center" style="color:red" href="#" onclick="DeleteTpbank(<?= $mbbank['id'] ?>)"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
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
                                action: "TOKENZALOPAY",
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
            function DeleteTpbank(id) {
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
                            action: "ZALOPAY",
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
        </script>
        <?php
        require_once("../../public/Footer.php");
        ?>