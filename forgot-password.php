<?php
// Session start
session_start();
// Silence erro reporting
error_reporting(0);
// Import the necessary Scripts
include('includes/dbconnection.php');
include_once('includes/functions.php');
include_once('includes/send.php');
// If reset password clicked
if(isset($_POST['submit'])){
  // Fetch needed data fro the form fields
  $email=$_POST['email'];
  $mobile=$_POST['mobile'];
  // One way hash the password
  $newpassword=md5($_POST['newpassword']);
  $sql ="SELECT Admin_name, Admin_email FROM admin WHERE Admin_email='$email' and Phone_number='$mobile'";
  // Query the database to verify information
  $query= $Conn-> query($sql);
  // Fetch the results as an array
  $results = $query -> fetch_assoc();
  // If data is verified
if($query -> num_rows > 0){
  // Store session information about the fetched row
  $_SESSION['adminmobno']=$_POST['mobile'];
  $_SESSION['adminemail']=$_POST['email'];
  $_SESSION['adminnewpass']=$newpassword;
  $_SESSION['adminname'] = $results['Admin_name'];
  // Redirect to OTP generating and sending Script
  $_SESSION['forgotpassword'] = 1;
  echo "<script type='text/javascript'> document.location ='send.php'; </script>";
}
// If data entered doesn't match a record return an alert and inform them the data is incorrect 
else {
echo "<script>alert('Email id or Mobile no is invalid');</script>"; 
}
}

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    
    <title>Forgot Password | Smart Farming System</title>
   
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- adminpro icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/adminpro-custon-icon.css">
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- form CSS
		============================================ -->
    <link rel="stylesheet" href="css/form.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <script type="text/javascript">
    // new passwords confirmation function
  function valid(){
    if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
    {
      alert("New Password and Confirm Password Field do not match  !!");
      document.chngpwd.confirmpassword.focus();
      return false;
      }
      return true;
  }
</script>
</head>

<body class="materialdesign" style="background-image: url(img/luska-city.jpg); background-repeat-x:no-repeat; background-size: cover; height: 100vh; margin-top:-30px">
    
    <div class="wrapper-pro">

      
            <!-- login Start-->
            <div class="login-form-area mg-t-30 mg-b-40">
                <div class="container-fluid">
                    <div class="row" style="margin-top: 07%;">
                        <div class="col-lg-4"></div>
                        <form class="adminpro-form" method="post" name="chngpwd" onSubmit="return valid();">
                            <div class="col-lg-4">
                                <div class="login-bg"  style="">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="logo">
                                               <h3 style="font-weight: bold;color: #870E0G;font-family:Baloo Tammudu 2">SMART FARMING</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="login-title">
                                                <h1 style="color: red; text-align:center; font-family:cursive">Forgot Password</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="login-input-head">
                                                <p style="font-family:cursive;">Email Address</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="login-input-area">
                                                <input type="email" placeholder="Email Address" required="true" name="email">
                                                <i class="fa fa-envelope login-user" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-lg-4">
                                            <div class="login-input-head">
                                                <p style="font-family:cursive;">Mobile Number</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="login-input-area">
                                                <input type="text" name="mobile" placeholder="Mobile Number" required="true">
                                                <i class="fa fa-mobile login-user" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="login-input-head">
                                                <p style="font-family:cursive;">New Password</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="login-input-area">
                                                <input type="password" name="newpassword" placeholder="New Password" required="true"/>
                                                <i class="fa fa-lock login-user" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="login-input-head">
                                                <p style="font-family:cursive;">Confirm Password</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="login-input-area">
                                                <input class="form-control" type="password" name="confirmpassword" placeholder="Confirm Password" required="true" />
                                                <i class="fa fa-lock login-user" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                  
                                    <div class="row">
                                        <div class="col-lg-12" style="text-align:center">

                                        </div>
                                        <div class="col-lg-12" style="text-align:center">
                                            <div class="login-button-pro">
                                               
                                                <button type="submit" class="login-button login-button-lg" name="submit">Reset</button>

                                            </div>
                                            <p><a href="index.php">Already Have Account ? Sign In</a></p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="col-lg-4"></div>
                    </div>
                </div>
            </div>
            <!-- login End-->
        </div>
    </div>
      <!-- jquery
		============================================ -->
    <script src="js/vendor/jquery-1.11.3.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="js/jquery.meanmenu.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- sticky JS
		============================================ -->
    <script src="js/jquery.sticky.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- form validate JS
		============================================ -->
    <script src="js/jquery.form.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/form-active.js"></script>
    <!-- main JS
		============================================ -->
    <script src="js/main.js"></script>
</body>

</html>