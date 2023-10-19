<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = 'LỊCH SỬ GIAO DỊCH VÀ CHUYỂN TIỀN | ' . $NNL->site('title');
require_once("../../public/Header.php");
CheckLogin();
require_once("../../class/momo.php");
error_reporting(0);
$Momo = new Momov2;
?>
<?php
if (isset($_GET['phonemomo'])) {
    $rowData = $NNL->get_row(" SELECT * FROM `cron_momo` WHERE `phone` = '" . xss($_GET['phonemomo']) . "' AND `user_id`='" . $_SESSION['username'] . "' ");
    if ($rowData) {
       
    } else {
        admin_msg_error("Liên kết không tồn tại", BASE_URL(''), 500);
    }
} else {
    admin_msg_error("Liên kết không tồn tại", BASE_URL(''), 0);
}

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
               
                <!-- BEGIN: Pricing Content -->
                <div class="mt-10">
                    <div class="tab-content">
                        <div id="layout-2-monthly-fees" class="tab-pane flex flex-col lg:flex-row active" role="tabpanel" aria-labelledby="layout-2-monthly-fees-tab">
                             <div class="intro-y flex justify-center flex-col flex-1 text-center sm:px-10 lg:px-5 pb-10 lg:pb-0">
                                <div class="mt-3 lg:text-justify text-gray-700">
                                    <div class="intro-y box lg:mt-5">
                                        <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                            <h2 class="font-medium text-base mr-auto">
                                                Rút tiền về Bank
                                            </h2>
                                        </div>
                                        <div class="p-5">
                                            <form class="form-horizontal mb-lg" action="" method="post">
                                                <div class="flex flex-col-reverse xl:flex-row flex-col">
                                                    <div class="flex-1 mt-6 xl:mt-0">
                                                        <div class="grid grid-cols-12 gap-x-5">
                                                            <div class="col-span-12 2xl:col-span-6">
                                                                <div class="mt-3">
                                                                    <input type="hidden" id="from" class="form-control" value="<?= $rowData['phone'] ?>">
                                                                </div>
                                                                <div class="mt-3">
                                                                    <label for="update-profile-form-1" class="form-label">Ngân hàng nhận</label>
                                                                    <select
                                                                        class="form-control" data-live-search="true"
                                                                        id="bankcode">
                                                                        <option value="0"> - Chọn Ngân Hàng - </option>
                                                                       <?php
                                                                       $result = curl_get(BASE_URL('') . "listbank");
                                                                        $tmpDiscount = json_decode($result, true);
                                                                      
                                                                       foreach ($tmpDiscount['napasBanks'] as $value) {
                                                                           $bankCode = $value['bankCode'];
                                                                           $bankName = $value['bankName'];
                                                                           ?>
                                                                            <option value="<?=$bankCode?>"><?=$bankName?></option>
                                                                           <?php
                                                                        }?>
                                                                       
                                                                    ?>
                                                                    
                                                                    </select>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <label for="update-profile-form-1" class="form-label">Số tài khoản nhận</label>
                                                                    <input type="text" id="account_number" onchange="getName()" class="form-control">
                                                                </div>
                                                                 <div class="mt-3">
                                                                    <label for="update-profile-form-1" class="form-label">Người nhận
                                                                        tiền</label>
                                                                    <input type="text" id="namebank" class="form-control" readonly>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <label for="update-profile-form-1" class="form-label">Số tiền cần rút</label>
                                                                    <input type="number" id="money" class="form-control" placeholder="Nhập số tiền">
                                                                    <i>Số tiền rút tối thiểu 10.000đ</i>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <label for="update-profile-form-1" class="form-label">Nhập mật khẩu momo</label>
                                                                    <input type="password" id="pass" class="form-control" placeholder="Nhập mật khẩu">
                                                                </div>
                                                            </div>
                                                            <div class="col-span-12 2xl:col-span-6">
                                                                <div class="mt-3 2xl:mt-0">
                                                                    <label for="update-profile-form-1" class="form-label">Nội dung</label>
                                                                    <textarea type="text" id="content" class="form-control" placeholder="Nội dung"></textarea>
                                                                </div>
                                                            </div>
                                                           
                                                        </div>
                                                        <div class="mt-3">
                                                            <button style="width: 100%" type="button" id="sendBank" class="btn btn-primary w-full">Xác thực rút</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--tab2-->
                     
                    </div>
                </div>
                <!-- END: Pricing Content -->
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
        $("#sendBank").on("click", function() {
            $.LoadingOverlay("show");
            var myData = {
                type: 'sendBank',
                phone: $("#from").val(),
                money: $("#money").val(),
                pass: $("#pass").val(),
                account_number: $("#account_number").val(),
				bankcode : $("#bankcode").val(),
                content: $("#content").val(),
            };
            $.post("<?= BASE_URL("assets/ajaxs/momo.php"); ?>", myData,
                function(data) {
                    $.LoadingOverlay("hide");
                    Noti(data.status, data.msg);
                }, "json");

        });

        function getName() {
             $.ajax({
                url: "<?=BASE_URL("assets/ajaxs/momo.php");?>",
                method: "POST",
                dataType: "json",
                data: {
                    type: 'getNameBank',
                    phone: $("#from").val(),
                    account_number: $("#account_number").val(),
					bankcode : $("#bankcode").val()
                },
                success: function(data) {
                    if (data.status == '2') {
                        $("#namebank").attr('value', data.msg);
                    } else if (data.status == '1') {
                        $("#namebank").attr('value', data.msg);
                    }
                },
                error: function() {
                    cuteToast({
                        type: "error",
                        message: 'Không tìm thấy người dùng bank',
                        timer: 5000
                    });
                }
            });

        };
    </script>
    <?php
    require_once("../../public/Footer.php");
    ?>