<!DOCTYPE html>
<?php 
require_once("../backend/config/config.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/Homepage.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <div class="center mt-16">
            <?php if(!empty($user_id)){
            include 'spaces.php';
            }else{
                echo '<div class="space"></div>';
            } ?>
            <div style="display: flex; align-items: center; justify-content: center;">
                <div class="container">
                <h1>Home Page</h1>
                    <?php 
                        $query = "SELECT tp.*, td.full_name, td.profile_img, tr.role_name, ts.space_id, ts.space_name, COUNT(tc.posted_id) AS total_comments FROM tbl_spaces_post tp
                        JOIN tbl_account ta ON tp.acc_id = ta.acc_id
                        JOIN tbl_account_details td ON tp.acc_id = td.acc_id
                        JOIN tbl_role tr ON ta.role_id = tr.role_id
                        JOIN tbl_spaces ts ON tp.space_id = ts.space_id
                        LEFT JOIN tbl_comments tc ON tp.posted_id = tc.posted_id
                        WHERE tp.posted_privacy = 1 AND tp.post_status = 1
                        GROUP BY tp.posted_id
                        ORDER BY tp.posted_date ASC";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        while($row = $result->fetch_assoc()){
                            $dateFormated = date('M d, Y', strtotime($row["posted_date"]));
                    ?>
                    <div class="content">
                        <div class="post-details">
                            <div class="left">
                                <?php if (empty($row["profile_img"])): ?>
                                    <i class="fa-regular fa-circle-user"></i>
                                <?php else: ?>
                                    <div class="h-16">
                                        <img src="<?php echo htmlspecialchars($row["profile_img"]); ?>" alt="Profile Image"
                                        class="h-full rounded-full">
                                    </div>
                                <?php endif; ?>

                                <div class="user-details">
                                    <div class="name"><?php echo $row["full_name"] ?> - <span>Author</span></div>
                                    <div class="font-medium text-sm text-amber-500"><?php echo $row["role_name"] ?></div>
                                    <div class="date"><?php echo $dateFormated ?></div>
                                </div>
                            </div>
                            <div class="right">
                                <?php echo $row["space_name"] ?>
                            </div>
                        </div>

                        <div class="post-description">
                            <div class="font-medium text-lg"><?php echo $row["post_title"] ?></div>
                            <?php echo $row["posted_caption"] ?>
                            <div class="font-medium text-blue-400"><?php echo $row["post_tags"] ?></div>
                        </div>

                        <div class="img-con">
                            <img src="<?php echo $row["posted_img"] ?>" alt="">
                        </div>

                        <div class="others-con">
                            <div class="likes">
                                <?php
                                    // Check if the user has already liked the post
                                    $queryLikes = "SELECT * FROM tbl_likes WHERE posted_id = ? AND acc_id = ?";
                                    $stmtLikes = $conn->prepare($queryLikes);
                                    $stmtLikes->bind_param("ii", $row["posted_id"], $user_id);
                                    $stmtLikes->execute();
                                    $resultLikes = $stmtLikes->get_result();

                                    // Check if the user has already upvoted (liked)
                                    $userHasUpvoted = $resultLikes->num_rows > 0;
                                ?>
                                <i class="fa-solid fa-up-long cursor-pointer upVote <?php echo $userHasUpvoted ? 'active' : ''; ?>" 
                                data-posted-id="<?php echo $row['posted_id']; ?>"></i>

                                <div>Upvote <span style="color: red; font-weight:500;"><?php echo $row["posted_likes"]; ?></span></div>

                                <!-- Enable downvote only if the user has upvoted -->
                                <i class="fa-solid fa-down-long cursor-pointer downVote <?php echo $userHasUpvoted ? '' : ''; ?>" 
                                data-posted-id="<?php echo $row['posted_id']; ?>"></i>
                            </div>


                            <div class="comments">
                                <i class="fa-regular fa-comment"></i>
                                <span class="total-comments"><?php echo $row["total_comments"] ?></span>
                            </div>
                            <div class="comments">
                                <i class="fa-solid fa-rotate"></i>
                                <span><?php echo $row["posted_share"] ?></span>
                            </div>
                        </div>

                        <div class="comment-div">
                            <?php 
                                if(!empty($user_id)){
                            ?>
                            <div class="input-comment">
                                <input type="text" placeholder="Write a comment..." maxlength="255" class="comment">
                                <button class="submit-comment" data-acc-id="
                                <?php 
                                    if(!empty($user_id)){
                                        echo $user_id;
                                    }else{
                                        echo 0;
                                    }
                                ?>" data-posted-id="<?php echo $row["posted_id"] ?>"
                                data-profile-img="<?php echo $row["profile_img"] ?>" data-full-name="<?php echo $row["full_name"] ?>" >Post</button>
                            </div>
                            <?php } ?>
                            <div class="comments-con" data-posted-id="<?php echo $row["posted_id"] ?>">
                                <?php 
                                    $query2 = "SELECT tc.*, td.full_name, td.profile_img FROM tbl_comments tc
                                    JOIN tbl_account ta ON tc.acc_id = ta.acc_id
                                    JOIN tbl_account_details td ON tc.acc_id = td.acc_id
                                    WHERE tc.posted_id = ? 
                                    ORDER BY tc.comment_date ASC";
                                    $stmt2 = $conn->prepare($query2);
                                    $stmt2->bind_param("i", $row["posted_id"]);
                                    $stmt2->execute();
                                    $result2 = $stmt2->get_result();
                                    
                                    if($result2->num_rows > 0){
                                        while($row2 = $result2->fetch_assoc()){
                                            $dateFormated2 = date('M d, Y', strtotime($row2["comment_date"]));
                                    ?>
                                    <div class="flex justify-between gap-2 comment-container" data-comment-con-id="<?php echo $row2['comment_id']; ?>">
                                        <div class="comment">
                                            <div class="left">
                                                <?php if (empty($row2["profile_img"])): ?>
                                                    <i class="fa-regular fa-circle-user"></i>
                                                <?php else: ?>
                                                    <div class="h-16">
                                                        <img src="<?php echo htmlspecialchars($row2["profile_img"]); ?>" alt="Profile Image"
                                                        class="h-full rounded-full">
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="right">
                                            <div class="flex gap-2 text-sm right-details">
                                                <div class="name"><?php echo $row2["full_name"] ?></div>
                                                <div class="date font-semibold"><?php echo $dateFormated2 ?></div>
                                            </div>
                                            <div class="modify-comment" data-comment-id="<?php echo $row2['comment_id']; ?>">
                                                <?php 
                                                    if($row2["acc_id"] == $user_id){
                                                ?>
                                                <div class="comment-text"><?php echo $row2["comment"] ?></div>
                                                <div class="flex gap-2">
                                                    <div class="edit cursor-pointer">
                                                        <i class="fa-regular fa-edit text-blue-700 font-medium"></i>
                                                    </div>
                                                    <div class="delete delete-comment cursor-pointer">
                                                        <i class="fa-regular fa-trash-can text-red-700"></i>
                                                    </div>
                                                </div>
                                                <?php }else{ ?>
                                                    <div class="comment-text"><?php echo $row2["comment"] ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } }else{ ?>
                                    <div class="no-comment text-center mt-2">No comments yet</div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
            <?php 
                if(!empty($user_id)){
            ?>
            <?php include 'profile.php'; ?>
            <?php } ?>
        </div>
    </main>

<?php include 'footer.php'; ?>
<script src="../js/sidebar.js"></script>
<script src="../jquery/comments.js"></script>
<script src="../jquery/vote.js"></script>
</body>
</html>
