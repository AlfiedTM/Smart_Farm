     <?php
        session_start();
        error_reporting(0);
        include('includes/dbconnection.php');
        if (strlen($_SESSION['smaid'] == 0)) {
            header('location:logout.php');
        } else {



        ?>
         <div class="left-sidebar-pro" style="color:white">
             <nav id="sidebar">
                 <div class="sidebar-header" style="color:white">
                     <a href="profile.php"><img src="img/avatar.jpg" style="height:190px; width: 150px" alt="" />
                     </a>
                     <?php
                        $aid = $_SESSION['smaid'];
                        $sql = "SELECT Admin_username, Admin_email from  admin where ID='$aid'";
                        $query = $Conn->query($sql);
                        $cnt = 1;
                        if ($query->num_rows > 0) {
                            $row = $query->fetch_assoc();              ?>
                         <h3> <?php echo $row['Admin_username']; ?></h3>
                         <p style="display:none"> <?php echo  $_SESSION['Admin_email'] = $row['Admin_email']; ?></p>
                     <?php $cnt = $cnt + 1;
                        } ?>
                 </div>
                 <div class="left-custom-menu-adp-wrap" style="background-color: #222d32">
                     <ul class="nav navbar-nav left-sidebar-menu-pro">
                         <li class="nav-item">
                             <a href="dashboard.php" role="button" aria-expanded="false"><i class="fa big-icon fa-home"></i> <span class="mini-dn">Home</span> </a>

                         </li>
                         <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-table"></i> <span class="mini-dn">Current Irrigation</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                             <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                                 <a href="new-plant.php" class="dropdown-item">Add New Plant</a>
                                 <a href="delete-plant-record.php" class="dropdown-item">Delete Plant Record</a>
                                 <a href="change-irrigation.php" class="dropdown-item">Change Irrigation Info</a>
                                 <a href="change-record.php" class="dropdown-item">Edit Plant Record</a>
                                 <a href="todays's-irrigation-.php" class="dropdown-item">Currently Irrigating</a>
                                 <a href="plant-records.php" class="dropdown-item">Check Plant Records</a>
                             </div>
                         </li>
                         <li class="nav-item">
                             <a href="between-dates.php" role="button" aria-expanded="false"><i class="fa big-icon fa-files-o"> </i> <span class="mini-dn"> B/W Dates Reports</span> </a>
                         </li>
                         <li class="nav-item">
                             <a href="search.php" role="button" aria-expanded="false"><i class="fa fa-search"></i> <span class="mini-dn">Search Records</span> </a>
                         </li>
                         <li class="nav-item">
                             <a href="records.php" role="button" aria-expanded="false"><i class="fa fa-database" aria-hidden="true"></i> <span class="mini-dn">Data Records</span> </a>
                         </li>
                         <li class="nav-item">
                             <a href="backup.php" role="button" aria-expanded="false"><i class="fa fa-hdd-o" aria-hidden="true"></i> <span class="mini-dn">Back Up</span> </a>
                         </li>
                     </ul>
                 </div>
             </nav>
         </div>
     <?php }  ?>