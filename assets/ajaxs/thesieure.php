<?php
define("IN_SITE", true);
require_once("../../config/config.php");
require_once("../../config/function.php");
require_once('../../class/simple_html_dom.inc.php');
// error_reporting(0);
set_time_limit(0);
date_default_timezone_set('Asia/Ho_Chi_Minh');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'CHECKTSR') 
    {
        if(empty($_SESSION['username']))
        {
            die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
        }
        if (!$getUser = $NNL->get_row("SELECT * FROM `users` WHERE `username` = '" . $_SESSION['username']. "' AND `banned` = '0' ")) {
            die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
        }
        $checkLimit = $NNL->num_rows(" SELECT * FROM `account_thesieure` WHERE `user_id`='" . $getUser['id'] . "'");
        if ($getUser['time_api'] < time()) {
            die(json_encode([
                'status'    => 'error',
                'msg'       => 'Gói API của bạn đã hết hạn sử dụng, vui lòng nâng cấp để tiếp tục sử dụng'
            ]));
        }
        $username = check_string($_POST['username']);
        $cookie = check_string($_POST['cookie']);
        if (empty($username)) {
            die(json_encode([
                'status'    => '1',
                'msg'       => 'Vui lòng tài khoản'
            ]));
        }
        if (empty($cookie)) {
            die(json_encode([
                'status'    => '1',
                'msg'       => 'Vui lòng điền cookie'
            ]));
        }
        if ($checkLimit > 1) {
            die(json_encode([
                'status'    => '1',
                'msg'       => 'Quý dị chỉ được thêm tối đa 2 tài khoản thẻ siêu rẻ'
            ]));
        }
       if(!CheckCookieTSR($cookie))
       {
            die(json_encode([
                'status'    => '1',
                'msg'       => 'Cookie thẻ siêu rẻ không chính xác'
            ]));
       }
        $isInsert = $NNL->insert("account_thesieure", [
            'user_id'      => $getUser['id'],
            'username'     => $username,
            'cookie'         => $cookie,
            'token'      => CreateToken(),
            'status'     => 1,
            'time'          => time()
        ]);
        if($isInsert)
        {
            die(json_encode([
                'status'    => '2',
                'msg'       => 'Đã thêm thành công'
            ]));
        }else{
            die(json_encode([
                'status'    => '1',
                'msg'       => 'Thêm thất bại'
            ]));
        }
    }
}