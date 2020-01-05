<?php 
session_start();
if(isset($_GET['x']) === true && empty($_GET['y']) === false && empty($_GET['z']) ===false ){


    $con = mysqli_connect('localhost','root','','db_project');
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_errno();
    }

    
    $sql =  mysqli_query($con,"SELECT p.ProductID, s.SKU, p.Name, p.Detail, p.SellingPrice, r.Remain, s.Size, s.Color, s.Category
                               FROM product_infomation p 
                                JOIN remain r ON p.ProductID = r.ProductID
                                JOIN skudetail s ON r.SKU = s.SKU
                               WHERE p.ProductID = '".$_GET['x']."' AND s.Color = '".$_GET['y']."' AND s.Group = '".$_GET['z']."'
                               ORDER BY s.Size 
                        ");
    $arr =[];
    while($row = mysqli_fetch_array($sql)){
        array_push($arr,$row);
    }

    

    echo json_encode($arr); 
    mysqli_close($con);
}
?>