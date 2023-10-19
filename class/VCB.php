<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
class VCB
{
    public function valid_captcha($captcha_id, $captcha_text)
    {
        $url = "https://vcbdigibank.vietcombank.com.vn/w1/valid-captcha";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            'Connection: keep-alive',
            'Accept: application/json, text/plain, */*',
            'Accept-Language: vi',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.26 Safari/537.36 Edg/85.0.564.13',
            'Content-Type: application/json',
            'Origin: https://vcbdigibank.vietcombank.com.vn',
            'Sec-Fetch-Site: same-origin',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Dest: empty',
            'Referer: https://vcbdigibank.vietcombank.com.vn/',
            'Cookie: _ga=GA1.3.1535919639.1595752306; _gid=GA1.3.1407703616.1595752306',
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = '{"captcha_id":"' . $captcha_id . '","captcha_text":"' . $captcha_text . '"}';

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        return $resp;
    }
    public function get_captcha($captcha_id)
    {
        $headers = array(
            'Connection: keep-alive',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.26 Safari/537.36 Edg/85.0.564.13',
            'Accept: image/webp,image/png,image/svg+xml,image/*;q=0.8,video/*;q=0.8,*/*;q=0.5',
            'Sec-Fetch-Site: same-origin',
            'Sec-Fetch-Mode: no-cors',
            'Sec-Fetch-Dest: image',
            'Referer: https://vcbdigibank.vietcombank.com.vn/',
            'Accept-Language: en-US,en;q=0.9',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://digiapp.vietcombank.com.vn/utility-service/v1/captcha/$captcha_id");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);

        curl_close($ch);
        return $data;
    }
    public function random($string, $int)
    {
        return substr(str_shuffle($string), 0, $int);
    }
    public function save_captcha($value)
    {
        $rand = $this->random("QWERTYUIOPASDFGHJKLZXCVBNM0123456789", 6);
        $saveFile = fopen('captcha/' . $rand . '.jpeg', 'w+');
        fwrite($saveFile, $value);
        fclose($saveFile);
    }
  
    public function login($username, $password, $captcha_token, $captcha_value)
    {
        $url = "https://digiapp.vietcombank.com.vn/authen-service/v1/login";
        $headers = array(
			'Host: digiapp.vietcombank.com.vn',
			'Accept: application/json',
			'Accept-Encoding: gzip, deflate, br',
			'Accept-Language: vi',
			'Content-Type: application/json;charset=utf-8',
            'Referer: https://vcbdigibank.vietcombank.com.vn/',
			'Origin: https://vcbdigibank.vietcombank.com.vn',
			'X-Channel: Web',
			'X-Request-ID: 166170894708822',
			'Connection: keep-alive',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.26 Safari/537.36 Edg/85.0.564.13',
			'sec-ch-ua: "Chromium";v="104", " Not A;Brand";v="99", "Google Chrome";v="104"',
			'sec-ch-ua-mobile: ?0',
			'sec-ch-ua-platform: "Windows"',
			'Authorization: Bearer null'
        );
        $data = '{
			"DT": "Windows",
			"OV": "10",
			"PM": "Chrome 104.0.0.0",
			"captchaToken": "'.$captcha_token.'",
			"captchaValue": "'.$captcha_value.'",
			"checkAcctPkg": "1",
			"lang": "vi",
			"mid": 6,
			"password": "'.$password.'",
			"user": "'.$username.'"
		}';
        $result = $this->CURL($url, $headers, $data);
        return $result;
    }
    public function get_lsgd($username, $account, $session_id, $cif, $client_id, $mobile_id)
    {
        $url = "https://digiapp.vietcombank.com.vn/bank-service/v1/transaction-history";
        $headers = array(
            'Host: digiapp.vietcombank.com.vn',
            'Accept: application/json',
            'Accept-Encoding: gzip, deflate, br',
            'Accept-Language: vi',
            'Content-Type: application/json;charset=utf-8',
            'Referer: https://vcbdigibank.vietcombank.com.vn/',
            'Origin: https://vcbdigibank.vietcombank.com.vn',
            'X-Channel: Web',
            'X-Request-ID: 166170894708822',
            'Connection: keep-alive',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.26 Safari/537.36 Edg/85.0.564.13',
            'sec-ch-ua: "Chromium";v="104", " Not A;Brand";v="99", "Google Chrome";v="104"',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "Windows"',
            'Authorization: Bearer null'
        );
        $data = '{
            "DT":"Windows",
            "PM":"Chrome 104.0.0.0",
            "OV":"10",
            "lang":"vi",
            "accountNo":"'.$account.'",
            "accountType":"D",
            "fromDate":"'.date("d/m/Y",time() - 3600*168).'",
            "toDate":"'.date("d/m/Y",time()).'",
            "pageIndex":0,
            "lengthInPage":999999,
            "stmtDate":"",
            "stmtType":"",
            "mid":14,
            "cif":"'.$cif.'",
            "user":"'.$username.'",
            "mobileId":"'.$mobile_id.'",
            "clientId":"'.$client_id.'",
            "sessionId":"'.$session_id.'"
        }';
        $result = $this->CURL($url, $headers, $data);
        return $result;
    }
    public function get_balance($username, $account, $session_id, $cif, $client_id, $mobile_id)
    {
        $url = "https://digiapp.vietcombank.com.vn/bank-service/v1/get-account-detail";
        $headers = array(
            'Host: digiapp.vietcombank.com.vn',
            'Accept: application/json',
            'Accept-Encoding: gzip, deflate, br',
            'Accept-Language: vi',
            'Content-Type: application/json;charset=utf-8',
            'Referer: https://vcbdigibank.vietcombank.com.vn/',
            'Origin: https://vcbdigibank.vietcombank.com.vn',
            'X-Channel: Web',
            'X-Request-ID: 166170894708822',
            'Connection: keep-alive',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.26 Safari/537.36 Edg/85.0.564.13',
            'sec-ch-ua: "Chromium";v="104", " Not A;Brand";v="99", "Google Chrome";v="104"',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "Windows"',
            'Authorization: Bearer null'
        );
        $data = '{
            "DT":"Windows",
            "PM":"Chrome 104.0.0.0",
            "OV":"10",
            "lang":"vi",
            "accountNo":"'.$account.'",
            "accountType":"D",
            "mid":13,
            "cif":"'.$cif.'",
            "user":"'.$username.'",
            "mobileId":"'.$mobile_id.'",
            "clientId":"'.$client_id.'",
            "sessionId":"'.$session_id.'"
        }';
        $result = $this->CURL($url, $headers, $data);
        return $result;
    }
    public function CURL($Action, $header, $data)
    {
        $curl = curl_init();
        $opt = array(
            CURLOPT_URL => $Action,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_POST => empty($data) ? FALSE : TRUE,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_CUSTOMREQUEST => empty($data) ? 'GET' : 'POST',
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_ENCODING => "",
            CURLOPT_HEADER => FALSE,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2,
            CURLOPT_TIMEOUT => 20,
        );
        curl_setopt_array($curl, $opt);
        $body = curl_exec($curl);
     
        return $body;
    }
	public function get_time_request()
    {
        $d=getdate();
        $today = $d['hours'].$d['minutes'].$d['seconds'];
        $day = date('Y').date('m').date('d');
        return $day.$today;
    }
	public function Decrypt_data($data,$keys)
    {

        $iv = pack('C*', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        return openssl_decrypt(base64_decode($data), 'AES-256-CBC', $keys, OPENSSL_RAW_DATA, $iv);
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
	public function get_microtime()
    {
        return round(microtime(true) * 1000);
    }
}