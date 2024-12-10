<?php 
    
    require_once("../config/config.php");
    session_start();
    if(isset($_POST["subscriptionType"]) && isset($_POST["email"]) && isset($_POST["password"])
    && isset($_POST["gcashNumber"]))
    {
        $subscriptionType = $_POST["subscriptionType"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $gcashNumber = $_POST["gcashNumber"];
        $acc_id = $_SESSION["user_id"];
        $start_date = '';
        $end_date = '';

        // subscriptionType = 1 -> 1 month
        // subscriptionType = 2 -> 1 Year

        if($subscriptionType == 1)
        {
            $start_date = date('Y-m-d');
            $end_date = date('Y-m-d', strtotime($start_date. ' + 1 month'));
        }
        else if($subscriptionType == 2)
        {
            $start_date = date('Y-m-d');
            $end_date = date('Y-m-d', strtotime($start_date. ' + 1 year'));
        }

        //check if the email and password is same with the current user
        $query = "SELECT * FROM tbl_account WHERE acc_id = ? AND acc_email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("is", $acc_id, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            if(password_verify($password, $row["acc_password"]))
            {

                $itemImgPath = null;
                if (!empty($_FILES['receipt']['name'])) {
                    $targetDir = "../../imgs/receipts/";
                    $fileName = basename($_FILES['receipt']['name']);
                    $targetFilePath = $targetDir . $fileName;
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            
                    // Validate file type
                    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                    if (!in_array(strtolower($fileType), $allowedTypes)) {
                        echo "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
                        exit;
                    }
            
                    // Move uploaded file
                    if (move_uploaded_file($_FILES['receipt']['tmp_name'], $targetFilePath)) {
                        $itemImgPath = $targetFilePath;
                    } else {
                        echo "Error uploading the image.";
                        exit;
                    }
                }


                $query2 = "INSERT INTO tbl_subscription (subs_type, subs_start_month, subs_end_month, subs_receipt_img, acc_id) VALUES (?, ?, ?, ?, ?)";
                $stmt2 = $conn->prepare($query2);
                $stmt2->bind_param("isssi", $subscriptionType, $start_date, $end_date, $itemImgPath, $acc_id);
    
                if($stmt2->execute())
                {
                    echo "success";
                }
                else
                {
                    echo "failed";
                }
            }
            else
            {
                echo "incorrect";
            }
        }
        else
        {
            echo "incorrect";
        }
    
    }
?>