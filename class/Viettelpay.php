<?php
class VIETTELPAY
{
    public $generateImei  = '20220609204159';
    public function LoginVTP($phone)
    {
        $headers = array(
             'Host: api8.viettelpay.vn',
             'product: VIETTELPAY',
             'accept-language: vi',
             'authority-party: APP',
             'channel": APP',
             'type-os: android',
             'app-version: 5.1.1',
             'os-version: 11',
             'imei: VTP_6CE52C1296D839D385E51CD63B9B85EC',
             'x-request-id: ' . $this->get_time_request() . '',
             'user-agent: okhttp/4.2.2',
             'Content-Type: application/json; charset=UTF-8',
             'Content-Length: 42',
             'Accept-Encoding: gzip',
             'User-Agent: okhttp/4.2.2'
         );
        $data = '{
            "username":"'.$phone.'",
            "type":"msisdn"
        }';
        return $this->CURL('https://api8.viettelpay.vn/customer/v1/validate/account', $headers, $data);
    }
    public function CURL($Action, $header, $data)
    {
        $Data = is_array($data) ? json_encode($data) : $data;
        $curl = curl_init();
        $opt = array(
            CURLOPT_URL => $Action,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_POST => empty($data) ? FALSE : TRUE,
            CURLOPT_POSTFIELDS => $Data,
            CURLOPT_CUSTOMREQUEST => empty($data) ? 'GET' : 'POST',
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_ENCODING => "",
            CURLOPT_HEADER => FALSE,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2,
            CURLOPT_TIMEOUT => 20,
        );
        curl_setopt_array($curl, $opt);
        $body = curl_exec($curl);
        if (is_object(json_decode($body))) {
            return json_decode($body, true);
        }
        return $body;
    }
    // function randomnumber
    function randomnumber($length)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // function random refNo
    public function refNo($username)
    {
        return $username . '-' . time();
    }

    // function userId
    public function userId($username)
    {
        return $username;
    }

    // function pass
    public function pass($password)
    {
        return $password;
    }

    // function random token 
    public function get_TOKEN()
    {
        return $this->generateRandomString(39);
    }
    // get imei
    public function generateImei()
    {
        return $this->generateRandomString(8) . '-' . $this->generateRandomString(4) . '-' . $this->generateRandomString(4) . '-' . $this->generateRandomString(4) . '-' . $this->generateRandomString(12);
    }

    public function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdef';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function get_time_request()
    {
        $d=getdate();
        $today = $d['hours'].$d['minutes'].$d['seconds'];
        $day = date('Y').date('m').date('d');
        return $day.$today;
    }
}
$phone="84978364572";
$VTP = new VIETTELPAY;
var_dump($VTP->LoginVTP($phone));

