<?php 

	require 'functions.php';
	session_start();
	require 'conn.php';

	$id = $_GET['id'];
	$course = db_query("select * from course ");
	$row = db_query("select * from student where id = :id limit 1",['id'=>$id]);

	if($row)
	{
		$row = $row[0];
	}
	include('sidebar.php');
  $title="STUDENT PROFILE";
  include('navbar.php');

 $fullname = $row['firstname'].'_'.$row['lastname'];

$str =esc($row['MIddlename']);

$initial = substr($str, 0, 1).'.';

$query2 = mysqli_query($conn, "SELECT * FROM `student` WHERE `id` = '$id'") or die(mysqli_error());
$rows = mysqli_fetch_array($query2);

 $Form_137 = $rows['Form_137'];
$tor = $rows['Tor'];
$Good_Moral = $rows['Good_Moral'];
$Form_138 = $rows['Form_138'];
$diploma = $rows['Diploma'];
 $psa = $rows['Psa']; 
 
 $stud_no = $rows['stud_no']; 
 $Student = $rows['firstname'].' '. $initial.' '. $rows['lastname'];

 

	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> <?php echo $Student?></title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="assets/css/student-profile.css">
	<link rel = "stylesheet" type = "text/css" href = "css/style.css" />
	
</head>
<body>	




	<?php if(!empty($row)):?>
	
	
    <div id="confirmationModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to archive this student?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <!-- Add an onclick event to show the confirmation modal -->
                <button type="button" class="btn btn-primary" onclick="confirmArchive()">Archive</button>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmArchive() {
        // Submit the form if the user confirms the archive action
        document.getElementById("archiveForm").submit();
    }
</script>

		
			
		
		</div>
		<div class="container">
 

  <div class="row">
    <div class="col-md-8">
      <table class="table1 table border mx-auto mt-5 p-2 shadow-lg">
        <tr>
        <th colspan="2">
      <div class="top-group">
       <img src="img/school.jpg" alt="">
         
            <div class="h2"><?= esc($row['firstname']).' '.$initial.' '.esc($row['lastname']) ?> </div>
            
           
            </th>
        </tr>

     </div>
       
        <tr>
          <th><i class="bi bi-envelope"></i> Email</th>
          <td class="centered-text text-center"><?= esc($row['email']) ?></td>
        </tr>
        <tr>
          <th><i class="bi bi-person-circle"></i> First name</th>
          <td class="centered-text text-center"><?= esc($row['firstname']) ?></td>
        </tr>
        <tr>
          <th><i class="bi bi-person-circle"></i> Middle name</th>
          <td class="centered-text text-center"><?= esc($row['MIddlename']) ?></td>
        </tr>
        <tr>
          <th><i class="bi bi-person-square"></i> Last name</th>
          <td class="centered-text text-center"><?= esc($row['lastname']) ?></td>
        </tr>
        <tr>
          <th><i class="bi bi-gender"></i> Gender</th>
          <td class="centered-text text-center"><?= esc($row['gender']) ?></td>
        </tr>
        <tr>
          <th><i class="bi bi-book-fill"></i> Status</th>
          <td class="centered-text text-center"><?= esc($row['Status']) ?></td>
        </tr>
        <tr>
          <th><i class="bi bi-book-fill"></i> Course/Section</th>
          <td class="centered-text text-center"><?= esc($row['Level'] . '-' . $row['Course'] . ' ' . $row['Year']. '-' . $row['Section']) ?></td>
        </tr>
        <tr>
          <th><i class="bi bi-house"></i> Address</th>
          <td class="centered-text text-center"><?= esc($row['address']) ?></td>
        </tr>
        <tr>
          <th><i class="bi bi-calendar-event-fill"></i> Birthdate</th>
          <td class="centered-text text-center"><?= esc($row['birthdate']) ?></td>
        </tr>
        <tr>
          <th><i class="bi bi-building"></i> Birthplace</th>
          <td class="centered-text text-center"><?= esc($row['birthplace']) ?></td>
        </tr>
        <tr>
          <th><i class="bi bi-people-fill"></i> Guardian/Parent</th>
          <td class="centered-text text-center"><?= esc($row['guardian']) ?></td>
        </tr>
    
        <tr>
  
    <td colspan="2" style="text-center">
      <form method="post" action="archive-process.php" id="archive_form" class="d-inline">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button style="width: 8rem; " class=" btn btn-danger btn-archive" type="button">Archive</button>
      </form>
      <a href="edit-profile.php?id=<?php echo($id);?>" class="d-inline">
        <button style="width: 8rem;" class="btn btn-primary">Update Profile</button>
      </a>
    </td>
  </tr>


<div class="modal fade" id="modal_confirm_archive" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Confirmation</h3>
      </div>
      <div class="modal-body">
        <center><h3 class="text-danger">Are you sure you want to archive this Student?</h3></center>
      </div>
      <div class="modal-footer">
      
        <button type="button" class="btn btn-success" id="btn_yes_archive">Yes</button>
      </div>
    </div>
  </div>
</div>

</table>

</div>
<div class="col-md-4 ">
  <table class="table2 table border  mx-auto mt-5 p-2 shadow-lg">
    <thead>
      <tr>
        <th>Record</th>
        <th>Action</th>
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
            echo '<i class="bi bi-file-person"></i> <b>' .  $record["name"] . '';
          }
          echo '</td>';
          echo '<td>';
          echo '<div style="display:flex; ">';
          
          
            echo '<form action="download.php" method="POST" class="d-inline">';
            echo '<input name="id" type="hidden" value="' . $id . '">';
            echo '<input name="stud_no" type="hidden" value="' . $stud_no . '">';
            echo '<button name="' .$record["name"]. '" class="btn btn-success download-btn"><i class="bi-arrow-down-circle-fill"></i></button>';
            echo '</form>';

            echo '<form action="view_rec.php" method="POST" class="d-inline">';
echo '<input name="id" type="hidden" value="' . $id . '">';
echo '<input name="stud_no" type="hidden" value="' . $stud_no . '">';
echo '<input name="file" type="hidden" value="' . $record["file"] . '">';
echo '<input name="filetype" type="hidden" value="' . $record["name"] . '">';
echo '<button class="btn btn-warning" style="height:fit-content; margin-left:10px;" type="submit"><i class="bi-eye-fill"></i></button>';
echo '</form>';
          echo '</div>';
          echo '</td>';
          echo '</tr>';
        }
        
      ?>
        
    </tbody>
  </table>
  
</div>


 


<?php include 'script.php'?>


	<?php else:?>
		<div class="text-center alert alert-danger">That profile was not found</div>
		<a href="index.php">
			<button class="btn btn-primary m-4">Home</button>
		</a>
	<?php endif;?>
	
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<script>
  $(document).ready(function() {
  $('.btn-archive').on('click', function() {
    $("#modal_confirm_archive").modal('show');
  });

  $('#btn_yes_archive').on('click', function() {
    $("#archive_form").submit();
  });
});
</script>

<script>
			function goBack() {
				history.back();
			}
		</script>