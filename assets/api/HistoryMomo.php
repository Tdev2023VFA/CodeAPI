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
                            ], " `phone` = '" . $getData['phone'] . "' ");
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
                 $lichsu = $Momo->CheckHisNew(24);
                print_r($lichsu);
            }
        }
        else
        {
            die('{"status":99,"msg":"Access_token không tồn tại!"}');
        }
    }

    //chuyển tiền momo
     if (isset($_GET["tokensend"]) && isset($_GET["sdtnguoinhan"]) && isset($_GET["password"]) && isset($_GET["money"]) && isset($_GET["noidung"])) {
        $token=$_GET["tokensend"];
        $phone = check_string($_GET['sdtnguoinhan']);
        $password = check_string($_GET["password"]);
        $money = check_string($_GET["money"]);
        $content = $_GET['noidung'];
        if(empty($content))
        {
            exit();
        }
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
        exit(json_encode(array('status' => $result['status'],'transId' =>$result['tranDList']['tranId'] ,'msg' => $result['message'])));
    }
    if (isset($_POST["type"]) && $_POST['type']=="transfer") {
        $ip=myip();
        $token=xss($_POST["token"]);
        $phone = xss($_POST['phone']);
        $password = xss($_POST["password"]);
        $money = xss($_POST["amount"]);
        $content = $_POST['comment'];
        if(empty($content))
        {
            die();
        }
    
        //check thông tin
        $row = $NNL->get_row(" SELECT * FROM `cron_momo` WHERE `setupKeyDecrypt` = '".$token."' and `password`='" . $password . "'  ");
        if (!$row) {
          die(json_encode(array('status' => 'false', 'msg' => 'Thông tin api không chính xác')));
        }
        //check hạn sử dụng
        $getUser = $NNL->get_row(" SELECT * FROM `users` WHERE `username`='" . $row['user_id'] . "'");
        if ($getUser['time_api'] < time()) {
            die(json_encode(array('status' => 'false', 'msg' => 'Gói API của bạn đã hết hạn sử dụng, vui lòng nâng cấp để tiếp tục sử dụng')));
        }
        if($row['status_anti']==1){
            //check ip
            $whitelist = array(
                '127.0.0.1',
                '::1'
            );
            if (in_array($ip, $whitelist)) {
                die(json_encode(array('status' => 'false', 'msg' => 'Truy cập trái phép')));
            }
            $checkIp = $NNL->get_row("SELECT * FROM `cron_momo` WHERE `ip_white`='$ip' AND `setupKeyDecrypt`='$token'");
            if(!$checkIp)
            {
                 die(json_encode(array('status' => 'false', 'msg' => 'Bạn không có quyền sử dụng chức năng này'.$ip)));
            }
            // //check die token
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
            die(json_encode(array('status' => $result['status'],'transId' =>$result['tranDList']['tranId'] ,'msg' => $result['message'])));
        }else{
            // //check die token
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
            die(json_encode(array('status' => $result['status'],'transId' =>$result['tranDList']['tranId'] ,'msg' => $result['message'])));
            
        }
        
    }
    