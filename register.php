<?php
// Session start
session_start();
// Silence erro reporting
error_reporting(0);
// Import the necessary Scripts
include('includes/dbconnection.php');
include_once('includes/functions.php');
// Logic for authenticated access
if (strlen($_SESSION['smaid']==0)) {
    // if not authenticated redirec to index page
  header('location:logout.php');
//   Else display this
  } else{

if(isset($_POST['submit']))
  {
    $fname=dataVerification($_POST['fullname']);
    $email=dataVerification($_POST['email']);
    $authorizer=dataVerification($_POST['authorizedby']);
    $mobno=dataVerification($_POST['mobno']);
    $username=dataVerification($_POST['username']);
    $password=md5(dataVerification($_POST['password']));
    $ret="SELECT Admin_email FROM admin WHERE Admin_email='$email'";
    $query=$Conn->query($ret);
 
    $results = $query -> fetch_assoc();
if($query -> num_rows == 0)
{
    $_SESSION['newadminname'] = $fname;
    $_SESSION['newadminemail'] =  $email;
    $_SESSION['newadminmobno'] = $mobno;
    $_SESSION['newadminusername'] = $username;
    $_SESSION['newadminpassword'] = $password;
    $_SESSION['adminauthorizer'] = $authorizer;

echo "<script type='text/javascript'> document.location ='send.php'; </script>";
}
else
{

echo "<script>alert('This email already exist. Please try again');</script>";
}
}


?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    
    <title>Admin Account Creation Form | Smart Farming System</title>
   
		
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
    <!-- style CSS
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
    // Function for new password verification
    function checkpass(){
      if(document.register.password.value!=document.register.Confirmpassword.value)
      {
        alert('New Password and Confirm Password field does not match');
        document.register.Confirmpassword.focus();
        return false;
        }
        return true;
    }   

</script>
</head>


<body class="materialdesign" >
  
    <div class="wrapper-pro">
           <!-- Import the needed files -->
   <?php include_once('includes/sidebar.php');?>
        <?php include_once('includes/header.php');?>
         <!-- Breadcome start-->
         <div class="breadcome-area mg-b-30 small" style="<?php echo $erro;?>">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcome-list shadow-reset">
                                <div class="row">
                                   
                                    <div class="col-lg-12">
                                        <ul class="breadcome-menu">
                                            <li><a href="dashboard.php">Home</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">Admin Account Creation Form</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Register Start-->
            <div class="basic-form-area mg-b-15">
                <div class="container-fluid">
                   
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sparkline12-list shadow-reset mg-t-30">
                                <div class="sparkline12-hd">
                                    <div class="main-sparkline12-hd">
                                        <h1>New Admin Account Creation Form</h1>
                                        <div class="sparkline12-outline-icon">
                                            <span class="sparkline12-collapse-link"><i class="fa fa-chevron-up"></i></span>
                                            <span><i class="fa fa-wrench"></i></span>
                                            <span class="sparkline12-collapse-close"><i class="fa fa-times"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="sparkline12-graph">
                                    <div class="basic-login-form-ad">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="all-form-element-inner">
                                                    
                                                    <form method="post">
                                                        <div class="form-group-inner mt-3">
                                                        <div class="row">
                                        <div class="col-lg-4" style="text-align:center">
                                            <div class="login-input-head">
                                                <p >Full Name</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="login-input-area">
                                                <input type="text" name="fullname" required="true" placeholder="Enter account holder's full name" />
                                                <i class="fa fa-user login-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-lg-4" style="text-align:center">
                                            <div class="login-input-head">
                                                <p >Username</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="login-input-area">
                                                <input type="text" name="username" required="true" placeholder="Enter account holder's username" />
                                                <i class="fa fa-user login-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4" style="text-align:center">
                                            <div class="login-input-head">
                                                <p >Mobille Number</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="login-input-area">
                                                <input type="text" name="mobno" maxlength="13" placeholder="Enter account holder's phone number" pattern="^\+?[\d\s]{3,}$" required="true" />
                                                <i class="fa fa-mobile login-user" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-lg-4" style="text-align:center">
                                            <div class="login-input-head">
                                                <p >Email</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="login-input-area">
                                                <input type="text" name="email" placeholder="Enter account holder's email" />
                                                <i class="fa fa-envelope login-user" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4" style="text-align:center">
                                            <div class="login-input-head">
                                                <p >Authorized By</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="login-input-area">
                                                <input type="text" name="authorizedby" value="<?php echo $_SESSION['Admin_email'];?>" placeholder="Authorized by email" readonly/>
                                                <i class="fa fa-envelope login-user"  aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4" style="text-align:center">
                                            <div class="login-input-head">
                                                <p >Password</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="login-input-area">
                                                <input type="password" name="password" value="@Smart1Farming" required="true" placeholder="Enter password" />
                                                <i class="fa fa-lock login-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4" style="text-align:center">
                                            <div class="login-input-head">
                                                <p >Confirm Password</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="login-input-area">
                                                <input type="password" name="Confirmpassword" value="@Smart1Farming" required="true" placeholder="Confirm password" />
                                                <i class="fa fa-lock login-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                      
                                   
                                    </div>
                                                                                 
                                                        <div class="form-group-inner">
                                                            <div class="login-btn-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-4"></div>
                                                                    <div class="col-lg-8">
                                                                        <div class="login-horizental cancel-wp pull-left">
                                                                            <button class="btn btn-sm btn-primary login-submit-cs" type="submit" name="submit" style="background:black">Create Account</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Register End-->
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
<?php }?>