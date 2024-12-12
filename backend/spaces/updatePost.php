<?php 

require_once("../config/config.php");
session_start();

 if(isset($_POST["post_id"]) && isset($_POST["title"]) && isset($_POST["tags"]) && isset($_POST["message"]) && isset($_POST["privacy"]))
 {
    $post_id = $_POST["post_id"];
    $title = $_POST["title"];
    $tags = $_POST["tags"];
    $message = $_POST["message"];
    $privacy = $_POST["privacy"];

    $query = "UPDATE tbl_spaces_post SET post_title = ?, post_tags = ?, posted_caption = ?, posted_privacy = ? WHERE posted_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $title, $tags, $message, $privacy, $post_id);
    $stmt->execute();

    if($stmt->affected_rows == 1)
    {
        echo "success";
    }
    else
    {
        echo "failed";
    }
 }
?>