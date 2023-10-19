<?php
require_once "../../config/config.php";
require_once "../../config/function.php";
require_once "../../libs/simple_html_dom.php";
// //     $access = true;
$ips = intval(rand()%255).'.'.intval(rand()%255).'.'.intval(rand()%255).'.'.intval(rand()%255); 
class Thesieure
{
    private $Config;
    public function __construct()
    {
        $this->Config = new Config;
    }
    // Các hàm xử lý
    // Kiểm tra đăng nhập bằng cookie
    
    public function GetCookieLogin_TSR()
    {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_PROXY=>$ips,
            CURLOPT_URL => "https://thesieure.com/account/login",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_COOKIEFILE => __DIR__ . "/session.txt",
            CURLOPT_COOKIEJAR => __DIR__ . "/session.txt",
        ));
        $exec = curl_exec($ch);
        curl_close($ch);
        if (strpos($exec, "<h4>Đăng nhập tài khoản</h4>") !== false) {
            // FIND TOKEN CSRF TSR
            $TOKEN_CSRF = str_get_html($exec)->find("input[name=_token]", 0)->value;
            // Get Cookie
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_PROXY=>$ips,
                CURLOPT_URL => "https://thesieure.com/account/login",
                CURLOPT_COOKIEJAR => __DIR__ . "/session.txt",
                CURLOPT_COOKIEFILE => __DIR__ . "/session.txt",
                CURLOPT_CONNECTTIMEOUT => 30,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_FOLLOWLOCATION => 1,
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => "phoneOrEmail=" . $this->Config::TSR_USERNAME . "&password=" . $this->Config::TSR_PASSWORD . "&_token=" . $TOKEN_CSRF . "&g-recaptcha-response=" . $this->Config::G_CAPTCHA_CODE . "&remember=checked",
                CURLINFO_HEADER_OUT => true,
            ));
            $exec = curl_exec($curl);
            curl_close($curl);
            // Kiểm tra xem đăng nhập thành công chưa
            if (strpos($exec, "<h4>Đăng nhập tài khoản</h4>") !== false) {
                // Xóa cookie khi chưa đăng nhập thành công
                unlink(__DIR__ . "/session.txt");
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    // Check LSGD
    public function Get_LSGD($type)
    {

        if ($type == 'check') {
            // Check Thesieure login vaild status
            if ($this->GetCookieLogin_TSR()) {
                $ch = curl_init();
                curl_setopt_array($ch, array(
                    CURLOPT_PROXY=>$ips,
                    CURLOPT_URL => "https://thesieure.com/wallet/transfer",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_COOKIEFILE => __DIR__ . "/session.txt",
                    CURLOPT_COOKIEJAR => __DIR__ . "/session.txt",
                ));
                $exec = curl_exec($ch);
                curl_close($ch);
                return true;
            } else {
                return false;
            }
        } else {
            // Get Cookie and login
            if ($this->GetCookieLogin_TSR()) {
                // Export data
                $ch = curl_init();
                curl_setopt_array($ch, array(
                    CURLOPT_PROXY=>$ips,
                    CURLOPT_URL => "https://thesieure.com/wallet/transfer",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_COOKIEFILE => __DIR__ . "/session.txt",
                    CURLOPT_COOKIEJAR => __DIR__ . "/session.txt",
                ));
                $exec = curl_exec($ch);
                curl_close($ch);
                if ($this->Config::AUTO_DELETE_COOKIE) {
                    unlink(__DIR__ . "/session.txt");
                }
                if ($this->Config::LOGGING) {
                    // Ghi nhật ký lỗi
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    file_put_contents("thesieure_log.log", 'Thời gian: ' . date('h:i:s d/m/y') . ' | Đăng nhập thành công vào tài khoản tsr: ' . $this->Config::TSR_USERNAME . PHP_EOL, FILE_APPEND);
                }
                return $exec;
            } else {
                return false;
            }
        }
    }

    public function CheckCode_GD($code)
    {
        // Get Cookie and login
        if ($this->GetCookieLogin_TSR()) {
            $Get_Table = str_get_html($this->Get_LSGD('get'))->find('tbody', 2);
            // Xuất dữ liệu
            if ($Get_Table) 
            {
                foreach ($Get_Table->find('tr') as $Data) 
                {
                    $Json_Datas[] = array(
                        'trading_code' => $Data->find('td', 0)->plaintext,
                        'money_cost' => $Data->find('td', 1)->plaintext,
                        'username_send_or_receive' => $Data->find('td', 2)->plaintext,
                        'status' => $Data->find('td', 4)->plaintext,
                        'content_send' => $Data->find('td', 5)->plaintext,
                        'time_created' => $Data->find('td', 3)->plaintext,
                    );
                }
                if (isset($Json_Datas))
                {
                    $Json_Datas = json_decode(json_encode($Json_Datas));
                    foreach ($Json_Datas as $Json_Datas_For)
                    {
                        if (isset($Json_Datas_For->trading_code) && $Json_Datas_For->trading_code == $code) 
                        {
                            return json_encode(array(
                                'status' => true,
                                'msg' => 'Mã giao dịch hợp lệ !',
                                'username_send_or_receive' => $Json_Datas_For->username_send_or_receive,
                                'money' => $Json_Datas_For->money_cost,
                                'time_created' => $Json_Datas_For->time_created,
                                'content_send' => $Json_Datas_For->content_send), JSON_UNESCAPED_UNICODE);
                            break;
                        }
                    }
                } 
                else 
                {
                    return false;
                }
            }
        }
        else 
        {
            return false;
        }
    }
}
$TSR = new Thesieure;
$magd = check_string($_POST['magd']);
if (empty($magd)) {
    nnl_error("Vui lòng nhập mã giao dịch !");
}

// Kiểm tra mã giao dịch
$Check = $TSR->CheckCode_GD($magd);
// Nếu không hợp lệ hoặc lỗi
if (!$Check) {
    nnl_error("Hệ thống không tồn tại mã giao dịch này của bạn!");
} else {
    $Check = json_decode($Check);
    if (!isset($Check->money)) {
        nnl_error("Hệ thống không tồn tại mã giao dịch này của bạn!");
    } else {
        if (!preg_match('/-/i', $Check->money)) {
            $money = intval(preg_replace("/đ|,|\-|\+/i", '', $Check->money));
            $content = $Check->content_send;
            if ($content != 'xxx') {
                nnl_error("Mã giao dịch hoặc nội dung không tồn tại");
            }

            if ($NNL->get_row(" SELECT * FROM `tsr` WHERE `magd` = '$magd'")) {
                nnl_error("Mã giao dịch này đã được nạp rồi!");
            } else {
                $row_user = $NNL->get_row(" SELECT * FROM `users` WHERE `username` = '" . $getUser['username'] . "' ");
                $NNL->cong("users", "money", $money, " `username` = '" . $row_user['username'] . "' ");
                $NNL->cong("users", "total_money", $money, " `username` = '" . $row_user['username'] . "' ");
                /* GHI LOG DÒNG TIỀN */
                $NNL->insert("dongtien", array(
                    'sotientruoc' => $row_user['money'],
                    'sotienthaydoi' => $row_user['money'],
                    'sotiensau' => $row_user['money'] + $money,
                    'thoigian' => gettime(),
                    'noidung' => 'Nạp tiền tự động qua ví thẻ siêu rẻ',
                    'username' => $row_user['username'],
                ));
                $NNL->insert("tsr", array(
                    'user' => $getUser['username'],
                    'magd' => $magd,
                    'price' => $money,
                    'content' => $content,
                    'status' => 2,
                ));
                nnl_success_time("Đã nạp tiền thành công!", BASE_URL('nap-momo'), 1000);
            }
        }
    }
}
