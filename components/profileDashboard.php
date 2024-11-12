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
                    <div class="content">
                        <div class="post-details">
                            <div class="left">
                                <i class="fa-regular fa-circle-user"></i>
                                <div class="user-details">
                                    <div class="name">Juan Dela Cruz - <span>Author</span></div>
                                    <div class="date">#Student</div>
                                    <div class="date">Aug 23, 2024</div>
                                </div>
                            </div>
                            <div class="right">
                                Technology
                            </div>
                        </div>

                        <div class="post-description">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum consequatur neque ea, laudantium deserunt veritatis sequi mollitia ipsum exercitationem id dolore omnis atque blanditiis quaerat sunt aperiam a voluptatum iure.
                        </div>

                        <div class="img-con">
                            <img src="../imgs/post images/post-1.avif" alt="">
                        </div>

                        <div class="others-con">
                            <div class="likes">
                                <i class="fa-solid fa-up-long"></i>
                                <div>Update <span>100</span></div>
                                <i class="fa-solid fa-down-long"></i>
                            </div>
                            <div class="comments">
                                <i class="fa-regular fa-comment"></i>
                                <span>150</span>
                            </div>
                            <div class="comments">
                                <i class="fa-solid fa-rotate"></i>
                                <span>80</span>
                            </div>
                        </div>
                    </div>

                    <div class="content">
                        <div class="post-details">
                            <div class="left">
                                <i class="fa-regular fa-circle-user"></i>
                                <div class="user-details">
                                    <div class="name">Juan Dela Cruz - <span>Author</span></div>
                                    <div class="date">Aug 23, 2024</div>
                                </div>
                            </div>
                            <div class="right">
                                Technology
                            </div>
                        </div>

                        <div class="post-description">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum consequatur neque ea, laudantium deserunt veritatis sequi mollitia ipsum exercitationem id dolore omnis atque blanditiis quaerat sunt aperiam a voluptatum iure.
                        </div>

                        <div class="img-con">
                            <img src="../imgs/post images/post-1.avif" alt="">
                        </div>

                        <div class="others-con">
                            <div class="likes">
                                <i class="fa-solid fa-up-long"></i>
                                <div>Update <span>100</span></div>
                                <i class="fa-solid fa-down-long"></i>
                            </div>
                            <div class="comments">
                                <i class="fa-regular fa-comment"></i>
                                <span>150</span>
                            </div>
                            <div class="comments">
                                <i class="fa-solid fa-rotate"></i>
                                <span>80</span>
                            </div>
                        </div>
                    </div>

                    <div class="content">
                        <div class="post-details">
                            <div class="left">
                                <i class="fa-regular fa-circle-user"></i>
                                <div class="user-details">
                                    <div class="name">Juan Dela Cruz - <span>Author</span></div>
                                    <div class="date">Aug 23, 2024</div>
                                </div>
                            </div>
                            <div class="right">
                                Technology
                            </div>
                        </div>

                        <div class="post-description">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum consequatur neque ea, laudantium deserunt veritatis sequi mollitia ipsum exercitationem id dolore omnis atque blanditiis quaerat sunt aperiam a voluptatum iure.
                        </div>

                        <div class="img-con">
                            <img src="../imgs/post images/post-1.avif" alt="">
                        </div>

                        <div class="others-con">
                            <div class="likes">
                                <i class="fa-solid fa-up-long"></i>
                                <div>Update <span>100</span></div>
                                <i class="fa-solid fa-down-long"></i>
                            </div>
                            <div class="comments">
                                <i class="fa-regular fa-comment"></i>
                                <span>150</span>
                            </div>
                            <div class="comments">
                                <i class="fa-solid fa-rotate"></i>
                                <span>80</span>
                            </div>
                        </div>
                    </div>

                    

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
