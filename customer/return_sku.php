<!DOCTYPE html>
<html>
<head style='height:15px;'>
  <meta charset="utf-8" >
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
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
<br><br><br><br><br>
<?php
$con=mysqli_connect("localhost","root","","db_project");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$orderid = $_POST["orderid"];
$productid_select = $_POST["productID_select"];

$result = mysqli_query($con,"SELECT o.OrderID,o.ProductID ,o.SKU,p.Name,s.Size,s.Color,s.Group,s.Category
FROM order_product o JOIN product_infomation p ON o.ProductID = p.ProductID
JOIN skudetail s ON o.SKU = s.SKU WHERE o.OrderID = $orderid AND o.ProductID = $productid_select");

echo "<h1 style='position:absolute; left:42.5%;' >Return Detail</h1>";
echo "<br><br>";
$no=1;
?>
<br><br>
<div class="table-responsive-md">
  <table class="table" style='width:50%; position:absolute; left:24%;'>
      <tr style='font-size: 15px;'>
        <th >No.</th>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>SKU</th>
        <th>Size</th>
        <th>Color</th>
        <th>Group</th>
        <th>Category</th>
      </tr>


        <?php 
          while($row = mysqli_fetch_array($result))
          {
            ?>
            <tr style='font-size: 15px;'> 
              <td><?php echo $no  ?></td>
              <td><?php echo $row['ProductID']  ?></td>
              <td><?php echo $row['Name']  ?></td>
              <td><?php echo $row['SKU']  ?></td>
              <td><?php echo $row['Size']  ?></td>
              <td><?php echo $row['Color']  ?></td>
              <td><?php echo $row['Group']  ?></td>
              <td><?php echo $row['Category']  ?></td>
            </tr>
          <?php
          $no++;
          }
          ?> 

  </table>
</div>
<br><br><br><br><br><br><br><br><br><br>
  <h3 style=' position:absolute; left:24.5%; '> Reason of returning the product.</h3>
  <br><br>
  <p style='font-size:15px; position:absolute; left:24.5%;'>Select Product Detail: </p>
  
    <form action="return_function.php" method="post" name="select_sku" style='font-size:15px; position:absolute; left:40.5%;'> 
          <select name="sku_select" style='font-size:15px; position:absolute; left:24.5%;'>
          
            <option value="0"><-- Please Select --></option>
            <?php
            $objQuery = mysqli_query($con,"SELECT o.ProductID,p.Name,o.SKU,o.OrderID,s.Color,s.Size FROM order_product o JOIN product_infomation p ON o.ProductID = p.ProductID JOIN skudetail s ON o.SKU = s.SKU WHERE o.OrderID = $orderid AND o.ProductID = $productid_select ");
            
            while($row = mysqli_fetch_array($objQuery))
            {
              ?>
               <option value="<?php echo $row['SKU'] ?> "> <?php echo " SKU: ". $row['SKU'] ." Color: ".$row['Color']." Size: ".$row['Size'] ?> </option>
            
            <?php
            }
            ?> 
          </select>
          <br><br>
          <p style='font-size:15px; position:absolute; right:159%;'>Reason:</p>

          <select name="reason" id="reason" style='font-size:15px; position:absolute; left:24.5%;'>
            <option value="0"><-- Please Select --></option>
            <option value="INE">Incomplete equipments</option>
            <option value="DMG">Damaged</option>
            <option value="WRP">Wrong product</option>
            <option value="ETC">Other reson</option>
          </select>
            <br><br>
          <p style='font-size:15px; position:absolute; right:159%; '>Detail:</p>
           <input type="text" name="detail" value="" style='font-size:15px; position:absolute; left:24.5% '><br><br><br><br>
          <input type="hidden" name="orderid" value="<?php echo $orderid  ?>"> 
          <input type="hidden" name="productID_select" value="<?php echo $productid_select  ?>"> 
          <input class='returnChooseBut' name="btnSubmit" type="submit" value="Submit" style='width:100%; margin-left:50px;'>
    </form>
    <br><br><br><br>

<?php
mysqli_close($con);
?>


<!--login-->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div id="login" style="height: 400px; ">
                      <form id='loginForm' action="#" method="POST" style='display: block;'>
                          <br>
                          <div class="rha" style="display: inline; margin: 25px 0 10px 0; ">
                              <hr class="hr1" />
                              <hr class="hr2" />
                              <h2 style="text-align:center; margin-top: 5px; padding: 0;">
                                Login
                              </h2>
                            </div>
                            <br>
                          <label style="position: absolute; left:256px"
                              >Email</label
                            >
                            <br />
                            <input
                              id ="emailLog"
                              class="input1"
                              type="email"
                              style="width: 35%;"
                              autofocus
                            />
                            <br> <br>
                            <label style="position: absolute; left:256px"
                              >Password</label
                            >
                            <br />
                            <input
                              id = 'passLog'
                              class="input1"
                              type="password"
                              style="width: 35%;"
                            />
                            <br> <br> <br> <br>
                            <input id='loginSub' type="button" value="Login" > <br>
                            <span class='test'></span>
                            
          
                      </form>
                      <div class="loginSuccess" style='display:none;' >
                        <h1 style="position:absolute; top:170px; left:320px;">Welcome</h1>
                        <h6 style="position: relative; top:220px; font-size: 14px;">Please click outside the box to close the tab</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        <!--register-->
        <div
          class="modal fade bd-example-modal-xl"
          tabindex="-1"
          role="dialog"
          aria-labelledby="myExtraLargeModalLabel"
          aria-hidden="true"
          >
    
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
    
                <div id="regisNav">
                  <br />
                  <div class="rha" style="display: inline; margin: 15px 0 10px 0; ">
                    <hr class="hr1" />
                    <hr class="hr2" />
                    <h2 style="text-align:center; margin-top: 5px; padding: 0;">
                      Register
                    </h2>
                  </div>
                  <br />
                  <span class="dot">1</span> <span>&#10230;</span>
                  <span class="dot">2</span> <span>&#10230;</span>
                  <span class="dot">3</span> <span>&#10230;</span>
                  <span class="dot">4</span>
                  <br />
                  <br />
                </div>
    
                <div id='regisForm'>
                  <br />
                  <form id="registerForm" action="register.php" method="POST">
                    <div class="tab" style="display: block; height: 500px;">
                      <label class="regisEmail" style="position:relative; right:125px;"
                        >Email</label
                      >
                      <br />
                      <input
                        id="Email"
                        class="input1"
                        type="email"
                        name="email"
                        autofocus
                        style="position: sticky;"
                        onkeyup="checkInput(0,0)"
                      />
                      <br />
                      <span
                        id="emailValid"
                        style="font-size:11px; padding:0; margin:0; position:relative; right: 75px;text-align: left; "
                      ></span>
                      <br />
                      <label class="regisPassword" style="position:relative; right:110px;"
                        >Password</label
                      >
                      <br />
                      <input
                        class="input1"
                        type="password"
                        name="password"
                        id="myPass"
                        onkeyup="confirmPassword(), checkInput(0,1)"
                      />
                      <br />
                      <br />
                      <!-- <input  type = 'checkbox' onclick = 'showPassword()'> Show Password <br> -->
                      <label class="regisConfirm" style="position:relative; right:114px;"
                        >Confirm</label
                      ><br />
                      <input
                        class="input1"
                        type="password"
                        name="confpass"
                        id="confPass"
                        onkeyup=" confirmPassword()"
                      />
                      <br />
                      <br />
                      <br />
                      <br />
                      <!-- <input type = 'button' name = 'next1' value = 'Next' onclick='validForm(0)'> -->
                    </div>
    
                    <div class="tab" style="display: none; height: 500px;">
                      <span style="position: relative; right: 182px; ">First Name</span>
                      <span style="position: relative; left: 30px;">Last Name</span>
                      <br />
                      <input
                        class="input2_1"
                        type="text"
                        name="firstName"
                        autofocus
                        onkeyup="checkInput(1,0)"
                      />
                      <input
                        class="input2_1"
                        type="text"
                        name="lastName"
                        onkeyup="checkInput(1,1)"
                      />
                      <br />
                      <br />
                      <span style="position:relative; right:195px;"
                        >Telephone Number</span
                      >
                      <br />
                      <input
                        class="input2_2"
                        type="text"
                        name="telNo"
                        onkeyup="checkInput(1,2)"
                      />
                      <br />
                      <br />
                      <span style="position:relative; right:216px">Date of Birth</span>
                      <br />
                      <input
                        class="input2_3"
                        type="date"
                        name="dob"
                        onkeyup="checkInput(1,3)"
                      />
                      <br />
                      <br />
                      <span style="position:relative; right:236px;">Gender</span> <br />
                      <div class="input2_4">
                        <input
                          type="radio"
                          name="gender"
                          id="m"
                          value="m"
                          style="position: relative; left:7px;"
                        />
                        <label for="m" style="position: relative; left: 7px;"
                          >Male</label
                        >
                        <input
                          type="radio"
                          name="gender"
                          id="f"
                          value="f"
                          style="position: relative; left:45px;"
                        />
                        <label for="f" style="position: relative; left: 45px;"
                          >Female</label
                        >
                        <input
                          type="radio"
                          name="gender"
                          id="u"
                          value="u"
                          style="position: relative; left:75px;"
                          checked
                        />
                        <label for="u" style="position: relative; left: 75px;"
                          >Undefined</label
                        >
                        <br />
                      </div>
                      <br />
                      <br />
                    </div>
    
                    <div class="tab" style="display:none; height: 500px;">
                      <span style="position:relative; right:174px;">Address</span>
                      <br />
                      <textarea
                        rows="7"
                        cols="50"
                        name="address"
                        onkeyup="checkInput(2,0)"
                        style="background:#F8F9F9; border:1px solid #CACFD2; padding: 5px 20px; font-size: 13px;"
                      ></textarea>
                      <br />
                      <br />
                      <br />
                      <br />
                    </div>
    
                    <div class="tab" style="display: none; height: 500px;">
                      <span style="position: relative; right:150px;">Card Number</span>
                      <br />
                      <input
                        class="input4_1"
                        type="text"
                        name="cardNumber"
                        onkeyup="checkInput(3,0)"
                        autofocus
                      />
                      <br />
                      <br />
                      <br />
                      <span style="position: relative; right:90px"
                        >Expiration Date
                      </span>
                      <span style="position: relative; left:45px">Security Code</span>
                      <br />
                      <input
                        class="input4_2"
                        type="month"
                        name="exDate"
                        onkeyup="checkInput(3,1)"
                      />
                      <input
                        class="input4_3"
                        type="text"
                        name="secCode"
                        onkeyup="checkInput(3,2)"
                      />
                      <br />
                      <br />
                      <br />
                    </div>
    
                    <!-- <div class="loginSuccess" style='display:none;' >
                        <h1 style="position:absolute; top:170px; left:320px;">Registration Successful!</h1>
                        <h6 style="position: relative; top:220px; font-size: 14px;">Please click outside the box to close the tab</h6>
                    </div> -->
    
                
                </div>
    
                <div id='regisPage'>
                    <input
                      id="prev"
                      type="button"
                      value="Previous"
                      style="display: none; margin: 0 30px 0 30px; font-size: 15px;"
                      onclick="display(currentPage -= 1), displayButton(currentPage),dot()  "
                    />
                    <input
                      id="next"
                      type="button"
                      value="Next"
                      style="display: inline; margin: 0 30px 0 30px; font-size: 15px;"
                      onclick="validForm(currentPage), displayButton(currentPage),dot()"
                    />
                </div>
              </form>
              </div>
            </div>
            </div>

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</html>


