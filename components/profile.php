<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/profile.css">
    <title>Profile</title>
</head>
<body>
    <?php
        // Fetch user data from the database
        $query = "SELECT full_name, job, birthdate, gender, profile_img FROM tbl_account_details WHERE acc_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $user_data = $result->fetch_assoc();
        $age = null;
        if ($user_data && $user_data['birthdate']) {
            $birthDate = new DateTime($user_data['birthdate']);
            $today = new DateTime();
            $age = $today->diff($birthDate)->y; // Calculate age
        }
    ?>

    <div class="profile-con">
        <div class="profile-center">
            <div class="img-con">
                <img src="<?php echo $user_data['profile_img'] ? $user_data['profile_img'] : '../imgs/no-profile.png'; ?>" alt="Profile Picture">
            </div>
        </div>
        <div class="p-info">
            <div class="title">Personal Information</div>
            <div class="details">
                <div>Name: <span class="full_name"><?php echo htmlspecialchars($user_data['full_name']); ?></span></div>
                <div>Job Title: <span class="job"><?php echo htmlspecialchars($user_data['job'] ?: 'N/A'); ?></span></div>
                <div>Age: <span class="age"><?php echo $age ? $age : 'N/A'; ?></span></div>
                <div>Gender: <span class="gender"><?php echo htmlspecialchars($user_data['gender']); ?></span></div>
            </div>
            <?php 
                if(!empty($user_id)){
            ?>
            <a href="./account.php">
                <div class="edit">
                    <button id="edit-profile">Edit</button>
                </div>
            </a>
            <?php } ?>
        </div>

        <div class="credentials">
            <div class="title">Credentials</div>
            <form id="add-credential-form">
                <input type="text" id="new-credential" placeholder="Add a new credential" required>
                <button type="button" id="add-credential-btn">Add</button>
            </form>
            <ul id="credential-list">
                <?php 
                    $query = "SELECT credential_title FROM tbl_credentials WHERE acc_id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param('i', $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            echo "<li>" . htmlspecialchars($row['credential_title']) . 
                                 " <i class='fa-solid fa-minus delete-credential' style='color: red;' data-title='" . htmlspecialchars($row['credential_title']) . "'></i></li>";
                        }                        
                    }else{
                        echo "<li>No credentials added yet</li>";
                    }
                ?>
            </ul>
        </div>


        <div class="soc-media">
            <div class="title">Social Media</div>
            <div class="icons">
                <i class="fab fa-facebook"></i>
                <i class="fab fa-twitter"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-linkedin"></i>
            </div>
        </div>

        <div class="out-div">
            <a href="../backend/account/logout.php"><button>Log out</button></a>
        </div>
    </div>
</body>
</html>
<script src="../jquery/addCredentials.js"></script>
