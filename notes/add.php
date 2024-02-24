<?php

include "../connect.php";

$user_id = filterPostRequest('user');
$note_title = filterPostRequest('note_title');
$note_content = filterPostRequest('note_content');

$image_name = imageupload("note_image");

if($image_name[0] == "fail"){ // there input problem
    echo json_encode(array("status" => "file-fail", "message" => $image_name[1]));
    return;
}

if($image_name[0] == "success"){ // there is no image
    $image_name[0] = "";
}

$statment = $con-> prepare('INSERT INTO `notes`(title, content, image, user_id) VALUES (?, ?, ?, ?)');

$statment->execute(array($note_title, $note_content, $image_name[0], $user_id));

$count = $statment->rowCount();

if($count > 0){
    echo json_encode(array("status" => "success"));
}
else{
    echo json_encode(array("status" => "fail"));
}


?>