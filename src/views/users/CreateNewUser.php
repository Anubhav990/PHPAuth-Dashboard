<?php
session_start();
include("../../../db/connection.php");
$error_message = '';

if (isset($_SESSION['Error'])) {
    $error_message = $_SESSION['message'];
    unset($_SESSION['Error']);
    unset($_SESSION['message']);
}


$users_role = '';

if(isset($_SESSION['user_id'])){

    $user_id = $_SESSION['user_id'];
}

// else{
//     header("Location: sigin.php");
//     exit();
// }

$sql = "SELECT * FROM users WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_details = $result->fetch_assoc();
// echo $user_details;

if($user_details){
    $users_role = $user_details['role']; 
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../../public/css/trying.css">
</head>

<body>

    <!-- for header part -->
    <header>
        <div class="logosec">
            <div class="logo">YourHelpHR</div>
            <svg class="icn menuicn" id="menuicn" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                <path d="M3 6h18v2H3zm0 5h18v2H3zm0 5h18v2H3z" fill="black" />
            </svg>
        </div>

        <div class="searchbar">
            <input type="text" placeholder="Search">
            <div class="searchbtn">
                <svg class="icn srchicn" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <circle cx="10" cy="10" r="7" stroke="white" stroke-width="2" fill="none" />
                    <line x1="16.5" y1="16.5" x2="22" y2="22" stroke="white" stroke-width="2" />
                </svg>
            </div>
        </div>

        <div class="message">
            <div class="circle"></div>
            <svg class="icn" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" style="fill: #2196F3;">
                <path d="M12 22c1.1 0 2-.9 2-2H10c0 1.1.9 2 2 2zm6-6V10c0-3.07-1.64-5.64-4.22-6.32C13.08 3.01 12.57 2 12 2s-1.08 1.01-1.78 1.68C7.64 4.36 6 6.93 6 10v6l-2 2v1h16v-1l-2-2z" />
            </svg>
            <div class="dp">
                <svg class="dpicn" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                    <circle cx="32" cy="32" r="30" fill="#2196F3" />
                    <circle cx="32" cy="26" r="10" fill="#ffffff" />
                    <path d="M32 38c-8 0-24 4-24 12v2h48v-2c0-8-16-12-24-12z" fill="#ffffff" />
                </svg>
            </div>
        </div>
    </header>

    <div class="main-container">
        <div class="navcontainer">
            <nav class="nav">
                <div class="nav-upper-options">
                    <div class="nav-option option1">
                        <svg class="nav-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <rect x="3" y="3" width="7" height="7" fill="#2196F3" />
                            <rect x="3" y="12" width="7" height="7" fill="#64B5F6" />
                            <rect x="14" y="3" width="7" height="7" fill="#1E88E5" />
                            <rect x="14" y="12" width="7" height="7" fill="#90CAF9" />
                        </svg>
                        <a href="../dashboard.php"><h3> Dashboard</h3></a>
                    </div>
                    <div class="nav-option option2">
                    <svg class="nav-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <path d="M3 3h18v2H3zm0 4h18v2H3zm0 4h12v2H3zm0 4h18v2H3z" fill="#007BFF" />
                    </svg>
                        <h3> Articles</h3>
                    </div>
                    <div class="nav-option option3">
                        <svg class="nav-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path d="M12 2l10 9h-3v10h-14V11H2l10-9z" fill="#007BFF" />
                        </svg>
                        <h3> Institution</h3>
                    </div>

                    <?php if($users_role == 'admin'): ?>
                    <div class="nav-option option4" id="show">
                    <svg class="nav-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-3.31 0-10 1.67-10 5v2h20v-2c0-3.33-6.69-5-10-5z" fill="#007BFF" />
                    </svg>
                        <a href="../users/Users.php"> <h3> Users</h3> </a>
                    </div>
                    <?php endif; ?>

                    <div class="nav-option logout" onclick="logoutuser()">
                        <svg class="nav-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path d="M16 13v-2h-4V7l-5 5 5 5v-4h4z" fill="red" />
                            <path d="M20 3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z" fill="none" stroke="red" stroke-width="2" />
                        </svg>
                        <h3>Logout</h3>
                    </div>
                </div>
            </nav>
        </div>

        <div class="main">
            <div class="row-wrapper">
            <div class="row">
        <div class="column1">
            <h5>Welcome admin!</h5>
            <h2>Please fill out the form<br> to create a new user.<br> Ensure all details are correct<br> for a smooth onboarding.</h2>
        </div>
        <div class="column2">
            <div class="form-container">
                <form id="form" action="../../controllers/createuserconnection.php" method="POST">
                <?php if ($error_message): ?>
                        <div class="error-message-check"><?php echo htmlspecialchars($error_message); ?></div>
                    <?php endif; ?>
                    <div class="formline1">
                        <div class="input-control">
                            <input type="text" id="fname" name="firstname" placeholder="First Name">
                            <div id="fname-error" class="error-message"></div>
                        </div>
                        <div class="input-control">
                            <input type="text" id="lname" name="lastname" placeholder="Last Name">
                            <div id="lname-error" class="error-message"></div>
                        </div>
                    </div>

                    <div class="formline2">
                        <div class="input-control">
                            <input type="email" id="email" name="email" placeholder="Email Address">
                            <div id="email-error" class="error-message"></div>
                        </div>
                        <div class="input-control">
                            <input type="tel" id="Pnumber" name="Pnumber" placeholder="Phone Number">
                            <div id="Pnumber-error" class="error-message"></div>
                        </div>
                    </div>

                    <div class="formline3">
                        <div class="input-control">
                            <input type="text" id="Company_Name" name="company_name" placeholder="Company Name">
                            <div id="company_name-error" class="error-message"></div>
                        </div>
                        <div class="select-control">
                            <select name="best_time_to_contact" id="best_time_to_contact">
                                <option value="" disabled selected>Best Time To Contact</option>
                                <option value="8amto10am">08:00 AM - 10:00 AM</option>
                                <option value="10amto12pm">10:00 AM - 12:00 PM</option>
                                <option value="1pmto3pm">01:00 PM - 03:00 PM</option>
                                <option value="3pmto5pm">03:00 PM - 05:00 PM</option>
                            </select>
                            <div id="best_time-error" class="error-message"></div>
                        </div>
                    </div>

                    <div class="formline4">
                        <div class="input-control">
                            <input type="password" id="password" name="password" placeholder="Password">
                            <div id="password-error" class="error-message"></div>
                        </div>
                        <div class="input-control">
                            <input type="password" id="repassword" name="repassword" placeholder="Re-type Password">
                            <div id="password2-error" class="error-message"></div>
                        </div>
                    </div>

                    <div class="textarea4">
                        <div class="input-control">
                            <textarea id="message" name="message" placeholder="Message (optional)"></textarea>
                            <div id="message-error" class="error-message"></div>
                        </div>
                    </div>

                    <button type="submit">Create</button>
                </form>
            </div>
         </div>
       </div>
   </div>
            </div>
        </div>
    </div>

    <script src="../../../public/js/trying.js"></script>
    <script src="../../../public/js/logout.js"></script>
</body>

</html>
