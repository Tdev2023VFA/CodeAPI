<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");

    if(isset($_POST['id']))
    {
        $id = check_string($_POST['id']);
        if(empty($_SESSION['username']))
        {
            nnl_error("Vui lòng đăng nhập để thanh toán !");
        }
        $user = $NNL->get_row(" SELECT * FROM `users` WHERE `username` = '".$getUser['username']."'");
        $row = $NNL->get_row(" SELECT * FROM `service` WHERE `id` = '$id'  ");
        if(!$row)
        {
            nnl_error("Dịch vụ API không tồn tại trong hệ thống.");
        }
        $giamgia = 0;
		$magiamgia = $_POST['magiamgia'];
		$check_giam_gia = $NNL->get_row("SELECT * FROM `giftcode` WHERE `code` = '$magiamgia' and `status`=0");
        if($check_giam_gia)
        {
            $info_giamgia = $check_giam_gia;
            $giamgia = $info_giamgia['phantram'];
        }
		$tien = $row['giatien'] - ($row['giatien'] / 100 * $giamgia);
        if($tien > $getUser['money'])
        {
            nnl_error("Số dư không đủ vui lòng nạp thêm.");
        }
        if(!empty($_POST['magiamgia']))
        {
            if($check_giam_gia)
            {
                if($info_giamgia['soluong'] <= 1)
				{
                    $NNL->update("giftcode", [
                        'status'      => '1',
                        'soluong'    => '0'
                    ], " `id` = '".$info_giamgia['id']."' ");
				} 
				else
				{
                    $NNL->update_quantity("giftcode"," `id` = '". $info_giamgia['id']."' ");
				}

                $isMoney = $NNL->tru("users", "money", $tien, " `username` = '".$getUser['username']."' ");
                if($isMoney)
                {
                    /* GHI LOG DÒNG TIỀN */
                    $NNL->insert("dongtien", array(
                        'sotientruoc'   => $getUser['money'],
                        'sotienthaydoi' => -$row['giatien'],
                        'sotiensau'     => $getUser['money']-$row['giatien'],
                        'thoigian'      => gettime(),
                        'noidung'       => 'Thuê API (#'.$row['name'].')',
                        'username'      => $getUser['username']
                    ));
                   
                    $NNL->insert("historyapi", array(
                        'username'   => $getUser['username'],
                        'type' => $row['name'],
                        'api_key' => random('qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789', 20),
                        'token'     => $user['token'],
                        'day'=>30
                    ));
                    $NNL->cong("service", "daban", 1, " `id` = '".$row['id']."' ");
                    nnl_success_time("Thanh toán thành công!", BASE_URL("lich-su-thue-api"), 1000);
                }
            }
            else
            {
                nnl_error('Mã giảm giá không tồn tại');
            }
                            
        }
        else
        {
            $isMoney = $NNL->tru("users", "money", $tien, " `username` = '".$getUser['username']."' ");
            if($isMoney)
            {
                /* GHI LOG DÒNG TIỀN */
                $NNL->insert("dongtien", array(
                    'sotientruoc'   => $getUser['money'],
                    'sotienthaydoi' => -$row['giatien'],
                    'sotiensau'     => $getUser['money']-$row['giatien'],
                    'thoigian'      => gettime(),
                    'noidung'       => 'Thuê API (#'.$row['name'].')',
                    'username'      => $getUser['username']
                ));
               
                $NNL->insert("historyapi", array(
                    'username'   => $getUser['username'],
                    'type' => $row['name'],
                    'api_key' => random('qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789', 20),
                    'token'     => $user['token'],
                    'day'=>30
                ));
                $NNL->cong("service", "daban", 1, " `id` = '".$row['id']."' ");
                nnl_success_time("Thanh toán thành công!", BASE_URL("lich-su-thue-api"), 1000);
            }
        }
    }