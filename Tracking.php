<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Tracking</title>
</head>
<body>
    <h2>Order Tracking</h2>
    
    <?php
    //include 'info.php';

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get user input
        $orderID = $_POST['orderID'];
        $email = $_POST['email'];

        try {
            // Connect to MariaDB using PDO
            include 'info.php';
            $dsn = "mysql:host=courses;dbname=$dbname";
            $pdo = new PDO($dsn, $username, $password);

            // Prepare and execute SQL query
            $sql = "SELECT TrackingNo FROM PlacedOrder WHERE OrderID = :orderID AND Email = :email";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':orderID', $orderID);
            $statement->bindParam(':email', $email);
            $statement->execute();

            // Check if a matching pair is found
            if ($statement->rowCount() > 0) {
                // Fetch the tracking number
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                $trackingNumber = $row['TrackingNo'];

                // Display the tracking number
                echo "<p>Tracking Number: $trackingNumber</p>";
            } else {
                // Display a message if no match is found
                echo "<p>No matching order found.</p>";
            }
        } catch (PDOException $e) {
            // Display an error message
            echo "Error: " . $e->getMessage();
        }

        // Close the database connection
        if (isset($pdo)) {
            $pdo = null;
        }
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="orderID">Order ID:</label>
        <input type="text" id="orderID" name="orderID" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <input type="submit" value="Check Order">
    </form>
</body>
</html>
