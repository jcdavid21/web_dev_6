<?php

    require_once("../config/config.php");
    session_start();
    if(isset($_POST["comment_id"]))
    {
        $comment_id = $_POST["comment_id"];
        $query = "DELETE FROM tbl_comments WHERE comment_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $comment_id);
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