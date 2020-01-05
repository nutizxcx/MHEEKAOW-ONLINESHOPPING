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
        <h3>Add Staff</h3>
        <form action="addstaffdata.php" method="post" style="text-align: right;position: relative;margin: 30px 40%;">
            <label>First Name : </label><input type="text" name="first" class="mix"><br>
            <label>last Name : </label><input type="text" name="last" class="mix"><br>
            <label>Date Of Birth : </label><input type="date" name="date" class="mix"><br>
            <label>Address : </label><input type="text" name="address" class="mix"><br>
            <label>Tel. : </label><input type="text" name="tel" class="mix"><br>
            <label>Email : </label><input type="text" name="email" class="mix"><br>
            <label>Salary : </label><input type="number" name="salary" class="mix"><br>
            <label>Role : </label><select name="role">
                                            <option value="CEO">CEO</option>
                                            <option value="AE">Account Excutive</option>
                                            <option value="SA">Stock Assistance</option>
                                        </select><br />
            <label>Gender : </label><select name="gender">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="un">Undefined</option>
                                        </select><br />
            <label>Password : </label><input type="password" name="password" class="mix"><br>
            <input type="submit" name="submit" value="Submit" style="margin-right:100px">
        </form>
        </center>
    </body>
</html>