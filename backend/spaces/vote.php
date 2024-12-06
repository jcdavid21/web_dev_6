<?php
require_once("../config/config.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $posted_id = $_POST['posted_id'];
    $vote_type = $_POST['vote_type']; // 1 for upvote, 0 for downvote
    $acc_id = $_SESSION['user_id']; // Assuming user is logged in


    // Check if the user has already upvoted (i.e., a record exists for this user and post)
    $query = "SELECT * FROM tbl_likes WHERE posted_id = ? AND acc_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $posted_id, $acc_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $userHasUpvoted = $result->num_rows > 0;

    if ($vote_type == 1) { // Upvote
        if ($userHasUpvoted) {
            // User already upvoted, so remove the vote (i.e., downvote or undo upvote)
            $query = "DELETE FROM tbl_likes WHERE posted_id = ? AND acc_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $posted_id, $acc_id);
            $stmt->execute();
        } else {
            // User hasn't voted yet, so insert the upvote
            $query = "INSERT INTO tbl_likes (posted_id, acc_id) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $posted_id, $acc_id);
            $stmt->execute();
        }
    }

    // Calculate the total likes (count of upvotes)
    $query = "SELECT COUNT(*) AS total_likes FROM tbl_likes WHERE posted_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $posted_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $totalLikes = $result->fetch_assoc()["total_likes"] ?? 0;

    $updatePostedQuery = "UPDATE tbl_spaces_post SET posted_likes = ? WHERE posted_id = ?";
    $updatePostedStmt = $conn->prepare($updatePostedQuery);
    $updatePostedStmt->bind_param("ii", $totalLikes, $posted_id);
    $updatePostedStmt->execute();

    echo json_encode([
        "status" => "success",
        "user_has_voted" => !$userHasUpvoted, // Toggle user's vote state
        "total_likes" => $totalLikes
    ]);
    exit();
}
?>
