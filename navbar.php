
<style>
	.topBox{
		top:0;
		height:50px;
		 width:100%; 
		 background:black;  
		 position:sticky; 
		 z-index:1;
		  display:flex; 
		 justify-content:right;
		  align-items:center; 
		padding-right: 1rem;
	}

	@media (max-width: 768px) {
		.topBox{
			width:100%; 
		 justify-content:center;
		
	}
		
	}
</style>
<div class="topBox"  >

<?php 
	require 'validation.php';
				$query = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_id` = '$_SESSION[user]'") or die(mysqli_error());
				$fetch = mysqli_fetch_array($query);


				
			?>	
						<p style="color:white;"><?php 
							echo $fetch['status']."_".$fetch['firstname']." ".$fetch['lastname'];
						?>
						</p>
</div>
