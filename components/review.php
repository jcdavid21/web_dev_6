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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Review</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="center">
        <div class="container">
            <div class="center">
                <div class="contact">
                    <div class="title">Send us a review!</div>
                    <div class="stars">
                        Rating:
                        <i class="fa-solid fa-star" onclick="setRating(1)"></i>
                        <i class="fa-solid fa-star" onclick="setRating(2)"></i>
                        <i class="fa-solid fa-star" onclick="setRating(3)"></i>
                        <i class="fa-solid fa-star" onclick="setRating(4)"></i>
                        <i class="fa-solid fa-star" onclick="setRating(5)"></i>
                    </div>


                    <textarea name="message" id="message" rows="10"
                    cols="10">Feedback message here</textarea>
                    <div class="submit">
                        <button id="submitReview">Submit</button>
                    </div>
                </div>
                <div class="img-con">
                    <img src="../imgs/review.png" alt="Contact Us">
                </div>

            </div>

            <div class="reviews">
                <div class="title">Reviews</div>
                <div class="review-grid">
                    <?php 
                        $query = "SELECT tr.*, td.full_name, td.profile_img FROM tbl_reviews tr INNER JOIN tbl_account_details td ON tr.acc_id = td.acc_id";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                    ?>

                    <div class="review-con">
                        <div class="details">
                            <div class="user-flex">
                                <div class="user-con">
                                    <img src="../../<?php echo 
                                    str_replace("../", "", $row["profile_img"]) ?>" alt="">
                                </div>
                                <div class="user-details">
                                    <div class="name">
                                        <?php echo $row['full_name'] ?>
                                    </div>
                                    <div class="rate">
                                        <?php 
                                            for($i = 0; $i < $row['review_star']; $i++){
                                                echo '<i class="fa-solid fa-star filled"></i>';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="date">
                                <?php echo date('F d, Y', strtotime($row['review_date'])) ?>
                            </div>
                        </div>
                        <div class="message">
                            <?php echo $row['review_message'] ?>
                        </div>
                    </div>
                    <?php 
                            }
                        }else{
                            echo "<div class='no-reviews'>No reviews available.</div>";
                        }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script>
        let stars_number = 0;
        function setRating(rating) {
            // Select all stars
            const stars = document.querySelectorAll('.stars i');
            stars_number = rating;
            // Loop through each star to update its state
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('filled'); // Apply filled class to selected stars
                } else {
                    star.classList.remove('filled'); // Remove filled class from unselected stars
                }
            });
        }
    </script>

    <script src="../js/sidebar.js"></script>
    <script src="../jquery/reviews.js"></script>
</body>
</html>