<?php
	require 'validation.php';
require 'functions.php';
session_start();
require 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $user_id = $_SESSION['id'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['Middlename'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $username = $_POST['username'];

    // Retrieve the user's password from the database
    $password_query = "SELECT password FROM user WHERE user_id = '$user_id'";
    $password_result = mysqli_query($conn, $password_query);

    if ($password_result && mysqli_num_rows($password_result) > 0) {
        $row = mysqli_fetch_assoc($password_result);
        $stored_password = $row['password'];

        // Perform password check
        if ($password === $stored_password) {
            
            // Update the user profile in the database
           
           
            $type = 'Update-User';
            date_default_timezone_set('Asia/Manila');
            $date = date('F j, Y g:i:s:a  ');

                $first= $_SESSION['firstname'];
                $last= $_SESSION['lastname'];
                $gender_old= $_SESSION['gender'];
                $mi_old =$_SESSION['Middlename'];
                $email_old =$_SESSION['email'];
                $mobile_old =$_SESSION['mobile'];
                            
            $fullD= $_SESSION['status']."_".$first." ".$last;
          
           $message = "<b>Updated their User Information</b> <br> <br>";                                                                     

           if ($firstname != $first) {
			$message .= "<div><b>Firstname:</b> $first <b><br> to </b> <span style='background-color: lightgreen;'>$firstname  </span></div>";
		} else {
			$message .= "<div><b>Firstname: </b> $first <i>(Unchanged)</i></div>";
		}
		
		if ($middlename  != $mi_old) {
			$message .= "<div><b>Middlename:</b>$mi_old <b>to </b> <span style='background-color: lightgreen;'>$middlename</span></div>";
		} else {
			$message .= "<div><b>Middlename: </b> $mi_old <i>(Unchanged)</i></div>";
		}
		
		if ($lastname  != $last) {
			$message .= "<div><b>Lastname:</b> $last <b>to </b> <span style='background-color: lightgreen;'>$lastname years</span></div>";
		} else {
			$message .= "<div><b>Lastname: </b> $last <i>(Unchanged)</i></div>";
		}
		if ($gender  != $gender_old) {
			$message .= "<div><b>Gender: </b>$gender_old <b>to </b> <span style='background-color: lightgreen;'>$gender</span></div>";
		} else {
			$message .= "<div><b>Gender: </b> $gender_old <i>(Unchanged)</i></div>";
		}
		if ($email != $email_old) {
			$message .= "<div><b>Email: </b>$email_old<b> to </b> <span style='background-color: lightgreen;'> $email</span></div>";
		} else {
			$message .= "<div><b>Email: </b> $email_old <i>(Unchanged)</i></div>";
		}
        if ($mobile  != $mobile_old) {
			$message .= "<div><b>Mobile Number: </b>$mobile_old <b>to </b> <span style='background-color: lightgreen;'>$mobile</span></div>";
		} else {
			$message .= "<div><b>Mobile Number: </b> $mobile_old <i>(Unchanged)</i></div>";
		}
		

        
        $message = mysqli_real_escape_string($conn, $message);
        $query = "INSERT INTO `activity_log` VALUES('', '$fullD', '$date', '$message', '$type')";
        $query .= ";"; // Add a semicolon to separate the queries
        
        $query .= "UPDATE user SET firstname = '$firstname', Middlename = '$middlename', lastname = '$lastname', email = '$email', mobile = '$mobile', gender = '$gender', address = '$address',username= $username WHERE user_id = '$user_id'";
        $query .= ";"; // Add a semicolon to separate the queries
        
        mysqli_multi_query($conn, $query) or die(mysqli_error($conn));
        
        // Check if both queries were executed successfully
        if (mysqli_affected_rows($conn) > 0) {
            // User profile and activity log updated successfully
        
            // Destroy the current session and start a new session
            session_unset();
            session_destroy();
        
            $message_info = "User profile updated successfully. Please log in again.";
            echo "<script>alert('$message_info'); window.location.href='login.php';</script>";
            exit();
        } else {
            // Failed to update the user profile or activity log
            $message_info = "Failed to update the user profile.";
            echo "<script>alert('$message_info'); window.location.href='update-user-profile.php';</script>";
            exit();
        }
        
        } else {
            // Wrong password
            $message_info = "Wrong password! Failed to update profile.";
            echo "<script>alert('$message_info'); window.location.href='update-user-profile.php';</script>";
            exit();
        }
    } else {
        // Unable to retrieve the user's password
        $message_info = "Failed to retrieve user password.";
        echo "<script>alert('$message_info'); window.location.href='update-user-profile.php';</script>";
        exit();
    }
} else {
    // Handle the case when the form is not submitted via POST method
    // You can redirect the user to an error page or perform any other actions here
}
