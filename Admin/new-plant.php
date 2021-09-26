<?php
// Session start
session_start();
// Silence erro reporting
error_reporting(0);
// Import the necessary Scripts
include('includes/dbconnection.php');
include_once('includes/functions.php');
// Logic for authenticated access
if (strlen($_SESSION['smaid'] == 0)) {
    // if not authenticated redirec to index page
    header('location:logout.php');
    //   Else display this
} else {
    //   If new plant addition included
    if (isset($_POST['submit'])) {
        //PH Limits
        $ph_Upper = 14;
        $Lower = 0;
        // Fetch data from the form fields
        $ph_H = (float)dataVerification($_POST['Highest_PH']);
        $ph_L = (float)dataVerification($_POST['Lowest_PH']);
        $tmp_L = (float)dataVerification($_POST['Lowest_Temp']);
        $tmp_H = (float)dataVerification($_POST['Highest_Temp']);
        $phosporus = (float)dataVerification($_POST['Phosphorus']);
        $nitrogen = (float)dataVerification($_POST['Nitrogen']);
        $potassium = (float)dataVerification($_POST['Potassium']);
        $name = ucwords(dataVerification($_POST['Plantname']),  " ");
        $upload = 1;


        if(($ph_H > 14 || $ph_L > 14 ) OR ($ph_H < 0|| $ph_L < 0)){
            $phError = "PH must be greater than or eual to 0 and less than or equal to 14";
            $ph_style = "d-block text-danger";
            $ph_css = "border-color: red";
            $upload = 0;
        } 
        if($ph_H < $ph_L){
            $phError = "Highest PH must be greater than or equal to least";
            $ph_style = "d-block text-danger";
            $ph_css = "border-color: red";
            $upload = 0;
        }
        if($tmp_H < $tmp_L){
            $tmpError ="Highest Temperature Value should not be less than the Lower value";
            $tmp_style ="d-block text-danger";
            $upload = 0;
            $tmp_css = "border-color: red";
        }
        if($upload ==1){

        
        $sql = "SELECT ID FROM plant_records WHERE Plant_name = '$name'";
        $query = $Conn->query($sql);
        if($query->num_rows >0){
            echo '<script>alert("Plant record already exists");</script>';
        }else{
            $sql = "SELECT ID FROM plant_records where ID =(SELECT MAX(ID) FROM plant_records)";
        $query = $Conn->query($sql);
        $row = $query->fetch_assoc();
        $ID = 1 + $row['ID'];
        // Insert new plant record onto the database
        $sql = "INSERT INTO plant_records (ID,Plant_name, Ph_high, Ph_low, Temp_high, Temp_low, Nitrogen, Phosphorus, Potassium) VALUES('$ID', '$name', '$ph_H', '$ph_L', '$tmp_H', '$tmp_L', '$nitrogen', '$phosporus', '$potassium')";
        $query = $Conn->query($sql);
        // Alert the user that the operation was a success and redirect them
        echo '<script>alert("Plant successfully registered");</script>';
        echo "<script type='text/javascript'> document.location ='new-plant.php'; </script>";
        unset($temp_css);
        unset($ph_css);
        unset($phError);
        unset($tempError);
        unset($temp_style);
        unset($ph_style);
        }
    }else{

    }
    }



?>
    <!doctype html>
    <html class="no-js" lang="en">

    <head>

        <title>New Plant Form | Smart Farming System</title>

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
            <!-- Import the needed files -->
            <?php include_once('includes/sidebar.php'); ?>
            <?php include_once('includes/header.php'); ?>
            <!-- Breadcome start-->
            <div class="breadcome-area mg-b-30 small" style="<?php echo $erro; ?>">
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

                                                    <form method="post" name="newPlant">
                                                        <div class="form-group-inner mt-3">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">Name</label>
                                                                </div>
                                                                <div class="col-lg-8">

                                                                    <input type="text" placeholder="Name of the plant" class="form-control" name="Plantname" required value="<?php if(isset($name)){
                                                                        echo $name;
                                                                    } ?>"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">PH</label>
                                                                </div>
                                                                <div class="col-lg-4">

                                                                    <input style="<?php if(isset($ph_css)){
                                                                        echo $ph_css;
                                                                    } ?>" type="text"placeholder="Highest PH" class="form-control PH " id="Highest_PH" name="Highest_PH"  pattern="^\d*\.{0,1}\d+$" required  value="<?php if(isset($ph_H)){
                                                                        echo $ph_H;
                                                                    } ?>"/>
                                                                </div>
                                                                <div class="col-lg-4">

                                                                    <input style="<?php if(isset($ph_css)){
                                                                        echo $ph_css;
                                                                    } ?>" type="text"placeholder="Lowest PH" class="form-control PH" id="Lowest_PH" name="Lowest_PH" pattern="^\d*\.{0,1}\d+$"  required value="<?php if(isset($ph_L)){
                                                                        echo $ph_L;
                                                                    } ?>"/>
                                                                </div>
                                                                <small id="phError" class="col-lg-12 text-center text-danger"><?php if(isset($phError)){
                                                                        echo $phError;
                                                                    } ?></small>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">Temperature</label>
                                                                </div>
                                                                <div class="col-lg-4">

                                                                    <input style="<?php if(isset($tmp_css)){
                                                                        echo $tmp_css;
                                                                    } ?>" type="text" placeholder="Highest Temperature in degrees Celsius" pattern="^\d*\.{0,1}\d+$" class="form-control temp" name="Highest_Temp"  required  value="<?php if(isset($tmp_H)){
                                                                        echo $tmp_H;
                                                                    } ?>"/>
                                                                </div>
                                                                <div class="col-lg-4">

                                                                    <input style="<?php if(isset($tmp_css)){
                                                                        echo $tmp_css;
                                                                    } ?>" type="text" placeholder="Lowest Temperature in degrees Celsius" class="form-control temp" pattern="^\d*\.{0,1}\d+$" name="Lowest_Temp"  required  value="<?php if(isset($tmp_L)){
                                                                        echo $tmp_L;
                                                                    } ?>"/>
                                                                </div>
                                                                <small id="tempError" class="col-lg-12 text-center text-danger"><?php if(isset($tmpError)){
                                                                        echo $tmpError;
                                                                    } ?></small>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">Nitrogen</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <input type="text" placeholder="Nitrogen amount in grams" class="form-control" pattern="^\d*\.{0,1}\d+$" name="Nitrogen" required="true" value="<?php if(isset($nitrogen)){
                                                                        echo $nitrogen;
                                                                    } ?>" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">Phosphorus</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <input type="text" placeholder="Phosphorus amount in grams" class="form-control" pattern="^\d*\.{0,1}\d+$" name="Phosphorus" required="true" value="<?php if(isset($phosporus)){
                                                                        echo $phosporus;
                                                                    } ?>" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">Potassium</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <input type="text" placeholder="Potassium amount in grams" class="form-control" name="Potassium"  required="true"value="<?php if(isset($potassium)){
                                                                        echo $potassium;
                                                                    } ?>"/>
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