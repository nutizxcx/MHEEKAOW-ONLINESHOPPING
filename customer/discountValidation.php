<?php
    $disCode = $_POST['disCode'];
    $con = mysqli_connect('localhost','root','','db_project');

    $sql = "SELECT DiscountCode FROM discount WHERE DiscountCode = '".$disCode."';";

    $result = mysqli_query($con,$sql);
    if(mysqli_fetch_array($result)){
        echo 1;
    }else{
        echo 0;
    }

    mysqli_close($con);

?>