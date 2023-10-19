<?php
require_once("../config/config.php");
require_once("../config/function.php");
$title = 'Xác thực khôi phục | '.$NNL->site('tenweb');
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title><?=$title?></title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
    <script src="<?=BASE_URL('');?>assets/js/jquery-2.1.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL('');?>/assets/toastr/toastr.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL('');?>/assets/toastr/toastr.css" />
    <script type="text/javascript" src="<?=BASE_URL('');?>/assets/toastr/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
</head>
<body class="login-page">
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6">
					<img src="vendors/images/forgot-password.png" alt="">
				</div>
				<div class="col-md-6">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Xác thực khôi phục</h2>
						</div>
						<form>
							<div class="input-group custom">
								<input type="number" class="form-control form-control-lg" id="otp" placeholder="OTP">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" id="password" placeholder="Mật khẩu mới">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1" aria-hidden="true"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" id="repassword" placeholder="Nhập lại mật khẩu mới">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1" aria-hidden="true"></i></span>
								</div>
							</div>
							<div class="row align-items-center">
								<div class="col-5">
									<div class="input-group mb-0">
										<button type="submit" class="btn btn-primary btn-lg btn-block" id="ChangePassword">Xác thực</button>
									</div>
								</div>
								<div class="col-2">
									<div class="font-16 weight-600 text-center" data-color="#707373">OR</div>
								</div>
								<div class="col-5">
									<div class="input-group mb-0">
										<a class="btn btn-outline-primary btn-lg btn-block" href="<?=BASE_URL('dang-nhap')?>">Đăng nhập</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
    <script type="text/javascript">
$("#ChangePassword").on("click", function() {

    $('#ChangePassword').html('Loading...').prop('disabled',
        true);
    $.ajax({
        url: "<?=BASE_URL("assets/ajaxs/Auth.php");?>",
        method: "POST",
        data: {
            type: 'ChangePassword',
            otp: $("#otp").val(),
            password: $("#password").val(),
            repassword: $("#repassword").val()
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#ChangePassword').html(
                    'Xác thực')
                .prop('disabled', false);
        }
    });
});
</script>
    <div id="thongbao"></div>
    <script src="vendors/scripts/core.js"></script>
    <script src="vendors/scripts/script.min.js"></script>
    <script src="vendors/scripts/process.js"></script>
    <script src="vendors/scripts/layout-settings.js"></script>
</body>

</html>