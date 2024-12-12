<?php 
    session_start();
    $user_id = "";
    if(isset($_SESSION["user_id"])){
        $user_id = $_SESSION["user_id"];
    }
?> 

<?php 
    require_once("../backend/config/config.php");
?>

<nav>
<div class="navbar">
        <div class="lc">
            <?php 
                if(!empty($user_id)){
            ?>
                <div class="spaces-container" onclick="openNav()">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            <?php } ?>

            <div class="logo">
                <img src="../imgs/DDlogo.jpg" alt="Logo">
            </div>
       </div>
        <div class="search-box">
            <input type="text" placeholder="Search...">
            <button><i class="fas fa-search"></i></button>
        </div>
        
        <div class="nav-icons mr-5">
            <a href="./homepage.php" class="nav-icon"><i class="fas fa-home"></i><span>Home</span></a>

            <a href="#" class="nav-icon spaces"><i class="fas fa-rocket"></i><span>Spaces</span>
                <?php if(!empty($user_id)){ ?>

                <div class="hover-div">
                    <?php 
                        $query = "SELECT * FROM tbl_spaces WHERE acc_id = ? ORDER BY space_name ASC";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param('i', $user_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                    ?>
                    <div class="space" data-space-id="<?php echo htmlspecialchars($row['space_id'], ENT_QUOTES, 'UTF-8'); ?>">
                        <div class="img-con">
                            <img src="<?php echo htmlspecialchars($row['space_img'], ENT_QUOTES, 'UTF-8'); ?>" alt="">
                        </div>
                        <div class="space-name">
                            <?php echo htmlspecialchars($row['space_name'], ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                    </div>
                    <?php 
                            }
                        }
                    ?>

                    <div class="add-more">
                        +
                    </div>
                </div>
                <?php } ?>
            </a>
            
            <?php 
                if(!empty($user_id)){
            ?>
            <a href="#" class="nav-icon following"><i class="fas fa-user-friends"></i><span>Following</span>
                <div class="hover-div">
                    <div class="icons-outer">
                        <div class="title">Followed Spaces</div>
                        <div class="icons">
                            <div class="img-con">
                                <img src="../imgs/reddit-logo-2436.png" alt="">
                            </div>

                            <div class="img-con">
                                <img src="../imgs/reddit-logo-2436.png" alt="">
                            </div>

                            <div class="img-con">
                                <img src="../imgs/reddit-logo-2436.png" alt="">
                            </div>
                        </div>
                    </div>
                    
                    <div class="followed-div">
                        <div class="title">Followed User & Author</div>

                        <div class="info-det">
                            <div class="img-con">
                                <img src="../imgs/reddit-logo-2436.png" alt="">
                            </div>
                            <div class="name">
                                Krizzy Cruz
                                <div class="author">Author</div>
                            </div>
                        </div>

                        <div class="info-det">
                            <div class="img-con">
                                <img src="../imgs/reddit-logo-2436.png" alt="">
                            </div>
                            <div class="name">
                                Jc David
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <?php } ?>
            <?php 
                if(!empty($user_id)){
            ?>
            <a href="#" class="nav-icon following"><i class="fas fa-bell"></i><span>Notifications</span>
                <div class="hover-div">
                    <div class="followed-div">
                        <div class="title">Notifications</div>

                        <div class="info-det">
                            <div class="img-con">
                                <img src="../imgs/reddit-logo-2436.png" alt="">
                            </div>
                            <div class="name name-notif">
                                Krizzy Cruz liked your post
                                <div class="author">1 min ago</div>
                            </div>
                        </div>

                        <div class="info-det">
                            <div class="img-con">
                                <img src="../imgs/reddit-logo-2436.png" alt="">
                            </div>
                            <div class="name name-notif">
                                Jc David Comment on your post
                                <div class="author">1 min ago</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <?php } ?>
            <?php 
                if(empty($user_id)){
            ?>
            <a href="signup.php" class="nav-icon sign-in"><i class="fas fa-sign-in-alt"></i><span>Sign In</span></a>
            <?php } ?>
            <?php 
                if(!empty($user_id)){
            ?>
            <a href="./subscription.php" class="nav-icon subscription"><i class="fas fa-star"></i><span>Subscription</span></a>
            <?php } ?>
            <a href="./createblog.php" class="nav-icon"><i class="fa-brands fa-blogger"></i><span>Create Blog</span></a>
        </div>
        
        <?php
            if(!empty($user_id)){
         ?>
            <div class="account">
                <a href="./profileDashboard.php?acc_id=<?php echo $user_id ?>" class="nav-icon"><i class="fa-solid fa-user"></i><span>Account</span></a>
            </div>
        <?php } ?>
    </div>
</nav>

<script>
const spaces = document.querySelectorAll('.space');

spaces.forEach((space) => {
    space.addEventListener('click', (e) => {
        // Ensure the correct element with the `data-space-id` is targeted
        const spaceId = space.getAttribute('data-space-id');
        if (spaceId) {
            window.location.href = `./spacesPost.php?space_id=${spaceId}`;
        }
    });
});

</script>