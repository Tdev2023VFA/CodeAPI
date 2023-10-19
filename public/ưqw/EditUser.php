<?php
   require_once("../../config/config.php");
   require_once("../../config/function.php");
   require_once("../../public/Header.php");
?>
<?php
if(isset($_GET['id']) && $getUser['level'] == 'admin')
{
    $row = $NNL->get_row(" SELECT * FROM `users` WHERE `id` = '".check_string($_GET['id'])."'  ");
    if(!$row)
    {
        admin_msg_error("Người dùng này không tồn tại", BASE_URL(''), 500);
    }
}
else
{
    admin_msg_error("Liên kết không tồn tại", BASE_URL(''), 0);
}
?>

<body class="main">
    <?php require_once("../../public/Sidebar.php");?>
    <!-- BEGIN: Top Bar -->
    <?php require_once("../../public/Navbar.php");?>
    <!-- END: Top Bar -->
    <div class="wrapper">
        <div class="wrapper-box">
            <!-- BEGIN: Side Menu -->
            <?php require_once("../../public/SidebarPc.php");?>
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">


                <div class="grid grid-cols-12 gap-6">
                    <!-- BEGIN: General Report -->
                    <div class="col-span-12 mt-8">
                        <div class="intro-y box lg:mt-5">
                            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                <h2 class="font-medium text-base mr-auto">
                                    Chỉnh sửa thành viên
                                </h2>
                            </div>
                            <div class="p-5">
                                <form class="form-horizontal mb-lg" action="" method="post">
                                    <div class="flex flex-col-reverse xl:flex-row flex-col">
                                        <div class="flex-1 mt-6 xl:mt-0">
                                            <div class="grid grid-cols-12 gap-x-5">
                                                <div class="col-span-12 2xl:col-span-6">
                                                    <div>
                                                        <label for="update-profile-form-1" class="form-label">Tài
                                                            khoản</label>
                                                        <input type="text" class="form-control"
                                                            value="<?=$row['username'];?>" disabled>
                                                    </div>
                                                    <div class="mt-3">
                                                        <label for="update-profile-form-1"
                                                            class="form-label">Token</label>
                                                        <input type="text" id="token" class="form-control"
                                                            value="<?=$row['token'];?>">
                                                    </div>
                                                    <div class="mt-3">
                                                        <label for="update-profile-form-1" class="form-label">Số
                                                            dư</label>
                                                        <input type="text" class="form-control" id="money"
                                                            value="<?=$row['money'];?>" required>
                                                    </div>
                                                    <div class="mt-3">
                                                        <label for="update-profile-form-1" class="form-label">Phân
                                                            quyền</label>
                                                        <input type="text" id="level" class="form-control"
                                                            value="<?=$row['level'];?>"
                                                            placeholder="Nếu muốn đưa lên Admin thì ghi: admin"
                                                            required>
                                                    </div>
                                                    <div class="mt-3">
                                                        <label for="update-profile-form-1"
                                                            class="form-label">OTP</label>
                                                        <input type="text" class="form-control" id="otp"
                                                            value="<?=$row['otp'];?>" placeholder="Mã OTP">
                                                    </div>
                                                    <div class="mt-3">
                                                        <label for="update-profile-form-1" class="form-label">Trạng
                                                            thái</label>
                                                        <select class="form-control" id="banned">
                                                            <option value="<?=$row['banned'];?>">
                                                                <?php
                                                                            if($row['banned'] == "0"){ echo 'Hoạt động';}
                                                                            if($row['banned'] == "1"){ echo 'Banned';}
                                                                            ?>
                                                            </option>
                                                            <option value="0">Hoạt động</option>
                                                            <option value="1">Banned</option>
                                                        </select>
                                                    </div>
                                                    <div class="mt-3">
                                                        <label for="update-profile-form-1" class="form-label">Ngày tham
                                                            gia</label>
                                                        <input type="text" class="form-control"
                                                            value="<?=$row['createdate'];?>" disabled>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="mt-3">
                                                <button style="width: 100%" type="button" id="saveUser"
                                                    class="btn btn-primary w-full">Cập nhật người dùng</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-6">
                    <!-- BEGIN: General Report -->
                    <div class="col-span-12 lg:col-span-6 2xl:col-span-3 flex lg:block flex-col-reverse">
                        <div class="intro-y box mt-5">
                            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                <h2 class="font-medium text-base mr-auto">
                                    Cộng tiền thành viên
                                </h2>
                            </div>
                            <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                                <div>
                                    <label for="update-profile-form-1" class="form-label">Số tiền cộng</label>
                                    <input id="moneyplus" type="number" class="form-control">
                                </div>
                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label">Nội dung</label>
                                    <textarea id="contentplus" type="text" class="form-control"></textarea>
                                </div>

                            </div>
                            <div class="p-5 border-t border-gray-200 dark:border-dark-5 flex">
                                <button type="button" id="Plus" class="btn btn-success py-1 px-2">Thực hiện</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-12 lg:col-span-6 2xl:col-span-3 flex lg:block flex-col-reverse">
                        <div class="intro-y box mt-5">
                            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                <h2 class="font-medium text-base mr-auto">
                                    Trừ tiền thành viên
                                </h2>
                            </div>
                            <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                                <div>
                                    <label for="update-profile-form-1" class="form-label">Số tiền trừ</label>
                                    <input id="moneyDeduction" type="number" class="form-control">
                                </div>
                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label">Nội dung</label>
                                    <textarea id="contentDeduction" type="text" class="form-control"></textarea>
                                </div>

                            </div>
                            <div class="p-5 border-t border-gray-200 dark:border-dark-5 flex">
                                <button type="button" id="Deduction" class="btn btn-danger py-1 px-2">Thực
                                    hiện</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BEGIN: thongtin -->
            </div>
        </div>
        <!-- END: Content -->
    </div>
    </div>
    <script type="text/javascript">
    $("#saveUser").on("click", function() {
        $('#saveUser').html('Đang xử lý...').prop('disabled',
            true);
        var myData = {
            type: 'changeUser',
            token: $("#token").val(),
            level: $("#level").val(),
            banned: $("#banned").val(),
            money: $("#money").val(),
            otp: $("#otp").val(),
            moneydefault: <?=$row['money']?>,
            id: <?=$row['id']?>,
            user: "<?=$row['username']?>"
        };
        $.post("<?=BASE_URL("assets/ajaxs/Admin.php");?>", myData,
            function(data) {
                if (data.status == "1") {
                    Swal.fire("Thất Bại", data.msg, "error");
                    $('#saveUser').html(
                            'Cập nhật người dùng')
                        .prop('disabled', false);
                } else {
                    Swal.fire("Thành công", data.msg, "success");
                    setTimeout(function() {
                        window.location = " "
                    }, 1000);
                    $('#saveUser').html(
                            'Cập nhật người dùng')
                        .prop('disabled', false);
                }
            }, "json");
    });

    $("#Plus").on("click", function() {
        $('#Plus').html('Đang xử lý...').prop('disabled',
            true);
        var myData = {
            type: 'PlusMoney',
            moneydefault: <?=$row['money']?>,
            money: $("#moneyplus").val(),
            content: $("#contentplus").val(),
            user: "<?=$row['username']?>"
        };
        $.post("<?=BASE_URL("assets/ajaxs/Admin.php");?>", myData,
            function(data) {
                if (data.status == "1") {
                    Swal.fire("Thất Bại", data.msg, "error");
                    $('#Plus').html(
                            'Thực hiện')
                        .prop('disabled', false);
                } else {
                    Swal.fire("Thành công", data.msg, "success");
                    setTimeout(function() {
                        window.location = " "
                    }, 1000);
                    $('#Plus').html(
                            'Thực hiện')
                        .prop('disabled', false);
                }
            }, "json");
    });

    $("#Deduction").on("click", function() {
        $('#Deduction').html('Đang xử lý...').prop('disabled',
            true);
        var myData = {
            type: 'Deduction',
            moneydefault: <?=$row['money']?>,
            money: $("#moneyDeduction").val(),
            content: $("#contentDeduction").val(),
            user: "<?=$row['username']?>"
        };
        $.post("<?=BASE_URL("assets/ajaxs/Admin.php");?>", myData,
            function(data) {
                if (data.status == "1") {
                    Swal.fire("Thất Bại", data.msg, "error");
                    $('#Deduction').html(
                            'Thực hiện')
                        .prop('disabled', false);
                } else {
                    Swal.fire("Thành công", data.msg, "success");
                    setTimeout(function() {
                        window.location = " "
                    }, 1000);
                    $('#Deduction').html(
                            'Thực hiện')
                        .prop('disabled', false);
                }
            }, "json");
    });
    </script>
    <?php 
    require_once("../../public/Footer.php");
?>