<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Завантаження електронного підручника</title>
</head>
<body>

<h2 class="title">Завантаження електронного підручника</h2>

<div class="form-container">
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="author">Автор книги:</label>
        <input type="text" id="author" name="author" required>

        <label for="title">Назва книги:</label>
        <input type="text" id="title" name="title" required>

        <label for="publisher">Видавництво:</label>
        <input type="text" id="publisher" name="publisher" required>

        <label for="pages">Кількість сторінок:</label>
        <input type="number" id="pages" name="pages" min="1" required>

        <label for="format">Формат файлу:</label>
        <select id="format" name="format" required>
            <option value="pdf">PDF</option>
            <option value="epub">EPUB</option>
            <option value="mobi">MOBI</option>
        </select>

        <label for="file">Виберіть файл:</label>
        <input type="file" id="file" name="file" required>

        <input type="submit" value="Завантажити">
    </form>
</div>

</body>
</html>
