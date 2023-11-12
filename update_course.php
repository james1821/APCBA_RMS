<?php
	require 'validation.php';
	require_once 'conn.php';
	session_start();
	if(ISSET($_POST['update'])){
		$id = $_POST['id'];
		$levels = $_POST['levels'];
		$course = $_POST['course'];
		$sections = $_POST['sections'];
		$years = $_POST['years'];

		$sql = "SELECT * FROM course where id = $id"; 


		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			
			while ($row = mysqli_fetch_assoc($result)) {
				$course_old = $row['course'];
				$level_old= $row['levels'];
				$section_old = $row['section'];	
				$year_old = $row['year'];	
			}
		} else {
			echo "No data found.";
		}

		date_default_timezone_set('Asia/Manila');
		$date = date('F j, Y g:i:s:a  ');
			$first= $_SESSION['firstname'];
			$last= $_SESSION['lastname'];
		?>
			<style>.green-bg {
				background-color: lightgreen;
			}</style>

			<?php
		$message = "<b>Updated a Course</b> <br>";

		if ($course != $course_old) {
			$message .= "<div><b>Course:</b> $course_old <b><br> to </b> <span style='background-color: lightgreen;'>$course</span></div>";
		} else {
			$message .= "<div><b>Course:</b> $course_old <i>(Unchanged)</i></div>";
		}
		
		if ($levels != $level_old) {
			$message .= "<div><b>Level:</b>$level_old <b> to</b> <span style='background-color: lightgreen;'>$levels</span></div>";
		} else {
			$message .= "<div><b>Level:</b> $level_old <i>(Unchanged)</i></div>";
		}
		
		if ($years != $year_old) {
			$message .= "<div><b>Years:</b> $year_old <b> to</b> <span style='background-color: lightgreen;'>$years</span></div>";
		} else {
			$message .= "<div><b>Years:</b> $year_old <i>(Unchanged)</i></div>";
		}
		
		if ($sections != $section_old) {
			$message .= "<div><b>Sections:</b>$section_old<b> to</b> <span style='background-color: lightgreen;'>$sections</span></div>";
		} else {
			$message .= "<div><b>Sections:</b> $section_old <i>(Unchanged)</i></div>";
		}
		
				

			
		$type = 'Update-Course';
		
						
		$fullD= $_SESSION['status']."_".$first." ".$last;
		
		mysqli_query($conn, "UPDATE `course` SET `levels` = '$levels', `course` = '$course', `section` = '$sections', `year` = '$years' WHERE `id` = '$id'") or die(mysqli_error());
		$message = mysqli_real_escape_string($conn, $message);
		mysqli_query($conn, "INSERT INTO `activity_log` (`id`, `user`, `date`, `activity`,`type`) VALUES(NULL, '$fullD', '$date', '$message', '$type')") or die(mysqli_error());

		echo "<script>alert('Successfully updated!')</script>";
		echo "<script>window.location = 'course.php'</script>";


	}
?>