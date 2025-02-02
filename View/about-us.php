<?php
require_once('../Controller/AboutUsController.php');

$aboutUsController = new AboutUsController();
$aboutUsData = $aboutUsController->showAboutUs();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Bibliotech</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php
if (file_exists('includes/menu.php')) {
    require_once('includes/menu.php');
} else {
    echo "Menu file not found.";
}
?>

<main class="about-container">
    <section class="about-content">
        <h1>About <?php echo htmlspecialchars($aboutUsData['name']); ?></h1>
        <p><strong>Founded in:</strong> <?php echo htmlspecialchars($aboutUsData['year']); ?></p>
        <p><?php echo nl2br(htmlspecialchars($aboutUsData['text'])); ?></p>
    </section>
</main>

<style>
    .about-container {
        width: 80%;
        margin: 0 auto;
        padding: 20px;
        text-align: center;
    }
    .about-content {
        background-color: #f8f8f8;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .about-content h1 {
        color: #634174;
    }
</style>

<?php
if (file_exists('includes/footer.php')) {
    require_once('includes/footer.php');
} else {
    echo "Footer file not found.";
}
?>

</body>
</html>
