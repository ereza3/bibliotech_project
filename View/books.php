<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Bookstore</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .content-container {
            display: flex; 
            justify-content: space-between; 
            align-items: flex-start; 
            gap: 20px; 
            margin: 40px auto; 
            max-width: 1200px; 
        }

        .content-left {
            flex: 1; 
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .content-right {
            flex-basis: 20%; 
            padding: 20px;
            background-color: #f4f4f4;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .content-right h3 {
            margin-bottom: 15px;
            color: #333;
        }

        .content-right ul {
            list-style: none;
            padding: 0;
        }

        .content-right ul li {
            margin-bottom: 10px;
        }

        .content-right ul li a {
            text-decoration: none;
            color: #555;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .content-right ul li a:hover {
            color: #54146e;
        }

        .content-left h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        .book-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr); 
            gap: 20px; 
            margin-top: 20px;
        }

        .book {
            position: relative;
            text-align: center;
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .book:hover {
            transform: scale(1.05);
        }

        .book img {
            width: 200px;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
            transition: filter 0.3s ease;
        }

        .book img.clicked {
            filter: brightness(70%);
        }

        .book p {
            font-size: 1rem;
            color: #54146e;
            font-weight: 600;
            transition: font-size 0.3s ease;
        }

        .book p.title.clicked {
            font-size: 1.2rem; 
            font-weight: bold;
        }
    </style>
</head>
<body>
<?php
if (file_exists('includes/menu.php')) {
    require_once('includes/menu.php');
} else {
    echo "Books not found.";
}
?>

<main class="main-content">
    <div class="content-container">
        <div class="content-left">
            <h2>Biography</h2>
            <div class="book-grid">
                <div class="book">
                    <img src="images/cleopatra.jpg" alt="Book 1">
                    <p class="title">Cleopatra: A Life</p>
                    <p><i>A Life is a biography of Cleopatra, the last queen of Egypt, who ruled from 51 to 30 BC. The book aims to separate fact from fiction and shed light on the woman behind the myths and legends that have surrounded her for centuries.</i></p>
                </div>
                <div class="book">
                    <img src="images/mind.jpg" alt="Book 2">
                    <p class="title">Into The Wild</p>
                    <p><i> The Wild is a 1996 non-fiction book written by Jon Krakauer. Into the Wild is an international bestseller which has been printed in 30 languages and 173 editions and formats.</i></p>
                </div>
                <div class="book">
                    <img src="images/sylvia.jpg" alt="Book 3">
                    <p class="title">My Beautiful Mind</p>
                    <p><i>A Beautiful Mind is a 1998 unauthorized biography of Nobel Prize-winning economist and mathematician John Nash by Sylvia Nasar, professor of journalism at Columbia University.</i></p>
                </div>
                <div class="book">
                    <img src="images/mao.jpg" alt="Book 4">
                    <p class="title">Mao: The Unknown Story</p>
                    <p><i>Mao: The Unknown Story is a 2005 biography of the Chinese communist leader Mao Zedong (1893-1976) that was written by the husband-and-wife team of the writer Jung Chang and the historian Jon Halliday, who detail Mao's early life, his introduction to the Chinese Communist Party, and his political career.</i></p>
                </div>
            </div>
        </div>
        <aside class="content-right">
            <h3>Categories</h3>
            <ul>
                <li><a href="books.html">Biography</a></li>
                <li><a href="psychology.html">Psychology</a></li>
                <li><a href="romance.html">Romance</a></li>
            </ul>
        </aside>
    </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const books = document.querySelectorAll(".book");

        books.forEach((book) => {
            book.addEventListener("click", () => {
                const img = book.querySelector("img");
                const title = book.querySelector("p:first-of-type");
                img.classList.toggle("clicked");
                title.classList.toggle("clicked");
            });
        });
    });
</script>
</body>
<?php
if (file_exists('includes/footer.php')) {
    require_once('includes/footer.php');
} else {
    echo "Footer file not found.";
}
?>
</html>
