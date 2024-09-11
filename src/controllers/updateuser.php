<?php
session_start();
include("../../db/connection.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user_id = $_GET['id'];
    $firstname = $_POST['firstname'] ?? null;
    $lastname = $_POST['lastname'] ?? null;
    $email = $_POST['email'] ?? null;
    $Pnumber = $_POST['Pnumber'] ?? null;
    $company_name = $_POST['company_name'] ?? null;
    $best_time_to_contact = $_POST['best_time_to_contact'] ?? null;
    
    
    $stmt = $conn->prepare("UPDATE users SET firstname= ?, lastname=?, email=?, Pnumber=?, company_name=?, best_time_to_contact=? WHERE id=?");

    $stmt->bind_param("ssssssi", $firstname, $lastname, $email, $Pnumber, $company_name, $best_time_to_contact, $user_id);

    if($stmt->execute()){
        $_SESSION['successmessage'] = 'Details Edited Successfully';
        echo("done");
        header("Location: ../views/users/users.php");
        exit();
    }else{
        $_SESSION['failmessage'] = 'Failed Editing The Record';
        echo "failed";
    }

    $stmt->close();
}
$conn->close();


?>