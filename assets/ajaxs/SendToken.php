<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once('../../class/class.smtp.php');
    require_once('../../class/PHPMailerAutoload.php');
    require_once('../../class/class.phpmailer.php');
    if(isset($_POST['id']) && $_POST['action'] == 'TOKENTSR')
    {
        if(empty($_SESSION['username']))
        {
            die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
        }
        if (!$getUser = $NNL->get_row("SELECT * FROM `users` WHERE `username` = '" . $_SESSION['username']. "' AND `banned` = '0' ")) {
            die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
        }
        $id = xss($_POST['id']);
        if(empty($id))
        {
            exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền thông tin!')));
        }
        $row = $NNL->get_row(" SELECT * FROM `account_thesieure` WHERE `id` = '$id' AND `user_id`='".$getUser['id']."' ");
        if(!$row)
        {
            exit(json_encode(array('status' => '1', 'msg' => 'Tài khoản thẻ siêu rẻ không tồn tại!')));
        }
        $user = $NNL->get_row(" SELECT * FROM `users` WHERE `id` = '".$row['user_id']."' ");
        if(!$user)
        {
            exit(json_encode(array('status' => '1', 'msg' => 'Người dùng không tồn tại!')));
        }
        
        $guitoi = $user['email'];   
        $subject = 'TOKEN THẺ SIÊU RẺ';
        $bcc = "SIÊU THỊ CODE";
        $hoten ='Client';
        $token = $row['token'];
        $noi_dung = '<h3>Có ai đó vừa yêu cầu gửi token thẻ siêu rẻ bằng Email này, nếu là bạn thì token bên dưới dùng để chạy api</h3>
        <table>
        <tbody>
        <tr>
        <td style="font-size:20px;">TOKEN:</td>
        <td><b style="color:blue;font-size:30px;">'.$token.'</b></td>
        </tr>
        </tbody>
        </table>';
        Locdz_Email($guitoi, $hoten, $subject, $noi_dung, $bcc);   
        exit(json_encode(array('status' => '2', 'msg' => 'Đã gửi token đến mail của bạn!')));
    }

    if(isset($_POST['id']) && $_POST['action'] == 'TOKENTPBANK')
    {
        if(empty($_SESSION['username']))
        {
            die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
        }
        if (!$getUser = $NNL->get_row("SELECT * FROM `users` WHERE `username` = '" . $_SESSION['username']. "' AND `banned` = '0' ")) {
            die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
        }
        $id = xss($_POST['id']);
        if(empty($id))
        {
            exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền thông tin!')));
        }
        $row = $NNL->get_row(" SELECT * FROM `account_tpbank` WHERE `id` = '$id' AND `username`='".$getUser['username']."' ");
        if(!$row)
        {
            exit(json_encode(array('status' => '1', 'msg' => 'Tài khoản TPBank không tồn tại!')));
        }
        $user = $NNL->get_row(" SELECT * FROM `users` WHERE `username` = '".$row['username']."' ");
        if(!$user)
        {
            exit(json_encode(array('status' => '1', 'msg' => 'Người dùng không tồn tại!')));
        }
        
        $guitoi = $user['email'];   
        $subject = 'TOKEN KÍCH HOẠT TPBANK';
        $bcc = "SIÊU THỊ CODE";
        $hoten ='Client';
        $token = $row['token'];
        $noi_dung = '<h3>Có ai đó vừa yêu cầu gửi token tpbank bằng Email này, nếu là bạn thì token bên dưới dùng để chạy api</h3>
        <table>
        <tbody>
        <tr>
        <td style="font-size:20px;">TOKEN:</td>
        <td><b style="color:blue;font-size:30px;">'.$token.'</b></td>
        </tr>
        </tbody>
        </table>';
        Locdz_Email($guitoi, $hoten, $subject, $noi_dung, $bcc);   
        exit(json_encode(array('status' => '2', 'msg' => 'Đã gửi token đến mail của bạn!')));
    }
 if(isset($_POST['id']) && $_POST['action'] == 'TOKENMBBANK')
    {
        if(empty($_SESSION['username']))
        {
            die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
        }
        if (!$getUser = $NNL->get_row("SELECT * FROM `users` WHERE `username` = '" . $_SESSION['username']. "' AND `banned` = '0' ")) {
            die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
        }
        $id = xss($_POST['id']);
        if(empty($id))
        {
            exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền thông tin!')));
        }
        $row = $NNL->get_row(" SELECT * FROM `account_mbbank` WHERE `id` = '$id' AND `username`='".$getUser['username']."' ");
        if(!$row)
        {
            exit(json_encode(array('status' => '1', 'msg' => 'Tài khoản MBBank không tồn tại!')));
        }
        $user = $NNL->get_row(" SELECT * FROM `users` WHERE `username` = '".$row['username']."' ");
        if(!$user)
        {
            exit(json_encode(array('status' => '1', 'msg' => 'Người dùng không tồn tại!')));
        }
        
        $guitoi = $user['email'];   
        $subject = 'TOKEN KÍCH HOẠT MBBANK';
        $bcc = "SIÊU THỊ CODE";
        $hoten ='Client';
        $token = $row['token'];
        $noi_dung = '<h3>Có ai đó vừa yêu cầu gửi token mbbank bằng Email này, nếu là bạn thì token bên dưới dùng để chạy api</h3>
        <table>
        <tbody>
        <tr>
        <td style="font-size:20px;">TOKEN:</td>
        <td><b style="color:blue;font-size:30px;">'.$token.'</b></td>
        </tr>
        </tbody>
        </table>';
        Locdz_Email($guitoi, $hoten, $subject, $noi_dung, $bcc);   
        exit(json_encode(array('status' => '2', 'msg' => 'Đã gửi token đến mail của bạn!')));
    }
    if(isset($_POST['id']) && $_POST['action'] == 'TOKENZALOPAY')
    {
        if(empty($_SESSION['username']))
        {
            die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
        }
        if (!$getUser = $NNL->get_row("SELECT * FROM `users` WHERE `username` = '" . $_SESSION['username']. "' AND `banned` = '0' ")) {
            die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
        }
        $id = xss($_POST['id']);
        if(empty($id))
        {
            exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền thông tin!')));
        }
        $row = $NNL->get_row(" SELECT * FROM `account_zalopay` WHERE `id` = '$id' AND `username`='".$getUser['username']."' ");
        if(!$row)
        {
            exit(json_encode(array('status' => '1', 'msg' => 'Tài khoản Zalopay không tồn tại!')));
        }
        $user = $NNL->get_row(" SELECT * FROM `users` WHERE `username` = '".$row['username']."' ");
        if(!$user)
        {
            exit(json_encode(array('status' => '1', 'msg' => 'Người dùng không tồn tại!')));
        }
        
        $guitoi = $user['email'];   
        $subject = 'TOKEN KÍCH HOẠT ZALOPAY';
        $bcc = "SIÊU THỊ CODE";
        $hoten ='Client';
        $token = $row['token'];
        $noi_dung = '<h3>Có ai đó vừa yêu cầu gửi token Zalopay bằng Email này, nếu là bạn thì token bên dưới dùng để chạy api</h3>
        <table>
        <tbody>
        <tr>
        <td style="font-size:20px;">TOKEN:</td>
        <td><b style="color:blue;font-size:30px;">'.$token.'</b></td>
        </tr>
        </tbody>
        </table>';
        Locdz_Email($guitoi, $hoten, $subject, $noi_dung, $bcc);   
        exit(json_encode(array('status' => '2', 'msg' => 'Đã gửi token đến mail của bạn!')));
    }
    if(isset($_POST['id']) && $_POST['action'] == 'TOKENVCB')
    {
        if(empty($_SESSION['username']))
        {
            die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
        }
        if (!$getUser = $NNL->get_row("SELECT * FROM `users` WHERE `username` = '" . $_SESSION['username']. "' AND `banned` = '0' ")) {
            die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
        }
        $id = xss($_POST['id']);
        if(empty($id))
        {
            exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền thông tin!')));
        }
        $row = $NNL->get_row(" SELECT * FROM `vietcombank` WHERE `id` = '$id' AND `user_id`='".$getUser['id']."' ");
        if(!$row)
        {
            exit(json_encode(array('status' => '1', 'msg' => 'Tài khoản Vietcombank không tồn tại!')));
        }
        $user = $NNL->get_row(" SELECT * FROM `users` WHERE `id` = '".$row['user_id']."' ");
        if(!$user)
        {
            exit(json_encode(array('status' => '1', 'msg' => 'Người dùng không tồn tại!')));
        }
        
        $guitoi = $user['email'];   
        $subject = 'TOKEN KÍCH HOẠT VIETCOMBANK';
        $bcc = "SIÊU THỊ CODE";
        $hoten ='Client';
        $token = $row['token'];
        $noi_dung = '<h3>Có ai đó vừa yêu cầu gửi token Vietcombank bằng Email này, nếu là bạn thì token bên dưới dùng để chạy api</h3>
        <table>
        <tbody>
        <tr>
        <td style="font-size:20px;">TOKEN:</td>
        <td><b style="color:blue;font-size:30px;">'.$token.'</b></td>
        </tr>
        </tbody>
        </table>';
        Locdz_Email($guitoi, $hoten, $subject, $noi_dung, $bcc);   
        exit(json_encode(array('status' => '2', 'msg' => 'Đã gửi token đến mail của bạn!')));
    }

    if(isset($_POST['id']) && $_POST['action'] == 'TOKENMOMO')
    {
        if(empty($_SESSION['username']))
        {
            die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
        }
        if (!$getUser = $NNL->get_row("SELECT * FROM `users` WHERE `username` = '" . $_SESSION['username']. "' AND `banned` = '0' ")) {
            die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
        }
        $id = xss($_POST['id']);
        if(empty($id))
        {
            exit(json_encode(array('status' => '1', 'msg' => 'Vui lòng điền thông tin!')));
        }
        $row = $NNL->get_row(" SELECT * FROM `cron_momo` WHERE `id` = '$id' AND `user_id`='".$getUser['username']."' ");
        if(!$row)
        {
            exit(json_encode(array('status' => '1', 'msg' => 'Tài khoản momo không tồn tại!')));
        }
        $user = $NNL->get_row(" SELECT * FROM `users` WHERE `username` = '".$row['user_id']."' ");
        if(!$user)
        {
            exit(json_encode(array('status' => '1', 'msg' => 'Người dùng không tồn tại!')));
        }
        
        $guitoi = $user['email'];   
        $subject = 'TOKEN MOMO';
        $bcc = "SIÊU THỊ CODE";
        $hoten ='Client';
        $token = $row['setupKeyDecrypt'];
        $noi_dung = '<h3>Có ai đó vừa yêu cầu gửi token momo bằng Email này, nếu là bạn thì token bên dưới dùng để chạy api</h3>
        <table>
        <tbody>
        <tr>
        <td style="font-size:20px;">TOKEN:</td>
        <td><b style="color:blue;font-size:30px;">'.$token.'</b></td>
        </tr>
        </tbody>
        </table>';
        Locdz_Email($guitoi, $hoten, $subject, $noi_dung, $bcc);   
        exit(json_encode(array('status' => '2', 'msg' => 'Đã gửi token đến mail của bạn!')));
    }


