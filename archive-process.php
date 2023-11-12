<?php
	require 'validation.php';
require 'functions.php';
require 'conn.php';
session_start();

if (isset($_POST['id'])) {
    $id = $_POST['id'];


    $query = mysqli_query($conn, "SELECT * FROM `student` WHERE `id` = '$id'") or die(mysqli_error());
    $fetch  = mysqli_fetch_array($query);
    $stud_no = $fetch['stud_no'];
    $firstname = $fetch['firstname'];
    $lastname = $fetch['lastname'];
    $middlename = $fetch['MIddlename'];
    $type = 'Archive-Student';


    date_default_timezone_set('Asia/Manila');
    $date = date('F j, Y g:i:s:a  ');
        $first= $_SESSION['firstname'];
        $last= $_SESSION['lastname'];
        $fullname=$firstname." ".$middlename ." ".$lastname;

                    
    $fullD= $_SESSION['status']."_".$first." ".$last;
   
        $message = "<b>Archived a Student</b> <br>";

    
        $message .= "<div><b>Student ID:</b> $stud_no <br></div>";
    
    
    
        $message .= "<div><b>Fullname: </b> $fullname <br> </div>";

    
        mysqli_query($conn, "INSERT INTO `activity_log` VALUES('', '$fullD', '$date', '$message', '$type')") or die(mysqli_error());

    
    // Fetch the student record
    $row = db_query("SELECT * FROM student WHERE id = :id LIMIT 1", ['id' => $id]);

    if ($row) {
        $row = $row[0];
        
        // Move the record to the archive table
        db_query("INSERT INTO archive SELECT * FROM student WHERE id = :id", ['id' => $id]);
        
        // Delete the record from the student table
        db_query("DELETE FROM student WHERE id = :id", ['id' => $id]);
        
        // Redirect to the archived page
        header("Location: student_archive.php");
        exit;
    }
}
?>
