<?php
require('connect.php');
$userId = $_POST['userId'];
$rowId = $_POST['rowId'];

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