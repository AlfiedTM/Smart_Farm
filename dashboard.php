<!-- Smart Farming  Dashboard-->
<?php
// Session Start
session_start();
// Silecnce error reporting
error_reporting(0);
// Import database connection file
include('includes/dbconnection.php');
// Logic for logged on admin access
if (strlen($_SESSION['smaid']==0)) {
    // If not Logged on redirect them to index page
    header('location:logout.php');
    // Else display this
  } else{
  ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
  
    <title>Dashboard | Smart Farming System</title>
    
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
    <!-- jvectormap CSS
		============================================ -->
    <link rel="stylesheet" href="css/jvectormap/jquery-jvectormap-2.0.3.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/data-table/bootstrap-table.css">
    <link rel="stylesheet" href="css/data-table/bootstrap-editable.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- charts CSS
		============================================ -->
    <link rel="stylesheet" href="css/c3.min.css">
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
    
    <!-- Header top area start-->
    <div class="wrapper-pro">
      <?php include_once('includes/sidebar.php');?>
        <!-- Header top area start-->
       <?php include_once('includes/header.php');?>
            <!-- Header top area end-->
            <!-- Breadcome start-->
            <div class="breadcome-area mg-b-30 small-dn">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcome-list map-mg-t-40-gl shadow-reset">
                                <div class="row">
                                   
                                    <div class="col-lg-12">
                                        <ul class="breadcome-menu">
                                            <li><a href="dashboard.php">Home</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">Dashboard</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Breadcome End-->
      
            <!-- Breadcome End-->
            <!-- income order visit user Start -->
            <div class="income-order-visit-user-area">
                <div class="container-fluid" style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">
                    <div class="row">
                        <div class="col-lg-4">
                             <?php 
                                //  Query the database and collect the recent row
                                $sql ="SELECT * from farm_data where ID=(SELECT MAX(ID) from farm_data)";
                                $query = $Conn -> query($sql);
                                //  Collect its data as an array 
                                $row=$query->fetch_assoc();
                                $totalnewapp=$query->num_rows;
                             ?>
                              <div class="income-dashone-total orders-monthly shadow-reset nt-mg-b-30" style="background:#05866C">
                                 
                                 <div class="income-title">
 
                                     <div class="main-income-head">
                                         <h2>Temperature</h2>
                                        
                                     </div>
                                 </div>
                                 <div class="income-dashone-pro">
                                     <div class="income-rate-total">
                                         <div class="price-adminpro-rate">
                                             <h3><span class="counter"><?php echo $row['Temperature'];?></span> &#8451;</h3>
                                         </div>
                                        
                                     </div>
                                     <div class="income-range order-cl">
                                         <a class="block text-center" href="temperature-view-data.php"><strong style="color:white">View Detail</strong></a>
                                     </div>
                                     <div class="clear"></div>
                                 </div>
                             </div>
                          
                        </div>
                        <!-- Display the current Temprature readings here -->
                        <div class="col-lg-4">
                            <div class="income-dashone-total orders-monthly shadow-reset nt-mg-b-30" style="background:#05866C">
                                 
                                 <div class="income-title">
 
                                     <div class="main-income-head">
                                         <h2 >Moisture Content</h2>
                                        
                                     </div>
                                 </div>
                                 <div class="income-dashone-pro">
                                     <div class="income-rate-total">
                                         <div class="price-adminpro-rate">
                                             <h3><span class="counter"><?php echo $row['Moisture'];?></span> %</h3>
                                         </div>
                                        
                                     </div>
                                     <div class="income-range order-cl">
                                         <a class="block text-center" href="moisture-view-detail.php"><strong style="color:white">View Detail</strong></a>
                                     </div>
                                     <div class="clear"></div>
                                 </div>
                             </div>
                        </div>
                       
                        <!-- Disply the current Moisture readings here -->
                        <div class="col-lg-4">
                            <div class="income-dashone-total income-monthly shadow-reset nt-mg-b-30" style="background:#05866C">
                               <!-- Display the current readings for PH here -->
                                <div class="income-title">
                                    <div class="main-income-head">
                                        <h2>PH</h2>
                                        <div class="main-income-phara">
                                            <!-- <p style="background: yellow; color: black">New Application</p> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="income-dashone-pro">
                                    <div class="income-rate-total">
                                        <div class="price-adminpro-rate">
                                            <h3><span class="counter"><?php echo $row['Ph'];?></span> </h3>
                                        </div>
                                        
                                    </div>
                                    <div class="income-range">
                                       
                                        <a class="block text-center" href="ph-view-data.php"><strong style="color:white">View Detail</strong></a>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Display the current Nitrogen contents here -->
                        <div class="col-lg-4">
                            <div class="income-dashone-total orders-monthly shadow-reset nt-mg-b-30" style="background:#05866C">
                                 
                                <div class="income-title">

                                    <div class="main-income-head">
                                        <h2>Nitrogen</h2>
                                       
                                    </div>
                                </div>
                                <div class="income-dashone-pro">
                                    <div class="income-rate-total">
                                        <div class="price-adminpro-rate">
                                            <h3><span class="counter"><?php echo $row['Nitrogen'];?></span> mg/Kg</h3>
                                        </div>
                                       
                                    </div>
                                    <div class="income-range order-cl">
                                        <a class="block text-center" href="nitrogen-view-data.php"><strong style="color:white">View Detail</strong></a>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Display the current Phosphorus readings here-->
                        <div class="col-lg-4" >
                            <div class="income-dashone-total orders-monthly shadow-reset nt-mg-b-30" style="background:#05866C">
                                 
                                <div class="income-title">

                                    <div class="main-income-head">
                                        <h2>Phosphorus</h2>
                                       
                                    </div>
                                </div>
                                <div class="income-dashone-pro">
                                    <div class="income-rate-total">
                                        <div class="price-adminpro-rate">
                                            <h3><span class="counter"><?php echo $row['Phosphorus'];?></span> mg/Kg</h3>
                                        </div>
                                       
                                    </div>
                                    <div class="income-range order-cl">
                                        <a class="block text-center" href="phosphorus-view-data.php"><strong style="color:white">View Detail</strong></a>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Display the current potassum readings here  -->
                        <div class="col-lg-4">
                         
                            <div class="income-dashone-total visitor-monthly shadow-reset nt-mg-b-30" style="background:#05866C">
                                
                                <div class="income-title">
                                    <div class="main-income-head">
                                        <h2>Potassium</h2>
                                       
                                    </div>
                                </div>
                                <div class="income-dashone-pro">
                                    <div class="income-rate-total">
                                        <div class="price-adminpro-rate">
                                            <h3><span class="counter"><?php echo $row['Potassium'];?></span> mg/Kg</h3>
                                        </div>
                                    </div>
                                    <div class="income-range visitor-cl">
                                        <a class="block text-center" href="potassium-view-detail.php"><strong style="color:white">View Detail</strong></a>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
  
        
        
         
        </div>
    </div>
      <!-- Footer End-->
   
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
    <!-- scrollUp JS
		============================================ -->
    <script src="js/wow/wow.min.js"></script>
    <!-- counterup JS
		============================================ -->
    <script src="js/counterup/jquery.counterup.min.js"></script>
    <script src="js/counterup/waypoints.min.js"></script>
    <script src="js/counterup/counterup-active.js"></script>
    <!-- jvectormap JS
		============================================ -->
    <script src="js/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="js/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="js/jvectormap/jvectormap-active.js"></script>
    <!-- peity JS
		============================================ -->
    <script src="js/peity/jquery.peity.min.js"></script>
    <script src="js/peity/peity-active.js"></script>
    <!-- sparkline JS
		============================================ -->
    <script src="js/sparkline/jquery.sparkline.min.js"></script>
    <script src="js/sparkline/sparkline-active.js"></script>
    <!-- flot JS
		============================================ -->
    <script src="js/flot/Chart.min.js"></script>
    <script src="js/flot/dashtwo-flot-active.js"></script>
    <!-- data table JS
		============================================ -->
    <script src="js/data-table/bootstrap-table.js"></script>
    <script src="js/data-table/tableExport.js"></script>
    <script src="js/data-table/data-table-active.js"></script>
    <script src="js/data-table/bootstrap-table-editable.js"></script>
    <script src="js/data-table/bootstrap-editable.js"></script>
    <script src="js/data-table/bootstrap-table-resizable.js"></script>
    <script src="js/data-table/colResizable-1.5.source.js"></script>
    <script src="js/data-table/bootstrap-table-export.js"></script>
    <!-- main JS
		============================================ -->
    <script src="js/main.js"></script>
</body>

</html><?php }  ?>