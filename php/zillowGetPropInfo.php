<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

$zillowKey = getenv('ZILLOW_API_KEY');

$responseArray = [
    'success' => true,
    'data' => file_get_contents($_POST['url']."&zws-id=$zillowKey")
];

print(json_encode($responseArray));
