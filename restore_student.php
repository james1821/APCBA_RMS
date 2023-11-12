<?php
	require 'conn.php';
	session_start();
	if (isset($_POST['id'])) {
	    $id = $_POST['id'];
	    
	    // Fetch the archived student record
	    $query = "SELECT * FROM archive WHERE id = ?";
	    $stmt = mysqli_prepare($conn, $query);
	    mysqli_stmt_bind_param($stmt, "i", $id);
	    mysqli_stmt_execute($stmt);
	    $result = mysqli_stmt_get_result($stmt);
	    $row = mysqli_fetch_array($result);

		$stud_no = $row['stud_no'];
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$middlename = $row['MIddlename'];

		
		$fullname=$firstname." ".$middlename ." ".$lastname;
		date_default_timezone_set('Asia/Manila');
		$date = date('F j, Y g:i:s:a  ');
			$first= $_SESSION['firstname'];
			$last= $_SESSION['lastname'];
	
						
		$fullD= $_SESSION['status']."_".$first." ".$last;
		$type = 'Restore-Student';
 
			$message = "<b>Restored a Student</b> <br>";

			$message .= "<div><b>Student ID:</b> $stud_no <br></div>";
			$message .= "<div><b>Firstname:</b> $fullname <br></div>";
		
		
		
		
	
// Activity log insertion query
$sql = "INSERT INTO `activity_log` (`id`, `user`, `date`, `activity`, `type`) VALUES(NULL, ?, ?, ?, ?)";
// Prepare the statement for activity log insertion
$stmt_activity = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt_activity, $sql)) {
    // Bind the parameters to the statement
    mysqli_stmt_bind_param($stmt_activity, "ssss", $fullD, $date, $message, $type);

    // Execute the statement for activity log insertion
    mysqli_stmt_execute($stmt_activity);

    // Close the statement for activity log insertion
    mysqli_stmt_close($stmt_activity);
} else {
    // Error: Failed to prepare the statement for activity log insertion
    echo "Error: Failed to prepare the database statement for activity log insertion.";
}

	    if ($row) {
	        // Move the record back to the student table
	        $query = "INSERT INTO student SELECT * FROM archive WHERE id = ?";
	        $stmt = mysqli_prepare($conn, $query);
	        mysqli_stmt_bind_param($stmt, "i", $id);
	        mysqli_stmt_execute($stmt);
	        
	        // Delete the record from the archive table
	        $query = "DELETE FROM archive WHERE id = ?";
	        $stmt = mysqli_prepare($conn, $query);
	        mysqli_stmt_bind_param($stmt, "i", $id);
	        mysqli_stmt_execute($stmt);
	        
			echo '<script>alert("Student restored successfully!");</script>';

			// Redirect to the archived page
			echo '<script>window.location.href = "student_archive.php";</script>';
	        exit;
	    }
	}
?>
