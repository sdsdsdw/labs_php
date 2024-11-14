<?php
include '../third_part/header_login.inc';
include '../third_part/db_connection.php';

if (!isset($_SESSION['user_id'])) {
    echo "Ви повинні увійти в систему для додавання статей.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['title']) || empty($_POST['author']) || empty($_POST['description']) || 
        empty($_POST['magazine']) || empty($_POST['year']) || empty($_POST['n_pages']) || 
        empty($_POST['format']) || empty($_FILES['article_file']['name'])) {
        
        echo "Всі поля мають бути заповнені.";
    } else {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $description = $_POST['description'];
        $magazine = $_POST['magazine'];
        $year = $_POST['year'];
        $n_pages = $_POST['n_pages'];
        $format = $_POST['format'];
        $uploadDir = 'articles/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = basename($_FILES['article_file']['name']);
        $targetFilePath = $uploadDir . $fileName;

        if (file_exists($targetFilePath)) {
            echo "Файл з такою назвою вже існує. Будь ласка, перейменуйте файл.";
        } elseif (move_uploaded_file($_FILES['article_file']['tmp_name'], $targetFilePath)) {
            $stmt = $pdo2->prepare("INSERT INTO articles (title, author, description, magazine, year, n_pages, format, path) 
                                    VALUES (:title, :author, :description, :magazine, :year, :n_pages, :format, :path)");
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':author', $author, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':magazine', $magazine, PDO::PARAM_STR);
            $stmt->bindParam(':year', $year, PDO::PARAM_INT);
            $stmt->bindParam(':n_pages', $n_pages, PDO::PARAM_INT);
            $stmt->bindParam(':format', $format, PDO::PARAM_STR);
            $stmt->bindParam(':path', $targetFilePath, PDO::PARAM_STR);

            if ($stmt->execute()) {
                echo "Статтю успішно додано до бібліотеки!";
            } else {
                echo "Помилка додавання статті до бази даних.";
            }
        } else {
            echo "Помилка завантаження файлу статті.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Додати статтю</title>
</head>
<body>
    <h1>Додати статтю до бібліотеки</h1>
    <form action="addarticle.php" method="POST" enctype="multipart/form-data">
        <label for="title">Назва статті:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="author">Автор:</label>
        <input type="text" id="author" name="author" required><br><br>

        <label for="description">Опис:</label><br>
        <textarea id="description" name="description" rows="5" cols="50" required></textarea><br><br>

        <label for="magazine">Журнал:</label>
        <input type="text" id="magazine" name="magazine" required><br><br>

        <label for="year">Рік видання:</label>
        <input type="number" id="year" name="year" required><br><br>

        <label for="n_pages">Кількість сторінок:</label>
        <input type="number" id="n_pages" name="n_pages" required><br><br>

        <label for="format">Формат:</label>
        <input type="text" id="format" name="format" required><br><br>

        <label for="article_file">Файл статті:</label>
        <input type="file" id="article_file" name="article_file" required><br><br>

        <button type="submit">Додати статтю</button>
    </form>

    <form action="articles.php" method="get" style="margin-top: 20px;">
        <button type="submit">Переглянути всі статті</button>
    </form>
</body>
</html>
