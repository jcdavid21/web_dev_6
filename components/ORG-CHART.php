<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar with Sidebar</title>
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Basic styling for the navbar */
        body {
            margin: 0;
            padding: 0;
            font-family: 'DM Sans', sans-serif;
            background: #f5f4ed;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensure full height */
        }
        .logo img {
            height: 50px;
            width: 50px;
            border-radius: 60%;
            border: 1px solid #010000;
            margin-left: 25px;
        }
        .category-icon {
            margin-left: 15px; /* Adjust spacing as needed */
            font-size: 24px; /* Adjust size of the icon */
            color: #333; /* Change color as needed */
        }

        /* Tooltip styling */
        .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
            position: absolute;
            z-index: 1;
            bottom: 100%; /* Position above the icon */
            left: 50%;
            margin-left: -60px; /* Center the tooltip */
            opacity: 0;
            transition: opacity 0.3s;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }

        /* Other existing styles remain unchanged... */

        .org-chart {
            text-align: center;
            padding: 70px 20px; /* Add top padding to avoid overlap with the fixed header */
            position: relative;
        }

        .org-chart h1 {
            font-size: 36px;
            color: #FFAB00;
            margin-bottom: 40px;
        }

        /* Team Leader Styles */
        .leader {
            position: relative;
            margin-bottom: 30px;
            grid-column: 3; /* Align the leader directly above the third column (Content Manager) */
        }

        .leader img {
            width: 130px;
            height: 130px;
            border-radius: 0;
            margin-bottom: 10px;
            border: 2px solid #f6a425;
        }

        .leader h3 {
            font-size: 18px;
            margin: 10px 0;
            font-weight: 500;
        }

        .leader p {
            font-size: 16px;
            color: gray;
            font-weight: 500;
        }

        /* Line connecting team leader to the horizontal line */
        .leader::after {
            content: '';
            position: absolute;
            width: 2px;
            height: 20px; /* Adjusted to match the height to the horizontal line */
            background-color: #FFAB00;
            left: 50%;
            top: 60%;
            transform: translateX(-50%);
        }

        /* Team Members */
        .members {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            grid-template-rows: 1fr;
            grid-gap: 40px;
            position: relative;
            margin-top: 50px;
        }

        .member {
            text-align: center;
            position: relative;
        }

        .member img {
            width: 100px;
            height: 100px;
            border-radius: 0;
            margin-bottom: 3px; /* Reduced margin for closer positioning */
            border: 2px solid #f6a425;
        }

        .member h3 {
            font-size: 18px;
            margin: 5px 0;
            font-weight: 500;
        }

        .member p {
            font-size: 16px;
            color: gray;
            margin-top: 1px; 
        }

        /* Horizontal line connecting the members */
        .members::before {
            content: '';
            position: absolute;
            top: -50px; /* Adjusted to align with the leader's vertical line */
            left: 9%; /* Adjusted for line alignment */
            right: 9%; /* Adjusted for line length */
            height: 2px;
            background-color: #FFAB00;
        }

        /* Vertical lines connecting each member to the horizontal line */
        .member::before {
            content: '';
            position: absolute;
            width: 2px;
            height: 50px;
            background-color: #FFAB00;
            top: -50px; /* Connects to the horizontal line */
            left: 50%;
            transform: translateX(-50%);
        }
        .grid-con{
            display: grid;
            grid-template-columns: 260px 1fr 0;
            align-items: start;
            justify-content: center;
            margin-top: 80px;
        }
    </style>
</head>

<body>
   <?php include 'header.php'; ?>
    <!-- Organizational Chart -->
     <div class="center">
     <div class="org-chart">
            <h1>Organizational Chart</h1>

            <!-- Team Leader -->
            <div class="leader">
                <img src="../chart/alvin.jfif" alt="Team Leader">
                <h3>JOHN ALVIN OFEMIA</h3>
                <p><i>Team Leader</i></p>
            </div>

            <!-- Team Members -->
            <div class="members">
                <div class="member">
                    <img src="../chart/CHESKA.jfif" alt="Member 1">
                    <h3>CHESCA F. ROSALES</h3>
                    <p><i>Information Architect</i></p>
                </div>
                <div class="member">
                    <img src="../chart/me.jfif" alt="Member 2">
                    <h3>LUSTER JAY ANDAYA</h3>
                    <p><i>UI/UX Designer</i></p>
                </div>
                <div class="member">
                    <img src="../chart/ghille.jfif" alt="Member 3">
                    <h3>GHILLE ABIGAIL SANTOS</h3>
                    <p><i>Content Manager</i></p>
                </div>
                <div class="member">
                    <img src="../chart/pat.jfif" alt="Member 4">
                    <h3>PATRICK LEE CHUA</h3>
                    <p><i>Front-end Developer</i></p>
                </div>
                <div class="member">
                    <img src="../chart/felix.jfif" alt="Member 5">
                    <h3>FELIX NARIO II</h3>
                    <p><i>Back-end Developer</i></p>
                </div>
            </div>
        </div>
     </div>

    <?php include 'footer.php'; ?>
    <script src="../js/sidebar.js"></script>
</body>
</html>
