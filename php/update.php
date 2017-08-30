<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require('connect.php');
$rowId = mysqli_real_escape_string($conn, $_POST['rowId']);
$title = mysqli_real_escape_string($conn, $_POST['title']);
$updateQuery = "UPDATE `apartments` SET `title`='$title' WHERE `id` = $rowId";
$queryResult = mysqli_query($conn, $updateQuery);
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