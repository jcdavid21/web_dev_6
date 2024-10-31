<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset password</title>
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/resetpass.css">
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/spaces.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <?php include 'header.php'; ?>

    <div class="center">
        <div class="container">
        <div class="forms">
            <div class="form login">
            <span class="title">Forgot password</span>
            <div class="text">
            Enter your email address  and we will send you a
            verification a code to reset your password.
            </div>
            <form action="#">
                <div class="input-field">
                <input type="text" placeholder="Enter your email" required />
                <i class="uil uil-envelope icon"></i>
                </div>
                <div class="input-field">
                <div class="input-field button">
                <input type="button" value="Send code" />
                </div>
            </form>
            </div>
    </div>

<script src="../js/sidebar.js"></script>
<script src="../js/signup.js"></script>
</body>
</html>
