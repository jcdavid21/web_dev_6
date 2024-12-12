<?php 

    require_once("../config/config.php");
    session_start();

    if(isset($_POST["space_name"]) && isset($_SESSION["user_id"]))
    {
        $space_name = $_POST["space_name"];
        $user_id = $_SESSION["user_id"];

        // check if the space name already exists
        $queryCheck = "SELECT * FROM tbl_spaces WHERE space_name = ?";
        $stmtCheck = $conn->prepare($queryCheck);
        $stmtCheck->bind_param("s", $space_name);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->get_result();

        if($resultCheck->num_rows > 0)
        {
            echo "exists";
            exit;
        }

        $target_file = '';

        // Check if a file was uploaded
        if (isset($_FILES['space_img']) && $_FILES['space_img']['error'] === 0) {
            $target_dir = "../../imgs/spaces/";
            $file_extension = pathinfo($_FILES["space_img"]["name"], PATHINFO_EXTENSION);
            $new_file_name = uniqid("space_", true) . "." . $file_extension; // Generate a unique name
            $target_file = $target_dir . $new_file_name;

            if (!move_uploaded_file($_FILES["space_img"]["tmp_name"], $target_file)) {
                echo json_encode(["status" => "error", "message" => "Failed to upload file."]);
                exit;
            }
        } 


        $query = "INSERT INTO tbl_spaces (space_name, space_img, acc_id) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $space_name, $target_file, $user_id);
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