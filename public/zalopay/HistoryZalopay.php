<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = 'LỊCH SỬ GIAO DỊCH ZALOPAY | ' . $NNL->site('title');
require_once("../../public/Header.php");
CheckLogin();
require_once("../../class/Zalopay.php");
error_reporting(0);
$zalo = new Zalopay;
?>
<?php
if (isset($_GET['phone'])) {
    $rowData = $NNL->get_row(" SELECT * FROM `account_zalopay` WHERE `phone` = '" . check_string($_GET['phone']) . "' AND `username`='" . $_SESSION['username'] . "' ");
    if ($rowData) {
        $myUser = $NNL->get_row(" SELECT * FROM `users` WHERE `username` = '" . $rowData["username"] . "'");
            $lichsu = $zalo->checkHistory($rowData['session_id']);
            $result = json_decode($lichsu, true);
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
                                                    <th class="whitespace-nowrap">ICON</th>
                                                    <th class="whitespace-nowrap">LOẠI GIAO DỊCH</th>
                                                    <th class="whitespace-nowrap">MÃ GIAO DỊCH</th>
                                                    <th class="whitespace-nowrap">SỐ TIỀN</th>
                                                    <th class="whitespace-nowrap">NỘI DUNG</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($result['zalopayMsg']['tranList'] as $value) { ?>
                                                    <tr class="intro-x">
                                                        <td>
                                                            <div><?=$value['trans_time'] ?>
                                                            </div>
                                                        </td>
                                                        <td width="8%"><img width="100%" src="<?= $value['icon'] ?>"></td>
                                                        <td><?= $value['sign'] == '1' ? 'Nhận tiền' : 'Chuyển tiền' ?></td>
                                                        <td style="color:green">
                                                            <div><?= $value['trans_id'] ?></div>
                                                        </td>
                                                       
                                                      
                                                        <td style="color:green"><?= format_cash($value['trans_amount']) ?>đ</td>
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