<?php
    include "../connect.php";
    $user_id = filterGetRequest("user");
    $note_id = filterGetRequest("note_id");
    $image_name = filterGetRequest("note_image");

    $stmt = $con->prepare("DELETE FROM notes WHERE id = ? and user_id=?");
    $stmt->execute(array($note_id, $user_id));
    
    $count = $stmt->rowCount();
    
    if ($count > 0) {
        if(file_exists("../assets/images/".$image_name)) {
            deleteFile("../assets/images", $image_name);
        }
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "fail"));
    }    
?>