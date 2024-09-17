<?php 
include("../connection.php");

if($_SERVER["REQUEST_METHOD"] == "GET"){

    $permissionsArray = [
        [
            "role" => "admin",
            "page" => "users"
        ],
        [
            "role" => "admin",
            "page" => "edit"
        ],
        [   
            "role" => "admin",
            "page" => "CreateNewUser"
        ],
        // users...
    ];


    $role = isset($_GET['role']) ? $_GET['role'] : null;
    $pages = isset($_GET['pages']) ? $_GET['pages'] : null;

    $created = date("y-m-d H:i:s");
    $updated = date("y-m-d H:i:s"); 

    $stmt = $conn->prepare("INSERT INTO permissions (role, pages, created_at, updated_at) VALUES(?, ?, ?, ?)");
    
    foreach($permissionsArray as $permission){
        $role = $permission['role'];
        $pages = $permission['page'];

        //bind parameters inside the loop
        $stmt->bind_param("ssss", $role, $pages, $created, $updated);

        if($role && $pages && $created && $updated){

            if($stmt->execute()){
                echo("Data inserted successfully");
            }else{
                echo("Error inserting data". $stmt->error);
            }
            // $stmt->execute();
        }else{
            echo("error in inserting the values");
        }
    
    }
    
}else{
    echo("No Data Submitted");
}

?>