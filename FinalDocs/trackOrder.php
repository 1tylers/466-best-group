<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <title>Order Tracking</title>
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
            		<li class="nav-item">
               			 <a class="nav-link" href="login.php">Employee Login</a>
            		</li>
            		<li class="nav-item active">
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
            //include 'info.php';
            $dsn = "mysql:host=courses;dbname=z1948457";
            $pdo = new PDO($dsn, "z1948457", "2002Feb05");
/*
            // Prepare and execute SQL query
            $sql = "SELECT TrackingNo, Status, Total FROM PlacedOrder WHERE OrderID = :orderID AND Email = :email";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':orderID', $orderID);
            $statement->bindParam(':email', $email);
            $statement->execute();
*/

            // Prepare and execute SQL query with JOIN
            $sql = "SELECT PlacedOrder.TrackingNo, PlacedOrder.Status, Orders.Total 
                    FROM PlacedOrder 
                    JOIN Orders ON PlacedOrder.OrderID = Orders.OrderID 
                    WHERE PlacedOrder.OrderID = :orderID AND PlacedOrder.Email = :email";
            
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
                $total = $row['Total'];

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
/*
            // Query to calculate the total of all orders made by a specific user
            $sqlTotal = "SELECT SUM(Total) AS GrandTotal FROM PlacedOrder WHERE Email = :email";
            $stmtTotal = $pdo->prepare($sqlTotal);
            $stmtTotal->bindParam(':email', $email);
            $stmtTotal->execute();

            // Fetch the total for all orders made by the user
            $rowTotal = $stmtTotal->fetch(PDO::FETCH_ASSOC);
            $grandTotal = $rowTotal['GrandTotal'];

            // Display the total for all orders made by the user
            echo "<p>Grand Total for All Orders: $grandTotal</p>";
            echo "<p>All the money you have given to us. For now...,</p>";
*/

            
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
