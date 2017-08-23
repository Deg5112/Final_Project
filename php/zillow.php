<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
echo file_get_contents("http://www.zillow.com/webservice/GetSearchResults.htm?zws-id=X1-ZWz1fye6isfggb_634pb&address=21551+Brookhurst+St&citystatezip=Huntington+Beach%2C+CA", true);
//var_dump(extension_loaded('curl'));

//$zillowUrl = $_POST['url'];
$zillowUrl = "http://www.zillow.com/webservice/GetSearchResults.htm?zws-id=X1-ZWz1fy14xfmebv_6sext&address=21551+Brookhurst+St&citystatezip=Huntington+Beach%2C+CA";
$proxy = json_decode(file_get_contents('http://gimmeproxy.com/api/getProxy'))->curl;
//
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $zillowUrl);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 0);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST,'GET');
//
//$result = curl_exec($ch);  //get an xml string as a response

//$zillowUrl = $_POST['url'];
//$zillowUrl = "http://www.zillow.com/webservice/GetSearchResults.htm?zws-id=X1-ZWz1fy14xfmebv_6sext&address=21551+Brookhurst+St&citystatezip=Huntington+Beach%2C+CA";
//$curl = curl_init();

$result = curl_exec($ch);  //get an xml string as a response


$responseArray = [
    'success' => true,
    'data' => $result
];
print(json_encode($responseArray));




