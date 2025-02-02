<?php

require_once __DIR__ . '/../Repository/CartRepository.php';

class CartController {

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['action']) && $_POST['action'] === 'add_to_cart') {
                $this->addToCart();
            }
        }
    }

    public function addToCart() {
        session_start();

        // Check if all necessary POST parameters are set
        if (!isset($_POST['book_id'], $_POST['book_name'], $_POST['book_price'], $_POST['quantity'])) {
            echo json_encode(['status' => 'error', 'message' => 'Missing parameters']);
            exit;
        }

        // Get the book data from POST
        $bookId = (int)$_POST['book_id'];
        $bookName = $_POST['book_name'];
        $bookPrice = (float)$_POST['book_price'];
        $quantity = (int)$_POST['quantity']; // Fix: Include quantity

        if ($quantity <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid quantity']);
            exit;
        }

        // Initialize the cart if not set
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Use the repository to add the book to the cart
        $cartRepo = new CartRepository();
        $cartRepo->addBookToCart($bookId, $bookName, $bookPrice, $quantity);

        echo json_encode(['status' => 'success', 'message' => 'Book added to the cart']);
    }
}

// Instantiate and handle the request
$cartController = new CartController();
$cartController->handleRequest();
