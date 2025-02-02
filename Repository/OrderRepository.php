<?php
require_once __DIR__ . '/../Database/dbconnection.php';
require_once __DIR__ . '/../Model/Order.php';

class OrderRepository {
    private $conn;

    public function __construct() {
        $this->conn = dbconnection::getInstance()->getConnection();
    }

    public function getAllOrdersWithItems() {
        $query = "SELECT 
                    o.order_id, o.user_id, o.order_date, o.name, o.surname, 
                    o.phone, o.address, o.price, 
                    oi.order_item_id, oi.book_id, oi.quantity 
                  FROM orders o 
                  LEFT JOIN order_items oi ON o.order_id = oi.order_id
                  ORDER BY o.order_id DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $orders = [];
        foreach ($results as $row) {
            $order_id = $row['order_id'];

            if (!isset($orders[$order_id])) {
                $orders[$order_id] = new Order(
                    $row['order_id'], $row['user_id'], $row['order_date'], 
                    $row['name'], $row['surname'], $row['phone'], 
                    $row['address'], $row['price'], []
                );
            }

            if ($row['order_item_id']) {
                $orders[$order_id]->getItems()[] = [
                    'order_item_id' => $row['order_item_id'],
                    'book_id' => $row['book_id'],
                    'quantity' => $row['quantity']
                ];
            }
        }

        return array_values($orders);
    }

      public function createOrder($userId, $name, $surname, $phone, $address, $price) {
        $query = "INSERT INTO orders (user_id, name, surname, phone, address, price) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute([$userId, $name, $surname, $phone, $address, $price])) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function addOrderItem($orderId, $bookId, $quantity) {
        $query = "INSERT INTO order_items (order_id, book_id, quantity) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$orderId, $bookId, $quantity]);
    }
}
?>
