<!-- Logout Script -->
<?php
// Session start
session_start();
// Unset all session variables
session_unset();
// Destroy all the stored data
session_destroy();
// Redirect to the index page
header('location:index.php');
?>