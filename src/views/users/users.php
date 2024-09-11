<?php
session_start();
include("../../../db/connection.php");

$users_role = '';

$created_user_message = '';

$not_deletion = '';

$deletion = '';

$successmessage = '';

$failmessage = '';

if(isset($_SESSION['message'])){
    $created_user_message = $_SESSION['message'];
    unset($_SESSION['message']);
}

if(isset($_SESSION['notdeletion'])) {
    $not_deletion = $_SESSION['notdeletion'];
    unset($_SESSION['notdeletion']);
}

if (isset($_SESSION['deletionmessage'])) {
    $deletion = $_SESSION['deletionmessage'];
    unset($_SESSION['deletionmessage']);
}

if(isset($_SESSION['successmessage'])){
    $successmessage = $_SESSION['successmessage'];
    unset($_SESSION['successmessage']);
}

if(isset($_SESSION['failmessage'])){
    $failmessage = $_SESSION['failmessage'];
    unset($_SESSION['failmessage']);
}

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
    <link rel="stylesheet" href="../../../public/css/users.css">
</head>

<body>

    <!-- Header Section -->
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
                        <a href="../dashboard.php"><h3>Dashboard</h3></a>
                    </div>

                    <div class="nav-option option2">
                        <svg class="nav-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path d="M3 3h18v2H3zm0 4h18v2H3zm0 4h12v2H3zm0 4h18v2H3z" fill="#007BFF" />
                        </svg>
                        <h3>Articles</h3>
                    </div>

                    <div class="nav-option option3">
                        <svg class="nav-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path d="M12 2l10 9h-3v10h-14V11H2l10-9z" fill="#007BFF" />
                        </svg>
                        <h3>Institution</h3>
                    </div>

                    <?php if($users_role == 'admin') ?>
                    <div class="nav-option option4" id="show">
                        <svg class="nav-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-3.31 0-10 1.67-10 5v2h20v-2c0-3.33-6.69-5-10-5z" fill="#007BFF" />
                        </svg>
                        <a href="../users/users.php"><h3>Users</h3></a>
                    </div>
                    <? endif; ?>
           

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
            <div class="searchbar2">
                <input type="text" placeholder="Search">
                <div class="searchbtn">
                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png" class="icn srchicn" alt="search-button">
                </div>
            </div>

            <div class="confirmation-user-created">
                <?php if($created_user_message): ?>
                <div class="success-message-check"><?php echo($created_user_message) ?></div>
                <?php endif; ?>
                <?php if($not_deletion):?>
                <div class="error-message-check"><?php echo($not_deletion) ?></div>
                <?php endif; ?>
                <?php if($deletion): ?>
                <div class="error-message-check"><?php echo($deletion)?></div>
                <?php endif; ?>
                <?php if($successmessage): ?>
                <div class="success-message-check"><?php echo($successmessage) ?></div>
                <?php endif; ?>
                <?php if($failmessage): ?>
                <div class="error-message-check"><?php echo($failmessage) ?></div>
                <?php endif; ?>

           </div>

            <div class="admin-create-user"> 
                <a href="trying.php"><button>create a new user</button></a>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                    <!-- headings for the data in users dashboard -->
                        <tr>
                            <th>Sno</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Pnumber</th>
                            <th>Status</th>
                            <th>Role</th>
                            <th>Companyname</th>
                            <th>Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //fetch data from the database
                        $stmt = $conn->prepare("SELECT id, firstname, lastname, email, Pnumber, status, role, company_name, best_time_to_contact FROM users");
                        $stmt->execute();
                        $result= $stmt->get_result();
                        // $sql = "SELECT id, firstname, lastname, email, Pnumber, status, role, company_name, best_time_to_contact FROM users";
                        // $result = $conn->query($sql);
                        
                        if($result->num_rows > 0){
                            $curr_index = 1;
                            while($row = $result->fetch_assoc()){
                                //show the registered data accordingly
                                echo "<tr>
                                <td data-label='Sno'>{$curr_index}</td>                                
                                <td data-label='Firstname'>{$row['firstname']}</td>                                
                                <td data-label='Lastname'>{$row['lastname']}</td>                                
                                <td data-label='Email'>{$row['email']}</td>                                
                                <td data-label='Pnumber'>{$row['Pnumber']}</td>                                
                                <td data-label='Status'>{$row['status']}</td>                                
                                <td data-label='Role'>{$row['role']}</td>                                
                                <td data-label='Companyname'>{$row['company_name']}</td> 
                                <td data-label='Time'>{$row['best_time_to_contact']}</td>                               
                                <td data-label='Actions'> <a href='../users/edit.php?id={$row['id']}' class='action-button edit-button'>Edit</a> 
                                <button class='action-button delete-button' onclick='confirmDelete({$row['id']})'>Delete</button>
                                
                                </td>                               
                                </tr>";
                                $curr_index++;
                            }
                        }else{
                            //if no data is found in the database
                            echo "<tr><td colspan='8'> No records Found </td></tr>";
                        }

                        $stmt->close();
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script defer src="../../../public/js/users.js"></script>
    <script defer src="../../../public/js/logout.js"></script>
</body>

</html>
