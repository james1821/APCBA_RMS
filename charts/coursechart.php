<?php
$result = mysqli_query($conn, "SELECT DISTINCT levels FROM course");

$dataPoints = array();

while ($row = mysqli_fetch_array($result)) {
    $level = $row['levels'];
    $query = "SELECT * FROM student WHERE Level = '$level'";

    if (isset($_GET['filter'])) {
        $dropdownOption = $_GET['filter'];
        if ($dropdownOption === "Enrolled" || $dropdownOption === "Graduated") {
            $query .= " AND Status = '$dropdownOption'";
        }
    }

    $res = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($res);

    array_push($dataPoints, array("label" => $level, "y" => $rows));
}

// Get the total number of students
$totalStudentsQuery = "SELECT COUNT(*) AS total FROM student";

if (isset($_GET['filter'])) {
    $dropdownOption = $_GET['filter'];
    if ($dropdownOption === "Enrolled" || $dropdownOption === "Graduated") {
        $totalStudentsQuery .= " WHERE Status = '$dropdownOption'";
    }
}

$totalStudentsResult = mysqli_query($conn, $totalStudentsQuery);
$totalStudentsRow = mysqli_fetch_assoc($totalStudentsResult);
$totalStudents = $totalStudentsRow['total'];
?>
<div>
    <label for="filterDropdown">Filter: </label>
    <select id="filterDropdown" name="filter">
        <option value="All Students">All Students</option>
        <option value="Enrolled">Enrolled Students</option>
        <option value="Graduated">Graduate Students</option>
    </select>
</div>

<div id="chartContainers" style=" margin-top: 3rem; height:100%; width: auto;"></div>

<script>
    var chart2;
    var filterDropdown;
    var totalStudents = <?php echo $totalStudents; ?>;

    function handleDropdownChange() {
        var selectedOption = filterDropdown.value;

        if (selectedOption === "All Students") {
            window.location.href = "reports.php?chart=Student";
        } else if (selectedOption === "Enrolled") {
            window.location.href = updateURLParameter(window.location.href, "filter", "Enrolled");
        } else if (selectedOption === "Graduated") {
            window.location.href = updateURLParameter(window.location.href, "filter", "Graduated");
        }
    }

    function updateURLParameter(url, param, paramValue) {
        var urlObject = new URL(url);
        urlObject.searchParams.set(param, paramValue);
        return urlObject.href;
    }

    window.onload = function () {
        filterDropdown = document.getElementById("filterDropdown");
        filterDropdown.addEventListener('change', handleDropdownChange);

        // Set the selected value in the dropdown
        <?php
        if (isset($_GET['filter'])) {
            $selectedOption = $_GET['filter'];
            echo "filterDropdown.value = '" . $selectedOption . "';";
        }
        ?>

        chart2 = new CanvasJS.Chart("chartContainers", {
            animationEnabled: true,
            exportEnabled: true,
            title: {
                text: "Student Status"
            },
            subtitles: [{
                text: <?php
                    if (isset($_GET['filter'])) {
                        $dropdownOption = $_GET['filter'];
                        if ($dropdownOption === "All Students") {
                            echo "'Total Number of Students: ' + $totalStudents";
                        } else {
                            echo "'$dropdownOption: ' + $totalStudents";
                        }
                    } else {
                        echo "'Total Number of Students: ' + $totalStudents";
                    }
                    ?>
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

        chart2.render();
    };
</script>
