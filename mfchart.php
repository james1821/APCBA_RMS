<?php

	$result = mysqli_query($conn," SELECT * FROM `student` where `gender` = 'Male'");
	$rows = mysqli_num_rows($result);

	$result2 = mysqli_query($conn," SELECT * FROM `student` where `gender` = 'Female'");
	$rows2 = mysqli_num_rows($result2);

	$totalR= $rows + $rows2;

	
 
 $dataPoints = array(
	 array("label"=> "MALE", "y"=> $rows),
	 array("label"=> "FEMALE", "y"=> $rows2)
	
	
 );
	 
 ?>
	
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "Total Number of Students:   <?php echo $totalR?>"
		
	},
	subtitles: [{
		text: ""
	}],
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",
		yValueFormatString: "",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}

</script>

<div id="chartContainers" style=" margin-left: 6rem; margin-top: 3rem; height: 500px; width: 1000px;"></div>

