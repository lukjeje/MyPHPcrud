<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="conn2.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>



<div id="box1"> 

<h1>MySQL Data Types</h1>

<div id="red">
<h2>Example:</h2>
<p>users / name VARCHAR(255), age INT(11)</p>
<br>
<p>items / name VARCHAR(255), price INT(11)</p>
</div>

<div class="content-section">
            <h2>1. Numeric Data Types</h2>
            <div class="data-type">
                <h3>TINYINT:</h3>
                <p>Small integer (range: -128 to 127 or 0 to 255 for unsigned).</p>
                <p><strong>Example:</strong> TINYINT(3) — Stores small integers.</p>
            </div>
            <div class="data-type">
                <h3>SMALLINT:</h3>
                <p>Small integer (range: -32,768 to 32,767 or 0 to 65,535 for unsigned).</p>
                <p><strong>Example:</strong> SMALLINT(5) — Stores small integer values.</p>
            </div>
            <div class="data-type">
                <h3>MEDIUMINT:</h3>
                <p>Medium-sized integer (range: -8,388,608 to 8,388,607 or 0 to 16,777,215 for unsigned).</p>
                <p><strong>Example:</strong> MEDIUMINT(8) — Useful for larger ranges of integers.</p>
            </div>
            <div class="data-type">
                <h3>INT (INTEGER):</h3>
                <p>Standard integer (range: -2,147,483,648 to 2,147,483,647 or 0 to 4,294,967,295 for unsigned).</p>
                <p><strong>Example:</strong> INT(11) — Common for general integer storage (e.g., ID fields).</p>
            </div>
            <div class="data-type">
                <h3>BIGINT:</h3>
                <p>Large integer (range: -9,223,372,036,854,775,808 to 9,223,372,036,854,775,807 or 0 to 18,446,744,073,709,551,615 for unsigned).</p>
                <p><strong>Example:</strong> BIGINT(20) — For storing very large values (e.g., large transaction numbers).</p>
            </div>
            <div class="data-type">
                <h3>DECIMAL (or NUMERIC):</h3>
                <p>Fixed-point number with exact precision.</p>
                <p><strong>Example:</strong> DECIMAL(10,2) — Stores up to 10 digits, with 2 after the decimal point (e.g., 12345678.90).</p>
            </div>
            <div class="data-type">
                <h3>FLOAT:</h3>
                <p>Single-precision floating-point number (approximate).</p>
                <p><strong>Example:</strong> FLOAT(7,4) — Stores floating-point numbers with 7 digits in total, 4 after the decimal.</p>
            </div>
            <div class="data-type">
                <h3>DOUBLE:</h3>
                <p>Double-precision floating-point number (approximate).</p>
                <p><strong>Example:</strong> DOUBLE(15,5) — Stores more precise floating-point numbers (up to 15 digits, 5 after the decimal).</p>
            </div>
        </div>

        <div class="content-section">
            <h2>2. Date and Time Data Types</h2>
            <div class="data-type">
                <h3>DATE:</h3>
                <p>Stores date values in YYYY-MM-DD format.</p>
                <p><strong>Example:</strong> DATE — Useful for birthdays, hire dates, etc.</p>
            </div>
            <div class="data-type">
                <h3>DATETIME:</h3>
                <p>Stores date and time values in YYYY-MM-DD HH:MM:SS format.</p>
                <p><strong>Example:</strong> DATETIME — Used for storing timestamps (e.g., event creation time).</p>
            </div>
            <div class="data-type">
                <h3>TIMESTAMP:</h3>
                <p>Stores date and time values, auto-updating on row changes.</p>
                <p><strong>Example:</strong> TIMESTAMP DEFAULT CURRENT_TIMESTAMP — Automatically records when the row was created or updated.</p>
            </div>
            <div class="data-type">
                <h3>TIME:</h3>
                <p>Stores time values in HH:MM:SS format.</p>
                <p><strong>Example:</strong> TIME — Useful for storing durations or event start times.</p>
            </div>
            <div class="data-type">
                <h3>YEAR:</h3>
                <p>Stores a year in YYYY format.</p>
                <p><strong>Example:</strong> YEAR — Used for storing years (e.g., for a product's year of manufacture).</p>
            </div>
        </div>

        <div class="content-section">
            <h2>3. String Data Types</h2>
            <div class="data-type">
                <h3>CHAR:</h3>
                <p>Fixed-length string (up to 255 characters).</p>
                <p><strong>Example:</strong> CHAR(10) — Stores strings of exactly 10 characters.</p>
            </div>
            <div class="data-type">
                <h3>VARCHAR:</h3>
                <p>Variable-length string (up to 65,535 characters, depending on row size).</p>
                <p><strong>Example:</strong> VARCHAR(255) — Common for names, emails, and other variable-length text.</p>
            </div>
            <div class="data-type">
                <h3>TEXT:</h3>
                <p>Variable-length text (up to 65,535 characters).</p>
                <p><strong>Example:</strong> TEXT — Stores large blocks of text (e.g., descriptions, comments).</p>
            </div>
            <div class="data-type">
                <h3>TINYTEXT:</h3>
                <p>Smaller variable-length text (up to 255 characters).</p>
                <p><strong>Example:</strong> TINYTEXT — Used for small text entries (e.g., tags, short descriptions).</p>
            </div>
            <div class="data-type">
                <h3>MEDIUMTEXT:</h3>
                <p>Medium-sized variable-length text (up to 16,777,215 characters).</p>
                <p><strong>Example:</strong> MEDIUMTEXT — Suitable for medium-sized content (e.g., articles).</p>
            </div>
            <div class="data-type">
                <h3>LONGBLOB:</h3>
                <p>Large variable-length text (up to 4,294,967,295 characters).</p>
                <p><strong>Example:</strong> LONGTEXT — Used for very large text (e.g., books, long documents).</p>
            </div>
        </div>

        <div class="content-section">
            <h2>4. Binary Data Types</h2>
            <div class="data-type">
                <h3>BINARY:</h3>
                <p>Fixed-length binary data (up to 255 bytes).</p>
                <p><strong>Example:</strong> BINARY(16) — Stores fixed-length binary data (e.g., for UUIDs).</p>
            </div>
            <div class="data-type">
                <h3>VARBINARY:</h3>
                <p>Variable-length binary data (up to 65,535 bytes).</p>
                <p><strong>Example:</strong> VARBINARY(255) — Stores binary data, such as images or files.</p>
            </div>
            <div class="data-type">
                <h3>BLOB:</h3>
                <p>Binary Large Object (up to 65,535 bytes).</p>
                <p><strong>Example:</strong> BLOB — For storing binary data like images, audio, or video.</p>
            </div>
            <div class="data-type">
                <h3>TINYBLOB:</h3>
                <p>Smaller binary data (up to 255 bytes).</p>
                <p><strong>Example:</strong> TINYBLOB — Used for small binary objects (e.g., thumbnail images).</p>
            </div>
            <div class="data-type">
                <h3>MEDIUMBLOB:</h3>
                <p>Medium-sized binary data (up to 16,777,215 bytes).</p>
                <p><strong>Example:</strong> MEDIUMBLOB — Used for medium-sized binary data (e.g., larger images).</p>
            </div>
            <div class="data-type">
                <h3>LONGBLOB:</h3>
                <p>Large binary data (up to 4,294,967,295 bytes).</p>
                <p><strong>Example:</strong> LONGBLOB — For very large binary objects (e.g., full-resolution videos).</p>
            </div>
        </div>

        <div class="content-section">
            <h2>5. JSON Data Type</h2>
            <div class="data-type">
                <h3>JSON:</h3>
                <p>Stores JSON data.</p>
                <p><strong>Example:</strong> JSON — Used to store JSON formatted data (e.g., user preferences or settings).</p>
            </div>
        </div>

        <div class="content-section">
            <h2>6. Enum and Set Data Types</h2>
            <div class="data-type">
                <h3>ENUM:</h3>
                <p>A string with a predefined list of values.</p>
                <p><strong>Example:</strong> ENUM('small', 'medium', 'large') — Used for fixed options, like product sizes.</p>
            </div>
            <div class="data-type">
                <h3>SET:</h3>
                <p>A string object that can store multiple values from a predefined list.</p>
                <p><strong>Example:</strong> SET('red', 'green', 'blue') — Useful for tags, where multiple values can be selected (e.g., user interests).</p>
            </div>
        </div>


</div>





<div id="box">

<button onclick="back()" id="back"> <-back </button>

<?php
// Retrieve the connection details from POST data
$host = isset($_POST['host']) ? htmlspecialchars($_POST['host']) : '';
$username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
$password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
$dbname = isset($_POST['dbname']) ? htmlspecialchars($_POST['dbname']) : '';

$connection = new mysqli($host, $username, $password, $dbname);

// Check for connection errors
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$query = "SHOW TABLES";
$result = $connection->query($query);

echo "<div id='top'>" . "<input type='text' id='addname' placeholder='table name' />" . "<input type='text' id='addtext' placeholder=' colum_name(data type), colum_name(data type), colum_name(data type)' />" . "    <button id='addButton'>Add</button>" .  "</div>";


if ($result && $result->num_rows > 0) {
    echo "<h2>Tables in $dbname: </h2>";
    echo "<div class='database-list'>";
    while ($row = $result->fetch_array()) {
        $tableName = htmlspecialchars($row[0]);
        echo "<div class='database-box'>" . "<span class='db-name'>" . $tableName . "</span>" . "<div class='button-container'>" . "<button class='btn-use'>Use</button>" . "<button class='btn-remove'>Remove</button>" . "</div>" . "</div>" ."<br>";

    }
    echo "</div>";
} else {
    echo "No tables found or error executing query: " . $connection->error;
}

?>

</div>



<script>
// Function to submit connection details via POST
function redirectToConnection(table) {

// Define the connection details
var connectionDetails = {
  host: '<?= $host ?>',
  username: '<?= $username ?>',
  password: '<?= $password ?>',
  dbname: '<?= $dbname ?>',
  table: table
};


  // Create a form element
  const form = document.createElement("form");
  form.method = "POST";
  form.action = "iner.php";

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
    const table = this.closest('.database-box').querySelector('.db-name').textContent;
    redirectToConnection(table);  // Pass the captured dbName to the function
  });
});

document.querySelectorAll('.btn-remove').forEach(button => {
   button.addEventListener('click', function () {
    const table = this.closest('.database-box').querySelector('.db-name').textContent;


    if (confirm(`Are you sure you want to delete the table: ${table}?`)) {
                $.ajax({
                    url: 'delete_table.php',
                    type: 'POST',
                    data: { tableN: table, database: '<?= $dbname ?>', host: '<?= $host ?>', username: '<?= $username ?>', password: '<?= $password ?>' },
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


document.getElementById('addButton').addEventListener('click', function () {
        const newtable = document.getElementById('addname').value.trim();
        const newcolum = document.getElementById("addtext").value.trim();

        if (newtable && newcolum) {   
            $.ajax({
                url: 'add_table.php',
                type: 'POST',
                data: {colum: newcolum, table: newtable, database: '<?= $dbname ?>', host: '<?= $host ?>', username: '<?= $username ?>', password: '<?= $password ?>' },
                success: function(response) {
                    alert(response);
                    location.reload(); // Refresh the list of databases
                },
                error: function(xhr) {
                    alert('Failed to add table: ' + xhr.responseText);
                }
            });
        } else {
            alert('Please enter a table name.');
        }
    });


    function back() {
    // Debugging: Log the current connection details
    console.log('Redirecting with connection details:', {
        host: '<?= $host ?>',
        username: '<?= $username ?>',
        password: '<?= $password ?>'
    });

    // Ensure that the host, username, and password are available
    if ('<?= $host ?>' && '<?= $username ?>' && '<?= $password ?>') {
        // Create a form to submit the data
        var form = document.createElement("form");
        form.method = "POST";
        form.action = "connect.php"; // Change to connection.php if you want to redirect back there

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

        // Append the form to the body and submit it
        document.body.appendChild(form);

        // Submit the form to send the data back to connection.php
        form.submit();
    } else {
        // If any of the required fields are missing, show an alert
        alert('Missing connection details!');
    }
}

</script>



</body>
</html>