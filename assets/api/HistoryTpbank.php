<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once("../../class/Tpbank.php");
    $TPBANK = new TPBANK;
    //lấy lịch sử giao dịch
    if (isset($_GET["token"])) 
    {
        $getData=$NNL->get_row(" SELECT * FROM `account_tpbank` WHERE `token` = '" . $_GET["token"] . "'");
        if($getData)
        {
            $myUser=$NNL->get_row(" SELECT * FROM `users` WHERE `username` = '" . $getData["username"] . "'");
            if($myUser['time_mbbank'] <time() )
            {
                die('{"status":99,"msg":"Tài khoản của bạn đã hết hạn sử dụng, vui lòng nâng cấp gói để tiếp tục sử dụng!"}');
            }
            else
            {
                $access_token = $getData['access_token'];
                $stk = $getData['stk'];
                $login = $TPBANK->get_history($access_token,$stk );
                if(strpos($login, 'Error 401: Full authentication is required to access this resource') !== false)
                {
                    $check = json_decode($TPBANK ->get_token($getData['phone'],$getData['password']));
                    $NNL->update("account_tpbank", [
                        'access_token'         => $check->access_token,
                    ], " `phone` = '" . $getData['phone'] . "' ");
                }
                else{
                   echo $login;
                }
            }
        }
        else
        {
            die('{"status":99,"msg":"Token không tồn tại!"}');
        }
    }
    if (isset($_GET["balance"])) 
    {
        $getData=$NNL->get_row(" SELECT * FROM `account_tpbank` WHERE `token` = '" . $_GET["balance"] . "'");
        if($getData)
        {
            $myUser=$NNL->get_row(" SELECT * FROM `users` WHERE `username` = '" . $getData["username"] . "'");
            if($myUser['time_mbbank'] <time() )
            {
                die('{"status":99,"msg":"Tài khoản của bạn đã hết hạn sử dụng, vui lòng nâng cấp gói để tiếp tục sử dụng!"}');
            }
            else
            {
                $access_token = $getData['access_token'];
                $stk = $getData['stk'];
                $get_balance = $TPBANK->get_balance($access_token,$stk);
                $result = json_decode($get_balance,true);
                if (isset($result)) {
                    exit(json_encode(array('status' => '200', 'accountNumber'=>''.$result['BBAN'].'', 'SoDu' => '' . $result['availableBalance'] . '')));
                } else {
                    $check = json_decode($TPBANK ->get_token($getData['phone'],$getData['password']));
                    $NNL->update("account_tpbank", [
                        'access_token'         => $check->access_token,
                    ], " `phone` = '" . $getData['phone'] . "' ");
                    
                    exit(json_encode(array('status' => '99', 'SoDu' => '0')));
                }
            }
        }
        else
        {
            die('{"status":99,"msg":"Token không tồn tại!"}');
        }
    }
