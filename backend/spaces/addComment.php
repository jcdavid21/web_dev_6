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
        $stmtTotal->bind_param("i", $posted_id);
        $stmtTotal->execute();
        $resultTotal = $stmtTotal->get_result();
        $totalComments = $resultTotal->fetch_assoc()["total_comments"];

        echo json_encode(["status" => "success", "total_comments" => $totalComments]);

    }

?>