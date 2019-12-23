<?php
//github
require_once "Curl.php";
$code = $_GET['code'];//code码
$url = "https://github.com/login/oauth/access_token";
$data = [
    'client_id' => '662686310d8eb2abebbb',
    'client_secret' => 'f09865676f8f1747de1112a7eff4cf4c6ebabbd6',
    'code' => $code
];
$header = array('Accept: application/json');
$res = Curl::http_post($url,$data,$header);

$pa = json_decode($res,true);
if (isset($pa['access_token'])){
    $accessToken = $pa['access_token'];
    $h = array(
        'User-Agent:VerisFung',
        'Authorization: token '.$accessToken
    );
    $content = Curl::http_get("https://api.github.com/user",$h);
    $user_info = json_decode($content,true);
    var_dump($user_info);die;
}
else{
    echo "失败";die;
}