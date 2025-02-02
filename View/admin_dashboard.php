<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
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
    </style>
</head>

<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

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
        <div class="dashboard-header">Welcome to the Admin Dashboard</div>
        <p>Use the sidebar to navigate through the different sections.</p>
    </div>
</body>


</html>
