<?php
	require 'validation.php';
// Include your dbconfig.php file for database connection
require_once 'conn.php';

// Fetch the selected Level from the AJAX POST data
$selectedLevel = $_POST['level'];

// Query to retrieve data from the "Course" column based on the selected Level
$sql = "SELECT course FROM course WHERE levels = ?";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind the selected Level as a parameter
$stmt->bind_param("s", $selectedLevel);

// Execute the statement
$stmt->execute();

// Get the result set
$result = $stmt->get_result();
// Check if result contains data
if ($result->num_rows > 0) {
    // Loop through the rows and generate the options for the "Course" dropdown
    while ($course = $result->fetch_assoc()) {
        echo '<option value="' . $course['course'] . '">' . $course['course'] . '</option>';
    }
} else {
    // If no courses found for the selected level, display a default option
    echo '<option value="">No courses found</option>';
}
// Close the statement
$stmt->close();

// Close the database connection
$conn->close();
?>
