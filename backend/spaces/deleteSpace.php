<?php 

    require_once("../config/config.php");
    session_start();

    if(isset($_POST["space_id"]))
    {
        $space_id = $_POST["space_id"];
        $user_id = $_SESSION["user_id"];

        // delete all posts in the space
        $queryDeletePosts = "DELETE FROM tbl_spaces_post WHERE space_id = ?";
        $stmtDeletePosts = $conn->prepare($queryDeletePosts);
        $stmtDeletePosts->bind_param("i", $space_id);
        $stmtDeletePosts->execute();

        // delete all users in the space
        $queryDeleteUsers = "DELETE FROM tbl_spaces_joined WHERE space_id = ?";
        $stmtDeleteUsers = $conn->prepare($queryDeleteUsers);
        $stmtDeleteUsers->bind_param("i", $space_id);
        $stmtDeleteUsers->execute();

        $query = "DELETE FROM tbl_spaces WHERE space_id = ? AND acc_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $space_id, $user_id);
        $stmt->execute();

        echo "success";
    }
?>