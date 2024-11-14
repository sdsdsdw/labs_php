<?php
include '../third_part/header_login.inc';
include '../third_part/db_connection.php';

if (!isset($_SESSION['user_id'])) {
    echo "Ви повинні увійти в систему для додавання книг.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['title']) || empty($_POST['author']) || empty($_POST['publishing']) || 
        empty($_POST['year']) || empty($_POST['n_pages']) || empty($_POST['format']) || 
        empty($_FILES['book_file']['name'])) {
        
        echo "Всі поля мають бути заповнені.";
    } else {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $publishing = $_POST['publishing'];
        $year = $_POST['year'];
        $n_pages = $_POST['n_pages'];
        $format = $_POST['format'];
        $uploadDir = 'library/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = basename($_FILES['book_file']['name']);
        $targetFilePath = $uploadDir . $fileName;

        if (file_exists($targetFilePath)) {
            echo "Файл з такою назвою вже існує. Будь ласка, перейменуйте файл.";
        } elseif (move_uploaded_file($_FILES['book_file']['tmp_name'], $targetFilePath)) {
            $stmt = $pdo2->prepare("INSERT INTO library (title, author, publishing, year, n_pages, format, path) 
                                    VALUES (:title, :author, :publishing, :year, :n_pages, :format, :path)");
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':author', $author, PDO::PARAM_STR);
            $stmt->bindParam(':publishing', $publishing, PDO::PARAM_STR);
            $stmt->bindParam(':year', $year, PDO::PARAM_INT);
            $stmt->bindParam(':n_pages', $n_pages, PDO::PARAM_INT);
            $stmt->bindParam(':format', $format, PDO::PARAM_STR);
            $stmt->bindParam(':path', $targetFilePath, PDO::PARAM_STR);

            if ($stmt->execute()) {
                echo "Книгу успішно додано до бібліотеки!";
            } else {
                echo "Помилка додавання книги до бази даних.";
            }
        } else {
            echo "Помилка завантаження файлу книги.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Додати книгу</title>
</head>
<body>
    <h1>Додати книгу в бібліотеку</h1>
    <form action="addbook.php" method="POST" enctype="multipart/form-data">
        <label for="title">Назва книги:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="author">Автор:</label>
        <input type="text" id="author" name="author" required><br><br>

        <label for="publishing">Видавництво:</label>
        <input type="text" id="publishing" name="publishing" required><br><br>

        <label for="year">Рік видання:</label>
        <input type="number" id="year" name="year" required><br><br>

        <label for="n_pages">Кількість сторінок:</label>
        <input type="number" id="n_pages" name="n_pages" required><br><br>

        <label for="format">Формат:</label>
        <input type="text" id="format" name="format" required><br><br>

        <label for="book_file">Файл книги:</label>
        <input type="file" id="book_file" name="book_file" required><br><br>

        <button type="submit">Додати книгу</button>
    </form>

    <form action="library.php" method="get" style="margin-top: 20px;">
        <button type="submit">Переглянути всі книги</button>
    </form>
</body>
</html>
