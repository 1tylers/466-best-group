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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #643843">
   	 		<a class="navbar-brand" href="website.php">Funky Shop</a>
    		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        		<span class="navbar-toggler-icon"></span>
    		</button>
    		<div class="collapse navbar-collapse" id="navbarNav">
        		<ul class="navbar-nav ml-auto">
            		<li class="nav-item">
                		<a class="nav-link" href="website.php">Home</a>
            		</li>
            		<li class="nav-item active">
               			 <a class="nav-link" href="login.php">Employee Login</a>
            		</li>
            		<li class="nav-item">
                		<a class="nav-link" href="trackOrder.php">Track Your Order</a>
            		</li>
            		<li class="nav-item">
                		<a class="nav-link" href="cartPage.php">Cart</a>
        			</li>
        		</ul>
    		</div>
		</nav>

		<!-- Bootstrap JS and dependencies -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

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
