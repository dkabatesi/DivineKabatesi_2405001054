<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }

        h2 {
            font-weight: bold;
        }

        form {
            width: 300px;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 6px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            margin-top: 15px;
            padding: 6px 12px;
        }
    </style>
</head>

<body>

    <h2>Login Form</h2>

    <form method="post" action="login.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password">

        <input type="submit" value="Login">
    </form>

    <?php
    // Database connection setup
    $servername = "localhost";
    $dbUsername = "root";       // default for XAMPP
    $dbPassword = "";           // leave empty for XAMPP
    $dbName     = "divine";  // replace with your DB name

    // Create connection
    $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle POST login submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = $_POST['username'] ?? '';
        $pass = $_POST['password'] ?? '';

        // Sanitize input
        $user = $conn->real_escape_string($user);
        $pass = $conn->real_escape_string($pass);

        // SQL query to check credentials
        $sql = "SELECT * FROM users WHERE Username = '$user' AND Password = '$pass'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows === 1) {
            echo "<p><strong>Login successful!</strong> Welcome, $user.</p>";
        } else {
            echo "<p><strong>Login failed!</strong> Invalid username or password.</p>";
        }
    }
    ?>


</body>

</html>