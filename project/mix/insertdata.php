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
    $manuid=$_POST["manu_id"];
    $staffid=$_SESSION["staffID"];
    $productid=$_SESSION['passproduct'];
    $sku=$_SESSION['passsku'];
    $cost=$_SESSION['passcost'];
    $amount=$_POST['amount'];
    $stockid = 1000000000;
    $check1 = 0;
    $check2 =0;
    $conn = openCon();
    $check="SELECT StockOrderID
            FROM stock_product_import
            WHERE StockOrderID = (SELECT MAX(StockOrderID) FROM stock_product_import)";
    $que=mysqli_query($conn,$check);
    $last=mysqli_fetch_array($que);

    if($last==NULL){
        $stockid++;
    }
    else{
        $stockid = $last['StockOrderID']+1;
    }

    for($i=0;$i<sizeof($amount);$i++){
        if($amount[$i] != 0){
            $check1++;
            $total[$i]=$amount[$i]*$cost[$i];

            $insert="INSERT INTO stock_product_import
                    VALUES ('$stockid','$productid[$i]','$sku[$i]','$amount[$i]','$total[$i]')";
            $result=$conn->query($insert);
        }
    }

    if($check1 != 0){
        $check2++;
        $insertstock="INSERT INTO stock_import
                    VALUES ('$stockid',NOW(),'$manuid','$staffid')";
        $resultstock=$conn->query($insertstock);
    }

    if($check2 != 0){
        echo "Success";
    }
    else{
        echo "Failed";
    }

?>
<form action="restockform.php" method="post">
    <input type="submit" name="submit3" value="Submit" />
</form>

<?php mysqli_close($conn); ?>
</body>
</html>
