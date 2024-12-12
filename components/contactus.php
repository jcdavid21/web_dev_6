<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/spaces.css">
    <link rel="stylesheet" href="../styles/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Contact Us</title>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="center">
        <div class="container">
            <div class="center">
                <div class="contact">
                    <div class="title">Contact Us</div>
                    <div class="text">We are here to help you. Please fill out the form below and we will get back to you as soon as possible.</div>
                    <div class="div">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" id="name" placeholder="Full name">
                    </div>

                    <div class="div">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="text" id="email" placeholder="Email">
                    </div>

                    <textarea name="message" id="message" >Message</textarea>
                    <div class="submit">
                        <button>Submit</button>
                    </div>
                </div>
                <div class="img-con">
                    <img src="../imgs/contact.png" alt="Contact Us">
                </div>

            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>

    <script src="../js/sidebar.js"></script>
    <script src="../jquery/contactUs.js"></script>
</body>
</html>