<?php
// Start the session
session_start();

// Include necessary files
include 'info.php';

// Name of the DB
$dsn = "mysql:host=courses;dbname=z1968549";

// Test the connection
try {
    $pdo = new PDO($dsn, "z1968549", "2004Jul30");
} catch (PDOexception $e) {
    echo "Connection to database failed: " . $e->getMessage();
}

// Get Input
$qty = "";
$prod_id = "";

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
<!--- Group Project ~ CSCI466 																	--->
<!--- website.php																				--->
<!--- Aaron Arreola, Calvin Darley, Eli Gallegos, Jason Lan, Tyler Stenberg						--->
<!--- Purpose: 																					--->
<!--- This will be the main page of the website where different functions can be used and other --->
<!--- pages for the assignment can be reached here												--->
<html>
	<head>
		<title> Main Page - Funky Shop </title>
	</head>
	<body>
		<h1> Funky Shop </h1>
		<!--- Stuff that we should probably include sooner or later --->

		<!--- Get to shopping cart where they can finish transactions, etc... --->
		<a href="cartPage.php"> SHOPPING CART </a>
		<br>

		<!--- Link to login to account (split between user and employee views for the assignment) --->
		<a href="login.php"> EMPLOYEE LOGIN </a>
		<br>

		<!--- Track Order --->
		<a href="trackOrder.php"> Track Order </a>
		<br>

		<!--- Product List--->
		<!--- Show Product, Description, Add Quantity, Add Order --->

		<!--- PDO to Establish Connection --->
		<?php
			//login file
      //session_start();
			include 'info.php';

			//name of the DB
			$dsn = "mysql:host=courses;dbname=z1968549";

			//test the connection
			try
			{
				$pdo = new PDO($dsn, "z1968549", "2004Jul30");
			} //end of try statement
			catch (PDOexception $e)
			{
				echo "Connection to database failed: " . $e->getMessage();
			} //end of catch statement
		?>

		<h2> Product List </h2>
		<!--- Execute Query --->
		<?php
			$result = $pdo->query("SELECT * FROM Product WHERE Quantity > 0");

			echo "<table border='1'>";

				//print out the headers of the table
				echo "<tr>";
					echo "<th> NAME </th>";
					echo "<th> PRICE </th>";
					echo "<th> QUANTITY </th>";
				echo "</tr>";

				while ($row = $result->fetch(PDO::FETCH_ASSOC))
				{
					//create a new row
					echo "<tr>";

						//fill row with data
						echo "<td> {$row['Name']} </td>";
						echo "<td> {$row['Price']} </td>";

						//get the ProductID
						$PID = $row['ProductID'];
            $availableQuantity=$row['Quantity'];
						//form to get the quantity to add to cart
						echo "<form method='POST' action='website.php'>";
							echo "<input type='hidden' name='product_id' value='$PID'/>";
              echo "<td><input type='number' name='quantity' value='quantity' min='1' max='$availableQuantity'></td>";
							//echo "<td> <input type='text' name='quantity'/> </td>";
							echo "<td> <input type='submit' name='Add' value='ADD'/> </td>";
						echo "</form>";
              echo "<form method='GET' action='description.php'>";
              echo "<input type='hidden' name='product_id' value='$PID'/>";
              echo "<td><input type='submit' name='view_description' value='View Description' /></td>";
              echo "</form>";
					//close the row
					echo "</tr>";

					//increment the rows
					$row++;
				} //end of while loop

			//close the table
			echo "</table>";
		?>

		<!--- Get Input --->

	</body>
</html>













