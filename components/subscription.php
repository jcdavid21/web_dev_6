<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/subscription.css">
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
            } 

            $querySubsCheck = "SELECT * FROM tbl_subscription WHERE acc_id = ?";
            $stmtSubsCheck = $conn->prepare($querySubsCheck);
            $stmtSubsCheck->bind_param('i', $user_id);
            $stmtSubsCheck->execute();
            $resultSubsCheck = $stmtSubsCheck->get_result();

            if($resultSubsCheck->num_rows >= 1)
            {
                echo "<script>window.location.href='./subscriptionView.php'</script>";
            }
        ?>
        <div class="center" id="main-con">
            <div class="center">
                <div class="container">
                    <div class="title">
                        BE A WRITER
                        <i class="fa-solid fa-feather-pointed"></i>
                    </div>
                    <strong>Upgrade to Deep Dive's best blogging services.</strong>
                    <div class="text">
                        <span>Free 7 day trial.</span>
                        Cancel anytime. We’ll send an email to remind you 2 days before trial ends.
                    </div>

                    <div class="flex">
                        <div class="flex-con">
                            <div class="date">Monthly</div>
                            <div>Pay monthy, cancel anytime</div>
                        </div>

                        <div><span>₱300</span>/month</div>
                    </div>

                    <div class="flex">
                        <hr>
                        or
                        <hr>
                    </div>

                    <div class="flex">
                        <div class="flex-con">
                            <div class="date">Yearly</div>
                            <div>Pay yearly</div>
                        </div>

                        <div><span>₱2,500</span>/year</div>
                    </div>

                    <div class="button-con">
                        <button>Start your 7-days free trial</button>
                    </div>
                </div>
            </div>
            <div class="center">
                <div class="container con-2">
                    <div class="back"><i class="fa-solid fa-chevron-left"></i></div>
                    <strong>Try being a writer for free</strong>
                    <div class="text">
                        <span><i class="fa-solid fa-check"></i></span>
                        Free 7 day trial, cancel anytime
                    </div>
                    <div class="text">
                        <span><i class="fa-solid fa-check"></i></span>
                        Email will remind you before your trial ends
                    </div>
                    <div class="select">
                        <div class="flex">
                            <input type="radio" name="subs" id="monthly" data-subs-id="1" checked>
                            <div>
                                <span>Monthly</span>
                                <div class="price">₱300</div>
                            </div>
                        </div>
                        <div class="flex">
                            <input type="radio" name="subs" id="yearly" data-subs-id="2">
                            <div>
                                <span>Yearly</span>
                                <div class="price">₱2,500</div>
                            </div>
                        </div>
                    </div>

                    <div class="due-date">
                        <div class="flex">
                            <div id="due-text"><strong>Due (DD/MM/YY)</strong></div>
                            <div class="price" id="due-price">₱300</div>
                        </div>
                        <div class="flex">
                            <div><strong>Due today (DD/MM/YY)</strong></div>
                            <div class="price" id="due-today">₱300</div>
                        </div>
                    </div>
                    <div class="button-con">
                        <button>Start trial and subscribe</button>
                    </div>
                </div>
            </div>

            <div class="center">
                <div class="container dets">
                    <div class="back"><i class="fa-solid fa-chevron-left"></i></div>
                    <div class="details">
                        <div class="img-con">
                            <img src="../imgs/DDlogo.jpg" alt="">
                        </div>
                        <div class="text-details">
                            <div class="title">Deep Dive Pro</div>
                            <div class="email">
                                krizzy0919@gmail.com
                            </div>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-con">
                            <div>Starting today</div>
                        </div>

                        <div>1-week/free trial</div>
                    </div>

                    <div class="flex">
                        <div class="flex-con">
                            <div>Starting (<span class="dateToday">DD/MM/YY</span>)</div>
                        </div>

                        <div class="subsChecked">₱300</div>
                    </div>

                    <div class="desc">
                    Add a payment method to your email account to subscribe. You won’t be charged until your free trial has ended.
                    </div>

                    <div class="button-con">
                        <button>Subcribe</button>
                    </div>
                </div>
            </div>
            <div class="center">
                <div class="container dets">
                    <div class="flex-con">
                        <div class="back"><i class="fa-solid fa-chevron-left"></i></div>
                        <div class="gcash-back">
                            <div>Add Gcash</div>
                            <span>Deep Dive Pro</span>
                        </div>
                    </div>
                    <div class="input-field">
                        <input type="text" placeholder="Enter your email" id="emailInput" required />
                        <i class="fa-regular fa-envelope"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password" id="password" placeholder="Password" required />
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>
                    <div class="gcash-con">
                        <div class="img-con">
                            <img src="../imgs/gcash.png" alt="">
                        </div>
                        <input type="number" maxlength="11" id="gcashInput" placeholder="Gcash number">
                    </div>

                    <div class="receipt">
                        <div class="title">Upload Receipt</div>
                        <input type="file" id="receipt" accept="image/*" placeholder="Upload Receipt">
                    </div>

                    <div class="button-con">
                        <button class="submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="../js/sidebar.js"></script>
    <script src="../js/signup.js"></script>
    <script>
       document.addEventListener("DOMContentLoaded", () => {
    const containers = document.querySelectorAll("#main-con .center");
    let currentIndex = 0;

    // Display the first container initially
    containers[currentIndex].classList.add("active");

    // Function to show the next container when the button is clicked
    function showNextContainer() {
        if (currentIndex < containers.length - 1) {
            containers[currentIndex].classList.remove("active");
            currentIndex++;
            containers[currentIndex].classList.add("active");
        }
    }

    // Function to show the previous container when the back button is clicked
    function showPreviousContainer() {
        if (currentIndex > 0) {
            containers[currentIndex].classList.remove("active");
            currentIndex--;
            containers[currentIndex].classList.add("active");
        }
    }

    // Attach click event to all submit buttons to show the next container
    const submitButtons = document.querySelectorAll(".button-con button");
    submitButtons.forEach(button => {
        button.addEventListener("click", showNextContainer);
    });

    // Attach click event to the back button
    const backButtons = document.querySelectorAll(".back");
    backButtons.forEach(button => {
        button.addEventListener("click", showPreviousContainer);
    });
});


    </script>

<script>

    if(localStorage.getItem('userDetails') != null){
        const userDetails = JSON.parse(localStorage.getItem('userDetails'));
        document.querySelector('.email').innerHTML = userDetails.acc_email;
    }

    // Function to update the due date based on selected subscription
    function updateDueDate() {
        const monthlyRadio = document.getElementById('monthly');
        const yearlyRadio = document.getElementById('yearly');
        const dueText = document.getElementById('due-text');
        const duePrice = document.getElementById('due-price');
        const dueToday = document.getElementById('due-today');
        const subsChecked = document.querySelector('.subsChecked');
        const dateToday = document.querySelector('.dateToday');

        if (monthlyRadio.checked) {
            // If Monthly is selected
            dueText.innerHTML = "<strong>Due (DD/MM/YY)</strong>";
            duePrice.innerText = "₱300";
            dueToday.innerText = "₱300";
            subsChecked.innerText = "₱300";
        } else if (yearlyRadio.checked) {
            // If Yearly is selected
            dueText.innerHTML = "<strong>Due (DD/MM/YY)</strong>";
            duePrice.innerText = "₱2,500";
            dueToday.innerText = "₱2,500";
            subsChecked.innerText = "₱2,500";
        }

        // Get the current date
        const today = new Date();

        // Format the date to "Dec 10, 2024"
        const options = { month: 'short', day: 'numeric', year: 'numeric' };
        const formattedDate = today.toLocaleDateString('en-US', options);

        dateToday.innerText = formattedDate;


    }

    // Add event listeners to update the due date when a user changes the subscription option
    document.querySelectorAll('input[name="subs"]').forEach(radio => {
        radio.addEventListener('change', updateDueDate);
    });

    // Initialize the due date on page load
    updateDueDate();
</script>
<script src="../jquery/subscription.js"></script>
</body>
</html>