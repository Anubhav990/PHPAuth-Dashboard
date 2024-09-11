<?php
session_start();
include("../../../db/connection.php");

if(isset($_GET['user_id'])){
    $id = $_GET['user_id'];

    $stmt = $conn->prepare("DELETE FROM users where id= ?");
    $stmt->bind_param("i", $id);

    $deletion = ''; 
    $nondeletion = '';

    if($stmt->execute()){
    
        $_SESSION['deletionmessage'] = "Deleted successfully";
        header("Location: users.php");
        // echo  $_SESSION['deletionmessage'];
        // die;
        // $deletion = $_SESSION['deletionmessage'];
        
    }else{
        $_SESSION['notdeletion'] = "Error Deleting the record";
        // $nondeletion = $_SESSION['notdeletion'];
    }

    $stmt->close();

}else{
    $_SESSION['notdeletion'] = "No ID provided for deletion";
    // $nondeletion = $_SESSION['notdeletion'];
}

$conn->close();

?>