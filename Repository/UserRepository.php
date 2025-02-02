<?php
require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../Database/dbconnection.php';

class UserRepository {
    private $conn;

    public function __construct() {
        $this->conn = dbconnection::getInstance()->getConnection();
    }

    public function registerUser(User $user) {
        try {
            $query = "INSERT INTO users (name, surname, email, phone, role, password) VALUES (:name, :surname, :email, :phone, :role, :password)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([
                ':name' => $user->getName(),
                ':surname' => $user->getSurname(),
                ':email' => $user->getEmail(),
                ':phone' => $user->getPhone(),
                ':role' => $user->getRole(),
                ':password' => $user->getPassword()
            ]);
            return true;
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage()); // Log the error
            die("Database Error: " . $e->getMessage()); // 🔴 Show the error on-screen
            return false;
        }
    }

    public function getAllUsers() {
        $query = "SELECT id, name, surname, email, phone, role FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addAdminUser($name, $surname, $email, $phone, $password) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (name, surname, email, phone, role, password) 
                      VALUES (:name, :surname, :email, :phone, 'admin', :password)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([
                ':name' => $name,
                ':surname' => $surname,
                ':email' => $email,
                ':phone' => $phone,
                ':password' => $hashedPassword
            ]);
            return true;
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return false;
        }
    }

    
    public function findUserByEmail($email) {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    public function storeRememberToken($userId, $token) {
        $db = dbconnection::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE users SET remember_token = ? WHERE id = ?");
        $stmt->execute([$token, $userId]);
    }
    
    public function findUserByToken($token) {
        $db = dbconnection::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE remember_token = ?");
        $stmt->execute([$token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}
?>
