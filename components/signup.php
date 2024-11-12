<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/signup.css">
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/spaces.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <?php include 'header.php'; ?>

    <div class="center">
        <div class="container">
        <div class="forms">
            <div class="form login">
            <span class="title">Login</span>
            <form action="#">
                <div class="input-field">
                <input type="text" id="log_email" placeholder="Enter your email" required />
                <i class="uil uil-envelope icon"></i>
                </div>
                <div class="input-field">
                <input type="password" id="log_password" class="password" placeholder="Enter your password" required />
                <i class="uil uil-lock icon"></i>
                <i class="uil uil-eye-slash showHidePw"></i>
                </div>
                <div class="checkbox-text">
                <div class="checkbox-content">
                    <input type="checkbox" id="logCheck" />
                    <label for="logCheck" class="text">Remember me</label>
                </div>
                <a href="./forgotpass.php" class="text">Forgot password?</a>
                </div>
                <div class="input-field button">
                <input type="button" id="submit" value="Login" />
                </div>
            </form>
            <div class="login-signup">
                <span class="text"
                >Not a member?
                <a href="#" class="text signup-link">Signup Now</a>
                </span>
            </div>
            </div>
            <!-- Registration Form -->
            <div class="form signup">
            <span class="title">Sign up</span>
            <form action="#">
                <div class="input-field">
                <input type="text" id="name" placeholder="Enter your name" required />
                <i class="uil uil-user"></i>
                </div>
                <div class="input-field">
                <input type="text" id="gender" placeholder="Enter your gender" required />
                <i class="fa-solid fa-venus-mars"></i>
                </div>
                <div class="input-field" >
                    <input type="date" id="birth-date" placeholder="Enter your email" required />
                    <i class="fa-solid fa-calendar-days"></i>
                </div>
                <div class="input-field">
                <input type="text" id="email" placeholder="Enter your email" required />
                <i class="uil uil-envelope icon"></i>
                </div>
                <div class="input-field">
                <input type="text" id="username" placeholder="Enter your username" required />
                <i class="fa-regular fa-circle-user"></i>
                </div>
                <div class="input-field">
                <input type="password" id="password" class="password" placeholder="Password" required />
                <i class="uil uil-lock icon"></i>
                <i class="uil uil-eye-slash showHidePw"></i>
                </div>
                <div class="checkbox-text">
                <div class="checkbox-content">
                    <input type="checkbox" id="termCon" />
                    <label for="termCon" class="text">I accepted all terms and conditions</label>
                </div>
                </div>
                <div class="input-field button">
                <input type="button" id="signup" value="Signup" />
                </div>
            </form>
            <div class="login-signup">
                <span class="text"
                >Already a member?
                <a href="#" class="text login-link">Login Now</a>
                </span>
            </div>
            </div>
        </div>
        </div>
    </div>

<?php include 'footer.php'; ?>
<script src="../js/sidebar.js"></script>
<script src="../js/signup.js"></script>
<script src="../jquery/signup.js"></script>
<script src="../jquery/login.js"></script>
</body>
</html>
