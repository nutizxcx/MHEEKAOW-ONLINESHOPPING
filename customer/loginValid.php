<?php

    

    if(isset($_POST['email']) === true && empty($_POST['email']=== false)){

        $con = mysqli_connect('localhost','root','','db_project');
	    if(mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_errno();
	    }

        $sql = mysqli_query($con,"SELECT *
                FROM customer
                WHERE `Email` = '".mysqli_real_escape_string($con,trim($_POST['email']))."'
                    AND `Password` = '".mysqli_real_escape_string($con,$_POST['pw'])."' 
            ");

        if($row = mysqli_fetch_array($sql)){
            session_start();
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['id'] = $row['CustomerID'];
            $_SESSION['name'] = $row['FirstName'];
            echo $row['FirstName'];
        }else echo 'Fail';
    }

    mysqli_close($con);

   
    

?>