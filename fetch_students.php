<?php

// Retrieve the filters from the request data
$filters = json_decode($_POST['filters'], true);

// Build the SQL query
$sql = "SELECT * FROM student WHERE ";

// Loop through the filters and add them to the query
foreach ($filters as $filterOption => $value) {
  // Check if the filter option is checked (not empty)
  if (!empty($value)) {
    // Add the filter option to the query
    $sql .= "$filterOption = '$value' AND ";
  }
}

// Remove the trailing "AND" from the query
$sql = rtrim($sql, " AND ");

// Execute the SQL query on the database
// Replace 'your_db_host', 'your_db_name', 'your_db_user', 'your_db_password' with your actual database credentials
$connection = mysqli_connect('localhost', 'root', '', 'db_sfms');
if (!$connection) {
  die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($connection, $sql);
if (!$result) {
  die("Query failed: " . mysqli_error($connection));
}

// Fetch the results as an associative array
$students = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Close the database connection
mysqli_close($connection);

// Send the fetched results back as JSON data
echo json_encode($students);

?>
