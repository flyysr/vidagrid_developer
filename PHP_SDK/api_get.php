<?php
/**
 * 通过curl来调用restful的 web API
 */
//api的url地址
$url = "https://api.diacloudsolutions.com/devices";
$ch = curl_init($url);
//username , password
$user = 'your_account';
$password = 'your_password';
$headers = array(
    'Accept:application/json',
    'Authorization: Basic '. base64_encode("$user:$password")
);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
curl_setopt($ch, CURLOPT_HTTPHEADER , $headers );


curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
$result = curl_exec($ch);

if($result === false){
    echo 'Curl error: ' . curl_error($ch);
    curl_close($ch);
}else{
    //在这里处理返回的结果

    $http_code = curl_getinfo ($ch,CURLINFO_HTTP_CODE);
    $http_header_size = curl_getinfo ($ch,CURLINFO_HEADER_SIZE);
    curl_close($ch);
    header('content-type:application/json');
    echo (substr($result, $http_header_size));exit;
}