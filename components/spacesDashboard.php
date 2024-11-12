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
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <div class="center">
            <?php if(!empty($user_id)){
            include 'spaces.php';
            }else{
                echo '<div class="space"></div>';
            } ?>
            <div style="display: flex; align-items: center; justify-content: center;">
                <div class="container">
                <h1>Home Page</h1>
                    <?php 
                        $query = "SELECT tp.*, td.full_name, tr.role_name, ts.space_id, ts.space_name, COUNT(tc.posted_id) AS total_comments FROM tbl_spaces_post tp
                        JOIN tbl_account ta ON tp.acc_id = ta.acc_id
                        JOIN tbl_account_details td ON tp.acc_id = td.acc_id
                        JOIN tbl_role tr ON ta.role_id = tr.role_id
                        JOIN tbl_spaces ts ON tp.space_id = ts.space_id
                        LEFT JOIN tbl_comments tc ON tp.posted_id = tc.posted_id
                        WHERE tp.posted_privacy = 1
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
                                <i class="fa-regular fa-circle-user"></i>
                                <div class="user-details">
                                    <div class="name"><?php echo $row["full_name"] ?> - <span>Author</span></div>
                                    <div class="date">#<?php echo $row["role_name"] ?></div>
                                    <div class="date"><?php echo $dateFormated ?></div>
                                </div>
                            </div>
                            <div class="right">
                                <?php echo $row["space_name"] ?>
                            </div>
                        </div>

                        <div class="post-description">
                            <?php echo $row["posted_caption"] ?>
                        </div>

                        <div class="img-con">
                            <img src="<?php echo $row["posted_img"] ?>" alt="">
                        </div>

                        <div class="others-con">
                            <div class="likes">
                                <i class="fa-solid fa-up-long"></i>
                                <div>Update <span style="color: red; font-weight:500;"><?php echo $row["posted_likes"] ?></span></div>
                                <i class="fa-solid fa-down-long"></i>
                            </div>
                            <div class="comments">
                                <i class="fa-regular fa-comment"></i>
                                <span><?php echo $row["total_comments"] ?></span>
                            </div>
                            <div class="comments">
                                <i class="fa-solid fa-rotate"></i>
                                <span><?php echo $row["posted_share"] ?></span>
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
</body>
</html>
