<?php
require_once("../config/config.php");
require_once("../config/function.php");
$title = 'THÔNG TIN CÁ NHÂN | '.$NNL->site('tenweb');
require_once("../public/Header.php");
CheckLogin();
?>
<section class="p-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-12 mb-5">
                <?php require_once("../public/Tab.php");?>
            </div>
            <div class="col-md-9 col-12 mb-5">
                <div class="box-table shadow">
                    <div class="table responsive">
                        <h5 class="text-left text-black px-2 mt-2 fw-bold" style="border-left:4px solid green;">BIẾN
                            ĐỘNG
                            SỐ DƯ</h5>
                        <table class="table data-table table-hover" id="headerTable">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">SỐ TIỀN TRƯỚC</th>
                                    <th scope="col">SỐ TIỀN THAY ĐỔI</th>
                                    <th scope="col">SỐ TIỀN HIỆN TẠI</th>
                                    <th scope="col">THỜI GIAN</th>
                                    <th scope="col">NỘI DUNG</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach($NNL->get_list("SELECT * FROM `dongtien` where `username`='".$getUser['username']."' order by id desc") as $change) { ?>
                                <tr>
                                    <th scope="row"><?=$i++?></th>
                                    <td><?=format_cash($change['sotientruoc'])?>đ</td>
                                    <td><?=format_cash($change['sotienthaydoi'])?>đ</td>
                                    <td><?=format_cash($change['sotiensau'])?>đ</td>
                                    <td><?=$change['thoigian']?></td>
                                    <td><?=$change['noidung']?></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
require_once("../public/Footer.php");
?>