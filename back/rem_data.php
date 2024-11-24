<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_entry'])) {
    // Get the database connection details from the POST data
    $host = $_POST['host'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $dbname = $_POST['dbname'];
    $table = $_POST['table'];

    // Establish a new database connection
    $connection = new mysqli($host, $username, $password, $dbname);

    // Check for connection errors
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Initialize an empty array to hold the WHERE conditions
    $whereConditions = [];

    // Loop through all columns and check for provided values
    foreach ($_POST as $key => $value) {
        // Only check fields that correspond to input fields like input_columnName
        if (strpos($key, 'input_') === 0 && !empty($value)) {
            $columnName = substr($key, 6); // Remove "input_" prefix
            $whereConditions[] = "`$columnName` = '" . $connection->real_escape_string($value) . "'";
        }
    }

    // If we have any conditions to match, proceed with the DELETE query
    if (!empty($whereConditions)) {
        $deleteQuery = "DELETE FROM `$table` WHERE " . implode(' AND ', $whereConditions);
        
        // Execute the delete query
        if ($connection->query($deleteQuery)) {
            echo "<p>Entry deleted successfully!</p>";
        } else {
            echo "<p>Error deleting entry: " . $connection->error . "</p>";
        }
    } else {
        echo "<p>Please provide values to identify the row to delete.</p>";
    }

    // Close the database connection
    $connection->close();
}
?>
