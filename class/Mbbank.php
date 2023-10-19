<?php
class MBBANK
{
    public $userId       = '';
    public $pass        = '';
    public $generateImei  = '';
    public $refNo  = '';

    public function LoginMbBank($phone, $password)
    {
        $header = array(
            'User-Agent: Mozilla/5.0 (Linux; Android 7.1.2; A5010 Build/N2G48H; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/83.0.4103.120 Mobile Safari/537.36',
            'Cache-Control: no-cache',
            'Authorization: Basic QURNSU46QURNSU5=',
            'Content-Type: application/json; charset=utf-8',
            'Host: mobile.mbbank.com.vn'
        );
        $Action = 'https://mobile.mbbank.com.vn/retail_lite/common/doLogin';
        $Data = '{
                  "refNo":"' . $this->refNo . '",
                  "userId":"' . $this->userId. '",
                  "password":"' . $this->pass. '",
                  "softTokenId":"' . $this->get_TOKEN() . '",
                  "deviceId":"' . $this->generateImei. '",
                  "deviceIdCommon":"' . $this->generateImei. '",
                  "appVersion":"android_13.1_v482"
                  }';
        return $this->CURL($Action, $header, $Data);
    }
    public function balanceMBBank($phone, $sessionId, $deviceId)
    {
        $header = array(
            'User-Agent: Mozilla/5.0 (Linux; Android 7.1.2; A5010 Build/N2G48H; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/83.0.4103.120 Mobile Safari/537.36',
            'Cache-Control: no-cache',
            'Authorization: Basic QURNSU46QURNSU5=',
            'Content-Type: application/json; charset=utf-8',
            'Host: mobile.mbbank.com.vn'
        );
        $Action = 'https://mobile.mbbank.com.vn/retail_lite/account/v2.0/getBalance';
        $Data = '{
		          "sessionId":"' . $sessionId . '",
                  "refNo":"' . $this->refNo(''.$phone.'') . '",
                  "type":"",              
                  "deviceIdCommon":"' . $deviceId . '",
                  "appVersion":"android_13.1_v482"
                  }';
        $result = $this->CURL($Action, $header, $Data);
        return $result;
    }
    public function getHistory($phone, $sessionId, $deviceId)
    {
        $header = array(
            'User-Agent: Mozilla/5.0 (Linux; Android 7.1.2; A5010 Build/N2G48H; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/83.0.4103.120 Mobile Safari/537.36',
            'Cache-Control: no-cache',
            'Authorization: Basic QURNSU46QURNSU5=',
            'Content-Type: application/json; charset=utf-8',
            'Host: mobile.mbbank.com.vn'
        );
        $Action = 'https://mobile.mbbank.com.vn/retail_lite/notification/getNotificationDataList';
        $Data = '{
		          "sessionId":"' . $sessionId . '",
                  "refNo":"' . $this->refNo(''.$phone.'') . '",
                  "fromRows": 0,
                  "toRows": 20,
                  "deviceIdCommon":"' . $deviceId . '",
                  "appVersion":"android_13.1_v482"
                  }';
        $result = $this->CURL($Action, $header, $Data);
        return $result;
    }
    public function getHistoryV2($phone, $sessionId, $deviceId, $stk,$day)
    {
        $header = array(
            'User-Agent: Mozilla/5.0 (Linux; Android 7.1.2; A5010 Build/N2G48H; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/83.0.4103.120 Mobile Safari/537.36',
            'Cache-Control: no-cache',
            'Authorization: Basic QURNSU46QURNSU5=',
            'Content-Type: application/json; charset=utf-8',
            'Host: mobile.mbbank.com.vn'
        );
        $Action = 'https://mobile.mbbank.com.vn/retail_lite/common/getTransactionHistory';
        $Data = '{
		          "sessionId":"' . $sessionId . '",
                  "refNo":"' . $this->refNo(''.$phone.'') . '",
                  "fromDate": "'.date("d/m/Y",strtotime("$day days ago")).'",
                  "toDate":"'.date("d/m/Y").'",
                  "accountNo":"'.$stk.'",
                  "type":"ACCOUNT",
                  "historyType":"DATE_RANGE",
                  "historyNumber":5,
                  "deviceIdCommon":"' . $deviceId . '",
                  "appVersion":"android_13.1_v482"
                  }';
        $result = $this->CURL($Action, $header, $Data);
        return $result;
    }
    public function getListBank($phone, $sessionId, $deviceId)
    {
        $header = array(
            'User-Agent: Mozilla/5.0 (Linux; Android 7.1.2; A5010 Build/N2G48H; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/83.0.4103.120 Mobile Safari/537.36',
            'Cache-Control: no-cache',
            'Authorization: Basic QURNSU46QURNSU5=',
            'Content-Type: application/json; charset=utf-8',
            'Host: mobile.mbbank.com.vn'
        );
        $Action = 'https://mobile.mbbank.com.vn/retail_lite/common/getBankList';
        $Data = '{
		          "sessionId":"' . $sessionId . '",
                  "refNo":"' . $this->refNo(''.$phone.'') . '",
                  "deviceIdCommon":"' . $deviceId . '",
                  "appVersion":"android_13.1_v482"
                  }';
        $result = $this->CURL($Action, $header, $Data);
        return $result;
    }
    public function inquiryAccountName($phone, $sessionId, $deviceId,$stk,$bankcode,$stknhan)
    {
        $header = array(
            'User-Agent: Mozilla/5.0 (Linux; Android 7.1.2; A5010 Build/N2G48H; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/83.0.4103.120 Mobile Safari/537.36',
            'Cache-Control: no-cache',
            'Authorization: Basic QURNSU46QURNSU5=',
            'Content-Type: application/json; charset=utf-8',
            'Host: mobile.mbbank.com.vn'
        );
        $Action = 'https://mobile.mbbank.com.vn/retail_lite/transfer/inquiryAccountName';
        $Data = '{
		          "sessionId":"' . $sessionId . '",
                  "refNo":"' . $this->refNo(''.$phone.'') . '",
                  "creditAccount":"'.$stknhan.'",
                  "type":"FAST",
                  "debitAccount":"'.$stk.'",
                  "deviceIdCommon":"' . $deviceId . '",
                  "bankCode":"' . $bankcode . '",
                  "remark":"",
                  "creditAccountType":"ACCOUNT",
                  "creditCardNo":"",
                  "appVersion":"android_13.1_v482"
                  }';
        $result = $this->CURL($Action, $header, $Data);
        return $result;
    }
    public function getDomesticInfo($phone, $sessionId, $deviceId,$stk,$bankcode,$stknhan)
    {
        $header = array(
            'User-Agent: Mozilla/5.0 (Linux; Android 7.1.2; A5010 Build/N2G48H; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/83.0.4103.120 Mobile Safari/537.36',
            'Cache-Control: no-cache',
            'Authorization: Basic QURNSU46QURNSU5=',
            'Content-Type: application/json; charset=utf-8',
            'Host: mobile.mbbank.com.vn'
        );
        $Action = 'https://mobile.mbbank.com.vn/retail_lite/transfer/getDomesticInfo';
        $Data = '{
		          "sessionId":"' . $sessionId . '",
                  "refNo":"' . $this->refNo(''.$phone.'') . '",
                  "creditAccount":"'.$stknhan.'",
                  "type":"FAST",
                  "debitAccount":"'.$stk.'",
                  "deviceIdCommon":"' . $deviceId . '",
                  "bankCode":"' . $bankcode . '",
                  "remark":"",
                  "creditAccountType":"ACCOUNT",
                  "creditCardNo":"",
                  "appVersion":"android_13.1_v482"
                  }';
        $result = $this->CURL($Action, $header, $Data);
        return $result;
    }
    public function verifyMakeTransfer($phone, $sessionId, $deviceId,$stk,$bankcode,$stknhan)
    {
        $header = array(
            'User-Agent: Mozilla/5.0 (Linux; Android 7.1.2; A5010 Build/N2G48H; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/83.0.4103.120 Mobile Safari/537.36',
            'Cache-Control: no-cache',
            'Authorization: Basic QURNSU46QURNSU5=',
            'Content-Type: application/json; charset=utf-8',
            'Host: mobile.mbbank.com.vn'
        );
        $Action = 'https://mobile.mbbank.com.vn/retail_lite/transfer/verifyMakeTransfer';
        $Data = '{
                  "sessionId":"' . $sessionId . '",
                  "refNo":"' . $this->refNo(''.$phone.'') . '",
                  "creditAccount":"'.$stknhan.'",
                  "type":"FAST",
                  "debitAccount":"'.$stk.'",
                  "deviceIdCommon":"' . $deviceId . '",
                  "bankCode":"' . $bankcode . '",
                  "remark":"",
                  "creditAccountType":"ACCOUNT",
                  "creditCardNo":"",
                  "appVersion":"android_13.1_v482"
                  }';
        $result = $this->CURL($Action, $header, $Data);
        return $result;
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
}
