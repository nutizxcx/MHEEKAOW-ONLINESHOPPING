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
            "SELECT si.StockOrderID, sp.ProductID, p.Name, si.ManufacturerID, m.Name AS Factor, sp.Amount, sp.SKU, si.DateAndTime
            FROM stock_import si 
                JOIN stock_product_import sp ON si.StockOrderID = sp.StockOrderID
                JOIN product_infomation p ON sp.ProductID = p.ProductID
                JOIN manufacturer m ON si.ManufacturerID = m.ManufacturerID
            ORDER BY si.DateAndTime");
        closeCon($conection);
        $no = 1;
        $html = '<table border="1">';
        $html = $html.'<tr>';
        $html = $html.'<td height="30" style="font-weight:bold; text-align:center;">No.</td>';
        $html = $html.'<td height="30" style="font-weight:bold; text-align:center;">Date And Time</td>';
        $html = $html.'<td height="30" style="font-weight:bold; text-align:center;">Stock Order ID</td>';
        $html = $html.'<td height="30" style="font-weight:bold; text-align:center;">Product ID</td>';
        $html = $html.'<td height="30" style="font-weight:bold; text-align:center;">SKU</td>';
        $html = $html.'<td height="30" style="font-weight:bold; text-align:center;">Product Name</td>';
        $html = $html.'<td height="30" style="font-weight:bold; text-align:center;">Manu. ID</td>';
        $html = $html.'<td height="30" style="font-weight:bold; text-align:center;">Manu. Name</td>';
        $html = $html.'<td height="30" style="font-weight:bold; text-align:center;">Amount</td>';
        $html = $html.'</tr>';
        while($data = mysqli_fetch_array($result)) {
            $html = $html.'<tr>';
            $html = $html.'<td height="30" style="text-align:center;">'.$no.'</td>';
            $html = $html.'<td height="30" style="text-align:center;">'.$data['DateAndTime'].'</td>';
            $html = $html.'<td height="30" style="text-align:center;">'.$data['StockOrderID'].'</td>';
            $html = $html.'<td height="30" style="text-align:center;">'.$data['ProductID'].'</td>';
            $html = $html.'<td height="30" style="text-align:center;">'.$data['SKU'].'</td>';
            $html = $html.'<td height="30" style="text-align:center;">'.$data['Name'].'</td>';
            $html = $html.'<td height="30" style="text-align:center;">'.$data['ManufacturerID'].'</td>';
            $html = $html.'<td height="30" style="text-align:center;">'.$data['Factor'].'</td>';
            $html = $html.'<td height="30" style="text-align:center;">'.$data['Amount'].'</td>';
            $html = $html.'</tr>';
            $no++;
        }
        $html = $html.'</table>';
        echo $html;
    }
?>