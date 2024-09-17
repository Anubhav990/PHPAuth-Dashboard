
<?php
session_start();
include("../../db/connection.php");
// include("../middlwares/HasAccess.php");

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

// else{
//     // header("Location: dash.php");
//     exit();
// }

// #1 Get the user ID if user is successfully logged
// #2. Store that user ID inside session variable
// #3 $user_id = $_SESSION['id'];
// #4. Write a SQL Query to get that user details with the help of user ID.
// #5. Get the Role
// #6. Toggle the users section in sidebar based on role.


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, 
                   initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../public/css/dashboard.css">
</head>

<body>

    <!-- for header part -->
    <header>

        <div class="logosec">
            <div class="logo">YourHelpHR</div>
            <svg class="icn menuicn" id="menuicn" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                height="24">
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
            <svg class="icn" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                style="fill: #2196F3;">
                <path
                    d="M12 22c1.1 0 2-.9 2-2H10c0 1.1.9 2 2 2zm6-6V10c0-3.07-1.64-5.64-4.22-6.32C13.08 3.01 12.57 2 12 2s-1.08 1.01-1.78 1.68C7.64 4.36 6 6.93 6 10v6l-2 2v1h16v-1l-2-2z" />
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
                        <svg class="nav-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                            height="24">
                            <rect x="3" y="3" width="7" height="7" fill="#2196F3" />
                            <rect x="3" y="12" width="7" height="7" fill="#64B5F6" />
                            <rect x="14" y="3" width="7" height="7" fill="#1E88E5" />
                            <rect x="14" y="12" width="7" height="7" fill="#90CAF9" />
                        </svg>
                        <h3> Dashboard</h3>
                    </div>

                    <div class="nav-option option2">
                        <svg class="nav-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                            height="24">
                            <path d="M3 3h18v2H3zm0 4h18v2H3zm0 4h12v2H3zm0 4h18v2H3z" fill="#007BFF" />
                        </svg>
                        <h3> Articles</h3>
                    </div>

                    <div class="nav-option option3">
                        <svg class="nav-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                            height="24">
                            <path d="M12 2l10 9h-3v10h-14V11H2l10-9z" fill="#007BFF" />
                        </svg>
                        <h3> Institution</h3>
                    </div>

                    <?php if($users_role == 'admin'): ?>
                    <div class="nav-option option4" id="show">
                        <svg class="nav-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                            height="24">
                            <path
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-3.31 0-10 1.67-10 5v2h20v-2c0-3.33-6.69-5-10-5z"
                                fill="#007BFF" />
                        </svg>
                    
                       <a href="../views/users/users.php"> <h3> Users</h3> </a>
                    </div>
                    <?php endif; ?>

                    <div class="nav-option logout" onclick="logoutuser()">
                        <svg class="nav-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                            height="24">
                            <path d="M16 13v-2h-4V7l-5 5 5 5v-4h4z" fill="red" />
                            <path d="M20 3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"
                                fill="none" stroke="red" stroke-width="2" />
                        </svg>
                     <h3>Logout</h3>
                    </div>

                </div>
            </nav>
        </div>
        <div class="main">

            <div class="searchbar2">
                <input type="text" name="" id="" placeholder="Search">
                <div class="searchbtn">
                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
                        class="icn srchicn" alt="search-button">
                </div>
            </div>

            <div class="box-container">

                <div class="box box1">
                    <div class="text">
                        <h2 class="topic-heading">60.5k</h2>
                        <h2 class="topic">Article Views</h2>
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                        <path d="M12 4.5C6.5 4.5 2 12 2 12s4.5 7.5 10 7.5 10-7.5 10-7.5-4.5-7.5-10-7.5z"
                            fill="#ffffff" />
                        <circle cx="12" cy="12" r="3" fill="#2196F3" />
                        <circle cx="12" cy="12" r="1" fill="#ffffff" />
                    </svg>
                </div>

                <div class="box box2">
                    <div class="text">
                        <h2 class="topic-heading">150</h2>
                        <h2 class="topic">Likes</h2>
                    </div>

                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210185030/14.png" alt="likes">
                </div>

                <div class="box box3">
                    <div class="text">
                        <h2 class="topic-heading">320</h2>
                        <h2 class="topic">Comments</h2>
                    </div>

                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210184645/Untitled-design-(32).png"
                        alt="comments">
                </div>

                <div class="box box4">
                    <div class="text">
                        <h2 class="topic-heading">70</h2>
                        <h2 class="topic">Published</h2>
                    </div>

                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210185029/13.png" alt="published">
                </div>
            </div>

            <div class="report-container">
                <div class="report-header">
                    <h1 class="recent-Articles">Recent Articles</h1>
                    <button class="view">View All</button>
                </div>

                <div class="report-body">
                    <div class="report-topic-heading">
                        <h3 class="t-op">Article</h3>
                        <h3 class="t-op">Views</h3>
                        <h3 class="t-op">Comments</h3>
                        <h3 class="t-op">Status</h3>
                    </div>

                    <div class="items">
                        <div class="item1">
                            <h3 class="t-op-nextlvl">Article 73</h3>
                            <h3 class="t-op-nextlvl">2.9k</h3>
                            <h3 class="t-op-nextlvl">210</h3>
                            <h3 class="t-op-nextlvl label-tag">Published</h3>
                        </div>

                        <div class="item1">
                            <h3 class="t-op-nextlvl">Article 72</h3>
                            <h3 class="t-op-nextlvl">1.5k</h3>
                            <h3 class="t-op-nextlvl">360</h3>
                            <h3 class="t-op-nextlvl label-tag">Published</h3>
                        </div>

                        <div class="item1">
                            <h3 class="t-op-nextlvl">Article 71</h3>
                            <h3 class="t-op-nextlvl">1.1k</h3>
                            <h3 class="t-op-nextlvl">150</h3>
                            <h3 class="t-op-nextlvl label-tag">Published</h3>
                        </div>

                        <div class="item1">
                            <h3 class="t-op-nextlvl">Article 70</h3>
                            <h3 class="t-op-nextlvl">1.2k</h3>
                            <h3 class="t-op-nextlvl">420</h3>
                            <h3 class="t-op-nextlvl label-tag">Published</h3>
                        </div>

                        <div class="item1">
                            <h3 class="t-op-nextlvl">Article 69</h3>
                            <h3 class="t-op-nextlvl">2.6k</h3>
                            <h3 class="t-op-nextlvl">190</h3>
                            <h3 class="t-op-nextlvl label-tag">Published</h3>
                        </div>

                        <div class="item1">
                            <h3 class="t-op-nextlvl">Article 68</h3>
                            <h3 class="t-op-nextlvl">1.9k</h3>
                            <h3 class="t-op-nextlvl">390</h3>
                            <h3 class="t-op-nextlvl label-tag">Published</h3>
                        </div>

                        <div class="item1">
                            <h3 class="t-op-nextlvl">Article 67</h3>
                            <h3 class="t-op-nextlvl">1.2k</h3>
                            <h3 class="t-op-nextlvl">580</h3>
                            <h3 class="t-op-nextlvl label-tag">Published</h3>
                        </div>

                        <div class="item1">
                            <h3 class="t-op-nextlvl">Article 66</h3>
                            <h3 class="t-op-nextlvl">3.6k</h3>
                            <h3 class="t-op-nextlvl">160</h3>
                            <h3 class="t-op-nextlvl label-tag">Published</h3>
                        </div>

                        <div class="item1">
                            <h3 class="t-op-nextlvl">Article 65</h3>
                            <h3 class="t-op-nextlvl">1.3k</h3>
                            <h3 class="t-op-nextlvl">220</h3>
                            <h3 class="t-op-nextlvl label-tag">Published</h3>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../public/js/dashboard.js"></script>
    <script src="../../public/js/logout.js"> </script>
</body>

</html>
