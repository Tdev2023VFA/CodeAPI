<?php

define("IN_SITE", true);

require_once "../../../config/config.php";
require_once "../../../config/function.php";

if (isset($_POST['id'])) {
    $getUser = $NNL->get_row(" SELECT * FROM `users` WHERE `username`='" . $_SESSION['username'] . "' AND `level`='admin'");
    if(!$getUser)
    {
        $data = json_encode([
            'status'    => 'error',
            'msg'       => 'Vui lòng đăng nhập'
        ]);
        die($data);
    }
    $id = check_string($_POST['id']);
    $row = $NNL->get_row("SELECT * FROM `users` WHERE `id` = '$id' ");
    if (!$row) {
        $data = json_encode([
            'status'    => 'error',
            'msg'       => 'User không tồn tại trong hệ thống'
        ]);
        die($data);
    }
    $isRemove = $NNL->remove("users", " `id` = '$id' ");
    if ($isRemove) {
        $NNL->insert("logs", [
            'user_id'       => $getUser['id'],
            'ip'            => myip(),
            'device'        => $_SERVER['HTTP_USER_AGENT'],
            'create_date'    => gettime(),
            'action'        => 'Xóa thành viên ('.$getUser['username'].')'
         ]);
        $data = json_encode([
            'status'    => 'success',
            'msg'       => 'Xóa thành viên thành công'
        ]);
        die($data);
    }
} else {
    $data = json_encode([
        'status'    => 'error',
        'msg'       => 'Dữ liệu không hợp lệ'
    ]);
    die($data);
}
