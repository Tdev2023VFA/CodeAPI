<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
error_reporting(0);
include 'acb.php';
$username = "4650511"; // tên đăng nhập MBBank
$password = "Anhtuan98@"; // pass đăng nhập MBBank
$account = "4650511";
$rows = 20; // số lịch sử muốn lấy

//lấy refreshToken khi login thành công
$token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NjIyMDUzMTIsIm5iZiI6MTY2MjIwNTMxMiwianRpIjoiZjIxMjE3N2ItMTY0Zi00MmE0LTkyMGUtNzAyYzYzYTAyYTgzIiwiZXhwIjoxNjY0MDE5NzEyLCJpZGVudGl0eSI6eyJzY2hlbWFzIjpbInVybjppZXRmOnBhcmFtczpzY2ltOnNjaGVtYXM6Y29yZToyLjA6VXNlciJdLCJpZCI6IjRkMzQ0NWNiLWI0ZjEtNGNjNS04N2UxLTI5ZTNmMDVjNTRmNCIsInVzZXJOYW1lIjoiNDY1MDUxMSIsIm5hbWUiOnsiZ2l2ZW5OYW1lIjoiRE8gVEhBTkgiLCJmYW1pbHlOYW1lIjoiVEFOIn0sImRpc3BsYXlOYW1lIjoiVEFOIERPIFRIQU5IIiwiZW1haWxzIjpudWxsLCJhY3RpdmUiOnRydWUsImdyb3VwcyI6W3sidmFsdWUiOiIxIiwiJHJlZiI6Imh0dHBzOi8vbG9jYWxob3N0L3NjaW0vR3JvdXBzLzEiLCJkaXNwbGF5IjoiYWNibyJ9XSwibWV0YSI6eyJyZXNvdXJjZVR5cGUiOiJVc2VyIiwiY3JlYXRlZCI6IjIwMjItMDktMDNUMDQ6MDI6MTcuMzc2KzAwOjAwIiwibGFzdE1vZGlmaWVkIjoiMjAyMi0wOS0wM1QwNDowMjoxNy4zNzYrMDA6MDAiLCJsb2NhdGlvbiI6Imh0dHBzOi8vbG9jYWxob3N0L3NjaW0vVXNlcnMvNGQzNDQ1Y2ItYjRmMS00Y2M1LTg3ZTEtMjllM2YwNWM1NGY0In0sImxhc3RMb2dpbiI6IjIwMjItMDktMDNUMTE6NDE6NTIuNjQ5MTQ2KzAwOjAwIiwic3RhdHVzIjowLCJhZGRyZXNzZXMiOm51bGwsInBob3RvcyI6bnVsbCwicGhvbmVOdW1iZXJzIjpudWxsLCJleHRlcm5hbElkIjoiMTA3NTIzMDQiLCJjb3Jwb3JhdGUiOm51bGwsInJvbGUiOm51bGwsImxhc3RDcmVkZW50aWNhbCI6IjIwMjItMDktMDNUMDQ6MDY6MjQuMzA4ODQxKzAwOjAwIiwiaWF0IjoiMjAyMi0wOS0wM1QxMTo0MTo1Mi42Nzc3NzQrMDA6MDAiLCJwYXNzd29yZEV4cGlyZUluIjozNjQuNjgzNjk5NTY5OTc2ODUsInBhc3N3b3JkRXhwaXJlQWxlcnQiOmZhbHNlLCJpc3MiOiJpdVN1SFlWdWZJVXVOSVJFVjBGQjlFb0xuOWtIc0RibSIsInBlcnNfcm9sZSI6WyJFS1lDIl19LCJ0eXBlIjoicmVmcmVzaCIsImlzcyI6Iml1U3VIWVZ1ZklVdU5JUkVWMEZCOUVvTG45a0hzRGJtIn0.ReUiH-ob1sMncQiTelt3vDjHUI1bae7oLw4iSViArYE"; // token để thực hiện check thông tin

$acb = new ACB($username,$password);
$acb->clientId = "iuSuHYVufIUuNIREV0FB9EoLn9kHsDbm";
// echo $acb->generateRandomString(32);
// echo time();
// $login = $acb->login();
// if (isset($login["errorCode"])) {
//     exit(json_encode(array(
//         "status" => "error",
//         "code" => 500,
//         "message" => "Tên Đăng Nhập Hoặc Mật Khẩu Sai"
//     )));
// } else {
//     print_r($login);
// }

// $login = $acb->LSGD($account,$rows,$token);
// //$login = $acb->get_balance($token);
// print_r($login);

// $url = 'https://apiapp.acb.com.vn/mb/auth/tokens';



function curl_get($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);

    curl_close($ch);
    return $data;
}
echo curl_get("https://apiapp.acb.com.vn/mb/auth/tokens");
