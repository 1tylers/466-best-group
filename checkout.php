<?php
session_start();

include 'info.php';

$dsn = "mysql:host=courses;dbname=z1968549";

try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo "Connection to the database failed: " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit_order'])) {
        // Get user info
        $address = $_POST['address'];
        $cardNumber = $_POST['card_number'];
        $email = $_POST['email'];

        // Get total from the session
        $total = isset($_SESSION['total']) ? $_SESSION['total'] : 0;

        // create an order id
        $orderID = uniqid();

        // Get date
        $date = date("Y-m-d");

        // Get the number of items in the order
        $itemCount = count($_SESSION['Add']);

        // Directly insert values into the SQL query
        $insertOrderSQL = "INSERT INTO Orders (OrderID, Address, Total, BillingInfo, Datee, ItemCount, Email) 
                           VALUES ('$orderID', '$address', '$total', '$cardNumber', '$date', '$itemCount', '$email')";
        $pdo->query($insertOrderSQL);

        // put into placed order table
        $trackingNo = uniqid();
        $status = "Processing";
        $insertPlacedOrderSQL = "INSERT INTO PlacedOrder (Email, OrderID, TrackingNo, Status) 
                                VALUES ('$email', '$orderID', '$trackingNo', '$status')";
        $pdo->query($insertPlacedOrderSQL);

        // go to order info after placed order
        header("Location: orderdetails.php");
        exit();
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
