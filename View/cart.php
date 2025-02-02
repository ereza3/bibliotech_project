<?php
if (file_exists(__DIR__ . '/includes/menu.php')) {
    require_once(__DIR__ . '/includes/menu.php');
} else {
    echo "Menu file not found.";
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        
        .content {
            width: 80%;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #2c3e50;
            color: #ffffff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .total-container {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
        }

        .checkout-btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background-color: #28a745;
            color: white;
            text-align: center;
            font-size: 18px;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .checkout-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="content">
        <h2>Your Shopping Cart</h2>
        <table>
            <tr>
                <th>Book Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>

            <?php
            $total = 0;
            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                foreach ($_SESSION['cart'] as $bookId => $book) {
                    $itemTotal = $book['price'] * $book['quantity'];
                    $total += $itemTotal;
                    echo "<tr>
                        <td>{$book['name']}</td>
                        <td>\${$book['price']}</td>
                        <td>{$book['quantity']}</td>
                        <td>\$" . number_format($itemTotal, 2) . "</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='4' style='text-align:center; padding:20px;'>Your cart is empty.</td></tr>";
            }
            ?>
        </table>

        <div class="total-container">
            Total: $<?= number_format($total, 2) ?>
        </div>

        <?php if ($total > 0): ?>
            <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
        <?php endif; ?>
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
