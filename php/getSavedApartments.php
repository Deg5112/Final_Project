<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

require('connect.php');
//ob_start();

$userId = mysqli_real_escape_string($conn, $_POST['userId']);

$apartmentsQuery = "SELECT * FROM `apartments` WHERE user_id = $userId";
$result = mysqli_query($conn, $apartmentsQuery);

$responseArray = [];
if (mysqli_num_rows($result)>0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $apartments[] = $row;

        $responseArray = [
            'success'=> true,
            'data'=> $apartments
        ];
    }
} else {
    $responseArray = [
        'success'=> false,
        'data'=> 'no apartments found'
    ];
}
//ob_end_clean();
print(json_encode($responseArray));



?>