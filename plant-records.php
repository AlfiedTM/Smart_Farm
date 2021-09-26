<?php
// Session start
session_start();
// Silence erro reporting
error_reporting(0);
// Import the necessary Scripts
include('includes/dbconnection.php');
// include_once('print-report.php');
// Logic for authenticated access
if (strlen($_SESSION['smaid']==0)) {
    // if not authenticated redirec to index page
  header('location:logout.php');
//   Else display this
  } else{
    // If export data requested
    if(isset($_GET['export'])){
      // Set identifier and redirect to pdf creation
        $_SESSION['plantrecord']="print-report";
        echo"<script>document.location = 'print-report.php';</script>";
    }

  ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
   
    <title>Plant Records | Smart Farming System</title>
  
    
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
  
    <div class="wrapper-pro">
    <!-- Import the neccessary scripts needed -->
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
                                            <li><span class="bread-blod">Plant Records</span>
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

            <!-- Static Table Start -->
            <div class="data-table-area mg-b-15">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sparkline13-list shadow-reset">
                                <div class="sparkline13-hd">
                                    <div class="main-sparkline13-hd">
                                    <!-- Display today's date -->
                                        <h1><span class="table-project-n"></span><?php 
                                        echo date('l jS \of F Y');?></h1>
                                        <div class="sparkline13-outline-icon">
                                            <span class="sparkline13-collapse-link"><i class="fa fa-chevron-up"></i></span>
                                            <span><i class="fa fa-wrench"></i></span>
                                            <span class="sparkline13-collapse-close"><i class="fa fa-times"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Data export portion  -->
                                <div class="form-group-inner"  style="margin-top: 8px   ;margin-bottom: 50px" >
                                                            <form class="form"  method="get">
                                                                <div class="col-lg-4">
                                                                    <label class="login2 pull-right pull-right-pro">Export Data</label>
                                                                </div>
                                                                <div class="col-lg-5">
                                                                <select name="mode" class="form-control">
                                                                  <!-- <option  value="">Export Basic</option> -->
                                                                  <option name="pdf" value="pdf">Export as PDF</option>
                                                                  <!-- <option value="excel">Export as Excel</option> -->
                                                                </select>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                
                                                                            <button class="btn btn btn-primary login-submit-cs" type="submit" name="export" style="background:black">Export</button>
                                                                      
                                                                </div>
                                                            </form>
                                </div>

   <h4 class="align-center "></h4>
                                        <table class="table table-bordered table-hover" style="background-color: white; " >
                                       
                                            <thead >
                                                <tr class="text-center">
                                                    <th class="text-center">S.No</th>
                                                    <th class="text-center">Plant Name</th>
                                                    <th class="text-center">Max Temperature</th>
                                                    <th class="text-center">Min Temperature</th>
                                                    <th class="text-center">Max PH</th>
                                                    <th class="text-center">Min PH</th>
                                                    <th class="text-center">Nitrogen</th>
                                                    <th class="text-center">Phosphorus</th>
                                                    <th class="text-center">Potassium</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody id="table2">
                                               
                                             
                                              <?php 
                                               // Query the database and collect all records
                                                $sql="SELECT * from plant_records";
                                                $query = $Conn -> query($sql);
                                                $cnt=1;
                                                if($query->num_rows > 0){
                                                  while($row = $query->fetch_assoc()){
                                              ?>
                                                <tr>
                                                <!-- Display collected data here -->
                                                    <td><?php echo $row['ID']?></td>
                                                    <td><?php  echo $row['Plant_name'];?></td>
                                                    <td><?php  echo $row['Temp_low'];?> &#8451;</td>
                                                    <td><?php  echo $row['Temp_high'];?> &#8451;</td>
                                                    <td><?php  echo $row['Ph_low'];?></td>
                                                    <td><?php  echo $row['Ph_high'];?></td>
                                                    <td><?php  echo $row['Nitrogen']." mg/Kg";?></td>
                                                    <td><?php  echo $row['Phosphorus']." mg/Kg";?></td>
                                                    <td><?php  echo $row['Potassium']." mg/Kg";?></td> 
                                                   
                                                </tr>
                                             
                                            
                                                </tbody>
                                            <?php 
                                            $cnt=$cnt+1;
                                            } }?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Static Table End -->
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
    <!-- peity JS
		============================================ -->
    <script src="js/peity/jquery.peity.min.js"></script>
    <script src="js/peity/peity-active.js"></script>
    <!-- sparkline JS
		============================================ -->
    <script src="js/sparkline/jquery.sparkline.min.js"></script>
    <script src="js/sparkline/sparkline-active.js"></script>
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
