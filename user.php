<!DOCTYPE html>
<?php 
	require 'validation.php';
	include 'sidebar.php';
	require_once 'conn.php';

	
?>
<html lang = "en">
	<head>
		<title>User Accounts</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/jquery.dataTables.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/style.css" />
	</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
		<div class="container-fluid">
				
			<?php 
			$stat = $_SESSION['status'] ;
				$query = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_id` = '$_SESSION[user]'") or die(mysqli_error());
				$fetch = mysqli_fetch_array($query);
			?>
			<ul class="nav navbar-left">	
				<li class="dropdown">
					<a class="user dropdown-toggle" data-toggle = "dropdown" href = "#">
						
						<?php 
						echo $fetch['status']."_".$fetch['firstname']." ".$fetch['lastname'];
						?>
						<b class="caret"></b>
					</a>
				<ul class="dropdown-menu">
					<li>
						<a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
					</li>
				</ul>
				</li>
			</ul>
		</div>
	</nav>
	
	<div id = "content">
		<br /><br /><br />
		<div class="alert alert-info"><Center><h3>Accounts / Users</h3></Center></div>
		<?php
							if( $stat!= "Head-Admin"){
						?>
							
						<?php
							}else{
							?> 
							<a href="register.php"><button class="btn btn-success" ><span class="glyphicon glyphicon-plus"></span> Add User</button></a>
							<button class="btn btn-warning " data-toggle="modal" data-target="#filter_modal"><span class="glyphicon glyphicon-filter"></span> Filter</button>
							<?php }
						?>
							<a href="view-user-profile.php"><button class="btn btn-primary" ><span class="glyphicon glyphicon-eye"></span> View my Profile</button></a>
						
		
		<br><br>
		<?php
    $filterStatus = isset($_POST['filter_status']) ? $_POST['filter_status'] : '';
?>

    <table id="table" class="table table-bordered">
        <thead>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = mysqli_query($conn, "SELECT * FROM `user` WHERE `status` LIKE '%$filterStatus%'") or die(mysqli_error());
					while($fetch = mysqli_fetch_array($query)){
				?>
				<?php 
					if($fetch['status'] != "Head-Admin" || $_SESSION['status'] == $fetch['status']){
				?>	
					<tr class="del_user<?php echo $fetch['user_id']?>">
						<td><?php echo $fetch['firstname']?></td>
						<td><?php echo $fetch['lastname']?></td>
						
						<td><?php echo $fetch['status']?></td>
					
						<?php
							if( $stat!= "Head-Admin"){
						?>
							<td><center><button style="display:none;" class="btn btn-warning" data-toggle="modal" data-target="#edit_modal<?php echo $fetch['user_id']?>"><span class="glyphicon glyphicon-edit"></span> </button> 
							 <button style="display:none;"class="btn btn-danger btn-delete icon" id="<?php echo $fetch['user_id']?>" type="hidden"><span class="glyphicon glyphicon-trash"></span> </button></center></td>
						<?php
							}else{
								?>	
									<td><center><button class="btn btn-warning icon" data-toggle="modal" data-target="#edit_modal<?php echo $fetch['user_id']?>"><span class="glyphicon glyphicon-edit"></span> </button> 
								 <button class="btn btn-danger btn-delete icon" id="<?php echo $fetch['user_id']?>" type="hidden"><span class="glyphicon glyphicon-trash"></span> </button></center></td>
							<?php }
						?>
					</tr>
					
					<div class="modal fade" id="edit_modal<?php echo $fetch['user_id']?>" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<form method="POST" action="update-role.php">	
									<div class="modal-header">
										<h4 class="modal-title">User Information</h4>
									</div>
									<div class="modal-body">
										<div class="col-md-3"></div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Firstname</label>
												<input type="hidden" name="user_id" value="<?php echo $fetch['user_id']?>"/>
												<input type="text" name="firstname" value="<?php echo $fetch['firstname']?>" readonly="readonly"  class="form-control" required="required"/>
											</div>
											<div class="form-group">
												<label>Middlename</label>
												<input type="text" name="middlename" value="<?php echo $fetch['Middlename']?>" readonly="readonly" class="form-control" required="required"/>
											</div>
											
											<div class="form-group">
												<label>Lastname</label>
												<input type="text" name="lastname" value="<?php echo $fetch['lastname']?>" readonly="readonly" class="form-control" />
											</div>
											<div class="form-group">
												<label>Email</label>
												<input type="text" name="emaile" value="<?php echo $fetch['email']?>" readonly="readonly" class="form-control" />
											</div>
											<div class="form-group">
												<label>Mobile Number</label>
												<input type="text" name="mobile" value="<?php echo $fetch['mobile']?>" readonly="readonly" class="form-control" />
											</div>
											
											<div class="form-group">
												<label>Address</label>
												<input type="text" name="address" value="<?php echo $fetch['address']?>" readonly="readonly" class="form-control" />
											</div>
											<div class="form-group">
												<label>Status</label>
												<?php
													if($_SESSION['status'] != "Head-Admin"){
												?>
													
												<?php
													}else{
												?>
													<select name="status" class="form-control" required="required">
   									 <option value="Head-Admin"<?php if ($fetch['status'] == 'Head-Admin') echo ' selected="selected"'; ?>>Head-Admin</option>
   									 <option value="Assistant-Admin"<?php if ($fetch['status'] == 'Assistant-Admin') echo ' selected="selected"'; ?>>Assistant-Admin</option>
													</select>

												<?php
													}
												?>
											</div>
										</div>
									</div>
									<div style="clear:both;"></div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
										<button name="edit" class="btn btn-warning" ><span class="glyphicon glyphicon-save"></span> Update Role</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					
					
				<?php
					}
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
                <center>
                    <h4 class="text-danger">Are you sure you want to remove this user?</h4>
                    <form id="confirm_form" method="POST" action="delete_user.php">
                        <div class="form-group">
                            <label for="password">Enter your password to confirm:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <input type="hidden" id="user_id" name="user_id">
                    </form>
                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" form="confirm_form">Yes</button>
            </div>
        </div>
    </div>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filter_modal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="filter_form" method="POST" action="">
                    <div class="form-group text-center">
                        <label for="filter_status">Status</label>
                        <select class="form-control text-center filter-input"  id="filter_status" name="filter_status">
                            <option value="">All</option>
                            <option value="Head-Admin">Head-Admin</option>
                            <option value="Assistant-Admin">Assistant Admin</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning" form="filter_form">Apply Filter</button>
            </div>
        </div>
    </div>
</div>


<?php include 'script.php' ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('.btn-delete').on('click', function () {
            var user_id = $(this).attr('id');
            $("#user_id").val(user_id);
            $("#modal_confirm").modal('show');
        });
    });
</script>

</script>	
</body>
</html>