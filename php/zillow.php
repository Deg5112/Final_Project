<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

$zillowUrl = $_POST['url'];


$curl = curl_init();

//
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl,  CURLOPT_URL, $zillowUrl);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER => 0);
//
echo '<pre>';
print_r($curl);
echo '</pre>';
$result = curl_exec($curl);  //get an xml string as a response
//
//
echo '<pre>';
print_r($result);
echo '</pre>';

$responseArray = [
    'success'=>true,
    'data'=>$result
];
print(json_encode($responseArray));




?>