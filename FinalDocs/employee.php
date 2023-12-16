<html>
<body>
  <h1>Employee View</h1>

  <?php

  $dsn = "mysql:host=courses;dbname=z1948457";

  try {
    $pdo = new PDO($dsn, "z1948457", "2002Feb05");
  } catch (PDOexception $e) {
      echo "Connection to database failed: " . $e->getMessage();
  }

    $sql = "SELECT ProductID, Name, Quantity FROM Product;";
    $result = $pdo->query($sql);
  ?>

  <table border = 1>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Quantity</th>
    </tr>


    <?php
      while($row = $result->fetch())
      {
        echo "<tr>";
        echo "<td>{$row['ProductID']}</td>";
        echo "<td>{$row['Name']}</td>";
        echo "<td>{$row['Quantity']}</td>";
        echo "</tr>";
      }
    ?>
  </table><br><br>

  <h2>Non-Shipped Orders</h2>
  <?php
    $sql = "SELECT OrderID, TrackingNo, Email FROM PlacedOrder WHERE Status = 'Received'";
    $result = $pdo->query($sql);
  ?>

  <table border = 1>
    <tr>
      <th>OrderID</th>
      <th>Tracking Number</th>
      <th>User Email</th>
    </tr>


    <?php
      while($row = $result->fetch())
      {
        echo "<tr>";
        echo "<td>{$row['OrderID']}</td>";
        echo "<td>{$row['TrackingNo']}</td>";
        echo "<td>{$row['Email']}</td>";
        echo "</tr>";
      }
    ?>
  </table><br><br>


  <form method ="POST">
    <label for="TrackingNo">Update Status:</label>
      <input type="text" value="Tracking Number" name="TrackingNo"> Set delivery status to:

      <select name="status" id="status">
        <option value="Received">Received</option>
        <option value="Shipped">Shipped</option>
        <option value="Delivered">Delivered</option>
      </select>

    <input type="submit" value="Update">
  </form>

  <?php
    if(isset($_POST['TrackingNo'], $_POST['status']))
    {
	  $tracking = $_POST['TrackingNo'];
	  $status = $_POST['status'];


      $sql = "UPDATE PlacedOrder SET Status = '$status' WHERE TrackingNo = '$tracking';";
	  $result = $pdo->exec($sql);

	  if(!$result)
	  {
	    die('Error: Order not found. ' . $pdo->errorInfo()[2]);
	  }

	  echo "Order '$tracking' status updated to '$status'";
	}
  ?>

</body>
</html>
