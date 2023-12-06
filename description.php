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
  
    <?php
      if (isset($_GET['product_id'])) 
      {
        $product_id = $_GET['product_id'];
        $result = $pdo->query("SELECT * FROM Product WHERE ProductID=$product_id ");
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // Display product information
            echo "<h1>{$row['Name']}</h1>";
            echo "<p>Product ID: {$row['ProductID']}</p>";
            echo "<p>Available: {$row['Quantity']}</p>";
            echo "<p>Price: $ {$row['Price']}</p>";
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


