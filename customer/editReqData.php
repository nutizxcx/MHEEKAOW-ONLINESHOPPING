<?php
    session_start();
    $con = mysqli_connect('localhost','root','','db_project');
    $req = $_POST['req'];

    if($req == 0){
        $sql = "SELECT FirstName, LastName, DateOfBirth, Tel, Gender
                FROM customer
                WHERE CustomerID = '".$_SESSION['id']."'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        echo json_encode($row);
        mysqli_close($con);
    }else if($req ==1){
        $sql = "SELECT Email
                FROM customer
                WHERE CustomerID = '".$_SESSION['id']."'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        echo json_encode($row);
        mysqli_close($con);
    }else if($req == 2){
        $sql = "SELECT AddressID , AddressDescribe FROM `address` WHERE CustomerID = '".$_SESSION['id']."'";
        $result = mysqli_query($con,$sql);
        $arr = [];
        while($row = mysqli_fetch_array($result)){
            array_push($arr,$row);
        }
        echo json_encode($arr);
        mysqli_close($con);
    }else if($req == 3){
        $sql = "SELECT CreditCardID  FROM `customer_credit_card` WHERE CustomerID = '".$_SESSION['id']."'";
        $result = mysqli_query($con,$sql);
        $arr = [];
        while($row = mysqli_fetch_array($result)){
            array_push($arr,$row);
        }
        echo json_encode($arr);
        mysqli_close($con);
    }else if($req == 0.1){
        $fn = $_POST['firstName'];
        $ln = $_POST['lastName'];
        $time = strtotime($_POST['birthDay']);
        $bd = date('Y-m-d',$time);
        $tel = $_POST['tel'];
        $gender = $_POST['gender'];

        $sql = "UPDATE customer
                SET `FirstName` = '$fn', `LastName` = '$ln', `Tel`=$tel, `Gender`='$gender'
                WHERE CustomerID = '".$_SESSION['id']."'";

        if(mysqli_query($con,$sql)){
            echo "edit user success";
        }else{
            echo "edit user fail";
        }
        mysqli_close($con);
    }else if($req == 1.1){
        $pw = $_POST['pw'];
        $sql = " SELECT `Password` FROM customer WHERE CustomerID = '".$_SESSION['id']."' AND `Password` = '$pw' ";
        $result = mysqli_query($con,$sql);
        if($row = mysqli_fetch_array($result)){
            echo "password found";
        }else{
            echo "password not found";
        }
        mysqli_close($con);
    }else if($req == 1.2){
        $newpw = $_POST['newpw'];
        $sql = "UPDATE customer SET `Password` = '$newpw' WHERE CustomerID = '".$_SESSION['id']."';";
        if(mysqli_query($con,$sql)){
            echo "password is changed";
        }else{
            echo "fail to change pw";
        }
        mysqli_close($con);
    }else if($req == 2.1){
        $addID = $_POST['addID'];
        $newAdd = $_POST['newAdd'];
        $sql = "UPDATE `address`
                SET AddressDescribe = '$newAdd'
                WHERE CustomerID = '".$_SESSION['id']."' 
                AND AddressID = '$addID' ";

        if(mysqli_query($con,$sql)){
            echo "edit address success";
        }else{
            echo "edit address fail";
        }
    }else if($req == 2.2){
        $newAdd = $_POST['newAdd'];
        $sql = "INSERT INTO `address` (AddressDescribe,CustomerID,`Default`)
                VALUES ($newAdd,'".$_SESSION['id']."',1) ";
                
        if(mysqli_query($con,$sql)){
            echo "insert address success";
        }else{
            echo "insert address fail";
        }
    }else if($req == 2.3){
        $delAdd = $_POST['delAdd'];
        $sql = "DELETE FROM `address`
                WHERE AddressID = $delAdd ";

        if(mysqli_query($con,$sql)){
            echo "delete address success";
        }else{
            echo "delete address fail";
        }
    }else if($req == 3.2){
        $newCred = $_POST['newCred'];
        $newExpired = $_POST['newExpired'];
        $newCVV = $_POST['newCVV'];
        
        $sql = "INSERT INTO credit_card
                VALUES ($newCred,$newExpired,$newCVV,1);
               ";

        mysqli_query($con,$sql);

        $sql1 = "INSERT INTO `customer_credit_card`
                VALUES ($newCred,'".$_SESSION['id']."') ";

        if(mysqli_query($con,$sql1)){
            echo "insert credit card success";
        }else{
            echo "insert credit card fail";
        }
    }else if($req == 3.3){
        $delCred = $_POST['delCred'];
        $sql = "DELETE FROM `credit_card`
                WHERE CreditCardID = $delCred ";

        if(mysqli_query($con,$sql)){
            echo "delete credit success";
        }else{
            echo "delete credit fail";
        }
    }



?>