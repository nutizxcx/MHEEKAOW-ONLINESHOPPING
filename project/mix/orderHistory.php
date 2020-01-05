<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order History | MheeKaow Co., Ltd.</title>
    <link rel="stylesheet" href="../css/staff.css" type="text/css">
    <link rel="stylesheet"  href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <?php 
        include '../php/db_connection.php';
        
        function getNameUser() {
            echo getName();
        }
        function callOrderID() {
        $key = $_REQUEST['q'];
        $connection = openCon();
        $i = 0;
        $a = array('', '', '', '', '', '');
        $result = mysqli_query($connection, 
            "SELECT OrderID
            FROM order_history
            WHERE OrderID LIKE "."'%$key%'"
            . "LIMIT 6");
        closeCon($connection);
        while($row = mysqli_fetch_array($result)) {
            $a[$i] = (string)$row['ProductID'];
            $i++;
        }
        echo json_encode($a);
    }
    ?>
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
    <center><h2>Order History</h2>
    <form action="../sa_addTrack.html" method="post">
        <input type="submit" value="Inout Tracking no.">
    </form>
    <?php
    $connection = openCon();
    echo '<table border="1">';
    echo '<tr>';
    echo '<td height="30" style="font-weight:bold; text-align:center;">No.</td>';
    echo '<td height="30" style="font-weight:bold; text-align:center;">Order ID</td>';
    echo '<td height="30" style="font-weight:bold; text-align:center;">First Name</td>';
    echo '<td height="30" style="font-weight:bold; text-align:center;">Last Name</td>';
    echo '<td height="30" style="font-weight:bold; text-align:center;">Date And Time</td>';
    echo '<td height="30" style="font-weight:bold; text-align:center;">Status</td>';
    echo '<td height="30" style="font-weight:bold; text-align:center;">Tracking no.</td>';
    echo '</tr>';
    $no=1;
    $sql="SELECT o.OrderID,p.Name,h.FirstName,h.LastName,h.DateAndTime,o.SKU,o.Amount, h.Status, h.TrackingNumber
        FROM order_product o, order_history h, product_infomation p
        WHERE o.ProductID = p.ProductID
            AND o.OrderID = h.OrderID
        ORDER BY h.DateAndTime";
    $query = mysqli_query($connection, $sql);
    while($data = mysqli_fetch_array($query)) {
        echo '<tr>';
        echo '<td height="30" style="text-align:center;">'; echo $no.'</td>';
        echo '<td height="30" style="text-align:center;">'; echo $data['OrderID'].'</td>';
        echo '<td height="30" style="text-align:center;">'; echo $data['FirstName'].'</td>';
        echo '<td height="30" style="text-align:center;">'; echo $data['LastName'].'</td>';
        echo '<td height="30" style="text-align:center;">'; echo $data['DateAndTime'].'</td>';
        echo '<td height="30" style="text-align:center;">'; echo $data['Status'].'</td>';
        echo '<td height="30" style="text-align:center;">'; echo $data['TrackingNumber'].'</td>';
        echo '</tr>';
        $no++; 
    }
    echo '</table>';
    echo '</center>';
    mysqli_close($connection); ?>
    </body>
</html>
