<?php

require 'conn.php';
session_start();
if (isset($_SESSION['user'])):
  
  date_default_timezone_set('Asia/Manila');
  $date = date('F j, Y g:i:s:a  ');
			$first= $_SESSION['firstname'];
			$last= $_SESSION['lastname'];
	
		
						
		$fullD= $_SESSION['status']."_".$first." ".$last;
						
		
		mysqli_query($conn, "INSERT INTO `activity_log` VALUES('', '$fullD', '$date', 'Logged Out from the System ','Logout')") or die(mysqli_error());
    session_regenerate_id();
    unset($_SESSION['googleCode']);
    unset($_SESSION['email']);
    unset($_SESSION['secret']);
    unset($_SESSION['username']);
    unset($_SESSION['password']);

    session_unset();
	header("location:login.php");
endif;
?>
