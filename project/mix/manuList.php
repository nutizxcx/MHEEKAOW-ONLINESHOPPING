<!DOCTYPE HTML>
<html> 
<head>
        <meta charset="UTF-8">
        <title>Manufacturer</title>
        <link rel="stylesheet" href="../css/staff.css" type="text/css">
        <link rel="stylesheet"  href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
        <?php include "../php/db_connection.php";?>
    </head>
    <body>
        <div class="header">
            <h2 class="logo">MheeKaow</h2>
            <input type="checkbox" name="menu" id="chk">
            <label for="chk" class="show-menu-btn">
                <i class="fas fa-bars"></i>
            </label>
            <ul class="menu">
                <a href="../sa_productList.html">Product list</a>
                <a href="orderHistory.php">Order history</a>
                <a href="restockform.php">Stock history</a>
                <a href="manuList.php">Manufacturer</a>
                <a href="../login_staff.html">Log out (<?php getName() ?>)</a>
                <label for="chk" class="hide-menu-btn">
                    <i class="fas fa-times"></i>
                </label>
            </ul>
        </div>
        
            <center>
                <h3>Manufacturer</h3>
                <form action="insert_manu.php" method="post">
                <input type="submit" value="Add NEW Manufacturer">
                </form>
            <?php
        $connection = openCon();
        echo '<table border="1">';
        echo '<tr>';
        echo '<td height="30" style="font-weight:bold; text-align:center;">No.</td>';
        echo '<td height="30" style="font-weight:bold; text-align:center;">Manufacturer ID ID</td>';
        echo '<td height="30" style="font-weight:bold; text-align:center;">Name</td>';
        echo '<td height="30" style="font-weight:bold; text-align:center;">Address</td>';
        echo '<td height="30" style="font-weight:bold; text-align:center;">Tel.</td>';
        echo '<td height="30" style="font-weight:bold; text-align:center;">Email</td>';
        echo '</tr>';
        $no=1;
        $sql="SELECT *
            FROM manufacturer";
        $query = mysqli_query($connection, $sql);
        while($data = mysqli_fetch_array($query)) {
            echo '<tr>';
            echo '<td height="30" style="text-align:center;">'; echo $no.'</td>';
            echo '<td height="30" style="text-align:center;">'; echo $data['ManufacturerID'].'</td>';
            echo '<td height="30" style="text-align:center;">'; echo $data['Name'].'</td>';
            echo '<td height="30" style="text-align:center;">'; echo $data['Address'].'</td>';
            echo '<td height="30" style="text-align:center;">'; echo $data['Tel.'].'</td>';
            echo '<td height="30" style="text-align:center;">'; echo $data['Email'].'</td>';
            echo '</tr>';
            $no++; 
        }
        echo '</table>';
        echo '</center>';
        mysqli_close($connection); ?>
</body>
</html>