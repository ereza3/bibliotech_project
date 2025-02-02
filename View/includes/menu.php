<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="header">
    <div class="container">
        <img src="../images/logo.png" alt="Logo Image">
        <nav class="nav">
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="about-us.php">ABOUT US</a></li>
                <li><a href="categories.php">BOOKS</a></li>
                <li><a href="contact.php">CONTACT</a></li>
                <li><a href="cart.php">CART</a></li>

                <?php if (isset($_SESSION['user_id'])) : ?>
                    <?php if ($_SESSION['user_role'] === 'admin') : ?>
                        <li><a href="admin_dashboard.php">ADMIN DASHBOARD</a></li>
                    <?php endif; ?>
                    <li><a href="../Controller/AuthController.php?action=logout" class="logout-btn">LOGOUT</a></li>
                <?php else : ?>
                    <li><a href="login.php" class="login-btn">LOGIN</a></li>
                    <li><a href="register.php" class="signup-btn">SIGN UP</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
