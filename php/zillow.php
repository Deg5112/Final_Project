<?php


$zillowUrl = $_POST['url'];

$curl = curl_init();

curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl,  CURLOPT_URL, $zillowUrl);

$result = curl_exec($curl);  //get an xml string as a response


$responseArray = [
    'success'=>true,
    'data'=>$result
];
print(json_encode($responseArray));




?>