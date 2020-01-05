<?php
    $id = $_POST['prodID'];
    $color = $_POST['color'];
    $sex = $_POST['sex'];
    $con = mysqli_connect('localhost','root','','db_project');
    $sql = "SELECT ImagePath
            FROM `image` i  JOIN skudetail s ON i.SKU = s.SKU
            WHERE i.ProductID = $id
            AND s.Color = '$color' 
            AND s.Group = '$sex' ";
    $result = mysqli_query($con,$sql);
    if($row = mysqli_fetch_array($result)){
        echo $row['ImagePath'];
    }
    mysqli_close($con);
?>