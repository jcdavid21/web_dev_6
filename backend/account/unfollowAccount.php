<?php 
    require_once("../config/config.php");
    session_start();

    if(isset($_POST["account_id"]))
    {
        $acc_id = $_POST["account_id"];
        $user_id = $_SESSION["user_id"];

        $query = "DELETE FROM tbl_followed WHERE acc_id = ? AND followed_id = ?";
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
    }
?>