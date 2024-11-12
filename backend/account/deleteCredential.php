<?php
require_once("../config/config.php");
session_start();
if (isset($_POST['credential_title'])) {
    $credentialTitle = $_POST['credential_title'];
    $userId = $_SESSION['user_id']; // Assuming the user ID is stored in the session

    $query = "DELETE FROM tbl_credentials WHERE acc_id = ? AND credential_title = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('is', $userId, $credentialTitle);
    if ($stmt->execute()) {
        echo "Credential deleted successfully.";
    } else {
        echo "Error deleting credential.";
    }
}
?>
