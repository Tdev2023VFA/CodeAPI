<?php
include "../../config/config.php";
include "../../config/function.php";
include "../../class/Tpbank.php";
error_reporting(0);
set_time_limit(0);
date_default_timezone_set('Asia/Ho_Chi_Minh');
$TPBANK = new TPBANK;
//đăng nhập tpbank
if ($_POST['type'] == 'Login') 
{
    $checkLimit = $NNL->num_rows(" SELECT * FROM `account_tpbank` WHERE `username`='" . $_SESSION['username'] . "'");
    $getUser = $NNL->get_row(" SELECT * FROM `users` WHERE `username`='" . $_SESSION['username'] . "'");
    if($getUser['time_mbbank'] < time())
    {
        exit(json_encode(array('status' => '1', 'msg' => 'Gói API của bạn đã hết hạn sử dụng, vui lòng nâng cấp để tiếp tục sử dụng')));
    }
    $phonetpbank = $_POST['phonetpbank'];
    $passtpbank = $_POST['passtpbank'];
    $stktpbank =  $_POST['stktpbank'];
    if (empty($phonetpbank)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền tài khoản đăng nhập')));
    }
    if (empty($passtpbank)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền mật khẩu')));
    }
    if(empty($stktpbank))
    {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền số tài khoản')));
    }
    $time = time();
    $check = json_decode($TPBANK ->get_token($phonetpbank, $passtpbank));
    if($check->error->error_code == 50525)
    {
        exit(json_encode(array('status' => '1', 'msg' => 'Thông tin không chính xác')));
   }
    else{
          $create = $NNL->insert("account_tpbank", [
            'username'      => $getUser['username'],
            'phone'         => $phonetpbank,
            'password'      => $passtpbank,
            'stk'         =>   $stktpbank,
            'token'       => CreateToken(),
            'access_token'         => $check->access_token,
            'time'          => time()
        ]);
        exit(json_encode(array('status' => '2', 'msg' => 'Thêm tài khoản thành công')));

    }
}