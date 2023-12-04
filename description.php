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
  if (isset($_GET['product_id'])) 
  {
    $product_id = $_GET['product_id'];
    $result = $pdo->query("SELECT * FROM Product WHERE ProductID=$product_id ");
  }
?>