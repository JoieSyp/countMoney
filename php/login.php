<?php
// 封装的函数
 include_once('constant.php');
 include_once('access_url.php');  
// 获取score
 $code=$_GET["code"];
 // 得到token值
function get_access_token($code){
  $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".appID."&secret=".appsecret."&code={$code}&grant_type=authorization_code";
  $reponse=httpGet($url);
  return $reponse;
}
$response=get_access_token($code);
$obj=json_decode($response);
$access_token=$obj->access_token;
$openid=$obj->openid;
//-- 获取用户信息的的方法
function getUserList($access_token,$openid){
  $url="https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang=zh_CN";
  $reponse=httpGet($url);
  return $reponse;
}
$arr=getUserList($access_token,$openid);
// 得到人物信息
 getInfo($arr);
function getInfo($arr){
   $obj=json_decode($arr);
    $openid=$obj->openid;
    $nickname=$obj->nickname;
    $imgurl=$obj->headimgurl;
    // 数据库连接
    $mysqli=new mysqli(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB);
    if ($mysqli->connect_errno) {
      die($mysqli->connect_error);
    }
    $mysqli->query("set names utf8");
    $sql="select * from countMoney where openId='$openid'";
     $result=$mysqli->query($sql);
     if($result->num_rows==0 && isset($openid)){
     	 $sql2="insert into countMoney(openId,nikename,headImgurl) values('$openid','$nickname','$imgurl')";
        $mysqli->query($sql2);
     }else{
        echo "1";
     }
    $_SESSION['openId']=$openid;  
    $mysqli->close();
 }

?>