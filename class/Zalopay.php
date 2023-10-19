<?php
class Zalopay{

    public $phone       = '';
    public $password        = '';
    public $deviceid  = '';
    public $otp = '';
    public $send_otp_token = '';
    public $token = '';
    public $public_key = '';
    public $salt = '';
   
    public function get_otp_token()
    {
        $headers = array(
            'x-device-id: '.$this->deviceid.'',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.zalopay.vn/v2/account/phone/status?phone_number=".$this->phone."");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
    
        curl_close($ch);
        return $data;
    }
    public function get_public_key()
    {
        $headers = array(
            'x-device-id: '.$this->deviceid.'',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.zalopay.vn/v2/user/public-key");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
    
        curl_close($ch);
        return $data;
    }
    public function get_salt()
    {
        $headers = array(
            'x-device-id: '.$this->deviceid.'',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.zalopay.vn/v2/user/salt");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
    
        curl_close($ch);
        return $data;
    }
    public function get_otp()
    {
        $headers = array(
            'Host: api.zalopay.vn',
            'x-platform: NATIVE',
            'x-device-os: ANDROID',
            'x-device-id: '.$this->deviceid.'',
            'x-device-model: Samsung SM_G532G',
            'x-app-version: 7.7.0',
            'user-agent: '.$_SERVER['HTTP_USER_AGENT'].' ZaloPay Android / 9464',
            'x-density: hdpi',
            'authorization: Bearer'
         );
         $data =array(
            'phone_number' => $this->phone,
            'send_otp_token' => $this->send_otp_token
        );
        return $this->CURL('https://api.zalopay.vn/v2/account/otp', $headers, $data);
    }
    public function xac_thuc_otp()
    {
        $headers = array(
            'Host: api.zalopay.vn',
            'x-platform: NATIVE',
            'x-device-os: ANDROID',
            'x-device-id: '.$this->deviceid.'',
            'x-device-model: Samsung SM_G532G',
            'x-app-version: 7.7.0',
            'user-agent: '.$_SERVER['HTTP_USER_AGENT'].' ZaloPay Android / 9464',
            'x-density: hdpi',
            'authorization: Bearer'
         );
         $data =array(
            'phone_number' => $this->phone,
            'otp' => $this->otp
        );
        return $this->CURL('https://api.zalopay.vn/v2/account/otp-verification', $headers, $data);
    }
    
    //login zalo
    public function ZaloLogin()
    {
        $headers = array(
            'Host: api.zalopay.vn',
            'x-platform: NATIVE',
            'x-device-os: ANDROID',
            'x-device-id: '.$this->deviceid.'',
            'x-device-model: Samsung SM_G532G',
            'x-app-version: 7.7.0',
            'user-agent: '.$_SERVER['HTTP_USER_AGENT'].' ZaloPay Android / 9464',
            'x-density: hdpi',
            'authorization: Bearer'
        );
        $data =array(
            'phone_number' => $this->phone,
            'pin' => $this->RsaEncrypt($this->public_key,json_encode(array(
                'pin' => hash("sha256",$this->password),
                'salt'=> $this->salt
                ))),
            'phone_verified_token' => $this->token
        );
        return $this->CURL('https://api.zalopay.vn/v2/account/phone/session', $headers, $data);
    }
    public function getBalance($sessionid,$access_token,$zaloid,$user_id)
    {
        $headers = array(
            'Host: api.zalopay.vn',
            'x-platform: NATIVE',
            'x-device-os: ANDROID',
            'x-device-id: '.$this->deviceid.'',
            'x-device-model: Samsung SM_G532G',
            'x-access-token: '.$access_token.'',
            'x-zalo-id: '.$zaloid.'',
            'x-zalopay-id: '.$user_id.'',
            'x-user-id: '.$user_id.'',
            'x-app-version: 7.7.0',
            'user-agent: '.$_SERVER['HTTP_USER_AGENT'].' ZaloPay Android / 9464',
            'x-density: hdpi',
            'authorization: Bearer '.$sessionid.''
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.zalopay.vn/v2/user/balance");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
    
        curl_close($ch);
        return $data;
    }
    public function getHistory($user_id,$access_token,$device_id,$hours)
    {
        $sieuthicode =  (time() - (3600 * $hours)) * 1000;
        $headers = array(
            'Host: zalopay.com.vn'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://zalopay.com.vn/v001/tpe/transhistory?userid=$user_id&accesstoken=$access_token&timestamp=$sieuthicode&count=20&order=1&statustype=1&platform=android&deviceid=$device_id&devicemodel=Samsung%20SM-G610F&osver=Android%2027%20%288.1.0%29&appversion=7.7.0&sdkver=2.0.0&distsrc=&mno=VN%20MobiFone&conntype=4G&issecure=true");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
    
        curl_close($ch);
        return $data;
    }
    public function checkHistory($access_token)
    {
        $result = $this->getHistoryV2($access_token);
        $HisList = json_decode($result,true)["data"]['transactions'];
        if(empty($HisList)){
            return array(
                "status" => "error",
                "code"   => -5,
                "message"=> 'Hết thời gian đăng nhập vui lòng đăng nhập lại'
            );
        }
        $tranList = array();
        foreach ($HisList as $transaction){
            $list_result = json_decode($this->GET_TRANS_BY_TID($transaction['trans_id'],$access_token),true)["data"]['transaction'];
                $tranList[] = array(
                    "trans_id"=> $list_result["trans_id"],
                    "sign"    => $list_result["sign"],
                    "trans_amount" => empty($list_result["trans_amount"]) ? 0 : $list_result["trans_amount"],
                    "description" => (!empty($list_result["description"])) ? $list_result["description"] : "",
                    "trans_time"  => empty($list_result["trans_time"]) ? "" : $list_result["trans_time"],
                    "icon" =>empty($list_result["icon"]) ? "" : $list_result["icon"],
                );
        }
       return json_encode(array(
            "status" => true,
              'message' => 'Thành công',
              "zalopayMsg" => array("tranList" => $tranList)
      ), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    public function getHistoryV2($access_token)
    {
        $headers = array(
            'Host: sapi.zalopay.vn',
            'x-device-os: ANDROID',
            'x-platform" ZPA',
            'authorization:Bearer '.$access_token.''
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://sapi.zalopay.vn/v2/history/transactions?page_size=20&page_token=");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
    
        curl_close($ch);
        return $data;
    }
    public function GET_TRANS_BY_TID($ID,$access_token)
    {
         $headers = array(
            'Host: sapi.zalopay.vn',
            'x-device-os: ANDROID',
            'x-platform" ZPA',
            'authorization: Bearer '.$access_token.''
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://sapi.zalopay.vn/v2/history/transactions/$ID?type=1");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
    
        curl_close($ch);
        return $data;
    }
    public function getName($user_id,$access_token,$device_id)
    {
        $headers = array(
            'Host: zalopay.com.vn'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://zalopay.com.vn/um/getuserprofilesimpleinfo?userid=$user_id&accesstoken=$access_token&platform=android&deviceid=$device_id&devicemodel=Vsmart%20Live%204&osver=Android%2030%20%2811%29&appversion=7.10.0&sdkver=2.0.0&distsrc=&mno=Viettel&conntype=WIFI&issecure=true");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
    
        curl_close($ch);
        return $data;
    }
    public function creatTransfer($user_id,$access_token,$device_id)
    {
        $headers = array(
            'Host: mte.zalopay.vn',
         );
         $data =array(
            'accesstoken'=>$access_token,
            'clientid'=>1,
            'platform' => "android",
            'receivername'=>"Hoàng Văn Nhi",
            'sendername'=>"Nguyễn Nhật Lộc",
            'appid' =>450,
            'apptransid'=>1654667508987,
            'appuser'=>"1;180628000003830",
            'amount' =>1000,
            'item'=>array(
                "transtype"=>4,
                "ext"=>"Người nhận:Hoàng Văn Nhi Số điện thoại:0961898253",
                "sender"=>array(
                    "phonenumber"=>"0978364572",
                    "name"=>"Nguyễn Nhật Lộc",
                    "userid"=>"200325000010505"
                )
              ),
            'senderZalopayId'=>"200325000010505",
            'receiverzaloId'=>"180628000003830",
            'deviceid' => $device_id,
            'receiverphone'=> "0961898253",
            'senderuserid'=> $user_id,
            'senderSocialId'=> "7555604904320319889",
            'devicemodel' => "Vsmart%20Live%204",
            'osver' => "Android%2030%20%2811%29",
            'appversion' => "7.10.0",
            'sdkver' => "2.0.0",
            'distsrc' => "",
            'mno' =>"Viettel",
            'conntype' => "WIFI",
            'issecure' => true,
            'productcode'=>"TF002",
        );
        return $this->CURL('https://mte.zalopay.vn/api/transfers/direct', $headers, $data);
    }
    public function get_info($user_id,$access_token,$device_id,$phone)
    {
        $headers = array(
            'Host: zalopay.com.vn'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://zalopay.com.vn/um/getuserinfobyphonev2?userid=$user_id&accesstoken=$access_token&phonenumber=$phone&platform=android&deviceid=$device_id&devicemodel=Vsmart%20Live%204&osver=Android%2030%20%2811%29&appversion=7.10.0&sdkver=2.0.0&distsrc=&mno=Viettel&conntype=WIFI&issecure=true");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
    
        curl_close($ch);
        return $data;
        
    }
    public function CURL($Action, $header, $data)
    {
        $Data = is_array($data) ? json_encode($data) : $data;
        $curl = curl_init();
        // echo strlen($Data); die;
        $header[] = 'Content-Type: application/json';
        $header[] = 'accept: application/json';
        $header[] = 'Content-Length: ' . strlen($Data);
        $opt = array(
            CURLOPT_URL => $Action,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_POST => empty($data) ? FALSE : TRUE,
            CURLOPT_POSTFIELDS => $Data,
            CURLOPT_CUSTOMREQUEST => empty($data) ? 'GET' : 'POST',
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_ENCODING => "",
            CURLOPT_HEADER => FALSE,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_TIMEOUT => 20,
        );
        curl_setopt_array($curl, $opt);
        $body = curl_exec($curl);
        // echo strlen($body); die;
        if (is_object(json_decode($body))) {
            return json_decode($body, true);
        }
        return $body;
    }
    function RsaEncrypt($key,$content)
    {
        if(empty($this->rsa)){
            $this->INCLUDE_RSA($key);
        }
        return base64_encode($this->rsa->encrypt($content));
    }
    public function INCLUDE_RSA($key)
    {
        require_once('lib/RSA/Crypt/RSA.php');
        $this->rsa = new Crypt_RSA();
        $this->rsa->loadKey($key);
        $this->rsa->setHash('sha256');
        $this->rsa->setMGFHash('sha256');
        $this->rsa->setEncryptionMode(1);
        return $this;
    }
    public function Encrypt_data($data, $key)
    {

        $iv = pack('C*', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        $this->keys = $key;
        return base64_encode(openssl_encrypt(is_array($data) ? json_encode($data) : $data, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv));
    }

    public function Decrypt_data($data)
    {

        $iv = pack('C*', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        return openssl_decrypt(base64_decode($data), 'AES-256-CBC', $this->keys, OPENSSL_RAW_DATA, $iv);
    }

    public function generateCheckSum($type, $microtime)
    {
        $Encrypt =   $this->config["phone"] . $microtime . '000000' . $type . ($microtime / 1000000000000.0) . 'E12';
        $iv = pack('C*', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        return base64_encode(openssl_encrypt($Encrypt, 'AES-256-CBC', $this->config["setupKeyDecrypt"], OPENSSL_RAW_DATA, $iv));
    }

    public function get_pHash()
    {
        $data = $this->config["imei"] . "|" . $this->config["password"];
        $iv = pack('C*', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        return base64_encode(openssl_encrypt($data, 'AES-256-CBC', $this->config["setupKeyDecrypt"], OPENSSL_RAW_DATA, $iv));
    }

    public function get_setupKey($setUpKey)
    {
        $iv = pack('C*', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        return openssl_decrypt(base64_decode($setUpKey), 'AES-256-CBC', $this->config["ohash"], OPENSSL_RAW_DATA, $iv);
    }

    public function generateRandom($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function get_SECUREID($length = 17)
    {
        $characters = '0123456789abcdef';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
   
    public function get_device_id($length = 16)
    {
        $characters = '0123456789abcdef';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
  
}
?>