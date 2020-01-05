<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Restockform</title>
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
        <h3>Restock Form</h3>


<?php
    $manuid=$_POST["manufacturer"];
    $staffid=$_SESSION["staffID"];
    $conn = openCon();
?>

<form action="insertdata.php" method="post">
<table border="1">
    <tr>
        <td height="30" style="font-weight:bold; text-align:center;">No.</td>
        <td height="30" style="font-weight:bold; text-align:center;">Product ID</td>
        <td height="30" style="font-weight:bold; text-align:center;">SKU</td>
        <td height="30" style="font-weight:bold; text-align:center;">Amount</td>
    </tr>
    
    <?php
        $no=1;
        $n=0;
        $sql="SELECT p.ProductID,r.SKU,p.Cost 
            FROM product_infomation p, remain r
            WHERE p.ProductID = r.ProductID
            AND p.ManufacturerID = '$manuid'
            ORDER BY ProductID";
        $query=mysqli_query($conn,$sql);
        while($data = mysqli_fetch_array($query)) {
    ?>

    <tr>
        <td height="30" style="text-align:center;"><?php echo $no?></td>
        <td height="30" style="text-align:center;"><?php echo $data['ProductID']; $productid[$n]=$data['ProductID'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['SKU']; $sku[$n]=$data['SKU'] ?></td>
        <?php ['Cost']; $cost[$n]=$data['Cost']; ?>
        <td class="amountinput" height="30" style="text-align:center;"><input type='number' name='amount[]' min="0" value="0" /></td>
    </tr>
    <?php
        $no++;
        $n++; 
        }
    ?>
</table>

    <input type="submit" name="submit2" value="Submit" />
    <input type="hidden" name="manu_id" value="<?=$manuid;?>" />
    <input type="hidden" name="staff_id" value="<?=$staffid;?>" />
</form>

    <?php
        $_SESSION['passproduct']=$productid;
        $_SESSION['passsku']=$sku;
        $_SESSION['passcost']=$cost;
    ?>

<?php mysqli_close($conn); ?>
    </body>
</html>
