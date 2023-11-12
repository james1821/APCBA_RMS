<?php
	
	//echo('gogo');
	//validate firstname
	require 'conn.php';
	session_start();
	


	
  


	if(empty($info['errors']) && $row)
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
	$Status			= $_POST['Status'];
	$image_query 		= "";

	if(!empty($image))
	{
		$image_query = ", image = ?";
	}

		
		$sql = "SELECT * FROM student where id = $id"; 


		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($newRow = mysqli_fetch_assoc($result)) {
				$firstname_old = $newRow['firstname'];
				$mi_old= $newRow['MIddlename'];
				$lastname_old = $newRow['lastname'];	
				$email_old = $newRow['email'];	
				$gender_old = $newRow['gender'];	
				$guardian_old = $newRow['guardian'];	
				$birthdate_old = $newRow['birthdate'];	
				$birthplace_old = $newRow['birthplace'];	
				$address_old = $newRow['address'];
				$level_old = $newRow['Level'];
				$course_old = $newRow['Course'];	
				$year_old = $newRow['Year'];
				$section_old = $newRow['Section'];
				$Status_old	= $newRow['Status'];
			}
		} else {
			echo "No data found.";
		}
		
		
		date_default_timezone_set('Asia/Manila');
		$date = date('F j, Y g:i:s:a  ');
			$first= $_SESSION['firstname'];
			$last= $_SESSION['lastname'];
		
	
						
		$fullD= $_SESSION['status']."_".$first." ".$last;
		$type = 'Update-Student';
 
			$message = "<b>Updated a Student</b> <br>";

		if ($firstname != $firstname_old) {
			$message .= "<div><b>Firstname: </b> $firstname_old <b><br>to </b> <span style='background-color: lightgreen;'>$firstname  </span></div>";
		} else {
			$message .= "<div><b>Course: </b> $firstname_old <i>(Unchanged)</i></div>";
		}
		
		if ($MIddlename  != $mi_old) {
			$message .= "<div><b>Middlename: </b>$mi_old <b>to </b> <span style='background-color: lightgreen;'>$MIddlename </span></div>";
		} else {
			$message .= "<div><b>Middlename: </b> $mi_old <i>(Unchanged)</i></div>";
		}
		
		if ($lastname  != $lastname_old) {
			$message .= "<div><b>Lastname: </b> $lastname_old <b>to </b> <span style='background-color: lightgreen;'>$lastname years</span></div>";
		} else {
			$message .= "<div><b>Lastname: </b> $lastname_old <i>(Unchanged)</i></div>";
		}
		
		if ($email 	 != $email_old) {
			$message .= "<div><b>Email: </b>$email_old<b>to </b> <span style='background-color: lightgreen;'>$email</span></div>";
		} else {
			$message .= "<div><b>Email: </b> $email_old <i>(Unchanged)</i></div>";
		}
		if ($gender  != $gender_old) {
			$message .= "<div><b>Gender: </b>$gender_old<b>to </b> <span style='background-color: lightgreen;'>$gender</span></div>";
		} else {
			$message .= "<div><b>Gender: </b> $gender_old <i>(Unchanged)</i></div>";
		}
		if ($Status  != $Status_old) {
			$message .= "<div><b>Status: </b>$Status_old<b>to </b> <span style='background-color: lightgreen;'>$Status</span></div>";
		} else {
			$message .= "<div><b>Status: </b> $Status_old <i>(Unchanged)</i></div>";
		}
		
		if ($guardian  != $guardian_old) {
			$message .= "<div><b>Guardian: </b>$guardian_old<b>to </b> <span style='background-color: lightgreen;'>$guardian</span></div>";
		} else {
			$message .= "<div><b>Guardian: </b> $guardian_old <i>(Unchanged)</i></div>";
		}
		
		if ($birthdate  != $birthdate_old) {
			$message .= "<div><b>Birthdate: </b>$birthdate_old<b>to </b> <span style='background-color: lightgreen;'>$birthdate</span></div>";
		} else {
			$message .= "<div><b>Birthdate: </b> $birthdate_old <i>(Unchanged)</i></div>";
		}
		
		if ($birthplace != $birthplace_old) {
			$message .= "<div><b>Birthplace: </b>$birthplace_old<b>to </b> <span style='background-color: lightgreen;'>$birthplace</span></div>";
		} else {
			$message .= "<div><b>Birthplace: </b> $birthplace_old <i>(Unchanged)</i></div>";
		}
		
		if ($address  != $address_old) {
			$message .= "<div><b>Address: </b>$address_old<b>to </b> <span style='background-color: lightgreen;'>$address</span></div>";
		} else {
			$message .= "<div><b>Address: </b> $address_old <i>(Unchanged)</i></div>";
		}
		
		if ($level != $level_old) {
			$message .= "<div><b>Level:</b>$level_old<b>to </b> <span style='background-color: lightgreen;'>$level</span></div>";
		} else {
			$message .= "<div><b>Level: </b> $level_old <i>(Unchanged)</i></div>";
		}
		
		if ($course != $course_old) {
			$message .= "<div><b>Course:</b>$course_old<b>to </b> <span style='background-color: lightgreen;'>$course</span></div>";
		} else {
			$message .= "<div><b>Course: </b> $course_old <i>(Unchanged)</i></div>";
		}

		if ($year != $year_old) {
			$message .= "<div><b>Years: </b>$year_old<b>to </b> <span style='background-color: lightgreen;'>$year</span></div>";
		} else {
			$message .= "<div><b>Years: </b> $year_old <i>(Unchanged)</i></div>";
		}
		if ($section != $section_old) {
			$message .= "<div><b>Sections: </b>$section_old<b>to </b> <span style='background-color: lightgreen;'>$section</span></div>";
		} else {
			$message .= "<div><b>Sections: </b> $section_old <i>(Unchanged)</i></div>";
		}
		
	// Assuming $conn is the mysqli database connection object

// Update query
$query = "UPDATE student SET firstname = ?, MIddlename = ?, lastname = ?, gender = ?, Status = ?, email = ?, birthdate = ?, birthplace = ?, level = ?, course = ?, year = ?, section = ?, guardian = ?, address = ? $image_query WHERE id = ? LIMIT 1";

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
    mysqli_stmt_bind_param($stmt, "sssssssssssssssi", $firstname, $MIddlename, $lastname, $gender,$Status, $email, $birthdate, $birthplace, $level, $course, $year, $section, $guardian, $address, $image, $id);
} else {
    mysqli_stmt_bind_param($stmt, "ssssssssssssssi", $firstname, $MIddlename, $lastname, $gender,$Status, $email, $birthdate, $birthplace, $level, $course, $year, $section, $guardian, $address, $id);
}

// Execute update query
mysqli_stmt_execute($stmt);

// Close statement for update query
mysqli_stmt_close($stmt);


	


		

		//delete old image
		if(!empty($image) && file_exists($row['image']))
		{
			unlink($row['image']);
		}
		$row = db_query("select * from student where id = :id limit 1", ['id' => $row['id']]);

		
		

		$info['success'] 	= true;

		
	}
	