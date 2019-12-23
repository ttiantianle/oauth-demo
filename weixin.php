<?php
//微信
require_once "Curl.php";
$code = $_GET['code'];
$res = Curl::http_get('https://api.weixin.qq.com/sns/oauth2/access_token?appid=APPID&secret=SECRET&code=CODE&grant_type=authorization_code
');
$info = json_decode($res,true);
if (isset($info['access_token']))
{
    $access_token = $info['access_token'];
    $openid = $info['openid'];
    $USERINFO_URL = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid;
    $userJson = Curl::http_get($USERINFO_URL);
    var_dump(json_decode($userJson,true));
}else{
    var_dump('失败');
}