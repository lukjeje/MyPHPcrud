<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="con.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    
    <div id="box">

<?php 

// Get form data
$host = filter_var($_POST['host'], FILTER_SANITIZE_STRING);
$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

if (empty($host) || empty($username) || empty($password)) {
    die("Please fill in all required fields.");
}

$connection = new mysqli($host, $username, $password);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$result = $connection->query("SHOW DATABASES");


if ($result) {
    echo "<h3>Databases:</h3>";
    echo "<div id='top'>" . "<input type='text' id='addtext' placeholder='New database name' />" . "    <button id='addButton'>Add</button>" .  "</div>";
    echo "<div class='database-list'>";
    while ($row = $result->fetch_assoc()) {
        echo "<div class='database-box'>" . "<span class='db-name'>" . htmlspecialchars($row['Database']) . "</span>" . "<div class='button-container'>" . "<button class='btn-use'>Use</button>" . "<button class='btn-remove'>Remove</button>" . "</div>" . "</div>" ."<br>";
    }
    echo "</div>";
} else {
    echo "Error: " . $connection->error;
}

// Close the connection
$connection->close();

?>        

</div>




<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-remove').forEach(button => {
        button.addEventListener('click', function () {
            const dbName = this.closest('.database-box').querySelector('.db-name').textContent; // Select only the db-name span

            if (confirm(`Are you sure you want to delete the database: ${dbName}?`)) {
                $.ajax({
                    url: 'delete_database.php',
                    type: 'POST',
                    data: { database: dbName, host: '<?= $host ?>', username: '<?= $username ?>', password: '<?= $password ?>' },
                    success: function(response) {
                        alert(response);
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Failed to delete database: ' + xhr.responseText);
                    }
                });
            }
        });
    });
});



document.getElementById('addButton').addEventListener('click', function () {
        const newDbName = document.getElementById('addtext').value.trim();

        if (newDbName) {
            $.ajax({
                url: 'add_database.php',
                type: 'POST',
                data: { database: newDbName, host: '<?= $host ?>', username: '<?= $username ?>', password: '<?= $password ?>' },
                success: function(response) {
                    alert(response);
                    location.reload(); // Refresh the list of databases
                },
                error: function(xhr) {
                    alert('Failed to add database: ' + xhr.responseText);
                }
            });
        } else {
            alert('Please enter a database name.');
        }
    });





// Function to submit connection details via POST
function redirectToConnection(dbName) {

// Define the connection details
var connectionDetails = {
  host: '<?= $host ?>',
  username: '<?= $username ?>',
  password: '<?= $password ?>',
  dbname: dbName
};


  // Create a form element
  const form = document.createElement("form");
  form.method = "POST";
  form.action = "connection2.php";

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

// Add event listener to each 'Use' button
document.querySelectorAll('.btn-use').forEach(button => {
  button.addEventListener('click', function () {
    // Capture the database name from the clicked button's parent element
    const dbName = this.closest('.database-box').querySelector('.db-name').textContent;
    redirectToConnection(dbName);  // Pass the captured dbName to the function
  });
});



</script>


</body>
</html>