<?php
	require_once 'conn.php';
	require 'validation.php';
	if(ISSET($_POST['update'])){
		$id = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$gender = $_POST['gender'];
		$yrsec = $_POST['year']."".$_POST['section'];
		
		
		mysqli_query($conn, "UPDATE `student` SET `firstname`='$firstname', `lastname`='$lastname', `gender`='$gender', `yr_sec`='$yrsec', `password`='$password' WHERE `id`='$id' ") or die(mysqli_error());
		
		header('location: student_profile.php');
	}
?>