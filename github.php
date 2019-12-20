<?php
//github
require_once "Curl.php";
$code = $_GET['code'];//code码
$url = "https://github.com/login/oauth/access_token";
$data = [
    'client_id' => '',
    'client_secret' => '',
    'code' => $code
];
$res = Curl::http_post($url,$data);
$arr = explode('&',$res);
$pa = [];
foreach ($arr as $v){
    $tempArr = explode('=',$v);
    $pa[$tempArr[0]] = $tempArr[1];
}

$accessToken = $pa['access_token'];

$oCurl = curl_init();
$url = 'https://api.github.com/user';
curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($oCurl, CURLOPT_URL, $url);
curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($oCurl,CURLOPT_HTTPHEADER,array(
    'User-Agent:VerisFung',
    'Authorization: token '.$accessToken
));
$sContent = curl_exec($oCurl);
$aStatus = curl_getinfo($oCurl);
curl_close($oCurl);
echo $sContent;die;