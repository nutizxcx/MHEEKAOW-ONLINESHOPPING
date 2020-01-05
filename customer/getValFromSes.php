<?php 
    session_start();
    echo json_encode($_SESSION['prodID'][$_POST['param']],$_SESSION['prodSKU'][$_POST['param']],$_SESSION['amount'][$_POST['param']]);
        

    

?>
