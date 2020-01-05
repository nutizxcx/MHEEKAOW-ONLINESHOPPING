<?php

    $orderId = $_POST['orderIdReq'];
    $con = mysqli_connect('localhost','root','','db_project');
    $sql = " SELECT p.Name, s.Color, s.Size, o.Amount, p.SellingPrice, o.Subtotal
             FROM   product_infomation p JOIN order_product o ON o.ProductID =  p.ProductID
                                         JOIN skudetail s ON s.SKU = o.SKU
             WHERE  o.OrderID = $orderId;
             ";
    $result = mysqli_query($con,$sql);


    $arr = [];
    while($row = mysqli_fetch_array($result)){
        array_push($arr,$row);
    }

    echo json_encode($arr);
    mysqli_close($con);

?>