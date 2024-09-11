<?php
session_start();

include("../../../db/connection.php");

$error_message = '';
$user = [];

if(isset($_SESSION['Error'])){
    $error_message = $_SESSION['message'];
    unset($_SESSION['Error']);
    unset($_SESSION['message']);
}

if(isset($_GET['id'])){
   $user_id = $_GET['id'];

    //fetch user details from the database

    $stmt = $conn->prepare("SELECT firstname, lastname, email, Pnumber, status, role, company_name, best_time_to_contact, message FROM users WHERE id= ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
    }else{
        echo "no user found";
        exit();
    }
}else{
    echo "no ID found";
    exit();
}

$stmt->close();
$conn->close();
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a new User</title>
    <link rel="stylesheet" href="../../../public/css/edit.css"/>
</head>
<body>

<nav class="navbar">
        <div class="logo">
            <a href="#">My Logo</a>
        </div>
        <div class="menu">
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="../dashboard.php">Dashboard</a></li>
                <li><a href="#">About</a></li>
                <li><a href="index.php">Register</a></li>   
                <li><a href="signin.html">Sign-In</a></li>
            </ul>
            <div class="hamburger">
                &#9776;
            </div>
        </div>
    </nav>

<div class="row-container">
<div class="row-wrapper">
        <div class="row">
            <div class="column1">
                <h5>Welcome admin!</h5>
                <h2>
                Please fill out the form<br> to edit the user.<br>
                Ensure all details are correct<br> for a smooth onboarding.
                </h2>
            </div>
            <div class="column2">
                <div class="form-container">
                    <form id="form" action="../../controllers/updateuser.php?id=<?php echo $_GET['id'] ?>" method="POST">
                        <?php if($error_message): ?>
                        <div class="error-message-check"><?php echo $error_message ?></div>
                        <?php endif; ?> 
                        <div class="formline1">
                            <div class="input-control">
                                <input type="text" value = "<?php echo $user['firstname']?>" id="fname" name="firstname" placeholder="First Name">
                                <div id="fname-error" class="error-message"></div>
                            </div>

                            <div class="input-control">
                                <input type="text" value="<?php echo $user['lastname']?>" id="lname" name="lastname" placeholder="Last Name">
                                <div id="lname-error" class="error-message"></div>
                            </div>
                        </div>

                        <div class="formline2">
                            <div class="input-control">
                                <input type="email" value = "<?php echo $user['email']?>" id="email" name="email" placeholder="Email Address">
                                <div id="email-error" class="error-message"></div>
                            </div>

                            <div class="input-control">
                                <input type="tel" value = "<?php echo $user['Pnumber']?>" id="Pnumber" name="Pnumber" placeholder="Phone Number">
                                <div id="Pnumber-error" class="error-message"></div>
                            </div>
                        </div>

                        <div class="formline3">
                            <div class="input-control">
                                <input type="text" value = "<?php echo $user['company_name']?>" id="Company_Name" name="company_name" placeholder="Company Name">
                                <div id="company_name-error" class="error-message"></div>
                            </div>

                            <div class="select-control">
                                <select name="best_time_to_contact" id="best_time_to_contact">
                                    <option value="Best Time To Contact">Best Time To Contact</option>
                                    <option value="8amto10am"<?php if($user['best_time_to_contact'] == '8amto10am') echo 'selected'; ?>>08:00 AM - 10:00 AM</option>
                                    <option value="10amto12pm" <?php if($user['best_time_to_contact'] == '10amto12pm') echo 'selected' ;?>>10:00 AM - 12:00 PM</option>
                                    <option value="1pmto3pm" <?php if($user['best_time_to_contact'] == '1pmto3pm') echo 'selected' ?> >01:00 PM - 03:00 PM</option>
                                    <option value="3pmto5pm" <?php if($user['best_time_to_contact'] == '3pmto5pm') echo 'selected' ?> >03:00 PM - 05:00 PM</option>
                                </select>
                                <div id="best_time-error" class="error-message"></div>
                            </div>
                            
                        </div>
                        
                        <input type="hidden" name="id" value = "<?php echo $_GET['id'] ?>" >
                        <button type="submit">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script defer src="../../../public/js/edit.js"></script>
</body>
</html>

<?php
session_destroy();
?>