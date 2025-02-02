<?php
require_once('../Repository/BookRepository.php');
require_once('../Model/Book.php');

class BookController {
    private $bookRepo;

    public function __construct() {
        $this->bookRepo = new BookRepository();
    }

    // Handle adding a new book
    public function handleAddBook() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate fields
            $name = trim($_POST['name']);
            $author = trim($_POST['author']);
            $image = trim($_POST['image']);
            $category = trim($_POST['category']);
            $price = trim($_POST['price']);

            if (empty($name) || empty($author) || empty($image) || empty($category) || empty($price)) {
                $_SESSION['error'] = "All fields are required.";
                header('Location: ../View/add_books.php');
                exit();
            }

            // Create Book object
            $book = new Book($name, $author, $image, $category, $price);

            // Save to the database using the repository
            $isSaved = $this->bookRepo->save($book);

            if ($isSaved) {
                $_SESSION['success'] = "Book added successfully!";
                header('Location: ../View/add_books.php');
                exit();
            } else {
                $_SESSION['error'] = "Failed to add the book. Please try again later.";
                header('Location: ../View/add_books.php');
                exit();
            }
        }
    }
}

// Instantiate and call the function
$bookController = new BookController();
$bookController->handleAddBook();
?>
