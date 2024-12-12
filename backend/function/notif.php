
<?php 
    function insertNotif($conn, $activity, $user_id, $acc_id)
    {
        $query = "INSERT INTO tbl_notifications (notif_activity, user_id, acc_id) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sii", $activity, $user_id, $acc_id);
        $stmt->execute();
    }
?>