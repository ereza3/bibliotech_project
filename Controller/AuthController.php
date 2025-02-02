<?php
require_once __DIR__ . '/../Repository/UserRepository.php';
require_once __DIR__ . '/../Database/dbconnection.php';

class AuthController {
    private $userRepo;

    public function __construct() {
        session_start();
        $this->userRepo = new UserRepository();

        // Check for "Remember Me" cookie
        if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_me'])) {
            $this->autoLogin();
        }
    }


    
    public function handleRequest() {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'register':
                    $this->register();
                    break;
                case 'login':
                    $this->login();
                    break;
                case 'logout':
                    $this->logout();
                    break;
                case 'addAdmin':
                    $this->addAdminUser();
                    break;
                default:
                    echo "Invalid action.";
            }
        } else {
            echo "No action specified.";
        }
    }

    public function addAdminUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['phone'], $_POST['password'])) {
                $_SESSION['error'] = "Missing required fields!";
                header("Location: ../View/manage_users.php");
                exit();
            }

            $name = trim($_POST['name']);
            $surname = trim($_POST['surname']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
            $password = $_POST['password'];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Invalid email format!";
                header("Location: ../View/manage_users.php");
                exit();
            }

            if (strlen($password) < 6) {
                $_SESSION['error'] = "Password must be at least 6 characters!";
                header("Location: ../View/manage_users.php");
                exit();
            }

            if ($this->userRepo->findUserByEmail($email)) {
                $_SESSION['error'] = "Email already taken!";
                header("Location: ../View/manage_users.php");
                exit();
            }

            if ($this->userRepo->addAdminUser($name, $surname, $email, $phone, $password)) {
                $_SESSION['success'] = "Admin user added successfully!";
            } else {
                $_SESSION['error'] = "Failed to add admin!";
            }

            header("Location: ../View/manage_users.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid request!";
            header("Location: ../View/manage_users.php");
            exit();
        }
    }


private function validateCSRF() {
    if (!isset($_SESSION['csrf_token'])) {
        die("CSRF token is missing from session.");
    }

    if (!isset($_POST['csrf_token'])) {
        die("CSRF token is missing from form.");
    }

    echo "<pre>";
    echo "Session CSRF: " . $_SESSION['csrf_token'] . "<br>";
    echo "Form CSRF: " . $_POST['csrf_token'] . "<br>";
    echo "</pre>";

    if (hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']) === false) {
        die("CSRF token validation failed.");
    }

    unset($_SESSION['csrf_token']); // Invalidate token after use
}


public function register() {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Check required fields
        if (!isset($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['phone'], $_POST['password'])) {
            $_SESSION['error'] = "Missing fields!";
            header("Location: ../View/register.php");
            exit();
        }

        // Sanitize input
        $name = trim($_POST['name']);
        $surname = trim($_POST['surname']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $password = $_POST['password'];

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Invalid email format!";
            header("Location: ../View/register.php");
            exit();
        }

        // Password validation
        if (strlen($password) < 6) {
            $_SESSION['error'] = "Password is too weak!";
            header("Location: ../View/register.php");
            exit();
        }

        // Check if email already exists
        if ($this->userRepo->findUserByEmail($email)) {
            $_SESSION['error'] = "Email already taken!";
            header("Location: ../View/register.php");
            exit();
        }

        // Create user object
        $user = new User($name, $surname, $email, $phone, $password);

        // Register user
        if ($this->userRepo->registerUser($user)) {
            $_SESSION['success'] = "Registration successful!";
            header("Location: ../View/login.php");
            exit();
        } else {
            $_SESSION['error'] = "Registration failed!";
            header("Location: ../View/register.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Invalid request!";
        header("Location: ../View/register.php");
        exit();
    }
}

public function login() {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['email'], $_POST['password'])) {
            $_SESSION['error'] = "Missing fields!";
            header("Location: ../View/login.php");
            exit();
        }

        $email = trim($_POST['email']);
        $password = $_POST['password'];

        // Fetch user from database
        $user = $this->userRepo->findUserByEmail($email);

        if (!$user) {
            $_SESSION['error'] = "User not found!";
            header("Location: ../View/login.php");
            exit();
        }

        // Verify password
        if (!password_verify($password, $user['password'])) {
            $_SESSION['error'] = "Incorrect password!";
            header("Location: ../View/login.php");
            exit();
        }

        // Start session and store user data
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];

        // Handle "Remember Me" feature
        if (isset($_POST['remember_me'])) {
            $token = bin2hex(random_bytes(32)); // Generate secure token
            setcookie("remember_me", $token, time() + (86400 * 30), "/"); // Store in cookie for 30 days
            $this->userRepo->storeRememberToken($user['id'], $token);
        }

        // Redirect based on role
        if ($user['role'] === 'admin') {
            header("Location: ../View/admin_dashboard.php");
        } else {
            header("Location: ../View/index.php");
        }
        exit();
    } else {
        $_SESSION['error'] = "Invalid request!";
        header("Location: ../View/login.php");
        exit();
    }
}
    
 private function autoLogin() {
        $token = $_COOKIE['remember_me'] ?? '';

        if (!$token) {
            return;
        }

        $user = $this->userRepo->findUserByToken($token);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];
        } else {
            setcookie("remember_me", "", time() - 3600, "/"); // Expire the cookie
        }
    }

    public function logout() {
        session_destroy();
        setcookie("remember_me", "", time() - 3600, "/");
        header("Location: ../View/login.php?success=logged_out");
        exit();
    }
}

$authController = new AuthController();
$authController->handleRequest();
