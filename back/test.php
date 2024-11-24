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
        <?php
        $host = isset($_POST['host']) ? htmlspecialchars($_POST['host']) : '';
        $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
        $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
        $dbname = isset($_POST['dbname']) ? htmlspecialchars($_POST['dbname']) : '';
        $table = isset($_POST['table']) ? htmlspecialchars($_POST['table']) : '';

        // Establish a new database connection
        $connection = new mysqli($host, $username, $password, $dbname);
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

        // Start form
        echo "<form method='POST' id='dataForm'>";
        echo "<input type='hidden' name='host' value='" . htmlspecialchars($host) . "'>";
        echo "<input type='hidden' name='username' value='" . htmlspecialchars($username) . "'>";
        echo "<input type='hidden' name='password' value='" . htmlspecialchars($password) . "'>";
        echo "<input type='hidden' name='dbname' value='" . htmlspecialchars($dbname) . "'>";
        echo "<input type='hidden' name='table' value='" . htmlspecialchars($table) . "'>";

        // Display column names and input fields
        echo "<table border='1' id='dataTable'><tr>";
        $columns = [];
        while ($column = $columnsResult->fetch_assoc()) {
            echo "<th>" . htmlspecialchars($column['COLUMN_NAME']) . "<br><small>(" . htmlspecialchars($column['DATA_TYPE']) . ")</small></th>";
            $columns[] = $column['COLUMN_NAME'];
        }
        echo "</tr><tr>";
        foreach ($columns as $colName) {
            echo "<td><input type='text' name='input_$colName' placeholder='Enter $colName'></td>";
        }
        echo "</tr></table>";

        echo "<button type='button' onclick='addEntry()'>Add</button>";
        echo "<button type='button' onclick='removeEntry()'>Remove</button>";
        echo "</form>";

        // Fetch and display table data
        $query = "SELECT * FROM `$table`";
        $result = $connection->query($query);
        if ($result) {
            if ($result->num_rows > 0) {
                echo "<table border='1' id='dataTable'>";
                echo "<tr>";
                while ($field = $result->fetch_field()) {
                    echo "<th>" . htmlspecialchars($field->name) . "</th>";
                }
                echo "</tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $cell) {
                        echo "<td>" . htmlspecialchars($cell) . "</td>";
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
        $connection->close();
        ?>
    </div>

    <script src="script.js"></script>
</body>
</html>
