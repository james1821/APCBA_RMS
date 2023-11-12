<!DOCTYPE html>
<?php 

require 'validation.php';
	require_once 'conn.php'
	
?>
<html lang = "en">
	<head>
		<title></title>
		<meta charset = "utf-8" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/style.css" />
	</head>
<body style="position:fixed; background-color:whitesmoke;">
	<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
		<div class="container-fluid">
			
			<?php 
				$query = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_id` = '$_SESSION[user]'") or die(mysqli_error());
				$fetch = mysqli_fetch_array($query);


				
			?>
			<ul class = "nav navbar-left">
				
				<li class = "dropdown">
					<a class = "user dropdown-toggle" data-toggle = "dropdown" href = "#">
					
			
						<?php 
							echo $fetch['status']."_".$fetch['firstname']." ".$fetch['lastname'];
						?>
						<b class = "caret"></b>
					</a>
				<ul class = "dropdown-menu">
					<li>
						<a href = "logout.php"><i class = "glyphicon glyphicon-log-out"></i> Logout</a>
					</li>
				</ul>
				</li>
			</ul>
		</div>
	</nav>
	<?php include 'sidebar.php'?>
	
	<div class="slider">
    <img src="img/home.jpg" alt="Image 1">
	<img src="img/home.jpg" alt="Image 1">
	<img src="img/home.jpg" alt="Image 1">
  </div>

 

<?php include 'script.php'?>	

</body>
</html>            

<script>
	document.addEventListener("DOMContentLoaded", function() {
  var images = document.querySelectorAll(".slider img");
  var currentImageIndex = 0;

  setInterval(function() {
    images[currentImageIndex].classList.remove("active");
    currentImageIndex = (currentImageIndex + 1) % images.length;
    images[currentImageIndex].classList.add("active");
  }, 3000);
});

</script>