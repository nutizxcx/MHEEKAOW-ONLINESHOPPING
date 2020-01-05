
<?php
    $con = mysqli_connect('localhost','root','','db_project');
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_errno();
    }

    $email = mysqli_real_escape_string($con,$_POST['email']);
    $pass = mysqli_real_escape_string($con,$_POST['password']);
    $fname  = mysqli_real_escape_string($con,$_POST['firstName']);
    $lname  = mysqli_real_escape_string($con,$_POST['lastName']);
    $tel    = mysqli_real_escape_string($con,$_POST['telNo']);
    $dob    = mysqli_real_escape_string($con,$_POST['dob']);
    $gender = mysqli_real_escape_string($con,$_POST['gender']);
    $cardNumber = mysqli_real_escape_string($con,$_POST['cardNumber']);
    $exDate = mysqli_real_escape_string($con,$_POST['exDate']);
    $secCode = mysqli_real_escape_string($con,$_POST['secCode']);
    $address = mysqli_real_escape_string($con,$_POST['address']);

    $sql = "INSERT INTO customer (FirstName, LastName, DateOfBirth, Tel, Email, Gender, `Password`)
                VALUES ('$fname','$lname','$dob','$tel','$email','$gender','$pass')";
    
    mysqli_query($con,$sql);

    $qID = "SELECT MAX(CustomerID) FROM customer";

    $result = mysqli_query($con,$qID);
    if($id = mysqli_fetch_array($result)){
    $id = $id['MAX(CustomerID)'];
    

    $sql2 = "INSERT INTO `address` (AddressDescribe,CustomerID,`Default`)
                 VALUES ('$address',$id,1)";

    mysqli_query($con,$sql2);

    $sql3 = "INSERT INTO credit_card (CreditCardID, ExpiredDate, CVV, `Default`)
                VALUES ('$cardNumber', '$exDate', '$secCode',1)";

    mysqli_query($con,$sql3);

    $sql4 = "INSERT INTO customer_credit_card (CreditCardID, CustomerID)
    VALUES ('$cardNumber', $id)";
                
    mysqli_query($con,$sql4);

    
    
    
    
    header("location:http://localhost/register.html");
    mysqli_close($con);
    }
?>