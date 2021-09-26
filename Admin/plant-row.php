<?php 
// Session start
session_start();
// Silence erro reporting
error_reporting(0);
// Import database connection and functions script
include('includes/dbconnection.php');
// Logic for Logged on access
if (strlen($_SESSION['smaid'] == 0)) {
  // If not redirect access to index page
  header('location:logout.php');
  // If logged on display this
} else {
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT * FROM plant_records WHERE id = '$id'";
		$_SESSION['adminiddel'] = $id;
		$query = $Conn->query($sql);
		$row = $query->fetch_assoc();
		echo json_encode($row);
	}
}
?>