<?php
session_start();
include("../../db/connection.php");

// Set parameters for static values
$status = "active";
$role = "user";

// Set parameters and execute only if POST data is set
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : null;
    $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $Pnumber = isset($_POST['Pnumber']) ? $_POST['Pnumber'] : null;
    $company_name = isset($_POST['company_name']) ? $_POST['company_name'] : null;
    $best_time_to_contact = isset($_POST['best_time_to_contact']) ? $_POST['best_time_to_contact'] : null;
    $message = isset($_POST['message']) ? $_POST['message'] : null;
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    // Check if email already exists
    $check_email_stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check_email_stmt->bind_param("s", $email);
    $check_email_stmt->execute();
    $result = $check_email_stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION["Error"] = true;
        $_SESSION["message"] = "This email has already been registered. Please try with a different account";
        header("Location: index.php");
        exit;
    }

    // Prepare and bind for the insert statement
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, Pnumber, password, status, role, company_name, best_time_to_contact, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $firstname, $lastname, $email, $Pnumber, $password, $status, $role, $company_name, $best_time_to_contact, $message);

    // Check for null values before executing
    if ($firstname && $lastname && $email && $Pnumber && $company_name && $best_time_to_contact && $password) {
        $stmt->execute();
        echo "Your form has been submitted successfully.";
    } else {
        echo "Please fill in all required fields.";
    }

    // Close statements
    $stmt->close();
    $check_email_stmt->close();
} else {
    echo "No data submitted.";
}

$conn->close();
?>
