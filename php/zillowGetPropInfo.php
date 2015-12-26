<?php

$url = $_POST['url'];

$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_URL, $url);

$result = curl_exec($curl);


$responseArray = [
    'success'=>true,
    'data'=>$result
];

print(json_encode($responseArray));



?>