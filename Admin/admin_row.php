<?php 
session_start();
include('includes/dbconnection.php');

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT * FROM admin WHERE id = '$id'";
		$_SESSION['adminiddel'] = $id;
		$query = $Conn->query($sql);
		$row = $query->fetch_assoc();
		echo json_encode($row);
	}
?>