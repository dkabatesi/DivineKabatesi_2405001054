<?php
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "divine";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';
$type = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $conn->real_escape_string($_POST['username'] ?? '');
    $pass = $conn->real_escape_string($_POST['password'] ?? '');

    $sql = "SELECT * FROM users WHERE Username = '$user' AND Password = '$pass'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $message = "Welcome, $user!";
        $type = "success";
    } else {
        $message = "Invalid username or password.";
        $type = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #2563eb;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            text-align: center;
            width: 320px;
        }

        .logo img {
            width: 60px;
            margin-bottom: 40px;
        }

        label {
            display: block;
            text-align: left;
            font-weight: bold;
            color: #ffffff;
            margin: 20px 0 8px;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }

        button {
            width: 9.7cm;
            padding: 12px;
            margin-top: 10px;
            background-color: #ffffff;
            color: #2563eb;
            border: none;
            border-radius: 6px;
            font-weight: 700;
            font-size: 1.05rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }


        button:hover {
            opacity: 0.9;
        }

        .forgot {
            display: block;
            float: right;
            margin-top: 20px;
            color: #e6e6e6;
            font-size: 0.6cm;
            text-decoration: none;
            font-weight: 400;
        }


        .forgot:hover {
            text-decoration: underline;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group i {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: #d4d4d4;
            font-size: 1rem;
            pointer-events: none;
            z-index: 2;
        }

        .input-group input {
            width: 100%;
            padding: 10px 10px 10px 38px;
            background-color: rgba(255, 255, 255, 0.12);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 6px;
            font-size: 0.95rem;
            outline: none;
            z-index: 1;
        }

        .input-group input::placeholder {
            color: #e0e0e0;
        }

        .logo img {
            width: 4cm;
            height: auto;
            margin-bottom: 10px;
        }

        .popup {
            background-color: #fff;
            padding: 12px 20px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 20px;
            text-align: center;
            animation: slide-down 0.4s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .popup.success {
            color: #188038;
            background-color: #e6ffed;
        }

        .popup.error {
            color: #d93025;
            background-color: #ffeded;
        }

        @keyframes slide-down {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="logo">
            <img src="logo.png" alt="Logo" />
        </div>
        <?php if (!empty($message)): ?>
            <div class="popup <?= $type ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>
        <form action="Thequiz.php" method="POST">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" id="username" name="username" placeholder="Enter username" required />
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Enter password" required />
            </div>

            <button type="submit">LOGIN</button>
            <a href="#" class="forgot">Forgot password?</a>
        </form>
    </div>
    <div id="popup" class="popup" style="display:none;"></div>
</body>

</html>