<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require('connect.php');
$userId = mysqli_real_escape_string($conn, $_POST['userId']);
$rowId = mysqli_real_escape_string($conn, $_POST['rowId']);

$removeQuery = "DELETE FROM `apartments` WHERE id = $rowId";
$removeResult = mysqli_query($conn, $removeQuery);
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