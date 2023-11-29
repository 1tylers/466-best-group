<html>
  <head>
    <title>Shopping Cart</title>
  </head>
  <body>
   <?php 
     
      try {
            
            include 'info.php';
            $dsn = "mysql:host=courses;dbname=$username";
            $pdo = new PDO($dsn, $username, $password);
            
            $total = 0; 
              echo "<table>"; 
                    echo "<tr>"; 
                    echo "<th>Product Name </th> ";
                    echo "<th>Quantity </th> ";
                    echo "<th>Price </th>"; 
                    echo "<th>Total </th>"; 
                    echo "</tr> ";
            foreach ($_SESSION['cart'] as $product_id => $quantity)
            {
              $sql = "SELECT Description, Price WHERE ProductID=$product_id";
              $result = $pdo->query($supplierSql); 
                if ($result->rowCount() > 0)
                {
                    $row = $result->fetch_assoc(); 
                    $description=$row['Description'];
                    $price=$row['Price'];
                    $totalItem=$quantity * $price; 
                    $total += $totalItem; 
                    echo "<tr>"; 
                    echo "<th>$description</th> ";
                    echo "<th>$quantity </th> ";
                    echo "<th>$price </th>"; 
                    echo "<th>$totalItem </th>"; 
                    echo "</tr> ";  
                }
            } 
          }    
          catch (PDOException $e) {
           
          echo "Connection failed: " . $e->getMessage();
           
          }
          echo "<tr>"; 
          echo "<td> Total:</td>";
          echo "<td> $total</td>";
          echo "</tr>"; 
          echo "</table>";
          ?>
          <form action="checkout.php" method="post"> 
            <input type='submit' value='Checkout'>
          </form>
  </body>
</html>
 
