<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require('connect.php');
$rowId = mysqli_real_escape_string($conn, $_POST['rowId']);
$comments = mysqli_real_escape_string($conn, $_POST['comments']);

$updateCommentsQuery = "UPDATE `apartments` SET `comments`= '$comments' WHERE id=$rowId";
$commentResult = mysqli_query($conn, $updateCommentsQuery);
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