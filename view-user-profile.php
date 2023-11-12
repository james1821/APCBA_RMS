<?php 
	require 'validation.php';
	require 'functions.php';
	require 'conn.php';
	session_start();


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Profile</title>
  

	<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/user-profile.css">
	
	
</head>
<body>	

	<?php 
		include('sidebar.php');
		include('navbar.php');
		$str = $_SESSION['Middlename'];
		$initial = substr($str, 0, 1).'.';
		$id = $_SESSION['id']; 
		$User = $_SESSION['firstname'].' '.$initial.' '.$_SESSION['lastname'];
       
	?>
	

	<div class="container">
		
				<table class="table1 ">
					<tr>
						<th><img src="img/school.jpg" alt=""></th>
						<th colspan="2">
							<div class="name-status" >
								<div ><?= $User ?></div>
                            	<div >(<?= $_SESSION['status'] ?>)</div>
							</div>
							
						</th>
					</tr>
					<tr>
						<th><i class="bi bi-envelope"></i> Email</th>
						<td class="centered-text text-center"><?= esc($_SESSION['email']) ?></td>
					</tr>
					<tr>
						<th><i class="bi bi-person-circle"></i> First name</th>
						<td class="centered-text text-center"><?= esc($_SESSION['firstname']) ?></td>
					</tr>
					<tr>
						<th><i class="bi bi-person-circle"></i> Middle name</th>
						<td class="centered-text text-center"><?= esc($_SESSION['Middlename']) ?></td>
					</tr>
					<tr>
						<th><i class="bi bi-person-square"></i> Last name</th>
						<td class="centered-text text-center"><?= esc($_SESSION['lastname']) ?></td>
					</tr>
					<tr>
						<th><i class="bi-gender-ambiguous"></i>Gender</th>
						<td class="centered-text text-center"><?= esc($_SESSION['gender']) ?></td>
					</tr>
					<tr>
						<th><i class="bi bi-book-fill"></i> Status</th>
						<td class="centered-text text-center"><?= esc($_SESSION['status']) ?></td>
					</tr>
					<tr>
						<th><i class="bi bi-house"></i> Address</th>
						<td class="centered-text text-center"><?= esc($_SESSION['address']) ?></td>
					</tr>
					<tr>
						<th><i class="bi bi-phone-fill"></i> Mobile Number</th>
						<td class="centered-text text-center"><?= esc($_SESSION['mobile']) ?></td>
					</tr>
					<tr>
						<th><i class="bi bi-people"></i> Username</th>
						<td class="centered-text text-center"><?= esc($_SESSION['username']) ?></td>
					</tr>
					
                    <tr>
					
						<td colspan="2" >
							
								<button style="width: fit-content;" class="mx-auto m-1 btn-xl btn btn-warning btn-archive" onclick="goTo()" >
								Change Password</button>
					
							<a href="update-user-profile.php" class="d-inline">
								<button style="width: fit-content;" class="mx-auto m-1 btn-xl btn btn-primary">Update Profile</button>
							</a>
						</td>
					</tr>
				</table>

			</div>
	
	<?php include 'script.php' ?>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>

	<script>

		function goTo(){
		
    alert("This page is unavailable for demo accounts - James :)");

		}

		function confirmArchive() {
			document.getElementById("archive_form").submit();
		}

		$(document).ready(function() {
			$('.btn-archive').on('click', function() {
				$("#confirmationModal").modal('show');
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
</body>
</html>
