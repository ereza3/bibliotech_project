<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
} // Ensure session is started at the top

require_once('../Controller/ContactController.php');  // Include the controller
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<?php
if (file_exists('includes/menu.php')) {
    require_once('includes/menu.php');
} else {
    echo "Menu file not found.";
}
?>

<main class="contact-container">
    <section class="contact-details">
        <h2>Contact Information</h2>
        <p><strong>Address:</strong> 123 Library Lane, Booktown, BK 45678</p>
        <p><strong>Email:</strong> <a href="mailto:info@bibliotech.com">info@bibliotech.com</a></p>
        <p><strong>Phone:</strong> <a href="tel:+1234567890">(123) 456-7890</a></p>
        <p><strong>Hours:</strong> Mon-Sat: 9:00 AM - 8:00 PM</p>
    </section>

    <section class="contact-form">
        <h2>Get in Touch</h2>

        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="error">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }

        if (isset($_SESSION['success'])) {
            echo '<div class="success">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
        ?>

        <form action="/bibliotech_project/Controller/ContactController.php" method="POST">
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>

            <label for="email">Your Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="message">Your Message</label>
            <textarea id="message" name="message" placeholder="Write your message here..." rows="5" required></textarea>

            <button type="submit">Send Message</button>
        </form>

    </section>
</main>

</body>

<?php
if (file_exists('includes/footer.php')) {
    require_once('includes/footer.php');
} else {
    echo "Footer file not found.";
}
?>
</html>


<style>
    .contact-container {
        display: flex;
        justify-content: space-around;
        align-items: flex-start;
        padding: 20px;
        gap: 20px;
        flex-wrap: wrap;
    }

    .contact-details,
    .contact-form {
        width: 45%;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        padding: 20px;
        border-radius: 8px;
    }

    .contact-details h2,
    .contact-form h2 {
        margin-top: 0;
        color: #634174;
    }

    .contact-details p {
        margin: 10px 0;
    }

    .contact-details a {
        color: #634174;
        text-decoration: none;
    }

    .contact-details a:hover {
        text-decoration: underline;
    }

    .contact-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .contact-form input,
    .contact-form textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .contact-form button {
        display: inline-block;
        padding: 10px 15px;
        background-color: #634174;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
    }

    .contact-form button:hover {
        background-color: #543719;
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

</body>

<?php
if (file_exists('includes/footer.php')) {
    require_once('includes/footer.php');
} else {
    echo "Footer file not found.";
}
?>
</html>
