<?php 
    require_once("../config/config.php");
    session_start();
    if(isset($_POST['comment']) && isset($_POST["acc_id"]) && isset($_POST["posted_id"]))
    {
        $comment = $_POST['comment'];
        $acc_id = $_POST["acc_id"];
        $post_id = $_POST["posted_id"];
        $date = date('Y-m-d');
        $query = "INSERT INTO tbl_comments (comment, comment_date, acc_id, posted_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssii", $comment, $date, $acc_id, $post_id);
        $stmt->execute();

        $queryTotal = "SELECT COUNT(*) as total_comments FROM tbl_comments WHERE posted_id = ?";
        $stmtTotal = $conn->prepare($queryTotal);
        $stmtTotal->bind_param("i", $post_id);
        $stmtTotal->execute();
        $resultTotal = $stmtTotal->get_result();
        $totalComments = $resultTotal->fetch_assoc()["total_comments"];

        $queryNotif = "SELECT acc_id FROM tbl_spaces_post WHERE posted_id = ?";
        $stmtNotif = $conn->prepare($queryNotif);
        $stmtNotif->bind_param("i", $post_id);
        $stmtNotif->execute();
        $resultNotif = $stmtNotif->get_result();
        $fetchNotif = $resultNotif->fetch_assoc();
        $acc_id_posted = $fetchNotif["acc_id"];
        $notif = "Commented on your post";

        if($acc_id != $acc_id_posted)
        {
            $queryNotif = "INSERT INTO tbl_notifications (notif_activity, user_id, acc_id) VALUES (?, ?, ?)";
            $stmtNotif = $conn->prepare($queryNotif);
            $stmtNotif->bind_param("sii", $notif, $acc_id, $acc_id_posted);
            $stmtNotif->execute();
        }


        echo json_encode(["status" => "success", "total_comments" => $totalComments]);

    }

?>