<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order History | MheeKaow Co., Ltd.</title>
    <link rel="stylesheet" href="../css/staff.css" type="text/css">
    <link rel="stylesheet"  href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/sa_home.js"></script>
    <?php include "../php/db_connection.php"; $conn = openCon(); ?>
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
    <h2>Return Order</h2>
    <form action="insertreturnorder.php" method="post">
    <table border="1">
    <tr>
        <td height="30" style="font-weight:bold; text-align:center;">Check</td>
        <td height="30" style="font-weight:bold; text-align:center;">No.</td>
        <td height="30" style="font-weight:bold; text-align:center;">Return ID</td>
        <td height="30" style="font-weight:bold; text-align:center;">Order ID</td>
        <td height="30" style="font-weight:bold; text-align:center;">Item No.</td>
        <td height="30" style="font-weight:bold; text-align:center;">SKU</td>
        <td height="30" style="font-weight:bold; text-align:center;">Product ID</td>
        <td height="30" style="font-weight:bold; text-align:center;">Date And Time</td>
        <td height="30" style="font-weight:bold; text-align:center;">Reason</td>
        <td height="30" style="font-weight:bold; text-align:center;">Detail</td>
        <td height="30" style="font-weight:bold; text-align:center;">Customer ID</td>
        <td height="30" style="font-weight:bold; text-align:center;">Tracking no</td>
    </tr>
    
    <?php
        $no=1;
        $n=0;
        $sql="SELECT d.ReturnID,r.OrderID,d.ItemNo,d.SKU,d.ProductID,r.DateAndTime,d.Reason,d.Detail,h.CustomerID
        FROM return_request r, return_detail d, order_history h
        WHERE r.ReturnID = d.ReturnID
        AND r.OrderID = h.OrderID";
        $query=mysqli_query($conn,$sql);
        while($data=mysqli_fetch_array($query)){
    ?>

    <tr>
        <td height="30" style="text-align:center;"><input type='checkbox' value="<?= $n ?>" name='check[]'></td>
        <td height="30" style="text-align:center;"><?php echo $no?></td>
        <td height="30" style="text-align:center;"><?php echo $data['ReturnID']; $returnid[$n]=$data['ReturnID'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['OrderID']; $orderid[$n]=$data['OrderID'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['ItemNo'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['SKU']; $sku[$n]=$data['SKU'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['ProductID']; $productid[$n]=$data['ProductID'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['DateAndTime'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['Reason'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['Detail'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['CustomerID'] ?></td>
        <td height="30" style="text-align:center;"><input type="text" name="tracking[]" ></td>
    </tr>

    <?php
        $no++; 
        $n++;
        }
    ?>

</table>

    <input type="submit" name="submit2" value="Submit" />

</form>

<?php
    if ($returnid != NULL) {
        $_SESSION['passreturnid']=$returnid;
        $_SESSION['passorderid']=$orderid;
        $_SESSION['passproduct']=$productid;
        $_SESSION['passsku']=$sku;
    }
?>

<?php mysqli_close($conn); ?>
    </center>
    </body>
</html>