<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = 'CHỐNG TRỘM CHUYỂN TIỀN | ' . $NNL->site('title');
require_once("../../public/Header.php");
CheckLogin();
require_once("../../class/momo.php");
error_reporting(0);
$Momo = new Momov2;
?>
<?php
if (isset($_GET['phone'])) {
    $rowData = $NNL->get_row(" SELECT * FROM `cron_momo` WHERE `phone` = '" . xss($_GET['phone']) . "' AND `user_id`='" . $_SESSION['username'] . "' ");
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
                                                Chống trộm chuyển tiền momo
                                            </h2>
                                        </div>
                                        <div class="p-5">
                                            <form class="form-horizontal mb-lg" action="" method="post">
                                                <div class="flex flex-col-reverse xl:flex-row flex-col">
                                                    <div class="flex-1 mt-6 xl:mt-0">
                                                        <div class="grid grid-cols-12 gap-x-5">
                                                            <div class="col-span-12 2xl:col-span-6">
                                                                <div class="mt-3">
                                                                    <label for="update-profile-form-1" class="form-label">Chuyển đến số điện
                                                                        thoại</label>
                                                                    <input type="number" id="phone" value="<?= $rowData['phone'] ?>"  class="form-control" readonly>
                                                                    <input type="hidden" id="id" value="<?= $rowData['id'] ?>"  class="form-control">
                                                                </div>
                                                                <div class="mt-3">
                                                                    <label for="update-profile-form-1" class="form-label">Trạng thái anti</label>
                                                                    <select class="form-select mt-2 sm:mr-2" aria-label="Default select example" id="status">
                                                                        <option <?= $rowData['status_anti'] == 1 ? 'selected' : ''; ?> value="1">
                                                                            Hoạt động</option>
                                                                        <option <?= $rowData['status_anti'] == 2 ? 'selected' : ''; ?> value="2">Tắt
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                
                                                                <div class="mt-3">
                                                                    <label for="update-profile-form-1" class="form-label">Nhập Ip cho phép chuyển</label>
                                                                    <input type="text" id="ip" value="<?= $rowData['ip_white'] ?>" class="form-control">
                                                                </div>
                                                               
                                                            </div>
                                                           
                                                        </div>
                                                        <div class="mt-3">
                                                            <button style="width: 100%" type="button" id="saveAnti" class="btn btn-primary w-full">Lưu lại</button>
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
        $("#saveAnti").on("click", function() {
            $.LoadingOverlay("show");
            var myData = {
                type: 'anti-theft',
                status: $("#status").val(),
                ip: $("#ip").val(),
                id: $("#id").val(),
            };
            $.post("<?= BASE_URL("assets/ajaxs/momo.php"); ?>", myData,
                function(data) {
                    $.LoadingOverlay("hide");
                    Noti(data.status, data.msg);
                }, "json");

        });


    </script>
    <?php
    require_once("../../public/Footer.php");
    ?>