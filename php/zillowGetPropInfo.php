<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
$zillowUrl = $_POST['url'];
$proxy = json_decode(file_get_contents('http://gimmeproxy.com/api/getProxy'))->curl;
//
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$zillowUrl);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 0);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST,'GET');
//
$result = curl_exec($ch);

//$url = $_POST['url'];
//$curl = curl_init();
//curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($curl, CURLOPT_URL, $url);
//$result = curl_exec($curl);

$responseArray = [
    'success' => true,
    'data' => $result
];

print(json_encode($responseArray));