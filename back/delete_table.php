<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $host = filter_var($_POST['host'], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $database = filter_var($_POST['database'], FILTER_SANITIZE_STRING);
    $table = filter_var($_POST['tableN'], FILTER_SANITIZE_STRING);

    // Check for required fields
    if (empty($host) || empty($username) || empty($password) || empty($database) || empty($table)) {
        die("Missing required fields.");
    }

    // Connect to MySQL
    $connection = new mysqli($host, $username, $password, $database);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
     
// Delete the table
$table = $connection->real_escape_string($table);
if ($connection->query("DROP TABLE `$table`") === TRUE) {
    echo "Table '$table' deleted successfully.";
} else {
    echo "Error deleting table: " . $connection->error;
}

// Close the connection
$connection->close();

}
?>