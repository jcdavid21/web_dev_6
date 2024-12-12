<?php 
    require_once("../config/config.php");
    session_start();

    if(isset($_POST["account_id"]))
    {
        $acc_id = $_POST["account_id"];
        $user_id = $_SESSION["user_id"];

        $query = "INSERT INTO tbl_followed (acc_id, followed_id) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $user_id, $acc_id);
        $stmt->execute();

        if($stmt->affected_rows == 1)
        {
            echo "success";
        }
        else
        {
            echo "failed";
        }

        $activity = "followed you";

        $queryNotif = "INSERT INTO tbl_notifications (notif_activity, user_id, acc_id) VALUES (?, ?, ?)";
        $stmtNotif = $conn->prepare($queryNotif);
        $stmtNotif->bind_param("sii", $activity, $user_id, $acc_id);
        $stmtNotif->execute();

    }
?>