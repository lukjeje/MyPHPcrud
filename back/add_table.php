<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $host = filter_var($_POST['host'], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $database = filter_var($_POST['database'], FILTER_SANITIZE_STRING);
    $table = filter_var($_POST['table'], FILTER_SANITIZE_STRING);
    $columns = $_POST['colum'];


    if (empty($host) || empty($username) || empty($password) || empty($database) || empty($table) || empty($columns)) {
        die("Missing required fields: Please provide all the necessary inputs.");
    }




    // Connect to the database
    $connection = new mysqli($host, $username, $password, $database);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Check if table and columns are not empty
if (empty($table) || empty($columns)) {
    die("Table name and columns must not be empty.");
}

    // Construct SQL query
    $sql = "CREATE TABLE `$table` (
        id INT AUTO_INCREMENT PRIMARY KEY, 
        $columns
    );";

    echo "$columns";

    // Log the SQL query for debugging purposes
    error_log("SQL Query: $sql");

    // Execute query
    if ($connection->query($sql) === TRUE) {
        echo "Table '$table' created successfully.";
    } else {
        echo "Error creating table: " . $connection->error;
    }

    // Close connection
    $connection->close();
}
?>