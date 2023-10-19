<?php 
// if (!defined('IN_SITE')) {
//     die('The Request Not Found');
// }
require_once("../../config/config.php");
 require_once("../../config/function.php");
$body = [
    'title' => 'Dashboard'
];
$body['header'] = '
    <!-- DataTables -->
    <link rel="stylesheet" href="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
';
$body['footer'] = '
    <!-- DataTables  & Plugins -->
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/jszip/jszip.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/pdfmake/pdfmake.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/pdfmake/vfs_fonts.js"></script>   
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
';
require_once(__DIR__.'/Header.php');
require_once(__DIR__.'/Sidebar.php');
require_once(__DIR__.'/Navbar.php');
CheckLogin();
CheckAdmin();
?>
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!--<div class="col-lg-4 col-6">-->
                <!--    <div class="card">-->
                <!--        <div class="card-header border-0">-->
                <!--            <h3 class="card-title">Thống kê tháng 04</h3>-->
                <!--        </div>-->
                <!--        <div class="card-body">-->
                <!--            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">-->
                <!--                <p class="text-success text-xl">-->
                <!--                    <i class="ion ion-ios-refresh-empty"></i>-->
                <!--                </p>-->
                <!--                <p class="d-flex flex-column text-right">-->
                <!--                    <span class="font-weight-bold">-->
                <!--                        11.700đ </span>-->
                <!--                    <span class="text-muted">DOANH THU ĐƠN HÀNG</span>-->
                <!--                </p>-->
                <!--            </div>-->
                            <!-- /.d-flex -->
                <!--            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">-->
                <!--                <p class="text-warning text-xl">-->
                <!--                    <i class="ion ion-ios-cart-outline"></i>-->
                <!--                </p>-->
                <!--                <p class="d-flex flex-column text-right">-->
                <!--                    <span class="font-weight-bold">-->
                <!--                        2 </span>-->
                <!--                    <span class="text-muted">TÀI KHOẢN ĐÃ BÁN</span>-->
                <!--                </p>-->
                <!--            </div>-->
                            <!-- /.d-flex -->
                <!--            <div class="d-flex justify-content-between align-items-center mb-0">-->
                <!--                <p class="text-danger text-xl">-->
                <!--                    <i class="ion ion-ios-people-outline"></i>-->
                <!--                </p>-->
                <!--                <p class="d-flex flex-column text-right">-->
                <!--                    <span class="font-weight-bold">-->
                <!--                        3 </span>-->
                <!--                    <span class="text-muted">THÀNH VIÊN MỚI</span>-->
                <!--                </p>-->
                <!--            </div>-->
                            <!-- /.d-flex -->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-lg-4 col-6">-->
                <!--    <div class="card">-->
                <!--        <div class="card-header border-0">-->
                <!--            <h3 class="card-title">Thống kê tuần</h3>-->
                <!--        </div>-->
                <!--        <div class="card-body">-->
                <!--            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">-->
                <!--                <p class="text-success text-xl">-->
                <!--                    <i class="ion ion-ios-refresh-empty"></i>-->
                <!--                </p>-->
                <!--                <p class="d-flex flex-column text-right">-->
                <!--                    <span class="font-weight-bold">-->
                <!--                        0đ </span>-->
                <!--                    <span class="text-muted">DOANH THU ĐƠN HÀNG</span>-->
                <!--                </p>-->
                <!--            </div>-->
                            <!-- /.d-flex -->
                <!--            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">-->
                <!--                <p class="text-warning text-xl">-->
                <!--                    <i class="ion ion-ios-cart-outline"></i>-->
                <!--                </p>-->
                <!--                <p class="d-flex flex-column text-right">-->
                <!--                    <span class="font-weight-bold">-->
                <!--                        0 </span>-->
                <!--                    <span class="text-muted">TÀI KHOẢN ĐÃ BÁN</span>-->
                <!--                </p>-->
                <!--            </div>-->
                            <!-- /.d-flex -->
                <!--            <div class="d-flex justify-content-between align-items-center mb-0">-->
                <!--                <p class="text-danger text-xl">-->
                <!--                    <i class="ion ion-ios-people-outline"></i>-->
                <!--                </p>-->
                <!--                <p class="d-flex flex-column text-right">-->
                <!--                    <span class="font-weight-bold">-->
                <!--                        0 </span>-->
                <!--                    <span class="text-muted">THÀNH VIÊN MỚI</span>-->
                <!--                </p>-->
                <!--            </div>-->
                            <!-- /.d-flex -->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-lg-4 col-6">-->
                <!--    <div class="card">-->
                <!--        <div class="card-header border-0">-->
                <!--            <h3 class="card-title">Thống kê hôm nay</h3>-->
                <!--        </div>-->
                <!--        <div class="card-body">-->
                <!--            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">-->
                <!--                <p class="text-success text-xl">-->
                <!--                    <i class="ion ion-ios-refresh-empty"></i>-->
                <!--                </p>-->
                <!--                <p class="d-flex flex-column text-right">-->
                <!--                    <span class="font-weight-bold">-->
                <!--                        0đ </span>-->
                <!--                    <span class="text-muted">DOANH THU ĐƠN HÀNG</span>-->
                <!--                </p>-->
                <!--            </div>-->
                            <!-- /.d-flex -->
                <!--            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">-->
                <!--                <p class="text-warning text-xl">-->
                <!--                    <i class="ion ion-ios-cart-outline"></i>-->
                <!--                </p>-->
                <!--                <p class="d-flex flex-column text-right">-->
                <!--                    <span class="font-weight-bold">-->
                <!--                        0 </span>-->
                <!--                    <span class="text-muted">TÀI KHOẢN ĐÃ BÁN</span>-->
                <!--                </p>-->
                <!--            </div>-->
                            <!-- /.d-flex -->
                <!--            <div class="d-flex justify-content-between align-items-center mb-0">-->
                <!--                <p class="text-danger text-xl">-->
                <!--                    <i class="ion ion-ios-people-outline"></i>-->
                <!--                </p>-->
                <!--                <p class="d-flex flex-column text-right">-->
                <!--                    <span class="font-weight-bold">-->
                <!--                        0 </span>-->
                <!--                    <span class="text-muted">THÀNH VIÊN MỚI</span>-->
                <!--                </p>-->
                <!--            </div>-->
                            <!-- /.d-flex -->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-md-3 col-sm-6 col-12">-->
                <!--    <div class="info-box">-->
                <!--        <span class="info-box-icon bg-info"><i class="far fa-money-bill-alt"></i></span>-->
                <!--        <div class="info-box-content">-->
                <!--            <span class="info-box-text">Tổng tiền nạp toàn thời gian</span>-->
                <!--            <span class="info-box-number">739.900đ</span>-->
                <!--        </div>-->
                        <!-- /.info-box-content -->
                <!--    </div>-->
                    <!-- /.info-box -->
                <!--</div>-->
                <!-- /.col -->
                <!--<div class="col-md-3 col-sm-6 col-12">-->
                <!--    <div class="info-box">-->
                <!--        <span class="info-box-icon bg-success"><i class="far fa-money-bill-alt"></i></span>-->
                <!--        <div class="info-box-content">-->
                <!--            <span class="info-box-text">Tổng tiền nạp tháng 04</span>-->
                <!--            <span class="info-box-number">0đ</span>-->
                <!--        </div>-->
                        <!-- /.info-box-content -->
                <!--    </div>-->
                    <!-- /.info-box -->
                <!--</div>-->
                <!-- /.col -->
                <!--<div class="col-md-3 col-sm-6 col-12">-->
                <!--    <div class="info-box">-->
                <!--        <span class="info-box-icon bg-warning"><i class="far fa-money-bill-alt"></i></span>-->
                <!--        <div class="info-box-content">-->
                <!--            <span class="info-box-text">Tổng tiền nạp tuần</span>-->
                <!--            <span class="info-box-number">0đ</span>-->
                <!--        </div>-->
                        <!-- /.info-box-content -->
                <!--    </div>-->
                    <!-- /.info-box -->
                <!--</div>-->
                <!-- /.col -->
                <!--<div class="col-md-3 col-sm-6 col-12">-->
                <!--    <div class="info-box">-->
                <!--        <span class="info-box-icon bg-danger"><i class="far fa-money-bill-alt"></i></span>-->
                <!--        <div class="info-box-content">-->
                <!--            <span class="info-box-text">Tổng tiền nạp hôm nay</span>-->
                <!--            <span class="info-box-number">0đ</span>-->
                <!--        </div>-->
                        <!-- /.info-box-content -->
                <!--    </div>-->
                    <!-- /.info-box -->
                <!--</div>-->
                <section class="col-lg-12 connectedSortable">
                    <div class="card card-primary card-outline">
                        <div class="card-header ">
                            <h3 class="card-title">
                                <i class="fas fa-history mr-1"></i>
                                500 GIAO DỊCH GẦN ĐÂY (<i>Ẩn dòng tiền của Admin</i>)
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn bg-warning btn-sm" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn bg-danger btn-sm" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive p-0">
                                <table id="datatable1" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                        <th width="5%">#</th>
                                            <th>Username</th>
                                            <th>Số tiền trước</th>
                                            <th>Số tiền thay đổi</th>
                                            <th>Số tiền hiện tại</th>
                                            <th>Thời gian</th>
                                            <th>Nội dung</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; foreach ($NNL->get_list("SELECT * FROM `log_balance` WHERE `id` > 0 ORDER BY id DESC LIMIT 500 ") as $row) {?>
                                        <tr>
                                            <td class="text-center"><?=$i++;?></td>
                                            <td class="text-center"><a
                                                    href="<?=base_url('admin/ListUsers/Edit/'.$row['user_id']);?>"><?=getUser($row['user_id'], 'username');?></a>
                                            </td>
                                            <td class="text-center"><b
                                                    style="color: green;"><?=format_cash($row['money_before']);?></b>
                                            </td>
                                            <td class="text-center"><b
                                                    style="color:red;"><?=format_cash($row['money_change']);?></b>
                                            </td>
                                            <td class="text-center"><b
                                                    style="color: blue;"><?=format_cash($row['money_after']);?></b>
                                            </td>
                                            <td class="text-center"><i><?=$row['time'];?></i></td>
                                            <td><i><?=$row['content'];?></i></td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="col-lg-12 connectedSortable">
                    <div class="card card-primary card-outline">
                        <div class="card-header ">
                            <h3 class="card-title">
                                <i class="fas fa-history mr-1"></i>
                                500 NHẬT KÝ HOẠT ĐỘNG GẦN ĐÂY (<i>Ẩn nhật ký của Admin</i>)
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn bg-warning btn-sm" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn bg-danger btn-sm" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive p-0">
                                <table id="datatable2" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th>Username</th>
                                            <th width="40%">Action</th>
                                            <th>Time</th>
                                            <th>Ip</th>
                                            <th width="30%">Device</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; foreach ($NNL->get_list("SELECT * FROM `logs` WHERE `id` > 0 ORDER BY id DESC LIMIT 500 ") as $row) {?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td class="text-center"><a
                                                    href="<?=base_url('admin/ListUsers/Edit/'.$row['user_id']);?>"><?=getUser($row['user_id'], 'username');?></a>
                                            </td>
                                            <td><?=$row['action'];?></td>
                                            <td><?=$row['create_date'];?></td>
                                            <td><?=$row['ip'];?></td>
                                            <td><?=$row['device'];?></td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>


<script>
$(function() {
    $('#datatable1').DataTable();
});
</script>
<script>
$(function() {
    $('#datatable2').DataTable();
});
</script>
<?php
require_once(__DIR__.'/Footer.php');
?>
<script type="text/javascript">
$.ajax({
    url: "<?=BASE_URL('update.php');?>",
    type: "GET",
    dateType: "text",
    data: {},
    success: function(result) {

    }
});
</script>