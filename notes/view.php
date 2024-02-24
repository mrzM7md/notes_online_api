<?php

include "../connect.php";

$user_id = filterGetRequest('user');

$statment = $con-> prepare('SELECT * FROM `notes` WHERE `user_id` = ?');

$statment->execute(array($user_id));

$data = $statment->fetchAll(PDO::FETCH_ASSOC);

$count = $statment->rowCount();

if($count > 0){
    echo json_encode(array("status" => "success", "data" => $data));
}
else{
    echo json_encode(array("status" => "fail"));
}

?>