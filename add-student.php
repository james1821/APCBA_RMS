<?php 
	require 'validation.php';
	require 'functions.php';
	require_once 'conn.php';
	session_start();
include('sidebar.php');
$title="ADD NEW STUDENT";
include('navbar.php');

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Student </title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="assets/css/add.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel = "stylesheet" type = "text/css" href = "css/style.css" />
	
</head>
<body>




<div class="container ">
  <div class="row">
    <div class="tab col-md-7  border  mx-auto mt-5 p-2 shadow-lg " >
   
	<form method="post" onsubmit="myaction.collect_data(event, 'student-add')">
 
    
    <div class="row justify-content-center">
      <div class="col-lg-5">
        <div class="input-group">
        <div class="mb-3">
		<input value="" type="hidden" class="form-control" name="id" id="id" placeholder="id" >
		<label for="stud_no" class="form-label fw-bold">Student Number</label>
		<input  value="" type="number" class="form-control" name="stud_no" id="stud_no" placeholder="Student Number" required>
    </div>
         
          <div class="input-group">
          <label for="email" class="form-label fw-bold">Email</label> <br>
            <input value="" type="text" class="form-control" name="email" id="email" placeholder="Email" required>
            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
          </div>
          <small class="text-danger js-error-email"></small>
        </div>
        <div class="mb-3">
          <label for="firstname" class="form-label fw-bold">First Name</label>
          <div class="input-group">
            <input value="" type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" required>
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
          </div>
          <small class="text-danger js-error-firstname"></small>
        </div>
        <div class="mb-3">
          <label for="middlename" class="form-label fw-bold">Middle Name</label>
          <div class="input-group">
            <input value="" type="text" class="form-control" name="MIddlename" id="MIddlename" placeholder="Middle Name" required>
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
          </div>
          <small class="text-danger js-error-middlename"></small>
        </div>
        <div class="mb-3">
          <label for="lastname" class="form-label fw-bold">Last Name</label>
          <div class="input-group">
            <input value="" type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" required>
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
          </div>
          <small class="text-danger js-error-lastname"></small>
        </div>
        <div class="mb-3">
          <label for="gender" class="form-label fw-bold">Gender</label>
          <div class="input-group">
            <select name="gender" class="form-select" required>
              <option value="">->Select Gender<-</option>
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
            <select name="Status" class="form-select" required>
              <option value="">Select Status</option>
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
        <option selected value="">Select Level</option>
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
        <select required name="course" id="courseSelect" class="form-select form-select mb-3 centered-text fixed-width-select" aria-label=".form-select-lg example">
            <option selected value="">Select Course</option>
        </select>
    </div>
	<div class="row mb-3">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">
                <label for="year" class="form-label fw-bold">Year</label>
                <select required name="year" id="yearSelect" class="form-select form-select mb-3 smol" aria-label=".form-select-lg example">
                    <option value=""></option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="section" class="form-label fw-bold">Section</label>
                <select required name="section" id="sectionSelect" class="form-select form-select mb-3 smol" aria-label=".form-select-lg example">
                    <option value=""></option>
                </select>
            </div>
        </div>
    </div>
</div>




        <div class="mb-3">
          <label for="address" class="form-label fw-bold">Address</label>
          <div class="input-group">
            <input value="" type="text" class="form-control" name="address" id="address" placeholder="Address" required>
            <span class="input-group-text"><i class="bi bi-house-fill"></i></span>
          </div>
        </div>
        <div class="mb-3">
          <label for="birthdate" class="form-label fw-bold">Birthdate</label>
          <div class="input-group">
            <input value="" type="date" class="form-control" name="birthdate" id="birthdate">
            <span class="input-group-text"><i class="bi bi-calendar-date-fill"></i></span>
          </div>
        </div>
        <div class="mb-3">
          <label for="birthplace" class="form-label fw-bold">Birthplace</label>
          <div class="input-group">
            <input value="" type="text" class="form-control" name="birthplace" id="birthplace" placeholder="Birthplace" required>
            <span class="input-group-text"><i class="bi bi-geo-alt-fill"></i></span>
          </div>
        </div>
        <div class="mb-3">
          <label for="guardian" class="form-label fw-bold">Guardian</label>
          <div class="input-group">
            <input value="" type="text" class="form-control" name="guardian" id="guardian" placeholder="Guardian" required> 
            <span class="input-group-text"><i class="bi bi-people-fill"></i></span>
          </div>
        </div>
      </div>
    </div>
    <div class="text-center">
      <button type="submit" style="width:8rem;" class="btn btn-success">Next</button>
      
    </div>

 
</form>


					<div class="progress my-3 d-none">
					  <div class="progress-bar" role="progressbar" style="width: 50%;" >Working... 25%</div>
					</div>
 
		</div>
		



	

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

			ajax.open('post','ajax.php', true);
			ajax.send(form);
		},

		handle_result: function (result)
		{
			console.log(result);
			var obj = JSON.parse(result);
		
			if(obj.success)
			{
				alert("Student Added successfully");
				window.location.href = 'student.php';
			}else{

        alert("Failed to add new Student. Student ID already Exists!");
		
				
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









