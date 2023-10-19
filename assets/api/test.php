<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once("../../class/momo.php");
    error_reporting(0);
    $Momo = new Momov2;
    if (isset($_GET["sdt"])&&isset($_GET["tokenname"])) 
    {
        $getData=$NNL->get_row(" SELECT * FROM `accountmomo` WHERE `phone`='".$_GET["sdt"]."' AND `setupkey` = '" . $_GET["tokenname"] . "'");
        if($getData)
        {
            $pHash = $getData['ohash'];
            $keySetup = $getData['setupkey'];
            $Momo->phone = $getData['phone'];
            $Momo->pass = $getData['password'];
        }
        else
        {
            die('{"status":99,"msg":"Token không chính xác!"}');
        }
        $login = json_decode($Momo->userLogin(trim(str_replace('\/', "/", $pHash)), $keySetup), true);

        if ($login['error'] == 0) {

            echo '{"status":"200","name":"' . $Momo->FULL_NAME . '"}';
        } else {
            echo '{"status":"99","msg":"Hết thời gian truy cập rồi. Vui lòng đăng nhập lại"}';
        }

    }
    //lấy lịch sử giao dịch
    if (isset($_GET["token"])) 
    {
        $getData = $NNL->get_row(" SELECT * FROM `cron_momo` WHERE `setupKeyDecrypt` = '" . $_GET["token"] . "' LIMIT 1");
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
                // $lichsu = $Momo->loadMessageChat("92233703766956762885c08f47b-b892-4bb2-9093-24b61d163808");
                // print_r($lichsu['json']['data'][0]['templateData']);
                $lichsu = $Momo->CheckHistoryV3();
                print_r($lichsu);
                // $tesst = $Momo->GENERATE_TOKEN_AUTH_MSG();
                // print_r($tesst);
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
        $getData=$NNL->get_row(" SELECT * FROM `accountmomo` WHERE `setupkey` = '" . $_GET["balancetoken"] . "'");
        if($getData)
        {
            $pHash = $getData['ohash'];
            $keySetup = $getData['setupkey'];
            $Momo->phone = $getData['phone'];
            $Momo->pass = $getData['password'];
        }
        else
        {
            die('{"status":99,"msg":"Token không chính xác!"}');
        }
        $login = json_decode($Momo->userLogin(trim(str_replace('\/', "/", $pHash)), $keySetup), true);
        if ($login['error'] == 0) 
        {
            exit(json_encode(array('status' => '200', 'SoDu' => '' . $Momo->BALANCE . '')));
        } 
        else 
        {
           exit(json_encode(array('status' => '99', 'SoDu' => '0')));
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
        if($Momo->config['TimeLogin'] < time() - 3600)
        {
            $result = $Momo->GENERATE_TOKEN_AUTH_MSG();
            $extra = $result["extra"];
            $NNL->update("cron_momo", [
                'authorization' => $extra["AUTH_TOKEN"],
                'RSA_PUBLIC_KEY' => $extra["REQUEST_ENCRYPT_KEY"],
                'sessionkey' => $extra["SESSION_KEY"],
                'errorDesc' => $result["errorCode"],
                'TimeLogin'  => time()
            ], " `phone` = '" . $Momo->config['phone'] . "' ");
        }
        $result = $Momo->SendMoney($phone, $money, $content);
        // $data_send = $result['full'];
        // $NNL->insert("send", [
        //     'momo_id'               => isset($result['tranDList']['ID']) ? $result['tranDList']['ID'] : "default",
        //     'tranId'                 => isset($result['tranDList']['tranId']) ? $result['tranDList']['tranId'] : "default",
        //     'partnerId'                => isset($result['tranDList']['partnerId']) ? $result['tranDList']['partnerId'] : "default",
        //     'partnerName'                    => isset($result['tranDList']['partnerName']) ? $result['tranDList']['partnerName'] : "default",
        //     'amount'             => isset($result['tranDList']['amount']) ? $result['tranDList']['amount'] : "default",
        //     'comment'           => isset($result['tranDList']['comment']) ? $result['tranDList']['comment'] : "default",
        //     'time'           => time(),
        //     'user_id'                => $getUser["username"],
        //     'status'               => $result['status'],
        //     'message'           => $result['message'],
        //     'data'             => $data_send,
        //     'balance'           => $result['tranDList']['balance'],
        //     'ownerNumber'             => isset($result['tranDList']['ownerNumber']) ? $result['tranDList']['ownerNumber'] : "default",
        //     'ownerName'           => isset($result['tranDList']['ownerName']) ? $result['tranDList']['ownerName'] : "default"
        // ]);
        // exit(json_encode(array('status' => $result['status'],'transId' =>$result['tranDList']['tranId'] ,'msg' => $result['message'])));
        print_r($result);
    }
    