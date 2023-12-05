<?php
// Start the session
    session_start();
    
    // Include necessary files
    include 'info.php';
    
    // Name of the DB
    $dsn = "mysql:host=courses;dbname=z1968549";
    
    // Test the connection
    try {
        $pdo = new PDO($dsn, $username, $password);
    } catch (PDOexception $e) {
        echo "Connection to the database failed: " . $e->getMessage();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $EmpID = $_POST["EmpID"];
    $pswd = $_POST["password"];
    $result = $pdo->query("SELECT * FROM Employees WHERE EmpID = '$EmpID' AND Password = '$pswd'");
    if ($result->rowCount() > 0) {
        header("Location: employee.php?login=success");
        exit();
    } else {
        header("Location: login.php?login=failed");
        exit();
    }
}
?>
    
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    
    <?php
    // Display error message if login fails
    if (isset($_GET["login"]) && $_GET["login"] == "failed") {
        echo "<p style='color: red;'>Invalid credentials. Please try again.</p>";
    }
    ?>

    <form method="post" action="">
        <label for="empID">Employee ID:</label>
        <input type="text" name="EmpID" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>