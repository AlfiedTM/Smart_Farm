<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['smaid'] == 0)) {
  header('location:logout.php');
} else {

?>

  <!doctype html>
  <html class="no-js" lang="en">

  <head>

    <title>Delete Account | Smart Farming System</title>

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
    <script src="js/vendor/jquery-1.11.3.min.js"></script>
  </head>

  <body class="materialdesign">

    <div class="wrapper-pro">
      <?php include_once('includes/sidebar.php'); ?>
      <?php include_once('includes/header.php'); ?>

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
                      <li><span class="bread-blod">Delete Admin Account</span>
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
                    <h1>Delete <span class="table-project-n"></span> User Accounts</h1>
                    <div class="sparkline13-outline-icon">
                      <span class="sparkline13-collapse-link"><i class="fa fa-chevron-up"></i></span>
                      <span><i class="fa fa-wrench"></i></span>
                      <span class="sparkline13-collapse-close"><i class="fa fa-times"></i></span>
                    </div>
                  </div>
                </div>

                <div class="sparkline13-graph">
                  <div class="datatable-dashv1-list custom-datatable-overright">


                    <form action="" method="post">
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Admin's ID</th>
                            <th>Admin Name</th>
                            <th>Admin Email</th>
                            <th>Admin Username</th>
                            <th>Phone Number</th>
                            <th>Registration Date</th>
                            <th style="border-right-style: hidden; border-bottom-style: hidden; border-top-style: hidden"></th>
                          </tr>
                        </thead>
                        <tbody>


                          <?php

                          $sql = "SELECT * FROM admin  ORDER BY ID ASC";
                          // $_SESSION['editplant']=$_POST['searchdata'];
                          $query = $Conn->query($sql);
                          $cnt = 1;
                          if ($query->num_rows > 0) {

                            while ($row = $query->fetch_assoc()) {
                              // {            
                          ?>
                              <tr>
                                <td><?php echo $row['ID']; ?></td>
                                <td><?php echo $row['Admin_name']; ?></td>
                                <td><?php echo $row['Admin_email']; ?></td>
                                <td><?php echo $row['Admin_username']; ?></td>
                                <td><?php echo $row['Phone_number']; ?></td>
                                <td><?php echo $row['Registration_date']; ?></td>
                                <td style="border-right-style: hidden; border-bottom-style: hidden; border-top-style: hidden"><button type="button" value="<?php echo $row['ID'] ?>" style="background:black; color:white" name="Delete" class="btn btn-primary  "><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></td>
                              </tr>


                        </tbody>
                    <?php
                              $cnt = $cnt + 1;
                            }
                          }
                    ?>
                      </table>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="delete">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" action="">
                <input type="hidden" class="adminid" name="adminid">
                <div class="text-center">
                  <p>DELETE ADMIN ACCOUNT</p>
                  <h2 class="bold fullname"></h2>
                </div>
                <div></div>
            </div>
            <div class="modal-footer">
              <button type="button" style="background:black; color:white" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>


              <button type="button" style="background:black; color:white" data-id="<?php echo  $ids; ?>" id="Delete" class="btn btn-danger btn-flat deleteadmin" name="delete"><i class="fa fa-trash"></i> Delete</button>
              </form>

            </div>
          </div>
        </div>
      </div>
      <!-- Modal ends -->

      </form>
      <!-- Static Table End -->

    </div>
    </div>
    <script>

    </script>
    <!-- jquery
		============================================ -->
    <script>
      $(document).ready(function() {
        $('button').click(function(e) {
          e.preventDefault();
          $('#delete').modal('show');
          var id = $(this).val();
          // data('id');

          getRow(id);
        });
      });


      $(document).ready(function() {
        $('#Delete').click(function(e) {
          e.preventDefault();
          var id = $(this).val();
          deleteRow(id);
        });
      });

      function deleteRow(id) {
        $.ajax({
          type: 'POST',
          url: 'admin_delete.php',
          data: {
            id: id
          },
          dataType: 'json',
          success: function() {
            document.location = 'delete-account.php';
          }
        })
      }

      function getRow(id) {
        $.ajax({
          type: 'POST',
          url: 'admin_row.php',
          data: {
            id: id
          },
          dataType: 'json',
          success: function(response) {
            $('.fullname').html(response.Admin_name);
            $('.adminid').html(response.ID);
            $('.deleteadmin').val(response.ID);
          }
        });
      }
    </script>
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