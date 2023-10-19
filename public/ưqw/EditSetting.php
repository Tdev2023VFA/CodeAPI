<?php
   require_once("../../config/config.php");
   require_once("../../config/function.php");
   require_once("../../public/Header.php");
?>
<?php
if(isset($_GET['id']) && $getUser['level'] == 'admin')
{
    $row = $NNL->get_row(" SELECT * FROM `service` WHERE `id` = '".check_string($_GET['id'])."'  ");
    if(!$row)
    {
        admin_msg_error("Dịch vụ này không tồn tại", BASE_URL(''), 500);
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
                                    Chỉnh sửa gói thuê api
                                </h2>
                            </div>
                            <div class="p-5">
                                <form class="form-horizontal mb-lg" action="" method="post">
                                    <div class="flex flex-col-reverse xl:flex-row flex-col">
                                        <div class="flex-1 mt-6 xl:mt-0">
                                            <div class="grid grid-cols-12 gap-x-5">
                                                <div class="col-span-12 2xl:col-span-6">
                                                    <div>
                                                        <label for="update-profile-form-1" class="form-label">Stt</label>
                                                        <input type="text" class="form-control"
                                                            value="<?=$row['stt'];?>" id="stt">
                                                    </div>
                                                    <div class="mt-3">
                                                        <label for="update-profile-form-1"
                                                            class="form-label">Số ngày</label>
                                                        <input type="number" id="day" class="form-control"
                                                            value="<?=$row['day'];?>">
                                                    </div>
                                                    <div class="mt-3">
                                                        <label for="update-profile-form-1" class="form-label">Giá tiền</label>
                                                        <input type="number" class="form-control" id="money"
                                                            value="<?=$row['money'];?>" required>
                                                    </div>
                                                    <div class="mt-3">
                                                        <label for="update-profile-form-1" class="form-label">Tên lựa chọn</label>
                                                        <input type="text" id="name" class="form-control"
                                                            value="<?=$row['name'];?>"
                                                           >
                                                    </div>
                                                
                                                </div>


                                            </div>

                                            <div class="mt-3">
                                                <button style="width: 100%" type="button" id="update"
                                                    class="btn btn-primary w-full">Cập nhật</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
        <!-- END: Content -->
    </div>
    </div>
    <script type="text/javascript">
    $("#update").on("click", function() {
        $('#update').html('Đang xử lý...').prop('disabled',
            true);
        var myData = {
            type: 'updateOptions',
            stt: $("#stt").val(),
            day: $("#day").val(),
            money: $("#money").val(),
            name: $("#name").val(),
            id: <?=$row['id']?>
        };
        $.post("<?=BASE_URL("assets/ajaxs/Admin.php");?>", myData,
            function(data) {
                if (data.status == "1") {
                    Swal.fire("Thất Bại", data.msg, "error");
                    $('#update').html(
                            'Cập nhật')
                        .prop('update', false);
                } else {
                    Swal.fire("Thành công", data.msg, "success");
                    setTimeout(function() {
                        window.location = "<?=BASE_URL('')?>admin/Setting"
                    }, 1000);
                    $('#update').html(
                            'Cập nhật')
                        .prop('disabled', false);
                }
            }, "json");
    });
    </script>
    <?php 
    require_once("../../public/Footer.php");
?>