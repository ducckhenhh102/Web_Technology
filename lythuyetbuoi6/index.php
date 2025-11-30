<?php
require_once 'BookManager.php';

// Kết nối CSDL
$db = new Database();
$bookManager = new BookManager($db);
$books = $bookManager->getAllBooks();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Library Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Book List</h2>
    <a href="add_book.php" class="btn-add">+ Add New Book</a> 
    <ul class="book-list">
        <?php foreach ($books as $book): ?>
            <li class="book-item">
                <div class="book-info">
                    <strong><?php echo htmlspecialchars($book['Title']); ?></strong>
                    <?php echo htmlspecialchars($book['Genre']); ?> 
                    (<?php echo htmlspecialchars($book['PublishedYear']); ?>)
                </div>       
                <a href="delete_book.php?id=<?php echo $book['BookID']; ?>" class="btn-delete">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php if (empty($books)): ?>
        <p style="text-align: center; color: #999;">No books available.</p>
    <?php endif; ?>
</div>

</body>
</html>