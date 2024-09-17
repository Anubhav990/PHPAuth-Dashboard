<?php 
// if(session_status() == PHP_SESSION_NONE){
//     session_start();
// }

// include("../../db/connection.php");
// require_once('../conf/configuration.php');

// $base_dir = __DIR__;
// $doc_root = $_SERVER['DOCUMENT_ROOT'];
// $constants = require './../../src/lib/constants.php';
// $constants = require __DIR__ . '/../../src/lib/constants.php';
// $real_path = realpath(__DIR__ . '/Anubhavphpprac/src/middlwares/HasAccess.php/./../../src/lib/constants.php');
// echo $real_path;

// $path = 'E:\Xampp_Learning\htdocs\Anubhavphpprac\src\lib\constants.php';
// $path = '../../src/lib/constants.php';

$constants = require 'E:\Xampp_Learning\htdocs\Anubhavphpprac\src\lib\constants.php';

if(isset($_SESSION['user_id'])){
    $userId = $_SESSION['user_id'];
}else{
    echo "User id not set";
    exit();
}

function hasAccess($userId, $requestedPage){
    global $conn;

    //fetching user role from the database

    $sql = "SELECT * FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_details = $result->fetch_assoc();

    // echo ", user id is ". $userId;

    if($user_details){
        $role = $user_details['role'];

        //checking permissions table for the role
    $permissionQuery = "SELECT * FROM permissions WHERE role = ? AND pages = ?";
    $permissionStmt = $conn->prepare($permissionQuery);
    $permissionStmt->bind_param("ss", $role, $requestedPage);
    $permissionStmt->execute();
    $permissionResult = $permissionStmt->get_result();

    return $permissionResult->num_rows > 0;

    }

    return false;
}

// $userId = $_SESSION['user_id'];
// $requestedPage = basename($_SERVER['PHP_SELF']);

$requestedPage = basename($_SERVER['PHP_SELF'],".php");
// echo $requestedPage;
// Debugging requested page
// echo "Requested Page: " . $requestedPage;

if(!hasAccess($userId, $requestedPage)){
    header("Location: ". $constants['paths']['AccessDenied']);
    echo", access denied";
    exit();
}


?>