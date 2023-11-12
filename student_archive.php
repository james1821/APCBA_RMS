<!DOCTYPE html>
<?php 
	require 'validation.php';
	require_once 'conn.php';
	
?>
<html lang = "en">
	<head>
		<title>Student Archive</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
			<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css" />
			<link rel = "stylesheet" type = "text/css" href = "css/style.css" />
			
	</head>
<body>
<?php include 'sidebar.php';
		  include 'navbar.php';
		?>
	<div id = "content">
		
		<div class="alert alert-info"><center><h3> STUDENT ARCHIVE</h3></center></div> 
        
		<div class="table-container">
		<table id = "table" class="table table-bordered">
			<thead>
				<tr>
					<th>Student ID</th>
					<th>Firstname</th>
					<th>Lastname</th>
					<th>Gender</th>
					<th>Course/Year</th>
					
					<th>Action</th>
				</tr>
		

			</thead>
			<tbody>
				<?php
					$query = mysqli_query($conn, "SELECT * FROM `archive`") or die(mysqli_error());
					while($fetch = mysqli_fetch_array($query)){
				?>
					<tr class="del_student<?php echo $fetch['id']?>">
						<td><?php echo $fetch['stud_no']?></td>
						<td><?php echo $fetch['firstname']?></td>
						<td><?php echo $fetch['lastname']?></td>
						<td><?php echo $fetch['gender']?></td>
						<td class="centered-text text-center"><?php echo htmlspecialchars($fetch['Level'] . '-' . $fetch['Course'] . ' ' .  $fetch['Year']. '-' . $fetch['Section']) ?></td>
						<td>
    <div class="d-flex">
        <form action="restore_student.php" method="post" id="restore_form_<?php echo $fetch['id'] ?>" class="restore_form">
            <input type="hidden" name="stud_no" value="<?php echo $fetch['stud_no'] ?>" class="form-control" />
            <input type="hidden" name="id" value="<?php echo $fetch['id'] ?>" class="form-control" />
            <button name="restore" type="button" class="btn btn-primary btn-restore" id="<?php echo $fetch['id'] ?>">
                <span class="glyphicon glyphicon-refresh"></span> 
            </button>
        </form>
        <?php if ($stat == "Head-Admin") { ?>
        <button class="btn btn-danger btn-delete" id="<?php echo $fetch['id'] ?>" type="button">
            <span class="glyphicon glyphicon-trash"></span> 
        </button>
        <?php } ?>
    </div>
</td>

<style>
    .d-flex {
        display: flex;
        align-items: center;
    }
    .d-flex form {
        margin-right: 10px; /* Adjust this value as needed */
    }
</style>






					</tr>
	

				<?php
					}
				?>
			</tbody>
		</table>
		</div>
	</div>

	<div class="modal fade" id="modal_confirm_restore" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">System</h3>
			</div>
			<div class="modal-body">
				<center><h3 class="text-danger">Are you sure you want to restore this Student?</h3></center>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" id="btn_yes_restore">Yes</button>
			</div>
		</div>
	</div>
</div>


	<div class="modal fade" id="modal_confirm" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">System</h3>
				</div>
				<div class="modal-body">
					<center><h4 class="text-danger">All records of the student will also be deleted.</h4></center>
					<center><h3 class="text-danger">Are you sure you want to delete this Student?</h3></center>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-success" id="btn_yes">Yes</button>
				</div>
			</div>
		</div>
	</div>
	
					
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
			url: "perma_del.php",
			data:{
				id: id
			},
			success: function(){
				$("#modal_confirm").modal('hide');
				$(".del_student" + id).empty();
				$(".del_student" + id).html("<td colspan='6'><center class='text-danger'>Deleting...</center></td>");
				setTimeout(function(){
					$(".del_student" + id).fadeOut('slow');
				}, 1000);
			}
		});
	});
});




$(document).ready(function(){
  $('.btn-restore').on('click', function(){
    var id = $(this).attr('id');
    $("#modal_confirm_restore").modal('show');
    $('#btn_yes_restore').attr('name', id);
  });

  $('#btn_yes_restore').on('click', function(){
    var id = $(this).attr('name');
    // Submit the form only if the restore confirmation is clicked
    $('form#restore_form_' + id).submit();
  });
});																		
</script>








</body>
</html>