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
            $dsn = "mysql:host=courses;dbname=z1968549";
            $pdo = new PDO($dsn, "z1968549", "2004Jul30");

            // Prepare and execute SQL query
            $sql = "SELECT TrackingNo, Status, Total FROM PlacedOrder WHERE OrderID = :orderID AND Email = :email";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':orderID', $orderID);
            $statement->bindParam(':email', $email);
            $statement->execute();



            // Check if a matching pair is found
            if ($statement->rowCount() > 0) {
                // Fetch the tracking number and the status
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                $trackingNumber = $row['TrackingNo'];
                $status = $row['Status'];
                $total = $rowOrder['Total'];

                // Display the tracking number
                echo "<p>Tracking Number: $trackingNumber</p>";

                // Display the status of the order
                echo "<p>Status of Order: $status</p>";

                //Display the total for the order
                echo "<p>Total for Order: $total</p>";
            }
            else{
                // Display a message if no match is found
                echo "<p>No matching order found.</p>";
            }

            // Make a query to calculate the total of all orders made by a specific user
            $sqlTotal = "SELECT SUM(Total) AS GrandTotal FROM PlacedOrder WHERE Email = :email";
            $statementTotal = $pdo->prepare($sqlTotal);
            $statementTotal->bindParam(':email', $email);
            $statementTotal->execute();

            // Fetch the total for all orders made by the user
            $rowTotal = statementTotal->fetch(PDO::FETCH_ASSOC);
            $grandTotal = roeTotal['GrandTotal'];

            // Display the total for all orders made by the user
            echo "<p>All the money you have given to us. For now...,</p>";
            echo "<p>Grand Total for All Orders: $grandTotal</p>";

            
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

