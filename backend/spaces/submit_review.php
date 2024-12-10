<?php 

    require_once("../config/config.php");
    session_start();
    if(isset($_POST["rating"]) && isset($_POST["message"]))
    {
        $rating = $_POST["rating"];
        $message = $_POST["message"];
        $acc_id = $_SESSION["user_id"];
        $date = date('Y-m-d');

        $query = "INSERT INTO tbl_reviews (acc_id, review_message, review_date, review_star) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("issi", $acc_id, $message, $date, $rating);
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