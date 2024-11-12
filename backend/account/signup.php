<?php 
require_once("../config/config.php");

if(isset($_POST["full_name"]) && isset($_POST["email"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["gender"]) && isset($_POST["birthdate"])) {
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $gender = $_POST["gender"];
    $birthdate = $_POST["birthdate"];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query1 = "SELECT acc_email, acc_username FROM tbl_account WHERE acc_email = ? AND acc_username = ?";
    $stmt1 = $conn->prepare($query1);
    $stmt1->bind_param("ss", $email, $username);
    $stmt1->execute();
    $result = $stmt1->get_result();

    if($result->num_rows > 0) {
        return "existed";
    }

    $query2 = "INSERT INTO tbl_account(acc_email, acc_username, acc_password) VALUES(?, ?, ?)";
    $stmt2 = $conn->prepare($query2);
    $stmt2->bind_param("sss", $email, $username, $hashed_password);
    $stmt2->execute();

    $account_id = $stmt2->insert_id;

    $query3 = "INSERT INTO tbl_account_details(acc_id, full_name, birthdate, gender) VALUES(?, ?, ?, ?)";
    $stmt3 = $conn->prepare($query3);
    $stmt3->bind_param("isss", $account_id, $full_name, $birthdate, $gender);
    $stmt3->execute();

    return "success";
    

}

?>