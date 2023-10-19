<?php
$curl = curl_init();
$dataPost = array(
    "type" => "transfer",
    "token" => "eea91678-2bb4-4e56-8ba0-3e450a4b0eb4",
    "phone"  => "0978364572",
    "amount" => "100",
    "comment" => "Noi dung",
    "password" => "198555"
);
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.sieuthicode.net/api/v2/service/momo/transfer',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $dataPost,
));

$response = curl_exec($curl);

curl_close($curl);
print_r($response);
