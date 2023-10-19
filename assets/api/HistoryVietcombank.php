<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
require_once("../../class/VCB.php");
error_reporting(0);
$vcb = new VCB;
//lấy lịch sử giao dịch
if (isset($_GET["token"])) {
    $getData = $NNL->get_row(" SELECT * FROM `vietcombank` WHERE `token` = '" . xss($_GET["token"]) . "' LIMIT 1");
    if ($getData) {
        $myUser = $NNL->get_row(" SELECT * FROM `users` WHERE `id` = '" . $getData["user_id"] . "'");
        if ($myUser['time_vcb'] < time()) {
            exit(json_encode(array('status' => 'false', 'msg' => 'Tài khoản của bạn đã hết hạn sử dụng, vui lòng nâng cấp gói để tiếp tục sử dụng!')));
        } else {

               $lichsu = $vcb->get_lsgd($getData['username'], $getData['account'], $getData['session_id'], $getData['cif'], $getData['client_id'], $getData['mobile_id']);
                if (json_decode($lichsu)->code != '00') {
                    $response = getCaptcha($NNL->site('key_captcha'));
                    $captcha_id =  json_decode($response, true)['data']['captcha_id'];
                    $captcha = json_decode($response, true)['data']['captcha'];
                    $token = md5(random('QWERTYUIOPASDGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm0123456789', 6) . time());
                    $login = json_decode($vcb->login($getData['username'], $getData['password'], $captcha_id, $captcha), true);
                    if ($login['code'] == '00') {
                        $NNL->update("vietcombank", [
                            'session_id'           => $login['sessionId'],
                            'access_key'                => $login['accessKey'],
                            'client_id'           => $login['userInfo']['clientId'],
                            'mobile_id'           => $login['userInfo']['mobileId'],
                            'cif'                => $login['userInfo']['cif'],
                        ], " `username` = '" . $getData['username'] . "' ");
       
                    }
                } else {
                    echo $lichsu;
                }
        }
    } else {
        exit(json_encode(array('status' => 'false', 'msg' => 'Token không tồn tại!')));
    }
}
//lấy số dư nha
if (isset($_GET["balancetoken"])) {
    $getData = $NNL->get_row(" SELECT * FROM `vietcombank` WHERE `token` = '" . xss($_GET["balancetoken"]) . "' LIMIT 1");
    if ($getData) {
        $myUser = $NNL->get_row(" SELECT * FROM `users` WHERE `id` = '" . $getData["user_id"] . "'");
        if ($myUser['time_vcb'] < time()) {
            exit(json_encode(array('status' => 'false', 'msg' => 'Tài khoản của bạn đã hết hạn sử dụng, vui lòng nâng cấp gói để tiếp tục sử dụng!')));
        } else {

            $lichsu = json_decode($vcb->get_balance($getData['username'], $getData['account'], $getData['session_id'], $getData['cif'], $getData['client_id'], $getData['mobile_id']), true);
                if ($lichsu['code'] != '00') {
                    $response = getCaptcha($NNL->site('key_captcha'));
                    $captcha_id =  json_decode($response, true)['data']['captcha_id'];
                    $captcha = json_decode($response, true)['data']['captcha'];
                    $token = md5(random('QWERTYUIOPASDGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm0123456789', 6) . time());
                    $login = json_decode($vcb->login($getData['username'], $getData['password'], $captcha_id, $captcha), true);
                    if ($login['code'] == '00') {
                        $NNL->update("vietcombank", [
                            'session_id'           => $login['sessionId'],
                            'access_key'                => $login['accessKey'],
                            'client_id'           => $login['userInfo']['clientId'],
                            'mobile_id'           => $login['userInfo']['mobileId'],
                            'cif'                => $login['userInfo']['cif'],
                        ], " `username` = '" . $getData['username'] . "' ");
                    }
                } else {
                    if (isset($lichsu['code']) == '00') {
                        exit(json_encode(array('status' => '200', 'SoDu' => '' . str_replace(',', '', $lichsu['accountDetail']['availBalance']) . '')));
                    } else {
                        exit(json_encode(array('status' => '99', 'SoDu' => '0')));
                    }
                }
        }
    }
}
if (isset($_GET["listbanktoken"])) {
    $getData = $NNL->get_row(" SELECT * FROM `account_mbbank` WHERE `token` = '" . xss($_GET["listbanktoken"]) . "'");
    if ($getData) {
        if ($getData['time'] < time() - 180) {
            $MBBANK->generateImei = $MBBANK->generateImei();
            $MBBANK->refNo = check_string($getData['phone']) . '-' . time();
            $MBBANK->userId = check_string($getData['phone']);
            $MBBANK->pass = md5(check_string($getData['password']));
            $check = $MBBANK->LoginMbBank($getData['phone'], $getData['password']);
            if ($check['result']['message'] == 'Customer is invalid') {
                exit(json_encode(array('status' => '1', 'msg' => 'Thông tin không chính xác')));
            } else {
                $NNL->update("account_mbbank", [
                    'name'         => $check['cust']['nm'],
                    'password'      => $getData['password'],
                    'sessionId' => $check['sessionId'],
                    'deviceId' => $MBBANK->generateImei,
                    'time'  => time()
                ], " `phone` = '" . $getData['phone'] . "' ");
            }
        }
        $balance = $MBBANK->inquiryAccountName($getData['phone'], $getData['sessionId'], $getData['deviceId'],$getData['stk'],'970418','65010003347874');
        print_r($balance);
       
        // if ($balance['result']['message'] == 'OK') {
        //     foreach ($balance['acct_list'] as $data) {
        //     if ($data['acctNo'] == $getData['stk']) {
        //         $status = true;
        //         $message = 'Giao dịch thành công';
        //         exit(json_encode(array('status' => '200', 'SoDu' => '' . $data['currentBalance'] . '')));
        //         }
        //      }
            
        // } else {
        //     exit(json_encode(array('status' => '99', 'SoDu' => '0')));
        // }
    }
}