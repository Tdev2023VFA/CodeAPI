<?php
include "../../config/config.php";
include "../../config/function.php";
include "../../class/ACB.php";
error_reporting(0);
set_time_limit(0);
date_default_timezone_set('Asia/Ho_Chi_Minh');
$acb = new ACB;
//đăng nhập tpbank
if ($_POST['type'] == 'Login') 
{
    $username = xss($_POST['phonembbank']);
    $password = xss($_POST['passmbbank']);
    $account = xss($_POST['stkmbbank']);
    if(empty($_SESSION['username'])){
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng đăng nhập')));
    }
    $getUser = $NNL->get_row(" SELECT * FROM `users` WHERE `username`='" . $_SESSION['username'] . "'");
    if($getUser['time_vcb'] < time())
    {
        exit(json_encode(array('status' => '1', 'msg' => 'Gói API của bạn đã hết hạn sử dụng, vui lòng nâng cấp để tiếp tục sử dụng')));
    }

    if (empty($username)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền tài khoản đăng nhập')));
    }
    if (empty($password)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền mật khẩu')));
    }
     if (empty($account)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền số tài khoản')));
    }
    // $time = time();

    $acb->clientId = "iuSuHYVufIUuNIREV0FB9EoLn9kHsDbm";
    $login_check = $acb->login_acb($username, $password);
    exit(json_encode(array('status' => '1', 'msg' => 'Thông tin đăng nhập không chính xác')));
    // if (isset($login_check["errorCode"])) {
    //     exit(json_encode(array('status' => '1', 'msg' => 'Thông tin đăng nhập không chính xác')));
    // } 
    // else {
    //   $create = $NNL->insert("account_acb", [
    //         'user_id'      => $getUser['id'],
    //         'name'         => $login_check['identity']['displayName'],
    //         'username'         => $username,
    //         'password'         => $password,
    //         'account'      => $account,
    //         'access_token'         => $login_check['accessToken'],
    //         'refreshToken'       => $login_check['refreshToken'],
    //         'token'       => CreateToken(),
    //         'time'          => time()
    //     ]);
    //     exit(json_encode(array('status' => '2', 'msg' => 'Thêm tài khoản thành công')));
    // }
    
}