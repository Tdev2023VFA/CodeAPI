<?php
require_once "../../config/config.php";
require_once "../../config/function.php";
require_once "../../class/simple_html_dom.inc.php";
//lấy lịch sử giao dịch
if (isset($_GET["token"])) {
    $getData = $NNL->get_row(" SELECT * FROM `account_thesieure` WHERE `token` = '" . xss($_GET["token"]) . "'");
    if ($getData) {
        $myUser = $NNL->get_row(" SELECT * FROM `users` WHERE `id` = '" . $getData["user_id"] . "'");
        if ($myUser['time_api'] < time()) {
            die('{"status":99,"msg":"Tài khoản của bạn đã hết hạn sử dụng, vui lòng nâng cấp gói để tiếp tục sử dụng!"}');
        } else {
            $cookie = $getData['cookie'];
        }
    } else {
        die('{"status":99,"msg":"Token không tồn tại!"}');
    }
    $url = "https://thesieure.com/wallet/transfer";
    $head = array(
        "Host:thesieure.com",
        "referer:https://thesieure.com/",
        "cookie:$cookie"
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; Android 10; SM-J600G) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.106 Mobile Safari/537.36");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
    $mr2 = curl_exec($ch);
    curl_close($ch);
    $rs = str_get_html($mr2);
    $lol = $rs->find('tbody', 2);
    $array = [];
    if ($lol) {
        foreach ($lol->find('tr') as $article) {
            $ma_GD = $article->find('td', 0)->plaintext;
            $so_tien = $article->find('td', 1);
            $txt_sotien = $so_tien->find('span', 0)->plaintext;
            $nguoigui_nhan = $article->find('td', 2);
            $txt_nguoiguinhan = $nguoigui_nhan->find('span', 0)->plaintext;
            $ngay_tao = $article->find('td', 3)->plaintext;
            $trang_thai = $article->find('td', 4);
            $txt_trangthai = $trang_thai->find('span', 0)->plaintext;
            $noi_dung = $article->find('td', 5)->plaintext;
            $array[] = [
                    "transId" => $ma_GD,
                    "amount" => $txt_sotien,
                    "username" => $txt_nguoiguinhan,
                    "date" => $ngay_tao,
                    "status" => $txt_trangthai,
                    "description" => $noi_dung,
            ];
        }

    }
    die(json_encode(array("status" => true,"msg" => "Thành công","tranList" =>$array)));
}
if (isset($_GET["balancetoken"])) {
    $getData = $NNL->get_row(" SELECT * FROM `account_thesieure` WHERE `token` = '" . xss($_GET["balancetoken"]) . "'");
    if ($getData) {
        $myUser = $NNL->get_row(" SELECT * FROM `users` WHERE `id` = '" . $getData["user_id"] . "'");
        if ($myUser['time_api'] < time()) {
            die('{"status":99,"msg":"Tài khoản của bạn đã hết hạn sử dụng, vui lòng nâng cấp gói để tiếp tục sử dụng!"}');
        } else {
            $cookie = $getData['cookie'];
        }
    } else {
        die('{"status":99,"msg":"Token không tồn tại!"}');
    }
    $url = "https://thesieure.com/wallet/transfer";
    $head = array(
        "Host:thesieure.com",
        "referer:https://thesieure.com/",
        "cookie:$cookie"
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; Android 10; SM-J600G) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.106 Mobile Safari/537.36");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
    $mr2 = curl_exec($ch);
    curl_close($ch);
    $rs = str_get_html($mr2);
     $lol =  $rs->find('h4', 0)->plaintext;
     
     if ($lol) {
         $so_tien1 = str_replace('đ', '', $lol);
        $so_tien1 = str_replace('Số dư:', '', $so_tien1);
        $so_tien1 = str_replace(',', '', $so_tien1);
        $so_tien1 = str_replace(',', '', $so_tien1);
               exit(json_encode(array('status' => '200', 'SoDu' => '' . $so_tien1 . '')));
            } else {
                exit(json_encode(array('status' => '99', 'SoDu' => '0')));
            }
    
}
