<?php
require_once __DIR__ . '/../Model/Contact.php';
require_once __DIR__ . '/../Database/dbconnection.php'; // Include database connection

class ContactRepository {
    private $pdo;

    public function __construct() {
        $this->pdo = dbconnection::getInstance()->getConnection(); // Get PDO instance
    }

    public function save(Contact $contact) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO contact (name, email, message) VALUES (:name, :email, :message)");
            $stmt->bindParam(':name', $contact->getName());
            $stmt->bindParam(':email', $contact->getEmail());
            $stmt->bindParam(':message', $contact->getMessage());

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return false;
        }
    }

    public function getAllMessages() {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM contact ORDER BY id DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return all messages as an associative array
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return false;
        }
    }
}
?>
