<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    
    <div id="box">

        <h2>Log In</h2>
        <form action="back/connect.php" method="POST">
            <div class="input-group">
                <label for="host">MySql Host:</label>
                <input type="text" name="host" id="host" placeholder="localhost/13.15.22.1" required>
            </div>
            <div class="input-group">
                <label for="username">MySql Username:</label>
                <input type="text" name="username" id="username" placeholder="Enter username" required>
            </div>
            <div class="input-group">
                <label for="password">MySql Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter password" required>
            </div>
            <button type="submit">Submit</button>
        </form>

    </div>

</body>
</html>