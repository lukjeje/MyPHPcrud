<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="iner.css">
</head>
<body>

<div id="box">

<button onclick="back()" id="back"> <-back </button>



<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $host = filter_var($_POST['host'], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $database = filter_var($_POST['dbname'], FILTER_SANITIZE_STRING);
    $table = filter_var($_POST['table'], FILTER_SANITIZE_STRING);
    $rowString = "";

    // Check for required fields
    if (empty($host) || empty($username) || empty($password) || empty($database) || empty($table)) {
        die("Missing required fields.");
    }

    // Connect to MySQL
    $connection = new mysqli($host, $username, $password, $database);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    
// Query the table to retrieve its data

$sqlC = "SELECT COLUMN_NAME, DATA_TYPE 
         FROM INFORMATION_SCHEMA.COLUMNS 
         WHERE TABLE_SCHEMA = '$database' AND TABLE_NAME = '$table'
         ORDER BY ORDINAL_POSITION";

$columnsResult = $connection->query($sqlC);


if (!$columnsResult) {
    die("Error fetching column information: " . $connection->error);
}


// Display column names and types
echo "<table border='1'><tr>";

echo "<button type='button' onclick='send()'  id='addButton'>update</button>";


echo "<form id='dataForm'><table border='1'><tr>";


$columns = []; // To store column names for later use

while ($column = $columnsResult->fetch_assoc()) {
    echo "<th>" . htmlspecialchars($column['COLUMN_NAME']) . "<br><small>(" . htmlspecialchars($column['DATA_TYPE']) . ")</small></th>";
    $columns[] = $column['COLUMN_NAME']; // Save column names for ordered data display
}
echo "</tr>";



// Add input fields row
echo "<tr>";
foreach ($columns as $colName) {
    echo "<td><input type='text' id='test' name='$colName' placeholder='Enter $colName'></td>";
}

echo "</tr>";



    // Check if there is any data in $_POST
    // Define fields to exclude (e.g., connection details)
    $excludedFields = ['host', 'username', 'password', 'dbname', 'table'];

    // Filter $_POST to exclude specific keys
    $rowData = array_filter($_POST, function ($key) use ($excludedFields) {
        return !in_array($key, $excludedFields);
    }, ARRAY_FILTER_USE_KEY);

    // Check if rowData has data
    if (!empty($rowData)) {
        echo "<table border='1'>";
        echo "<tr><th>Key</th><th>Value</th></tr>";

        global $rowString;

        foreach ($rowData as $key => $value) {
            // Sanitize the output
            $sanitizedKey = htmlspecialchars($key);
            $sanitizedValue = htmlspecialchars($value);

             // Check if the value is a string and enclose it in single quotes
             if (is_numeric($value)) {
                $sanitizedValue = $sanitizedValue; // No quotes for numbers
            } else {
                $sanitizedValue = "'{$sanitizedValue}'"; // Add quotes for strings
            }
                    
            // Append the key-value pair to the string
            $rowString .= "{$sanitizedKey} = {$sanitizedValue} AND ";

            echo "<tr><td>{$sanitizedKey}</td><td>{$sanitizedValue}</td></tr>";
        }
        $rowString = rtrim($rowString, "AND "); 




        echo "</table>";
    }


}
?>

</div>


<script>

function send() {

    const formData = new FormData(document.getElementById('dataForm'));

    // Use FormData and display its values in an alert
    const formDataEntries = [];
    formData.forEach((value, key) => {
        // Check if the value is a string and enclose it in single quotes
        if (isNaN(value)) {  // If value is a string, wrap it in single quotes
            value = `'${value}'`;
        }
        formDataEntries.push(`${key} = ${value}`);
    });

    // Show the collected data in an alert
    alert(formDataEntries.join("\n"));


var connectionDetails = {
  host: '<?= $host ?>',
  username: '<?= $username ?>',
  password: '<?= $password ?>',
  dbname: '<?= $database ?>',
  table: '<?= $table ?>',
  data: "<?= $rowString ?>",
  usertxt: formDataEntries
};



  // Create a form element
  const form = document.createElement("form");
  form.method = "POST";
  form.action = "update.php";

  // Add each connection detail as a hidden input field
  for (const key in connectionDetails) {
    if (connectionDetails.hasOwnProperty(key)) {
      const input = document.createElement("input");
      input.type = "hidden";
      input.name = key;
      input.value = connectionDetails[key];
      form.appendChild(input);
    }
  }

  // Append the form to the body and submit it
  document.body.appendChild(form);
  form.submit();

}




function back() {
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
}


</script>



</body>
</html>