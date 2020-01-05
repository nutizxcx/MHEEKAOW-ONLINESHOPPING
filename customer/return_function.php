<!DOCTYPE html>
<html>
<head style="height:15px;">
      <meta charset="utf8">
      <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link rel="stylesheet"  type="text/css" href="register.css" />
    <title>MHEEKAOW</title>
    <link rel="icon" href="https://cf.shopee.co.th/file/19099adae752f468145338551b64da3c_tn">
</head>
  
  <nav>
    <div id="navDetail">
        <p class="regisBut" data-toggle="modal" data-target=".bd-example-modal-xl">
            Register
          </p>
        <p class="loginBut" data-toggle="modal" data-target=".bd-example-modal-lg">
            Login
          </p>

        <div class="logoutBut" style="display: none;">
            <p class='welcome'></p> 

            <div id="mndropdown" style="display:inline-block; height: 40px;">
                <a class='manageBut' href='#' style="display:none;">Manage</a>
                <div id="mndropdown-content" style="display:none;">
                  <a href='shippingHist.php'>Shipping</a>
                  <a href='return_request.php'>Returns</a>
                  <a href='#'>link3</a>
                  <a href='#'>link4</a>
                  <a href='editAccount.php'>Account</a>
                </div>
            </div>

            <a href="cart.php"> <img class='cartLogo' src="https://image.flaticon.com/icons/svg/1170/1170627.svg"> </a>
            <a class='logout' href="#">log out</a>
        </div>

        <a href='register.html'><img src="https://cf.shopee.co.th/file/19099adae752f468145338551b64da3c_tn" style="height: 40px; width: auto; margin: 0 7px 0 35px; float: left; position: relative; bottom: 4px;"></a>
        <div id="shoesGroup" >

          
          <h1 style="display: inline; font-size:15px; margin: 0 30px 0 7px;  ">MHEEKAOW</h1>  
        
          <div id="maledropdown" style="display:inline-block; height: 40px; ">
              <a class='maleShoes' href="/male.html" >Male</a>
              <div id="maledropdown-content" style="display:none;">
                <a href='#'>link1</a>
                <a href='#'>link2</a>
                <a href='#'>link3</a>
                <a href='#'>link4</a>
                <a href='#'>link5</a>
              </div>
          </div>

          <div id="femaledropdown" style="display:inline-block;  height: 40px;">
          <a class='femaleShoes' href="#">Female</a>
          <div id="femaledropdown-content" style="display:none;">
              <a href='#'>link1</a>
              <a href='#'>link2</a>
              <a href='#'>link3</a>
              <a href='#'>link4</a>
              <a href='#'>link5</a>
            </div>
          </div>

          <div id="unidropdown" style="display:inline-block; height: 40px;">
          <a class='unisexShoes' href="#">Unisex</a>
          <div id="unidropdown-content" style="display:none;">
              <a href='#'>link1</a>
              <a href='#'>link2</a>
              <a href='#'>link3</a>
              <a href='#'>link4</a>
              <a href='#'>link5</a>
            </div>
          </div>


        </div>

        <!-- <form class="form-inline mr-auto" style="display:inline; position: relative; bottom:5px; left: 300px;">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn blue-gradient btn-rounded btn-sm my-0" type="submit">Search</button>
          </form> -->

        <br>
        <hr style="width: 100%; margin: 20px 0 0 0; padding: 0;">
      </div>
  </nav>

<body>
  <br><br><br><br><br><br><br><br><br><br>
<?php
$con=mysqli_connect("localhost","root","","db_project");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$productID_select = $_POST["productID_select"];
$reason_select = $_POST["reason"];
$detail_select = $_POST["detail"];
$orderid = $_POST['orderid'];
$sku_select = $_POST['sku_select'];
//echo $orderid;
//echo "<br>";
//echo $productID_select;
//echo "<br>";
//echo $reason_select;
//echo "<br>";
//echo $detail_select;
//echo "<br>";
date_default_timezone_set("Asia/Bangkok");
$date = date('Y-m-d H:i:s');
//echo $sku_select;
//echo "<br>";


$checkorderid = mysqli_query($con,"SELECT MAX(r.ReturnID) AS returnid_select FROM return_detail r JOIN order_product o  WHERE o.OrderID = $orderid ");
$checkSameorderid = mysqli_query($con,"SELECT r.ReturnID FROM return_detail r JOIN order_product o  WHERE o.OrderID = $orderid ");
while($row = mysqli_fetch_array($checkorderid))
    {
        if(!$row['returnid_select'])
        {
            $returnid_select=100000;
        }
        else
        {
            while($row = mysqli_fetch_array($checkSameorderid))
            {
                if(!$row['ReturnID'])
                {
                    $returnid_select = $row['returnid_select'];
                    $returnid_select++;
                }
                else
                {
                    $returnid_select = $row['ReturnID'];
                }
            }
            
            
        }
    }

$no=1;
$checkno = mysqli_query($con,"SELECT MAX(ItemNo) AS itemno FROM return_detail GROUP BY ReturnID ");
while($row = mysqli_fetch_array($checkno))
    {
        if(!$row['itemno'])
        {
            $no=1;
        }
        else
        {
            $no = $row['itemno'];
            $no++;
        }
    }

//echo $no;
// echo $returnid_select;
//echo "<br>";
//echo $orderid;
//echo "<br>";
//echo $date;
//echo "<br>";
if ($InsToReturnDetail = $con->query("INSERT INTO return_detail(ReturnID, ItemNo, ProductID, SKU, Reason, Detail) VALUES ('".$returnid_select."','".$no."','".$productID_select."','".$sku_select."','".$reason_select."','".$detail_select."')"))
{
    if($InsToReturnRequest = $con->query("INSERT INTO return_request(ReturnID,OrderID,DateAndTime) VALUES('".$returnid_select."','".$orderid."','".$date."')"))
    {
        echo "Success, your return request will be response soon.";
    }
    else
    {
        if($checksamereturninsert = $con->query("SELECT ReturnID FROM return_request WHERE ReturnID = $returnid_select"))
        {
            echo "Success, your return request will be response soon.";
        }
        else
        {
            echo "error can't insert to ReturnRequest";
        }
        
    }
    
}
else 
{
    echo "error can't insert to ReturnDetail";
}


?>

<?php
mysqli_close($con);
?>


</body>

<footer style='height:313px; width:100%; background-color:black; margin-top:250px; padding:0; display: block;'>
    <p style='color:white; font-size: 25px; padding: 35px 0 0 100px;'>MHEEKAOW</p>
    <div class="contact" style="display: block; width:50%; ">
    <img src='https://www.yanheenursinghome.com/wp-content/themes/yanheenursinghome/images/icon/fa.png' style='height: 35px; padding:5px 0 0 95px;'>
      <p style='display:inline; font-size: 14px; margin: 5px 0 0 25px; color:white; '>MHEEKAOW</p> <br>
      <img src='https://clipart.info/images/ccovers/1522452763logo-instagram-png-white.png' style='height: 35px; padding:5px 0 0 95px;'>
      <p style='display:inline; font-size: 14px; margin: 5px 0 0 25px; color:white; '>MHEEKAOW</p> <br>
      <img src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSVIDkVnSoTaQYlpeazEe95cwZs8dXNV3NvNFOQHq-qx3hVZGIZ' style='height: 35px; padding:5px 0 0 95px;'>
      <p style='display:inline; font-size: 14px; margin: 5px 0 0 25px; color:white; '>MHEEKAOW</p><br>
      
    </div>

    <div class="memberName" style='display:inline; position: relative; bottom: 100px; left:50px;'>
      <p style='font-size: 14px; color:white; padding: 0 0 0 550px; display: inline;'> Member</p>
      <p style='font-size: 14px; color:white; padding: 0 0 0 150px; display: inline;'> 60070501002    Kittipong   Sirigate</p> <br>
      <p style='font-size: 14px; color:white; padding: 0 0 0 758px; display: inline;'> 60070501009    Chanakarn   Sapdeemeecharoen</p> <br>
      <p style='font-size: 14px; color:white; padding: 0 0 0 758px; display: inline;'> 60070501034    Phonthakorn Chanprasoet</p> <br>
      <p style='font-size: 14px; color:white; padding: 0 0 0 758px; display: inline;'> 60070501036    Pasit       Hankijpongpan</p> <br>
      <p style='font-size: 14px; color:white; padding: 0 0 0 758px; display: inline;'> 60070501009    Pisut       Suntronkiti</p> 
 
    </div>
      
  </footer>

<script
    src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"
  ></script>
  <script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
  <script src="cookieJS.js"></script>
  <script src="register.js"></script>
  <script src="login.js"></script>
  <script src="logout.js"></script>
  <script src="pic.js"></script>

</html>