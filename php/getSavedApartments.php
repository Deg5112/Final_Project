<?php
require('connect.php');

//$password = $_POST['password'];
//
//$hash =  crypt('fluffybunnies', '$2a$09$anexamplestringforsalt$');
//we'll deal with login and password stuff later.. ?

$apartmentsQuery = "SELECT * FROM apartments";
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