<?php
class dbconnection {
    private static $instance = null;
    private $conn;

    private $host = "localhost";
    private $user = "root";  
    private $pass = "";    
    private $dbname = "bibliotech"; 

    private function __construct() {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
            PDO::ATTR_EMULATE_PREPARES => false, 
        ];

        try {
            $this->conn = new PDO($dsn, $this->user, $this->pass, $options);
            // Test the connection
            $this->testConnection();
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new dbconnection();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }

   
    private function testConnection() {
        try {
            $this->conn->query("SELECT 1");  // Run a simple query to test the connection
          
        } catch (PDOException $e) {
            echo "Error: Unable to verify database connection.<br>";
            die($e->getMessage());
        }
    }
}

?>
