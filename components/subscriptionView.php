<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/subscriptionView.css">
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/spaces.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Subscription</title>
</head>
<body>
<?php include 'header.php'; ?>
    <div id="grid-con">
        <div class="space" style="margin-top: 77px;">
            <?php include 'spaces.php'; ?>
        </div>

        <?php 
            $user_id = '';
            if(isset($_SESSION['user_id'])){
                $user_id = $_SESSION['user_id'];
            } else {
                header('Location: ./subscription.php');
                exit();
            }
        ?>
        <div class="center" id="main-con">
            <div class="center">
                <div class="container">
                    <div class="title">
                        Subscription
                        <i class="fa-solid fa-feather-pointed"></i>
                    </div>
                    <?php 
                        $subs_id = '';
                        $query = "SELECT * FROM tbl_subscription WHERE acc_id = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param('i', $user_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $start_month = '';
                        $end_month = '';
                        if($result->num_rows > 0){
                            $row = $result->fetch_assoc();
                            $start_month = date('F m, Y', strtotime($row['subs_start_month']));
                            $end_month = date('F m, Y', strtotime($row['subs_end_month']));
                            $subs_id = $row['subs_id'];
                        }
                        
                    ?>

                    <div>
                        <!-- start date -->
                        <div class="sub-details">
                            <div class="sub-title">Start Date: </div>
                            <div class="sub-value"><?php echo $start_month ?></div>
                        </div>
                        <div class="flex">
                            <hr>
                            start / end
                            <hr>
                        </div>
                        <!-- end date -->
                        <div class="sub-details">
                            <div class="sub-title">End Date: </div>
                            <div class="sub-value"><?php echo $end_month ?></div>
                        </div>
                    </div>
                    
                    <!-- button cancel -->
                    <div class="sub-details">
                        <button class="cancel-sub" 
                        data-subs-id="<?php echo $subs_id; ?>">Cancel Subscription</button>
                    </div>
                        
                </div>
            </div>

        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="../js/sidebar.js"></script>
    <script src="../jquery/cancelSubs.js"></script>

<script>

    if(localStorage.getItem('userDetails') != null){
        const userDetails = JSON.parse(localStorage.getItem('userDetails'));
        document.querySelector('.email').innerHTML = userDetails.acc_email;
    }

    
</script>
</body>
</html>