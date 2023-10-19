<?php
include "../../config/config.php";
include "../../config/function.php";
include "../../class/Mbbank.php";
error_reporting(0);
set_time_limit(0);
date_default_timezone_set('Asia/Ho_Chi_Minh');
$MBBANK = new MBBANK;
$MBBANK->generateImei = $MBBANK->generateImei();
$MBBANK->refNo = check_string($_POST['phonembbank']) . '-' . time();
$MBBANK->userId = check_string($_POST['phonembbank']);
$MBBANK->pass = md5(check_string($_POST['passmbbank'] ));
//đăng nhập tpbank
if ($_POST['type'] == 'Login') 
{
    $checkLimit = $NNL->num_rows(" SELECT * FROM `account_mbbank` WHERE `username`='" . $_SESSION['username'] . "'");
    $getUser = $NNL->get_row(" SELECT * FROM `users` WHERE `username`='" . $_SESSION['username'] . "'");
    if($getUser['time_mbbank'] < time())
    {
        exit(json_encode(array('status' => '1', 'msg' => 'Gói API của bạn đã hết hạn sử dụng, vui lòng nâng cấp để tiếp tục sử dụng')));
    }
    $phonembbank = $_POST['phonembbank'];
    $passmbbank = $_POST['passmbbank'];
    $stkmbbank = $_POST['stkmbbank'];
    if (empty($phonembbank)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền tài khoản đăng nhập')));
    }
    if (empty($passmbbank)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền mật khẩu')));
    }
     if (empty($stkmbbank)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền số tài khoản')));
    }
    $time = time();
    $check = $MBBANK->LoginMbBank($phonembbank, $passmbbank);
    if($check['result']['message'] == 'Customer is invalid')
    {
        exit(json_encode(array('status' => '1', 'msg' => 'Thông tin không chính xác')));
    }
    else{
          $create = $NNL->insert("account_mbbank", [
            'username'      => $getUser['username'],
            'phone'         => $phonembbank,
            'stk'         => $stkmbbank,
            'name'         => $check['cust']['nm'],
            'password'      => $passmbbank,
            'sessionId'         => $check['sessionId'],
            'deviceId'       => $MBBANK->generateImei,
            'token'       => CreateToken(),
            'time'          => time()
        ]);
        exit(json_encode(array('status' => '2', 'msg' => 'Thêm tài khoản thành công')));

    }
}