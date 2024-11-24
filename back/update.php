<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $host = filter_var($_POST['host'], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $database = filter_var($_POST['dbname'], FILTER_SANITIZE_STRING);
    $table = filter_var($_POST['table'], FILTER_SANITIZE_STRING);
    $data = $_POST['data']; 
    $usertxt = $_POST['usertxt'];

    // Check for required fields
    if (empty($host) || empty($username) || empty($password) || empty($database) || empty($table)) {
        die("Missing required fields.");
    }

    // Connect to MySQL
    $connection = new mysqli($host, $username, $password, $database);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    } else {
 
        $sqlC = "UPDATE $table SET $usertxt WHERE $data;";

        // Execute the query
        if ($connection->query($sqlC) === TRUE) {
            
        } else {
            echo "Error updating record: " . $connection->error . "<br><br>";
            die;
        }
    
    }



}
?>

<script>

    // Debugging: Log the current connection details
    console.log('Redirecting with connection details:', {
        host: '<?= $host ?>',
        username: '<?= $username ?>',
        password: '<?= $password ?>',
        dbname: '<?= $database ?>',
        table: '<?= $table ?>'
    });

    // Ensure that the host, username, password, and dbname are available
    if ('<?= $host ?>' && '<?= $username ?>' && '<?= $password ?>' && '<?= $database ?>' && '<?= $table ?>') {
        // Create a form to submit the data
        var form = document.createElement("form");
        form.method = "POST";
        form.action = "iner.php"; // Change this to connection.php if you want to redirect back there

        // Create hidden input fields for connection details
        var hostInput = document.createElement("input");
        hostInput.type = "hidden";
        hostInput.name = "host";
        hostInput.value = '<?= $host ?>';
        form.appendChild(hostInput);

        var usernameInput = document.createElement("input");
        usernameInput.type = "hidden";
        usernameInput.name = "username";
        usernameInput.value = '<?= $username ?>';
        form.appendChild(usernameInput);

        var passwordInput = document.createElement("input");
        passwordInput.type = "hidden";
        passwordInput.name = "password";
        passwordInput.value = '<?= $password ?>';
        form.appendChild(passwordInput);

        var dbInput = document.createElement("input");
        dbInput.type = "hidden";
        dbInput.name = "dbname";
        dbInput.value = '<?= $database ?>';
        form.appendChild(dbInput);

        var tableInput = document.createElement("input");
        tableInput.type = "hidden";
        tableInput.name = "table";
        tableInput.value = '<?= $table ?>';
        form.appendChild(tableInput);

        // Append the form to the body and submit it
        document.body.appendChild(form);

        // Submit the form to send the data back to connection2.php (or connection.php)
        form.submit();
    } else {
        // If any of the required fields are missing, show an alert
        alert('Missing connection details!');
    }    

</script>

</body>
</html>