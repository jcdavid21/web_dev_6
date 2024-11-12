<?php
require_once("../config/config.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['credential_title'])) {
    $credential_title = htmlspecialchars($_POST['credential_title']);
    $user_id = $_SESSION['user_id']; // assuming user_id is stored in session
    
    $query = "INSERT INTO tbl_credentials (acc_id, credential_title) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('is', $user_id, $credential_title);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
