<!-- Plant record editing -->
<?php
// Session start
session_start();
// Silence error reporting
error_reporting(0);
// Import the neccessary scripts
include('includes/dbconnection.php');
include('includes/functions.php');
// Logic for access Verification
if (strlen($_SESSION['smaid']==0)) {
    // if not authenticated redirect them to index page
  header('location:logout.php');
  } else{
  
                  if(isset($_POST['submit'])){
                    //   PH limits 
                      $ph_Upper = 14;
                      $Lower = 0;
                    //   Collect data from the form
                      $ph_H =(float)dataVerification($_POST['Highest_PH']);
                      $ph_L =(float)dataVerification($_POST['Lowest_PH']);
                      $tmp_H =(float)dataVerification($_POST['Lowest_Temp']);
                      $tmp_L =(float)dataVerification($_POST['Highest_Temp']);
                      $phosphorus =(float)dataVerification($_POST['Phosphorus']);
                      $nitrogen =(float)dataVerification($_POST['Nitrogen']);
                      $potassium =(float)dataVerification($_POST['Potassium']);
                      $name =ucwords(dataVerification($_POST['Plantname']),  " ");
                      $id = $_SESSION['edtplantid'];

                    //   Update the database records
                    $sql = "UPDATE plant_records SET Plant_name ='$name', Ph_high='$ph_H', Ph_low='$ph_L', Temp_high='$tmp_H', Temp_low='$tmp_L', Nitrogen='$nitrogen', Phosphorus='$phosphorus', Potassium='$potassium' where ID='$id'";
                    if($Conn->query($sql)){
                        echo'<script>alert("Edited successfully");</script>';
                        echo"<script type='text/javascript'> document.location ='edit-plant-record.php'; </script>";
                        }       
                }
  ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
   
    <title>Edit Plant Record | Smart Farming System</title>
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
    <!-- Import the sidebar and header-->
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
                                            <li><span class="bread-blod">Plant Registration Form</span>
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
                                        <h1>New Plant Application Form</h1>
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
                                                        // Fetch the row to be edited
                                                        $id = $_SESSION['editplant'];
                                                        $sql="SELECT * from plant_records where ID ='$id'" ;
                                                        // Querry the database
                                                        $query = $Conn->query($sql);
                                                        // Fetch data as an associated array
                                                        $row = $query->fetch_assoc();
                                                        $_SESSION['edtplantid']=$row['ID'];
                                                    ?>
                                                        <div class="form-group-inner mt-3">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">Name</label>
                                                                </div>
                                                                <div class="col-lg-8">

                                                                    <input type="text" name="Plantname"  class="form-control"  value="<?php echo $row['Plant_name'];?>" required/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">PH</label>
                                                                </div>
                                                                <div class="col-lg-4">

                                                                    <input type="text" class="form-control" name="Highest_PH" value="<?php echo $row['Ph_high'];?>" pattern="^\d*\.{0,1}\d+$" placeholder="Highest PH"  required/>
                                                                </div>
                                                                <div class="col-lg-4">

                                                                    <input type="text" class="form-control" name="Lowest_PH" pattern="^\d*\.{0,1}\d+$" value="<?php echo $row['Ph_low'];?>" placeholder="Lowest PH"  required/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">Temperature</label>
                                                                </div>
                                                                <div class="col-lg-4">

                                                                    <input type="text" pattern="^\d*\.{0,1}\d+$" class="form-control" name="Highest_Temp" placeholder="Highest Temperature"  value="<?php echo $row['Temp_high'];?>" required/>
                                                                </div>
                                                                <div class="col-lg-4">

                                                                    <input type="text"  class="form-control" pattern="^\d*\.{0,1}\d+$" name="Lowest_Temp" placeholder="Lowest Temperature"  value="<?php echo $row['Temp_low'];?>" required/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">Nitrogen</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <input type="text" class="form-control" pattern="^\d*\.{0,1}\d+$" name="Nitrogen" value="<?php echo $row['Nitrogen'];?>" required="true" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">Phosphorus</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <input type="text" name="Phosphorus" class="form-control" pattern="^\d*\.{0,1}\d+$" value="<?php echo $row['Phosphorus'];?>" required="true" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">Potassium</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <input type="text" class="form-control" name="Potassium" value="<?php echo $row['Potassium'];?>" required="true" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                                                 
                                                        <div class="form-group-inner">
                                                            <div class="login-btn-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-3"></div>
                                                                    <div class="col-lg-9">
                                                                        <div class="login-horizental cancel-wp pull-left">
                                                                            <button class="btn btn-sm btn-primary login-submit-cs" type="submit" name="submit" style="background:black">Register Plant</button>
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