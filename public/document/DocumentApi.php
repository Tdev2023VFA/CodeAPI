<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = 'TÀI LIỆU API | ' . $NNL->site('title');
require_once("../../public/Header.php");
CheckLogin();
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
                <div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Tài liệu API </h2>
                </div>
                
                <div class="grid grid-cols-12 gap-6">

                    <!-- BEGIN: FAQ Menu -->
                    <div class="intro-y col-span-12 lg:col-span-12 xl:col-span-12">
                        <!-- BEGIN: Bordered Table -->
                        <div class="intro-y box mt-5">
                            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                                <h2 class="font-medium text-base mr-auto">
                                    Lấy lịch sử giao dịch Momo
                                </h2>
                                <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                                    <label class="form-check-label ml-0 sm:ml-2" for="show-example-1">Xem code php
                                        mẫu</label>
                                    <input data-target="#bordered-table" class="show-code form-check-switch mr-0 ml-3" type="checkbox" id="show-example-1">
                                </div>
                            </div>
                            <div class="p-5" id="bordered-table">
                                <div class="preview">
                                    <div class="overflow-x-auto">
                                        <p><strong>Mô tả</strong>: Giúp lấy danh sách giao dịch theo tài khoản</p>
                                        <p><strong>Method</strong>: GET</p>
                                        <p><strong>URL</strong>: <?= BASE_URL('') ?>historyapimomo/token</p>
                                        <p class="mt-10"><strong>Data Get (JSON)</strong>:</p>
                                        <pre><code class="php">
 {
     $token = "02a58884-1ab4-486d-81b4-e35f8dc5d7f4",
 }</code></pre>

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                        Tham số</th>
                                                    <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                        Dữ liệu</th>
                                                    <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                        Ví dụ</th>
                                                    <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                        Bắt buộc</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="border"><strong>token</strong></td>
                                                    <td class="border">String</td>
                                                    <td class="border">02a58884-1ab4-486d-81b4-e35f8dc5d7f4</td>
                                                    <td class="border">*</td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="source-code hidden">
                                    <button data-target="#copy-bordered-table" class="copy-code btn py-1 px-2 btn-outline-secondary"> <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy code php mẫu </button>
                                    <div class="overflow-y-auto mt-3 rounded-md">
                                        <pre class="source-preview" id="copy-bordered-table"> <code class="text-xs p-0 rounded-md php pl-5 pt-8 pb-4 -mb-10 -mt-10"> 
                                         &lt;?php
                                        $ch = curl_init('<?= BASE_URL('') ?>historyapimomo/02a58884-1ab4-486d-81b4-e35f8dc5d7f4');
   
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    print_r($response);</code> </pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Bordered Table -->

                        <!-- BEGIN: Hoverable Table -->

                    </div>
                    <!-- END: FAQ Menu -->
                    <!-- BEGIN: FAQ Menu -->
                    <div class="intro-y col-span-12 lg:col-span-12 xl:col-span-12">
                        <!-- BEGIN: Bordered Table -->
                        <div class="intro-y box mt-5">
                            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                                <h2 class="font-medium text-base mr-auto">
                                    Lấy lịch sử giao dịch Momo V2
                                </h2>
                                <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                                    <label class="form-check-label ml-0 sm:ml-2" for="show-example-1">Xem code php
                                        mẫu</label>
                                    <input data-target="#bordered-table" class="show-code form-check-switch mr-0 ml-3" type="checkbox" id="show-example-1">
                                </div>
                            </div>
                            <div class="p-5" id="bordered-table">
                                <div class="preview">
                                    <div class="overflow-x-auto">
                                        <p><strong>Mô tả</strong>: Giúp lấy danh sách giao dịch theo tài khoản</p>
                                        <p><strong>Method</strong>: GET</p>
                                        <p><strong>URL</strong>: <?= BASE_URL('') ?>historyapimomov3/token</p>
                                        <p class="mt-10"><strong>Data Get (JSON)</strong>:</p>
                                        <pre><code class="php">
 {
     $token = "02a58884-1ab4-486d-81b4-e35f8dc5d7f4",
 }</code></pre>

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                        Tham số</th>
                                                    <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                        Dữ liệu</th>
                                                    <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                        Ví dụ</th>
                                                    <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                        Bắt buộc</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="border"><strong>token</strong></td>
                                                    <td class="border">String</td>
                                                    <td class="border">02a58884-1ab4-486d-81b4-e35f8dc5d7f4</td>
                                                    <td class="border">*</td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="source-code hidden">
                                    <button data-target="#copy-bordered-table" class="copy-code btn py-1 px-2 btn-outline-secondary"> <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy code php mẫu </button>
                                    <div class="overflow-y-auto mt-3 rounded-md">
                                        <pre class="source-preview" id="copy-bordered-table"> <code class="text-xs p-0 rounded-md php pl-5 pt-8 pb-4 -mb-10 -mt-10"> 
                                         &lt;?php
                                        $ch = curl_init('<?= BASE_URL('') ?>historyapimomov2/02a58884-1ab4-486d-81b4-e35f8dc5d7f4');
   
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    print_r($response);</code> </pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Bordered Table -->

                        <!-- BEGIN: Hoverable Table -->



                    </div>
                    <!-- END: FAQ Menu -->
                    
                    
                    <!-- BEGIN: FAQ Menu -->
                    <div class="intro-y col-span-12 lg:col-span-12 xl:col-span-12">
                        <!-- BEGIN: Bordered Table -->
                        <div class="intro-y box mt-5">
                            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                                <h2 class="font-medium text-base mr-auto">
                                    Lấy lịch sử giao dịch thẻ siêu rẻ
                                </h2>
                                <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                                    <label class="form-check-label ml-0 sm:ml-2" for="show-example-1">Xem code php
                                        mẫu</label>
                                    <input data-target="#bordered-table" class="show-code form-check-switch mr-0 ml-3" type="checkbox" id="show-example-1">
                                </div>
                            </div>
                            <div class="p-5" id="bordered-table">
                                <div class="preview">
                                    <div class="overflow-x-auto">
                                        <p><strong>Mô tả</strong>: Giúp lấy danh sách giao dịch theo tài khoản</p>
                                        <p><strong>Method</strong>: GET</p>
                                        <p><strong>URL</strong>: <?= BASE_URL('') ?>historyapithesieure/token</p>
                                        <p class="mt-10"><strong>Data Get (JSON)</strong>:</p>
                                        <pre><code class="php">
 {
     $token = "02a58884-1ab4-486d-81b4-e35f8dc5d7f4",
 }</code></pre>

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                        Tham số</th>
                                                    <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                        Dữ liệu</th>
                                                    <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                        Ví dụ</th>
                                                    <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                        Bắt buộc</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="border"><strong>token</strong></td>
                                                    <td class="border">String</td>
                                                    <td class="border">02a58884-1ab4-486d-81b4-e35f8dc5d7f4</td>
                                                    <td class="border">*</td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="source-code hidden">
                                    <button data-target="#copy-bordered-table" class="copy-code btn py-1 px-2 btn-outline-secondary"> <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy code php mẫu </button>
                                    <div class="overflow-y-auto mt-3 rounded-md">
                                        <pre class="source-preview" id="copy-bordered-table"> <code class="text-xs p-0 rounded-md php pl-5 pt-8 pb-4 -mb-10 -mt-10"> 
                                         &lt;?php
                                        $ch = curl_init('<?= BASE_URL('') ?>historyapimomo/02a58884-1ab4-486d-81b4-e35f8dc5d7f4');
   
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    print_r($response);</code> </pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Bordered Table -->

                        <!-- BEGIN: Hoverable Table -->



                    </div>
                    <!-- END: FAQ Menu -->

                    <!-- BEGIN: FAQ Menu -->
                    <div class="intro-y col-span-12 lg:col-span-12 xl:col-span-12">
                        <!-- BEGIN: Bordered Table -->
                        <div class="intro-y box mt-5">
                            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                                <h2 class="font-medium text-base mr-auto">
                                    Lấy lịch sử giao dịch Tpbank
                                </h2>
                                <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                                    <label class="form-check-label ml-0 sm:ml-2" for="show-example-1">Xem code php
                                        mẫu</label>
                                    <input data-target="#bordered-table" class="show-code form-check-switch mr-0 ml-3" type="checkbox" id="show-example-1">
                                </div>
                            </div>
                            <div class="p-5" id="bordered-table">
                                <div class="preview">
                                    <div class="overflow-x-auto">
                                        <p><strong>Mô tả</strong>: Giúp lấy danh sách giao dịch theo tài khoản</p>
                                        <p><strong>Method</strong>: GET</p>
                                        <p><strong>URL</strong>: <?= BASE_URL('') ?>historyapitpb/token</p>
                                        <p class="mt-10"><strong>Data Get (JSON)</strong>:</p>
                                        <pre><code class="php">
 {
     $token = "02a58884-1ab4-486d-81b4-e35f8dc5d7f4",
 }</code></pre>

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                        Tham số</th>
                                                    <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                        Dữ liệu</th>
                                                    <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                        Ví dụ</th>
                                                    <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                        Bắt buộc</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="border"><strong>token</strong></td>
                                                    <td class="border">String</td>
                                                    <td class="border">02a58884-1ab4-486d-81b4-e35f8dc5d7f4</td>
                                                    <td class="border">*</td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="source-code hidden">
                                    <button data-target="#copy-bordered-table" class="copy-code btn py-1 px-2 btn-outline-secondary"> <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy code php mẫu </button>
                                    <div class="overflow-y-auto mt-3 rounded-md">
                                        <pre class="source-preview" id="copy-bordered-table"> <code class="text-xs p-0 rounded-md php pl-5 pt-8 pb-4 -mb-10 -mt-10"> 
                                         &lt;?php
                                        $ch = curl_init('<?= BASE_URL('') ?>historyapimomo/02a58884-1ab4-486d-81b4-e35f8dc5d7f4');
   
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    print_r($response);</code> </pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Bordered Table -->

                        <!-- BEGIN: Hoverable Table -->



                    </div>
                    <!-- END: FAQ Menu -->
                    <!-- BEGIN: FAQ Menu -->
                    <div class="intro-y col-span-12 lg:col-span-12 xl:col-span-12">
                        <!-- BEGIN: Bordered Table -->
                        <div class="intro-y box mt-5">
                            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                                <h2 class="font-medium text-base mr-auto">
                                    Lấy lịch sử giao dịch MBBANK NOTI
                                </h2>
                                <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                                    <label class="form-check-label ml-0 sm:ml-2" for="show-example-1">Xem code php
                                        mẫu</label>
                                    <input data-target="#bordered-table" class="show-code form-check-switch mr-0 ml-3" type="checkbox" id="show-example-1">
                                </div>
                            </div>
                            <div class="p-5" id="bordered-table">
                                <div class="preview">
                                    <div class="overflow-x-auto">
                                        <p><strong>Mô tả</strong>: Giúp lấy danh sách giao dịch theo tài khoản</p>
                                        <p><strong>Method</strong>: GET</p>
                                        <p><strong>URL</strong>: <?= BASE_URL('') ?>historyapimbnoti/token</p>
                                        <p class="mt-10"><strong>Data Get (JSON)</strong>:</p>
                                        <pre><code class="php">
 {
     $token = "02a58884-1ab4-486d-81b4-e35f8dc5d7f4",
 }</code></pre>

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                        Tham số</th>
                                                    <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                        Dữ liệu</th>
                                                    <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                        Ví dụ</th>
                                                    <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                        Bắt buộc</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="border"><strong>token</strong></td>
                                                    <td class="border">String</td>
                                                    <td class="border">02a58884-1ab4-486d-81b4-e35f8dc5d7f4</td>
                                                    <td class="border">*</td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="source-code hidden">
                                    <button data-target="#copy-bordered-table" class="copy-code btn py-1 px-2 btn-outline-secondary"> <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy code php mẫu </button>
                                    <div class="overflow-y-auto mt-3 rounded-md">
                                        <pre class="source-preview" id="copy-bordered-table"> <code class="text-xs p-0 rounded-md php pl-5 pt-8 pb-4 -mb-10 -mt-10"> 
                                         &lt;?php
                                        $ch = curl_init('<?= BASE_URL('') ?>historyapimbnoti/02a58884-1ab4-486d-81b4-e35f8dc5d7f4');
   
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    print_r($response);</code> </pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Bordered Table -->
                        <!-- BEGIN: FAQ Menu -->
                        <div class="intro-y col-span-12 lg:col-span-12 xl:col-span-12">
                            <!-- BEGIN: Bordered Table -->
                            <div class="intro-y box mt-5">
                                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                                    <h2 class="font-medium text-base mr-auto">
                                        Lấy lịch sử giao dịch MBBANK
                                    </h2>
                                    <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                                        <label class="form-check-label ml-0 sm:ml-2" for="show-example-1">Xem code php
                                            mẫu</label>
                                        <input data-target="#bordered-table" class="show-code form-check-switch mr-0 ml-3" type="checkbox" id="show-example-1">
                                    </div>
                                </div>
                                <div class="p-5" id="bordered-table">
                                    <div class="preview">
                                        <div class="overflow-x-auto">
                                            <p><strong>Mô tả</strong>: Giúp lấy danh sách giao dịch theo tài khoản</p>
                                            <p><strong>Method</strong>: GET</p>
                                            <p><strong>URL</strong>: <?= BASE_URL('') ?>historyapimbbank/token</p>
                                            <p class="mt-10"><strong>Data Get (JSON)</strong>:</p>
                                            <pre><code class="php">
 {
     $token = "02a58884-1ab4-486d-81b4-e35f8dc5d7f4",
 }</code></pre>

                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                            Tham số</th>
                                                        <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                            Dữ liệu</th>
                                                        <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                            Ví dụ</th>
                                                        <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                            Bắt buộc</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="border"><strong>token</strong></td>
                                                        <td class="border">String</td>
                                                        <td class="border">02a58884-1ab4-486d-81b4-e35f8dc5d7f4</td>
                                                        <td class="border">*</td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="source-code hidden">
                                        <button data-target="#copy-bordered-table" class="copy-code btn py-1 px-2 btn-outline-secondary"> <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy code php mẫu
                                        </button>
                                        <div class="overflow-y-auto mt-3 rounded-md">
                                            <pre class="source-preview" id="copy-bordered-table"> <code class="text-xs p-0 rounded-md php pl-5 pt-8 pb-4 -mb-10 -mt-10"> 
                                         &lt;?php
                                        $ch = curl_init('<?= BASE_URL('') ?>historyapimbbank/02a58884-1ab4-486d-81b4-e35f8dc5d7f4');
   
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    print_r($response);</code> </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END: Bordered Table -->

                            <!-- BEGIN: Hoverable Table -->



                        </div>
                        <!-- END: FAQ Menu -->
                        <!-- BEGIN: FAQ Menu -->
                        <div class="intro-y col-span-12 lg:col-span-12 xl:col-span-12">
                            <!-- BEGIN: Bordered Table -->
                            <div class="intro-y box mt-5">
                                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                                    <h2 class="font-medium text-base mr-auto">
                                        Lấy lịch sử giao dịch ZALOPAY
                                    </h2>
                                    <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                                        <label class="form-check-label ml-0 sm:ml-2" for="show-example-1">Xem code php
                                            mẫu</label>
                                        <input data-target="#bordered-table" class="show-code form-check-switch mr-0 ml-3" type="checkbox" id="show-example-1">
                                    </div>
                                </div>
                                <div class="p-5" id="bordered-table">
                                    <div class="preview">
                                        <div class="overflow-x-auto">
                                            <p><strong>Mô tả</strong>: Giúp lấy danh sách giao dịch theo tài khoản</p>
                                            <p><strong>Method</strong>: GET</p>
                                            <p><strong>URL</strong>: <?= BASE_URL('') ?>historyapizalopay/token</p>
                                            <p class="mt-10"><strong>Data Get (JSON)</strong>:</p>
                                            <pre><code class="php">
 {
     $token = "02a58884-1ab4-486d-81b4-e35f8dc5d7f4",
 }</code></pre>

                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                            Tham số</th>
                                                        <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                            Dữ liệu</th>
                                                        <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                            Ví dụ</th>
                                                        <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                            Bắt buộc</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="border"><strong>token</strong></td>
                                                        <td class="border">String</td>
                                                        <td class="border">02a58884-1ab4-486d-81b4-e35f8dc5d7f4</td>
                                                        <td class="border">*</td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="source-code hidden">
                                        <button data-target="#copy-bordered-table" class="copy-code btn py-1 px-2 btn-outline-secondary"> <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy code php mẫu
                                        </button>
                                        <div class="overflow-y-auto mt-3 rounded-md">
                                            <pre class="source-preview" id="copy-bordered-table"> <code class="text-xs p-0 rounded-md php pl-5 pt-8 pb-4 -mb-10 -mt-10"> 
                                         &lt;?php
                                        $ch = curl_init('<?= BASE_URL('') ?>historyapimbbank/02a58884-1ab4-486d-81b4-e35f8dc5d7f4');
   
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    print_r($response);</code> </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END: Bordered Table -->

                            <!-- BEGIN: Hoverable Table -->



                        </div>
                        <!-- END: FAQ Menu -->
                        <!-- BEGIN: FAQ Menu -->
                        <div class="intro-y col-span-12 lg:col-span-12 xl:col-span-12">
                            <!-- BEGIN: Bordered Table -->
                            <div class="intro-y box mt-5">
                                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                                    <h2 class="font-medium text-base mr-auto">
                                        Lấy lịch sử giao dịch Vietcombank
                                    </h2>
                                    <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                                        <label class="form-check-label ml-0 sm:ml-2" for="show-example-1">Xem code php
                                            mẫu</label>
                                        <input data-target="#bordered-table" class="show-code form-check-switch mr-0 ml-3" type="checkbox" id="show-example-1">
                                    </div>
                                </div>
                                <div class="p-5" id="bordered-table">
                                    <div class="preview">
                                        <div class="overflow-x-auto">
                                            <p><strong>Mô tả</strong>: Giúp lấy danh sách giao dịch theo tài khoản</p>
                                            <p><strong>Method</strong>: GET</p>
                                            <p><strong>URL</strong>: <?= BASE_URL('') ?>historyapivcb/token</p>
                                            <p class="mt-10"><strong>Data Get (JSON)</strong>:</p>
                                            <pre><code class="php">
 {
     $token = "02a58884-1ab4-486d-81b4-e35f8dc5d7f4",
 }</code></pre>

                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                            Tham số</th>
                                                        <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                            Dữ liệu</th>
                                                        <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                            Ví dụ</th>
                                                        <th class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                                            Bắt buộc</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="border"><strong>token</strong></td>
                                                        <td class="border">String</td>
                                                        <td class="border">02a58884-1ab4-486d-81b4-e35f8dc5d7f4</td>
                                                        <td class="border">*</td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="source-code hidden">
                                        <button data-target="#copy-bordered-table" class="copy-code btn py-1 px-2 btn-outline-secondary"> <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy code php mẫu
                                        </button>
                                        <div class="overflow-y-auto mt-3 rounded-md">
                                            <pre class="source-preview" id="copy-bordered-table"> <code class="text-xs p-0 rounded-md php pl-5 pt-8 pb-4 -mb-10 -mt-10"> 
                                         &lt;?php
                                        $ch = curl_init('<?= BASE_URL('') ?>historyapimbbank/02a58884-1ab4-486d-81b4-e35f8dc5d7f4');
   
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    print_r($response);</code> </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END: Bordered Table -->

                            <!-- BEGIN: Hoverable Table -->



                        </div>
                        <!-- END: FAQ Menu -->
                        <!-- BEGIN: FAQ Content tab phải-->
                        <div class="intro-y col-span-12 lg:col-span-12 xl:col-span-12">
                            <div class="intro-y box lg:mt-5">
                                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                    <h2 class="font-medium text-base mr-auto">
                                        Response mẫu
                                    </h2>
                                </div>
                                <div id="faq-accordion-1" class="accordion accordion-boxed p-5">

                                    <div class="accordion-item">
                                        <div id="faq-accordion-content-2" class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-accordion-collapse-2" aria-expanded="false" aria-controls="faq-accordion-collapse-2"> Mẫu giao
                                                dịch MOMO </button>
                                        </div>
                                        <div id="faq-accordion-collapse-2" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-2" data-bs-parent="#faq-accordion-1">
                                            <pre><code class="php">

  {
  "status": true,
  "message": "Thành công",
  "momoMsg": {
    "tranList": [
      {
        "tranId": 23643551872,
        "id": "1651314554074_01657385033",
        "partnerId": "0931999671",
        "partnerName": "ĐẶNG THỊ OANH",
        "comment": "6575",
        "amount": 640,
        "millisecond": 1651314554074
      },
      {
        "tranId": 23637631827,
        "id": "1651297613132_01657385033",
        "partnerId": "01677890408",
        "partnerName": "Ng Huynh Kim Ngan",
        "comment": "5874",
        "amount": 4400,
        "millisecond": 1651297613132
      },
      {
        "tranId": 23637142555,
        "id": "1651296256618_01657385033",
        "partnerId": "0965794164",
        "partnerName": "NGUYỄN HẢI NAM",
        "comment": "6570",
        "amount": 1000,
        "millisecond": 1651296256618
      },
      {
        "tranId": 23632283867,
        "id": "1651283787413_01657385033",
        "partnerId": "01207796252",
        "partnerName": "Lâm Hoài Bảo",
        "comment": "5907",
        "amount": 1500,
        "millisecond": 1651283787413
      },
      {
        "tranId": 23614629529,
        "id": "1651233928403_01657385033",
        "partnerId": "01214898679",
        "partnerName": "Nguyễn Đại Lộc",
        "comment": "6559",
        "amount": 100,
        "millisecond": 1651233928403
      }
    ]
  }
}
 

                            </code></pre>
                                        </div>
                                    </div>



                                </div>
                            </div>

                        </div>
                        <!-- END: FAQ Content -->
                        <!-- BEGIN: FAQ Content tab phải-->
                        <div class="intro-y col-span-12 lg:col-span-12 xl:col-span-12">
                            <div class="intro-y box lg:mt-5">
                                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                    <h2 class="font-medium text-base mr-auto">
                                        Response mẫu
                                    </h2>
                                </div>
                                <div id="faq-accordion-1" class="accordion accordion-boxed p-5">

                                    <div class="accordion-item">
                                        <div id="faq-accordion-content-2" class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-accordion-collapse-2" aria-expanded="false" aria-controls="faq-accordion-collapse-2"> Mẫu giao
                                                dịch thẻ siêu rẻ </button>
                                        </div>
                                        <div id="faq-accordion-collapse-2" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-2" data-bs-parent="#faq-accordion-1">
                                            <pre><code class="php">

  {
  "status": true,
  "msg": "Thành công",
  "tranList": [
    {
      "transId": "T9712690",
      "amount": "-10,100đ",
      "username": "kuudo9x",
      "date": "28-04-2022 12:22:39",
      "status": "Thành công",
      "description": "naptien_1"
    },
    {
      "transId": "T9303123",
      "amount": "35,000đ",
      "username": "s4diepvien",
      "date": "03-04-2022 19:13:14",
      "status": "Thành công",
      "description": "Tt"
    }
  ]
}
 

                            </code></pre>
                                        </div>
                                    </div>



                                </div>
                            </div>

                        </div>
                        <!-- END: FAQ Content -->
                        <!-- BEGIN: FAQ Content tab phải-->
                        <div class="intro-y col-span-12 lg:col-span-12 xl:col-span-12">
                            <div class="intro-y box lg:mt-5">
                                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                    <h2 class="font-medium text-base mr-auto">
                                        Response mẫu
                                    </h2>
                                </div>
                                <div id="faq-accordion-1" class="accordion accordion-boxed p-5">

                                    <div class="accordion-item">
                                        <div id="faq-accordion-content-2" class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-accordion-collapse-2" aria-expanded="false" aria-controls="faq-accordion-collapse-2"> Mẫu giao
                                                dịch Tpbank </button>
                                        </div>
                                        <div id="faq-accordion-collapse-2" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-2" data-bs-parent="#faq-accordion-1">
                                            <pre><code class="php">

  {
    "transactionInfos": [
    {
      "id": "6484564401",
      "arrangementId": "94364572380,VND-1651316107258-32b1ccf528eae86a303595120a9a5629046d617d226a701ff68560ad77994f91",
      "reference": "666ITC122118A0HJ",
      "description": "naptien 1",
      "category": "transaction_CategoryMoneyIn",
      "bookingDate": "2022-04-28",
      "valueDate": "2022-04-28",
      "amount": "10000",
      "currency": "VND",
      "creditDebitIndicator": "CRDT",
      "runningBalance": "30000",
      "ofsAcctNo": "28023456777888",
      "creditorBankNameVn": "Ngân hàng Quân Đội",
      "creditorBankNameEn": "Military Commercial Joint stock Bank"
    },
    {
      "id": "6435639489",
      "arrangementId": "94364572380,VND-1651316107258-32b1ccf528eae86a303595120a9a5629046d617d226a701ff68560ad77994f91",
      "reference": "666ITC122111B1VQ",
      "description": "TT-210422-20:31:54 827270",
      "category": "transaction_CategoryMoneyIn",
      "bookingDate": "2022-04-21",
      "valueDate": "2022-04-21",
      "amount": "10000",
      "currency": "VND",
      "creditDebitIndicator": "CRDT",
      "runningBalance": "10000",
      "ofsAcctNo": "2835551",
      "creditorBankNameVn": "Ngân hàng Á Châu",
      "creditorBankNameEn": "Asia Commercial Bank"
    }
  ]
}
 

                            </code></pre>
                                        </div>
                                    </div>



                                </div>
                            </div>

                        </div>
                        <!-- END: FAQ Content -->
                        <!-- BEGIN: FAQ Content tab phải-->
                        <div class="intro-y col-span-12 lg:col-span-12 xl:col-span-12">
                            <div class="intro-y box lg:mt-5">
                                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                    <h2 class="font-medium text-base mr-auto">
                                        Response mẫu
                                    </h2>
                                </div>
                                <div id="faq-accordion-1" class="accordion accordion-boxed p-5">

                                    <div class="accordion-item">
                                        <div id="faq-accordion-content-2" class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-accordion-collapse-2" aria-expanded="false" aria-controls="faq-accordion-collapse-2"> Mẫu giao
                                                dịch ZALOPAY </button>
                                        </div>
                                        <div id="faq-accordion-collapse-2" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-2" data-bs-parent="#faq-accordion-1">
                                            <pre><code class="php">

  {
      "status": true,
      "message": "Thành công",
      "zalopayMsg": {
        "tranList": [
          {
            "trans_id": "220607000817995",
            "sign": 1,//nhận tiền
            "trans_amount": "1000",
            "description": "Lộc dz nha",
            "trans_time": "2022-06-07T07:49:51Z",
            "icon": "https://simg.zalopay.com.vn/zst/zpi-spa/cashier/icon/24555-157.png"
          },
          {
            "trans_id": "220527001581283",
            "sign": -1,//chuyển tiền
            "trans_amount": "1000",
            "description": "Ok",
            "trans_time": "2022-05-27T14:28:02Z",
            "icon": "https://simg.zalopay.com.vn/zst/zpi-spa/cashier/icon/15423-155.png"
          }
        }
}
 

                            </code></pre>
                                        </div>
                                    </div>



                                </div>
                            </div>

                        </div>
                        <!-- END: FAQ Content -->
                        <!-- BEGIN: FAQ Content tab phải-->
                        <div class="intro-y col-span-12 lg:col-span-12 xl:col-span-12">
                            <div class="intro-y box lg:mt-5">
                                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                    <h2 class="font-medium text-base mr-auto">
                                        Response mẫu
                                    </h2>
                                </div>
                                <div id="faq-accordion-1" class="accordion accordion-boxed p-5">

                                    <div class="accordion-item">
                                        <div id="faq-accordion-content-2" class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-accordion-collapse-2" aria-expanded="false" aria-controls="faq-accordion-collapse-2"> Mẫu giao
                                                dịch MBBANK NOTI </button>
                                        </div>
                                        <div id="faq-accordion-collapse-2" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-2" data-bs-parent="#faq-accordion-1">
                                            <pre><code class="php">

  {
    "status": "success",
  "message": "Thành công",
  "TranList": [
    
      "notiId": "fe6f15fb-9eae-42c7-96e1-00eb0f884905",
      "description": "TK 28023456777888|GD: +100,000VND 23/05/22 20:05|SD:104,000VND|ND: PHUNG VAN DUONG chuyen khoan Tu: PHUNG VAN DUONG",
      "createDt": "23/05/2022 20:06:39",
      "notiStatus": "1",
      "activeAgo": "2D",
      "notiType": "MSG_NOTI_BDSD_T24_CHUDONG"
    },
    {
      "notiId": "4453fe0d-59cc-4666-8baf-34aa7873e8ca",
      "description": "TK 28023456777888|GD: -10,000VND 17/05/22 01:36|SD:4,000VND|ND: Naptien 1 Den: NGUYEN THI TY",
      "createDt": "17/05/2022 01:36:52",
      "notiStatus": "1",
      "activeAgo": "8D",
      "notiType": "MSG_NOTI_BDSD_T24_CHUDONG"
    },
    {
      "notiId": "419930db-41be-4d86-a098-f0b4ed8d269c",
      "description": "TK 28023456777888|GD: -20,000VND 10/05/22 14:33|SD:14,000VND|ND: NAP TIEN DI DONG TRA TRUOC 09783645 72 20000",
      "createDt": "10/05/2022 14:34:08",
      "notiStatus": "1",
      "activeAgo": "15D",
      "notiType": "MSG_NOTI_BDSD_T24_CHUDONG"
    }
  ]
}
 

                            </code></pre>
                                        </div>
                                    </div>



                                </div>
                            </div>

                        </div>
                        <!-- END: FAQ Content -->
                    </div>
                </div>
                <!-- END: Content -->
                <!-- BEGIN: FAQ Content tab phải-->
                <div class="intro-y col-span-12 lg:col-span-12 xl:col-span-12">
                    <div class="intro-y box lg:mt-5">
                        <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">
                                Response mẫu
                            </h2>
                        </div>
                        <div id="faq-accordion-1" class="accordion accordion-boxed p-5">

                            <div class="accordion-item">
                                <div id="faq-accordion-content-2" class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-accordion-collapse-2" aria-expanded="false" aria-controls="faq-accordion-collapse-2"> Mẫu giao
                                        dịch MBBANK </button>
                                </div>
                                <div id="faq-accordion-collapse-2" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-2" data-bs-parent="#faq-accordion-1">
                                    <pre><code class="php">

  {
    "status": "success",
  "message": "Thành công",
  "TranList": [
    {
      "tranId": "FT22137670788369",
      "postingDate": "17/05/2022 01:36:00",
      "transactionDate": "17/05/2022 01:36:00",
      "accountNo": "28023456777888",
      "creditAmount": "0",
      "debitAmount": "10000",
      "currency": "VND",
      "description": "MB Naptien 1. DEN: NGUYEN THI TY",
      "availableBalance": "4000",
      "beneficiaryAccount": null
    },
    {
      "tranId": "FT22130045337910\\BNK",
      "postingDate": "10/05/2022 11:35:00",
      "transactionDate": "10/05/2022 11:35:00",
      "accountNo": "28023456777888",
      "creditAmount": "1000",
      "debitAmount": "0",
      "currency": "VND",
      "description": "mua 1 ti cuc cut - Ma giao dich/ Tr ace 986391",
      "availableBalance": "34000",
      "beneficiaryAccount": null
    },
    {
      "tranId": "FT22129515066440\\BNK",
      "postingDate": "09/05/2022 00:01:00",
      "transactionDate": "08/05/2022 08:55:00",
      "accountNo": "28023456777888",
      "creditAmount": "30000",
      "debitAmount": "0",
      "currency": "VND",
      "description": "Naptien chicken - Ma giao dich/ Tra ce 977492",
      "availableBalance": "33000",
      "beneficiaryAccount": null
    }
  ]
}
 

                            </code></pre>
                                </div>
                            </div>



                        </div>
                    </div>

                </div>
                <!-- END: FAQ Content -->
                <!-- BEGIN: FAQ Content tab phải-->
                <div class="intro-y col-span-12 lg:col-span-12 xl:col-span-12">
                    <div class="intro-y box lg:mt-5">
                        <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">
                                Response mẫu
                            </h2>
                        </div>
                        <div id="faq-accordion-1" class="accordion accordion-boxed p-5">

                            <div class="accordion-item">
                                <div id="faq-accordion-content-2" class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-accordion-collapse-2" aria-expanded="false" aria-controls="faq-accordion-collapse-2"> Mẫu giao
                                        dịch VIETCOMBANK </button>
                                </div>
                                <div id="faq-accordion-collapse-2" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-2" data-bs-parent="#faq-accordion-1">
                                    <pre><code class="php">

  {
      "code": "00",
      "des": "success",
      "clientIp": "103.200.22.212",
      "transactions": [
        {
          "TransactionDate": "30/08/2022",
          "Reference": "5017 - 95418",
          "CD": "+",
          "Amount": "1,124",
          "Description": "947033.300822.005239.loc dz nhan lam api",
          "PCTime": "5241"
        },
        {
          "TransactionDate": "30/08/2022",
          "Reference": "5017 - 65463",
          "CD": "+",
          "Amount": "1,245",
          "Description": "925500.290822.235904.Nguyen Nhat Loc chuyen tien",
          "PCTime": "235906"
        },
        {
          "TransactionDate": "29/08/2022",
          "Reference": "5017 - 64057",
          "CD": "+",
          "Amount": "1,000",
          "Description": "513780.290822.190410.naptien1",
          "PCTime": "190411"
        }
      ],
      "nextIndex": "-1"
  
}
 

                            </code></pre>
                                </div>
                            </div>



                        </div>
                    </div>

                </div>
                <!-- END: FAQ Content -->
            </div>
        </div>
        <!-- END: Content -->


    </div>
    </div>
    <?php
    require_once("../../public/Footer.php");
    ?>