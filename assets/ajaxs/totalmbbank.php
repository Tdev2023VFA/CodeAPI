<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");

    if ($_POST['act'] == 'totalmbbank')
    {
        if(empty($_SESSION['username']))
        {
            nnl_error("Vui lòng đăng nhập để thanh toán !");
        }
        $thoigiangiahanmbbank = check_string($_POST['thoigiangiahanmbbank']);
        $money = $NNL->site('money_api_mbbank');
        $totaltpbank = $money * $thoigiangiahanmbbank;
        echo '<input type="text" id="Name" class="form-control t14 RoR" placeholder="" value="'.format_cash($totaltpbank).' VNĐ" disabled="disabled">';
    }