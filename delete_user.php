<?php
require_once 'validation.php';
require_once 'conn.php';

if (isset($_POST['user_id']) && isset($_POST['password'])) {
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];

    // Compare the password with the session password
    if ($password === $_SESSION['password']) {
        // Password is correct, proceed with deletion
        $query = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_id` = '$user_id'") or die(mysqli_error());
        $fetch = mysqli_fetch_array($query);

        date_default_timezone_set('Asia/Manila');
        $date = date('F j, Y g:i:s:a');
        $first = $_SESSION['firstname'];
        $last = $_SESSION['lastname'];
        $fullD = $_SESSION['status'] . "_" . $first . " " . $last;

        $firstname = $fetch['firstname'];
        $middlename = $fetch['Middlename'];
        $lastname = $fetch['lastname'];

        $fullname_user = $firstname . ' ' . $middlename . ' ' . $lastname;

        $type = 'Delete-User';

        $message = "<b>Removed a User</b> <br>";
        $message .= "<div><b>Fullname:</b>  $fullname_user <br></div>";

        mysqli_query($conn, "DELETE FROM `user` WHERE `user_id` = '$user_id'") or die(mysqli_error());

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

            // Redirect the user back to the previous page
            header('Location: user.php');
            exit();
        } else {
            // Error: Failed to prepare the statement for activity log insertion
            echo "Error: Failed to prepare the database statement for activity log insertion.";
        }
    } else {
        // Password is incorrect, show an error message or redirect to a failure page
        echo "Incorrect password. Unable to remove the User.";
    }
}
?>
