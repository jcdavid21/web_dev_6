<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/spaces.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #f6a425, #ffffff); /* Gradient from #f6a425 to white */
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        
        /* FOOTER */

        /* ABOUT US */

        .about-us-container {
            background-color: white;
            padding:  10px;
            color: #f6a425;
            text-align: left; /* Align text to the left */
            width: 40%; 
            margin: 50px; /* Add some space around the section */
            margin-top: 100px;
            position: relative;
            border-radius: 12px;
            border: 2px solid black;
        }
        .about-us-container h2 {
            margin: 30px ;
            font-size: 36px;
            font-weight: bold;
            color: #f6a425;
        }
        .about-us-container p {
            font-size: 13.5px;
            line-height: 1.6;
            color: #333;
            margin: 30px ;
            text-align: justify;
        }
        .about-us-container .learn-more-btn {
            background-color: #f6a425; /* Keep the button with this color */
            color: white;
            padding: 15px 39px;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            font-size: 14.5px;
            border-radius: px;
            margin: 20px auto; /* Center the button */
            text-decoration: none;
            display: block; /* Change to block to allow centering */
            width: fit-content; /* Adjust width to fit content */
        }
        .about-us-container .learn-more-btn:hover {
            background-color: #000000;
        }

        .center .container{
            max-width: 1600px;
            width: 100%;
        }

        .center{
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .img-con{
            height: 500px;
        }

    </style>
</head>

<body>

    <?php include "header.php"  ?>
    <!-- Sidebar -->
    <!-- About Us Container -->
     <div class="center">
        <div class="container">
            <div class="center">
            <section class="about-us-container">
                <h2>About Us</h2>
                <p> 
                    CyberSix founded Deep Dive in 2024 with a simple yet
                    powerful vision: to be a dynamic space where ideas, creativity,
                    and meaningful discussions thrive in the digital world. In a time
                    where social platforms are crowded and meaningful
                    engagement is often lost in the noise, Deep Dive stands apart
                    as a forum and blogging site dedicated to fostering genuine
                    connections and thoughtful conversations.
                </p>
                <a href="#" class="learn-more-btn">Learn More</a> 
            </section>
            <div class="img-con">
                <img src="../imgs/about-us.webp" alt="">
            </div>
        </div>
        </div>
     </div>

    <?php include "footer.php"  ?>
    
    <script src="../js/sidebar.js"></script>
</body>
</html>