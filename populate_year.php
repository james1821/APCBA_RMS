<?php
require_once 'conn.php'; // Include your database connection code here
require 'validation.php';
// Get the selected Course from the AJAX request
$selectedCourse = $_POST['course'];

// TODO: Add your database connection code here

// Perform a query to retrieve the year options for the selected Course
$sql = "SELECT year FROM course WHERE course = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $selectedCourse);
$stmt->execute();
$result = $stmt->get_result();

// Get the selected number of years for the selected Course from the database
if ($year = $result->fetch_assoc()) {
    $numyears = $year['year'];
} else {
    $numyears = 0;
}

// Generate the HTML options for year dropdown
$options = "";
for ($i = 1; $i <= $numyears; $i++) {
    $options .= '<option value="' . $i . '">' . $i . '</option>';
}

// Close the prepared statement
$stmt->close();

// Return the generated options as HTML response
echo $options;
?>
