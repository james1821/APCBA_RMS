<?php
	require 'validation.php';
require_once 'conn.php';
session_start();

if (isset($_POST['Form_137']) || isset($_POST['Form_138']) || isset($_POST['TOR']) ||
    isset($_POST['Good_Moral']) || isset($_POST['PSA']) || isset($_POST['Diploma'])) {

    $fileTypes = [
        'Form_137' => 'Form 137',
        'Form_138' => 'Form 138',
        'TOR' => 'TOR',
        'Good_Moral' => 'Good Moral',
        'PSA' => 'PSA',
        'Diploma' => 'Diploma'
    ];

    $stud_no = $_POST['stud_no'];
    $fileType = null;
    $filename = null;

    foreach ($fileTypes as $key => $value) {
        if (isset($_POST[$key])) {
            $fileType = $key;
            break;
        }
    }

    if ($fileType !== null) {
        $query = mysqli_prepare($conn, "SELECT `$fileType` FROM `student` WHERE `stud_no` = ?");
        mysqli_stmt_bind_param($query, "s", $stud_no);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);
        $fetch = mysqli_fetch_array($result);
        $filename = $fetch[$fileType];

        if (!empty($filename)) {
            $filePath = "files/" . $stud_no . "/" . $fileType . "/" . $filename;
            
            if (is_readable($filePath) && filesize($filePath) > 0) {
                $_SESSION['downloaded'] = true;

                // Log the activity
                $message = "<b>Downloaded a Student Record</b> <br>";
                $message .= "<div><b>Record:</b> {$fileTypes[$fileType]}<br></div>";
                $message .= "<div><b>Student ID: </b> $stud_no <br></div>";
                insertActivityLog($message);

                header("Content-Disposition: attachment; filename=" . $filename);
                header("Content-Type: application/octet-stream;");
                readfile($filePath);
                exit;
            } else {
                echo "<script>alert('The file is empty.');</script>";
                echo "<script>window.history.go(-1);</script>";
                exit;
            }
        } else {
            echo "<script>alert('File not found.');</script>";
            echo "<script>window.history.go(-1);</script>";
            exit;
        }
    }
}

function insertActivityLog($message)
{
    global $conn;

    $fullD = $_SESSION['status'] . "_" . $_SESSION['firstname'] . " " . $_SESSION['lastname'];
    $date = date('F j, Y g:i:s:a');
    $type = 'Download-Record';

    $insert_query = mysqli_prepare($conn, "INSERT INTO `activity_log` (`id`, `user`, `date`, `activity`, `type`) VALUES (NULL, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($insert_query, 'ssss', $fullD, $date, $message, $type);
    mysqli_stmt_execute($insert_query);

    if (mysqli_stmt_affected_rows($insert_query) <= 0) {
        echo "Error: Failed to insert the activity log.";
    }
}
?>
