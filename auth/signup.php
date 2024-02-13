<?php

include "../connect.php";

$name = filterRequest(requestName: "name");
$username = filterRequest(requestName: "username");
$email = filterRequest(requestName: "email");
$password = filterRequest(requestName: "password");

$statment = $con->
                    prepare('INSERT INTO `users` (`name`, `username`, `email`, `password`) 
                             VALUES (?, ?, ?, ?)');

$statment->execute(array($name, $username, $email, $password));


$count = $statment->rowCount();

if($count > 0){
    echo json_encode(array("status" => "success"));
}
else{
    echo json_encode(array("status" => "fail"));
}

?>