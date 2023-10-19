<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");

    if($_POST['type'] == 'Napthe')
    {
                $return = '';
                $pin=$_POST['pin'];
                $seri=$_POST['seri'];
                $loaithe= $_POST['loaithe'];
                $menhgia= $_POST['menhgia'];
                if($loaithe==""||$menhgia==""||$seri==""||$pin=="")
                {
                nnl_error('Vui lòng điền đủ thông tin');
                }
                else
                {
                                // RANDOM YÊU CẦU ID (KHÔNG THAY ĐỔI)
                        $request_id = rand(100000000,999999999);

                        // ĐẶT GIÁ TRỊ MẢNG THÀNH NULL TRÁNH LỖI
                        $POSTGET = array();

                        // YÊU CẦU ID
                        $POSTGET['request_id'] = $request_id;

                        // MÃ THẺ NẠP TỪ POST USER
                        $POSTGET['code'] = $pin;

                        // PARTENER ID (CONFIG TRONG PHẦN CONFIG.PHP)
                        $POSTGET['partner_id'] = $partner_id;

                        // SERI THẺ CÀO TỪ POST USER
                        $POSTGET['serial'] = $seri;

                        // NHÀ MẠNG TỪ POST USER
                        $POSTGET['telco'] = $loaithe;

                        // LỆNH (MẶC ĐỊNH: NẠP THẺ)
                        $POSTGET['command'] = $command;

                        // SẮP XẾP MẢNG
                        ksort($POSTGET);

                        //CHỮ KÝ KHI ĐỔI THẺ
                        $sign = $partner_key;

                        //Đặt chữ ký MD5 vào item
                        foreach ($POSTGET as $item) {
                        $sign .= $item;
                        }

                        //CHUYỂN CHỮ KÝ SANG ĐỊNH DẠNG MD5 (BẮT BUỘC)
                        $mysign = md5($sign);

                        // MỆNH GIÁ THẺ TỪ POST USER
                        $POSTGET['amount'] = $menhgia;

                        // CHỮ KÝ MD5
                        $POSTGET['sign'] = $mysign;

                        // XUẤT RA URL ĐỂ GỬI LÊN TSR
                        $data = http_build_query($POSTGET);
                        // CHẠY CURL
                        $ch = curl_init();
                        // QUÁ TRÌNH GỬI LÊN TSR (ĐỪNG THAY ĐỔI)
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        $SERVER_NAME = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        curl_setopt($ch, CURLOPT_REFERER, $SERVER_NAME);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $result = curl_exec($ch);
                        // ĐÓNG GỬI LÊN TSR
                        curl_close($ch);

                        // XUẤT RA JSON (STD CLASS)
                        $return = json_decode($result);

                        if (isset($return->status)) {

                            if ($return->status == 99) 
                            {                                    
                                $NNL->insert("cards", array(
                                    'code' => $request_id,
                                    'seri' => $seri,
                                    'pin'  => $pin,
                                    'loaithe' => $loaithe,
                                    'menhgia' => $menhgia,
                                    'thucnhan' => '0',
                                    'username' => $getUser['username'],
                                    'status' => 'xuly',
                                    'note' => '',
                                    'createdate' => gettime()
                                ));
                                nnl_success_time("Gửi thẻ thành công, vui lòng đợi kết quả trong vài giây", "", 2000);
                            } 
                            elseif ($return->status == 4)
                            {
                                nnl_error('Nhà mạng đang bảo trì');
                            }
                            else {
                                nnl_error('Gửi thất bại');
                            }
                        } 
                        else {
                            nnl_error('Gửi thất bại');
                        }
                }

    }