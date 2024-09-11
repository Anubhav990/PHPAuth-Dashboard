<?php
session_start();
$error_message = '';

if(isset($_SESSION['Error'])){
    $error_message = $_SESSION['message'];
    unset($_SESSION['Error']);
    unset($_SESSION['message']);
}

session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="../../../public/css/styles.css" />
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <a href="#">My Logo</a>
        </div>
        <div class="menu">
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="trying.php">trying</a></li>
                <li><a href="#">About</a></li>
                <li><a href="./index.php">Register</a></li>   
                <li><a href="./signin.php">Sign-In</a></li>
            </ul>
            <div class="hamburger">
                &#9776;
            </div>
        </div>
    </nav>

    <div class="heading-wrapper">
        <div class="heading-container">
            <h5> Let’s get started today</h5>
            <h2>Are you READY to invest in GREAT PEOPLE?</h2>
            <p>We help you identify your challenge, apply a winning solution, and measure the results.</p>
        </div>
    </div>

    <div class="row-wrapper">
        <div class="row">
            <div class="column1">
                <h5> CONNECT WITH US </h5>
                <h2>
                    I'm ready for a FREE<br>
                    consultation on how to<br>
                    attract, engage and retain<br>
                    top talent!
                </h2>
            </div>
            <div class="column2">
                <div class="form-container">
                    <form id="form" action="../../controllers/register.php" method="POST">
                        <?php if($error_message): ?>
                        <div class="error-message-check"><?php echo $error_message ?></div>
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
                                    <option value="Best Time To Contact">Best Time To Contact</option>
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

                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script defer src="./public/js/validationR.js"></script>
</body>

</html>