<?php
if(isset($_GET['phone']))
{
    $phone = $_GET['phone'];
    $url="https://thuemomo.online/assets/ajaxs/API.php";
    $head=array(
    "Host:thuemomo.online",
    "referer:https://thuemomo.online/",
    "cookie:PHPSESSID=11b5ad9045bb04f72e572b2fc60336a4"
    );
    
    $param = array(
        'type' => 'GetOTP',
        'sdt' => $phone,
        'pass' => '4545'
    );
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; Android 10; SM-J600G) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.106 Mobile Safari/537.36");
    
    curl_setopt($ch, CURLOPT_POST, count($param));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
    
    curl_setopt($ch,CURLOPT_HTTPHEADER, $head);
    
    $mr2 = curl_exec($ch); 
    curl_close($ch);
    
     print_r($mr2);
}
else
{
    echo 'Chưa điền sdt';
}
?>