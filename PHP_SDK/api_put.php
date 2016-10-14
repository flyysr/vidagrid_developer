<?php
/**
 * 通过curl来调用restful的 web API
 */
//api的url地址
$url = "https://api.diacloudsolutions.com/devices/22059/regs";
$ch = curl_init($url);
//username , password
$user = 'your_account';
$password = 'your_password';
$headers = array(
    'Accept:application/json',
    'Authorization: Basic '. base64_encode("$user:$password"),
    'content-type: application/json'
);

$myjson =[['addr'=>2052,'value'=>201]];
$myjson = json_encode($myjson);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
curl_setopt($ch, CURLOPT_HTTPHEADER , $headers );

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//curl_setopt($ch, CURLOPT, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $myjson );//设置提交的字符串

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
    echo $result;
    echo (substr($result, $http_header_size));
}