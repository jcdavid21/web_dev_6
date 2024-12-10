<?php 

    require_once("../config/config.php");
    session_start();
    if(isset($_POST["subs_id"]))
    {
        $sub_id = $_POST["subs_id"];
        $query = "DELETE FROM tbl_subscription WHERE subs_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $sub_id);
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