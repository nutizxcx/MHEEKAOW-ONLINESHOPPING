<!DOCTYPE html>
<html>
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
<?php
$con=openCon();
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$name = $_POST["name_manu"];
$email = $_POST["email_manu"];
$tel = $_POST["tel_manu"];
$address = $_POST['add_manu'];


$checkmanuID = mysqli_query($con,"SELECT MAX(ManufacturerID) AS manufacturerid FROM manufacturer ");

while($row = mysqli_fetch_array($checkmanuID))
{
        if(!$row['manufacturerid'])
        {
            $manuid=1000;
        }
        else
        {
            $manuid = $row['manufacturerid'];
            $manuid++;
        }
}

if ($InsTomanu = $con->query("INSERT INTO manufacturer (ManufacturerID, Address , Name, `Tel.`, Email) VALUES ('$manuid','$address','$name','$tel','$email')"))
{
    echo "success";  
}
else
{
    echo "error can't insert to Manufacturer";
}

?>

</body>
</html>