<?php

include "../connect.php";

$user_id = filterPostRequest('user');
$note_id = filterPostRequest('note_id');
$note_title = filterPostRequest('note_title');
$note_content = filterPostRequest('note_content');

$last_image_name = filterPostRequest('image');

$image_name = imageupload("note_image");

if($image_name[0] == "fail"){ // there input problem
    echo json_encode(array("status" => "file-fail", "message" => $image_name[1]));
    return;
}

if($image_name[0] == "success"){ // there is no image, but we have the image name in [1]
    $image_name[0] = $last_image_name;
}
else { // ther is new image, 1- delete last
    if(file_exists("../assets/images/".$last_image_name)) {
        deleteFile("../assets/images", $last_image_name);
    }
}

$statment = $con-> prepare('UPDATE `notes` SET title=?, content=?, image=? WHERE id=? and user_id=?');

$statment->execute(array($note_title, $note_content, $image_name[0], $note_id, $user_id));

$count = $statment->rowCount();

if($count > 0){
    echo json_encode(array("status" => "success"));
}
else{
    echo json_encode(array("status" => "fail"));
}

?>