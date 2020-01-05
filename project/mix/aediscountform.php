<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Product List | MheeKaow Co., Ltd.</title>
    <link rel="stylesheet" href="../css/staff.css" type="text/css">
    <link rel="stylesheet"  href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/sa_home.js"></script>
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
                <a href="aeorderhistory.php">Order</a>
                <a href="aeproductlist.php">Product List</a>
                <a href="aemanufacturer.php">Manufacturer</a>
                <a href="aecustomerlist.php">Customer List</a>
                <a href="aetrend.php">Trend</a>
                <a href="aediscount.php">Discount</a>
                <a href="../login_staff.html">Log out (<?php getName() ?>)</a>
            <label for="chk" class="hide-menu-btn">
                <i class="fas fa-times"></i>
            </label>
        </ul>
    </div>
<center>
        <h3>Discount Form</h3>
        <form action="insertdiscount.php" method="post" style="text-align:right; margin-right: 40%;">
            <label>Discount Code : </label><input type="text" name="code" style="margin-buttom: 5px; margin-top: 5px"><br>
            <label>Type (PV/CM) : </label><input type="text" name="type"style="margin-buttom: 5px; margin-top: 5px"><br>
            <label>Formula : </label><input type="text" name="formula"style="margin-buttom: 5px; margin-top: 5px"><br>
            <label>Expired Date (YYYY-MM-DD) : </label><input type="text" name="expired"style="margin-buttom: 5px; margin-top: 5px"><br>
            <label>Condition : </label><input type="text" name="condition"style="margin-buttom: 5px; margin-top: 5px"><br>
            <input type="submit" name="submit" value="Submit"style="padding: 5px; margin-right: 13%; position:relative;">
        </form>
    </center>
    </body>
</html>