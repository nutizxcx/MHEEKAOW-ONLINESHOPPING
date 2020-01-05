<?php
include 'db_connection.php';
// session_destroy();
session_start();
$con = openCon();
$staffID = $_POST['staffId'];
$password = $_POST['password'];
$result = mysqli_query($con, 
    "SELECT * 
    FROM staff 
    WHERE staffID = '$staffID'");
closeCon($con);
$data = mysqli_num_rows($result);

if($data == 1){
    if($row = mysqli_fetch_array($result)){
        $passQuery = $row['Password'];
        $role = $row['Role'];
    }
    if($password == $passQuery){
        pass($staffID, $role);
    } else{
        echo "Password is NOT CORRECT!!";
    }
} else{
    echo "Staff ID is NOT FOUND!";
}

function pass($staffID, $role) {
    $_SESSION['staffID'] = $staffID;
    echo $role;
}

?>