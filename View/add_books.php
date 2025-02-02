<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* General Page Styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            background: #2c3e50;
            color: #fff;
            padding: 20px;
            position: fixed;
            height: 100vh;
            top: 0;
            left: 0;
            box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.2);
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 22px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #fff;
            display: flex;
            align-items: center;
            font-size: 16px;
            transition: 0.3s;
        }

        .sidebar ul li a:hover {
            color: #1abc9c;
        }

        .sidebar ul li a i {
            margin-right: 10px;
        }

        /* Content Section */
        .content {
            margin-left: 270px;
            padding: 20px;
            flex-grow: 1;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            width: calc(100% - 270px);
        }

        .dashboard-header {
            font-size: 24px;
            font-weight: bold;
            padding: 10px 0;
            color: #2c3e50;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Add Book Form Styling */
        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 20px auto;
        }

        .form-container label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }

        .form-container input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container button {
            background: #2c3e50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 10px;
        }

        .form-container button:hover {
            background: #1abc9c;
        }

        /* Alert Styling */
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="add_books.php"><i class="fas fa-book"></i> Add Books</a></li>
            <li><a href="manage_users.php"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="orders.php"><i class="fas fa-shopping-cart"></i> Orders</a></li>
            <li><a href="contact_admin.php"><i class="fas fa-envelope"></i> Contact</a></li>
        </ul>
    </div>

    <div class="content">
        <div class="dashboard-header">Add New Book</div>

         <!-- Display error or success messages -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success']; ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- Add Book Form -->
        <div class="form-container">
            <form action="../Controller/BookController.php" method="POST">
                <label for="name">Book Name:</label>
                <input type="text" id="name" name="name" required><br>

                <label for="author">Author:</label>
                <input type="text" id="author" name="author" required><br>

                <label for="image">Image Path:</label>
                <input type="text" id="image" name="image" required><br>

                <label for="category">Category:</label>
                <input type="text" id="category" name="category"><br>

                <label for="price">Price:</label>
                <input type="number" step="0.01" id="price" name="price" required><br>

                <button type="submit">Add Book</button>
            </form>
        </div>
    </div>
</body>
</html>
