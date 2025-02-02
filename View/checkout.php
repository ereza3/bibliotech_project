<?php



if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../Repository/OrderRepository.php';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $_SESSION['error'] = "Your cart is empty!";
    header("Location: cart.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $bankNumber = trim($_POST['bank_number']); // Not verified

    if (empty($name) || empty($surname) || empty($phone) || empty($address) || empty($bankNumber)) {
        $_SESSION['error'] = "All fields are required!";
        header("Location: checkout.php");
        exit();
    }

    $totalPrice = 0;
    foreach ($_SESSION['cart'] as $book) {
        $totalPrice += $book['price'] * $book['quantity'];
    }

    $orderRepo = new OrderRepository();
    $orderId = $orderRepo->createOrder($_SESSION['user_id'], $name, $surname, $phone, $address, $totalPrice);

    if ($orderId) {
        foreach ($_SESSION['cart'] as $bookId => $book) {
            $orderRepo->addOrderItem($orderId, $bookId, $book['quantity']);
        }
        
        unset($_SESSION['cart']); // Clear cart after successful order
        $_SESSION['success'] = "Order placed successfully!";
        header("Location: order_success.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to place the order!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .container {
            width: 50%;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 { text-align: center; color: #2c3e50; }
        .form-group { margin-bottom: 15px; }
        label { font-weight: bold; color: #2c3e50; }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .submit-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background: #28a745;
            color: #fff;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .submit-btn:hover { background: #218838; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Checkout</h2>
        <?php if (isset($_SESSION['error'])): ?>
            <p style="color:red;"><?= $_SESSION['error'] ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        
        <form action="" method="POST">
            <div class="form-group">
                <label>First Name:</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Surname:</label>
                <input type="text" name="surname" required>
            </div>
            <div class="form-group">
                <label>Phone:</label>
                <input type="text" name="phone" required>
            </div>
            <div class="form-group">
                <label>Address:</label>
                <input type="text" name="address" required>
            </div>
            <div class="form-group">
                <label>Bank Number (not verified):</label>
                <input type="number" name="bank_number" required>
            </div>
            <button type="submit" class="submit-btn">Place Order</button>
        </form>
    </div>
</body>
</html>
<?php
if (file_exists(__DIR__ . '/includes/footer.php')) {
  require_once(__DIR__ . '/includes/footer.php');
} else {
  echo "Footer file not found.";
}

?>