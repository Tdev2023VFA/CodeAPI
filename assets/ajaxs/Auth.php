<?php
require_once "../../config/config.php";
require_once "../../config/function.php";
date_default_timezone_set('Asia/Ho_Chi_Minh');
if ($_POST['type'] == 'Login') {
    $username = xss($_POST['username']);
    $password = sha1(xss($_POST['password']));
    if (empty($username)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng nhập tên đăng nhập !')));
    }
    if (empty($password)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng nhập mật khẩu !')));
    }
    if (check_username($username) != true) {
         exit(json_encode(array('status' => '1', 'msg' => 'Tài khoản không hợp lệ !')));
    }
    if (!$NNL->get_row(" SELECT * FROM `users` WHERE `username` = '$username' ")) {
        exit(json_encode(array('status' => '1', 'msg' => 'Tên đăng nhập không tồn tại !')));
    }
    if ($NNL->get_row(" SELECT * FROM `users` WHERE `username` = '$username' AND `banned` = '1' ")) {
        exit(json_encode(array('status' => '1', 'msg' => 'Tài khoản này đã bị khóa bởi BQT !i')));
    }
    if (!$NNL->get_row(" SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password' ")) {
        exit(json_encode(array('status' => '1', 'msg' => 'Mật khẩu đăng nhập không chính xác!')));
    }
    $NNL->update("users", [
        'otp' => null,
    ], " `username` = '$username' ");
    $_SESSION['username'] = $username;
    exit(json_encode(array('status' => '2', 'msg' => 'Đăng nhập thành công')));
}

if ($_POST['type'] == 'Register') {
    $username = xss($_POST['username']);
    $password = xss($_POST['password']);
    $repassword = xss($_POST['repassword']);
    $email = xss($_POST['email']);
    if (empty($username)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng nhập tên tài khoản !')));
    }
    if (check_username($username) != true) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng nhập định dạng tài khoản hợp lệ')));
    }
    if (strlen($username) < 6 || strlen($username) > 64) {
        exit(json_encode(array('status' => '1', 'msg' => 'Tài khoản phải từ 6 đến 64 ký tự')));
    }
    if ($NNL->get_row(" SELECT * FROM `users` WHERE `username` = '$username' ")) {
        exit(json_encode(array('status' => '1', 'msg' => 'Tên đăng nhập đã tồn tại!')));
    }
    if (empty($password)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng nhập mật khẩu !')));
    }
    if (empty($repassword)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng nhập lại mật khẩu !')));
    }
    if (empty($email)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng nhập email!')));
    }
    if (check_email($email) != true) {
        exit(json_encode(array('status' => '1', 'msg' => 'Email không đúng định dạng!')));
    }
    if ($password != $repassword) {
        exit(json_encode(array('status' => '1', 'msg' => 'Nhập lại mật khẩu không đúng')));
    }
    if ($NNL->get_row(" SELECT * FROM `users` WHERE `email` = '$email' ")) {
        exit(json_encode(array('status' => '1', 'msg' => 'Email đã tồn tại!')));
    }
    if (strlen($password) < 6) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng đặt mật khẩu trên 6 ký tự')));
    }
    if ($NNL->num_rows(" SELECT * FROM `users` WHERE `ip` = '" . myip() . "' ") > 20) {
        exit(json_encode(array('status' => '1', 'msg' => 'Bạn đã đạt giới hạn tạo tài khoản')));
    }
    $secret = "6LcjungbAAAAALIA1X7Z4S1zgOdHZPaJmYmvB531";
    $ip = $_SERVER['REMOTE_ADDR'];
    $response = $_POST['captcha'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$ip";
    $fire = file_get_contents($url);
    $data = json_decode($fire);
    if ($data->success == false) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng xác thực captcha')));
    }else{
        $iscreate = $NNL->insert("users", [
        'username' => $username,
        'email' => $email,
        'password' => sha1($password),
        'token' => random('qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM', 64),
        'money' => 0,
        'total_money' => 0,
        'banned' => 0,
        'ip' => myip(),
        'port_momo' => 5,
        'time_api' => time() + 86400,
        'time_tpbank' => time() + 86400,
        'time_mbbank' => time() + 86400,
        'time_zalopay' => time() + 86400,
        'create_date' => gettime(),
    ]);
    if ($iscreate) {
        $_SESSION['username'] = $username;
        exit(json_encode(array('status' => '2', 'msg' => 'Tạo tài khoản thành công')));
    } else {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng kiểm tra cấu hình DATABASE')));
    }
            }
}

if ($_POST['type'] == 'ForgotPassword') {
    $email = xss($_POST['email']);
    if (empty($email)) {
        nnl_error("Vui lòng nhập địa chỉ email vào ô trống");
    }
    if (check_email($email) != true) {
        nnl_error('Vui lòng nhập địa chỉ email hợp lệ');
    }
    $row = $NNL->get_row(" SELECT * FROM `users` WHERE `email` = '$email' ");
    if (!$row) {
        nnl_error('Địa chỉ email không tồn tại trong hệ thống');
    }
    $otp = random('0123456789', '6');
    $NNL->update("users", array(
        'otp' => $otp,
    ), " `id` = '" . $row['id'] . "' ");
    $guitoi = $email;
    $subject = 'XÁC NHẬN KHÔI PHỤC MẬT KHẨU';
    $bcc = $NNL->site('tenweb');
    $hoten = 'Client';
    $noi_dung = '<h3>Có ai đó vừa yêu cầu khôi phục lại mật khẩu bằng Email này, nếu là bạn vui lòng nhập mã xác minh phía dưới để xác minh tài khoản</h3>
        <table>
        <tbody>
        <tr>
        <td style="font-size:20px;">OTP:</td>
        <td><b style="color:blue;font-size:30px;">' . $otp . '</b></td>
        </tr>
        </tbody>
        </table>';
    Locdz_Email($guitoi, $hoten, $subject, $noi_dung, $bcc);
    nnl_success_time('Chúng tôi đã gửi mã xác minh vào địa chỉ Email của bạn !', BASE_URL('xac-thuc-khoi-phuc'), 4000);
}

if ($_POST['type'] == 'ChangePassword') {
    $otp = xss($_POST['otp']);
    $repassword = xss($_POST['repassword']);
    $password = sha1(xss($_POST['password']));
    if (empty($otp)) {
        nnl_error("Bạn chưa nhập OTP");
    }
    if (empty($password)) {
        nnl_error("Bạn chưa nhập mật khẩu mới");
    }
    if (empty($repassword)) {
        nnl_error("Vui lòng xác minh lại mật khẩu");
    }
    if (isset($_SESSION['countVeri'])) {
        if ($_SESSION['countVeri'] >= 3) {
            nnl_error("Chức năng này tạm khóa");
        }
    } else {
        $_SESSION['countVeri'] = 0;
    }
    $row = $NNL->get_row(" SELECT * FROM `users` WHERE `otp` = '$otp' ");
    if (!$row) {
        $_SESSION['countVeri'] = $_SESSION['countVeri'] + 1;
        nnl_error("OTP không tồn tại trong hệ thống");
    }
    if ($password != $repassword) {
        nnl_error("Nhập lại mật khẩu không đúng");
    }
    if (strlen($password) < 5) {
        nnl_error('Vui lòng nhập mật khẩu có ích nhất 5 ký tự');
    }
    $NNL->update("users", [
        'otp' => null,
        'password' => TypePassword($password),
    ], " `id` = '" . $row['id'] . "' ");

    nnl_success("Mật khẩu của bạn đã được thay đổi thành công !");
}

if ($_POST['type'] == 'DoiMatKhau') {
    $repassword = check_string($_POST['repassword']);
    $password = check_string($_POST['password']);
    if (empty($password)) {
        nnl_error("Bạn chưa nhập mật khẩu mới");
    }
    if (empty($repassword)) {
        nnl_error("Vui lòng xác minh lại mật khẩu");
    }
    if ($password != $repassword) {
        nnl_error("Nhập lại mật khẩu không đúng");
    }
    if (strlen($password) < 5) {
        nnl_error('Vui lòng nhập mật khẩu có ích nhất 5 ký tự');
    }
    $row = $NNL->get_row(" SELECT * FROM `users` WHERE `username` = '" . $_SESSION['username'] . "' ");
    if (!$row) {
        nnl_error("Vui lòng đăng nhập!", BASE_URL(''), 2000);
    }
    $NNL->update("users", [
        'otp' => null,
        'password' => sha1($password),
    ], " `id` = '" . $row['id'] . "' ");
    nnl_success_time("Mật khẩu của bạn đã được thay đổi thành công !", "", 1000);
}
if ($_POST['type'] == 'DeleteAccount') {
    $id = check_string($_POST['id']);
    if (empty($id)) {
        nnl_error("Vui lòng nhập id");
    }
    $row = $NNL->get_row(" SELECT * FROM `users` WHERE `username` = '" . $_SESSION['username'] . "' ");
    if (!$row) {
        nnl_error("Vui lòng đăng nhập!", BASE_URL(''), 2000);
    }
    $tool = $NNL->get_row(" SELECT * FROM `accountmomo` WHERE `id` = '$id' ");
    if (!$tool) {
        nnl_error("Không tồn tại!", BASE_URL(''), 2000);
    }
    $NNL->remove("accountmomo", "`id`='" . $id . "'");
    nnl_success_time("Xóa tài khoản thành công !", BASE_URL('momo/Listmomo'), 1000);
}

if ($_POST['type'] == 'Upgrade') {
    $type = check_string($_POST['loai']);
    if (empty($type)) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng chọn gói nâng cấp')));
    }
    $row = $NNL->get_row(" SELECT * FROM `users` WHERE `username` = '" . $_SESSION['username'] . "' ");
    if (!$row) {
        exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng đăng nhập để thực hiện')));
    }
    $getType = $NNL->get_row(" SELECT * FROM `service` where `stt` ='".$type."'");
    if(!$getType)
    {
        exit(json_encode(array('status' => '1', 'msg' => 'Không tồn tại loại này')));
    }
    $time = time();
    $timehethan = $type;
    $money = $getType['money'];
    $day= $getType['day'];
    if ($row['time'] < $time) {
            $timeto = $time + 86400 * $day;
            $giatien = $money;
    } else {
            $timeto = $row['time'] + 86400 * $day;
            $giatien = $money;
    }
    //kiểm tra số dư so với giá tiền thuê
    if($row['money'] < $giatien)
    {
        exit(json_encode(array('status' => '1', 'msg' => 'Bạn không đủ số dư để nâng cấp gói thuê api')));
    }
    else
    {
          $isMoney = $NNL->tru("users", "money", $giatien, " `username` = '".$getUser['username']."' ");
          if($isMoney)
          {
                    // /* GHI LOG DÒNG TIỀN */
                    $NNL->insert("dongtien", array(
                        'sotientruoc'   => $getUser['money'],
                        'sotienthaydoi' => -$giatien,
                        'sotiensau'     => $getUser['money']-$giatien,
                        'thoigian'      => gettime(),
                        'noidung'       => 'Nâng cấp gói (#'.format_cash($giatien).'đ)',
                        'username'      => $getUser['username']
                    ));
                   
                    // $NNL->insert("historycode", array(
                    //     'username'   => $getUser['username'],
                    //     'idcode' => $row['id'],
                    //     'name' => $row['title'],
                    //     'price'     => $row['giatien']
                    // ));
                    $NNL->update("users", [
                        'time' => $timeto
                    ], " `username` = '".$_SESSION['username']."' ");
                    exit(json_encode(array('status' => '2', 'msg' => 'Nâng cấp gói thành công!')));
         }
    }
}

if ($_POST['type'] == 'UpdatePass') {
    $password = xss($_POST['password']);
    $repassword = xss($_POST['repassword']);
    if (empty($password)) {
        nnl_error("Vui lòng nhập mật khẩu mới !");
    }
    if (empty($password)) {
        nnl_error("Vui lòng nhập lại mật khẩu mới !");
    }
    if($password != $repassword)
    {
        nnl_error("2 mật khẩu không khớp nhau !");
    }
    $NNL->update("users", [
        'password' => sha1($password),
    ], " `username` = '".$getUser['username']."' ");
    nnl_success_time('Thay đổi mật khẩu thành công ', BASE_URL('info/profile'), 100);
}
if ($_POST['type'] == 'UpdateEmail') {
    $email = xss($_POST['email']);
    if (empty($email)) {
        nnl_error("Vui lòng nhập địa chỉ email vào ô trống");
    }
    if (check_email($email) != true) {
        nnl_error('Vui lòng nhập địa chỉ email hợp lệ');
    }
    $row = $NNL->get_row(" SELECT * FROM `users` WHERE `email` = '$email' AND `username` = '".$getUser['username']."'");
    if ($row) {
         nnl_error('Email đã tồn tại, vui lòng nhập email khác');
    }
  
     /* GHI LOG DÒNG TIỀN */
    $NNL->insert("logs", [
        'user_id'       => $getUser['id'],
        'ip'            => myip(),
        'device'        => $_SERVER['HTTP_USER_AGENT'],
        'create_date'    => gettime(),
        'action'        => "Thay đổi Email từ Email cũ: ".$getUser['email']." sang Email mới: $email"
    ]);
     $NNL->update("users", [
        'email' => $email,
    ], " `username` = '".$getUser['username']."' ");
    nnl_success_time('Thay đổi email thành công ', BASE_URL('info/profile'), 100);
}
