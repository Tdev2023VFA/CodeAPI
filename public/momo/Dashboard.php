<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = 'LỊCH SỬ GIAO DỊCH VÀ CHUYỂN TIỀN | ' . $NNL->site('title');
require_once("../../public/Header.php");
CheckLogin();
require_once("../../class/momo.php");
error_reporting(0);
$Momo = new Momov2;
?>
<?php
if (isset($_GET['phonemomo'])) {
    $rowData = $NNL->get_row(" SELECT * FROM `cron_momo` WHERE `phone` = '" . xss($_GET['phonemomo']) . "' AND `user_id`='" . $_SESSION['username'] . "' ");
    if ($rowData) {
        $Momo->config = $rowData;
        if ($Momo->config['TimeLogin'] < time() - 1800) {
             $result = $Momo->GENERATE_TOKEN_AUTH_MSG();
                    $extra = $result["extra"];
                    $authen_token = $extra["AUTH_TOKEN"];
                    if(!isset($authen_token)){
                          $result_login = $Momo->USER_LOGIN_MSG();
                            $extra_login = $result_login["extra"];
                            $BankVerify = ($result_login['momoMsg']['bankVerifyPersonalid'] == 'null') ? '1' : '2';
                            $partnerCode = $result_login['momoMsg']['bankCode'] ?: '';
                            $NNL->update("cron_momo", [
                                'authorization' => $extra_login["AUTH_TOKEN"],
                                'try' => '0',
                                'BankVerify' => $BankVerify,
                                'agent_id' => $result_login["momoMsg"]["agentId"],
                                'RSA_PUBLIC_KEY' => $extra_login["REQUEST_ENCRYPT_KEY"],
                                'refreshToken' => $extra_login["REFRESH_TOKEN"],
                                'sessionkey' => $extra_login["SESSION_KEY"],
                                'partnerCode' => $partnerCode,
                                'errorDesc' => $extra_login["errorCode"],
                                'status' => 'success',
                                'errorDesc' => 'Thành Công',
                                'TimeLogin' => time()
                            ], " `phone` = '" . $Momo->config['phone'] . "' ");
                    }
                    else{
                        $NNL->update("cron_momo", [
                            'authorization' => $extra["AUTH_TOKEN"],
                            'RSA_PUBLIC_KEY' => $extra["REQUEST_ENCRYPT_KEY"],
                            'sessionkey' => $extra["SESSION_KEY"],
                            'errorDesc' => $result["errorCode"],
                            'TimeLogin'  => time()
                        ], " `phone` = '" . $Momo->config['phone'] . "' ");
                    }
        }
        //  $from = date("d/m/Y", strtotime("1 days ago"));
        //         $history = $Momo->CheckHistoryV2(1,50);
        $history = $Momo->CheckHisNew(24);
        $result = json_decode($history, true);
    } else {
        admin_msg_error("Liên kết không tồn tại", BASE_URL(''), 500);
    }
} else {
    admin_msg_error("Liên kết không tồn tại", BASE_URL(''), 0);
}

?>

<body class="main">
    <?php require_once("../../public/Sidebar.php"); ?>
    <!-- BEGIN: Top Bar -->
    <?php require_once("../../public/Navbar.php"); ?>
    <!-- END: Top Bar -->
    <div class="wrapper">
        <div class="wrapper-box">
            <!-- BEGIN: Side Menu -->
            <?php require_once("../../public/SidebarPc.php"); ?>
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Pricing Tab -->
                <div class="intro-y flex justify-center mt-6">
                    <div class="pricing-tabs nav nav-tabs box dark:bg-dark-1 rounded-full overflow-hidden" role="tablist"> <a id="layout-2-monthly-fees-tab" data-toggle="tab" data-target="#layout-2-monthly-fees" href="javascript:;" class="flex-1 w-32 lg:w-40 py-2 lg:py-3 whitespace-nowrap text-center active" role="tab" aria-controls="layout-2-monthly-fees" aria-selected="true">HTR Nhận tiền</a>
                        <a id="layout-2-annual-fees-tab" data-toggle="tab" data-target="#layout-2-annual-fees" href="javascript:;" class="flex-1 w-32 lg:w-40 py-2 lg:py-3 whitespace-nowrap text-center" role="tab" aria-controls="layout-2-annual-fees" aria-selected="false">HTR Chuyển tiền</a>
                        
                    </div>
                </div>
                <!-- END: Pricing Tab -->
                <!-- BEGIN: Pricing Content -->
                <div class="mt-10">
                    <div class="tab-content">
                        <div id="layout-2-monthly-fees" class="tab-pane flex flex-col lg:flex-row active" role="tabpanel" aria-labelledby="layout-2-monthly-fees-tab">
                            <div class="intro-y justify-center flex-col flex-1 text-center sm:px-10 lg:px-5 pb-10 lg:pb-0">
                                <div class="lg:text-justify text-gray-700 dark:text-gray-600">
                                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                                        <table class="table table-report -mt-2" id="mytable">
                                            <thead>
                                                <tr>
                                                    <th class="whitespace-nowrap">THỜI GIAN</th>
                                                    <th class="whitespace-nowrap">LOẠI GIAO DỊCH</th>
                                                    <th class="text-center whitespace-nowrap">MÃ GIAO DỊCH</th>
                                                    <th class="text-center whitespace-nowrap">SỐ ĐIỆN THOẠI</th>
                                                    <th class="text-center whitespace-nowrap">NGƯỜI CHUYỂN</th>
                                                    <th class="text-center whitespace-nowrap">SỐ TIỀN</th>
                                                    <th class="text-center whitespace-nowrap">NỘI DUNG</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($result['momoMsg']['tranList'] as $value) { ?>
                                                    <tr class="intro-x">
                                                        <td>
                                                            <div><?= date('d-m-Y H:i:s', ($value['millisecond']) / 1000) ?>
                                                            </div>
                                                        </td>
                                                        <td>Nhận tiền</td>
                                                        <td style="color:green">
                                                            <div><?= $value['tranId'] ?></div>
                                                        </td>
                                                        <td><?php if (isset($value['partnerId'])) {
                                                                echo $value['partnerId'];
                                                            } ?>
                                                        </td>
                                                        <td><?php if (isset($value['partnerName'])) {
                                                                echo $value['partnerName'];
                                                            } ?>
                                                        </td>
                                                        <td style="color:green"><?= format_cash($value['amount']) ?>đ</td>
                                                        <td><?php if (isset($value['comment'])) {
                                                                echo $value['comment'];
                                                            } ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--tab2-->
                        <div id="layout-2-annual-fees" class="tab-pane flex flex-col lg:flex-row" role="tabpanel" aria-labelledby="layout-2-annual-fees-tab">
                            <div class="intro-y justify-center flex-col flex-1 text-center sm:px-10 lg:px-5 pb-10 lg:pb-0">
                                <div class="lg:text-justify text-gray-700 dark:text-gray-600">
                                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                                        <table class="table table-report -mt-2" id="mytable1">
                                            <thead>
                                                <tr>
                                                    <th class="whitespace-nowrap">THỜI GIAN</th>
                                                    <th class="whitespace-nowrap">LOẠI GIAO DỊCH</th>
                                                    <th class="whitespace-nowrap">MÃ GIAO DỊCH</th>
                                                    <th class="whitespace-nowrap">SỐ ĐIỆN THOẠI NHẬN</th>
                                                    <th class="whitespace-nowrap">NGƯỜI CHUYỂN</th>
                                                    <th class="whitespace-nowrap">SỐ TIỀN</th>
                                                    <th class="whitespace-nowrap">NỘI DUNG</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($NNL->get_list("SELECT * FROM `send` where `user_id`='" . $getUser['username'] . "' AND `date_time` >= DATE(NOW()) AND `date_time` < DATE(NOW()) + INTERVAL 1 DAY ORDER BY `id` DESC") as $value) { ?>
                                                    <tr class="intro-x">
                                                        <td>

                                                            <?= date('d-m-Y H:i:s', $value['time']) ?>
                                                        </td>
                                                        <td>Chuyển tiền</td>
                                                        <td class="w-40" style="color:green">

                                                            <?= $value['tranId'] ?>
                                                        </td>
                                                        <td><?= $value['partnerId'] ?></td>
                                                        <td><?= $value['ownerName'] ?></td>
                                                        <td><?= format_cash($value['amount']) ?>đ</td>
                                                        <td><?= $value['comment'] ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>
                <!-- END: Pricing Content -->
            </div>
        </div>
        <!-- END: Content -->
    </div>
    </div>
    <?php
    require_once("../../public/Footer.php");
    ?>