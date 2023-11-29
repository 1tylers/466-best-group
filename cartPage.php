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
            //$quantity = max(0, intval($quantity));
            $_SESSION['Add'][$product_id] = $quantity;
        }
    }
}
?>

<html>
  <head>
    <title>Shopping Cart</title>
  </head>
  <body>
  <form action="cartPage.php" method="post">
    <?php
  
        $total = 0;
        echo "<table>";
        echo "<tr>";
        echo "<th>Product Name </th> ";
        echo "<th>Quantity </th> ";
        echo "<th>Price </th>";
        echo "<th>Total </th>";
        echo "</tr>";

        foreach ($_SESSION['Add'] as $product_id => $quantity) {
            $sql = "SELECT Description, Price FROM Product WHERE ProductID=$product_id";
            $result = $pdo->query($sql);

            if ($result->rowCount() > 0) {
                $row = $result->fetch(PDO::FETCH_ASSOC);
                $description = $row['Description'];
                $price = $row['Price'];
                $totalItem = $quantity * $price;
                $total += $totalItem;

                echo "<tr>";
                echo "<td>$description</td> ";
               echo "<td><input type='number' name='quantity[$product_id]' value='$quantity' min='1'></td> ";
                echo "<td>$price </td>";
                echo "<td>$totalItem </td>";
                echo "<td><button type='submit' name='delete' value='$product_id'>X</button></td>";
                echo "</tr>";
            }
        }
   

    echo "<tr>";
    echo "<td> Total:</td>";
    echo "<td> $total</td>";
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
