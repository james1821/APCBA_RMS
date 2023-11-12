<?php
  	require 'validation.php';
  $stud_no = $_POST["stud_no"];
  $filename = $_POST["file"];
  $filetype = $_POST["filetype"];
  $file = "files/" . $stud_no . "/" . $filetype. "/" . $filename;
  if (file_exists($file)) {
    // output PDF to browser
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . $filename . '"');
    header('Content-Length: ' . filesize($file));
    readfile($file);
  } else {
    echo '<script>';
    echo 'alert("Record does not exist.");';
    echo 'window.history.back();';
    echo '</script>';
  }
?>
