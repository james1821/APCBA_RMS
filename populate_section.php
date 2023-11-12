<?php
require_once 'conn.php';
require 'validation.php';

// Get the selected Course from the AJAX request
$selectedCourse = $_POST['course'];

// TODO: Add your database connection code here

// Perform a query to retrieve the number of years and sections for the selected Course
$sql = "SELECT year, section FROM course WHERE course = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $selectedCourse);
$stmt->execute();
$result = $stmt->get_result();

// Get the selected number of years and sections for the selected Course from the database
if ($course = $result->fetch_assoc()) {
    $numYears = $course['year'];
    $numSections = $course['section'];
} else {
    $numYears = 0;
    $numSections = 0;
}

// Generate the HTML options for year dropdown
$yearOptions = "";
for ($i = 1; $i <= $numYears; $i++) {
    $yearOptions .= '<option value="' . $i . '">' . $i . '</option>';
}

// Generate the HTML options for section dropdown
$sectionOptions = "";
for ($i = 1; $i <= $numSections; $i++) {
    $sectionOptions .= '<option value="' . $i . '">' . $i . '</option>';
}

// Close the prepared statement
$stmt->close();

// Return the generated options as JSON response
$response = [
    'yearOptions' => $yearOptions,
    'sectionOptions' => $sectionOptions
];
echo json_encode($response);
?>
