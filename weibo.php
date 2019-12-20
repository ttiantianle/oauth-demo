<?php
//weibo
require_once "Curl.php";
$code = $_GET['code'];

$ACCESSTOKEN_URL = "https://api.weibo.com/oauth2/access_token";
$data = [
    'client_id' => '',
    'client_secret' => '',
    'grant_type' => 'authorization_code',
    'code' => $code,
    'redirect_uri' => 'http://localhost/oauth-github/weibo.php',
];

$info = Curl::http_post($ACCESSTOKEN_URL,$data);

$info = json_decode($info,true);

if ($info['access_token'])
{
    $access_token = $info['access_token'];
    $openid = $info['openid'];
    $USERINFO_URL = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid;
    $userJson = Curl::http_get($USERINFO_URL);
    var_dump(json_decode($userJson,true));

}else{
    var_dump('失败');
}