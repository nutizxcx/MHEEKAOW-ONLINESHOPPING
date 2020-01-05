<?php
    session_start();
    $con = mysqli_connect('localhost','root','','db_project');
    
    $sql = " SELECT * FROM discount WHERE DiscountCode = '".$_POST['disCode']."' ";
    
    $sql1 = " SELECT * 
              FROM useddiscountby 
              WHERE DiscountCode = '".$_POST['disCode']."' 
              AND CustomerID = '".$_SESSION['id']."';";

    $result = mysqli_query($con,$sql);
    $result1 = mysqli_query($con,$sql1);

    $row = mysqli_fetch_array($result);
    $row1 = mysqli_fetch_array($result1);
    
    if(isset($row) == 0){
        echo 'fail1';
    }else if(isset($row1) ==0){
        echo json_encode($row);
    }else{
        echo 'fail2';
    }



?>