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

    $selectOwner = "SELECT acc_id FROM tbl_spaces WHERE space_id = ?";
    $stmtSelectOwner = $conn->prepare($selectOwner);
    $stmtSelectOwner->bind_param("i", $space_id);
    $stmtSelectOwner->execute();
    $result = $stmtSelectOwner->get_result();
    $row = $result->fetch_assoc();
    $owner_id = $row["acc_id"];

    $activity = "joined your space";
    $insertNotifQuery = "INSERT INTO tbl_notifications (notif_activity, user_id, acc_id) VALUES (?, ?, ?)";
    $stmtInsertNotif = $conn->prepare($insertNotifQuery);
    $stmtInsertNotif->bind_param("sii", $activity, $user_id, $owner_id);
    $stmtInsertNotif->execute();
}

?>