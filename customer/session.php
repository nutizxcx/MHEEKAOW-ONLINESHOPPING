<?php
    session_start();
    if($_POST['requestByAjax']==2 && isset($_SESSION['name'])){ //ดูว่า login หรือยัง
        echo 1;
    }else if( $_POST['requestByAjax']==1 && isset($_SESSION['name']) ){ //ดูว่า login หรือยัง
        $value = $_SESSION['name'];
        echo $value;
    }else if($_POST['requestByAjax']==0 ){ 
        session_destroy();
    }

?>