<?php
require_once 'BookManager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $bookManager = new BookManager($db);
    
    $title = $_POST['title'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];

    $bookManager->addBook($title, $year, $genre);
    
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container" style="max-width: 500px;">
    <h2>Add Book</h2>
    <form method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required placeholder="Enter book title...">
        
        <label for="year">Published Year:</label>
        <input type="number" id="year" name="year" required placeholder="e.g. 2024">
        
        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" required placeholder="e.g. Fiction">
        
        <input type="submit" value="Add Book">
    </form>
    
    <div style="text-align: center; margin-top: 15px;">
        <a href="index.php" style="color: #666; text-decoration: none;">&larr; Back to list</a>
    </div>
</div>

</body>
</html>