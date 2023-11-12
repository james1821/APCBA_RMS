<?php
require_once 'validation.php';
require_once 'conn.php';

if (isset($_POST['edit'])) {
    $user_id = $_POST['user_id'];
    $status = $_POST['status'];
    $fullname = $_POST['firstname'].' '. $_POST['Middlename'].' '.$_POST['lastname'];

    // Update the user's role in the database
    $update_query = mysqli_prepare($conn, "UPDATE `user` SET `status` = ? WHERE `user_id` = ?");
    mysqli_stmt_bind_param($update_query, 'si', $status, $user_id);
    mysqli_stmt_execute($update_query);

    if (mysqli_stmt_affected_rows($update_query) > 0) {
        // Get the necessary user information from the session
        $fullD = $_SESSION['status'] . "_" . $_SESSION['firstname'] . " " . $_SESSION['lastname'];
        $date = date('F j, Y g:i:s:a');
        $type = 'Update-Role';
        $message = "<b>Updated a User's Role</b> <br>";
        $message .= "<div><b>User ID:</b> $user_id <br></div>";
        $message .= "<div><b>User Fullname:</b> $user_id <br></div>";
        $message .= "<div><b>New Role:</b> <span style='background-color: lightgreen;'>$status</span> <br></div>";

        // Insert the activity log entry into the database
        $insert_query = mysqli_prepare($conn, "INSERT INTO `activity_log` (`id`, `user`, `date`, `activity`, `type`) VALUES (NULL, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($insert_query, 'ssss', $fullD, $date, $message, $type);
        mysqli_stmt_execute($insert_query);

        if (mysqli_stmt_affected_rows($insert_query) > 0) {
            // Activity log inserted successfully
        } else {
            echo "Error: Failed to insert the activity log.";
        }
    } else {
        echo "Error: Failed to update the user's role.";
    }

    // Redirect the user back to the previous page
    header('Location: user.php');
    exit();
}
?>
