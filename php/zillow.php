<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
//var_dump(extension_loaded('curl'));

$zillowUrl = $_POST['url'];
//$zillowUrl = "http://www.zillow.com/webservice/GetSearchResults.htm?zws-id=X1-ZWz1f1y483y2ob_3l8b3&address=100+calais+st&citystatezip=laguna+niguel%2C+CA";
$proxy = json_decode(file_get_contents('http://gimmeproxy.com/api/getProxy'))->curl;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $zillowUrl);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 0);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST,'GET');

$result = curl_exec($ch);  //get an xml string as a response

$responseArray = [
    'success' => true,
    'data' => $result
];
print(json_encode($responseArray));




