<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = 'LỊCH SỬ GIAO DỊCH MBBANK | ' . $NNL->site('title');
require_once("../../public/Header.php");
CheckLogin();
require_once("../../class/Mbbank.php");
error_reporting(0);
$MBBANK = new MBBANK;
?>
<?php
if (isset($_GET['stk'])) {
    $rowData = $NNL->get_row(" SELECT * FROM `account_mbbank` WHERE `stk` = '" . check_string($_GET['stk']) . "' AND `username`='" . $_SESSION['username'] . "' ");
    if ($rowData) {
        
         if ($rowData['time'] < time() - 180) {
                $MBBANK->generateImei = $MBBANK->generateImei();
                $MBBANK->refNo = check_string($rowData['phone']) . '-' . time();
                $MBBANK->userId = check_string($rowData['phone']);
                $MBBANK->pass = md5(check_string($rowData['password']));
                $check = $MBBANK->LoginMbBank($rowData['phone'], $rowData['password']);
                if ($check['result']['message'] == 'Customer is invalid') {
                    exit(json_encode(array('status' => '1', 'msg' => 'Thông tin không chính xác')));
                } else {
                    $NNL->update("account_mbbank", [
                        'name'         => $check['cust']['nm'],
                        'password'      => $rowData['password'],
                        'sessionId' => $check['sessionId'],
                        'deviceId' => $MBBANK->generateImei,
                        'time'  => time()
                    ], " `phone` = '" . $rowData['phone'] . "' ");
                }
            }
           $lichsu = $MBBANK->getHistoryV2($rowData['phone'],$rowData['sessionId'],$rowData['deviceId'],$rowData['stk'],30);
            //print_r($lichsu['notificationBusinessList']);
            $tranList = array();
            foreach ($lichsu['transactionHistoryList'] as $transaction) {
                $tranList[] = array(
                    "tranId" => $transaction['refNo'],
                    "postingDate" => $transaction['postingDate'],
                    "transactionDate" =>$transaction['transactionDate'],
                    "accountNo" => $transaction['accountNo'],
                    "creditAmount"=> $transaction['creditAmount'],
                    "debitAmount"=> $transaction['debitAmount'],
                    "currency"=> $transaction['currency'],
                    "description"=> $transaction['description'],
                    "availableBalance"=> $transaction['availableBalance'],
                    "beneficiaryAccount"=> $transaction['beneficiaryAccount'],
                     
                );
                
            }
            $json = json_encode(array(
                "status"  => "success",
                "message" => "Thành công",
                "TranList" => $tranList
            ));
            $result = json_decode($json, true);
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
                                                    <th class="whitespace-nowrap">THỜI GIAN</th>
                                                    <th class="whitespace-nowrap">MÃ GIAO DỊCH</th>
                                                    <th class="whitespace-nowrap">SỐ TIỀN CHUYỂN</th>
                                                    <th class="whitespace-nowrap">SỐ TIỀN NHẬN</th>
                                                    <th class="whitespace-nowrap">NỘI DUNG</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($result['TranList'] as $value) { ?>
                                                    <tr class="intro-x">
                                                        <td>
                                                            <div><?=$value['transactionDate'] ?>
                                                            </div>
                                                        </td>
                                                        <td style="color:green">
                                                            <div><?= $value['tranId'] ?></div>
                                                        </td>
                                                        <td style="color:green"><?= format_cash($value['debitAmount']) ?>đ</td>
                                                         <td style="color:green"><?= format_cash($value['creditAmount']) ?>đ</td>
                                                        <td><?=$value['description']?>
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