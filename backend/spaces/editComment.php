<?php 

    require_once("../config/config.php");
    session_start();
    if(isset($_POST["comment_id"]) && isset($_POST["updated_comment"]))
    {
        $comment_id = $_POST["comment_id"];
        $updated_comment = $_POST["updated_comment"];
        $query = "UPDATE tbl_comments SET comment = ? WHERE comment_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $updated_comment, $comment_id);
        if($stmt->execute())
        {
            echo "success";
        }
        else
        {
            echo "failed";
        }
    }
?>