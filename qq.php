<?php
require_once "Curl.php";

$code = $_GET['code'];
$data = [
    "grant_type" => "authorization_code",
    "client_id" => "",
    "client_secret" => "",
    'code' => $code,
    "redirect_uri" => "http://localhost/oauth-github/qq.php"

];
$pa = http_build_query($data);
$res = Curl::http_get("https://graph.qq.com/oauth2.0/token?".$pa);
$info = json_decode($res);
if (isset($info['access_token']))
{
    $access_token = $info['access_token'];
    $open = Curl::http_get("https://graph.qq.com/oauth2.0/me?access_token=".$access_token);
    $openObj = json_decode($open,true);
    $openid = $openObj['openid'];

    $res = Curl::http_get("https://graph.qq.com/user/get_user_info?access_token=".$access_token."&oauth_consumer_key=APPID&openid=".$openid);
    var_dump(json_decode($res,true));

}else{
    var_dump("失败");
}