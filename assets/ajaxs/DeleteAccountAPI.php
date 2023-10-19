<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
require_once('../../class/class.smtp.php');
require_once('../../class/PHPMailerAutoload.php');
require_once('../../class/class.phpmailer.php');
if (isset($_POST['id']) && $_POST['action'] == 'TPBANK') {
    if (empty($_SESSION['username'])) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    if (!$getUser = $NNL->get_row("SELECT * FROM `users` WHERE `username` = '" . $_SESSION['username'] . "' AND `banned` = '0' ")) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    $id = xss($_POST['id']);
    if (empty($id)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Không được!')));
    }
    $tool = $NNL->get_row(" SELECT * FROM `account_tpbank` WHERE `id` = '$id' AND `username`='" . $getUser['username'] . "' ");
    if (!$tool) {
        exit(json_encode(array('status' => '1', 'msg' => 'Định hack à không dễ vậy đâu!')));
    }
    $NNL->remove("account_tpbank", "`id`='" . $id . "'");
    exit(json_encode(array('status' => '2', 'msg' => 'Đã xóa tài khoản thành công!')));
}
if (isset($_POST['id']) && $_POST['action'] == 'VCB') {
    if (empty($_SESSION['username'])) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    if (!$getUser = $NNL->get_row("SELECT * FROM `users` WHERE `username` = '" . $_SESSION['username'] . "' AND `banned` = '0' ")) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    $id = xss($_POST['id']);
    if (empty($id)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Không được!')));
    }
    $tool = $NNL->get_row(" SELECT * FROM `vietcombank` WHERE `id` = '$id' AND `user_id`='" . $getUser['id'] . "' ");
    if (!$tool) {
        exit(json_encode(array('status' => '1', 'msg' => 'Định hack à không dễ vậy đâu!')));
    }
    $NNL->remove("vietcombank", "`id`='" . $id . "'");
    exit(json_encode(array('status' => '2', 'msg' => 'Đã xóa tài khoản thành công!')));
}
if (isset($_POST['id']) && $_POST['action'] == 'MBBANK') {
    if (empty($_SESSION['username'])) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    if (!$getUser = $NNL->get_row("SELECT * FROM `users` WHERE `username` = '" . $_SESSION['username'] . "' AND `banned` = '0' ")) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    $id = xss($_POST['id']);
    if (empty($id)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Không được!')));
    }
    $tool = $NNL->get_row(" SELECT * FROM `account_mbbank` WHERE `id` = '$id' AND `username`='" . $getUser['username'] . "' ");
    if (!$tool) {
        exit(json_encode(array('status' => '1', 'msg' => 'Định hack à không dễ vậy đâu!')));
    }
    $NNL->remove("account_mbbank", "`id`='" . $id . "'");
    exit(json_encode(array('status' => '2', 'msg' => 'Đã xóa tài khoản thành công!')));
}
if (isset($_POST['id']) && $_POST['action'] == 'ZALOPAY') {
    if (empty($_SESSION['username'])) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    if (!$getUser = $NNL->get_row("SELECT * FROM `users` WHERE `username` = '" . $_SESSION['username'] . "' AND `banned` = '0' ")) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    $id = xss($_POST['id']);
    if (empty($id)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Không được!')));
    }
    $tool = $NNL->get_row(" SELECT * FROM `account_zalopay` WHERE `id` = '$id' AND `username`='" . $getUser['username'] . "' ");
    if (!$tool) {
        exit(json_encode(array('status' => '1', 'msg' => 'Định hack à không dễ vậy đâu!')));
    }
    $NNL->remove("account_zalopay", "`id`='" . $id . "'");
    exit(json_encode(array('status' => '2', 'msg' => 'Đã xóa tài khoản thành công!')));
}

if (isset($_POST['id']) && $_POST['action'] == 'TSR') {
    if (empty($_SESSION['username'])) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    if (!$getUser = $NNL->get_row("SELECT * FROM `users` WHERE `username` = '" . $_SESSION['username'] . "' AND `banned` = '0' ")) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    $id = xss($_POST['id']);
    if (empty($id)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Không được!')));
    }
    $tool = $NNL->get_row(" SELECT * FROM `account_thesieure` WHERE `id` = '$id' AND `user_id`='" . $getUser['id'] . "' ");
    if (!$tool) {
        exit(json_encode(array('status' => '1', 'msg' => 'Định hack à không dễ vậy đâu!')));
    }
    $NNL->remove("account_thesieure", "`id`='" . $id . "'");
    exit(json_encode(array('status' => '2', 'msg' => 'Đã xóa tài khoản thành công!')));
}

if (isset($_POST['id']) && $_POST['action'] == 'MOMO') {
    if (empty($_SESSION['username'])) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    if (!$getUser = $NNL->get_row("SELECT * FROM `users` WHERE `username` = '" . $_SESSION['username'] . "' AND `banned` = '0' ")) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    $id = xss($_POST['id']);
    if (empty($id)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Không được!')));
    }
    $tool = $NNL->get_row(" SELECT * FROM `cron_momo` WHERE `id` = '$id' AND `user_id`='" . $getUser['username'] . "' ");
    if (!$tool) {
        exit(json_encode(array('status' => '1', 'msg' => 'Định hack à không dễ vậy đâu!')));
    }
    $NNL->remove("cron_momo", "`id`='" . $id . "'");
    exit(json_encode(array('status' => '2', 'msg' => 'Đã xóa tài khoản thành công!')));
}