<?php
require_once("../config/config.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize variables
    $post_status = $_POST["action"];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $visibility = $_POST['visibility'];
    $date = date('Y-m-d');
    $account_id = $_SESSION['user_id']; // Assuming this is the user's account ID
    $tags = isset($_POST['tags']) ? json_decode($_POST['tags'], true) : []; // Decode JSON to array
    $target_file = ''; // Initialize with an empty string in case there's no file

    // Handle file upload
    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
        $target_dir = "../../imgs/post images/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        if (!move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo json_encode(["status" => "error", "message" => "File upload failed."]);
            exit;
        }
    }

    // Format tags with a '#' prefix and convert to a comma-separated string
    $tags_string = is_array($tags) ? implode(',', array_map(fn($tag) => '#' . ltrim($tag, '#'), $tags)) : '';

    // Prepare and execute the database insertion query
    $query = "INSERT INTO tbl_spaces_post (post_title, posted_date, posted_caption, space_id, posted_privacy, posted_img, post_status, post_tags, acc_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        // Corrected bind_param to match 9 parameters
        $stmt->bind_param('sssiisssi', $title, $date, $description, $category, $visibility, $target_file, $post_status, $tags_string, $account_id);

        if ($stmt->execute()) {
            $message = $post_status == 1 ? "Posted successfully" : "Draft saved successfully";
            echo json_encode(["status" => "success", "message" => $message]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to execute the statement: " . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Statement preparation failed: " . $conn->error]);
    }
}
?>
