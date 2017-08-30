<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require('connect.php');

$userId = mysqli_real_escape_string($conn, $_POST['userId']);
$street = mysqli_real_escape_string($conn, $_POST['street']);
$city = mysqli_real_escape_string($conn, $_POST['city']);
$state = mysqli_real_escape_string($conn, $_POST['state']);

$insertQuery = "INSERT INTO `apartments`( `title`, `street`, `city`, `state`, `user_id`) VALUES ('$street', '$street', '$city', '$state', $userId )";
$insertResult = mysqli_query($conn, $insertQuery);

if(mysqli_affected_rows($conn)>0){
    $lastId = mysqli_insert_id($conn);
    $responseArray = [
        'success'=>true,
        'rowId'=>$lastId
    ];
    print(json_encode($responseArray));
}else{
    $responseArray = [
        'success'=>false
    ];
    print(json_encode($responseArray));
}




?>