<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require('connect.php');

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

//echo '<pre>';
//echo $username.' '.$email.'  '.$password;
//echo '</pre>';
//
$checkIfUsernameExist = "SELECT `username` FROM `users` WHERE `username` = '$username'";
$checkIfEmailExist = "SELECT `email` FROM `users` WHERE `email` = '$email'";
$insertQuery = "INSERT INTO `users`(`username`, `password`, `email`) VALUES ('$username', '$password', '$email')";

$usernameResult = mysqli_query($conn, $checkIfUsernameExist);
if(mysqli_num_rows($usernameResult)<1){
    $emailResult = mysqli_query($conn, $checkIfEmailExist);
    if(mysqli_num_rows($emailResult)<1) {
        //both username and email are availble.. insert data into database
        $insertResult = mysqli_query($conn, $insertQuery);
        if(mysqli_affected_rows($conn)>0){
            $response = [
                'success'=>true
            ];

        }else{
            $response = [
                'success'=>false
            ];
        }

    }else{
        $response = [
            'success'=>false,
            'data'=>'username and/or email already exist'
        ];
    }
}else{
    $response = [
        'success'=>false,
        'data'=>'username and/or email already exist'
    ];
}

print(json_encode($response));




?>