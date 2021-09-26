<!-- Password changing for an authenticated user -->
<?php
// Session start 
session_start();
// Silence error reporting
error_reporting(0);
// Importing daabase connection script
include('includes/dbconnection.php');
// Logic for verifing if logged on
if (strlen($_SESSION['smaid']==0)) {
  // If not redirect them to index page
  header('location:logout.php');

  } else{
    // If password change is set
    if(isset($_POST['submit'])){
      // Assign admin to local variable
      $adminid=$_SESSION['smaid'];
      // Collect the neccessary data from the form fields
      $cpassword=md5($_POST['currentpassword']);
      $newpassword=md5($_POST['newpassword']);
      // Querry the database
      $sql ="SELECT ID FROM manager WHERE ID='$adminid' and Password='$cpassword'";
      $query= $Conn-> query($sql);
      // If a row or more are affected 
      if($query -> num_rows > 0){
        // Then Update the database content
        $con="UPDATE manager SET Password='$newpassword' where ID='$adminid'";
        $chngpwd1 = $Conn->query($con);
        // Alert the admin that password change was successful and redirect them to the same page
        echo '<script>alert("Your password successully changed")</script>';
        echo "<script>window.location.href ='change-password.php'</script>";
        // Else Reject saying the password entered is incorrect and redirect them to the same page
} else {
  echo '<script>alert("Your current password is wrong")</script>';  
  echo "<script>window.location.href ='change-password.php'</script>";
}
} 
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
   
    <title>Change Password | Smart Farming System</title>
   
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
    <!-- modals CSS
		============================================ -->
    <link rel="stylesheet" href="css/modals.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- forms CSS
		============================================ -->
    <link rel="stylesheet" href="css/form/all-type-forms.css">
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
      if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
      {
        alert('New Password and Confirm Password field does not match');
        document.changepassword.confirmpassword.focus();
        return false;
        }
        return true;
    }   

</script>
</head>

<body class="materialdesign">
  
    <div class="wrapper-pro">
    <!-- Import the sidebar and header  -->
   <?php include_once('includes/sidebar.php');?>
        <?php include_once('includes/header.php');?>
            <!-- Breadcome start-->
            <div class="breadcome-area mg-b-30 small-dn">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcome-list shadow-reset">
                                <div class="row">
                                   
                                    <div class="col-lg-12">
                                        <ul class="breadcome-menu">
                                            <li><a href="dashboard.php">Home</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">Change Password</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
            <!-- Basic Form Start -->
            <div class="basic-form-area mg-b-15">
                <div class="container-fluid">
                   
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sparkline12-list shadow-reset mg-t-30">
                                <div class="sparkline12-hd">
                                    <div class="main-sparkline12-hd">
                                        <h1>Change Password</h1>
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
                                                    <!-- Form for password changing -->
                                                    <form method="post" onsubmit="return checkpass();" name="changepassword" method="post">
                                                      
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">Current Password:</label>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                     <input type="password" class="form-control" name="currentpassword" id="currentpassword"required='true'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">New Password:</label>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                     <input type="password" class="form-control" name="newpassword"  class="form-control" required="true">
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">Confirm Password:</label>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <input type="password" class="form-control"  name="confirmpassword" id="confirmpassword"  required='true'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                 
                                                 
                                                        <div class="form-group-inner">
                                                            <div class="login-btn-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-3"></div>
                                                                    <div class="col-lg-9">
                                                                        <div class="login-horizental cancel-wp pull-left">
                                                                            
                                                                            <button class="btn btn-sm btn-primary login-submit-cs" type="submit" name="submit" style="background:black">Save Change</button>
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
            <!-- Basic Form End-->

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
    <!-- counterup JS
		============================================ -->
    <script src="js/counterup/jquery.counterup.min.js"></script>
    <script src="js/counterup/waypoints.min.js"></script>
    <!-- modal JS
		============================================ -->
    <script src="js/modal-active.js"></script>
    <!-- icheck JS
		============================================ -->
    <script src="js/icheck/icheck.min.js"></script>
    <script src="js/icheck/icheck-active.js"></script>
    <!-- main JS
		============================================ -->
    <script src="js/main.js"></script>
</body>

</html><?php }  ?>