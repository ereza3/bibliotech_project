
<?php
class OrderItem {
    private $id;
    private $orderId;
    private $bookId;
    private $quantity;

    public function __construct($id, $orderId, $bookId, $quantity) {
        $this->id = $id;
        $this->orderId = $orderId;
        $this->bookId = $bookId;
        $this->quantity = $quantity;
    }

    public function getId() {
        return $this->id;
    }

    public function getOrderId() {
        return $this->orderId;
    }

    public function getBookId() {
        return $this->bookId;
    }

    public function getQuantity() {
        return $this->quantity;
    }
}
?>