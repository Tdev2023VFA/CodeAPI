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
<?php
if (isset($_POST['updatemomo'])) {
    foreach ($_POST as $key => $value)
    {
        $NNL->update("options", array(
            'value' => $value
        ), " `key` = '$key' ");
    }
        die('<script type="text/javascript">if(!alert("Lưu thành công!")){window.history.back().location.reload();}</script>');
}
if (isset($_POST['updatemomounlimit'])) {
    foreach ($_POST as $key => $value)
    {
        $NNL->update("options", array(
            'value' => $value
        ), " `key` = '$key' ");
    }
        die('<script type="text/javascript">if(!alert("Lưu thành công!")){window.history.back().location.reload();}</script>');
}
if (isset($_POST['updatetsr'])) {
    foreach ($_POST as $key => $value)
    {
        $NNL->update("options", array(
            'value' => $value
        ), " `key` = '$key' ");
    }
        die('<script type="text/javascript">if(!alert("Lưu thành công!")){window.history.back().location.reload();}</script>');
}
if (isset($_POST['updatetpbank'])) {
    foreach ($_POST as $key => $value)
    {
        $NNL->update("options", array(
            'value' => $value
        ), " `key` = '$key' ");
    }
        die('<script type="text/javascript">if(!alert("Lưu thành công!")){window.history.back().location.reload();}</script>');
}
?>
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-4 connectedSortable">
                    <div class="card card-danger card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-cart-plus mr-1"></i>
                                CẤU HÌNH API MOMO UNLIMIT
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
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số tiền</label>
                                    <input type="number" class="form-control" name="money_api_momo_unlimit"
                                        value="<?=$NNL->site('money_api_momo_unlimit')?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giới hạn tài khoản</label>
                                    <input type="number" class="form-control" name="limit_api_momo_unlimit"
                                        value="<?=$NNL->site('limit_api_momo_unlimit')?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Trạng thái</label>
                                    <select class="form-control select2bs4" name="display_api_momo_unlimit">
                                        <option value="1" <?=$NNL->site('display_api_momo_unlimit') == '1' ? 'selected' : ''?>>
                                            Hoạt động
                                        </option>
                                        <option value="2" <?=$NNL->site('display_api_momo_unlimit') == '2' ? 'selected' : ''?>>
                                            Thử nghiệm
                                        </option>
                                        <option value="0" <?=$NNL->site('display_api_momo_unlimit') == '0' ? 'selected' : ''?>>
                                            Bảo trì
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer clearfix">
                                <button name="updatemomounlimit" class="btn btn-info btn-icon-left m-b-10" type="submit"><i class="fas fa-save mr-1"></i>Lưu Ngay</button>
                            </div>
                        </form>
                    </div>
                </section>
                <section class="col-lg-4 connectedSortable">
                    <div class="card card-danger card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-cart-plus mr-1"></i>
                                CẤU HÌNH API MOMO
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
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số tiền</label>
                                    <input type="number" class="form-control" name="money_api_momo"
                                        value="<?=$NNL->site('money_api_momo')?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giới hạn tài khoản</label>
                                    <input type="number" class="form-control" name="limit_api_momo"
                                        value="<?=$NNL->site('limit_api_momo')?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Trạng thái</label>
                                    <select class="form-control select2bs4" name="display_api_momo">
                                        <option value="1" <?=$NNL->site('display_api_momo') == '1' ? 'selected' : ''?>>
                                            Hoạt động
                                        </option>
                                        <option value="2" <?=$NNL->site('display_api_momo') == '2' ? 'selected' : ''?>>
                                            Thử nghiệm
                                        </option>
                                        <option value="0" <?=$NNL->site('display_api_momo') == '0' ? 'selected' : ''?>>
                                            Bảo trì
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer clearfix">
                                <button name="updatemomo" class="btn btn-info btn-icon-left m-b-10" type="submit"><i class="fas fa-save mr-1"></i>Lưu Ngay</button>
                            </div>
                        </form>
                    </div>
                </section>
                <section class="col-lg-4 connectedSortable">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-cart-plus mr-1"></i>
                                CẤU HÌNH API THẺ SIÊU RẺ
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
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số tiền</label>
                                    <input type="number" class="form-control" name="money_api_tsr"
                                        value="<?=$NNL->site('money_api_tsr')?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giới hạn tài khoản</label>
                                    <input type="number" class="form-control" name="limit_api_tsr"
                                        value="<?=$NNL->site('limit_api_tsr')?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Trạng thái</label>
                                    <select class="form-control select2bs4" name="display_api_tsr">
                                        <option value="1" <?=$NNL->site('display_api_tsr') == '1' ? 'selected' : ''?>>
                                            Hoạt động
                                        </option>
                                        <option value="2" <?=$NNL->site('display_api_tsr') == '2' ? 'selected' : ''?>>
                                            Thử nghiệm
                                        </option>
                                        <option value="0" <?=$NNL->site('display_api_tsr') == '0' ? 'selected' : ''?>>
                                            Bảo trì
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer clearfix">
                                <button name="updatetsr" class="btn btn-info btn-icon-left m-b-10" type="submit"><i class="fas fa-save mr-1"></i>Thêm Ngay</button>
                            </div>
                        </form>
                    </div>
                </section>
                <section class="col-lg-4 connectedSortable">
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-cart-plus mr-1"></i>
                                CẤU HÌNH API TPBANK
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
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số tiền</label>
                                    <input type="number" class="form-control" name="money_api_tpbank"
                                        value="<?=$NNL->site('money_api_tpbank')?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giới hạn tài khoản</label>
                                    <input type="number" class="form-control" name="limit_api_tpbank"
                                        value="<?=$NNL->site('limit_api_tpbank')?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Trạng thái</label>
                                    <select class="form-control select2bs4" name="display_api_tpbank">
                                        <option value="1" <?=$NNL->site('display_api_tpbank') == '1' ? 'selected' : ''?>>
                                            Hoạt động
                                        </option>
                                        <option value="2" <?=$NNL->site('display_api_tpbank') == '2' ? 'selected' : ''?>>
                                            Thử nghiệm
                                        </option>
                                        <option value="0" <?=$NNL->site('display_api_tpbank') == '0' ? 'selected' : ''?>>
                                            Bảo trì
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer clearfix">
                                <button name="updatetpbank" class="btn btn-info btn-icon-left m-b-10" type="submit"><i class="fas fa-save mr-1"></i>Thêm Ngay</button>
                            </div>
                        </form>
                    </div>
                </section>
                <section class="col-lg-4 connectedSortable">
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-cart-plus mr-1"></i>
                                CẤU HÌNH API MBBANK
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
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số tiền</label>
                                    <input type="number" class="form-control" name="money_api_mbbank"
                                        value="<?=$NNL->site('money_api_mbbank')?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giới hạn tài khoản</label>
                                    <input type="number" class="form-control" name="limit_api_mbbank"
                                        value="<?=$NNL->site('limit_api_mbbank')?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Trạng thái</label>
                                    <select class="form-control select2bs4" name="display_api_mbbank">
                                        <option value="1" <?=$NNL->site('display_api_mbbank') == '1' ? 'selected' : ''?>>
                                            Hoạt động
                                        </option>
                                        <option value="2" <?=$NNL->site('display_api_mbbank') == '2' ? 'selected' : ''?>>
                                            Thử nghiệm
                                        </option>
                                        <option value="0" <?=$NNL->site('display_api_mbbank') == '0' ? 'selected' : ''?>>
                                            Bảo trì
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer clearfix">
                                <button name="updatetpbank" class="btn btn-info btn-icon-left m-b-10" type="submit"><i class="fas fa-save mr-1"></i>Lưu Ngay</button>
                            </div>
                        </form>
                    </div>
                </section>
                <section class="col-lg-4 connectedSortable">
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-cart-plus mr-1"></i>
                                CẤU HÌNH API ZALOPAY
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
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số tiền</label>
                                    <input type="number" class="form-control" name="money_api_zalopay"
                                        value="<?=$NNL->site('money_api_zalopay')?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giới hạn tài khoản</label>
                                    <input type="number" class="form-control" name="limit_api_zalopay"
                                        value="<?=$NNL->site('limit_api_zalopay')?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Trạng thái</label>
                                    <select class="form-control select2bs4" name="display_api_zalopay">
                                        <option value="1" <?=$NNL->site('display_api_zalopay') == '1' ? 'selected' : ''?>>
                                            Hoạt động
                                        </option>
                                        <option value="2" <?=$NNL->site('display_api_zalopay') == '2' ? 'selected' : ''?>>
                                            Thử nghiệm
                                        </option>
                                        <option value="0" <?=$NNL->site('display_api_zalopay') == '0' ? 'selected' : ''?>>
                                            Bảo trì
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer clearfix">
                                <button name="updatetpbank" class="btn btn-info btn-icon-left m-b-10" type="submit"><i class="fas fa-save mr-1"></i>Lưu Ngay</button>
                            </div>
                        </form>
                    </div>
                </section>
                <section class="col-lg-4 connectedSortable">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-cart-plus mr-1"></i>
                                CẤU HÌNH API VIETCOMBANK
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
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số tiền</label>
                                    <input type="number" class="form-control" name="money_api_vcb"
                                        value="<?=$NNL->site('money_api_vcb')?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giới hạn tài khoản</label>
                                    <input type="number" class="form-control" name="limit_api_vcb"
                                        value="<?=$NNL->site('limit_api_vcb')?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Trạng thái</label>
                                    <select class="form-control select2bs4" name="display_api_vcb">
                                        <option value="1" <?=$NNL->site('display_api_vcb') == '1' ? 'selected' : ''?>>
                                            Hoạt động
                                        </option>
                                        <option value="2" <?=$NNL->site('display_api_vcb') == '2' ? 'selected' : ''?>>
                                            Thử nghiệm
                                        </option>
                                        <option value="0" <?=$NNL->site('display_api_vcb') == '0' ? 'selected' : ''?>>
                                            Bảo trì
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer clearfix">
                                <button name="updatetpbank" class="btn btn-info btn-icon-left m-b-10" type="submit"><i class="fas fa-save mr-1"></i>Lưu Ngay</button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<?php
require_once(__DIR__.'/Footer.php');
?>
</script>