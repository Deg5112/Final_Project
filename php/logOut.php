<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require('connect.php');
$token = $_POST['token'];
$logOutQuery = "DELETE FROM `auth_token` WHERE token = '$token'";

$result = mysqli_query($conn, $logOutQuery);
if(mysqli_affected_rows($conn)>0){
    $response = [
        'success'=>true
    ];
}else{
    $response = [
        'success'=>false
    ];
}
print(json_encode($response));


?>