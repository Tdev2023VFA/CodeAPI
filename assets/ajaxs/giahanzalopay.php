<?php
require_once("../../config/config.php");
require_once("../../config/function.php");

if ($_POST['act'] == 'zalopay') {
    $thoigiangiahanzalopay = xss($_POST['thoigiangiahanzalopay']);
    $row = $NNL->get_row(" SELECT * FROM `users` WHERE `username` = '" . $_SESSION['username'] . "' ");
    if (!$row) {
        nnl_error("Vui lòng đăng nhập để thực hiện");
    }
    if (empty($thoigiangiahanzalopay)) {
        nnl_error("Vui lòng chọn thời gian cần nâng cấp!");
    }
    if ($thoigiangiahanzalopay < 1) {
        nnl_error("Thời gian không hợp lệ!");
    }
    $time = time();
    $money = $NNL->site('money_api_zalopay');
    $countDay =  $thoigiangiahanzalopay * 30;
    if ($row['time_zalopay'] < $time) {
        $timeto = $time + 86400 * $countDay;
        $giatien = $money * $thoigiangiahanzalopay;
        // exit(json_encode(array('status' => '1', 'msg' => 'hết hạn!')));
    } else {
        $timeto = $row['time_zalopay'] + 86400 * $countDay;
        $giatien = $money * $thoigiangiahanzalopay;
        // exit(json_encode(array('status' => '2', 'msg' => 'còn hạn!')));
    }
    //kiểm tra số dư so với giá tiền thuê
    if ($row['money'] < $giatien) {
        nnl_error("Bạn không đủ ".format_cash($giatien)." VNĐ để nâng cấp gói api");
    } else {
        $isMoney = RemoveCredits($row['id'], $giatien, "Gia hạn gói API ZALOPAY (#$giatien)");
        if ($isMoney) {
            // /* GHI LOG DÒNG TIỀN */
              $NNL->insert("logs", [
                'user_id'       => $row['id'],
                'ip'            => myip(),
                'device'        => $_SERVER['HTTP_USER_AGENT'],
                'create_date'    => gettime(),
                'action'        => 'Gia hạn gói API ZALOPAY ('.$giatien.')'
             ]);

            $NNL->update("users", [
                'time_zalopay' => $timeto
            ], " `username` = '" . $_SESSION['username'] . "' ");
            nnl_success_time("Nâng cấp gói api thành công"," ", 1000);
        }
    }
}
