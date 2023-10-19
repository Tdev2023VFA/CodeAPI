<?php 
 require_once("../../config/config.php");
 require_once("../../config/function.php");
// if (!defined('IN_SITE')) {
//     die('The Request Not Found');
// }

$body['header'] = '';
$body['footer'] = '';
$body = [
    'title' => 'Đăng nhập quản trị'
];
require_once(__DIR__.'/Header.php');
?>
<link rel="stylesheet" href="<?=URL('theme/css/LoginAdmin.css');?>">
<div class="background-wrap">
    <div class="background"></div>
</div>
<form id="accesspanel" action="" method="post">
    <h1 id="litheader">SHOP TOOL NRO</h1>
    <div class="inset">
        <p>
            <input type="text" name="username" id="username" placeholder="Username">
        </p>
        <p>
            <input type="password" name="password" id="password" placeholder="Password">
        </p>
        <div style="text-align: center;">
            <label>Vui lòng đăng nhập</label>
        </div>
    </div>
    <p class="p-container">
        <button class="btn-login" type="button" name="btnLogin" id="btnLogin">Login</button>
    </p>
</form>
<script>
$("#btnLogin").on("click", function() {
    $('#btnLogin').html('<i class="fa fa-spinner fa-spin"></i> Loading...').prop('disabled',
        true);
    $.ajax({
        url: "<?=URL('ajaxs/admin/Login.php');?>",
        method: "POST",
        dataType: "JSON",
        data: {
            username: $("#username").val(),
            password: $("#password").val()
        },
        success: function(respone) {
            if (respone.status == 'success') {
                cuteToast({
                    type: "success",
                    message: respone.msg,
                    timer: 5000
                });
                setTimeout("location.href = '<?=URL('AdminTool/Home');?>';", 1000);
            } else if (respone.status == 'verify') {
                cuteToast({
                    type: "warning",
                    message: respone.msg,
                    timer: 5000
                });
                setTimeout("location.href = '" + respone.url + "';", 1000);
            } else {
                cuteToast({
                    type: "error",
                    message: respone.msg,
                    timer: 5000
                });
            }
            $('#btnLogin').html('Login').prop('disabled', false);
        },
        error: function() {
            cuteToast({
                type: "error",
                message: 'Không thể xử lý',
                timer: 5000
            });
        }

    });
});
</script>