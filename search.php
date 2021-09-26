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


  ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
   
    <title>Search | Smart Farming System</title>
  
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
    <!-- Import Neccessary files -->
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
                                            <li><span class="bread-blod">Search All Records</span>
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
                                        <h1>Search <span class="table-project-n"></span> All Records</h1>
                                        <div class="sparkline13-outline-icon">
                                            <span class="sparkline13-collapse-link"><i class="fa fa-chevron-up"></i></span>
                                            <span><i class="fa fa-wrench"></i></span>
                                            <span class="sparkline13-collapse-close"><i class="fa fa-times"></i></span>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="sparkline13-graph">
                                    <div class="datatable-dashv1-list custom-datatable-overright">
                                        
                                         <form method="post">
                                                     
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-4 mx-auto">
                                                                    <label class="login2 pull-right pull-right-pro">Search by Date</label>
                                                                </div>
                                                                <div class="col-lg-5 mx-auto">
                                                                     <input id="searchdata" type="date" name="searchdata" required="true" class="form-control" placeholder="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                     
                                                     
                                                        <div class="form-group-inner">
                                                            <div class="login-btn-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-6"></div>
                                                                    <div class="col-lg-6">
                                                                        <div class="login-horizental cancel-wp pull-left">
                                                                            
                                                                            <button class="btn btn-primary login-submit-cs" type="submit" name="search" style="background:black">Search</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    
                                          <?php
                                          // If a record is sought
                                              if(isset($_POST['search'])){ 
                                                $sdata=$_POST['searchdata'];
                                            ?>
  <h4 class="align-center" style="margin-bottom: 30px">Result against "<?php echo $sdata;?>" keyword </h4>
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Temperature</th>
                                                    <th >Moisture Content</th>
                                                    <th>pH</th>
                                                    <th>Nitrogen</th>
                                                    <th>Phosphorus</th>
                                                    <th>Potassium</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               
                                             
                                              <?php
                                                $sql="SELECT * from farm_data where Date ='$sdata' ORDER BY ID DESC";
                                                // Query the database
                                                $query = $Conn -> query($sql);
                                                $cnt=1;
                                                if($query->num_rows > 0){
                                                  // Iterate on fetched data collected as an array
                                                  while($row = $query->fetch_assoc())
                                                  {
                                              ?>
                                                <tr>
                                                <!-- Dsiplayy fetched data -->
                                                    <td><?php echo htmlentities($cnt);?></td>
                                                    <td><?php  echo $row['Temperature'];?> &#8451;</td>
                                                   <td><?php   echo $row['Moisture']." %";?></td>
                                                   <td><?php  echo $row['Ph'];?></td>
                                                    <td><?php  echo $row['Nitrogen']." mg/Kg";?></td>
                                                    <td><?php  echo $row['Phosphorus']." mg/Kg";?></td>
                                                    <td><?php  echo $row['Potassium']." mg/Kg";?></td>
                                                    <td><?php  echo $row['Date'];?></td>
                                                    <td><?php  echo $row['Time'];?></td> 
                                                </tr>
                                             
                                            
                                                </tbody>
                                            <?php 
                                            $cnt=$cnt+1;
                                            } } }?>
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
