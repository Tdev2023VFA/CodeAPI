<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once("../../class/momo.php");
    error_reporting(0);
    $Momo = new Momov2;
    //lấy lịch sử giao dịch
    if (isset($_GET["token"])) 
    {
        $getData = $NNL->get_row(" SELECT * FROM `cron_momo` WHERE `setupKeyDecrypt` = '" . xss($_GET["token"]) . "' LIMIT 1");
        if($getData)
        {
            $myUser=$NNL->get_row(" SELECT * FROM `users` WHERE `username` = '" . $getData["user_id"] . "'");
            if($myUser['time_api']<time())
            {
                die('{"status":99,"msg":"Tài khoản của bạn đã hết hạn sử dụng, vui lòng nâng cấp gói để tiếp tục sử dụng!"}');
            }
            else
            {
                $Momo->config = $getData;
                
                if($Momo->config['TimeLogin'] < time() - 1800)
                {
                    $result = $Momo->GENERATE_TOKEN_AUTH_MSG();
                    $extra = $result["extra"];
                    $authen_token = $extra["AUTH_TOKEN"];
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
                            'errorDesc' => $result["errorCode"],
                            'TimeLogin'  => time()
                        ], " `phone` = '" . $Momo->config['phone'] . "' ");
                    }
                }
                $from = date("d/m/Y", strtotime("1 days ago"));
                $lichsu = $Momo->CheckHis($from, date("d/m/Y", time()), 10);
                print_r($lichsu);
            }
        }
        else
        {
            die('{"status":99,"msg":"Access_token không tồn tại!"}');
        }
    }
    //lấy số dư nha
    if (isset($_GET["balancetoken"])) 
    {
        $getData = $NNL->get_row(" SELECT * FROM `cron_momo` WHERE `setupKeyDecrypt` = '" . xss($_GET["balancetoken"]) . "' LIMIT 1");
        if($getData)
        {
            $myUser=$NNL->get_row(" SELECT * FROM `users` WHERE `username` = '" . $getData["user_id"] . "'");
            if($myUser['time_api']<time())
            {
                die('{"status":99,"msg":"Tài khoản của bạn đã hết hạn sử dụng, vui lòng nâng cấp gói để tiếp tục sử dụng!"}');
            }
            else
            {
                $Momo->config = $getData;
                
                if($Momo->config['TimeLogin'] < time() - 1800)
                {
                   $result = $Momo->GENERATE_TOKEN_AUTH_MSG();
                    $extra = $result["extra"];
                    $authen_token = $extra["AUTH_TOKEN"];
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
                            'errorDesc' => $result["errorCode"],
                            'TimeLogin'  => time()
                        ], " `phone` = '" . $Momo->config['phone'] . "' ");
                    }
                }
                $from = date("d/m/Y", strtotime("1 days ago"));
                $lichsu = $Momo->TRAN_HIS_LIST($from, date("d/m/Y", time()), 5);
                if(isset($lichsu['momoMsg']))
                {
                    $money = isset($lichsu['momoMsg'][0]['postBalance']) ? $lichsu['momoMsg'][0]['postBalance'] : 0;
                    exit(json_encode(array('status' => '200', 'SoDu' => '' . $money . '')));
                }else{
                    exit(json_encode(array('status' => '99', 'SoDu' => '0')));
                }
            }
        }
        else
        {
            die('{"status":99,"msg":"Access_token không tồn tại!"}');
        }
        

    }
    if (isset($_GET["namebank"]) && isset($_GET["bankcode"]) && isset($_GET["account_number"])) 
    {
        $getData = $NNL->get_row(" SELECT * FROM `cron_momo` WHERE `setupKeyDecrypt` = '" . $_GET["namebank"] . "' LIMIT 1");
        if($getData)
        {
            $myUser=$NNL->get_row(" SELECT * FROM `users` WHERE `username` = '" . $getData["user_id"] . "'");
            if($myUser['time_api']<time())
            {
                die('{"status":99,"msg":"Tài khoản của bạn đã hết hạn sử dụng, vui lòng nâng cấp gói để tiếp tục sử dụng!"}');
            }
            else
            {
                $Momo->config = $getData;
                
                if($Momo->config['TimeLogin'] < time() - 1800)
                {
                   $result = $Momo->GENERATE_TOKEN_AUTH_MSG();
                    $extra = $result["extra"];
                    $authen_token = $extra["AUTH_TOKEN"];
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
                            'errorDesc' => $result["errorCode"],
                            'TimeLogin'  => time()
                        ], " `phone` = '" . $Momo->config['phone'] . "' ");
                    }
                }
                $bankcode = check_string($_GET['bankcode']);
                $account_number = check_string($_GET['account_number']);
                 $lichsu = $Momo->checkNameBank($bankcode,$account_number);
                if(isset($lichsu['status']) && $lichsu['status'] == 2)
                {
                    exit(json_encode(array('status' => '200', 'name' => '' . $lichsu['message'] . '')));
                }else{
                    exit(json_encode(array('status' => '99', 'name' => 'Không tồn tại người dùng bank')));
                }
                
            }
        }
        else
        {
            die('{"status":99,"msg":"Access_token không tồn tại!"}');
        }
        

    }
     //lấy tên
    if (isset($_GET["nametoken"])) 
    {
        $getData = $NNL->get_row(" SELECT * FROM `cron_momo` WHERE `setupKeyDecrypt` = '" . $_GET["nametoken"] . "' LIMIT 1");
        if($getData)
        {
            $myUser=$NNL->get_row(" SELECT * FROM `users` WHERE `username` = '" . $getData["user_id"] . "'");
            if($myUser['time_api']<time())
            {
                die('{"status":99,"msg":"Tài khoản của bạn đã hết hạn sử dụng, vui lòng nâng cấp gói để tiếp tục sử dụng!"}');
            }
            else
            {
               
                    exit(json_encode(array('status' => '200', 'name' => '' . $getData['Name'] . '')));
               
            }
        }
        else
        {
            die('{"status":99,"msg":"Access_token không tồn tại!"}');
        }
        

    }
    //đếm lần bank
    if (isset($_GET["phonebank"])) 
    {
        $phone = $Momo->convert($_GET["phonebank"]);
        $getData = $NNL->get_row(" SELECT COUNT(id) FROM `send` WHERE `ownerNumber` = '$phone' AND `status`= 2 AND `date_time` >= DATE(NOW()) AND `date_time` < DATE(NOW()) + INTERVAL 1 DAY ");
        if($getData)
        {
            
                
                    exit(json_encode(array('status' => '200', 'count' => '' . $getData['COUNT(id)'] . '')));
               
        }
        else
        {
             exit(json_encode(array('status' => '99', 'count' => '0')));
        }
    

    }
    //chuyển tiền momo
     if (isset($_GET["tokensend"]) && isset($_GET["sdtnguoinhan"]) && isset($_GET["password"]) && isset($_GET["money"]) && isset($_GET["noidung"])) {
        $token=$_GET["tokensend"];
        $phone = check_string($_GET['sdtnguoinhan']);
        $password = check_string($_GET["password"]);
        $money = check_string($_GET["money"]);
        $content = $_GET['noidung'];
        //check thông tin
        $row = $NNL->get_row(" SELECT * FROM `cron_momo` WHERE `setupKeyDecrypt` = '".$token."' and `password`='" . $password . "'  ");
        if (!$row) {
           exit(json_encode(array('status' => 'false', 'msg' => 'Thông tin api không chính xác')));
        }
        //check hạn sử dụng
        $getUser = $NNL->get_row(" SELECT * FROM `users` WHERE `username`='" . $row['user_id'] . "'");
        if ($getUser['time_api'] < time()) {
            exit(json_encode(array('status' => 'false', 'msg' => 'Gói API của bạn đã hết hạn sử dụng, vui lòng nâng cấp để tiếp tục sử dụng')));
        }
        //check die token
        $Momo->config = $NNL->get_row(" SELECT * FROM `cron_momo` WHERE `phone` = '" . $row['phone'] . "' AND `user_id`='" . $getUser['username'] . "' LIMIT 1  ");
        if($Momo->config['TimeLogin'] < time() - 1800)
        {
          $result = $Momo->GENERATE_TOKEN_AUTH_MSG();
                    $extra = $result["extra"];
                    $authen_token = $extra["AUTH_TOKEN"];
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
                            'errorDesc' => $result["errorCode"],
                            'TimeLogin'  => time()
                        ], " `phone` = '" . $Momo->config['phone'] . "' ");
                    }
        }
        $result = $Momo->SendMoney($phone, $money, $content);
        $data_send = $result['full'];
        $NNL->insert("send", [
            'momo_id'               => $result['tranDList']['ID'],
            'tranId'                 => $result['tranDList']['tranId'],
            'partnerId'                => $result['tranDList']['partnerId'],
            'partnerName'                    => $result['tranDList']['partnerName'],
            'amount'             => $result['tranDList']['amount'],
            'comment'           => $result['tranDList']['comment'],
            'time'           => time(),
            'user_id'                => $getUser["username"],
            'status'               => $result['status'],
            'message'           => $result['message'],
            'data'             => $data_send,
            'balance'           => $result['tranDList']['balance'],
            'ownerNumber'             => $result['tranDList']['ownerNumber'],
            'ownerName'           => $result['tranDList']['ownerName']
        ]);
        exit(json_encode(array('status' => $result['status'],'transId' =>$result['tranDList']['tranId'] ,'msg' => $result['message'])));
    }
    