<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
require_once("../../class/Zalopay.php");
error_reporting(0);
$Zalopay = new Zalopay;
//lấy lịch sử giao dịch
if (isset($_GET["token"])) {
    $getData = $NNL->get_row(" SELECT * FROM `account_zalopay` WHERE `token` = '" . $_GET["token"] . "' LIMIT 1");
    if ($getData) {
        $myUser = $NNL->get_row(" SELECT * FROM `users` WHERE `username` = '" . $getData["username"] . "'");
        if ($myUser['time_mbbank'] < time()) {
            exit(json_encode(array('status' => 'false', 'msg' => 'Tài khoản của bạn đã hết hạn sử dụng, vui lòng nâng cấp gói để tiếp tục sử dụng!')));
        } else {
            // $lichsu = $Zalopay->getHistory($getData['user_id'], $getData['access_token'], $getData['deviceId'],72);
            // print_r($lichsu);
             $lichsu = $Zalopay->checkHistory($getData['session_id']);
            print_r($lichsu);
           
        }
    } else {
        exit(json_encode(array('status' => 'false', 'msg' => 'Access_token không tồn tại!')));
    }
}
if (isset($_GET["tokenv2"])) {
    $getData = $NNL->get_row(" SELECT * FROM `account_zalopay` WHERE `token` = '" . $_GET["tokenv2"] . "' LIMIT 1");
    if ($getData) {
        $myUser = $NNL->get_row(" SELECT * FROM `users` WHERE `username` = '" . $getData["username"] . "'");
        if ($myUser['time_mbbank'] < time()) {
            exit(json_encode(array('status' => 'false', 'msg' => 'Tài khoản của bạn đã hết hạn sử dụng, vui lòng nâng cấp gói để tiếp tục sử dụng!')));
        } else {
            $lichsu = $Zalopay->getHistory($getData['user_id'], $getData['access_token'], $getData['deviceId'],180);
            print_r($lichsu);
        }
    } else {
        exit(json_encode(array('status' => 'false', 'msg' => 'Access_token không tồn tại!')));
    }
}
//lấy số dư nha
if (isset($_GET["balancetoken"])) {
    $getData = $NNL->get_row(" SELECT * FROM `account_zalopay` WHERE `token` = '" . $_GET["balancetoken"] . "'");
    if ($getData) {
       $myUser = $NNL->get_row(" SELECT * FROM `users` WHERE `username` = '" . $getData["username"] . "'");
        if ($myUser['time_mbbank'] < time()) {
            exit(json_encode(array('status' => 'false', 'msg' => 'Tài khoản của bạn đã hết hạn sử dụng, vui lòng nâng cấp gói để tiếp tục sử dụng!')));
        } else {
            $balance = $Zalopay->getBalance($getData['session_id'], $getData['access_token'], $getData['zalo_id'],$getData['user_id']);
            if (isset(json_decode($balance,true)['data'])) {
                exit(json_encode(array('status' => '200', 'SoDu' => '' . json_decode($balance,true)['data']['balance'] . '')));
            } else {
                exit(json_encode(array('status' => '99', 'SoDu' => '0')));
            }
        }
    }
    else {
        exit(json_encode(array('status' => 'false', 'msg' => 'Access_token không tồn tại!')));
    }
}
//lấy tên
if (isset($_GET["tokeninfo"])) {
    $getData = $NNL->get_row(" SELECT * FROM `account_zalopay` WHERE `token` = '" . $_GET["tokeninfo"] . "'");
    if ($getData) {
       $myUser = $NNL->get_row(" SELECT * FROM `users` WHERE `username` = '" . $getData["username"] . "'");
        if ($myUser['time_mbbank'] < time()) {
            exit(json_encode(array('status' => 'false', 'msg' => 'Tài khoản của bạn đã hết hạn sử dụng, vui lòng nâng cấp gói để tiếp tục sử dụng!')));
        } else {
             $lichsu = $Zalopay->getName($getData['user_id'], $getData['access_token'], $getData['deviceId']);
            if (json_decode($lichsu,true)['returncode'] == 1) {
                exit(json_encode(array('status' => '200', 'msg' => '' . json_decode($lichsu,true)['displayname'] . '')));
            } else {
                exit(json_encode(array('status' => '99', 'msg' => 'Phiên làm việc đã hết hạn. Vui lòng đăng nhập lại để tiếp tục')));
            }
        }
    }
    else {
        exit(json_encode(array('status' => 'false', 'msg' => 'Access_token không tồn tại!')));
    }
}
//chuyển tiền
if (isset($_GET["tokensend"])) {
    $getData = $NNL->get_row(" SELECT * FROM `account_zalopay` WHERE `token` = '" . $_GET["tokensend"] . "'");
    if ($getData) {
       $myUser = $NNL->get_row(" SELECT * FROM `users` WHERE `username` = '" . $getData["username"] . "'");
        if ($myUser['time_mbbank'] < time()) {
            exit(json_encode(array('status' => 'false', 'msg' => 'Tài khoản của bạn đã hết hạn sử dụng, vui lòng nâng cấp gói để tiếp tục sử dụng!')));
        } else {
             $lichsu = $Zalopay->creatTransfer($getData['user_id'], $getData['access_token'], $getData['deviceId'],'0961898253');
             print_r($lichsu);
            // if (json_decode($lichsu,true)['returncode'] == 1) {
            //     exit(json_encode(array('status' => '200', 'msg' => '' . json_decode($lichsu,true)['displayname'] . '')));
            // } else {
            //     exit(json_encode(array('status' => '99', 'msg' => 'Phiên làm việc đã hết hạn. Vui lòng đăng nhập lại để tiếp tục')));
            // }
        }
    }
    else {
        exit(json_encode(array('status' => 'false', 'msg' => 'Access_token không tồn tại!')));
    }
}
