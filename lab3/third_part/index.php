<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Завантаження статті</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h2 class="title">Завантаження статті</h2>

<div class="form-container">
    <form action="upload_article.php" method="POST" enctype="multipart/form-data">
        <label for="author">Автор статті:</label>
        <input type="text" id="author" name="author" required>

        <label for="description">Опис статті:</label>
        <textarea id="description" name="description" rows="4" required></textarea>

        <label for="journal">Журнал, у якому була надрукована стаття:</label>
        <input type="text" id="journal" name="journal" required>

        <label for="pages">Кількість сторінок:</label>
        <input type="number" id="pages" name="pages" min="1" required>

        <label for="year">Рік видання:</label>
        <input type="number" id="year" name="year" min="1900" max="2099" required>

        <label for="format">Формат файлу:</label>
        <select id="format" name="format" required>
            <option value="pdf">PDF</option>
            <option value="doc">DOC</option>
            <option value="docx">DOCX</option>
        </select>

        <label for="file">Виберіть файл:</label>
        <input type="file" id="file" name="file" required>

        <input type="submit" value="Завантажити статтю">
    </form>
</div>

</body>
</html>
