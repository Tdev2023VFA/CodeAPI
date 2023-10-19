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
            $lichsu = $MBBANK->getHistory($getData['phone'],$getData['sessionId'],$getData['deviceId']);
            //print_r($lichsu);
            $tranList = array();
            foreach ($lichsu['notificationBusinessList'] as $transaction) {
                $text = $transaction["body"];
				$taikhoan = explode('TK ', explode ('|', $text)[0])[1];
				$info = explode ('|', $text)[1];
				$tach = explode (' ', $info);
				$biendong = $tach[1];
				$deviant = str_replace(array('+', '-'), array('', ''), explode ('VND', $biendong)[0]);
				$time = $tach[2]." ".$tach[3].":00";
				$vnd = explode ('|', $text)[2];
				$sodu = explode ('VND', explode ('SD:', $text)[1])[0];
				$config = explode ('|', $text)[3];
				
                $tranList[] = array(
                  	"transactionId" => $transaction["notiId"], #mã giao dịch
                    "accountNo" => $taikhoan, #tài khoản
					"creditAmount" => str_replace(array(',', '.'), array('', ''), $deviant), #số tiền giao dịch
					"type" => $biendong[0], #1 = cộng tiền, -1 = trừ tiền
					"transactionDate" => $time, #thời gian
					"availableBalance" => $sodu, #số dư
					"description" => $config #nội dung giao dịch
                     
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