<?php include "connectdb.php";?>

<h2>Stock History</h2>
<form action="#" method="post">
<table border="1">
    <tr>
        <td height="30" style="font-weight:bold; text-align:center;">No.</td>
        <td height="30" style="font-weight:bold; text-align:center;">Stock Order ID</td>
        <td height="30" style="font-weight:bold; text-align:center;">Product ID</td>
        <td height="30" style="font-weight:bold; text-align:center;">Product Name</td>
        <td height="30" style="font-weight:bold; text-align:center;">Manufacturer ID</td>
        <td height="30" style="font-weight:bold; text-align:center;">Manufacturer Name</td>
        <td height="30" style="font-weight:bold; text-align:center;">Amount</td>
        <td height="30" style="font-weight:bold; text-align:center;">Category</td>
        <td height="30" style="font-weight:bold; text-align:center;">Group</td>
        <td height="30" style="font-weight:bold; text-align:center;">Size</td>
        <td height="30" style="font-weight:bold; text-align:center;">Color</td>
        <td height="30" style="font-weight:bold; text-align:center;">Date And Time</td>
    </tr>
    
    <?php
        $no=1;
        $sql="SELECT t.StockOrderID,k.ProductID,p.Name,t.ManufacturerID,m.Name,k.Amount,s.Category,s.Group,s.Size,s.Color,t.DateAndTime
        FROM stock_import t, stock_product_import k, product_infomation p, manufacturer m, skudetial s
        WHERE t.StockOrderID = k.StockOrderID
        AND k.ProductID = p.ProductID
        AND t.ManufacturerID = m.ManufacturerID
        AND k.SKU = s.SKU";
        $query=mysqli_query($conn,$sql);
        while($data=mysqli_fetch_array($query)){
    ?>

    <tr>
        <td height="30" style="text-align:center;"><?php echo $no?></td>
        <td height="30" style="text-align:center;"><?php echo $data['StockOrderID'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['ProductID'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data[2] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['ManufacturerID'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data[4] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['Amount'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['Category'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['Group'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['Size'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['Color'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['DateAndTime'] ?></td>
    </tr>

    <?php
        $no++; 
        }
    ?>

</table>

    <input type="submit" name="submit2" value="Submit" />

</form>

<?php mysqli_close($conn); ?>
