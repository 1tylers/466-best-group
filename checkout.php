<?php
session_start();


$dsn = "mysql:host=co	urses;dbname=z1968549";

try {
    $pdo = new PDO($dsn, "z1968549", "2004Jul30");
} catch (PDOexception $e) {
    echo "Connection to database failed: " . $e->getMessage();
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
        $itemCount = 10 //count($_SESSION['Add']);

        // Directly insert values into the SQL query
        $insertOrderSQL = "INSERT INTO Orders (OrderID, Address, Total, BillingInfo, Datee, ItemCount, Email) 
                           VALUES ('$orderID', '$address', '$total', '$cardNumber', '$date', '$itemCount', '$email')";
        $pdo->query($insertOrderSQL);

        // put into placed order table
        $trackingNo = uniqid();
        $status = "Recieved";
        $insertPlacedOrderSQL = "INSERT INTO PlacedOrder (Email, OrderID, TrackingNo, Status) 
                                VALUES ('$email', '$orderID', '$trackingNo', '$status')";
        $pdo->query($insertPlacedOrderSQL);

        //$_SESSION['order_details'] = getProductsDetails($_SESSION['Add'], $pdo);

        // go to order info after placed order
        //header("Location: orderdetails.php");
        exit();
    }
}

/*
function getProductsDetails($cart, $pdo) {
    $productsDetails = [];

    foreach ($cart as $product_id => $quantity) {
        $sql = "SELECT Quantity, Description, Price FROM Product WHERE ProductID=$product_id";
        $result = $pdo->query($sql);

        if ($result->rowCount() > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $description = $row['Description'];
            $price = $row['Price'];
            $totalItem = $quantity * $price;

            $productsDetails[] = [
                'description' => $description,
                'quantity' => $quantity,
                'price' => $price,
                'totalItem' => $totalItem
            ];
        }
    }

    return $productsDetails;
}
*/
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
