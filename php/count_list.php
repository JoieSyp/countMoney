<?php
   $mysqli=new mysqli(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB);
    if ($mysqli->connect_errno) {
      die($mysqli->connect_error);
    }
    $mysqli->query("set names utf8");

    $sql="select * from countMoney order by score DESC limit 5";
    $result=$mysqli->query($sql);
    if ($result->num_rows==0) {
    	 echo "0";
    }else{
        $arr=array();
        while ($rows=$result->fetch_assoc()) {
        	$arr[]=$rows;
        }
        $json=json_decode($arr);
        echo $json;
    }

?>