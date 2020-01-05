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
<h2>Product list</h2>
<table border="1">
    <tr>
        <td height="30" style="font-weight:bold; text-align:center;">No.</td>
        <td height="30" style="font-weight:bold; text-align:center;">Product ID</td>
        <td height="30" style="font-weight:bold; text-align:center;">Product Name</td>
        <td height="30" style="font-weight:bold; text-align:center;">SKU</td>
        <td height="30" style="font-weight:bold; text-align:center;">Detail</td>
        <td height="30" style="font-weight:bold; text-align:center;">Category</td>
        <td height="30" style="font-weight:bold; text-align:center;">Group</td>
        <td height="30" style="font-weight:bold; text-align:center;">Size</td>
        <td height="30" style="font-weight:bold; text-align:center;">Color</td>
        <td height="30" style="font-weight:bold; text-align:center;">Cost</td>
        <td height="30" style="font-weight:bold; text-align:center;">Selling Price</td>
        <td height="30" style="font-weight:bold; text-align:center;">Manufacturer ID</td>
    </tr>
    
    <?php
        $no=1;
        $sql="SELECT p.ProductID,p.Name,r.SKU,p.Detail,s.Category,s.Group,s.Size,s.Color,p.Cost,p.SellingPrice,p.ManufacturerID 
        FROM product_infomation p, remain r, skudetail s
        WHERE p.ProductID = r.ProductID
        AND    r.SKU = s.SKU
        ORDER BY p.ProductID";
        $query=mysqli_query($conn,$sql);
        while($data=mysqli_fetch_array($query)){
    ?>

    <tr>
        <td height="30" style="text-align:center;"><?php echo $no?></td>
        <td height="30" style="text-align:center;"><?php echo $data['ProductID'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['Name'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['SKU'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['Detail'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['Category'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['Group'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['Size'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['Color'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['Cost'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['SellingPrice'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['ManufacturerID'] ?></td>
    </tr>

    <?php
        $no++; 
        }
    ?>

</table>

<?php mysqli_close($conn); ?>
</center>
    </body>
</html>
