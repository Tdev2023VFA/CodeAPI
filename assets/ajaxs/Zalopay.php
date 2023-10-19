<?php
include "../../config/config.php";
include "../../config/function.php";
include "../../class/Zalopay.php";
error_reporting(0);
set_time_limit(0);
date_default_timezone_set('Asia/Ho_Chi_Minh');
$Zalopay = new Zalopay;

//lấy otp
if ($_POST['type'] == 'GetOTP') {
    if (empty($_SESSION['username'])) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng đăng nhập để thực hiện')));
    }
    $getUser = $NNL->get_row(" SELECT * FROM `users` WHERE `username`='" . $_SESSION['username'] . "'");
    if ($getUser['time_mbbank'] < time()) {
        exit(json_encode(array('status' => '1', 'msg' => 'Gói API của bạn đã hết hạn sử dụng, vui lòng nâng cấp để tiếp tục sử dụng')));
    }
    $phone = check_string($_POST['phonezalopay']);
    $pass = check_string($_POST['passzalopay']);
    if (empty($phone)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền số điện thoại')));
    }
    if (empty($pass)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền mật khẩu')));
    }
    $checkLimit = $NNL->num_rows(" SELECT * FROM `account_zalopay` WHERE `username`='" . $getUser['username'] . "'");
    if ($checkLimit >= $NNL->site('limit_api_zalopay')) {
        exit(json_encode(array('status' => '1', 'msg' => 'Quý dị chỉ được thêm tối đa '.$NNL->site('limit_api_zalopay').' tài khoản zalopay')));
    }
    $Zalopay->phone = $phone;
    $Zalopay->password = $pass;
    $Zalopay->deviceid = $Zalopay->get_device_id();
    $Zalopay->send_otp_token = json_decode($Zalopay->get_otp_token(),true)['data']['send_otp_token'];
    $tam =  json_encode($Zalopay->get_otp());
    if(json_decode($tam,true)['error']['error'] == 'InvalidArgument'){
        exit(json_encode(array('status' => '1', 'msg' => '' . json_decode($tam,true)['error']['details']['localized_message']['message'] . '')));
    }
     $isInsert =  $NNL->insert("account_zalopay", [
            'phone'               => $phone,
            'password'               => $pass,
            'username'                 => $getUser['username'],
            'deviceId'                => $Zalopay->deviceid,
            'salt'                    => null,
            'public_key'             => null,
            'otp'           => null,
            'token'                => CreateToken(),
            'time'               => time(),
        ]);
        if($isInsert)
        {
            exit(json_encode(array('status' => '2', 'msg' => 'Đã gửi mã otp đến số điện thoại của bạn')));
        }else{
            exit(json_encode(array('status' => '1', 'msg' => 'Có lỗi xảy ra')));
        }
}
if ($_POST['type'] == 'Login') 
{
    // $checkLimit = $NNL->num_rows(" SELECT * FROM `account_mbbank` WHERE `username`='" . $_SESSION['username'] . "'");
    $getUser = $NNL->get_row(" SELECT * FROM `users` WHERE `username`='" . $_SESSION['username'] . "'");
    if($getUser['time_mbbank'] < time())
    {
        exit(json_encode(array('status' => '1', 'msg' => 'Gói API của bạn đã hết hạn sử dụng, vui lòng nâng cấp để tiếp tục sử dụng')));
    }
    $phonezalopay = check_string($_POST['phonezalopay']);
    $passzalopay = check_string($_POST['passzalopay']);
    $otp = check_string($_POST['otp']);
    if (empty($phonezalopay)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền tài khoản đăng nhập')));
    }
    if (empty($passzalopay)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền mật khẩu')));
    }
    if (empty($otp)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền otp')));
    }
   
    $GetData = $NNL->get_row(" SELECT * FROM `account_zalopay` WHERE `phone` = '" . $phonezalopay . "' LIMIT 1  ");
    $Zalopay->phone = $phonezalopay;
    $Zalopay->password = $passzalopay;
    $Zalopay->otp = $otp;
    $check_otp =  $Zalopay->xac_thuc_otp();
    if(isset($check_otp['error'])){
        exit(json_encode(array('status' => '1', 'msg' => '' . $check_otp['error']['details']['localized_message']['message'] . '')));
    }
    $Zalopay->deviceid = $GetData['deviceId'];
    $Zalopay->public_key = json_decode($Zalopay->get_public_key(),true)['data']['public_key'];
    $Zalopay->salt = json_decode($Zalopay->get_salt(),true)['data']['salt'];
    $Zalopay->token = $Zalopay->xac_thuc_otp()['data']['phone_verified_token'];
    $login =  $Zalopay->ZaloLogin();
    if(isset($login['error'])){
        exit(json_encode(array('status' => '1', 'msg' => '' . $login['error']['details']['localized_message']['message'] . '')));
    }
    // exit(json_encode(array('status' => '1', 'msg' => '' . $login['data']['zalo_id'] . '')));
   
          $updateZalopay = $NNL->update("account_zalopay", [
            'salt' =>  $Zalopay->salt,
            'public_key' =>  $Zalopay->public_key,
            'otp' =>  $Zalopay->otp,
            'session_id'      => $login['data']['session_id'],
            'display_name'         => $login['data']['display_name'],
            'access_token'         => $login['data']['access_token'],
            'zalo_id'         => $login['data']['zalo_id'],
            'user_id'      => $login['data']['user_id'],
            'profile_level'         => $login['data']['profile_level'],
        ], " `phone` = '" . $phonezalopay . "' ");
        if($updateZalopay)
        {
            exit(json_encode(array('status' => '2', 'msg' => 'Thêm tài khoản thành công')));
        }else{
            exit(json_encode(array('status' => '1', 'msg' => 'Thêm tài khoản thất bại')));
        }


}