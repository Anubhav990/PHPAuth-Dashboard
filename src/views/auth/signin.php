<!DOCTYPE html>
<html>

<head>
    <title>HTML Login Form</title>
    <link rel="stylesheet" href="../../../public/css/signin.css">
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <a href="#">My Logo</a>
        </div>
        <div class="menu">
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="../auth/index.php">Register</a></li>
                <li><a href="../auth/signin.html">Sign-In</a></li>
            </ul>
            <div class="hamburger">
                &#9776;
            </div>
        </div>
    </nav>

    <div class="main-wrapper">
        <div class="main">
            <h1>YourHelpHR</h1>
            <h3>Please enter your login credentials</h3>
            <form id="form" action="../../controllers/signin.php" method="POST">
                <div class="input-control">
                    <label for="first">
                        Username:
                    </label>
                    <input type="text" id="email" name="email" placeholder="Enter your Email">
                    <div class="error-message"></div>
                </div>

                <div class="input-control">
                    <label for="password">
                        Password:
                    </label>
                    <input type="password" id="password" name="password" placeholder="Enter your Password">
                    <div class="error-message"></div>
                </div>

                <div class="wrap">
                    <button type="submit">
                        Submit
                    </button>
                </div>
            </form>
            <p>Not registered?
                <a href="#" style="text-decoration: none;">
                    Create an account
                </a>
            </p>
        </div>
    </div>

</body>

<script defer src="./public/js/signin.js"></script>

</html>

<!-- onclick="solve()" -->