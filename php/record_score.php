<?php
  session_start();
  $newScore=$_POST['score'];
  $openid=$_SESSION['openId'];
  $mysqli=new mysqli(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB);
  if ($mysqli->connect_errno) {
      die($mysqli->connect_error);
  }
  $mysqli->query("set names utf8");

  // 查询我的数据
  $sql="select score from countMoney where openId='$openid'";
  $result=$mysqli->query($sql);
  

  if ($result->num_rows==0) {

      $sql2="update countMoney set score=$newScore where openId='$openid'";
      $result2=$mysqli->query($sql2);
      if($result2->num_rows>0){
          $lastScore=$newScore;
          $count=countRank($lastScore);
      }

  }else{
     $rows=$result->fetch_assoc();
     $lastScores=(int)$rows['score'];
     if ($newScore>=$lastScores) {
       $sql2="update countMoney set score=$newScore where openId='$openid'";
         $result2=$mysqli->query($sql2);
         $lastScore=$newScore;
         $count=countRank($lastScore);

     }else{
        $lastScore=$lastScores;
        $count=countRank($lastScore);     
     }
  }

  function countRank($score){
      $mysqli=new mysqli(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB);
      if ($mysqli->connect_errno) {
          die($mysqli->connect_error);
      }
      $mysqli->query("set names utf8");
      
      $sqlScore="select count(*) as count from countMoney where score >'$score'";
      $resultCount=$mysqli->query($sqlScore);
      $rowCount=$resultCount->fetch_assoc();
      $count=(int)$rowCount['count']+1;
      return $count;
  }
  
  $arr = array();
  $arr['newScore']=$newScore;
  $arr['lastScore']=$lastScore;
  $arr['count']=$count;
  echo json_encode($arr);
//echo '{'"newScore:".$newScore.",lastScore:".$lastScore.",count""$count"}';

 

$mysqli->close();


?>