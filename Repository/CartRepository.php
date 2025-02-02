<?php

class CartRepository {

    public function addBookToCart($bookId, $bookName, $bookPrice, $quantity) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Initialize cart if it doesn't exist
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // If the book is already in the cart, update the quantity
        if (isset($_SESSION['cart'][$bookId])) {
            $_SESSION['cart'][$bookId]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$bookId] = [
                'name' => $bookName,
                'price' => $bookPrice,
                'quantity' => $quantity
            ];
        }
    }
}
