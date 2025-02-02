<?php
require_once __DIR__ . '/../Repository/OrderRepository.php';

class OrdersController {
    private $orderRepo;

    public function __construct() {
        $this->orderRepo = new OrderRepository();
    }

    public function displayOrders() {
        return $this->orderRepo->getAllOrdersWithItems();
    }
}

$ordersController = new OrdersController();
$orders = $ordersController->displayOrders();
?>
