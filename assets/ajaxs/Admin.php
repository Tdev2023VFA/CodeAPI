<?php
include "../../config/config.php";
include "../../config/function.php";
// error_reporting(0);
if ($_POST['type'] == 'changeUser' && $getUser['level']=="admin") {
    $token = check_string($_POST['token']);
    $otp = check_string($_POST['otp']);
    $money = check_string($_POST['money']);
    $moneydefault = check_string($_POST['moneydefault']);
    $level = check_string($_POST['level']);
    $banned = check_string($_POST['banned']);
    $id = check_string($_POST['id']);
    $user = check_string($_POST['user']);
    if($moneydefault != $money)
    {
        $NNL->insert("dongtien", array(
            'sotientruoc'   => $moneydefault,
            'sotienthaydoi' => $money,
            'sotiensau'     => $money+$moneydefault,
            'thoigian'      => gettime(),
            'noidung'       => 'Admin thay đổi số dư',
            'username'      => $user
        ));
    }
    $NNL->update("users", array(
        'otp'           => $otp,
        'token'         => $token,
        'money'         => $money,
        'level'         => $level,
        'banned'        => $banned
    ), " `id` = '$id' ");
    exit(json_encode(array('status' => '2', 'msg' => 'Đã cập nhật dữ liệu người dùng')));
}

if ($_POST['type'] == 'PlusMoney' && $getUser['level']=="admin") {
    $money = check_string($_POST['money']);
    $content = check_string($_POST['content']);
    $moneydefault = check_string($_POST['moneydefault']);
    $user = check_string($_POST['user']);
    if($money <= 0)
    {
        exit(json_encode(array('status' => '1', 'msg' => 'Số tiền đã nhập phải lớn hơn 0')));
    }
    $create = $NNL->insert("dongtien", [
        'sotientruoc' =>  $moneydefault,
        'sotienthaydoi' =>$money,
        'sotiensau' => $moneydefault + $money,
        'thoigian' => gettime(),
        'noidung' => 'Admin cộng tiền ('.$content.')',
        'username' => $user
    ]);
    if($create)
    {
        $NNL->cong("users", "money", $money, " `username` = '".$user."' ");
        exit(json_encode(array('status' => '2', 'msg' => 'Đã cộng '.$money.' thành công cho '.$user.'')));
    }
    else
    {
        exit(json_encode(array('status' => '1', 'msg' => 'Đã xảy ra lỗi vui lòng liên hệ 0978364572')));
    }
}

if ($_POST['type'] == 'Deduction' && $getUser['level']=="admin") {
    $money = check_string($_POST['money']);
    $content = check_string($_POST['content']);
    $moneydefault = check_string($_POST['moneydefault']);
    $user = check_string($_POST['user']);
    if($money <= 0)
    {
        exit(json_encode(array('status' => '1', 'msg' => 'Số tiền đã nhập phải lớn hơn 0')));
    }
    $create = $NNL->insert("dongtien", [
        'sotientruoc' =>  $moneydefault,
        'sotienthaydoi' =>-$money,
        'sotiensau' => $moneydefault - $money,
        'thoigian' => gettime(),
        'noidung' => 'Admin trừ tiền ('.$content.')',
        'username' => $user
    ]);
    if($create)
    {
        $NNL->tru("users", "money", $money, " `username` = '".$user."' ");
        exit(json_encode(array('status' => '2', 'msg' => 'Đã trừ '.$money.' thành công của '.$user.'')));
    }
    else
    {
        exit(json_encode(array('status' => '1', 'msg' => 'Đã xảy ra lỗi vui lòng liên hệ 0978364572')));
    }
}

if ($_POST['type'] == 'saveOptions' && $getUser['level']=="admin") {
    $stt = check_string($_POST['stt']);
    $day = check_string($_POST['day']);
    $money = check_string($_POST['money']);
    $name = $_POST['name'];
    if($money <= 0)
    {
        exit(json_encode(array('status' => '1', 'msg' => 'Số tiền đã nhập phải lớn hơn 0')));
    }
    $create = $NNL->insert("service", [
        'stt' =>  $stt,
        'day' =>$day,
        'money' => $money,
        'name' => $name
    ]);
    if($create)
    {
      
        exit(json_encode(array('status' => '2', 'msg' => 'Thêm thành công')));
    }
    else
    {
        exit(json_encode(array('status' => '1', 'msg' => 'Đã xảy ra lỗi vui lòng liên hệ 0978364572')));
    }
}

if ($_POST['type'] == 'updateOptions' && $getUser['level']=="admin") {
    $id = check_string($_POST['id']);
    $stt = check_string($_POST['stt']);
    $day = check_string($_POST['day']);
    $money = check_string($_POST['money']);
    $name = $_POST['name'];
    $NNL->update("service", array(
        'stt'           => $stt,
        'day'         => $day,
        'money'         => $money,
        'name'         => $name
    ), " `id` = '$id' ");
    exit(json_encode(array('status' => '2', 'msg' => 'Đã cập nhật dữ liệu')));
}
if ($_POST['type'] == 'btnSaveOption' && $getUser['level']=="admin") {
    foreach ($_POST as $key => $value)
    {
        $NNL->update("options", array(
            'value' => $value
        ), " `key` = '$key' ");
    }
    exit(json_encode(array('status' => '2', 'msg' => 'Đã cập nhật dữ liệu')));
}

