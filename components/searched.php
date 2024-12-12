<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/createblog.css">
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/spaces.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Create Blog</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php 
    $user_id = '';
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    } else {
        header('Location: ./signup.php');
        exit();
    } ?>

    <div id="grid-con" class="overflow-hidden">
        <div class="space">
            <?php include 'spaces.php'; ?>
        </div>
        <div class="center">
            <div class="container">
                <div class="flex items-center justify-between">
                    <div class="title">Results</div>
                </div>
                <div class="searched">
                    <?php 
                        $search = $_GET['search'];

                        if(isset($_GET['search'])){
                            $search = $_GET['search'];
                            $search = '%' . $search . '%';
                            $query = "SELECT ts.*, td.full_name FROM tbl_spaces ts 
                            INNER JOIN tbl_account_details td ON ts.acc_id = td.acc_id WHERE space_name LIKE ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param('s', $search);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                    ?>
                    <div class="cont-search">
                        <div class="container-search">
                            <div class="img-con">
                                <img src="../<?php echo str_replace("../", "", $row["space_img"]) ?>" alt="">
                            </div>
                            <div class="name">
                                <div class="space_name">
                                    <?php echo $row["space_name"] ?>
                                </div>
                                <div class="space_owner">
                                    <span style="font-weight: 500;">Owner:</span> <?php echo $row["full_name"] ?>
                                </div>
                            </div>
                        </div>
                        <div class="btn-view">
                            <a href="./spacesPost.php?space_id=<?php echo $row["space_id"] ?>">
                                <button>View Space</button>
                            </a>
                        </div>
                    </div>
                    <?php 
                            }
                        } else {
                            echo "No results found";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- profile -->
        <?php include 'profile.php'; ?>
    </div>

    <?php include 'footer.php'; ?>
    <script src="../js/sidebar.js"></script>
    
</body>
</html>
