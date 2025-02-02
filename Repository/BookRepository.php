<?php
require_once __DIR__ . '/../Model/Book.php';
require_once __DIR__ . '/../Database/dbconnection.php'; // Include database connection

class BookRepository {
    private $pdo;

    public function __construct() {
        $this->pdo = dbconnection::getInstance()->getConnection(); // Get PDO instance
    }

    public function getBooksByCategory($category) {
        $query = "SELECT * FROM books WHERE category = :category LIMIT 6";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->execute();
        $books = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book($row['name'], $row['author'], $row['image'], $row['category'], $row['price'], $row['book_id']);
        }

        return $books;
    }

    // Method to save book to the database
    public function save(Book $book) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO books (name, author, image, category, price) VALUES (:name, :author, :image, :category, :price)");
            $stmt->bindParam(':name', $book->getName());
            $stmt->bindParam(':author', $book->getAuthor());
            $stmt->bindParam(':image', $book->getImage());
            $stmt->bindParam(':category', $book->getCategory());
            $stmt->bindParam(':price', $book->getPrice());

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return false;
        }
    }

    public function getBookById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM books WHERE book_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return new Book(
                $result['name'], 
                $result['author'], 
                $result['image'], 
                $result['category'], 
                $result['price']
            );
        }
        return null; // Return null if no book is found
    }
}
?>
