<?php
class Order {
    private $order_id;
    private $user_id;
    private $order_date;
    private $name;
    private $surname;
    private $phone;
    private $address;
    private $price;
    private $items; // Array of order items

    public function __construct($order_id, $user_id, $order_date, $name, $surname, $phone, $address, $price, $items = []) {
        $this->order_id = $order_id;
        $this->user_id = $user_id;
        $this->order_date = $order_date;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->address = $address;
        $this->price = $price;
        $this->items = $items;
    }

    public function getOrderId() { return $this->order_id; }
    public function getUserId() { return $this->user_id; }
    public function getOrderDate() { return $this->order_date; }
    public function getName() { return $this->name; }
    public function getSurname() { return $this->surname; }
    public function getPhone() { return $this->phone; }
    public function getAddress() { return $this->address; }
    public function getPrice() { return $this->price; }
    public function getItems() { return $this->items; }
}
?>
