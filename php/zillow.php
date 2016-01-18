<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

$zillowUrl = $_POST['url'];


$curl = curl_init();

//
$value = 0;
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl,  CURLOPT_URL, $zillowUrl);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);


//

$result = curl_exec($curl);  //get an xml string as a response
//
//


$responseArray = [
    'success'=>true,
    'data'=>$result
];
print(json_encode($responseArray));




?>