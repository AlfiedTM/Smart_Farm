<?php
// Session start
session_start();
// Silence erro reporting
error_reporting(0);
// Import the necessary Scripts
include('includes/dbconnection.php');
include_once('includes/functions.php');

// If Login requested
if(isset($_POST['login'])){
  // Collect the neccessary data needed
  $username=dataVerification($_POST['username']);
  $password=md5(dataVerification($_POST['password']));
  $sql ="SELECT Admin_email, ID FROM manager WHERE Admin_Username='$username' and Password='$password'";
  // Query database
  $query=$Conn->query($sql);
  // If such a record is available
  if($query->num_rows > 0){
    // Fecthed data be made as an associated array
    $result = $query->fetch_assoc();
    $_SESSION['smaid']=$result['ID'];
    $_SESSION['Admin_email'] = $result['Admin_email'];
    // If User clicked remember me create a cookie
    if(!empty($_POST["remember"])) {
      //COOKIES for username
      setcookie ("user_login",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
      //COOKIES for password
      setcookie ("userpassword",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
    } else {
      if(isset($_COOKIE["user_login"])) {
        setcookie ("user_login","");
        if(isset($_COOKIE["userpassword"])) {
          setcookie ("userpassword","");
        }
      }
}
  // Store admin session login info 
  $_SESSION['login']=$_POST['username'];
  // Redirect to the dashboard
  echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
  // Else inform the user that the data entered is incorrect
} else{
echo "<script>alert('Invalid Details');</script>";
}
}

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    
    <title>Login | Smart Farming System</title>
   
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
</head>

<body  class="materialdesign" style="background-image: url(img/Bervin-.jpg); background-repeat-x:no-repeat; background-size: cover; height: 100vh; margin-top:-30px">
    <div class="wrapper-pro">
            <!-- login Start-->
            <div class="login-form-area mg-t-30 mg-b-40" >
                <div class="container-fluid">
                    <div class="row" style="margin-top: 10%;  margin-left: 10%;">
                        <div class="col-lg-4"></div>
                        <form class="adminpro-form" method="post" name="login">
                            <div class="col-lg-4">
                                <div class="login-bg">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="logo">
                                                <h3 style="font-weight: bold;font-family:Baloo Tammudu 2;">SMART FARMING SYSTEM</h3x>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="text-align:center">
                                        <div class="col-lg-12">
                                            <div class="login-input-head d-none">
                                                <p style="font-family:cursive; color:whte"></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                         </div>
                                        <div class="col-lg-8">
                                            <div class="login-input-area">
                                                <input type="text" placeholder="User Name" required="true" name="username" value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>" >
                                                <i class="fa fa-user login-user" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="text-align:center">
                                        <div class="col-lg-12">
                                            <div class="login-input-head">
                                                <p style="font-family:cursive; color:white; display:non"></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="login-input-area">
                                                <input type="password" placeholder="Password" name="password" required="true" value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>">
                                                <i class="fa fa-lock login-user"></i>
                                            </div>
                                            <div class="row" style="text-align:center">
                                                <div class="col-lg-12">
                                                    <div class="forgot-password">
                                                        <a href="forgot-password.php" style="text-align:center">Forgot password?</a>

                                                    </div>
                                                </div>
                                            </div>
                                             <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="login-keep-me">
                                                        <label class="checkbox ">
                                                            <input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?>><i ></i><span style="color: black">Keep me logged in</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" >
                                        <div class="col-lg-12" style="text-align:center">
                                        <div class="login-keep-me">
                                                        <label class="checkbox ">
                                                            <a href="register.php" style="color: #03a9f4; ">Don't have an account? Register</a>
                                                        </label>
                                                    </div>
                                        </div>
                                        <div class="col-lg-12" style="text-align:center">
                                            <div class="login-button-pro">
                                               
                                                <button type="submit" class="login-button" name="login"> <i class="fa fa-sign-in" aria-hidden="true"></i> Log in</button>

                                            </div>
                                           <!-- <p><a href="../index.html">Home</a></p> -->
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