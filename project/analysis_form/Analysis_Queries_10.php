<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Analysis Report | MheeKaow Co., Ltd.</title>
    <link rel="stylesheet" href="../css/staff.css" type="text/css">
    <link rel="stylesheet"  href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
</head>

<body>
<div class="header">
        <h2 class="logo">MheeKaow</h2>
        <input type="checkbox" name="menu" id="chk">
        <label for="chk" class="show-menu-btn">
            <i class="fas fa-bars"></i>
        </label>
        <ul class="menu">
                <a href="../mix/productlist.php">Product</a>
                <a href="../mix/customerlist.php">Customer</a>
                <a href="../mix/manufacturerlist.php">Manufacturer</a>
                <a href="../mix/selllist.php">Order</a>
                <a href="../mix/trendlist.php">Trend</a>
                <a href="../mix/brokenlist.php">Broken Product</a>
                <a href="../mix/stocklist.php">Stock</a>
                <a href="../mix/stafflist.php">Staff</a>
                <a href="../login_staff.html">Log out (<?php include '../php/db_connection.php'; echo getName();?>)</a>
            <label for="chk" class="hide-menu-btn">
                <i class="fas fa-times"></i>
            </label>
        </ul>
    </div>
    <div class="alter">
        <form action="Analysis_Queries_1.php" method="get"><input type="submit" class="choice" id="1" value="1"></form>
        <form action="Analysis_Queries_2.php" method="get"><input type="submit" class="choice" id="2" value="2"></form>
        <form action="Analysis_Queries_3.php" method="get"><input type="submit" class="choice" id="3" value="3"></form>
        <form action="Analysis_Queries_4.php" method="get"><input type="submit" class="choice" id="4" value="4"></form>
        <form action="Analysis_Queries_5.php" method="get"><input type="submit" class="choice" id="5" value="5"></form>
        <form action="Analysis_Queries_6.php" method="get"><input type="submit" class="choice" id="6" value="6"></form>
        <form action="Analysis_Queries_7.php" method="get"><input type="submit" class="choice" id="7" value="7"></form>
        <form action="Analysis_Queries_8.php" method="get"><input type="submit" class="choice" id="8" value="8"></form>
        <form action="Analysis_Queries_9.php" method="get"><input type="submit" class="choice" id="9" value="9"></form>
        <form action="Analysis_Queries_10.php" method="get"><input type="submit" class="choice" id="10" value="10"></form>
        <form action="Analysis_Queries_11.php" method="get"><input type="submit" class="choice" id="11" value="11"></form>
        <form action="Analysis_Queries_12.php" method="get"><input type="submit" class="choice" id="12" value="12"></form>
        <form action="Analysis_Queries_13.php" method="get"><input type="submit" class="choice" id="13" value="13"></form>
        <form action="Analysis_Queries_14.php" method="get"><input type="submit" class="choice" id="14" value="14"></form>
        <form action="Analysis_Queries_15.php" method="get"><input type="submit" class="choice" id="15" value="15"></form>
    </div>
<?php

$con=openCon();
$used_q = mysqli_query($con,"SELECT COUNT(DISTINCT DiscountCode)
FROM discount
WHERE DiscountCode IN (SELECT DiscountCode FROM useddiscountby)");
$used = mysqli_fetch_array($used_q);

$notuse_q = mysqli_query($con,"SELECT COUNT(DISTINCT DiscountCode)
FROM discount
WHERE DiscountCode NOT IN (SELECT DiscountCode FROM useddiscountby)");
$notuse = mysqli_fetch_array($notuse_q);
?>
    <center>
        <br>
        <h1>This report shows the discount using ratio between used and no used before the discount expired.<span id="name"></span></h1><br>

        <table id="customers">
    <thead>
      <tr>
        <th>Type</th>
        <th>Used</th>
      </tr>
    </thead>
    <tbody>
    <tr> 
        <td><?Php echo "Not use"?></td>
        <td><?php echo $notuse['COUNT(DISTINCT DiscountCode)']  ?></td>
    </tr>
    <tr> 
        <td><?Php echo "Used"?></td>
        <td><?php echo $used['COUNT(DISTINCT DiscountCode)']  ?></td>
    </tr>

          
    </tbody>      
  </table>
    </center>
  

<?php
mysqli_close($con);
?>
</body>
</html>
