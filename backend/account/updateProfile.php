<?php
require_once("../config/config.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    $acc_id = $_SESSION['user_id']; // Assuming session stores user id
    $full_name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $job = $_POST['job'];

    function updatePassword($conn, $acc_id, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE tbl_account SET acc_password = ? WHERE acc_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $hashed_password, $acc_id);
        return $stmt->execute();
    }

    if($password != "") {
        if (!updatePassword($conn, $acc_id, $password)) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Failed to update password"]);
            exit();
        }
    }

    // Handle profile image upload if a new file is selected
    $profile_img = null;
    if (isset($_FILES['profile_img']) && $_FILES['profile_img']['error'] == 0) {
        $target_dir = "../../imgs/profile/";
        
        // Generate a unique name for the file
        $file_extension = pathinfo($_FILES["profile_img"]["name"], PATHINFO_EXTENSION);
        $unique_name = uniqid() . "_" . time() . "." . $file_extension;
        $profile_img = $target_dir . $unique_name;
        move_uploaded_file($_FILES["profile_img"]["tmp_name"], $profile_img);
    } else {
        // If no new file is uploaded, retain the existing profile image
        $profile_img = $_POST['profile_img'];
    }

    // Construct SQL query to update profile information
    $sql = "UPDATE tbl_account_details SET full_name = ?, gender = ?, birthdate = ?, job = ?";
    $params = [$full_name, $gender, $birthdate, $job];
    $types = 'ssss';

    // Only include profile_img in the SQL if a new file was uploaded
    if ($profile_img && isset($_FILES['profile_img']) && $_FILES['profile_img']['error'] == 0) {
        $sql .= ", profile_img = ?";
        $params[] = $profile_img;
        $types .= 's';
    }
    $sql .= " WHERE acc_id = ?";
    $params[] = $acc_id;
    $types .= 'i';

    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Profile updated successfully"]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Failed to update profile"]);
    }
}
?>
