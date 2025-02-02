<?php
// Assuming you have a BookRepository class to handle fetching books from the database
require_once __DIR__ . '/../Repository/BookRepository.php';

// Instantiate the BookRepository
$bookRepo = new BookRepository();

// Get books with IDs 1, 2, and 3
$books = [];
foreach ([1, 2, 3] as $bookId) {
    $books[] = $bookRepo->getBookById($bookId);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Bookstore</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
<?php


if (file_exists(__DIR__ . '/includes/menu.php')) {
  require_once(__DIR__ . '/includes/menu.php');
} else {
  echo "Menu file not found.";
}


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>




  <div class="background"></div>
  <div class="overlay">
    <header class="homepage-header">
      <h1>📖 Welcome to Book Heaven</h1>
      <p>Your next great read awaits!</p>
      <a href="#" class="cta-button" onclick="redirectToBooks()">Shop Now</a>
    </header>
  </div>

  <div class="books-section">
    <h2>Best Sellers!</h2>
    <div class="books-container">
      <div class="book-card">
        <img src="../images/art.jpg" alt="Book 1">
        <h3>The Creative Act</h3>
        <p><i>"The Creative Act: A Way of Being" is a book by Rick Rubin, the legendary music producer known for his influence in the creative arts.</i></p>
      </div>
      <div class="book-card">
        <img src="../images/rule.jpg" alt="Book 2">
        <h3>The Rules Handbook</h3>
        <p><i>"The Rules Handbook" is a dating guide that emphasizes the importance of maintaining mystery and desirability in relationships.</i></p>
      </div>
      <div class="book-card">
        <img src="../images/ell.jpg" alt="Book 3">
        <h3>Pageboy</h3>
        <p><i>"Pageboy" is a coming-of-age memoir by Elliot Page, featuring a series of non-linear vignettes that explore his life starting at age 20.</i></p>
      </div>
    </div>
  </div>

 

  <style>
    body,
    html {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: Arial, sans-serif;
    }

    .background {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('../images/biblo2.jpg') no-repeat center center fixed;
      background-size: cover;
      filter: blur(8px);
      z-index: -1;
    }

    .overlay {
      position: relative;
      z-index: 1;
      text-align: center;
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      height: 100vh;
      background-color: rgba(0, 0, 0, 0.6);
    }

    .cta-button {
      display: inline-block;
      padding: 10px 20px;
      font-size: 1.2rem;
      color: white;
      background-color: #ce1dd1;
      text-decoration: none;
      border-radius: 5px;
      margin-top: 20px;
      transition: 0.3s;
    }

    .cta-button:hover {
      background-color: #49094a;
    }

    .books-section {
      text-align: center;
      padding: 50px 20px;
      background-color: #f9f9f9;
    }

    .books-section h2 {
      font-size: 2rem;
      margin-bottom: 20px;
      color: #49094a;
    }

    .books-container {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      gap: 20px;
      flex-wrap: wrap;
    }

    .book-card {
      background-color: #fff;
      width: 300px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      border-radius: 8px;
      overflow: hidden;
      text-align: left;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .book-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    }

    .book-card img {
      width: 100%;
      height: auto;
      transition: transform 0.3s;
    }

    .book-card:hover img {
      transform: scale(1.05);
    }

    .book-card h3 {
      margin: 15px 10px 5px;
      color: #49094a;
    }

    .book-card p {
      margin: 0 10px 15px;
      font-size: 0.9rem;
      color: #333;
    }
  </style>

  <script>
    function redirectToBooks() {
      window.location.href = 'categories.php';
    }
  </script>
</body>
<?php
if (file_exists(__DIR__ . '/includes/footer.php')) {
  require_once(__DIR__ . '/includes/footer.php');
} else {
  echo "Footer file not found.";
}

?>

</html>
