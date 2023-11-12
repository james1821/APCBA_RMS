

<?php
// Include your database connection code here

// Retrieve distinct courses from the database
$resultcourse = mysqli_query($conn, "SELECT DISTINCT course FROM course");

// Store the courses in an array
$courses = array();
while ($row = mysqli_fetch_array($resultcourse)) {
    $courses[] = $row['course'];
}

// Check if a course is selected from the dropdown
if (isset($_GET['selected_course']) && $_GET['selected_course'] !== 'all') {
    $selectedCourse = $_GET['selected_course'];

    // Update the query to include the selected course
    $query = "SELECT * FROM student WHERE course = '$selectedCourse' AND Status <> 'Graduated'";
} else {
    $selectedCourse = 'All'; // Default value for the selected course

    // Update the query to fetch all courses
    $query = "SELECT * FROM student WHERE Status <> 'Graduated'";
}

$result = mysqli_query($conn, $query);

$columns = ['Form_137', 'Form_138', 'Psa', 'Good_Moral', 'Diploma', 'Tor'];
$dataPointsWithRecords = [];
$dataPointsWithoutRecords = [];

if (isset($result)) {
    foreach ($columns as $column) {
        $studentsWithRecords = 0;
        $studentsWithoutRecords = 0;

        while ($row = mysqli_fetch_array($result)) {
            if (empty($row[$column])) {
                $studentsWithoutRecords++;
            } else {
                $studentsWithRecords++;
            }
        }

        $dataPointsWithRecords[] = [
            "label" => $column,
            "y" => $studentsWithRecords,
            "color" => "green",
            "name" => "Students with Records"
        ];

        $dataPointsWithoutRecords[] = [
            "label" => $column,
            "y" => $studentsWithoutRecords,
            "color" => "maroon",
            "name" => "Students without Records"
        ];

        // Reset the result set pointer to the beginning for the next column
        mysqli_data_seek($result, 0);
    }
}
?>

<script>
window.onload = function () {
    var selectedCourse = "<?php echo $selectedCourse; ?>";
    var subtitleText = selectedCourse === 'all' ? 'All' : selectedCourse;

    var chart = new CanvasJS.Chart("chartContainer", {
        exportEnabled: true,
        animationEnabled: true,
        title: {
            text: "Student Record Analytics"
        },
        subtitles: [{
            text: subtitleText
        }],
        axisX: {
            title: "Records",
            labelFontColor: "black",
            labelFontSize: 12,
            labelPlacement: "betweenColumns"
        },
        axisY: {
            title: "Number of Students",
            includeZero: true,
            titleFontColor: "green",
            lineColor: "green",
            labelFontColor: "green",
            tickColor: "green"
        },
        axisY2: {
            title: "Number of Students",
            includeZero: true,
            titleFontColor: "maroon",
            lineColor: "maroon",
            labelFontColor: "maroon",
            tickColor: "maroon"
        },
        toolTip: {
            shared: true
        },
        data: [{
            indexLabelFontSize: 6,
            type: "column",
            showInLegend: true,
            legendMarkerColor: "Green",
            name: "Students with Records",
            dataPoints: <?php echo json_encode($dataPointsWithRecords, JSON_NUMERIC_CHECK); ?>
        }, {
            type: "column",
            showInLegend: true,
            name: "Students without Records",
            legendMarkerColor: "maroon",
            axisYType: "secondary",
            dataPoints: <?php echo json_encode($dataPointsWithoutRecords, JSON_NUMERIC_CHECK); ?>
        }],
        legend: {
            cursor: "pointer"
        }
    });

    chart.render();

    // Function to handle dropdown change event
    function handleCourseChange() {
        var courseDropdown = document.getElementById("course");
        var selectedCourse = courseDropdown.value;

        // Reload the page with the selected course as a query parameter
        window.location.search = "selected_course=" + encodeURIComponent(selectedCourse);
    }

    // Attach onchange event listener to the course dropdown
    var courseDropdown = document.getElementById("course");
    courseDropdown.onchange = handleCourseChange;
}
</script>

<label for="course">Courses:</label>
<select name="selected_course" id="course">
    <option value="all"<?php if ($selectedCourse === 'all') echo ' selected'; ?>>All</option>
    <?php
    // Populate the dropdown with courses
    foreach ($courses as $course) {
        $selected = ($selectedCourse === $course) ? 'selected' : '';
        echo "<option value='$course' $selected>$course</option>";
    }
    ?>
</select>

<div id="chartContainer" style=" margin-top: 3rem; height:100%; width:100%; "></div>
