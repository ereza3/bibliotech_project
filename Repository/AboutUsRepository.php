<?php
require_once __DIR__ . '/../Database/dbconnection.php';

class AboutUsRepository {
    private $conn;

    public function __construct() {
        $this->conn = dbconnection::getInstance()->getConnection();
    }

    public function getAboutUs() {
        $stmt = $this->conn->prepare("SELECT name, year, text FROM about_us WHERE id = 1");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
