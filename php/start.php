<?php
  session_start();
  $openid=$_SESSION['openId'];
  if (isset($openid)) {
        $mysqli=new mysqli(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB);
    if ($mysqli->connect_errno) {
        die($mysqli->connect_error);
      }
        $mysqli->query("set names utf8");
        $sql="select userName,userPhone from countMoney where openId='$openid'";
        $result=$mysqli->query($sql);
        if ($result->num_rows>0) {
          $rows=$result->fetch_assoc();
          if ($rows['userName']=="" && $rows['userPhone']=="") {
            echo '1';
          }else{
             $arr=array();
             $arr['userName']=$rows['userName'];
             $arr['userPhone']=$rows['userPhone'];
             $json=json_encode($arr);
            echo $json;
          }

      }
  }
?>