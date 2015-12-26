<?php


$zillowUrl = $_POST['zillowUrl'];
print_r($zillowUrl);
$curl = curl_init();

curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl,  CURLOPT_URL, $zillowUrl);

$result = curl_exec($curl);
$xmlObject = simplexml_load_string($result);
print_r($xmlObject);
$json = json_encode($xmlObject);
print_r($xmlObject);
//print(json_encode($xmlObject));




?>