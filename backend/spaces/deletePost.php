<?php

require_once("../config/config.php");
session_start();

if(isset($_POST["post_id"]))
{
    $post_id = $_POST["post_id"];

    $query = "DELETE FROM tbl_spaces_post WHERE posted_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $post_id);
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