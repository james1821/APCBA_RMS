<?php
	require 'validation.php';
	require_once 'conn.php';
	session_start();
	if(ISSET($_POST['id'])){
		$id = $_POST['id'];
		$query = mysqli_query($conn, "SELECT * FROM `course` WHERE `id` = '$id'") or die(mysqli_error());
		$fetch  = mysqli_fetch_array($query);
        $courseid= $fetch['id'];
		$course = $fetch['course'];
		$level = $fetch['levels'];
		$section = $fetch['year'];
		$year = $fetch['section'];
		$type= 'Delete-Course';
		$fullname=$firstname." ".$lastname;
		date_default_timezone_set('Asia/Manila');
		$date = date('F j, Y g:i:s:a  ');
			$first= $_SESSION['firstname'];
			$last= $_SESSION['lastname'];
			
		
						
		$fullD= $_SESSION['status']."_".$first." ".$last;

		
	
		
		mysqli_query($conn, "INSERT INTO `activity_log` VALUES('', '$fullD', '$date', '<b>Deleted a Course</b><br> <b>Level:</b> $level <br> <b>Course:</b> $course <br> <b>Year:</b> $year 
		 <br>  <b>Sections:</b> $section','$type')") or die(mysqli_error());
		mysqli_query($conn, "DELETE FROM `course` WHERE `id` = '$courseid'") or die(mysqli_error());
		
		
		
	}
?>