<?php

require_once("../config/config.php");
session_start();

if(isset($_POST["space_id"]))
{
    $space_id = $_POST["space_id"];
    $user_id = $_SESSION["user_id"];

    $query = "INSERT INTO tbl_spaces_joined (space_id, acc_id) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $space_id, $user_id);
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