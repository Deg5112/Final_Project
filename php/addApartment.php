<?php
require('connect.php');

$userId = $_POST['userId'];


$street = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];

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