<!DOCTYPE HTML>
<html> 
<head>
        <meta charset="UTF-8">
        <title>Restockform</title>
        <link rel="stylesheet" href="../css/staff.css" type="text/css">
        <link rel="stylesheet"  href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
        <?php include "../php/db_connection.php";?>
    </head>
    <body>
        <div class="header">
            <h2 class="logo">MheeKaow</h2>
            <input type="checkbox" name="menu" id="chk">
            <label for="chk" class="show-menu-btn">
                <i class="fas fa-bars"></i>
            </label>
            <ul class="menu">
            <a href="../sa_productList.html">Product list</a>
                <a href="orderHistory.php">Order history</a>
                <a href="restockform.php">Stock history</a>
                <a href="manuList.php">Manufacturer</a>
                <a href="../login_staff.html">Log out (<?php getName() ?>)</a>
                <label for="chk" class="hide-menu-btn">
                    <i class="fas fa-times"></i>
                </label>
            </ul>
        </div>
        <h3>Insert Manufacturer</h3>

<form action="insert_manu_function.php" method="post">
Name: <input type="text" name="name_manu"><br>
<?php echo "<br>"; ?>
Address: <input type="text" name="add_manu"><br>
<?php echo "<br>"; ?>
Tel: <input type="tel" name="tel_manu"><br>
<?php echo "<br>"; ?>
Email: <input type="email" name="email_manu"><br>
<?php echo "<br>"; ?>
<input type="submit">
</form>

</body>
</html>