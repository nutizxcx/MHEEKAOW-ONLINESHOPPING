<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order History | MheeKaow Co., Ltd.</title>
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
    <h3>
<?php 
    $checkboxx = $_POST['check'];
    $returnid= $_SESSION['passreturnid'];
    $orid=$_SESSION['passorderid'];
    $productid=$_SESSION['passproduct'];
    $sku=$_SESSION['passsku'];
    $tracking = $_POST['tracking'];

    for ($i=0;$i<sizeof($returnid);$i++) {
        $checkbox[$i] = 0;
    }

    for ($i=0;$i<sizeof($checkboxx);$i++) {
        $checkbox[$checkboxx[$i]] = 1;
    }

    $check="SELECT OrderID
            FROM order_history
            WHERE OrderID = (SELECT MAX(OrderID) FROM order_history)";
    $que=mysqli_query($conn,$check);
    $last=mysqli_fetch_array($que);

    $orderid = $last['OrderID']+1;

    for($i=0;$i<sizeof($returnid);$i++) {

        if ($checkbox[$i] == 1) {

            $insert="INSERT INTO order_product
                    VALUES ('$orderid','$productid[$i]','$sku[$i]',1,0)";
            $result=$conn->query($insert);

            if ($i+1 != sizeof($returnid)){
                if ($returnid[$i] != $returnid[$i+1])
                {
                    $check1="SELECT *
                            FROM order_history
                            WHERE OrderID = $orid[$i]";
                    $que1=mysqli_query($conn,$check1);
                    $last1=mysqli_fetch_array($que1);

                    $insert1="INSERT INTO order_history
                    VALUES ('$orderid','$last1[1]','$last1[2]','$last1[3]','$last1[4]',
                    NOW(),'RT','$tracking[$i]','$last1[8]','none','$last1[10]','$last1[11]',0,0)";
                    $result1=$conn->query($insert1);

                    if($result1){
                        echo "Success";
                    }
                    else{
                        echo "Failed";
                    }

                    $orderid++;
                }
            }
            else {
                $check1="SELECT *
                            FROM order_history
                            WHERE OrderID = $orid[$i]";
                    $que1=mysqli_query($conn,$check1);
                    $last1=mysqli_fetch_array($que1);

                    $insert1="INSERT INTO order_history
                    VALUES ('$orderid','$last1[1]','$last1[2]','$last1[3]','$last1[4]',
                    NOW(),'RT','$tracking[$i]','$last1[8]','none','$last1[10]','NULL',0,0)";
                    $result1=$conn->query($insert1);

                    if($result1){
                        echo "Success";
                    }
                    else{
                        echo "Failed";
                    }
            }
        }
    }
?>
</h3>
<form action="aeorderhistory.php" method="get">
    <input type="submit" value="Back">
</form>
<?php mysqli_close($conn); ?>
</center>
    </body>
</html>