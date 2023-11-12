<?php
	session_start();
	
	if(!ISSET($_SESSION['googleCode'])){
		header("location: index.php");
	}
?>