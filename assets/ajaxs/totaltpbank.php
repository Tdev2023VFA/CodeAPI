<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");

    if ($_POST['act'] == 'totaltpbank')
    {
        if(empty($_SESSION['username']))
        {
            nnl_error("Vui lòng đăng nhập để thanh toán !");
        }
        $thoigiangiahantpbank = check_string($_POST['thoigiangiahantpbank']);
        $money = $NNL->site('money_api_tpbank');
        $totaltpbank = $money * $thoigiangiahantpbank;
        echo '<input type="text" id="Name" class="form-control t14 RoR" placeholder="" value="'.format_cash($totaltpbank).' VNĐ" disabled="disabled">';
    }