<?php
require_once("../config/config.php");
require_once("../config/function.php");
$title = 'THÔNG TIN CÁ NHÂN | '.$NNL->site('tenweb');
require_once("../public/Header.php");
CheckLogin();
?>
<section class="p-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-12 mb-5">
                <?php require_once("../public/Tab.php");?>
            </div>
            <div class="col-md-9 col-12 mb-5">
                <div class="box-table shadow">
                    <h5 class="text-left px-2" style="border-left:4px solid green;color: #d8e2ef;">ĐỔI MẬT
                        KHẨU</h5>
                    <div class="row">
                        <div class="col">
                            <input type="password" id="password" class="form-control"
                                placeholder="Mật khẩu mới" aria-label="Mật khẩu mới">
                        </div>
                        <div class="col">
                            <input type="password" id="repassword" class="form-control"
                                placeholder="Nhập lại mật khẩu mới">
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-primary" id="DoiMatKhau">ĐỔI MẬT
                                KHẨU</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
$("#DoiMatKhau").on("click", function() {
    $('#DoiMatKhau').html('ĐANG XỬ LÝ').prop('disabled',
        true);
    $.ajax({
        url: "<?=BASE_URL("assets/ajaxs/Auth.php");?>",
        method: "POST",
        data: {
            type: 'DoiMatKhau',
            password: $("#password").val(),
            repassword: $("#repassword").val()
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#DoiMatKhau').html(
                    'ĐỔI MẬT KHẨU')
                .prop('disabled', false);
        }
    });
});
</script>
<?php 
require_once("../public/Footer.php");
?>