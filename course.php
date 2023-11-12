<!DOCTYPE html>
<?php 
	require 'validation.php';
	include ('functions.php');
	require_once 'conn.php'
?>
<html lang = "en">
	<head>
		<title>Courses</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<link rel = "stylesheet" type = "text/css" href = "css/jquery.dataTables.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/style.css" />
	</head>
<body>
	
	<?php include 'sidebar.php';
		  include 'navbar.php';
		?>
	<div id = "content">
	


		<div class="alert alert-info"><center><h3>COURSES OFFERED</h3></center></div> 
		
	
		<button class="btn btn-success" data-toggle="modal" data-target="#form_modal"><span class="glyphicon glyphicon-plus"></span> Add a Course</button>
		<button class="btn btn-warning" data-toggle="modal" data-target="#filter_modal"><span class="glyphicon glyphicon-filter"></span> Filter</button>
		<br /><br />
		
		
		<table id = "table" class="table table-bordered">
			<thead>
				<tr>
					
					
				<th>ID</th>
					<th>Course</th>
					<th>Level</th>
					<th>Years</th>
					<th>Sections</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query = mysqli_query($conn, "SELECT * FROM `course`") or die(mysqli_error());
					
					while($fetch = mysqli_fetch_array($query)){
					
				?> 
					<tr class="del_student<?php echo $fetch['id']?>">
					
						<td><?php echo $fetch['id']?></td>
					
						<td><?php echo $fetch['course']?></td>
						<td><?php echo $fetch['levels']?></td>

						<td><?php echo $fetch['year']?></td>
						<td><?php echo $fetch['section']?></td>
						
						
						<td>
						<button class="btn btn-warning" data-toggle="modal" data-target="#edit_modal<?php echo $fetch['id']?>"><span class="glyphicon glyphicon-edit"></span> </button> 
						<button class="btn btn-danger btn-delete" id="<?php echo $fetch['id']?>" type="button"><span class="glyphicon glyphicon-trash"></span> </button>
					
					</td>
					<div class="modal fade" id="edit_modal<?php echo $fetch['id']?>" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<form method="POST" action="update_course.php">	
					<div class="modal-header">
						<h4 class="modal-title">Update Course</h4>
					</div>
					<div class="modal-body">
						<div class="col-md-3"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Level</label>
								<input type="hidden" name="id" value="<?php echo $fetch['id']?>" class="form-control"/>
								<select name="level" class="form-control" required="required">
    <option value="<?php echo $fetch['levels']?>"><?php echo $fetch['levels']?></option>
    <option value="College">College</option>
    <option value="TECHVOC">TECHVOC</option>
    <option value="Senior High School">Senior High School</option>
	<option value="Junior High School">Junior High School</option>
    <!-- Add more options as needed -->
  </select>
							</div>
							<div class="form-group">
								<label>Course</label>
								<input type="text" name="course" value="<?php echo $fetch['course']?>" class="form-control" required="required"/>
							</div>
							<div class="form-group">
								<label>Years</label>
								<input type="number" name="years" value="<?php echo $fetch['year']?>" class="form-control" required="required"/>
							</div>
							<div class="form-group">
								<label>Sections</label>
								<input type="number" name="sections" value="<?php echo $fetch['section']?>" class="form-control" required="required"/>
							</div>
							
					</div>
					<div style="clear:both;"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
						<button name="update" class="btn btn-warning" ><span class="glyphicon glyphicon-save"></span> Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>

				<?php
					}
				?>
			</tbody>
		</table>
	</div>
	<div class="modal fade" id="modal_confirm" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">System</h3>
				</div>
				<div class="modal-body">
					<center><h3 class="text-danger">Are you sure you want to Delete this Course?</h3></center>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-success " id="btn_yes">Yes</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="form_modal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<form method="POST" action="save_course.php">	
					<div class="modal-header">
						<h4 class="modal-title">Add Course</h4>
					</div>
					<div class="modal-body">
						<div class="col-md-3"></div>
						<div class="col-md-6">
							
						<div class="form-group">
  <label>Level</label>
  <select name="level" class="form-control" required="required">
    <option value="">Select Level</option>
    <option value="College">College</option>
    <option value="TechVoc">TechVoc</option>
    <option value="Senior High School">Senior High School</option>
    <!-- Add more options as needed -->
  </select>
</div>

							<div class="form-group">
								<label>Course</label>
								<input type="text" name="course" class="form-control" required="required"/>
							</div>
							<div class="form-group">
								<label>Year</label>
							
								<input type="number" name="year" class="form-control" required="required" >

							</div>
							<div class="form-group">
								<label>Section</label>
							
								<input type="number" name="section" class="form-control" required="required" >

							</div>
							
							<br />
							
						</div>
					</div>

					<div style="clear:both;"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
						<button name="save" class="btn btn-success" ><span class="glyphicon glyphicon-save"></span> Save</button>
					</div>
				</form>
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
						
						<div class="form-group">
  <label>Filter by Level</label>
  <select id="filterLevel" class="form-control">
    <option value="">All Levels</option>
    <option value="College">College</option>
    <option value="TECHVOC">TECHVOC</option>
    <option value="Senior High School">Senior High School</option>
    <option value="Junior High School">Junior High School</option>
  </select>
</div>


							
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
  var filterLevel = $('#filterLevel').val(); // Get selected level value

  // Perform filtering based on selected values
  // You can customize this logic based on your requirements
  // For example, you can use AJAX to send the filter values to the server and fetch filtered results
  // Then, update the table with the filtered results
  // This is just a basic example
  // Replace 'tableId' with the actual ID of your table element
  $('#table tbody tr').each(function () {
    var rowLevel = $(this).find('td:nth-child(3)').text();

    if (filterLevel === '' || rowLevel === filterLevel) {
      $(this).show();
    } else {
      $(this).hide();
    }
  });

  $('#filter_modal').modal('hide'); // Close the modal after applying filters
}
</script>

	






					
<?php include 'script.php'?>
<script type="text/javascript">
$(document).ready(function(){
	$('.btn-delete').on('click', function(){
		var id = $(this).attr('id');
		$("#modal_confirm").modal('show');
		$('#btn_yes').attr('name', id);
	});
	$('#btn_yes').on('click', function(){
		var id = $(this).attr('name');
		$.ajax({
			type: "POST",
			url: "delete_course.php",
			data:{
				id: id
			},
			success: function(){
				$("#modal_confirm").modal('hide');
				$(".del_student" + id).empty();
				$(".del_student" + id).html("<td colspan='6'><center class='text-warning'>Deleting...</center></td>");
				setTimeout(function(){
					$(".del_student" + id).fadeOut('slow');
				}, 1000);
			}
		});
	});
});
</script>	
</body>
</html>