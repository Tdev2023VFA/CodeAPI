<?php

define("IN_SITE", true);
require_once "../config/config.php";
require_once "../config/function.php";

/* START CHỐNG SPAM */
if (time() > $NNL->site('check_time_cron_thesieure')) {
    if (time() - $NNL->site('check_time_cron_thesieure') < 10) {
        die('Thao tác quá nhanh, vui lòng đợi');
    }
}
$NNL->update("options", array(
    'value' => time()
), " `key` = 'check_time_cron_thesieure' ");
/* END CHỐNG SPAM */


if ($NNL->site('status_thesieure') != 1) {
    die('Đang bảo trì.');
}
if ($NNL->site('token_thesieure') == '') {
    die('Thiếu Token THESIEURE');
}
$result = curl_get(BASE_URL('')."historyapithesieure/".$NNL->site('token_thesieure'));
$result = json_decode($result, true);
if ($result['status'] != true) {
    die('Lấy dữ liệu thất bại');
}
foreach ($result['tranList'] as $data) {
    $partnerId      = $data['username'];                    // SỐ ĐIỆN THOẠI CHUYỂN
    $comment        = $data['description'];                 // NỘI DUNG CHUYỂN TIỀN
    $tranId         = $data['transId'];                     // MÃ GIAO DỊCH
    $amount         = str_replace(',', '', $data['amount']);
    $amount         = str_replace('đ', '', $amount);               // SỐ TIỀN CHUYỂN
    $user_id        = isset(parse_order_id($comment)[1]) ? parse_order_id($comment)[1] : "";         // TÁCH NỘI DUNG CHUYỂN TIỀN
    // XỬ LÝ AUTO
    if ($getUser = $NNL->get_row(" SELECT * FROM `users` WHERE `id` = '$user_id' ")) {
        if ($NNL->num_rows(" SELECT * FROM `invoices` WHERE `trans_id` = '$tranId' ") == 0) {
            if(!preg_match('/-/i', $amount))
            {
                $insertSv2 = $NNL->insert("invoices", array(
                    'trans_id'               => $tranId,
                    'payment_method'    => "THESIEURE",
                    'user_id'           => $getUser['id'],
                    'description'       => $comment,
                    'amount'            => $amount,
                    'status'            => 1,
                    'create_time'       => time()
                ));
                if ($insertSv2) {
                    $isCong = PlusCredits($getUser['id'], $amount , "Nạp tiền tự động qua web THESIEURE.COM (#$tranId - $comment - $amount)");
                    if ($isCong) {
                        echo '[<b style="color:green">-</b>] Xử lý thành công 1 hoá đơn.' . PHP_EOL;
                    }
                }
            }
        }
    }
}
