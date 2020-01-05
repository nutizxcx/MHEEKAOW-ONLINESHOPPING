<?php
    session_start();
    $con = mysqli_connect('localhost','root','','db_project');
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_errno();
    }
    $request = $_POST['req'];

    if($request ==0 ){
        $cookies = $_POST['cookies'];  
        $prodSubtotal = $_POST['subTotal'];
        $cookies = json_decode($cookies,true);
        $lastID = $_POST['lastID'];

            $sql = "INSERT INTO order_product
                    VALUES ($lastID, '".$cookies['prodID']."' , '".$cookies['prodSKU']."' , '".$cookies['prodAmount']."', $prodSubtotal)
                ";
            
            $sql3 = "UPDATE remain 
            SET Remain = Remain - '".$cookies['prodAmount']."' 
            WHERE ProductID = '".$cookies['prodID']."' AND SKU = '".$cookies['prodSKU']."';
            ";

            if(mysqli_query($con,$sql3)){
                echo 'reduce success';
            }else{
                echo 'reduce fail';
            }

            if (!mysqli_query($con,$sql)) {
                die('Error: ' . mysqli_error($con));
                }

                
    }else if($request ==1){

        $sql = "SELECT FirstName, LastName, Tel FROM customer WHERE CustomerID = '".$_SESSION['id']."' ";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        $lastID = (integer) $_POST['lastID'];
        date_default_timezone_set("Asia/Bangkok");
        $date = date('Y-m-d H:i:s');
        $customerID = (integer)$_SESSION['id'];

        $discountCode = $_POST['discountCode'];
        $cusAddress = $_POST['cusAddress'];
        $cusCredit = $_POST['cusCredit'];
        $totalPrice = (integer)$_POST['totalPrice'];
        $netPrice = (integer)$_POST['netPrice'];

            $sql1 =  "INSERT INTO order_history (OrderID,CustomerID,FirstName,LastName,`Tel.`,`Status`,DateAndTime,DiscountCode,AddressDescribe,CreditCardID,Total,NetTotal)
            VALUES ($lastID,'".$customerID."' ,  '".$row['FirstName']."', '".$row['LastName']."','".$row['Tel']."','".'WT'."', '".$date."', '".$discountCode."' ,'".$cusAddress."','".$cusCredit."','".$totalPrice."','".$netPrice."');";

            if($discountCode != 'none'){
                
                $sql2 = "INSERT INTO useddiscountby
                         VALUES ('".$discountCode."', '".$_SESSION['id']."');";

                mysqli_query($con,$sql2);
            }

           

            if(mysqli_query($con,$sql1)){
                echo 'success2';
            }else{
                echo 'fail';
            }

    }
    
    
    
?>