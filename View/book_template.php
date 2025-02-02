
<?php


if (file_exists(__DIR__ . '/includes/menu.php')) {
  require_once(__DIR__ . '/includes/menu.php');
} else {
  echo "Menu file not found.";
}


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include necessary files for the database and model
require_once __DIR__ . '/../Repository/BookRepository.php';
require_once __DIR__ . '/../Model/Book.php';
require_once __DIR__ . '/../Controller/CartController.php';

// Get the book ID from the URL or query string (for example, book_template.php?id=1)
$bookId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Instantiate the BookRepository
$bookRepo = new BookRepository();
$book = $bookRepo->getBookById($bookId);

if (!$book) {
    // If no book found, redirect or show an error message
    $_SESSION['error'] = "Book not found!";
    header('Location: ../View/index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
     
        .book-details {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding: 50px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .book-image {
            width: 40%;
            max-width: 300px;
        }

        .book-image img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .book-info {
            width: 55%;
        }

        .book-info h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .book-info p {
            font-size: 18px;
            margin-bottom: 15px;
            color: #555;
        }

        .book-info p span {
            font-weight: bold;
            color: #2c3e50;
        }
    </style>
</head>

<body>
 

    <div class="content">
      

        <div class="book-details">
            <!-- Book Image -->
            <div class="book-image">
                <img src="../<?= htmlspecialchars($book->getImage()) ?>" alt="Book Image">
            </div>

            <!-- Book Information -->
            <div class="book-info">
                <h2><?= htmlspecialchars($book->getName()) ?></h2>
                <p><span>Author:</span> <?= htmlspecialchars($book->getAuthor()) ?></p>
                <p><span>Category:</span> <?= htmlspecialchars($book->getCategory() ? $book->getCategory() : 'N/A') ?></p>
                <p><span>Price:</span> $<?= htmlspecialchars(number_format($book->getPrice(), 2)) ?></p>
                <label for="quantity">Quantity:</label>
<input type="number" id="quantity" value="1" min="1" max="10" />
<button id="add-to-cart-btn" data-id="<?= htmlspecialchars($book->getId()) ?>" data-name="<?= htmlspecialchars($book->getName()) ?>" data-price="<?= htmlspecialchars($book->getPrice()) ?>">Add to Cart</button>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if (file_exists(__DIR__ . '/includes/footer.php')) {
  require_once(__DIR__ . '/includes/footer.php');
} else {
  echo "Footer file not found.";
}

?>


<script>
document.getElementById('add-to-cart-btn').addEventListener('click', function() {
    var bookId = this.getAttribute('data-id');
    var bookName = this.getAttribute('data-name');
    var bookPrice = this.getAttribute('data-price');
    var quantity = document.getElementById('quantity').value;

    if (quantity <= 0) {
        alert('Please select a valid quantity');
        return;
    }

    // Make an AJAX request to add the book to the cart
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../Controller/CartController.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            alert(response.message);
        } else {
            alert('Error adding book to cart');
        }
    };

    // Send the AJAX request with the necessary data (action, book details, and quantity)
    xhr.send('action=add_to_cart&book_id=' + bookId + '&book_name=' + encodeURIComponent(bookName) + '&book_price=' + bookPrice + '&quantity=' + quantity);
});

</script>
