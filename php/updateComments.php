<?php
require('connect.php');
$rowId = $_POST['rowId'];
$comments = $_POST['comments'];


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