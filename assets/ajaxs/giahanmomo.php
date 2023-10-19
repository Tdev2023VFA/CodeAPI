<?php
require_once("../../config/config.php");
require_once("../../config/function.php");

if ($_POST['act'] == 'momo') {
    $thoigiangiahanmomo = xss($_POST['thoigiangiahanmomo']);
    $row = $NNL->get_row(" SELECT * FROM `users` WHERE `username` = '" . $_SESSION['username'] . "' ");
    if (!$row) {
        nnl_error("Vui lòng đăng nhập để thực hiện");
    }
    if (empty($thoigiangiahanmomo)) {
        nnl_error("Vui lòng chọn thời gian cần nâng cấp!");
    }
    if ($thoigiangiahanmomo < 1) {
        nnl_error("Thời gian không hợp lệ!");
    }
    $time = time();
    $money = $NNL->site('money_api_momo');
    $countDay =  $thoigiangiahanmomo * 30;
    if ($row['time_api'] < $time) {
        $timeto = $time + 86400 * $countDay;
        $giatien = $money * $thoigiangiahanmomo;
        // exit(json_encode(array('status' => '1', 'msg' => 'hết hạn!')));
    } else {
        $timeto = $row['time_api'] + 86400 * $countDay;
        $giatien = $money * $thoigiangiahanmomo;
        // exit(json_encode(array('status' => '2', 'msg' => 'còn hạn!')));
    }
    //kiểm tra số dư so với giá tiền thuê
    if ($row['money'] < $giatien) {
        nnl_error("Bạn không đủ ".format_cash($giatien)." VNĐ để nâng cấp gói api");
    } else {
        $isMoney = RemoveCredits($row['id'], $giatien, "Gia hạn gói API MOMO và TSR (#$giatien)");
        if ($isMoney) {
            /* GHI LOG DÒNG TIỀN */
              $NNL->insert("logs", [
                'user_id'       => $row['id'],
                'ip'            => myip(),
                'device'        => $_SERVER['HTTP_USER_AGENT'],
                'create_date'    => gettime(),
                'action'        => 'Gia hạn gói API MOMO và TSR ('.$giatien.')'
             ]);
            

            $NNL->update("users", [
                'time_api' => $timeto
            ], " `username` = '" . $_SESSION['username'] . "' ");
            nnl_success_time("Nâng cấp gói api thành công"," ", 1000);
        }
    }
}
if ($_POST['act'] == 'momounlimit') {
    $thoigiangiahanmomo = xss($_POST['thoigiangiahanmomounlimit']);
    $row = $NNL->get_row(" SELECT * FROM `users` WHERE `username` = '" . $_SESSION['username'] . "' ");
    if (!$row) {
        nnl_error("Vui lòng đăng nhập để thực hiện");
    }
    if (empty($thoigiangiahanmomo)) {
        nnl_error("Vui lòng chọn số tài khoản cần nâng cấp!");
    }
    if ($thoigiangiahanmomo < 10) {
        nnl_error("Số tài khoản không hợp lệ không hợp lệ!");
    }
    $time = time();
    $money = $NNL->site('money_api_momo_unlimit');
    $total_money = $money * $thoigiangiahanmomo;
    //kiểm tra số dư so với giá tiền thuê
    if ($row['money'] < $total_money) {
        nnl_error("Bạn không đủ ".format_cash($total_money)." VNĐ để nâng cấp gói api");
    } else {
        $isMoney = RemoveCredits($row['id'], $total_money, "Nâng cấp thêm  $thoigiangiahanmomo cổng Momo (#$total_money)");
        if ($isMoney) {
            /* GHI LOG DÒNG TIỀN */
              $NNL->insert("logs", [
                'user_id'       => $row['id'],
                'ip'            => myip(),
                'device'        => $_SERVER['HTTP_USER_AGENT'],
                'create_date'    => gettime(),
                'action'        => "Nâng cấp thêm  $thoigiangiahanmomo cổng Momo (#$total_money)"
             ]);
            $NNL->cong("users", "port_momo", $thoigiangiahanmomo, " `username` = '" . $_SESSION['username'] . "' ");
            nnl_success_time("Nâng cấp thêm cổng thành công"," ", 1000);
        }
    }
}
