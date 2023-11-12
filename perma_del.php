<?php
	require 'validation.php';
require_once 'conn.php';
session_start();

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $query = "SELECT * FROM `archive` WHERE `id` = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $fetch = mysqli_fetch_array($result);

    $stud_no = $fetch['stud_no'];
    $firstname = $fetch['firstname'];
    $lastname = $fetch['lastname'];
    $middlename = $fetch['MIddlename'];
 date_default_timezone_set('Asia/Manila');
    $type = 'Delete-Student';
    $fullname = $firstname . " " . $middlename . " " . $lastname;
    $date = date('F j, Y g:i:s:a');
    $first = $_SESSION['firstname'];
    $last = $_SESSION['lastname'];
    $fullD = $_SESSION['status'] . "_" . $first . " " . $last;

    $message = "<span style='background-color: red; color:white;'><b>Permanently Deleted a Student</b><br></span>";
    $message .= "<div><b>Student ID: </b> $stud_no <br> </div>";
    $message .= "<div><b>Fullname:</b> $fullname <br></div>";

    // Insert activity log
    $insertQuery = "INSERT INTO `activity_log` (`id`, `user`, `date`, `activity`, `type`) VALUES (NULL, ?, ?, ?, ?)";
    $insertStmt = mysqli_prepare($conn, $insertQuery);
    mysqli_stmt_bind_param($insertStmt, "ssss", $fullD, $date, $message, $type);
    mysqli_stmt_execute($insertStmt);

    // Delete associated files and records
    if (file_exists("files/" . $stud_no)) {
        removeDir("files/" . $stud_no);
    }

    $deleteQuery = "DELETE FROM `archive` WHERE `id` = ?";
    $deleteStmt = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($deleteStmt, "i", $id);
    mysqli_stmt_execute($deleteStmt);
}

function removeDir($dir) {
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }
        $path = $dir . '/' . $item;
        if (is_dir($path)) {
            removeDir($path);
        } else {
            unlink($path);
        }
    }
    rmdir($dir);
}
?>
