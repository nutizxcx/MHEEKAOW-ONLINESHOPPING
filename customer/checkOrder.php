<?php
    session_start();
    if(isset($_SESSION['id'])){
    $con = mysqli_connect('localhost','root','','db_project');
    $sql = " SELECT * FROM order_history WHERE CustomerID = '".$_SESSION['id']."' ";
    $result = mysqli_query($con,$sql);
        if($row = mysqli_fetch_array($result)){
            echo "ok";
        }else{
            echo "empty";
        }
    }else{
        echo "empty";
    }

?>