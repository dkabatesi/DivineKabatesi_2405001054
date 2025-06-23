<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <style>

    </style>
</head>

<body>

    <form action="calculator.php" method="post">
        <input type="number" name="num1" placeholder="Enter first number" required>
        <select name="operator">
            <option value="add">+</option>
            <option value="sub">−</option>
            <option value="mul">×</option>
            <option value="div">÷</option>
        </select>
        <input type="number" name="num2" placeholder="Enter second number" required>
        <input type="submit" value="Calculate">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num1 = (float) $_POST["num1"];
        $num2 = (float) $_POST["num2"];
        $operator = $_POST["operator"];
        $result = "";

        switch ($operator) {
            case "add":
                $result = $num1 + $num2;
                break;
            case "sub":
                $result = $num1 - $num2;
                break;
            case "mul":
                $result = $num1 * $num2;
                break;
            case "div":
                $result = $num2 != 0 ? $num1 / $num2 : "Division by zero error!";
                break;
        }

        echo "<h2>Result: $result</h2>";
    }
    ?>

</body>

</html>