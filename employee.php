<html>
<body>
  <h1>Employee View</h1>

  <?php
    $sql = "SELECT ProductID, Description, Quantity FROM Product;";
    $result = $pdo->query($sql);
  ?>

    <table border = 1>
      <tr>
        <th>ID</th>
        <th>Description</th>
        <th>Quantity</th>
      </tr>


      <?php
        while($row = $result->fetch())
        {
          echo "<tr>";
          echo "<td>{$row['ProductID']}</td>";
          echo "<td>{$row['Description']}</td>";
          echo "<td>{$row['Quantity']}</td>";
          echo "</tr>";
        }
      ?>
    </table>





</body>
</html>
