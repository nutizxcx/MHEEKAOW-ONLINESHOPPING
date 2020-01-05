<?php
    session_start();
    $con = mysqli_connect('localhost','root','','db_project');
    $sql = "SELECT COUNT(CustomerID) 
            FROM `address` 
            WHERE CustomerID = '".$_SESSION['id']."' 
            GROUP BY CustomerID";
    
    $sql1 = "SELECT COUNT(CustomerID) 
             FROM `customer_credit_card` 
             WHERE CustomerID = '".$_SESSION['id']."' 
             GROUP BY CustomerID";

    $result = mysqli_query($con,$sql);
    $result1 = mysqli_query($con,$sql1);

    $row = mysqli_fetch_array($result);
    $row1 = mysqli_fetch_array($result1);
    mysqli_close($con);

?>
<html>
        <head style="height:15px;">
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
                          <a class='maleShoes' href="male.html" >Male</a>
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
        
        <br><br><br><br><br><br><br><br>
        <div id='editMenu' style='position:absolute; left:45%; top:37%; ' >
            <h5 class='editUser'>Edit Personal data</h5>
            <h5 class='editID'>Edit Username</h5>
            <h5 class='editAddress'>Edit Address</h5>
            <h5 class='editCredit'>Edit Credit</h5>
        </div> 

        <div id='editUser' style='display:none; position:absolute; left:45%;'>
            <h3 style='positon:absolute; right:10%;'>Edit personal data</h3>
            <p style='padding:0; margin:0;'>First name</p>
            <input class='firstName' type='text' style='padding-left:7px;'> 
            <p style='padding:0; margin:0;'>Last name</p>
            <input class='lastName' type='text' style='padding-left:7px;'> 
            <p style='padding:0; margin:0;'>Birthday</p>
            <input class='birthDay' type='date' style='padding-left:7px;'> 
            <p style='padding:0; margin:0;'>Telephone</p>
            <input class='tel' type='text' style='padding-left:7px;'> 
            <p style='padding:0; margin:0;'>Gender</p>
            <select class='gender' type='text' style='padding-left:7px;'> 
              <option value='m'>male</option>
              <option value='f'>female</option>
              <option value='u'>undefined</option>
            </select>
            <br><br>
            <input class='chgUsrData' type='button' value='submit'>
        </div>

        <div id='editID' style='display:none; position:absolute; left:45%; top:29%;'>
              <h3>Edit password</h3>
            <div class='checkOldPass'>
              <p style='padding:0; margin:0; '>Username</p>
              <input class='email' style='border:0;' disabled>
              <p style='padding:0; margin:0; '>Password</p>
              <input class='pw' style='padding-left:7px;' type='password'> <br><br>
              <input class='toNewPass' value='next' type='button' style='margin-left:40px;'>
            </div>
            <div class='setNewPass' style='display:none;'>
              <p style='padding:0; margin:0; '>New password</p>
              <input class='newPw' type='password' style='padding-left:7px;'>
              <p style='padding:0; margin:0; '>Confirm password</p>
              <input class='cnfnewPw' type='password' style='padding-left:7px;'> <br><br>
              <input class='chgPass' value='submit' type='button' style='margin-left:40px;' >
            </div>
        </div>

        <div id='editAddress' style='display:none; width:25%; position:absolute; left:42%; top:28%;' >
        <h3>Edit Address</h3>
        <p style='padding:0px; margin:0;'>Address</p>
            <?php
              for($i=0; $i < 3 ;$i++){ ?>
                  <?php if($i < (int)$row['COUNT(CustomerID)']) {?>
                    
                    <input class='address' style='padding:7px;  margin:0; font-size:13px; width:89.7%;' >
                    
                    <?php if($i!=0){?>

                        <p class='addAdd' style="display:none; margin:0; color:#2E86C1;">+ Add</p>
                        <button class='delAdd' style='font-size:13px; border:0; background:0; margin:0; '>x</button>


                    <?php } ?>
                  
                 
                  <?php  
                  }else{?>
                  <div style="display:flex; width:340px;">
                      <input class='address' style='display:none; padding:7px;  margin:0; font-size:13px; width:100%; '>
                      <p class='addAdd' style='color:#2E86C1; positon:relative; margin:0; top:40px;'>+ Add</p> 
                      <button class='delAdd' style='display:none; font-size:13px;  margin:0; border:0; background:0; '>x</button>
                  </div>
            <?php  
            }}?>

            <br><br>
            <input class='chgAdd' value='submit' type='button' style='margin-left:80px;'>
        </div>

        <div id='editCredit' style='display:none; position:absolute; left:45%'>
            <h3>Edit credit card</h3>
            <?php
              for($i=0; $i < 3 ;$i++){ ?>
                  <?php if($i < (int)$row1['COUNT(CustomerID)']) {?>
                    <p class='creditlab' style='padding:0; margin:0;'>credit card number</p>
                    <input class='credit' style='padding:0; margin:0;'>
                    <p class='addCred' style='display:none; color:#2E86C1; padding:0; margin:0;'>+ Add</p> 
                    <p class='creditExpiredlab'style='display:none; padding:0; margin:0;'>expired date</p>
                    <input class='creditExpired' type='month' style='display:none;'>
                    <p class='credCVVlab' style='display:none; padding:0; margin:0;'>cvv</p>
                    <input class='credCVV' style='display:none;'>
                    <button class='delCred' style='font-size:13px; border:0; background:0 '>x</button>
                    <br>
                  <?php  
                  }else{?>
                    <p class='addCred' style='color:#2E86C1; padding:0; margin:0;'>+ Add</p> 
                    <p class='creditlab'style='display:none; padding:0; margin:0;'>credit card number</p>
                    <input class='credit' style='display:none;'>
                    <p class='creditExpiredlab'style='display:none; padding:0; margin:0;'>expired date</p>
                    <input class='creditExpired' type='month' style='display:none;'>
                    <p class='credCVVlab' style='display:none; padding:0; margin:0;'>cvv</p>
                    <input class='credCVV' style='display:none;'>
                    <button class='delCred' style='display:none; font-size:13px; border:0; background:0;'>x</button>
            <?php  
            }}?>
            <br>
            <input class='chgCred' value='submit'  type='button'>
        </div>











           
                
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
          <br><br><br><br><br><br><br><br><br><br><br><br>
          <footer style='height:313px; width:100%; background-color:black; margin-top:600px; padding:0; display: block;'>
            <p style='color:white; font-size: 25px; padding: 35px 0 0 100px;'>MHEEKAOW</p>
            <div class="contact" style="display: block; width:50%; ">
            <img  src='https://www.yanheenursinghome.com/wp-content/themes/yanheenursinghome/images/icon/fa.png' style='height: 35px; padding:5px 0 0 95px;'>
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
        <script src="product.js"></script>
        <script src="editAccount.js"></script>
        
    
    </html>