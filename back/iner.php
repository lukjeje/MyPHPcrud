<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="iner.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     

</head>
<body>
    
    <div id="box">

    <button onclick="back()" id="back"> <-back </button>


<?php

$host = isset($_POST['host']) ? htmlspecialchars($_POST['host']) : '';
$username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
$password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
$dbname = isset($_POST['dbname']) ? htmlspecialchars($_POST['dbname']) : '';
$table = isset($_POST['table']) ? htmlspecialchars($_POST['table']) : '';


// Establish a new database connection
$connection = new mysqli($host, $username, $password, $dbname);

// Check for connection errors
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 


// Query the table to retrieve its data

$sqlC = "SELECT COLUMN_NAME, DATA_TYPE 
         FROM INFORMATION_SCHEMA.COLUMNS 
         WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$table'
         ORDER BY ORDINAL_POSITION";

$columnsResult = $connection->query($sqlC);

if (!$columnsResult) {
    die("Error fetching column information: " . $connection->error);
}

echo "<h2>Data from $table</h2>";


// Display column names and types
echo "<table border='1'><tr>";

$columns = []; // To store column names for later use

while ($column = $columnsResult->fetch_assoc()) {
    echo "<th>" . htmlspecialchars($column['COLUMN_NAME']) . "<br><small>(" . htmlspecialchars($column['DATA_TYPE']) . ")</small></th>";
    $columns[] = $column['COLUMN_NAME']; // Save column names for ordered data display
}
echo "</tr>";




// Start form


echo "<form method='POST'  id='dataForm'>";


echo "<input type='hidden' name='host' value='" . htmlspecialchars($host) . "'>";
echo "<input type='hidden' name='username' value='" . htmlspecialchars($username) . "'>";
echo "<input type='hidden' name='password' value='" . htmlspecialchars($password) . "'>";
echo "<input type='hidden' name='dbname' value='" . htmlspecialchars($dbname) . "'>";
echo "<input type='hidden' name='table' value='" . htmlspecialchars($table) . "'>";


echo "</form>";


// test end







// Add input fields row
echo "<tr>";
foreach ($columns as $colName) {
    echo "<td><input type='text' name='input_$colName' placeholder='Enter $colName'></td>";
}

echo "</tr>";

echo "<button type='button' name='add_new_entry' onclick='addEntry()' id='addButton'>Add</button>";
echo "<button type='button' name='remove_entry' onclick='removeEntry()' id='remButton'>Remove</button>";





$query = "SELECT * FROM `$table`";
$result = $connection->query($query);

$query2 = "show databases;";
$result2 = $connection->query($query);



if ($result) {


    // Display data if available
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        
        // Fetch and display the table headers
        echo "<tr>";
        while ($field = $result->fetch_field()) {
            echo "<th>" . htmlspecialchars($field->name) . "</th>";
        }
        echo "</tr>";

        // Fetch and display each row of data
        while ($row = $result->fetch_assoc()) {
          //  echo "<tr onclick=\"showRowData('" . htmlspecialchars(json_encode($row)) . "')\" >";
            foreach ($row as $cell) {
                echo "<td onclick=\"sendDataToServer('" . htmlspecialchars(json_encode($row)) . "')\" >" . htmlspecialchars($cell) . "</td>";
            }
            echo "</tr>";
        }
        
        echo "</table>";

    } else {
        echo "No data found in the table.";
        
    }
} else {
    echo "Error executing query: " . $connection->error;
}


// Close the connection
$connection->close();

?>


    </div>






<script>
      
// Function to show an alert with row data
function showRowData(rowData) {
    alert("Row Data: " + rowData);
}



function addEntry() {
        // Create a FormData object with all form fields
        const formData = new FormData(document.getElementById('dataForm'));
        
        // Add the input values for each column to the FormData
        document.querySelectorAll("input[name^='input_']").forEach(input => {
            formData.append(input.name, input.value);
        });

        // Send the data to add_data.php using fetch
        fetch('addent.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text()) // Get the response as plain text
        .then(data => {
            alert(data); // Show the response from add_data.php
            location.reload(); // Optionally reload the page to reflect changes
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while adding data.');
        });
    }



    function removeEntry() {
        // Create a FormData object with the form data
        const formData = new FormData(document.getElementById('dataForm'));
        
        // Add the input values for each column to the FormData
        document.querySelectorAll("input[name^='input_']").forEach(input => {
            formData.append(input.name, input.value);
        });
        
        // Add a flag to indicate the remove action
        formData.append('remove_entry', true);

        // Send the data to remove_data.php using fetch
        fetch('rem_data.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text()) // Get the response as plain text
        .then(data => {
            alert(data); // Show the response from remove_data.php
            location.reload(); // Optionally reload the page to reflect changes
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while removing data.');
        });
    }   

    
   
    


function sendDataToServer(rowData) {

alert("Row Data: " + rowData);

// Define the connection details
var connectionDetails = {
  host: '<?= $host ?>',
  username: '<?= $username ?>',
  password: '<?= $password ?>',
  dbname: '<?= $dbname ?>',
  table: '<?= $table ?>' 
};


  // Create a form element
  const form = document.createElement("form");
  form.method = "POST";
  form.action = "add_data.php";

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


   // Parse rowData (JSON string) and add each value as a hidden input field
   const rowDataObj = JSON.parse(rowData);
    for (const key in rowDataObj) {
        if (rowDataObj.hasOwnProperty(key)) {
            const input = document.createElement("input");
            input.type = "hidden";
            input.name = key;
            input.value = rowDataObj[key];
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
        dbname: '<?= $dbname ?>'
    });

    // Ensure that the host, username, password, and dbname are available
    if ('<?= $host ?>' && '<?= $username ?>' && '<?= $password ?>' && '<?= $dbname ?>') {
        // Create a form to submit the data
        var form = document.createElement("form");
        form.method = "POST";
        form.action = "connection2.php"; // Change this to connection.php if you want to redirect back there

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
        dbInput.value = '<?= $dbname ?>';
        form.appendChild(dbInput);

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