<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Add Staff | MheeKaow Co., Ltd.</title>
    <link rel="stylesheet" href="../css/staff.css" type="text/css">
    <link rel="stylesheet"  href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <?php include "../php/db_connection.php"; $conn = openCon();?>
</head>
<body>
    <div class="header">
        <h2 class="logo">MheeKaow</h2>
        <input type="checkbox" name="menu" id="chk">
        <label for="chk" class="show-menu-btn">
            <i class="fas fa-bars"></i>
        </label>
        <ul class="menu">
                <a href="productlist.php">Product</a>
                <a href="customerlist.php">Customer</a>
                <a href="manufacturerlist.php">Manufacturer</a>
                <a href="selllist.php">Order</a>
                <a href="trendlist.php">Trend</a>
                <a href="brokenlist.php">Broken Product</a>
                <a href="stocklist.php">Stock</a>
                <a href="stafflist.php">Staff</a>
                <a href="../login_staff.html">Log out (<?php getName() ?>)</a>
            <label for="chk" class="hide-menu-btn">
                <i class="fas fa-times"></i>
            </label>
        </ul>
    </div>
<center>
 <?php
    $first = $_POST['first'];
    $last = $_POST['last'];
    $date = $_POST['date'];
    $address = $_POST['address'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $salary = $_POST['salary'];
    $role = $_POST['role'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];

    $insert="INSERT INTO staff (FirstName,LastName,DateOfBirth,Address,`Tel.`,Email,Salary,Role,Gender,Password)
                VALUES ('$first','$last','$date','$address','$tel','$email','$salary','$role','$gender','$password')";
    $result=$conn->query($insert);

    if($result){
        echo "Success";
    }
    else{
        echo "Failed";
    }

 ?>

<?php mysqli_close($conn); ?>
        <form action="stafflist.php">
            <input type="submit" name="submit" value="Back">
        </form>
        </center>
    </body>
</html>