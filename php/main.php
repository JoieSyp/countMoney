<?php
// 封装的函数
 session_start(); 
 $userName=$_POST['userename'];
 $userPhone=$_POST['userphone'];
// 获取score
 $openid=$_SESSION['openId'];

 if(isset($userName) && isset($userPhone)){

    $mysqli=new mysqli(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB);
    if ($mysqli->connect_errno) {
      die($mysqli->connect_error);
    }
    $mysqli->query("set names utf8");
   
    $sqlquery="select userName, userPhone from countMoney where openId='$openid'";
    $resultquery=$mysqli->query($sqlquery);
    $rows=$resultquery->fetch_assoc();
    // 数据存在为1  数据更新成功为2     数据为空输出 3
    if($rows['userName']==$userName && $rows['userPhone']==$userPhone){
       echo '{"msg":"1"}';
    }else{
         $sql="update countMoney set userName='$userName',userPhone='$userPhone' where openId='$openid'";
         $result=$mysqli->query($sql); 
         if ($result) {
               echo '{"msg":"2"}';
         }

    }
    $mysqli->close();
     
 }else{
    echo '{"msg":"3"}';
 }
?>
<?php
// // 封装的函数
//  session_start(); 
//  $userName=$_POST['username'];
//  $userPhone=$_POST['userphone'];
// // 获取score
//  $openid=$_SESSION['openId'];
// if(isset($userName) && isset($userPhone)){
//     $mysqli=new mysqli(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB);
//     if ($mysqli->connect_errno) {
//       die($mysqli->connect_error);
//     }
//     $mysqli->query("set names utf8");
   
//     $sqlquery="select userName, userPhone from countMoney where openId='$openid'";
//     $resultquery=$mysqli->query($sqlquery);
//     $rows=$resultquery->fetch_assoc();
//     // 数据存在为1  数据更新成功为2     数据为空输出 3
   
//     if($rows['userName']==$userName && $rows['userPhone']==$userPhone){
//        echo '{"msg":"1"}';
//     }else{
//          $sql="update countMoney set userName='$userName',userPhone='$userPhone' where openId='$openid'";
//          $result=$mysqli->query($sql); 
//          if ($result) {
//                echo '{"msg":"2"}';
//          }

//     }
//     $mysqli->close();
// }else{

//     echo '{"msg":"3"}';
// }
?>