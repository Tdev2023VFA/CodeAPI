<?php
include "../../config/config.php";
include "../../config/function.php";
include "../../class/momo.php";
// error_reporting(0);
set_time_limit(0);
date_default_timezone_set('Asia/Ho_Chi_Minh');
$Momo = new MomoV2;

//lấy otp
if ($_POST['type'] == 'GetOTP') {
    if (empty($_SESSION['username'])) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng đăng nhập để thực hiện')));
    }
    $getUser = $NNL->get_row(" SELECT * FROM `users` WHERE `username`='" . $_SESSION['username'] . "'");
    if ($getUser['time_api'] < time()) {
        exit(json_encode(array('status' => '1', 'msg' => 'Gói API của bạn đã hết hạn sử dụng, vui lòng nâng cấp để tiếp tục sử dụng')));
    }
    $phone = xss($_POST['sdt']);
    $pass = xss($_POST['pass']);
    if (empty($phone)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền số điện thoại')));
    }
    if (empty($pass)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền mật khẩu')));
    }
    $checkLimit = $NNL->num_rows(" SELECT * FROM `cron_momo` WHERE `user_id`='" . $getUser['username'] . "'");
    if ($checkLimit > $getUser['port_momo']) {
        exit(json_encode(array('status' => '1', 'msg' => 'Quý dị chỉ được thêm tối đa '.$getUser['port_momo'].' tài khoản momo')));
    }
    
    $checkphone = json_decode($Momo->namemomo($phone));
    if ($checkphone->error == 0) {
        exit(json_encode(array('status' => '1', 'msg' => '' . $checkphone->msg . '')));
    }

    $getDevice = $NNL->get_row(" SELECT * FROM `device` ORDER BY RAND() LIMIT 1 ");
    if (!$NNL->get_row("SELECT * FROM `cron_momo` WHERE `phone` = '" . $phone . "' ")) {
        $NNL->insert("cron_momo", [
            'phone'               => $phone,
            'user_id'                 => $getUser['username'],
            'imei'                => $Momo->generateImei(),
            'SECUREID'                    => $Momo->get_SECUREID(),
            'rkey'             => $Momo->generateRandom(20),
            'AAID'           => $Momo->generateImei(),
            'TOKEN'           => $Momo->get_TOKEN(),
            'device'                => $getDevice["device"],
            'hardware'               => $getDevice["hardware"],
            'facture'           => $getDevice['facture'],
            'status'             => 'pending',
            'MODELID'           => $getDevice['MODELID']
        ]);
    }
    $Momo->config = $NNL->get_row(" SELECT * FROM `cron_momo` WHERE `phone` = '" . $phone . "' LIMIT 1  ");
    $Momo->CHECK_USER_BE_MSG();
    $result = $Momo->SEND_OTP_MSG();
    if ($result["errorCode"] == '0') {
        exit(json_encode(array('status' => '2', 'msg' => '' . $result["errorDesc"] . '!')));
    } else {
        exit(json_encode(array('status' => '1', 'msg' => '' . $result["errorDesc"] . '!')));
    }
}
//đăng nhập momo
if ($_POST['type'] == 'Login') {
    if (empty($_SESSION['username'])) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng đăng nhập để thực hiện')));
    }
    $getUser = $NNL->get_row(" SELECT * FROM `users` WHERE `username`='" . $_SESSION['username'] . "'");
    if ($getUser['time_api'] < time()) {
        exit(json_encode(array('status' => '1', 'msg' => 'Gói API của bạn đã hết hạn sử dụng, vui lòng nâng cấp để tiếp tục sử dụng')));
    }
    $checkLimit = $NNL->num_rows(" SELECT * FROM `cron_momo` WHERE `user_id`='" . $getUser['username'] . "'");
    if ($checkLimit > $getUser['port_momo']) {
        exit(json_encode(array('status' => '1', 'msg' => 'Quý dị chỉ được thêm tối đa '.$getUser['port_momo'].' tài khoản momo')));
    }
    if (empty($_POST['sdt'])) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền số điện thoại')));
    }
    if (empty($_POST['pass'])) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền mật khẩu')));
    }
    if (empty($_POST['otp'])) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền OTP')));
    }
    $phone = xss($_POST['sdt']);
    $pass = xss($_POST['pass']);
    $code = xss($_POST['otp']);
    $Momo->config = $NNL->get_row(" SELECT * FROM `cron_momo` WHERE `phone` = '" . $phone . "' LIMIT 1  ");
    $Momo->config['ohash'] = hash('sha256', $Momo->config["phone"] . $Momo->config["rkey"] . $code);
    $NNL->update("cron_momo", [
        'ohash' => $Momo->config['ohash']
    ], " `phone` = '" . $phone . "' ");
    $result = $Momo->REG_DEVICE_MSG();
    // $NNL->update("cron_momo", [
    //     'errorDesc' => $result["errorDesc"]
    // ], " `phone` = '" . $phone . "' ");
    $setupKeyDecrypt = $Momo->get_setupKey($result["extra"]["setupKey"]);
    $NNL->update("cron_momo", [
        'setupKey' => $result["extra"]["setupKey"],
        'status' => 'success',
        'setupKeyDecrypt' => $setupKeyDecrypt
    ], " `phone` = '" . $phone . "' ");
    $Momo->config = $NNL->get_row(" SELECT * FROM `cron_momo` WHERE `phone` = '" . $phone . "' LIMIT 1  ");
    $Momo->config["password"] = $pass;
    $result = $Momo->USER_LOGIN_MSG();

    if ($result["errorCode"] == '0') {

        $extra = $result["extra"];
        $BankVerify = ($result['momoMsg']['bankVerifyPersonalid'] == 'null') ? '1' : '2';
        $partnerCode = $result['momoMsg']['bankCode'] ?: '';
        $NNL->update("cron_momo", [
            'password' => $Momo->config["password"],
            'authorization' => $extra["AUTH_TOKEN"],
            'try' => '0',
            'BankVerify' => $BankVerify,
            'agent_id' => $result["momoMsg"]["agentId"],
            'RSA_PUBLIC_KEY' => $extra["REQUEST_ENCRYPT_KEY"],
            'Name' => $extra["FULL_NAME"],
            'BALANCE' => $extra["BALANCE"],
            'refreshToken' => $extra["REFRESH_TOKEN"],
            'sessionkey' => $extra["SESSION_KEY"],
            'partnerCode' => $partnerCode,
            'errorDesc' => $result["errorCode"],
            'status' => 'success',
            'errorDesc' => 'Thành Công',
            'TimeLogin' => time()
        ], " `phone` = '" . $phone . "' ");
        exit(json_encode(array('status' => '2', 'msg' => 'Xác nhận otp thành công!')));
    } else {
        exit(json_encode(array('status' => '1', 'msg' => 'Xác nhận otp thất bại!')));
    }
}
//chuyển tiền momo
if ($_POST['type'] == 'sendMoney') {
    if (empty($_SESSION['username'])) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng đăng nhập để thực hiện')));
    }
    $getUser = $NNL->get_row(" SELECT * FROM `users` WHERE `username`='" . $_SESSION['username'] . "'");
    if ($getUser['time_api'] < time()) {
        exit(json_encode(array('status' => '1', 'msg' => 'Gói API của bạn đã hết hạn sử dụng, vui lòng nâng cấp để tiếp tục sử dụng')));
    }
    $phone = xss($_POST['phone']);
    $from = xss($_POST['from']);
    $money = xss($_POST['money']);
    $pass = xss($_POST['pass']);
    $content = xss($_POST['content']);

    if (empty($phone)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng nhập số điện thoại cần chuyển')));
    }
    if (empty($pass)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng nhập mật khẩu')));
    }
    if (empty($money)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng nhập số tiền cần chuyển')));
    }
    if (empty($content)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng nhập nội dung')));
    }
    if ($money < 100) {
        exit(json_encode(array('status' => '1', 'msg' => 'Số tiền chuyển phải lớn hơn 100đ')));
    }
    $checkUser = $NNL->get_row(" SELECT * FROM `cron_momo` WHERE `phone` = '" . $from . "' AND `user_id`='" . $getUser['username'] . "' AND `password`='".$pass."' LIMIT 1  ");
    if($checkUser)
    {
        $Momo->config = $checkUser;
        if($Momo->config['TimeLogin'] < time() - 1800)
        {
             $result1 = $Momo->GENERATE_TOKEN_AUTH_MSG();
                    $extra = $result1["extra"];
                    $authen_token = $result1["AUTH_TOKEN"];
                    if(!isset($authen_token)){
                          $result_login = $Momo->USER_LOGIN_MSG();
                            $extra_login = $result_login["extra"];
                            $BankVerify = ($result_login['momoMsg']['bankVerifyPersonalid'] == 'null') ? '1' : '2';
                            $partnerCode = $result_login['momoMsg']['bankCode'] ?: '';
                            $NNL->update("cron_momo", [
                                'authorization' => $extra_login["AUTH_TOKEN"],
                                'try' => '0',
                                'BankVerify' => $BankVerify,
                                'agent_id' => $result_login["momoMsg"]["agentId"],
                                'RSA_PUBLIC_KEY' => $extra_login["REQUEST_ENCRYPT_KEY"],
                                'refreshToken' => $extra_login["REFRESH_TOKEN"],
                                'sessionkey' => $extra_login["SESSION_KEY"],
                                'partnerCode' => $partnerCode,
                                'errorDesc' => $extra_login["errorCode"],
                                'status' => 'success',
                                'errorDesc' => 'Thành Công',
                                'TimeLogin' => time()
                            ], " `phone` = '" . $Momo->config['phone'] . "' ");
                    }
                    else{
                        $NNL->update("cron_momo", [
                            'authorization' => $extra["AUTH_TOKEN"],
                            'RSA_PUBLIC_KEY' => $extra["REQUEST_ENCRYPT_KEY"],
                            'sessionkey' => $extra["SESSION_KEY"],
                            'errorDesc' => $result1["errorCode"],
                            'TimeLogin'  => time()
                        ], " `phone` = '" . $Momo->config['phone'] . "' ");
                    }
                    
        }
        $result = $Momo->SendMoney($phone, $money, $content);
        $data_send = $result['full'];
        $NNL->insert("send", [
            'momo_id'               => isset($result['tranDList']['ID']) ? $result['tranDList']['ID'] : "default",
            'tranId'                 => isset($result['tranDList']['tranId']) ? $result['tranDList']['tranId'] : "default",
            'partnerId'                => isset($result['tranDList']['partnerId']) ? $result['tranDList']['partnerId'] : "default",
            'partnerName'                    => isset($result['tranDList']['partnerName']) ? $result['tranDList']['partnerName'] : "default",
            'amount'             => isset($result['tranDList']['amount']) ? $result['tranDList']['amount'] : "default",
            'comment'           => isset($result['tranDList']['comment']) ? $result['tranDList']['comment'] : "default",
            'time'           => time(),
            'user_id'                => $getUser["username"],
            'status'               => $result['status'],
            'message'           => $result['message'],
            'data'             => $data_send,
            'balance'           => $result['tranDList']['balance'],
            'ownerNumber'             => isset($result['tranDList']['ownerNumber']) ? $result['tranDList']['ownerNumber'] : "default",
            'ownerName'           => isset($result['tranDList']['ownerName']) ? $result['tranDList']['ownerName'] : "default"
        ]);
        exit(json_encode(array('status' => $result['status'], 'msg' => $result['message'])));
    }
    else{
        exit(json_encode(array('status' => 1, 'msg' => 'Thông tin không đúng')));
    }
    
}
if ($_POST['type'] == 'getName') {
    $phone = xss($_POST['phone']);
    $checkphone = json_decode($Momo->namemomo($phone));
    if ($checkphone->error == 0) {
        exit(json_encode(array('status' => '1', 'msg' => '' . $checkphone->msg . '')));
    }
    else{
        exit(json_encode(array('status' => '2', 'msg' => '' . $checkphone->msg . '')));
    }
}
if ($_POST['type'] == 'getNameBank') {
    $bankcode = xss($_POST['bankcode']);
    $phone = xss($_POST['phone']);
    $account_number = xss($_POST['account_number']);
    if (empty($bankcode)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng chọn ngân hàng')));
    }
    if (empty($account_number)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng nhập số tài khoản')));
    }
    if (empty($phone)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng nhập số điện thoại')));
    }
    $checkUser = $NNL->get_row(" SELECT * FROM `cron_momo` WHERE `phone` = '" . $phone . "' AND `user_id`='" . $getUser['username'] . "' LIMIT 1  ");
    if(!$checkUser)
    {
        exit(json_encode(array('status' => '1', 'msg' => 'Không tồn tại momo hoặc không phải của bạn')));
    }
    $token = $checkUser['setupKeyDecrypt'];
    $result = getName_bank($token,$bankcode,$account_number);
    exit(json_encode(array('status' => 2, 'msg' => $result)));

}
if ($_POST['type'] == 'sendBank') {
     if (empty($_SESSION['username'])) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng đăng nhập để thực hiện')));
    }
    $getUser = $NNL->get_row(" SELECT * FROM `users` WHERE `username`='" . $_SESSION['username'] . "'");
    if ($getUser['time_api'] < time()) {
        exit(json_encode(array('status' => '1', 'msg' => 'Gói API của bạn đã hết hạn sử dụng, vui lòng nâng cấp để tiếp tục sử dụng')));
    }
    $phone = xss($_POST['phone']);
    $money = xss($_POST['money']);
    $pass = xss($_POST['pass']);
    $bankcode = xss($_POST['bankcode']);
    $account_number = xss($_POST['account_number']);
    $content = xss($_POST['content']);

    if (empty($bankcode)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng chọn ngân hàng')));
    }
    if (empty($account_number)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng nhập số tài khoản')));
    }
    if (empty($money)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng nhập số tiền cần rút về bank')));
    }
    if ($money < 10000) {
        exit(json_encode(array('status' => '1', 'msg' => 'Bạn có thể rút tối thiểu 10.000đ')));
    }
    if (empty($pass)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng nhập mật khẩu momo')));
    }
    if (empty($content)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng nhập nội dung')));
    }
    $checkUser = $NNL->get_row(" SELECT * FROM `cron_momo` WHERE `phone` = '" . $phone . "' AND `user_id`='" . $getUser['username'] . "' AND `password`='".$pass."' LIMIT 1  ");
    if($checkUser)
    {
        $Momo->config = $checkUser;
        if($Momo->config['TimeLogin'] < time() - 1800)
        {
             $result1 = $Momo->GENERATE_TOKEN_AUTH_MSG();
                    $extra = $result1["extra"];
                    $authen_token = $result1["AUTH_TOKEN"];
                    if(!isset($authen_token)){
                          $result_login = $Momo->USER_LOGIN_MSG();
                            $extra_login = $result_login["extra"];
                            $BankVerify = ($result_login['momoMsg']['bankVerifyPersonalid'] == 'null') ? '1' : '2';
                            $partnerCode = $result_login['momoMsg']['bankCode'] ?: '';
                            $NNL->update("cron_momo", [
                                'authorization' => $extra_login["AUTH_TOKEN"],
                                'try' => '0',
                                'BankVerify' => $BankVerify,
                                'agent_id' => $result_login["momoMsg"]["agentId"],
                                'RSA_PUBLIC_KEY' => $extra_login["REQUEST_ENCRYPT_KEY"],
                                'refreshToken' => $extra_login["REFRESH_TOKEN"],
                                'sessionkey' => $extra_login["SESSION_KEY"],
                                'partnerCode' => $partnerCode,
                                'errorDesc' => $extra_login["errorCode"],
                                'status' => 'success',
                                'errorDesc' => 'Thành Công',
                                'TimeLogin' => time()
                            ], " `phone` = '" . $Momo->config['phone'] . "' ");
                    }
                    else{
                        $NNL->update("cron_momo", [
                            'authorization' => $extra["AUTH_TOKEN"],
                            'RSA_PUBLIC_KEY' => $extra["REQUEST_ENCRYPT_KEY"],
                            'sessionkey' => $extra["SESSION_KEY"],
                            'errorDesc' => $result1["errorCode"],
                            'TimeLogin'  => time()
                        ], " `phone` = '" . $Momo->config['phone'] . "' ");
                    }
                    
        }
        $result = $Momo->SendMoneyBank($bankcode,$account_number, $money, $content);
        $data_send = $result['full'];
        $NNL->insert("send_bank", [
            'momo_id'               => isset($result['tranDList']['ID']) ? $result['tranDList']['ID'] : "default",
            'tranId'                 => isset($result['tranDList']['tranId']) ? $result['tranDList']['tranId'] : "default",
            'partnerId'                => isset($result['tranDList']['partnerId']) ? $result['tranDList']['partnerId'] : "default",
            'partnerName'                    => isset($result['tranDList']['partnerName']) ? $result['tranDList']['partnerName'] : "default",
            'amount'             => isset($result['tranDList']['amount']) ? $result['tranDList']['amount'] : "default",
            'comment'           => isset($result['tranDList']['comment']) ? $result['tranDList']['comment'] : "default",
            'time'           => time(),
            'user_id'                => $getUser["username"],
            'status'               => $result['status'],
            'message'           => $result['message'],
            'data'             => $data_send,
            'balance'           => $result['tranDList']['balance'],
            'ownerNumber'             => isset($result['tranDList']['ownerNumber']) ? $result['tranDList']['ownerNumber'] : "default",
            'ownerName'           => isset($result['tranDList']['ownerName']) ? $result['tranDList']['ownerName'] : "default"
        ]);
        exit(json_encode(array('status' => $result['status'], 'msg' => $result['message'])));
    }

}
if ($_POST['type'] == 'anti-theft') {
    $id = xss($_POST['id']);
    $status = xss($_POST['status']);
    $ip = xss($_POST['ip']);
    if (empty($status)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng chọn trạng thái')));
    }
    if (empty($ip)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng nhập ip cho phép chuyển')));
    }
    
    $checkUser = $NNL->get_row(" SELECT * FROM `cron_momo` WHERE `id` = '" . $id . "' AND `user_id`='" . $getUser['username'] . "' LIMIT 1  ");
    if(!$checkUser)
    {
        exit(json_encode(array('status' => '1', 'msg' => 'Không tồn tại momo hoặc không phải của bạn')));
    }
     $isUpdate = $NNL->update("cron_momo", [
                            'ip_white' => $ip,
                            'status_anti' => $status
                        ], " `id` = '" . $checkUser['id'] . "' ");
    if($isUpdate){
        exit(json_encode(array('status' => '2', 'msg' => 'Lưu thành công')));
    }else{
        exit(json_encode(array('status' => '1', 'msg' => 'Lưu thất bại')));
    }

}
