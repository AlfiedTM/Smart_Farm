<?php
// Session start
session_start();
// Silence erro reporting
error_reporting(0);
// Import the necessary Scripts
include('includes/dbconnection.php');
// Logic for authenticated access
if (strlen($_SESSION['smaid']==0)) {
    // if not authenticated redirec to index page
  header('location:logout.php');
//   Else display this
  } else{
    // If profile change requested
    if(isset($_POST['submit'])){
      // Collect neccessary data
      $adminid=$_SESSION['smaid'];
      $Aname=$_POST['adminname'];
      $mobno=$_POST['mobilenumber'];
      $email=$_POST['email'];
      $sql="update admin set Admin_name='$Aname',Phone_number='$mobno' where ID='$adminid'";
      // Query the database 
      $query = $Conn->query($sql);
      // Upon success inform the user
      echo '<script>alert("Profile has been updated")</script>';
      echo "<script>window.location.href ='profile.php'</script>";
  }
  ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
   
    <title>Profile | Smart Farming System</title>
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
</head>

<body class="materialdesign">
  
    <div class="wrapper-pro">
    <!-- Import the sidebar and header -->
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
                                            <li><span class="bread-blod">Profile</span>
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
                                        <h1>Profile</h1>
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
                                                       <?php
                                                      // Collect authenticated admin's data
                                                        $sql="SELECT * from  admin where ID = '$aid'";
                                                      // Query the database
                                                       $query = $Conn ->query($sql);
                                                       $cnt=1;
                                                      
                                                       if($query->num_rows > 0){
                                                         //  Collect admin data as an array 
                                                         $row=$query->fetch_assoc();
?>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">Admin Name</label>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                <!-- Display admin name -->
                                                                     <input type="text" class="form-control" name="adminname" value="<?php  echo $row['Admin_name'];?>" required='true'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">User Name</label>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                <!-- Display admin user name -->
                                                                     <input type="text" class="form-control" name="username" value="<?php  echo $row['Admin_username'];?>" readonly="true">
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">Email</label>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                <!-- Display admin email -->
                                                                     <input type="email" class="form-control" name="email" value="<?php  echo $row['Admin_email'];?>" required='true' readonly="true">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">Mobile Number</label>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                <!-- Display admin hphone number -->
                                                                    <input type="text" class="form-control" name="mobilenumber" value="<?php  echo $row['Phone_number'];?>" required='true' maxlength='10'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">Admin Registration Date</label>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                <!-- Display admin registration date -->
                                                                   <input type="text" class="form-control" id="email2" name="" value="<?php  echo $row['Registration_date'];?>" readonly="true">
                                                                </div>
                                                            </div>
                                                        </div>
                                                     
                                               
                                                    <?php $cnt=$cnt+1;} ?>
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