<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

if (isset($_SESSION['error'])) {
    echo '<div class="error">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']); // Clear the error after displaying it
}


if (isset($_SESSION['success'])) {
    echo '<div class="success">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']); // Clear the success message after displaying it
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
  <div class="register-form-container">
    <form action="/bibliotech_project/Controller/AuthController.php?action=register" method="post">
      <h2>Register</h2>

      <input type="text" name="name" placeholder="First Name" required>
      <input type="text" name="surname" placeholder="Last Name" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="text" name="phone" placeholder="Phone Number" required>
      <input type="password" name="password" placeholder="Password" required>

      <button type="submit">Register</button>

      <p class="login-link">Already have an account? <a href="login.php">Login</a></p>
    </form>
  </div>
</body>
</html>
<style>
    /* Centering the Register Form */
.register-form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Full page height */
}

/* Register Form Styles */
form {
    background: rgba(0, 0, 0, 0.7);
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    width: 320px;
    text-align: center;
    color: white;
}

/* Input Fields */
form input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    outline: none;
}

form input::placeholder {
    color: #bbb;
}

/* Register Button */
form button {
    background-color: #ce1dd1;
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    border-radius: 5px;
    font-size: 18px;
    width: 100%;
    transition: background 0.3s;
}

form button:hover {
    background-color: #49094a;
}

/* Login Link */
.login-link {
    margin-top: 15px;
    font-size: 14px;
}

.login-link a {
    color: #ce1dd1;
    text-decoration: none;
}

.login-link a:hover {
    text-decoration: underline;
}

.error {
    color: red;
    background-color: #f8d7da;
    padding: 10px;
    margin-bottom: 15px;
}

.success {
    color: green;
    background-color: #d4edda;
    padding: 10px;
    margin-bottom: 15px;
}


    </style>