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
            <input type="text" id="search" placeholder="Search...">
            <button id="searchBtn"><i class="fas fa-search"></i></button>
        </div>
        
        <div class="nav-icons mr-5">
            <a href="./homepage.php" class="nav-icon"><i class="fas fa-home"></i><span>Home</span></a>

            <div class="nav-icon spaces" style="cursor: pointer;"><i class="fas fa-rocket"></i><span>Spaces</span>
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

                    <a href="./addSpaces.php">
                        <div class="add-more">
                            +
                        </div>
                    </a>
                </div>
                <?php } ?>
            </div>
            
            <?php 
                if(!empty($user_id)){
            ?>
            <div class="nav-icon following"><i class="fas fa-user-friends"></i><span>Following</span>
                <div class="hover-div">
                    <div class="icons-outer">
                        <div class="title">Followed Spaces</div>
                        <div class="icons">
                            <?php 
                                $query = "SELECT tj.*, ts.space_name, ts.space_img FROM tbl_spaces_joined tj 
                                JOIN tbl_spaces ts ON tj.space_id = ts.space_id
                                WHERE tj.acc_id = ? ORDER BY RAND() LIMIT 3";
                                $stmt = $conn->prepare($query);
                                $stmt->bind_param('i', $user_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                
                                if($result->num_rows > 0){
                                    while($row = $result->fetch_assoc()){
                            ?>
                                <a href="./spacesPost.php?space_id=<?php echo $row["space_id"] ?>">
                                    <div class="img-con">
                                        <img src="../<?php echo str_replace("../", "", $row["space_img"]) ?>" alt="">
                                    </div>
                                </a>
                        <?php 
                                }
                            }
                        ?>
                        </div>
                    </div>
                    
                    <div class="followed-div">
                        <div class="title">Followed User</div>

                        <?php 
                            $query2 = "SELECT * FROM tbl_followed tf
                                    JOIN tbl_account_details td ON tf.followed_id = td.acc_id
                                    WHERE tf.acc_id = ? ORDER BY RAND() LIMIT 3";
                            $stmt2 = $conn->prepare($query2);
                            $stmt2->bind_param('i', $user_id);
                            $stmt2->execute();
                            $result2 = $stmt2->get_result();

                            if ($result2->num_rows > 0) {
                                while ($row2 = $result2->fetch_assoc()) {
                        ?>
                                <a href="./profileDashboard.php?acc_id=<?php echo $row2["acc_id"] ?>">
                                    <div class="info-det">
                                        <div class="img-con">
                                            <img src="../<?php echo htmlspecialchars(str_replace("../", "", $row2["profile_img"])); ?>" 
                                                alt="Profile Image"
                                                style="border-radius: 100%; object-fit: cover; height: 36px; width: 42px;">
                                        </div>
                                        <div class="name">
                                            <?php echo htmlspecialchars($row2["full_name"]); ?>
                                            <div class="author">Author</div>
                                        </div>
                                    </div>
                                </a>
                        <?php 
                                }
                            } else {
                                echo "<div class='info-det'>No followed accounts found.</div>";
                            }
                        ?>

                    </div>
                </div>
            </div>
            <?php } ?>
            <?php 
                if(!empty($user_id)){
            ?>
            <div class="nav-icon following"><i class="fas fa-bell"></i><span>Notifications</span>
                <div class="hover-div">
                    <div class="followed-div">
                        <div class="title">Notifications</div>
                        <?php 
                            $queryNotif = "SELECT tn.*, td.full_name, td.profile_img FROM tbl_notifications tn
                            JOIN tbl_account_details td ON tn.user_id = td.acc_id
                            WHERE tn.acc_id = ? ORDER BY tn.notif_date DESC LIMIT 3";
                            $stmtNotif = $conn->prepare($queryNotif);
                            $stmtNotif->bind_param('i', $user_id);
                            $stmtNotif->execute();
                            $resultNotif = $stmtNotif->get_result();

                            if($resultNotif->num_rows > 0){
                                while($rowNotif = $resultNotif->fetch_assoc()){
                        ?>
                        <a href="./profileDashboard.php?acc_id=<?php echo $rowNotif["user_id"] ?>">
                            <div class="info-det">
                                <div class="img-con">
                                    <img src="../<?php echo htmlspecialchars(str_replace("../", "", $rowNotif["profile_img"])); ?>" 
                                        alt="Profile Image"
                                        style="border-radius: 100%; object-fit: cover; height: 36px; width: 42px;">
                                </div>
                                <div class="name">
                                    <?php echo htmlspecialchars($rowNotif["full_name"]); ?>
                                    <div class="author">
                                        <?php echo htmlspecialchars($rowNotif["notif_activity"]); ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php 
                                }
                            }else{
                                echo "<div class='info-det'>No notifications found.</div>";
                            }
                        ?>

                    </div>
                </div>
        </div>
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

const searchBtn = document.getElementById('searchBtn');

searchBtn.addEventListener('click', (e) => {
    const search = document.getElementById('search').value;
    if (search) {
        window.location.href = `./searched.php?search=${search}`;
    }
});

</script>