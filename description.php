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
  if (isset($_POST["Add"])) {
    $qty = $_POST["quantity"];
    
    $product_id = $_POST["product_id"];

    // Adding to cart
    if (!isset($_SESSION["Add"])) {
        $_SESSION["Add"] = [];
    }
    
    //check quantity added
    $result = $pdo->query("SELECT Quantity FROM Product WHERE ProductID='$product_id'");
    
    //get value
    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
      $qtyCheck = $row['Quantity'];
      $row++;
    }//end of while loop

    //check if quantity is valid
    if ($qtyCheck >= (($_SESSION["Add"][$product_id]+$qty)))
    {
     $_SESSION["Add"][$product_id] += $qty;
      header("location:cartPage.php");
      exit(); 
    }//end of if statement
    else
    {
      echo "Error::Max Quantity for item is $qtyCheck";  
    }//end of else statement
}
?>
<html>
  <head>
    <title>Product Description</title>
  </head>
  <body>
    <?php
      if (isset($_GET['product_id'])) 
      {
        $product_id = $_GET['product_id'];
        $result = $pdo->query("SELECT * FROM Product WHERE ProductID=$product_id ");
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // Display product information
            echo "<h1>{$row['Description']}</h1>";
            echo "<p>Product ID: {$row['ProductID']}</p>";
            echo "<p>Available: {$row['Quantity']}</p>";
            echo "<p>Description: {$row['Description']}</p>";
            
            echo "<form method='POST' action='description.php'>";
            echo "<input type='hidden' name='product_id' value='$product_id'/>";
            echo "<label for='quantity'>Quantity:</label>";
            echo "<input type='number' name='quantity' value='1' min='1' max='{$row['Quantity']}' required>";
            echo "<input type='submit' name='Add' value='Add to Cart'>";
            echo "</form>";
          }
      }
    ?>
    <br>
    <a href="website.php">Back to Product List</a>
</body>
</html>
