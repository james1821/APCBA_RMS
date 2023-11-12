<?php
// Fetch all levels from the course table
$query = "SELECT DISTINCT levels FROM course";
$result = $conn->query($query);

// Create an empty array to store the levels
$levels = array();

// Iterate over the query results and populate the levels array
while ($row = $result->fetch_assoc()) {
    $levels[] = $row['levels'];
}

// Fetch the data for all levels and courses from the student table
$query = "SELECT course, COUNT(*) AS count FROM student";
$query .= " WHERE Status <> 'Graduated'";
$query .= " GROUP BY course";
$result = $conn->query($query);
$dataPoints = array();

while ($row = $result->fetch_assoc()) {
    $dataPoints[] = array(
        "label" => $row['course'],
        "y" => $row['count']
    );
}

// Check if a level is selected from the dropdown
if (isset($_GET['selected_level'])) {
    $selectedLevel = $_GET['selected_level'];

    // Update the query to include the selected level
    if ($selectedLevel !== 'all') {
        $query = "SELECT course, COUNT(*) AS count FROM student";
        $query .= " WHERE Level = '$selectedLevel' AND Status <> 'Graduated'";
        $query .= " GROUP BY course";
        
        $result = $conn->query($query);
        $dataPoints = array();

        while ($row = $result->fetch_assoc()) {
            $dataPoints[] = array(
                "label" => $row['course'],
                "y" => $row['count']
            );
        }
    }
}
?>

<script>
window.onload = function () {
    var dataPoints = <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>;

  
    var dropdown = document.getElementById("levels");
    var optionsPopulated = dropdown.options.length > 1; 

    
    if (!optionsPopulated) {
        var levels = <?php echo json_encode($levels); ?>;
        for (var i = 0; i < levels.length; i++) {
            var option = document.createElement("option");
            option.text = levels[i];
            dropdown.add(option);
        }
    }

    
    function handleDropdownChange() {
        
        var selectedLevel = dropdown.value;

      
        window.location.href = "reports.php?chart=course&selected_level=" + encodeURIComponent(selectedLevel);
    }

    
    dropdown.addEventListener('change', handleDropdownChange);

    
    dropdown.value = "<?php echo isset($selectedLevel) ? $selectedLevel : 'all'; ?>";

    
    var subtitleText = "All Levels";
    if (dropdown.value !== 'all') {
        subtitleText = "" + dropdown.value;
    }

    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        exportEnabled: true,
        theme: "light1",
        title: {
            text: "Student Count by Course"
        },
        subtitles: [{
            text: subtitleText
        }],
        axisY: {
            includeZero: true
        },
        data: [{
            type: "column",
            indexLabelFontColor: "#5A5757",
            indexLabelFontSize: 16,
            indexLabelPlacement: "outside",
            dataPoints: dataPoints
        }]
    });
    chart.render();
};

</script>

<label for="levels">Levels:</label>
<select  name="selected_level" id="levels">
    <option value="all">All</option>
    <?php
   
    foreach ($levels as $level) {
        $selected = isset($selectedLevel) && $selectedLevel === $level ? 'selected' : '';
        echo "<option value='$level' $selected>$level</option>";
    }
    ?>
</select>

<div id="chartContainer" style=" margin-top: 3rem; height:100%; width: 100%;"></div>
