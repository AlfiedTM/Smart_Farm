<!-- One Time Password Confirmation (OTP)-->
<?php
// Session start
session_start();
// Silence error reporting
error_reporting(0);
// Import database connection and functions scripts
include('includes/dbconnection.php');
include('includes/functions.php');
// If user confirms OTP
if(isset($_POST['confirmOTP'])) {
  // Verify if the entered OTP matches that sent to the user
  if($_POST['OTP']==$_SESSION['OTP']){
    if((strtotime(date("Y-m-d H:i:s"))- strtotime($_SESSION['OTPTime']))/60 > 30){
      echo "<script>alert('OTP has expired please request for a new OTP');</script>";
      unset($_SESSION['OTPTime']);
      unset($_POST['OTP']);
    }else{
    // If it does the change the password by updating the database
    $sql="update admin set Password='".$_SESSION['adminnewpass']."' where Admin_email='".$_SESSION['adminemail']."' and Phone_number='".$_SESSION['adminmobno']."'";
    $result= $Conn->query($sql);
    echo "<script>alert('Your Password succesfully changed ".$_SESSION['OTPTime']."');</script>";
    echo "<script type='text/javascript'> document.location ='index.php'; </script>";
    // Upon verification unset the OTP
    unset($_SESSION['OTP']);
        // If the OTP entered isn't correct alert the admin that the OTP does not match
    }
    }
    elseif($_SESSION['newaccountotp']==$_POST['OTP']){
       if((strtotime(date("Y-m-d H:i:s")) - strtotime( $_SESSION['OTPTime']))/60 > 30){
         echo "<script>alert('OTP has expired please request for a new OTP');</script>";
         unset($_SESSION['OTPTime']);
         unset($_POST['OTP']);
       }else{
       $sql = "SELECT ID FROM admin where ID =(SELECT MAX(ID) FROM admin)";
       $query = $Conn->query($sql);
       $row = $query->fetch_assoc();
       $ID = 1 + $row['ID'];
       $fname = $_SESSION['newadminname'];
       $email = $_SESSION['newadminemail'];
       $mobno = $_SESSION['newadminmobno'];
       $username = $_SESSION['newadminusername'];
       $password =  $_SESSION['newadminpassword'];
       $authorizer=$_SESSION['adminauthorizer'];
       $date = date("Y-m-d H:m:i");
       $sql="INSERT INTO admin (ID, Admin_name, Admin_username, Admin_email, Phone_number, Password, Registration_date) VALUES('$ID','$fname','$username','$email', '$mobno','$password','$date')";
       $query = $Conn->query($sql);
       echo "<script>alert('Account succesfully created');</script>";
       unset($_SESSION['newadminname']);
       unset($_SESSION['newadminemail']);
       unset($_SESSION['newadminmobno']);
       unset($_SESSION['newadminusername']);
       unset($_SESSION['newadminpassword']);
       unset($_SESSION['adminauthorizer']);
       unset($_SESSION['newaccountotp']);
       echo "<script type='text/javascript'> document.location ='register.php'; </script>";
       }
    }else{
      echo "<script>alert('Invalid One Time Password');</script>";
    }
}

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    
    <title>OTP Confirmation | Smart Farming System</title>
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
<!-- Background image and styles for the page -->
<body  class="materialdesign" style="background-image: url(img/Bervin-.jpg); background-repeat-x:no-repeat; background-size: cover; height: 100vh; margin-top:-30px">
    
    <div class="wrapper-pro">
            <!-- login Start-->
            <div class="login-form-area mg-t-30 mg-b-40" >
                <div class="container-fluid">
                    <div class="row" style="margin-top: 07%;">
                        <!-- <div class="col-lg-4"></div> -->
                        <!-- Form for OTP Confirmation -->
                        <form style="margin-left:38%" class="adminpro-form"  method="post" name="login">
                            <div class="col-lg-6">
                                <div class="login-bg" style=" margin-top: 25%">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="logo">
                                                <h3 style="font-weight: bold;color: #870E0G; font-family:Baloo Tammudu 2;">PASSWORD RECOVERY</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="text-align:center">
                                        <div class="col-lg-12">
                                            <div class="login-input-head">
                                                <p style="font-family:cursive;">One Time Password</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                         </div>
                                    <div class="row" style="text-align:center">
                                        <div class="col-lg-8 mx-auto">
                                            <div class="login-input-area text-center">
                                                <input type="text" class="text-center" placeholder="Enter OTP" required="true" name="OTP" value="" >
                                            </div>
                                        </div>
                                        
                                           
                                        </div>
                                    </div>
                                    <div class="row" >
                                        <div class="col-lg-12" style="text-align:center">

                                        </div>
                                        <div class="col-lg-12" style="text-align:center">
                                            <div class="login-button-pro">
                                               
                                                <button type="submit" name="confirmOTP" class="login-button login-button-lg" name="login">Confirm OTP</button>

                                            </div>
                                        
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
</body>

</html>