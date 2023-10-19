<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once("../../public/Header.php");
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
                    <div class="col-span-12 lg:col-span-6 2xl:col-span-3 flex lg:block flex-col-reverse">
                        <div class="intro-y box mt-5">
                            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                <h2 class="font-medium text-base mr-auto">
                                    Cấu hình website
                                </h2>
                            </div>
                          
                            <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                               <div>
                                    <label for="update-profile-form-1" class="form-label">Số điện thoại Momo</label>
                                    <input id="sdt_momo" type="text" value="<?= $NNL->site('sdt_momo')?>" class="form-control">
                                </div>
                                <div>
                                    <label for="update-profile-form-1" class="form-label">Tên chủ Momo</label>
                                    <input id="name_momo" type="text" value="<?= $NNL->site('name_momo')?>" class="form-control">
                                </div>
                                <div>
                                    <label for="update-profile-form-1" class="form-label">Token momo để cấu hình nạp tự động</label>
                                    <input id="token" type="text" value="<?= $NNL->site('token')?>" class="form-control">
                                </div>
                                
                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label">Tài khoản gmail</label>
                                    <input id="email" type="text" value="<?= $NNL->site('email')?>" class="form-control">
                                </div>
                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label">Mật khẩu gmail</label>
                                    <input id="pass_email" type="text" value="<?= $NNL->site('pass_email')?>" class="form-control">
                                </div>
                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label">Nội dung nạp tiền</label>
                                    <input id="noidung_naptien" type="text" value="<?= $NNL->site('noidung_naptien')?>" class="form-control">
                                </div>
                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label">Lưu ý nạp tiền</label>
                                    <textarea id="summernote"><?=$NNL->site('luuy_naptien')?></textarea>
                                   
                                </div>
                                
                            </div>
                            <div class="p-5 border-t border-gray-200 dark:border-dark-5 flex">
                                <button type="submit" id="btnSaveOption" class="btn btn-success py-1 px-2">Lưu</button>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-span-12 lg:col-span-6 2xl:col-span-3 flex lg:block flex-col-reverse">
                        <div class="intro-y box mt-5">
                            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                <h2 class="font-medium text-base mr-auto">
                                    Thiết lập giá tiền thuê api
                                </h2>
                            </div>
                            <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                                <div>
                                    <label for="update-profile-form-1" class="form-label">Số thứ tự</label>
                                    <input id="stt" type="number" class="form-control">
                                </div>
                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label">Số ngày thuê</label>
                                    <input id="day" type="number" class="form-control">
                                </div>
                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label">Giá tiền thuê</label>
                                    <input id="money" type="number" class="form-control">
                                </div>
                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label">Tên lựa chọn</label>
                                    <input id="name" type="text" class="form-control">
                                </div>
                                
                            </div>
                            <div class="p-5 border-t border-gray-200 dark:border-dark-5 flex">
                                <button type="button" id="saveOptions" class="btn btn-success py-1 px-2">Thực hiện</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-12 lg:col-span-12 2xl:col-span-3 flex lg:block flex-col-reverse">
                        <div class="intro-y box mt-5">
                            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                <h2 class="font-medium text-base mr-auto">
                                    Danh sách gói thuê api
                                </h2>
                            </div>
                            <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table class="table table-report -mt-2" id="mytable">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">VỊ TRÍ</th>
                                    <th class="whitespace-nowrap">SỐ NGÀY THUÊ</th>
                                    <th class="text-center whitespace-nowrap">GIÁ TIỀN</th>
                                    <th class="text-center whitespace-nowrap">TÊN LỰA CHỌN</th>
                                    <th class="text-center whitespace-nowrap">THAO TÁC</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $getData=$NNL->get_list("SELECT * FROM `service` order by `stt` asc");
                            foreach( $getData as $momo) { ?>
                                <tr class="intro-x">
                                    <td><div class="font-medium whitespace-nowrap"><?=$momo['stt']?></div></td>
                                    <td class="text-center"><?=$momo['day']?></td>
                                    <td class="text-center"><?=$momo['money']?></td>
                                    <td class="text-center"><?=$momo['name']?></td>
                                    <td class="font-medium whitespace-nowrap">
                                        <div class="flex justify-center items-center">
                                            <a class="flex items-center mr-3" href="<?=BASE_URL('admin/Setting/Edit/')?><?=$momo['id']?>"> <i data-feather="edit" class="w-4 h-4 mr-1"></i> Chỉnh sửa</a>
                                            <a class="flex items-center" style="color:red" onclick="Delete(<?=$momo['id']?>)"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                                
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Content -->
        </div>
    </div>
    <script>
        $('#summernote').summernote({
        placeholder: 'Điền nội dung',
        tabsize: 2,
        height: 200,
      });
  
  </script>
    <script type="text/javascript">
    $("#saveOptions").on("click", function() {
        $('#saveOptions').html('Đang xử lý...').prop('disabled',
            true);
        var myData = {
            type: 'saveOptions',
            stt: $("#stt").val(),
            day: $("#day").val(),
            money: $("#money").val(),
            name: $("#name").val()
        };
        $.post("<?=BASE_URL("assets/ajaxs/Admin.php");?>", myData,
            function(data) {
                if (data.status == "1") {
                    Swal.fire("Thất Bại", data.msg, "error");
                    $('#saveOptions').html(
                            'Lưu')
                        .prop('disabled', false);
                } else {
                    Swal.fire("Thành công", data.msg, "success");
                    setTimeout(function() {
                        window.location = " "
                    }, 1000);
                    $('#saveOptions').html(
                            'Lưu')
                        .prop('disabled', false);
                }
            }, "json");
    });
    </script>
     <script type="text/javascript">
    $("#btnSaveOption").on("click", function() {
        $('#btnSaveOption').html('Đang xử lý...').prop('disabled',
            true);
        var myData = {
            type: 'btnSaveOption',
            token: $("#token").val(),
            email: $("#email").val(),
            pass_email: $("#pass_email").val(),
            noidung_naptien: $("#noidung_naptien").val(),
            luuy_naptien: $("#summernote").val(),
            sdt_momo: $("#sdt_momo").val(),
            name_momo: $("#name_momo").val()
        };
        $.post("<?=BASE_URL("assets/ajaxs/Admin.php");?>", myData,
            function(data) {
                if (data.status == "1") {
                    Swal.fire("Thất Bại", data.msg, "error");
                    $('#btnSaveOption').html(
                            'Lưu')
                        .prop('disabled', false);
                } else {
                    Swal.fire("Thành công", data.msg, "success");
                    setTimeout(function() {
                        window.location = " "
                    }, 1000);
                    $('#btnSaveOption').html(
                            'Lưu')
                        .prop('disabled', false);
                }
            }, "json");
    });

    function Delete(id) {
        Swal.fire({
            title: 'Xác Nhận Xóa Gói Thuê',
            text: "Bạn có đồng ý xóa không ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xóa ngay'
        }).then((result) => {
            if (result.isConfirmed) {
                var myData = {
                    type: 'DeleteService',
                    id: id
                };
                $.post("<?=BASE_URL("assets/ajaxs/Admin.php");?>", myData,
                    function(data) {
                        if (data.status == "1") {
                            Swal.fire("Thất Bại", data.msg, "error");
                           
                        } else {
                            Swal.fire("Thành công", data.msg, "success");
                           
                        }
                    }, "json");
            }
        })
    };
    </script>
    <?php require_once("../../public/Footer.php");?>