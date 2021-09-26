      <?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['smaid']==0)) {
  header('location:logout.php');
  } else{



  ?>
 <div class="content-inner-all">
            <div class="header-top-area" >
                <div class="fixed-header-top" style="margin-left:1.6%;">
                    <div class="container-fluid">
                        <div class="row" style="background-color: #222d32;">
                            <div class="col-lg-1 col-md-6 col-sm-6 col-xs-12">
                                <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn"  style="background:black">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <div class="admin-logo logo-wrap-pro">
                                    <a href="#"><img src="img/logo/log.png" alt="" />
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-1 col-sm-1 col-xs-12">
                                <div class="header-top-menu tabl-d-n">
                                    
                                </div>
                            </div> 
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 ">
                                <div class="header-right-info">
                                    <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                        <li class="nav-item">
                                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                <?php
$aid=$_SESSION['smaid'];
$sql="SELECT Admin_name from  manager where ID='$aid'";
$query = $Conn -> query($sql);
$cnt=1;
if($query->num_rows > 0)
{
    $row = $query->fetch_assoc();
              ?>
                                                <span class="adminpro-icon adminpro-user-rounded header-riht-inf"></span>
                                                <span class="admin-name"><?php  echo $row['Admin_name'];?></span>
                                                <span class="author-project-icon adminpro-icon adminpro-down-arrow"></span><?php $cnt=$cnt+1;} ?>
                                            </a>
                                            <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated flipInX" style="background: #222d32; color:white">
                                                
                                                <li ><a href="profile.php"><span class="adminpro-icon adminpro-user-rounded author-log-ic" ></span>My Profile</a>
                                                </li>
                                                 <li><a href="change-password.php"><span class="adminpro-icon adminpro-settings author-log-ic"></span>Settings</a>
                                                </li>
                                                <li><a href="logout.php"><span class="adminpro-icon adminpro-locked author-log-ic"></span>Log Out</a>
                                                </li>
                                            </ul>
                                        </li>
                                   
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><?php }  ?>