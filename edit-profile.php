<?php 
	require 'validation.php';
	require 'functions.php';
	require_once 'conn.php';
	session_start();
	$id = $_GET['id'];
	$course = db_query("select * from course ");
	$row = db_query("select * from student where id = :id limit 1",['id'=>$id]);

	if($row)
	{
		$row = $row[0];
	}
	include('sidebar.php');
  $title="UPDATE STUDENT PROFILE";
  include('navbar.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update Student Profile</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="assets/css/update.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	
</head>
<body>

<?php $fullname = $row['firstname'].'_'.$row['lastname'];

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

	<?php if(!empty($row)):?>

		<div class="container ">
  <div class="row">
    <div class="tab col-md-7  border  mx-auto mt-5 p-2 shadow-lg " >
   
	<form method="post" onsubmit="myaction.collect_data(event, 'profile-edit')">
 
    
    <div class="row justify-content-center">
      <div class="col-lg-5">
        <div class="mb-3">
		<input value="<?=$row['id']?>" type="hidden" class="form-control" name="id" id="id" placeholder="id">
		<input  value="<?=$row['stud_no']?>" type="hidden" class="form-control" name="stud_no" id="stud_no" placeholder="stud_no">

          <label for="email" class="form-label fw-bold">Email</label>
          <div class="input-group">
            <input value="<?=$row['email']?>" type="text" class="form-control" name="email" id="email" placeholder="Email">
            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
          </div>
          <small class="text-danger js-error-email"></small>
        </div>
        <div class="mb-3">
          <label for="firstname" class="form-label fw-bold">First Name</label>
          <div class="input-group">
            <input value="<?=$row['firstname']?>" type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name">
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
          </div>
          <small class="text-danger js-error-firstname"></small>
        </div>
        <div class="mb-3">
          <label for="middlename" class="form-label fw-bold">Middle Name</label>
          <div class="input-group">
            <input value="<?=$row['MIddlename']?>" type="text" class="form-control" name="MIddlename" id="MIddlename" placeholder="Middle Name">
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
          </div>
          <small class="text-danger js-error-middlename"></small>
        </div>
        <div class="mb-3">
          <label for="lastname" class="form-label fw-bold">Last Name</label>
          <div class="input-group">
            <input value="<?=$row['lastname']?>" type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name">
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
          </div>
          <small class="text-danger js-error-lastname"></small>
        </div>
        <div class="mb-3">
          <label for="gender" class="form-label fw-bold">Gender</label>
          <div class="input-group">
            <select name="gender" class="form-select">
              <option value="<?=$row['gender']?>"><?=$row['gender']?></option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
            <span class="input-group-text"><i class="bi bi-gender-ambiguous"></i></span>
          </div>
          <small class="text-danger js-error-gender"></small>
        </div>
        <div class="mb-3">
          <label for="status" class="form-label fw-bold">Status</label>
          <div class="input-group">
            <select name="Status" class="form-select">
              <option value="<?=$row['Status']?>"><?=$row['Status']?></option>
              <option value="Enrolled">Enrolled</option>
              <option value="Graduated">Graduated</option>
            </select>
            <span class="input-group-text"><i class="bi bi-award-fill"></i></span>
          </div>
          <small class="text-danger js-error-status"></small>
        </div>
      </div>
      <div class="col-lg-6"> 
	  <label for="level" class="form-label fw-bold">Level</label>
<div class="input-group">
    <?php
    // Query to retrieve data from the "Level" column
    $sql = "SELECT DISTINCT levels FROM course";

    // Execute the query
    $result = $conn->query($sql);
    ?>
    <select name="level" id="levelSelect" class="form-select">
        <option selected value="<?=$row['Level']?>"><?=$row['Level']?></option>
        <?php
        // Fetch rows from the query result and append the "Level" value to the options
        while ($level = $result->fetch_assoc()) {
            echo '<option value="' . $level['levels'] . '">' . $level['levels'] . '</option>';
        }		
        ?>
    </select>
    <span class="input-group-text"><i class="bi bi-award-fill"></i></span>
</div>
<small class="text-danger js-error-status"></small>


    <div class="col-md-6">
        <label for="course" class="form-label fw-bold">Course</label>
        <select name="course" id="courseSelect" class="form-select form-select mb-3 centered-text fixed-width-select" aria-label=".form-select-lg example">
            <option selected value="<?=$row['Course']?>"><?=$row['Course']?></option>
        </select>
    </div>
	<div class="row mb-3">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">
                <label for="year" class="form-label fw-bold">Year</label>
                <select name="year" id="yearSelect" class="form-select form-select mb-3 smol" aria-label=".form-select-lg example">
                    <option value="<?=$row['Year']?>"><?=$row['Year']?></option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="section" class="form-label fw-bold">Section</label>
                <select name="section" id="sectionSelect" class="form-select form-select mb-3 smol" aria-label=".form-select-lg example">
                    <option value="<?=$row['Section']?>"><?=$row['Section']?></option>
                </select>
            </div>
        </div>
    </div>
</div>




        <div class="mb-3">
          <label for="address" class="form-label fw-bold">Address</label>
          <div class="input-group">
            <input value="<?=$row['address']?>" type="text" class="form-control" name="address" id="address" placeholder="Address">
            <span class="input-group-text"><i class="bi bi-house-fill"></i></span>
          </div>
        </div>
        <div class="mb-3">
          <label for="birthdate" class="form-label fw-bold">Birthdate</label>
          <div class="input-group">
            <input value="<?=$row['birthdate']?>" type="date" class="form-control" name="birthdate" id="birthdate">
            <span class="input-group-text"><i class="bi bi-calendar-date-fill"></i></span>
          </div>
        </div>
        <div class="mb-3">
          <label for="birthplace" class="form-label fw-bold">Birthplace</label>
          <div class="input-group">
            <input value="<?=$row['birthplace']?>" type="text" class="form-control" name="birthplace" id="birthplace" placeholder="Birthplace">
            <span class="input-group-text"><i class="bi bi-geo-alt-fill"></i></span>
          </div>
        </div>
        <div class="mb-3">
          <label for="guardian" class="form-label fw-bold">Guardian</label>
          <div class="input-group">
            <input value="<?=$row['guardian']?>" type="text" class="form-control" name="guardian" id="guardian" placeholder="Guardian">
            <span class="input-group-text"><i class="bi bi-people-fill"></i></span>
          </div>
        </div>
      </div>
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-success">Save</button>
      <a href="student_profile.php?id=<?php echo($id); ?>" class="btn btn-secondary">Back</a>
    </div>

 
</form>


					<div class="progress my-3 d-none">
					  <div class="progress-bar" role="progressbar" style="width: 50%;" >Working... 25%</div>
					</div>
 
		</div>
		

		<div class="col-md-4 ">
		<table class="table2 table border mx-auto mt-5 p-2 shadow-lg">
    <thead>
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
            echo '<div style="display:flex; justify-content:space-between;">';

            echo '<button id="' . $record["name"] . '" class="btn btn-primary upload-btn" data-bs-toggle="modal" data-bs-target="#uploadModal' . str_replace(" ", "_", $record["name"]) . $id . '" data-record-name="' . $record["name"] . '"><i class="bi-cloud-arrow-up-fill"></i></button>';

            echo '<form action="delete_record.php" method="POST" class="d-inline">';
            echo '<input name="id" type="hidden" value="' . $id . '">';
            echo '<input name="stud_no" type="hidden" value="' . $stud_no . '">';
            echo '<input name="file" type="hidden" value="' . $record["file"] . '">';
            echo '<input name="filetype" type="hidden" value="' . $record["name"] . '">';
            echo '<button class="btn btn-danger" style="height:fit-content;" type="button" data-bs-toggle="modal" data-bs-target="#confirmationModal' . str_replace(" ", "_", $record["name"]) . $id . '"><i class="bi-trash-fill"></i></button>';
            echo '</form>';

            echo '<form action="download.php" method="POST" class="d-inline">';
            echo '<input name="id" type="hidden" value="' . $id . '">';
            echo '<input name="stud_no" type="hidden" value="' . $stud_no . '">';
            echo '</form>';

            echo '<form action="view_rec.php" method="POST" class="d-inline">';
            echo '<input name="id" type="hidden" value="' . $id . '">';
            echo '<input name="stud_no" type="hidden" value="' . $stud_no . '">';
            echo '<input name="file" type="hidden" value="' . $record["file"] . '">';
            echo '<input name="filetype" type="hidden" value="' . $record["name"] . '">';
            echo '<button class="btn btn-warning" style="height:fit-content;" type="submit"><i class="bi-eye-fill"></i></button>';
            echo '</form>';

            echo '</div>';
            echo '</td>';
            echo '</tr>';

            echo '<div class="modal fade" id="confirmationModal' . str_replace(" ", "_", $record["name"]) . $id . '" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="confirmationModalLabel">Confirm Deletion of Record</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<p  style="color:red;" >Are you sure you want to delete this record: <b>' . $record["name"] . '</b>?</p> ';
            echo '<form action="delete_record.php" method="POST">';
            echo '<input name="id" type="hidden" value="' . $id . '">';
            echo '<input name="stud_no" type="hidden" value="' . $stud_no . '">';
            echo '<input name="filetype" type="hidden" value="' . $record["name"] . '">';
            echo '<input name="filename" type="hidden" value="' . $record["file"] . '">';
            echo '<div class="form-group">';
            echo '<label for="password"><b>Confirm your Password </b></label>';
            echo '<input type="password" class="form-control" id="password" name="password">';
            echo '</div>';
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>';
            echo '<button type="submit" class="btn btn-primary">Confirm</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            

        }
        ?>
    </tbody>
</table>


</div>
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
              <input type="file" value="<?php echo $formValue; ?>" class="form-control" id="fileInput<?php echo $recordType ?>" name="filename" accept="application/pdf" required>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="filetype" value="<?php echo $recordType ?>">
            <input readonly type="hidden" name="studentId" value="<?php echo $stud_no; ?>">
            <input  hidden="" class="form-control" id="password" name="password" value="<?php echo $_SESSION['password']?>" required>

            <?php if (!empty($formValue)) { ?>
              <div class="form-group">
                <p style="color:red;"><b>You are trying to overwrite an existing student record. </b></p>
                <label for="password"> <b>Please Confirm your Password</b></label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
            <?php } ?>
            
            <br>
            <button style=""name="<?php echo $recordType ?>" class="btn btn-primary">Confirm</button>
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



<script>
	

 
	var myaction  = 
	{
		collect_data: function(e, data_type)
		{
			e.preventDefault();
			e.stopPropagation();

			var inputs = document.querySelectorAll("form input, form select");
			let myform = new FormData();
			myform.append('data_type',data_type);

			for (var i = 0; i < inputs.length; i++) {

				myform.append(inputs[i].name, inputs[i].value);
			}

		

			myaction.send_data(myform);
		},

		send_data: function (form)
		{

			var ajax = new XMLHttpRequest();

			document.querySelector(".progress").classList.remove("d-none");

			//reset the prog bar
			document.querySelector(".progress-bar").style.width = "0%";
			document.querySelector(".progress-bar").innerHTML = "Working... 0%";

			ajax.addEventListener('readystatechange', function(){

				if(ajax.readyState == 4)
				{
					if(ajax.status == 200)
					{
						//all good
						myaction.handle_result(ajax.responseText);
					}else{
						console.log(ajax);
						alert("An error occurred");
					}
				}
			});

			ajax.upload.addEventListener('progress', function(e){

				let percent = Math.round((e.loaded / e.total) * 100);
				document.querySelector(".progress-bar").style.width = percent + "%";
				document.querySelector(".progress-bar").innerHTML = "Working..." + percent + "%";
			});

			ajax.open('POST','ajax.php', true);
			ajax.send(form);
		},

		handle_result: function (result)
		{
			console.log(result);
			
			var obj = JSON.parse(result);
			if(obj.success)
			{
				alert("Profile edited successfully");
				window.location.reload();
			}else{

				//show errors
				let error_inputs = document.querySelectorAll(".js-error");

				//empty all errors
				for (var i = 0; i < error_inputs.length; i++) {
					error_inputs[i].innerHTML = "";
				}

				//display errors
				for(key in obj.errors)
				{
					document.querySelector(".js-error-"+key).innerHTML = obj.errors[key];
				}
			}
		}
	};

		

</script>







<script>

$(document).ready(function() {
  // Add change event listener to the Level select element
  $('#levelSelect').on('change', function() {
    var selectedLevel = $(this).val(); // Get the selected Level
    // Make an asynchronous request to fetch the Course options from the database based on the selected Level
    $.ajax({
      url: 'get-courses.php', // Replace with the URL of the server-side script to fetch Course options
      type: 'POST',
      data: { level: selectedLevel }, // Send the selected Level as data to the server
      success: function(data) {
        $('#courseSelect').html(data); // Update the options in the Course select element
        // Clear the options in the Year and Section dropdowns
        $("#yearSelect").html('');
        $("#sectionSelect").html('');

        // Manually trigger the change event for the course dropdown
        $('#courseSelect').trigger('change');
      }
    });
  });

  // AJAX request to populate Year and Section dropdowns based on selected Course
  $("#courseSelect").on("change", function() {
    var selectedCourse = $(this).val();
    $.ajax({
      url: "populate_section.php", // Replace with the actual URL of your PHP script
      type: "POST",
      data: { course: selectedCourse },
      dataType: "json", // Assuming the response from the server is in JSON format
      success: function(data) {
        // Replace the options in Year dropdown with the retrieved data
        $("#yearSelect").html(data.yearOptions);
        // Replace the options in Section dropdown with the retrieved data
        $("#sectionSelect").html(data.sectionOptions);
      },
      error: function(xhr, status, error) {
        console.error("AJAX Error: " + status + " - " + error);
      }
    });
  });
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>









