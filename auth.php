<?php
 	require 'validation.php';
include("connection.php");
include("conn.php");

$checkResult="";
if($_POST['code']){
	
$code=$connect->real_escape_string($_POST['code']);

	
$secret = $_SESSION['secret'];

	
require_once 'googleLib/GoogleAuthenticator.php';
$ga = new GoogleAuthenticator();
$checkResult = $ga->verifyCode($secret, $code, 2); 
  // 2 = 2*30sec clock tolerance

//print "checkResult".$checkResult."<br/>";
//print "secret= ". $secret."<br>";
//print "code= ". $code."<br>";


if ($checkResult){
		
	

	$_SESSION['googleCode']	= $code;

	

	
	date_default_timezone_set('Asia/Manila');
	$date = date('F j, Y g:i:s:a  ');
			$first= $_SESSION['firstname'];
			$last= $_SESSION['lastname'];
						
		$fullD= $_SESSION['status']."_".$first." ".$last;

		mysqli_query($conn, "INSERT INTO `activity_log` VALUES('', '$fullD', '$date', 'Logged In Successfully ','Login')") or die(mysqli_error());
	 

								
		header("location:view-user-profile.php");
		exit;

} 
else{
	header("location:device_confirmations.php");
    exit;
}

}

?>
