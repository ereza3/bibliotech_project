<?php

class Cart {
    private $items = [];

    public function addItem($book, $quantity) {
        // Check if the book is already in the cart
        if (isset($this->items[$book->getBookId()])) {
            $this->items[$book->getBookId()]['quantity'] += $quantity;
        } else {
            $this->items[$book->getBookId()] = [
                'book' => $book,
                'quantity' => $quantity
            ];
        }
    }

    public function removeItem($bookId) {
        if (isset($this->items[$bookId])) {
            unset($this->items[$bookId]);
        }
    }

    public function getItems() {
        return $this->items;
    }

    public function calculateTotalPrice() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['book']->getPrice() * $item['quantity'];
        }
        return $total;
    }
}

?>
