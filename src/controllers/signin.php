<?php
session_start();
include("../../db/connection.php");

$email = $_POST["email"];
$password = $_POST["password"];

// Use prepared statements to avoid SQL injection
$stmt = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Verify the password.

    // output data of each row
    $row = $result->fetch_assoc();

        if(password_verify($password, $row["password"])){
            //sucessful login
            // $user_id = $_SESSION['id'];
            $_SESSION['user_id'] = $row["id"];
            header("Location: ../views/dashboard.php");
            exit();
        }else{
            //password does not match
            header("Location: ../views/auth/index.php");
            exit();
        }  
}else{
    //email not found
    header("Location: ../views/auth/index.php");
    exit();
}

$stmt->close();
$conn->close();



?>
