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
    // Check if the delete button is clicked
    if (isset($_POST['delete'])) {
        $deleteProductId = $_POST['delete'];
        // Remove the selected product from the session
        unset($_SESSION['Add'][$deleteProductId]);
    } elseif (isset($_POST['quantity'])) {
        // Update the quantity in the session
        foreach ($_POST['quantity'] as $product_id => $quantity) {
            // Validate quantity (you might want to add additional validation)
            
            $_SESSION['Add'][$product_id] = $quantity;
        }
    }
}
?>

<html>
  <head>
    <title>Shopping Cart</title>

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
            		<li class="nav-item">
               			 <a class="nav-link" href="login.php">Employee Login</a>
            		</li>
            		<li class="nav-item">
                		<a class="nav-link" href="trackOrder.php">Track Your Order</a>
            		</li>
            		<li class="nav-item active">
                		<a class="nav-link" href="cartPage.php">Cart</a>
        			</li>
        		</ul>
    		</div>
		</nav>

		<!-- Bootstrap JS and dependencies -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <h1>Your Cart</h1>
  <form action="cartPage.php" method="post">
    <?php
  
        $total = 0;
        $items=0;
        echo "<table>";
        echo "<tr>";
        echo "<th>Product Name </th> ";
        echo "<th>Quantity </th> ";
        echo "<th>Price </th>";
        echo "<th>Total </th>";
        echo "</tr>";
        if (!isset($_SESSION["Add"])) {
        $_SESSION["Add"] = [];
    }
        foreach ($_SESSION['Add'] as $product_id => $quantity) {
            $sql = "SELECT Quantity, Name, Price FROM Product WHERE ProductID=$product_id";
            $result = $pdo->query($sql);

            if ($result->rowCount() > 0) {
                $row = $result->fetch(PDO::FETCH_ASSOC);
                $availableQuantity=$row['Quantity'];
                $description = $row['Name'];
                $price = $row['Price'];
                $totalItem = $quantity * $price;
                $total += $totalItem;
                $items+=$quantity;
                echo "<tr>";
                echo "<td>$description</td> ";
               echo "<td><input type='number' name='quantity[$product_id]' value='$quantity' min='1' max='$availableQuantity'></td>";

                echo "<td>$price </td>";
                echo "<td>$totalItem </td>";
                echo "<td><button type='submit' name='delete' value='$product_id'>X</button></td>";
                echo "</tr>";
            }
        }
    $_SESSION['total'] = $total;
    $_SESSION['items'] = $items;
    echo "<tr>";
    echo "<td> Total:</td>";
    echo "<td> $total</td>";
    echo "<td> Total Items:</td>";
    echo "<td> $items</td>";
    echo "</tr>";
    echo "</table>";
    ?>
    <input type='submit' value='Update Quantities'>
    </form>

    <form action="checkout.php" method="post">
      <input type='submit' value='Checkout'>
    </form>
    <form action="website.php" method="get">
      <input type='submit' value='Continue Shopping'>
    </form>
  </body>
</html>


