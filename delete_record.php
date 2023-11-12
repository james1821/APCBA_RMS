<?php
	require 'validation.php';
require_once 'conn.php';
session_start();

if (isset($_POST['id']) && isset($_POST['stud_no']) && isset($_POST['filename']) && isset($_POST['filetype']) && isset($_POST['password'])) {
    $id = $_POST['id'];
    $original_stud_no = $_POST['stud_no']; // Store the original stud_no
    $filename = $_POST['filename'];
    $filetype = $_POST['filetype'];
    $password = $_POST['password'];

    // Sanitize and validate the input values
    $id = mysqli_real_escape_string($conn, $id);
    $original_stud_no = mysqli_real_escape_string($conn, $original_stud_no);
    $filename = mysqli_real_escape_string($conn, $filename);
    $filetype = mysqli_real_escape_string($conn, $filetype);
    $password = mysqli_real_escape_string($conn, $password);

    // Verify the password
    if ($password === $_SESSION['password']) {
        date_default_timezone_set('Asia/Manila');
        $date = date('F j, Y g:i:s:a');
        $first = $_SESSION['firstname'];
        $last = $_SESSION['lastname'];
        $fullD = $_SESSION['status'] . "_" . $first . " " . $last;
        $type = 'Delete-Record';

        $message = "<b>Deleted a Student Record</b> <br>";
        $message .= "<div><b>Student Number:</b> $original_stud_no<br></div>";
        $message .= "<div><b>Student:</b> $first $last <br></div>";
        $message .= "<div><b>Record: </b> $filetype<br></div>";

        $sql = "INSERT INTO `activity_log` (`id`, `user`, `date`, `activity`, `type`) VALUES(NULL, ?, ?, ?, ?)";
        $query = "UPDATE `student` SET `$filetype` = NULL WHERE `stud_no` = ?";

        // Prepare the statement for activity log insertion
        $stmt_activity = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt_activity, $sql)) {
            // Bind the parameters to the statement
            mysqli_stmt_bind_param($stmt_activity, "ssss", $fullD, $date, $message, $type);

            // Execute the statement for activity log insertion
            mysqli_stmt_execute($stmt_activity);

            // Close the statement for activity log insertion
            mysqli_stmt_close($stmt_activity);

            // Delete the file from the server
            $file_path = "files/" . $original_stud_no . "/" . $filetype . "/" . $filename;
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            // Update the corresponding database field to remove the filename
            $stmt_update = mysqli_stmt_init($conn);
            if (mysqli_stmt_prepare($stmt_update, $query)) {
                mysqli_stmt_bind_param($stmt_update, "s", $original_stud_no);
                mysqli_stmt_execute($stmt_update);
                mysqli_stmt_close($stmt_update);

                // Display JavaScript alert and redirect to previous page
                echo '<script>alert("Record deleted successfully!");</script>';
                echo '<script>window.history.go(-1);</script>';
                exit();
            } else {
                echo "Error: Failed to prepare the database statement for updating student record.";
            }
        } else {
            // Error: Failed to prepare the statement for activity log insertion
            echo "Error: Failed to prepare the database statement for activity log insertion.";
        }
    } else {
        echo '<script>alert("Incorrect password! Unable to delete record.");</script>';
        echo '<script>window.history.go(-1);</script>';
    }
} else {
    echo "Invalid request!";
}
?>
