<?php
     $con = mysqli_connect('localhost','root','','db_project');
     if(mysqli_connect_errno()){
         echo "Failed to connect to MySQL: " . mysqli_connect_errno();
     }

    $sql = mysqli_query($con,"SELECT MAX(OrderID) FROM order_product;");
    $lastID = mysqli_fetch_array($sql);
    $lastID = $lastID['MAX(OrderID)'];
    echo $lastID;
     mysqli_close($con);
?>