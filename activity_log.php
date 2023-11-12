  <!DOCTYPE html>
<?php 
	require 'validation.php';
	require_once 'conn.php'
?>
<style>.green-bg {
				background-color: lightgreen;
			}</style>
<html lang = "en">
	<head>
		<title>Activity Log</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/jquery.dataTables.css" />
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.21/jspdf.plugin.autotable.min.js"></script>
		<link rel = "stylesheet" type = "text/css" href = "css/style.css" />
	</head>
<body>
	
<?php include 'navbar.php'?>
	<?php include 'sidebar.php'?>


	<div id = "content">
	
		<center><div class="alert alert-info"><h3>ACTIVITY LOG</h3></div> </center>
		<button class="btn btn-warning" data-toggle="modal" data-target="#filter_modal"><span class="glyphicon glyphicon-filter"></span> Filter</button>
		<div class="table-container">
		<table id = "table" class="table table-bordered">
		
        <thead>
				<tr>
					<th>Date</th>
					<th>User</th>
					<th>Activity</th>
					
				</tr>
			</thead>
			<tbody>
				<?php
				 $query = mysqli_query($conn, "SELECT * FROM `activity_log` ORDER BY `id` DESC") or die(mysqli_error());
					while($fetch = mysqli_fetch_array($query)){
				?>
					<tr>
						<td class="date"><?php echo $fetch['date']?></td>
						<td><?php echo $fetch['user']?></td>
						<td><?php echo $fetch['activity']?></td>
						<td hidden="" class="type"><?php echo $fetch['type']?></td>
					</tr>
	
			</div>
		</div>
	</div>
				<?php
					}
				?>
			</tbody>
		</table>

	</div>
			</div>
		</div>
	</div>

	<?php include 'script.php'?>

</body>
</html>


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

// Fetch gender options from "student" table
$activitySql = "SELECT type FROM activity_log GROUP BY type";
$activityResult = mysqli_query($conn, $activitySql);
$activityOptions = array();
while($activityRow = mysqli_fetch_assoc($activityResult)) {
  $activityOptions[] = $activityRow['type'];
}

?>
<div class="form-group">
  <label>FIlter Type of Activity</label>
  <select id="filterActivity" name="activity" class="form-control">
    <option value="">All Activities</option>
    <?php
      // Generate options dynamically from fetched gender data
      foreach($activityOptions as $activity) {
        echo '<option value="' . $activity . '">' . $activity. '</option>';
      }
    ?>
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
  var filterActivity = $('#filterActivity').val();
  $('#table tbody tr').sort(function(a, b) {
    // Get the date values for comparison
    var dateA = new Date($(a).find('.date').text());
    var dateB = new Date($(b).find('.date').text());

    // Compare the date values in descending order
    if (dateA < dateB) {
      return 1;
    } else if (dateA > dateB) {
      return -1;
    } else {
      return 0;
    }
  }).appendTo('#table tbody').each(function () {
    var rowActivity = $(this).find('.type').text();
  
    if (filterActivity === '' || rowActivity === filterActivity) {
      $(this).show();
    } else {
      $(this).hide();
    }
  });

  $('#filter_modal').modal('hide'); // Close the modal after applying filters
}

</script>
		

