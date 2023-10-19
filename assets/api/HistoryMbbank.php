<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
require_once("../../class/Mbbank.php");
error_reporting(0);
$MBBANK = new MBBANK;
//lấy lịch sử giao dịch
if (isset($_GET["token"])) {
    $getData = $NNL->get_row(" SELECT * FROM `account_mbbank` WHERE `token` = '" . xss($_GET["token"]) . "' LIMIT 1");
    if ($getData) {
        $myUser = $NNL->get_row(" SELECT * FROM `users` WHERE `username` = '" . $getData["username"] . "'");
        if ($myUser['time_mbbank'] < time()) {
            exit(json_encode(array('status' => 'false', 'msg' => 'Tài khoản của bạn đã hết hạn sử dụng, vui lòng nâng cấp gói để tiếp tục sử dụng!')));
        } else {

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
            $lichsu = $MBBANK->getHistoryV2($getData['phone'],$getData['sessionId'],$getData['deviceId'],$getData['stk'],30);
            //print_r($lichsu['notificationBusinessList']);
            $tranList = array();
            foreach ($lichsu['transactionHistoryList'] as $transaction) {
                $tranList[] = array(
                    "tranId" => $transaction['refNo'],
                    "postingDate" => $transaction['postingDate'],
                    "transactionDate" =>$transaction['transactionDate'],
                    "accountNo" => $transaction['accountNo'],
                    "creditAmount"=> $transaction['creditAmount'],
                      "debitAmount"=> $transaction['debitAmount'],
                      "currency"=> $transaction['currency'],
                      "description"=> $transaction['description'],
                      "availableBalance"=> $transaction['availableBalance'],
                      "beneficiaryAccount"=> $transaction['beneficiaryAccount'],
                     
                );
                
            }
            // echo json_encode($tranList);
            print_r(json_encode(array(
                "status"  => "success",
                "message" => "Thành công",
                "TranList" => $tranList
            )));
        }
    } else {
        exit(json_encode(array('status' => 'false', 'msg' => 'Access_token không tồn tại!')));
    }
}
//lấy số dư nha
if (isset($_GET["balancetoken"])) {
    $getData = $NNL->get_row(" SELECT * FROM `account_mbbank` WHERE `token` = '" . xss($_GET["balancetoken"]) . "'");
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
        $balance = $MBBANK->balanceMBBank($getData['phone'], $getData['sessionId'], $getData['deviceId']);
    
       
        if ($balance['result']['message'] == 'OK') {
            foreach ($balance['acct_list'] as $data) {
            if ($data['acctNo'] == $getData['stk']) {
                $status = true;
                $message = 'Giao dịch thành công';
                exit(json_encode(array('status' => '200', 'SoDu' => '' . $data['currentBalance'] . '')));
                }
             }
            
        } else {
            exit(json_encode(array('status' => '99', 'SoDu' => '0')));
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