<?php

include "../connect.php";

$username = filterPostRequest(requestName: "username");
$password = filterPostRequest(requestName: "password");

$statment = $con->
                    prepare('SELECT * FROM `users` WHERE (`username` = ? OR `email` = ?) AND `password` = ? ');

    $statment->execute(array($username, $username, $password));

$count = $statment->rowCount();

if($count > 0){
    echo json_encode(array("status" => "success"));
}
else{
    echo json_encode(array("status" => "fail"));
}

?>