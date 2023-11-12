<!DOCTYPE html>
<?php 

	require 'validator.php';
	require_once 'conn.php';
	
	
?>
<html lang = "en">
	<head>
		<title>Analytics</title>
		<meta charset = "utf-8" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
		
		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
		<link rel = "stylesheet" type = "text/css" href = "Assets/css/analytics.css" />
		<?php include 'navbar.php';?>
	</head>

<body style="background-color:whitesmoke;">

	<div class="container">
	
  <div class="top-buttons">
  
  <button class="btn btn-primary" onclick="toggleChart('Student')">Total Students</button>
    <button class="btn btn-primary" onclick="toggleChart('course')">Course Chart</button>
    <button class="btn btn-primary" onclick="toggleChart('wide')">Record Analytics</button>
  </div>
 
	
      <?php
	 $selectedChart = isset($_GET['chart']) ? $_GET['chart'] : 'wide';
        if ($selectedChart === 'course') {
          include 'charts/course-chart.php';
		 
        }
      ?>
   
    <div class="column" id="wide-analytics" style="display: block;">
      <?php
        if ($selectedChart === 'wide') {
          include 'charts/record-chart.php';
        }
      ?>
    </div>

	<div class="column" id="student" style="display: block;">
      <?php
        if ($selectedChart === 'Student') {
          include 'charts/coursechart.php';
        }
      ?>
    </div>

  </div>
  



<script>
  function toggleChart(chartType) {
    var courseChartDiv = document.getElementById('course-chart');
    var wideChartDiv = document.getElementById('wide-analytics');
	var studentDiv = document.getElementById('student');
    

  
    // Update the URL with the selected chart type
    var url = new URL(window.location.href);
    url.searchParams.set('chart', chartType);
    window.location.href = url.href;
  }
</script>



  

 
 </body>
</html>
<?php 	include 'sidebar.php';

include 'script.php';

?>











