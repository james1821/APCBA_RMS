<?php
	require 'validation.php';
require 'functions.php';
session_start();
require 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $user_id = $_SESSION['id'];
    $old_password = $_POST['old'];
    $new_password = $_POST['new'];

    // Retrieve the old password from the database for the user
    $query = "SELECT password FROM user WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];

        // Verify if the old password matches the stored hashed password
        if ($old_password === $hashed_password) {
            // Update the password in the database
            $new_hashed_password = $new_password;
            $update_query = "UPDATE user SET password = '$new_hashed_password' WHERE user_id = '$user_id'";
            $update_result = mysqli_query($conn, $update_query);

            if ($update_result) {
                // Password updated successfully
                $message = "Password updated successfully.";
                echo "<script>alert('$message'); window.location.href='view-user-profile.php';</script>";
                exit();
            } else {
                // Failed to update the password
                $message = "Failed to update the password.";
                echo "<script>alert('$message'); window.location.href='change-password.php';</script>";
                exit();
            }
        } else {
            // Old password does not match
            $message = "Old password is incorrect. ";
            echo "<script>alert('$message'); window.location.href='change-password.php';</script>";
            exit();
        }
    } else {
        // Failed to retrieve the old password from the database
        $message = "Failed to retrieve the old password.";
        echo "<script>alert('$message'); window.location.href='change-password.php';</script>";
        exit();
    }
} else {
    // Handle the case when the form is not submitted via POST method
    // You can redirect the user to an error page or perform any other actions here
}

?>
