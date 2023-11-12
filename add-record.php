<?php 
    session_start();
	require 'functions.php';
	require_once 'conn.php';
  require 'validation.php';
	include('sidebar.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Records</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="assets/css/student-profile.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel = "stylesheet" type = "text/css" href = "css/style.css" />
	
</head>
<body>

<?php 
 
 $stud_no = isset($_SESSION['stud_no']) ? $_SESSION['stud_no'] : '';
$query2 = mysqli_query($conn, "SELECT * FROM `student` WHERE `stud_no` = '$stud_no'") or die(mysqli_error());
$rows = mysqli_fetch_array($query2);
$id = $rows['id'];
 $Form_137 = $rows['Form_137'];
$tor = $rows['Tor'];
$Good_Moral = $rows['Good_Moral'];
$Form_138 = $rows['Form_138'];
$diploma = $rows['Diploma'];
 $psa = $rows['Psa']; 

 $Student = $rows['firstname'].'  '. $rows['lastname'];

 
?>
<?php if(!empty($rows)):?>
	<div class="col-md-4 addtable ">
		
  <table class="addtable2 table border  mx-auto mt-5 p-2 shadow-lg " >
    <thead>
    <tr>
</tr>
      <tr>
        <th style="font-size:20px;">Record</th>
        <th style="font-size:20px;">Action</th>
      </tr>
    </thead>
    <tbody>
  <?php
    $records = array(
      array("name" => "Form_137", "file" => $Form_137),
      array("name" => "Form_138", "file" => $Form_138),
      array("name" => "TOR", "file" => $tor),
      array("name" => "Good_Moral", "file" => $Good_Moral),
      array("name" => "Diploma", "file" => $diploma),
      array("name" => "PSA", "file" => $psa)
    );

    foreach ($records as $record) {
      echo '<tr>';
      echo '<td>';
      if (empty($record["file"])) {
        echo '<i class="bi bi-file-earmark-check"></i> ' . $record["name"] . ' <span style="color:red; font-size:10px">Empty!</span>';
      } else {
        echo '<i class="bi bi-file-person"></i> <b>' .  $record["name"] . '</b> <span style="color:white; font-size:10px">Empty!</span>';
      }
      echo '</td>';
      echo '<td>';
      echo '<div style="display:flex;">';
      
      echo '<button style="height:fit-content; width:6rem;" id="' . $record["name"] . '" class="btn btn-primary upload-btn" data-bs-toggle="modal" data-bs-target="#uploadModal' . str_replace(" ", "_", $record["name"]) . $id . '" data-record-name="' . $record["name"] . '"><i class="bi-cloud-arrow-up-fill"></i></button>';
      
      echo '<form action="view_rec.php" method="POST" class="d-inline">';
      echo '<input name="stud_no" type="hidden" value="' . $stud_no . '">';
      echo '<input name="file" type="hidden" value="' . $record["file"] . '">';
      echo '<input name="filetype" type="hidden" value="' . $record["name"] . '">';
      echo '<button class="btn btn-warning" style="height:fit-content; width:6rem;" type="submit"><i class="bi-eye-fill"></i></button>';
      echo '</form>';
      
      echo '</div>';
      echo '</td>';
      echo '</tr>';
    }

    // Add the next button row
    echo '<tr>';
    echo '<td colspan="2" style="text-align: center; ">';
    echo '<a href="student_profile.php?id=' . $id . '">';
    echo '<button  style="  width:10rem;" class="btn btn-success" >Next</button>';
    echo '</a>';
  
    echo '</td>';
    echo '</tr>';

   
  ?>
</tbody>

  </table>
</div>
		</div>
		
		

	</div>
	<div>
<?php

function generateModalForm($recordType, $id, $Student, $stud_no, $formValue) {
    ?>
    <div class="modal fade" id="uploadModal<?php echo $recordType . $id; ?>" tabindex="-1" aria-labelledby="uploadModalLabel<?php echo $recordType . $id; ?>" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="uploadModalLabel<?php echo $recordType . $id; ?>">Upload <?php echo $recordType ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <form enctype="multipart/form-data" method="post" action="upload_record.php">
              <div class="form-group">
                <label for="fileInput<?php echo $recordType ?>">Select PDF File</label>
                <input type="file" value="<?php echo $formValue; ?>" class="form-control" id="fileInput<?php echo $recordType ?>" name="filename" accept="application/pdf" >
              </div>
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="hidden" name="filetype" value="<?php echo $recordType ?>">
            
              <input readonly type="hidden" name="studentId" value="<?php echo $stud_no; ?>">
              <br>
              <button name="<?php echo $recordType ?>" class="btn btn-primary">Confirm</button>
            </form>
            <form method="post" action="upload_record.php">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="hidden" name="studentId" value="<?php echo $stud_no; ?>">
              <input type="hidden" name="filetype" value="<?php echo $recordType ?>">
        
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php
}

// Usage:

generateModalForm("Form_137", $id, $Student, $stud_no, $Form_137);
generateModalForm("Form_138", $id, $Student, $stud_no, $Form_138);
generateModalForm("TOR", $id, $Student, $stud_no, $tor);
generateModalForm("Good_Moral", $id, $Student, $stud_no, $Good_Moral);
generateModalForm("Diploma", $id, $Student, $stud_no, $diploma);
generateModalForm("PSA", $id, $Student, $stud_no, $psa);

?>


	<?php else:?>
		<div class="text-center alert alert-danger">That profile was not found</div>
		<a href="index.php">
			<button class="btn btn-primary m-4">Home</button>
		</a>
	<?php endif;?>
   

</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>