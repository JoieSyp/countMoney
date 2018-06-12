<?php
// 网络请求的方法
// get请求
 function httpGet($url){
     $curl=curl_init();
     curl_setopt($curl,CURLOPT_URL, $url);
     curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
     $reponse=curl_exec($curl);
     curl_close($curl);
     return $reponse;
}
  // post请求
function httpPost($url,$postData){
    $curl=curl_init();
    curl_setopt($curl,CURLOPT_POST, true);
    curl_setopt($curl,CURLOPT_URL, $url);
    curl_setopt($curl,CURLOPT_POSTFIELDS,$postData);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    $reponse=curl_exec($curl);
    curl_close($curl);
    return $reponse;
}



?>