<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require('connect.php');
$username = $_POST['username'];
$password = $_POST['password'];


$usernameQuery = "SELECT `username` FROM `users` WHERE `username` = '$username'";
$result = mysqli_query($conn, $usernameQuery);
if(mysqli_num_rows($result)>0){

    $passwordQuery = "SELECT * FROM users WHERE username = '$username' AND `password` = '$password'";
    $passwordResult = mysqli_query($conn, $passwordQuery);
    if(mysqli_num_rows($passwordResult)>0){

        while($row = mysqli_fetch_assoc($passwordResult)){
           $userId = $row['id'];
            //at this point we have the user id and the token below
        }

        $data = getDate();
        $string = $data['weekday'].$data['month'].$data['mday'].$data['hours'].$data['minutes'].$data['seconds'];
        $token = md5($string);
        $tokenQuery = "INSERT INTO `auth_token`(`user_id`, `token`, `timestamp`) VALUES ($userId, '$token', NOW())";
        $tokenResult = mysqli_query($conn, $tokenQuery);


        $responseArray = [
          'success'=> true,
            'token'=>$token,
            'username'=> $username,
            'userId'=>$userId
        ];
    }else{
        $responseArray =[
            'success'=> false,
            'data'=>'username or password is not correct'
        ];
    }
}else{
    $responseArray =[
        'success'=> false,
        'data'=>'username or password is not correct'
    ];
}

print(json_encode($responseArray));

?>