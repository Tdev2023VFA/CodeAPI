<?php

define("IN_SITE", true);
require_once "../config/config.php";
require_once "../config/function.php";

/* START CHỐNG SPAM */
if (time() > $NNL->site('check_time_cron_tpbank')) {
    if (time() - $NNL->site('check_time_cron_tpbank') < 30) {
        die('Thao tác quá nhanh, vui lòng đợi');
    }
}
$NNL->update("options", array(
    'value' => time()
), " `key` = 'check_time_cron_tpbank' ");
/* END CHỐNG SPAM */
if ($NNL->site('status_tpbank') != 1) {
    die('Đang bảo trì.');
}
if ($NNL->site('token_tpbank') == '') {
    die('Thiếu Token TPBANK');
}
$json = curl_get(BASE_URL('')."historyapitpb/".$NNL->site('token_tpbank'));
$result = json_decode($json,true);
foreach ($result['transactionInfos'] as $data) {
    $tid            = $data['id'];
    $description    = check_string($data['description']);
    $amount         = check_string($data['amount']);
    $CRDT         = check_string($data['creditDebitIndicator']);
    $user_id        = isset(explode(' ', $description)[1]) ? explode(' ', $description)[1] : "";      // TÁCH NỘI DUNG CHUYỂN TIỀN
    // XỬ LÝ AUTO
    if($CRDT == "CRDT")
    {
        if ($getUser = $NNL->get_row(" SELECT * FROM `users` WHERE `id` = '$user_id' ")) {
            if ($NNL->num_rows(" SELECT * FROM `invoices` WHERE `trans_id` = '$tid' ") == 0) {
                $insertSv2 = $NNL->insert("invoices", array(
                    'trans_id'               => $tid,
                    'payment_method'    => "TPBANK",
                    'user_id'           => $getUser['id'],
                    'description'       => $description,
                    'amount'            => $amount,
                    'status'            => 1,
                    'create_time'       => time()
                ));
                if ($insertSv2) {
                    $isCong = PlusCredits($getUser['id'], $amount, "Nạp tiền tự động qua TPBank (#$tid - $description - $amount)");
                    if ($isCong) {
                        echo '[<b style="color:green">-</b>] Xử lý thành công 1 hoá đơn.' . PHP_EOL;
                    }
                }
            }
        }
    }
}
