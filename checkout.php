<?php
session_start();


$dsn = "mysql:host=courses;dbname=z1968549";

try {
    $pdo = new PDO($dsn, "z1968549", "2004Jul30");
} catch (PDOexception $e) {
    echo "Connection to database failed: " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit_order'])) {
     try {
        // Get user info
        $address = $_POST['address'];
        $cardNumber = $_POST['card_number'];
        $email = $_POST['email'];

        // Get total from the session
        $total = isset($_SESSION['total']) ? $_SESSION['total'] : 0;

        // create an order id
        $orderID = rand(10000000,99999999);

        // Get date
        $date = date("Y-m-d");

        // Get the number of items in the order
        $itemCount = 10; //count($_SESSION['Add']);

        $insertUserSQL = "INSERT INTO User (Email, Phone, Name) 
                              VALUES ('$email', '$phoneNumber', '$name')
                              ON DUPLICATE KEY UPDATE Name = '$name'";
            $pdo->query($insertUserSQL);

        // Directly insert values into the SQL query
        $insertOrderSQL = "INSERT INTO Orders (OrderID, Address, Total, BillingInfo, Datee, ItemCount, Email) 
                           VALUES ('$orderID', '$address', '$total', '$cardNumber', '$date', '$itemCount', '$email')";
        $pdo->query($insertOrderSQL);
        echo "$orderID, $address, $total, $cardNumber, $date, $itemCount, $email";
        // put into placed order table
        $trackingNo = rand(100000,999999);
        $status = "Recieved";
        $insertPlacedOrderSQL = "INSERT INTO PlacedOrder (Email, OrderID, TrackingNo, Status) 
                                VALUES ('$email', '$orderID', '$trackingNo', '$status')";

        // Insert product information into the Product table
            foreach ($_SESSION['Add'] as $product_id => $quantity) {
                $insertProductSQL = "INSERT INTO ProductStored (OrderID, ProductID) 
                                     VALUES ('$orderID', '$product_id')";
                $pdo->query($insertProductSQL);
            }
        
        $pdo->query($insertPlacedOrderSQL);

        
        exit();
    }
    catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    
}

?>

<html>
<head>
    <title>Checkout</title>
</head>
<body>
    <h2>Checkout</h2>

    <form action="checkout.php" method="post">
        <label for="address">Address:</label>
        <input type="text" name="address" required><br>

        <label for="card_number">Card Number:</label>
        <input type="text" name="card_number" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <input type="submit" name="submit_order" value="Place Order">
    </form>
    <br>
    <form action="cartPage.php" method="get">
        <input type="submit" value="Back to Cart">
    </form>
</body>
</html>
    

