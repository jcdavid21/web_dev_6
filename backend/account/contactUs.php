<?php

    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require "../../PHPMailer/src/Exception.php";
    require "../../PHPMailer/src/PHPMailer.php";
    require "../../PHPMailer/src/SMTP.php";

    require_once("../config/config.php");

    if(isset($_POST["message"]) && $_POST["email"])
    { 
            $mail = new PHPMailer();
            $email = $_POST["email"];
            $name = $_POST["name"];
            $message = $_POST["message"];

            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = 'deepdiveest24@gmail.com';
            $mail->Password = "qupw ciaf rspp xodm";
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('deepdiveest24@gmail.com');
            $mail->addAddress("rosaleschesca1@gmail.com");

            $mail->isHTML(true);
            $mail->Subject = "User Feedback";
            $mail->Body = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Message</title>
</head>
<body style='font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;'>
    <div style='max-width: 600px; margin: 20px auto; background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);'>
        <h1 style='color: #333333; font-size: 24px; text-align: center;'>User Feedback</h1>
        <p style='color: #555555; font-size: 16px; line-height: 1.5;'>
            <strong>Name:</strong> {$name}
            <br>
            <strong>Email:</strong> {$email}
            <br>
            {$message}
        </p>
        <div style='margin-top: 20px; text-align: center; font-size: 12px; color: #999999;'>
            <p>&copy; 2024 DeepDive. All Rights Reserved.</p>
        </div>
    </div>
</body>
</html>
";


            if ($mail->send()) {
                echo 'success';
            } else {
                echo 'Error: ' . $mail->ErrorInfo;
            }

        exit();
    }
?>
