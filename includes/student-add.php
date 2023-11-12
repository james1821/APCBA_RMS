


<?php
	
	//echo('gogo');
	//validate firstname
	require 'conn.php';
	session_start();

	
	$stud_no 	= $_POST['stud_no'];
	$existing_query = mysqli_query($conn, "SELECT * FROM `student` WHERE `stud_no` = '$stud_no'");
    $existing_rows = mysqli_num_rows($existing_query);
	if ($existing_rows > 0) {
		$info['success'] = false;
		
	}else{
	
  


	if(empty($info['errors']) )
	{
		//save to database
	
		$firstname 	= $_POST['firstname'];
	$MIddlename 	= $_POST['MIddlename'];
	$lastname 		= $_POST['lastname'];
	$email 			= $_POST['email'];
	$gender 		= $_POST['gender'];
	$guardian 		= $_POST['guardian'];
	$birthdate 		= $_POST['birthdate'];
	$birthplace 	= $_POST['birthplace'];
	$address 		= $_POST['address'];
	$level 			= $_POST['level'];
	$course 		= $_POST['course'];
	$section 		= $_POST['section'];
	$year 			= $_POST['year'];
	$id 			= $_POST['id'];
	$Status 		= $_POST['Status'];
	$image_query 		= "";
	$_SESSION['stud_no'] = $stud_no;
	if(!empty($image))
	{
		$image_query = ", image = ?";
	}

		
		
		
		
		date_default_timezone_set('Asia/Manila');
		$date = date('F j, Y g:i:s:a  ');
			$first= $_SESSION['firstname'];
			$last= $_SESSION['lastname'];
		
	
						
		$fullD= $_SESSION['status']."_".$first." ".$last;
		$type = 'Add-Student';
 
			$message = "<b>Added a new Student</b> <br>";

		
			$message .= "<div><b>Firstname:</b> $firstname <br></div>";
		
		
		
			$message .= "<div><b>Middlename: </b> $MIddlename <br> </div>";

		
		
			$message .= "<div><b>Lastname: </b> $lastname <br></div>";
	
		
	
			$message .= "<div><b>Email: </b> $email <br> </div>";

			$message .= "<div><b>Gender: </b> $gender <br> </div>";
			$message .= "<div><b>Status: </b> $Status <br> </div>";
			
		
		
			$message .= "<div><b>Guardian: </b> $guardian <br></div>";
		
		
		
			$message .= "<div><b>Birthdate: </b> $birthdate <br> </div>";
		
		
		
			$message .= "<div><b>Birthplace: </b> $birthplace <br> </div>";
		
		
			$message .= "<div><b>Sections: </b> $address <br> </div>";
		
		
		
			$message .= "<div><b>Level: </b> $level <br> </div>";
		
	
			$message .= "<div><b>Course: </b> $course <br> </div>";
		
		
		
		
		
			$message .= "<div><b>Sections: </b> $section </div>";
		
		
	// Assuming $conn is the mysqli database connection object

// Update query
$query = "INSERT INTO student (stud_no, firstname, MIddlename, lastname, gender,Status, email, birthdate, birthplace, level, course, year, section, guardian, address, image) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

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

// Prepare statement for update query
$stmt = mysqli_prepare($conn, $query);

if (!empty($image)) {
    mysqli_stmt_bind_param($stmt, "ssssssssssssssssi", $stud_no, $firstname, $MIddlename, $lastname, $gender, $email, $Status, $birthdate, $birthplace, $level, $course, $year, $section, $guardian, $address, $image, $id);
} else {
    mysqli_stmt_bind_param($stmt, "sssssssssssssssi", $stud_no, $firstname, $MIddlename, $lastname, $gender, $Status, $email, $birthdate, $birthplace, $level, $course, $year, $section, $guardian, $address, $id);
}

// Execute update query
mysqli_stmt_execute($stmt);

// Close statement for update query
mysqli_stmt_close($stmt);

		
		

		$info['success'] = true;

		
	}
}
