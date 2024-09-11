<?php
session_start();
include("../../db/connection.php"); // Include your database connection

$error_message = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $firstname = $_POST['firstname'] ?? null;
    $lastname = $_POST['lastname'] ?? null;
    $email = $_POST['email'] ?? null;
    $Pnumber = $_POST['Pnumber'] ?? null;
    $company_name = $_POST['company_name'] ?? null;
    $best_time_to_contact = $_POST['best_time_to_contact'] ?? null;
    $message = $_POST['message'] ?? null;
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT) ?? null;

    // Check if email already exists
    $check_email_stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check_email_stmt->bind_param("s", $email);
    $check_email_stmt->execute();
    $result = $check_email_stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION["Error"] = true;
        $_SESSION["message"] = "This email has already been registered. Register with different account.";
        header("Location: ../../src/views/users/trying.php");
        exit();
    }

    // Prepare and bind for the insert statement
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, Pnumber, password, status, role, company_name, best_time_to_contact, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $status = "active";
    $role = "user"; // Change this if you want to set a different role for admin-created users
    $stmt->bind_param("ssssssssss", $firstname, $lastname, $email, $Pnumber, $password, $status, $role, $company_name, $best_time_to_contact, $message);

    // Check for null values before executing
    if ($firstname && $lastname && $email && $Pnumber && $company_name && $best_time_to_contact && $password) {
        $stmt->execute();
        $_SESSION["message"] = "{$firstname} {$lastname} has been added to the record successfully!";
        header("Location: ../views/users/users.php"); // Redirect to users page or wherever you want
        exit();
    } else {
        echo "Please fill in all required fields.";
    }

    // Close statements
    $stmt->close();
    $check_email_stmt->close();
}

$conn->close();
?>

