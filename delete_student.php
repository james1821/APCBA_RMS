<?php
	require 'validation.php';
	require_once 'conn.php';
	session_start();
	if(ISSET($_POST['id'])){
		$id = $_POST['id'];
		$query = mysqli_query($conn, "SELECT * FROM `student` WHERE `id` = '$id'") or die(mysqli_error());
		$fetch  = mysqli_fetch_array($query);
		$stud_no = $fetch['stud_no'];
		$firstname = $fetch['firstname'];
		$lastname = $fetch['lastname'];
		$gender = $fetch['gender'];
		$yr = $fetch['yr_sec'];
		$fullname=$firstname." ".$lastname;
		date_default_timezone_set('Asia/Manila');
		$date = date('F j, Y g:i:s:a  ');
			$first= $_SESSION['firstname'];
			$last= $_SESSION['lastname'];
			$message="Archived the Records of this Student: $fullname ";
		
						
		$fullD= $_SESSION['status']."_".$first." ".$last;

		
		mysqli_query($conn, "INSERT INTO `student_archive` VALUES('', '$stud_no', '$firstname', '$lastname ','$gender','$yr')") or die(mysqli_error());
		
		mysqli_query($conn, "INSERT INTO `activity_log` VALUES('', '$fullD', '$date', 'Archived the Records of this Student: $fullname  ')") or die(mysqli_error());
		mysqli_query($conn, "DELETE FROM `student` WHERE `stud_no` = '$stud_no'") or die(mysqli_error());
		
		
		
	}
?>