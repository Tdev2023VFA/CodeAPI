<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = 'LỊCH SỬ GIAO DỊCH VIETCOMBANK | ' . $NNL->site('title');
require_once("../../public/Header.php");
CheckLogin();
require_once("../../class/VCB.php");
error_reporting(0);
$vcb = new VCB;
?>
<?php
if (isset($_GET['account'])) {
   $getData = $NNL->get_row(" SELECT * FROM `vietcombank` WHERE `account` = '" . xss($_GET['account']) . "' AND `user_id`='" . $getUser['id'] . "' ");
    if ($getData) {
        $history = $vcb->get_lsgd($getData['username'], $getData['account'], $getData['session_id'], $getData['cif'], $getData['client_id'], $getData['mobile_id']);
        if (json_decode($history)->code != '00') {
            $response = getCaptcha($NNL->site('key_captcha'));
            $captcha_id =  json_decode($response, true)['data']['captcha_id'];
            $captcha = json_decode($response, true)['data']['captcha'];
            $token = md5(random('QWERTYUIOPASDGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm0123456789', 6) . time());
            $login = json_decode($vcb->login($getData['username'], $getData['password'], $captcha_id, $captcha), true);
            if ($login['code'] == '00') {
                $NNL->update("vietcombank", [
                    'session_id'           => $login['sessionId'],
                    'access_key'                => $login['accessKey'],
                    'client_id'           => $login['userInfo']['clientId'],
                    'mobile_id'           => $login['userInfo']['mobileId'],
                    'cif'                => $login['userInfo']['cif'],
                ], " `username` = '" . $getData['username'] . "' ");
               
            }
        } else {
            $result = json_decode($history, true);
        } 
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
                                                    <th class="whitespace-nowrap">Thời gian</th>
                                                    <th class="whitespace-nowrap">Loại</th>
                                                    <th class="whitespace-nowrap">Mã giao dịch</th>
                                                    <th class="whitespace-nowrap">Số tiền</th>
                                                    <th class="whitespace-nowrap">Nội dung</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($result['transactions'] as $value) { ?>
                                                <tr class="intro-x">
                                                    <td>
                                                        <div><?= $value['TransactionDate'] ?>
                                                        </div>
                                                    </td>
                                                    <td><?= $value['CD'] == '+' ? 'Nhận tiền' : 'Trừ tiền' ?></td>
                                                    <td style="color:blue">
                                                        <div><?= $value['Reference'] ?></div>
                                                    </td>
        
                                                    <td style="color:green"><?= format_cash(str_replace(',', '', $value['Amount'])) ?>đ</td>
                                                    <td><?php if (isset($value['Description'])) {
                                                            echo $value['Description'];
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