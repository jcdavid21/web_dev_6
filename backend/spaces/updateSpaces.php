<?php

require_once("../config/config.php");
session_start();

if (isset($_POST["space_id"]) && isset($_POST["space_name"])) {
    $space_id = $_POST["space_id"];
    $space_name = $_POST["space_name"];
    $user_id = $_SESSION["user_id"];

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
    } else {
        $target_file = $_POST["existing_space_img"] ?? ''; // Use the existing image if no new one was uploaded
    }

    $query = '';

    if(empty($target_file)){
        $query = "UPDATE tbl_spaces SET space_name = ? WHERE space_id = ? AND acc_id = ?";
    } else {
        $query = "UPDATE tbl_spaces SET space_name = ?, space_img = ? WHERE space_id = ? AND acc_id = ?";
    }

    $stmt = $conn->prepare($query);
    if(!empty($target_file)){
        $stmt->bind_param("ssii", $space_name, $target_file, $space_id, $user_id);
    } else {
        $stmt->bind_param("sii", $space_name, $space_id, $user_id);
    }

    if ($stmt->execute() && $stmt->affected_rows === 1) {
        echo json_encode(["status" => "success", "message" => "Space updated successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "No changes were made or update failed."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid input data."]);
}
?>
