<?php
    include 'db_connection.php';
    $_REQUEST['f']();

    function getNameUser() {
        echo getName();
    }

    function queryData() {
        $html = '';
        $conection = openCon();
        $result = mysqli_query($conection, 
            "SELECT p.ProductID, p.Name, p.Detail, s.Category, s.Group, p.Cost, m.Name AS firm, p.SellingPrice, s.Size, s.Color, r.Remain
            FROM product_infomation p
                JOIN manufacturer m ON p.ManufacturerID = m.ManufacturerID
                JOIN remain r ON p.ProductID = r.ProductID
                JOIN skudetail s ON r.SKU = s.SKU
            ORDER BY ProductID DESC");
        while($row = mysqli_fetch_array($result)) {
            $html = $html.'<tr><td>image</td>';
            $html = $html.'<td><b>';
            $html = $html.$row['ProductID'].' | '.$row['Name'].'</b><br>Detail: ';
            $html = $html.$row['Detail'].' - By '.$row['firm'].'<br>Category: ';
            $html = $html.$row['Category'].'   Group: '.$row['Group'].'<br>Color: ';
            $html = $html.$row['Color'].'   Size: '.$row['Size'].'<br><b>Cost: ';
            $html = $html.$row['Cost'].'   Selling Price: '.$row['SellingPrice'].'</b><br>Remains: ';
            $html = $html.$row['Remain'].'<br><br></td></tr>';
        }
        echo $html;
    }
?>