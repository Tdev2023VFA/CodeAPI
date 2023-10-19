<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");

    if ($_POST['act'] == 'totalzalopay')
    {
        if(empty($_SESSION['username']))
        {
            nnl_error("Vui lòng đăng nhập để thanh toán !");
        }
        $thoigiangiahanzalopay = check_string($_POST['thoigiangiahanzalopay']);
        $money = $NNL->site('money_api_zalopay');
        $totaltpbank = $money * $thoigiangiahanzalopay;
        echo '<input type="text" id="Name" class="form-control t14 RoR" placeholder="" value="'.format_cash($totaltpbank).' VNĐ" disabled="disabled">';
    }