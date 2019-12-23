<?php
//weibo
require_once "Curl.php";
$code = $_GET['code'];
$ACCESSTOKEN_URL = "https://api.weibo.com/oauth2/access_token";
$data = [
    'client_id' => '2773864469',
    'client_secret' => 'bb18cf3d144fa0d135529f8ed5553338',
    'grant_type' => 'authorization_code',
    'code' => $code,
    'redirect_uri' => 'http://localhost/oauth-github/weibo.php',
];

$info = Curl::http_post($ACCESSTOKEN_URL,$data);

$info = json_decode($info,true);
if ($info['access_token'])
{
    $userJson = Curl::http_get("https://api.weibo.com/2/account/get_uid.json?access_token=".$info['access_token'],array('Accept: application/json'));
    $uidArr = json_decode($userJson,true);
    $uid = $uidArr['uid'];

    $content = Curl::http_get("https://api.weibo.com/2/users/show.json?access_token=".$info['access_token']."&uid=".$uid,array('Accept: application/json'));
    $user_info = json_decode($content,true);

    var_dump($user_info);die;
}else{
    var_dump('失败');
}