<?php
include "../../config/config.php";
include "../../config/function.php";
include "../../class/VCB.php";
error_reporting(0);
set_time_limit(0);
$vcb = new VCB;
//đăng nhập tpbank
if ($_POST['type'] == 'Login') 
{
   if(!$getUser = $NNL->get_row("SELECT * FROM `users` WHERE `username` = '" . $_SESSION['username'] . "' AND `banned` = '0' ")) {
            die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    if($getUser['time_vcb'] < time())
    {
        exit(json_encode(array('status' => '1', 'msg' => 'Gói API của bạn đã hết hạn sử dụng, vui lòng nâng cấp để tiếp tục sử dụng')));
    }

       $tk_vcb = xss($_POST['phonembbank']);
        $mk_vcb = xss($_POST['passmbbank']);
         if (empty($tk_vcb)) {
            die(json_encode([
                'status'    => '1',
                'msg'       => 'Vui lòng điền tài khoản'
            ]));
        }
        if (empty($mk_vcb)) {
            die(json_encode([
                'status'    => '1',
                'msg'       => 'Vui lòng điền mật khẩu'
            ]));
        }
        $checkLimit = $NNL->num_rows(" SELECT * FROM `vietcombank` WHERE `user_id`='" . $getUser['id'] . "'");
        if ($checkLimit >= $NNL->site('limit_api_vcb')) {
            exit(json_encode(array('status' => '1', 'msg' => 'Quý dị chỉ được thêm tối đa '.$NNL->site('limit_api_vcb').' tài khoản vietcombank')));
        }
        $response = getCaptcha($NNL->site('key_captcha'));
        $captcha_id =  json_decode($response,true)['data']['captcha_id'];
        $captcha = json_decode($response,true)['data']['captcha'];
        $token = md5(random('QWERTYUIOPASDGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm0123456789', 6) . time());
        $login = json_decode($vcb->login($tk_vcb,$mk_vcb,$captcha_id,$captcha),true);
        if ($login['code']=='00') {
            $NNL->insert("vietcombank", [
                'name'               => $login['userInfo']['cusName'],
                'user_id'                 => $getUser['id'],
                'username'                    => $tk_vcb,
                'password'             => $mk_vcb,
                'account'           => $login['userInfo']['defaultAccount'],
                'session_id'           => $login['sessionId'],
                'access_key'                => $login['accessKey'],
                'client_id'           => $login['userInfo']['clientId'],
                'mobile_id'           => $login['userInfo']['mobileId'],
                'cif'                => $login['userInfo']['cif'],
                'token'                => $token,
                'create_date'               => gettime(),
            ]);
            exit(json_encode(array('status' => '2', 'msg' => 'Đăng nhập thành công')));
        }else{
            exit(json_encode(array('status' => '1', 'msg' => ''.$login['des'].'')));
        }
    
}