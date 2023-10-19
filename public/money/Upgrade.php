<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = 'NÂNG CẤP GÓI | '.$NNL->site('title');
require_once("../../public/Header.php");
CheckLogin();
?>

<body class="main">
    <?php require_once("../../public/Sidebar.php");?>
    <!-- BEGIN: Top Bar -->
    <?php require_once("../../public/Navbar.php");?>
    <!-- END: Top Bar -->
    <div class="wrapper">
        <div class="wrapper-box">
            <!-- BEGIN: Side Menu -->
            <?php require_once("../../public/SidebarPc.php");?>
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Pricing Tab -->
                <!-- BEGIN: Pricing Content -->
                <div class="flex mt-10">
                    <div class="tab-content">
                        <div id="layout-1-monthly-fees" class="tab-pane flex flex-col lg:flex-row active"
                            role="tabpanel" aria-labelledby="layout-1-monthly-fees-tab">
                            
                            <div class="intro-y flex-1 box py-16 lg:ml-5 mb-5 lg:mb-0">
                                <i data-feather="briefcase"
                                    class="block w-12 h-12 text-theme-1 dark:text-theme-10 mx-auto"></i>
                                <div class="text-xl font-medium text-center mt-10">Gói Momo, Thẻ siêu rẻ</div>
                                <div style="color: red;"
                                    class="text-gray-700 dark:text-gray-400 px-10 text-center mx-auto mt-2">Sử dụng cho
                                    các
                                    cổng: <br />Momo, Thẻ siêu rẻ</div>
                                <div style="color: red;"
                                    class="text-gray-600 dark:text-gray-400 px-10 text-center mx-auto mt-2">Mỗi cổng
                                    thêm vào tối đa <?=$NNL->site('limit_api_momo')?> tài khoản</div>
                                <div style="color: red;"
                                    class="text-gray-600 dark:text-gray-400 px-10 text-center mx-auto mt-2">(Không giới
                                    hạn
                                    số lượng kiểm tra giao dịch)</div>
                                <div class="flex justify-center">
                                    <div class="relative text-3xl font-semibold mt-8 mx-auto"> <?=format_cash($NNL->site('money_api_momo'))?>đ/tháng</div>
                                </div><br />
                                <div class="text-xl font-medium text-center mt-2">Chọn thời gian nâng cấp</div>
                                <div style="color: red;"
                                    class="text-gray-600 dark:text-gray-400 px-10 text-center mx-auto mt-2"> <select
                                        class="form-control" data-live-search="true" name="thoigiangiahanvcb"
                                        id="thoigiangiahanmomo" onchange="tongtienmomo()">
                                        <option value="">Chọn thời gian nâng cấp</option>
                                        <option value="1">1 Tháng</option>
                                        <option value="2">2 Tháng</option>
                                        <option value="3">3 Tháng</option>
                                        <option value="4">4 Tháng</option>
                                        <option value="5">5 Tháng</option>
                                        <option value="6">6 Tháng</option>
                                    </select></span><br /><br />
                                    <div id="tongtienmomo"></div><br />
                                    <a id="btnTransfergoimomo"
                                        class="btn btn-rounded-primary py-3 px-4 block mx-auto mt-8">Nâng cấp ngay</a>
                                </div>
                            </div>
                            
                            <div class="intro-y flex-1 box py-16 lg:ml-5 mb-5 lg:mb-0">
                                <i data-feather="briefcase"
                                    class="block w-12 h-12 text-theme-1 dark:text-theme-10 mx-auto"></i>
                                <div class="text-xl font-medium text-center mt-10">Gói Phổ Biến</div>
                                <div style="color: red;"
                                    class="text-gray-700 dark:text-gray-400 px-10 text-center mx-auto mt-2">Sử dụng cho
                                    các
                                    cổng: <br />MBBANK, ZALOPAY, TPBANK</div>
                                <div style="color: red;"
                                    class="text-gray-600 dark:text-gray-400 px-10 text-center mx-auto mt-2">Tối đa 3 tài
                                    khoản</div>
                                <div style="color: red;"
                                    class="text-gray-600 dark:text-gray-400 px-10 text-center mx-auto mt-2">(Không giới
                                    hạn
                                    số lượng kiểm tra giao dịch)</div>
                                <div class="flex justify-center">
                                    <div class="relative text-3xl font-semibold mt-8 mx-auto">
                                        <center><?=format_cash($NNL->site('money_api_mbbank'))?>đ/tháng</center>
                                    </div>

                                </div><br />
                                <div class="text-xl font-medium text-center mt-2">Chọn thời gian nâng cấp</div>
                                <div style="color: red;"
                                    class="text-gray-600 dark:text-gray-400 px-10 text-center mx-auto mt-2"> <select
                                        class="form-control" data-live-search="true"
                                        id="thoigiangiahanmbbank" onchange="tongtienmbbank()">
                                        <option value="">Chọn thời gian nâng cấp</option>
                                        <option value="1">1 Tháng</option>
                                        <option value="2">2 Tháng</option>
                                        <option value="3">3 Tháng</option>
                                        <option value="4">4 Tháng</option>
                                        <option value="5">5 Tháng</option>
                                        <option value="6">6 Tháng</option>
                                    </select></span><br /><br />
                                    <div id="tongtienmbbank"></div><br />
                                    <a id="btnTransfergoimbb"
                                        class="btn btn-rounded-primary py-3 px-4 block mx-auto mt-8">Nâng cấp ngay</a>
                                </div>
                            </div>
                            
                            <div class="intro-y flex-1 box py-16 lg:ml-5 mb-5 lg:mb-0">
                                <i data-feather="briefcase"
                                    class="block w-12 h-12 text-theme-1 dark:text-theme-10 mx-auto"></i>
                                <div class="text-xl font-medium text-center mt-10">Gói Vietcombank</div>
                                <div style="color: red;"
                                    class="text-gray-700 dark:text-gray-400 px-10 text-center mx-auto mt-2">Sử dụng cho
                                    các
                                    cổng: <br />VIETCOMBANK</div>
                                <div style="color: red;"
                                    class="text-gray-600 dark:text-gray-400 px-10 text-center mx-auto mt-2">Tối đa <?=format_cash($NNL->site('limit_api_vcb'))?> tài
                                    khoản</div>
                                <div style="color: red;"
                                    class="text-gray-600 dark:text-gray-400 px-10 text-center mx-auto mt-2">(Không giới
                                    hạn
                                    số lượng kiểm tra giao dịch)</div>
                                <div class="flex justify-center">
                                    <div class="relative text-3xl font-semibold mt-8 mx-auto">
                                        <center><?=format_cash($NNL->site('money_api_vcb'))?>đ/tháng</center>
                                    </div>

                                </div><br />
                                <div class="text-xl font-medium text-center mt-2">Chọn thời gian nâng cấp</div>
                                <div style="color: red;"
                                    class="text-gray-600 dark:text-gray-400 px-10 text-center mx-auto mt-2"> <select
                                        class="form-control" data-live-search="true"
                                        id="thoigiangiahanvcb" onchange="tongtienvcb()">
                                        <option value="">Chọn thời gian nâng cấp</option>
                                        <option value="1">1 Tháng</option>
                                        <option value="2">2 Tháng</option>
                                        <option value="3">3 Tháng</option>
                                        <option value="4">4 Tháng</option>
                                        <option value="5">5 Tháng</option>
                                        <option value="6">6 Tháng</option>
                                    </select></span><br /><br />
                                    <div id="tongtienvcb"></div><br />
                                    <a id="btnTransfergoivcb"
                                        class="btn btn-rounded-primary py-3 px-4 block mx-auto mt-8">Nâng cấp ngay</a>
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
    <div id="trangthai"></div>
    <script>
    function tron(n, c, d, t) {
        var c = isNaN(c = Math.abs(c)) ? 2 : c,
            d = d == undefined ? "." : d,
            t = t == undefined ? "," : t,
            s = n < 0 ? "-" : "",
            i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
            j = (j = i.length) > 3 ? j % 3 : 0;

        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(
            n -
            i).toFixed(c).slice(2) : "");
    };
    var Noti = function(type, msg) {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 1500
        };
        if (type == 2)
            toastr.success(msg, 'Thông báo');
        else
            toastr.error(msg, 'Thông báo');
    };
    $("#btnTransfergoimomo").click(function() {
        $.LoadingOverlay("show");
        var id = 1907;
        var thoigiangiahanmomo = $('#thoigiangiahanmomo').val();
        $.ajax({
            url: '<?=BASE_URL('assets/ajaxs/giahanmomo.php')?>',
            type: 'POST',
            data: {
                act: "momo",
                id: id,
                thoigiangiahanmomo: thoigiangiahanmomo
            },
            success: function(result) {
                $('#trangthai').html(result);
                $.LoadingOverlay("hide");
            }
        });
    });
     $("#btnTransfergoimomounlimit").click(function() {
        $.LoadingOverlay("show");
        var id = 1907;
        var thoigiangiahanmomounlimit = $('#thoigiangiahanmomounlimit').val();
        $.ajax({
            url: '<?=BASE_URL('assets/ajaxs/giahanmomo.php')?>',
            type: 'POST',
            data: {
                act: "momounlimit",
                id: id,
                thoigiangiahanmomounlimit: thoigiangiahanmomounlimit
            },
            success: function(result) {
                $('#trangthai').html(result);
                $.LoadingOverlay("hide");
            }
        });
    });
    
     $("#btnTransfergoimbb").click(function() {
        $.LoadingOverlay("show");
        var id = 1907;
        var thoigiangiahanmbbank = $('#thoigiangiahanmbbank').val();
        $.ajax({
            url: '<?=BASE_URL('assets/ajaxs/giahanmbbank.php')?>',
            type: 'POST',
            data: {
                act: "mbbank",
                id: id,
                thoigiangiahanmbbank: thoigiangiahanmbbank
            },
            success: function(result) {
                $('#trangthai').html(result);
                $.LoadingOverlay("hide");
            }
        });
    });
    
     $("#btnTransfergoivcb").click(function() {
        $.LoadingOverlay("show");
        var id = 1907;
        var thoigiangiahanvcb = $('#thoigiangiahanvcb').val();
        $.ajax({
            url: '<?=BASE_URL('assets/ajaxs/giahanvcb.php')?>',
            type: 'POST',
            data: {
                act: "vcb",
                id: id,
                thoigiangiahanvcb: thoigiangiahanvcb
            },
            success: function(result) {
                $('#trangthai').html(result);
                $.LoadingOverlay("hide");
            }
        });
    });
    
   

    function tongtienmomo() {
        $.LoadingOverlay("show");
        var thoigiangiahanmomo = $('#thoigiangiahanmomo').val();
        if (thoigiangiahanmomo == '') {
            $('#tongtienmomo').html('');
            $.LoadingOverlay("hide");
        } else {
            $.ajax({
                url: '<?=BASE_URL('assets/ajaxs/totalmomo.php')?>',
                type: 'POST',
                data: {
                    act: "totalmomo",
                    thoigiangiahanmomo: thoigiangiahanmomo
                },
                success: function(result) {
                    $('#tongtienmomo').html(result);
                    $.LoadingOverlay("hide");
                }
            });
        }

    }
    function tongtienmomounlimit() {
        $.LoadingOverlay("show");
        var thoigiangiahanmomounlimit = $('#thoigiangiahanmomounlimit').val();
        if (thoigiangiahanmomounlimit == '') {
            $('#tongtienmomounlimit').html('');
            $.LoadingOverlay("hide");
        } else {
            $.ajax({
                url: '<?=BASE_URL('assets/ajaxs/totalmomo.php')?>',
                type: 'POST',
                data: {
                    act: "totalmomounlimit",
                    thoigiangiahanmomounlimit: thoigiangiahanmomounlimit
                },
                success: function(result) {
                    $('#tongtienmomounlimit').html(result);
                    $.LoadingOverlay("hide");
                }
            });
        }

    }

    
    function tongtienmbbank() {
        $.LoadingOverlay("show");
        var thoigiangiahanmbbank = $('#thoigiangiahanmbbank').val();
        if (thoigiangiahanmbbank == '') {
            $('#tongtienmbbank').html('');
            $.LoadingOverlay("hide");
        } else {
            $.ajax({
                url: '<?=BASE_URL('assets/ajaxs/totalmbbank.php')?>',
                type: 'POST',
                data: {
                    act: "totalmbbank",
                    thoigiangiahanmbbank: thoigiangiahanmbbank
                },
                success: function(result) {
                    $('#tongtienmbbank').html(result);
                    $.LoadingOverlay("hide");
                }
            });
        }

    }
    function tongtienvcb() {
        $.LoadingOverlay("show");
        var thoigiangiahanvcb = $('#thoigiangiahanvcb').val();
        if (thoigiangiahanvcb == '') {
            $('#tongtienvcb').html('');
            $.LoadingOverlay("hide");
        } else {
            $.ajax({
                url: '<?=BASE_URL('assets/ajaxs/totalvcb.php')?>',
                type: 'POST',
                data: {
                    act: "totalvcb",
                    thoigiangiahanvcb: thoigiangiahanvcb
                },
                success: function(result) {
                    $('#tongtienvcb').html(result);
                    $.LoadingOverlay("hide");
                }
            });
        }

    }
   
    </script>
    <?php 
require_once("../../public/Footer.php");
?>