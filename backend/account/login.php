<?php 
require("../config/config.php");
session_start();
if(isset($_POST["email"]) && isset($_POST["password"]))
{
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query1 = "SELECT ta.acc_id, ta.acc_email, ta.acc_username, ta.acc_password, ta.role_id, td.full_name, td.birthdate, td.gender FROM tbl_account ta 
    INNER JOIN tbl_account_details td ON ta.acc_id = td.acc_id
     WHERE ta.acc_email = ?";
    $stmt1 = $conn->prepare($query1);
    $stmt1->bind_param("s", $email);
    $stmt1->execute();
    $result = $stmt1->get_result();

    if($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $hashed_password = $row["acc_password"];

        if(password_verify($password, $hashed_password))
        {
            $role_id = $row["role_id"];
            $sessionData = array(
                "acc_id" => $row["acc_id"],
                "acc_email" => $row["acc_email"],
                "acc_username" => $row["acc_username"],
                "role_id" => $row["role_id"],
                "birthdate" => $row["birthdate"],
                "gender" => $row["gender"],
                "full_name" => $row["full_name"],
                "job_title" => $row["job"],
                "profile_img" => $row["profile_img"]
            );

            if($role_id == 1){
                $_SESSION["user_id"] = $row["acc_id"];
            }else{
                $_SESSION["admin_id"] = $row["acc_id"];
            }

            echo json_encode($sessionData);
        }
        else
        {
            echo "invalid";
        }
    }
    else
    {
        echo "invalid";
    }
}

?>