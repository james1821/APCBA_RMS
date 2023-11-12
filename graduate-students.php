 <!DOCTYPE html>
<?php 
	require 'validation.php';
	include ('functions.php');
	require_once 'conn.php'
?>
<html lang = "en">
	<head>
		<title>Graduated Student</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/jquery.dataTables.css" />
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.21/jspdf.plugin.autotable.min.js"></script>
	
		<link rel = "stylesheet" type = "text/css" href = "css/style.css" />
	</head>
<body>
 
	<?php include 'sidebar.php';
  include 'navbar.php';
  ?>
	<div id = "content">
	


		<div class="alert alert-info"><center><h3>GRADUATED STUDENTS</h3></center></div> 
		<?php 
	
		
		?>
	
  <a class="btn btn-success" href="add-student.php">
    <span class="bi bi-plus"></span> Add Student
</a>
		<button class="btn btn-warning" data-toggle="modal" data-target="#filter_modal"><span class="glyphicon glyphicon-filter"></span> Filter</button>
		<button class="btn btn-warning" type="button" onclick="resetFilters()">Reset Table</button>
		
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Generate Report
</button>

		<br /><br />
		<!-- Button to trigger the modal -->

		<div class="table-container">
		
		<table id = "table" class="table table-bordered">
			<thead>
				
				<tr>
				<th hidden =""> ID</th>
					<th>Student ID</th>
          <th hidden="">Email</th>
					<th>Firstname</th>
						
					<th>Middlename</th>
					<th>Lastname</th>
					<th hidden="">Gender</th>

          <th>Status</th>
					<th>Course</th>
          <th hidden="">Address</th>
          <th hidden="">Birthdate</th>
          <th hidden="">Birthplace</th>
          <th hidden="">Guardian</th>
					<th hidden="">TOR</th>
					<th hidden="">Form 137</th>
					<th hidden="">Form 138</th>
					<th hidden="">Good Moral</th>
					<th hidden="">Diploma</th>
					<th hidden="">PSA</th>
          <th hidden="">Level</th>
          <th hidden="">Course</th>
          <th hidden="">Year</th>
          <th hidden="">Section</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				
				$query = mysqli_query($conn, "SELECT * FROM `student` where Status ='Graduated'") or die(mysqli_error());

					
					while($fetch = mysqli_fetch_array($query)){
            
					
				?> 
					<tr class="del_student<?php echo $fetch['id']?>">
					<td hidden=""><?php echo $fetch['id']?></td>
					
						<td><?php echo $fetch['stud_no']?></td>
            <td  hidden="" class="email"><?php echo $fetch['email']?></td>
                 		<td><?php echo $fetch['firstname']?></td>
						 <td><?php echo $fetch['MIddlename']?></td>
						<td><?php echo $fetch['lastname']?></td>
						<td  hidden="" class="gender"><?php echo $fetch['gender']?></td>
            <td><?php echo $fetch['Status']?></td>
						<td class="course"><?php echo $fetch['Level'] . '_' . $fetch['Course'] ." ". $fetch['Year']."-". $fetch['Section']?></td>
            <td  hidden="" class="address"><?php echo $fetch['address']?></td>
            <td  hidden="" class="birthdate"><?php echo $fetch['birthdate']?></td>
            <td  hidden="" class="birthplace"><?php echo $fetch['birthplace']?></td>
            <td  hidden="" class="guardian"><?php echo $fetch['guardian']?></td>
						<td class="tor" hidden=""><?php echo $fetch['Tor']?></td>
						<td hidden="" class="Form_137"><?php echo $fetch['Form_137']?></td>
						<td hidden="" class="Form_138"><?php echo $fetch['Form_138']?></td>
						<td hidden="" class="Good_Moral"><?php echo $fetch['Good_Moral']?></td>
						<td hidden="" class="diploma"><?php echo $fetch['Diploma']?></td>
						<td hidden="" class="psa"><?php echo $fetch['Psa']?></td>
            <td hidden="" class="Level"><?php echo $fetch['Level']?></td>
            <td hidden="" class="Course"><?php echo $fetch['Course']?></td>
            <td hidden="" class="Year"><?php echo $fetch['Year']?></td>
            <td hidden="" class="Section"><?php echo $fetch['Section']?></td>
          
						
						
						<td>
					
						<center>
		
					
						<br>
            <a href="student_profile.php?id=<?php echo $fetch['id']?>" target="_blank">
  <button style="width: 120px;" class="btn btn-success">
    <span class="glyphicon glyphicon-file"></span> View Profile
  </button>
</a>

					</td>
			
				<?php
					}
				?>
			</tbody>
		</table>
    </div>
	</div>
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select report format</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="report-format">Report Format:</label>
          <select class="form-control" id="report-format" onchange="showMessage()">
          <option value="pdf" selected>Download PDF</option>
            <option value="csv">Download CSV</option>
          </select>
        </div>
        
      
        <input id="headerInput" class="form-control form-control-lg" name="header"  placeholder="Enter a header for your PDF report" type="text"><br>
        <p id="message-pdf" style="display: block;">This PDF report contains the following information;<br>
			* Student Number <br>
			* Firstname <br>
			* Middlename <br>
			* Lastname <br>
			* Level/Course/Year/Section <br>

	</p>
        <p id="message-csv" style="display: none; ">This CSV report contains the following information;<br>
			* Student Number <br>
			* Firstname <br>
			* Middlename <br>
			* Lastname <br>
			* Email <br>
			* Level/Course/Year/Section <br>
			* Address <br>
			* Gender <br>
			* Birthplace <br>
			* Birthdate <br>
			* Guardian/Parent <br>
    	* Records <br></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="generateReport()">Generate Report</button>
      </div>
    </div>
  </div>
</div>







			<div class="modal fade" id="filter_modal" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						
							<div class="modal-header">
						<h4 class="modal-title">Filter Results</h4>
					</div>
					<div class="modal-body">
						<div class="col-md-3"></div>
						<div class="col-md-6">
						
<!-- PHP code to fetch gender options from "student" table -->

<?php
 // Assuming you have a database connection established


$levelSql = "SELECT DISTINCT levels FROM course;";
$levelResult = mysqli_query($conn, $levelSql);
$levelOptions = array();
while($levelRow = mysqli_fetch_assoc($levelResult)) {
  $levelOptions[] = $levelRow['levels'];
}


// Fetch course options from "student" table
$courseSql = "SELECT course FROM course GROUP BY course";
$courseResult = mysqli_query($conn, $courseSql);
$courseOptions = array();
while($courseRow = mysqli_fetch_assoc($courseResult)) {
  $courseOptions[] = $courseRow['course'];
}
?>

<div class="form-group">
  <label>Level</label>
  <select id="filterLevel" name="level" class="form-control">
    <option value="">Select Level</option>
    <?php
      foreach ($levelOptions as $level) {
        echo '<option value="' . $level . '">' . $level . '</option>';
      }
    ?>
  </select>
</div>

<div class="form-group">
  <label>Course/Year</label>
  <select id="filterCourse" name="course" class="form-control">
    <option value=""></option>
  </select>
</div>


<script>
function resetFilters() {
  // Reset filter options
  $('input[name="filterOption"]').prop('checked', true);

  // Reset strict filtering toggle
  $('#strictFilteringToggle').prop('checked', false);

  // Reset selected gender
  $('#genderSelect').val('');

  // Reset selected course
  $('#courseSelect').val('');

  // Show all table rows
  $('#table tbody tr').show();

  // Clear local storage
  localStorage.clear();
}

</script>
<script>
  var filterCheckbox = document.getElementById('filterCheckbox'); // Select the checkbox element
  var hiddenText = document.getElementById('hiddenText'); // Select the hidden text element
  var messageParagraph = document.getElementById('message'); // Select the message paragraph element
  
  // Add event listener to the checkbox
 
</script>

<br>
<input type="hidden" name="checker" checked value="Activate" id="filterCheckbox"> 



<!-- HTML code for the message paragraph -->
<p id="message"></p>
<!-- HTML code for filter options using checkbox  -->
<!-- Assume your table has an id 'studentTable' and each row has class 'studentRow' -->

<div class="form-groups">
  <label style="font-size:20px;"class="filterlabel">Deselect Missing Records</label><br>
 <br>
 <label>
    <input type="checkbox" name="filterOption" value="Form_138" checked> Form 138
  </label><br>
  <label>
    <input type="checkbox" name="filterOption" value="Form_137" checked> Form 137
  </label><br>
  <label>
    <input type="checkbox" name="filterOption" value="tor" checked> Transcript of Records (TOR)
  </label><br>
  <label>
    <input type="checkbox" name="filterOption" value="Good_Moral" checked> Good Moral
  </label><br>
  <label>
    <input type="checkbox" name="filterOption" value="diploma" checked> Diploma
  </label><br>
  <label>
    <input type="checkbox" name="filterOption" value="psa" checked> PSA
  </label><br>
</div>




<button class="btn "type="button" onclick="resetCheckboxes()">Clear</button>
<button class="btn "type="button" onclick="selectAllCheckboxes()">Select All</button>


<script>
  
function resetCheckboxes() {
  var checkboxes = document.getElementsByName('filterOption');
  for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].checked = false;
  }
}

function selectAllCheckboxes() {
  var checkboxes = document.getElementsByName('filterOption');
  for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].checked = true;
  }
}

</script>

							
					</div>
					<div style="clear:both;"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
						<button onclick="applyFilters()" name="filter" class="btn btn-success" ><span class="glyphicon glyphicon-save"></span> Filter</button>
					</div>
					
				
			</div>
		</div>
	</div>


	<script>
   
 function applyFilters() {
  var filterOptions = [];
  $('input[name="filterOption"]').each(function() {
  if (!$(this).is(':checked')) {
    filterOptions.push($(this).val());
  }
});


  var strictFilteringEnabled = $('#filterCheckbox').is(':checked');
  var selectedLevel = $('#filterLevel').val();
  var selectedCourse = $('#filterCourse').val();


  // Apply the filters
  filterResults(filterOptions, strictFilteringEnabled, selectedLevel, selectedCourse);

  $('#filter_modal').modal('hide');
 
}


// Function to retrieve filter options from local storage and apply the filters
function retrieveAndApplyFilters() {
  var filterOptions = JSON.parse(localStorage.getItem('filterOptions'));
  var strictFilteringEnabled = localStorage.getItem('strictFilteringEnabled');
  var selectedLevel = localStorage.getItem('selectedLevel');
  var selectedCourse = localStorage.getItem('selectedCourse');

  // Apply the filters
  filterResults(filterOptions, strictFilteringEnabled, selectedLevel, selectedCourse);

  
}


function filterResults(filterOptions, strictFilteringEnabled, selectedLevel, selectedCourse) {
  $('#table tbody tr').each(function() {
    var hasTOR = $(this).find('.tor').text() !== '';
    var hasForm_137 = $(this).find('.Form_137').text() !== '';
    var hasForm_138 = $(this).find('.Form_138').text() !== '';
    var hasGood_Moral = $(this).find('.Good_Moral').text() !== '';
    var hasDiploma = $(this).find('.diploma').text() !== '';
    var hasPSA = $(this).find('.psa').text() !== '';
    var rowGender = $(this).find('.Level').text();
    var rowCourse = $(this).find('.Course').text();

    var shouldShow = true;

    if (strictFilteringEnabled) {
      filterOptions.forEach(function(option) {
        if (
          (option === 'tor' && hasTOR) ||
          (option === 'Form_137' && hasForm_137) ||
          (option === 'Form_138' && hasForm_138) ||
          (option === 'Good_Moral' && hasGood_Moral) ||
          (option === 'diploma' && hasDiploma) ||
          (option === 'psa' && hasPSA)
        ) {
          shouldShow = false;
          return;
        }
      });
      shouldShow = shouldShow && filterOptions.length > 0;
    } else {
      if (filterOptions.includes('tor') && hasTOR) {
        shouldShow = false;
      }
      if (filterOptions.includes('Form_137') && hasForm_137) {
        shouldShow = false;
      }
      if (filterOptions.includes('Form_138') && hasForm_138) {
        shouldShow = false;
      }
      if (filterOptions.includes('Good_Moral') && hasGood_Moral) {
        shouldShow = false;
      }
      if (filterOptions.includes('diploma') && hasDiploma) {
        shouldShow = false;
      }
      if (filterOptions.includes('psa') && hasPSA) {
        shouldShow = false;
      }
    }

    if (
      shouldShow &&
      (!selectedLevel || rowGender === selectedLevel) &&
      (!selectedCourse || rowCourse === selectedCourse)
    ) {
      $(this).show();
    } else {
      $(this).hide();
    }
  });
}


// Call the function to retrieve and apply filters on page load
retrieveAndApplyFilters();




</script> 






<script>

function downloadCSV() {
  var filterLevel = $('#filterLevel').val();
  var filterCourse = $('#filterCourse').val();
  var filterOptions = [];
  $('input[name="filterOption"]:checked').each(function() {
    filterOptions.push($(this).val());
  });
  var table = document.getElementById("table");
  var csv = "";

  for (var i = 0; i < table.rows.length; i++) {
    if (table.rows[i].style.display !== "none") {
      for (var j = 0; j < table.rows[i].cells.length; j++) {
        if (j !== table.rows[i].cells.length - 1) {
          if (j >= 13 && j <= 19 && i > 0) {
            if (table.rows[i].cells[j].innerText.trim() !== "") {
              csv += "\"Yes\",";
            } else {
              csv += "\"-\",";
            }
          } else if (j === 0) {
            csv += "\"" + table.rows[i].cells[j].innerText.replace(/"/g, '""') + "\",";
          } else {
            csv += "\"" + table.rows[i].cells[j].innerText.replace(/"/g, '""') + "\",";
          }
        }
      }
      csv += "\n";
    }
  }

  var blob = new Blob([csv], { type: "text/csv;charset=utf-8;" });

  var now = new Date();
  var dateStr = now.toISOString().slice(0, 10);
  var timeStr = now.toTimeString().slice(0, 5);

  var filename = "CSV_Report_";
  
  filename += dateStr + "_" + timeStr + ".csv";

  var link = document.createElement("a");
  link.href = URL.createObjectURL(blob);
  link.download = filename;
  link.style.display = "none";

  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}



</script>




<script>

  function generateReport() {
    var headerTitle = document.getElementById("headerInput").value;
    var headerTitle = headerInput.value;
    var reportType = document.getElementById("report-format").value;

    if (reportType === "pdf") {
      downloadPDF(headerTitle);
    } else if (reportType === "csv") {
      downloadCSV();
    }

    // Close the modal
    var modal = document.getElementById("exampleModal");
    var modalInstance = bootstrap.Modal.getInstance(modal);
    modalInstance.hide();
  }




 function downloadPDF(headerTitle) {
  var doc = new jsPDF();
  var table = document.getElementById("table");
  var filterOptions = document.getElementsByName("filterOption");
  var uncheckedOptions = [];

  // Get the unchecked checkboxes
  

  // Set the header title
 
  var subtitle =""
  
  
  // Add the header to the PDF
  doc.setFontSize(20);
  doc.text(headerTitle, 20, 15);
  doc.setFontSize(20);
  doc.text(subtitle, 20, 25);
  
  // Add the date to the PDF
  doc.setFontSize(12);
  doc.text("Date: " + new Date().toLocaleDateString(), 20, 35);
  
   // Define the columns to include in the PDF
var columns = ["StudentID", "Firstname", "Middlename", "Lastname", "Status", "Course/Year/Section"];

// Define the rows to include in the PDF
var data = [];
for (var i = 1; i < table.rows.length; i++) {
  // Check if the row is visible
  if (table.rows[i].style.display !== "none") {
    // Get the data for the specified columns
    var rowData = [];
    for (var j = 1; j < table.rows[i].cells.length - 1; j++) {
      if (j === 1) { // Student ID
        rowData.push(table.rows[i].cells[j].innerText.trim());
      } else if (j >= 3 && j <= 5) { // First Name, Middle Name, Last Name
        rowData.push(table.rows[i].cells[j].innerText.trim());
      } else if (j === 7) { // Status
        rowData.push(table.rows[i].cells[j].innerText.trim());
      } else if (j === 8) { // Course/Year/Section
        rowData.push(table.rows[i].cells[j].innerText.trim());
      }
    }
    data.push(rowData);
  }
}


  // Add the table to the PDF
  doc.autoTable({
    head: [columns],
    body: data,
    startY: 50,
    styles: {
      overflow: 'linebreak',
      columnWidth: 'auto',
      cellPadding: 5,
      fontSize: 10,
    },
  });
  var now = new Date();
  var dateStr = now.toISOString().slice(0, 10);
  var timeStr = now.toTimeString().slice(0, 5);

// Save the PDF
doc.save(dateStr + '-' + timeStr + "-students.pdf");
}


function showMessage() {
  var reportFormat = document.getElementById("report-format").value;
  if (reportFormat === "pdf") {
    document.getElementById("headerInput").style.display = "block";
    document.getElementById("message-pdf").style.display = "block";
    document.getElementById("message-csv").style.display = "none";
  } else if (reportFormat === "csv") {
    document.getElementById("message-pdf").style.display = "none";
    document.getElementById("message-csv").style.display = "block";
    document.getElementById("headerInput").style.display = "none";
  }
}
</script>


					
<?php include 'script.php'?>
<script type="text/javascript">
$(document).ready(function(){
	$('.btn-delete').on('click', function(){
		var id = $(this).attr('id');
		$("#modal_confirm").modal('show');
		$('#btn_yes').attr('name', id);
	});filterCourse
	$('#btn_yes').on('click', function(){
		var id = $(this).attr('name');
		$.ajax({
			type: "POST",
			url: "delete_student.php",
			data:{
				id: id
			},
			success: function(){
				$("#modal_confirm").modal('hide');
				$(".del_student" + id).empty();
				$(".del_student" + id).html("<td colspan='6'><center class='text-warning'>Archiving...</center></td>");
				setTimeout(function(){
					$(".del_student" + id).fadeOut('slow');
				}, 1000);
			}
		});
	});
});
</script>	
<script>
$(document).ready(function() {
  // Retrieve the saved level and course from localStorage
  var savedLevel = null; // Set the default level value
  var savedCourse = null; // Set the default course value

  // Set the selected level value
  $('#filterLevel').val(savedLevel);

  // Fetch course options based on the selected level
  $.ajax({
    url: 'get-courses.php',
    type: 'POST',
    data: { level: savedLevel },
    success: function(data) {
      $('#filterCourse').html(data);

      // Set the selected course value
      $('#filterCourse').val(savedCourse);

      // Apply the filter
      applyFilter(savedLevel, savedCourse);
    }
  });

  // Handle change event of "Level" dropdown
  $('#filterLevel').on('change', function() {
    var selectedLevel = $(this).val();

    // Send AJAX request to fetch course options based on the selected level
    $.ajax({
      url: 'get-courses.php',
      type: 'POST',
      data: { level: selectedLevel },
      success: function(data) {
        $('#filterCourse').html(data);

        // Apply the filter
        applyFilter(selectedLevel, $('#filterCourse').val());
      }
    });
  });

  // Handle change event of "Course" dropdown
  $('#filterCourse').on('change', function() {
    var selectedCourse = $(this).val();

    // Apply the filter
    applyFilter($('#filterLevel').val(), selectedCourse);
  });

  // Function to apply the filter
  function applyFilter(level, course) {
    // Perform the filtering operation based on the selected level and course
    // ...
    // Your filtering logic goes here
    // ...
  }

  // Trigger the change event of "Level" dropdown on page load
  $('#filterLevel').trigger('change');
});
</script>








</body>
</html>