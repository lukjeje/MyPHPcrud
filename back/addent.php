<?php
// Ensure the script processes POST requests only
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve connection and table details from the POST request
    $host = $_POST['host'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $dbname = $_POST['dbname'] ?? '';
    $table = $_POST['table'] ?? '';

    // Connect to the database
    $connection = new mysqli($host, $username, $password, $dbname);

    // Check the connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Prepare the data for insertion
    $columns = [];
    $values = [];
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'input_') === 0) {
            $columns[] = $connection->real_escape_string(substr($key, 6)); // Remove "input_" prefix
            $values[] = "'" . $connection->real_escape_string($value) . "'";
        }
    }

    // Build and execute the SQL query
    if (!empty($columns) && !empty($values)) {
        $sql = "INSERT INTO `$table` (" . implode(", ", $columns) . ") 
                VALUES (" . implode(", ", $values) . ")";
        if ($connection->query($sql) === TRUE) {
            echo "Data successfully added.";
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
    } else {
        echo "No data provided.";
    }

    // Close the connection
    $connection->close();
} else {
    echo "Invalid request method.";
}
?>

