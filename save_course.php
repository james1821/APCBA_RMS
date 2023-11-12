<?php
	require_once 'conn.php';
	session_start();
	if(ISSET($_POST['save'])){
		
		$level = $_POST['level'];
		$course = $_POST['course'];
        $year = $_POST['year'];	
		$section = $_POST['section'];
		
		$date=$_POST[ date("Y")];
		
		
		$fullname=$firstname." ".$lastname;
		date_default_timezone_set('Asia/Manila');
		$date = date('F j, Y g:i:s:a  ');
			$first= $_SESSION['firstname'];
			$last= $_SESSION['lastname'];
			
			$message = "<b>Updated a Course</b> <br>";
						
		$fullD= $_SESSION['status']."_".$first." ".$last;
		$type = 'Add-Course';
		
	
		mysqli_query($conn, "INSERT INTO `activity_log` VALUES('', '$fullD', '$date', '<b>Added a Course</b><br> <b>Course:</b> $course<br> <b>Level:</b> $level<br> <b>Years:</b>  $year<br> <b>Sections:</b> $section','$type')") or die(mysqli_error());
		mysqli_query($conn, "INSERT INTO `course` VALUES('', '$course', '$level',$year, '$section')") or die(mysqli_error());
		
		// Output JavaScript code to display alert
		echo '<script>';
		echo 'alert("Course added successfully!");';
		echo 'window.location.href = "course.php";'; // Redirect after displaying the alert
		echo '</script>';
		

	}
?>