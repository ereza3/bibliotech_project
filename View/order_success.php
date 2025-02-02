<?php
session_start();
if (!isset($_SESSION['success'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .container {
            width: 50%;
            margin: 50px auto;
            text-align: center;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 { color: #28a745; }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .btn:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h2>🎉 Order Placed Successfully!</h2>
        <p>Thank you for shopping with us.</p>
        <a href="index.php" class="btn">Continue Shopping</a>
    </div>
</body>
</html>

<?php unset($_SESSION['success']); ?>
