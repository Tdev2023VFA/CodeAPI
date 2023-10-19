<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");

    if ($_POST['act'] == 'totalmomo')
    {
        if(empty($_SESSION['username']))
        {
            nnl_error("Vui lòng đăng nhập để thanh toán !");
        }
        $thoigiangiahanmomo = check_string($_POST['thoigiangiahanmomo']);
        $money = $NNL->site('money_api_momo');
        $totalmomo = $money * $thoigiangiahanmomo;
        echo '<input type="text" id="Name" class="form-control t14 RoR" placeholder="" value="'.format_cash($totalmomo).' VNĐ" disabled="disabled">';
    }
    if ($_POST['act'] == 'totalmomounlimit')
    {
        if(empty($_SESSION['username']))
        {
            nnl_error("Vui lòng đăng nhập để thanh toán !");
        }
        $thoigiangiahanmomounlimit = check_string($_POST['thoigiangiahanmomounlimit']);
        $money = $NNL->site('money_api_momo_unlimit');
        $totalmomo = $money * $thoigiangiahanmomounlimit;
        echo '<input type="text" id="Name" class="form-control t14 RoR" placeholder="" value="'.format_cash($totalmomo).' VNĐ" disabled="disabled">';
    }