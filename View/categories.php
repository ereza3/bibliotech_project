<?php
if (file_exists(__DIR__ . '/includes/menu.php')) {
    require_once(__DIR__ . '/includes/menu.php');
} else {
    echo "Menu file not found.";
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include necessary files
require_once __DIR__ . '/../Repository/BookRepository.php';

// Get selected category
$category = isset($_GET['category']) ? trim($_GET['category']) : 'Biography';

// Instantiate the BookRepository
$bookRepo = new BookRepository();
$books = $bookRepo->getBooksByCategory($category);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-container {
            flex-grow: 1;
            max-width: 1200px;
            margin: 20px auto;
            display: flex;
            gap: 20px;
            padding-bottom: 200px;
            padding-top:50px;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            background: #000;
            color: white;
            padding: 20px;
            border-radius: 10px;
            height: fit-content;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            text-align: center;
            font-size: 22px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 10px 0;
            text-align: center;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
            display: block;
            padding: 10px;
            background: #333;
            border-radius: 5px;
            transition: 0.3s;
        }

        .sidebar ul li a:hover {
            background: #b195bf;
        }

        /* Content Section */
        .content {
            flex-grow: 1;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            padding-top: 30px;  /* Added padding */
            padding-bottom: 30px; /* Added padding */
        }

        .category-header {
            font-size: 24px;
            font-weight: bold;
            padding: 10px 0;
            color: #b195bf;
            text-transform: uppercase;
            text-align: center;
        }

        /* Book Grid */
        .book-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .book-card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .book-card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .book-card h3 {
            margin: 10px 0;
            font-size: 18px;
            color: #b195bf;
        }

        .book-card p {
            color: #555;
        }

        .book-card .price {
            font-weight: bold;
            color: #b195bf;
            margin-top: 10px;
        }

        /* Show Details Button */
        .book-card .details-btn {
            display: block;
            margin-top: 10px;
            padding: 8px;
            background: #b195bf;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
        }

        .book-card .details-btn:hover {
            background: #b195bf;
        }

        /* Footer Styling */
     

        /* Responsive Design */
        @media (max-width: 992px) {
            .main-container {
                flex-direction: column;
                align-items: center;
            }
            
            .sidebar {
                width: 100%;
                text-align: center;
            }

            .book-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .book-grid {
                grid-template-columns: repeat(1, 1fr);
            }
        }
    </style>
</head>
<body>

    <div class="main-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Categories</h2>
            <ul>
                <li><a href="categories.php?category=Biography">Biography</a></li>
                <li><a href="categories.php?category=Romance">Romance</a></li>
                <li><a href="categories.php?category=Psychology">Psychology</a></li>
            </ul>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="category-header"><?= htmlspecialchars($category) ?> Books</div>

            <div class="book-grid">
                <?php if (count($books) > 0): ?>
                    <?php foreach (array_slice($books, 0, 6) as $book): ?>
                        <div class="book-card">
                            <img src="../<?= htmlspecialchars($book->getImage()) ?>" alt="<?= htmlspecialchars($book->getName()) ?>">
                            <h3><?= htmlspecialchars($book->getName()) ?></h3>
                            <p><strong>Author:</strong> <?= htmlspecialchars($book->getAuthor()) ?></p>
                            <p class="price">$<?= number_format($book->getPrice(), 2) ?></p>
                            <a href="book_template.php?id=<?= htmlspecialchars($book->getId()) ?>" class="details-btn">Show Details</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="text-align: center; width: 100%;">No books found in this category.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php
if (file_exists(__DIR__ . '/includes/footer.php')) {
    require_once(__DIR__ . '/includes/footer.php');
} else {
    echo "<div class='footer'>Footer file not found.</div>";
}
?>
</body>
</html>
