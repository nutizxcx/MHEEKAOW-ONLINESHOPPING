<?php
  session_start();
  if(isset($_SESSION['id'])){
    
    $con = mysqli_connect('localhost','root','','db_project');
    
    $sql = "SELECT CreditCardID
            FROM customer_credit_card
            WHERE CustomerID = '".$_SESSION['id']."'
            ";

      $result = mysqli_query($con,$sql);
      while($row = mysqli_fetch_array($result)){
        $credit[] = $row['CreditCardID'];
      }
      echo json_encode($credit);
    mysqli_close($con);
  }
?>