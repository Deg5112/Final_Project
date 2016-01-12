<?php
require('connect.php');

$userId = $_POST['userId'];


$apartmentsQuery = "SELECT * FROM `apartments` WHERE user_id = $userId";
$result = mysqli_query($conn, $apartmentsQuery);
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        $apartments[] = $row;

        $responseArray = [
            'success'=> true,
            'data'=> $apartments
        ];
    }

    print(json_encode($responseArray));

}else{
    $responseArray = [
        'success'=> false,
        'data'=> 'no apartments found'
    ];
}



?>