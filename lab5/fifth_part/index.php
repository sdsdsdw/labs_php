<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>lab5v5</title>
</head>
<body>
    <h2>Додати новину</h2>
    <form action="save_news.php" method="POST">
        <label for="title">Заголовок:</label><br>
        <input type="text" id="title" name="title" required><br><br>
        
        <label for="content">Текст новини:</label><br>
        <textarea id="content" name="content" rows="5" required></textarea><br><br>
        
        <input type="submit" value="Надіслати">
    </form>
    <br>
    <a href="view_news.php">Переглянути всі новини</a>
</body>
</html>

