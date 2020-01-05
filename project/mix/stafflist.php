<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Staff | MheeKaow Co., Ltd.</title>
    <link rel="stylesheet" href="../css/staff.css" type="text/css">
    <link rel="stylesheet"  href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/sa_home.js"></script>
    <?php include "../php/db_connection.php"; $conn = openCon();?>
</head>
<body>
    <div class="header">
        <h2 class="logo">MheeKaow</h2>
        <input type="checkbox" name="menu" id="chk">
        <label for="chk" class="show-menu-btn">
            <i class="fas fa-bars"></i>
        </label>
        <ul class="menu">
                <a href="productlist.php">Product</a>
                <a href="customerlist.php">Customer</a>
                <a href="manufacturerlist.php">Manufacturer</a>
                <a href="selllist.php">Order</a>
                <a href="trendlist.php">Trend</a>
                <a href="brokenlist.php">Broken Product</a>
                <a href="stocklist.php">Stock</a>
                <a href="stafflist.php">Staff</a>
                <a href="../login_staff.html">Log out (<?php getName() ?>)</a>
            <label for="chk" class="hide-menu-btn">
                <i class="fas fa-times"></i>
            </label>
        </ul>
    </div>
<center>
<h2>Staff list</h2>
<form action="addstaffform.php" method="post">
<input type="submit" name="submit2" value="Add Staff" style="display:block; position:fixed; margin: 0 70px; padding: 5px;" >
</form>
<form action="../ceo_deleteStaff.html" method="post"><br>
<input type="submit" name="submit4" value="Delete Staff" style="display:block; margin:60px 60px; position:fixed; padding: 5px;">
</form>
<table border="1">
    <tr>
        <td height="30" style="font-weight:bold; text-align:center;">No.</td>
        <td height="30" style="font-weight:bold; text-align:center;">Staff ID</td>
        <td height="30" style="font-weight:bold; text-align:center;">First Name</td>
        <td height="30" style="font-weight:bold; text-align:center;">Last Name</td>
        <td height="30" style="font-weight:bold; text-align:center;">Tel.</td>
        <td height="30" style="font-weight:bold; text-align:center;">E-mail</td>
        <td height="30" style="font-weight:bold; text-align:center;">Salary</td>
        <td height="30" style="font-weight:bold; text-align:center;">Role</td>
        <td height="30" style="font-weight:bold; text-align:center;">Gender</td>
    </tr>
    
    <?php
        $no=1;
        $sql="SELECT s.StaffID,s.FirstName,s.LastName,s.`Tel.`,s.Email,s.Salary,s.Role,s.Gender
        FROM staff s
        WHERE s.Role != 'FIRED'";
        $query=mysqli_query($conn,$sql);
        while($data=mysqli_fetch_array($query)){
    ?>

    <tr>
        <td height="30" style="text-align:center;"><?php echo $no?></td>
        <td height="30" style="text-align:center;"><?php echo $data['StaffID'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['FirstName'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['LastName'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['Tel.'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['Email'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['Salary'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['Role'] ?></td>
        <td height="30" style="text-align:center;"><?php echo $data['Gender'] ?></td>
    </tr>

    <?php
        $no++; 
        }
    ?>

</table>
<?php mysqli_close($conn); ?>
</center>
    </body>
</html>