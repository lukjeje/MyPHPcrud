<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $host = filter_var($_POST['host'], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $database = filter_var($_POST['database'], FILTER_SANITIZE_STRING);

    // Check for required fields
    if (empty($host) || empty($username) || empty($password) || empty($database)) {
        die("Missing required fields.");
    }

    // Connect to MySQL
    $connection = new mysqli($host, $username, $password);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Delete the database
    if ($connection->query("DROP DATABASE `" . $connection->real_escape_string($database) . "`") === TRUE) {
        echo "Database '$database' deleted successfully.";
    } else {
        echo "Error deleting database: " . $connection->error;
    }

    // Close connection
    $connection->close();
}
?>