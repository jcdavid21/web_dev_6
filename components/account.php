<!DOCTYPE html>
<?php require_once("../backend/config/config.php") ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/account.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <?php include 'header.php'; ?>
    <?php 
        if(empty($_SESSION['user_id'])){
            header('Location: ./signup.php');
        }
    ?>
    <?php 
        $query = "SELECT ta.acc_id, ta.acc_username, ta.role_id,
        td.full_name, td.birthdate, td.gender, td.job, td.profile_img,
        tr.role_name FROM tbl_account ta 
        JOIN tbl_account_details td ON ta.acc_id = td.acc_id
        JOIN tbl_role tr ON ta.role_id = tr.role_id
        WHERE ta.acc_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        if($result->num_rows > 0){
            $data = $result->fetch_assoc();
        }
    ?>
    <div class="center">
        <div class="container">
            <div class="forms">
                <div class="form login">
                    <span class="title">Profile</span>
                    <form action="#">
                        <div class="center">
                            <div style="display: flex; align-items:center; flex-direction:column;">
                            <div class="profile-img">
                                <img id="profileImage" src="<?php echo $data["profile_img"] ? $data["profile_img"] : '../imgs/no-profile.png' ?>" alt="Profile Picture">
                            </div>
                            <input type="file" id="profile">
                            </div>
                        </div>
                        <div class="grid-con">
                            <div class="input-field">
                                <input type="text" id="full_name" placeholder="Full name"
                                value="<?php echo $data["full_name"] ?>"
                                 required />
                                <i class="fa-regular fa-user"></i>
                            </div>
                            <div class="input-field">
                                <input type="password" id="password" class="password" placeholder="Enter your password" required />
                                <i class="uil uil-lock icon"></i>
                            <i class="uil uil-eye-slash showHidePw"></i>
                            </div>
                            <div class="input-field">
                                <input type="text" id="gender"
                                value="<?php echo $data["gender"] ?>"
                                 placeholder="Enter your gender" required />
                                <i class="fa-solid fa-venus-mars"></i>
                            </div>
                            <div class="input-field" >
                                <input type="date" id="birth-date" required
                                value="<?php echo $data["birthdate"] ?>"
                                 />
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                            <div class="input-field">
                                <input type="text" id="job" placeholder="Enter your job"
                                value="<?php echo $data["job"] ?>"
                                 required />
                                <i class="fa-solid fa-briefcase"></i>
                            </div>
                        </div>
                        <div class="input-field button">
                            <input type="button" id="submit" value="Update" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php'; ?>
<script src="../js/sidebar.js"></script>
<script src="../jquery/updateProfile.js"></script>
<script>
    document.getElementById("profile").addEventListener("change", function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            document.getElementById("profileImage").src = e.target.result;
        };

        reader.readAsDataURL(file);
    }
});

</script>
</body>
</html>
