<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Tracking</title>
</head>
<body>
    <h2>Order Tracking</h2>

    <?php
    //include 'info.php';

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get user input
        $orderID = $_POST['orderID'];
        $email = $_POST['email'];

        try {
            // Connect to MariaDB using PDO
            include 'info.php';
            $dsn = "mysql:host=courses;dbname=$dbname";
            $pdo = new PDO($dsn, $username, $password);

            // Prepare and execute SQL query
            $sql = "SELECT TrackingNo, Status FROM PlacedOrder WHERE OrderID = :orderID AND Email = :email";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':orderID', $orderID);
            $statement->bindParam(':email', $email);
            $statement->execute();



