<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

$responseArray = [
    'success' => true,
    'data' => file_get_contents($_POST['url'])
];

print(json_encode($responseArray));
