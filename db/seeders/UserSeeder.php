<?php 
include("../connection.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $firstname = "firs";
    $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $Pnumber = isset($_POST['Pnumber']) ? $_POST['Pnumber'] : null;
    $company_name = isset($_POST['company_name']) ? $_POST['company_name'] : null;
    $message = isset($_POST['message']) ? $_POST['message'] : null;
    $password = isset($_POST['passwfirstnameord']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;
    $role = isset($_POST['role']) ? $_POST['role'] : null;
    $stmt=$conn->prepare("INSERT INTO users (firstname, lastname, email, Pnumber, role, company_name, $message, $password) VALUES(?)");
    $stmt->bind_param("ssssssss", $firstname, $lastname, $email, $Pnumber, $company_name, $message, $password, $role);

    if($firstname && $lastname && $email && $Pnumber && $company_name && $message && $password && $role){
        $stmt->execute();
    }else{
        echo("error changing the role");
    }

}else{
    echo("No data is submitted");
}


?>
