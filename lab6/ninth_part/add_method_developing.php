<?php
include '../third_part/header_login.inc';
include '../third_part/db_connection.php';

if (!isset($_SESSION['user_id'])) {
    echo "Ви повинні увійти в систему для додавання методичних розробок.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['title']) || empty($_POST['author']) || empty($_POST['description']) ||
        empty($_POST['subject']) || empty($_POST['year']) || empty($_POST['format']) || 
        empty($_FILES['method_file']['name'])) {
        
        echo "Всі поля мають бути заповнені.";
    } else {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $description = $_POST['description'];
        $subject = $_POST['subject'];
        $year = $_POST['year'];
        $format = $_POST['format'];
        $uploadDir = 'method_developing/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = basename($_FILES['method_file']['name']);
        $targetFilePath = $uploadDir . $fileName;

        if (file_exists($targetFilePath)) {
            echo "Файл з такою назвою вже існує. Будь ласка, перейменуйте файл.";
        } elseif (move_uploaded_file($_FILES['method_file']['tmp_name'], $targetFilePath)) {
            $stmt = $pdo2->prepare("INSERT INTO method_developing (title, author, description, subject, year, format, path) 
                                    VALUES (:title, :author, :description, :subject, :year, :format, :path)");
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':author', $author, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
            $stmt->bindParam(':year', $year, PDO::PARAM_INT);
            $stmt->bindParam(':format', $format, PDO::PARAM_STR);
            $stmt->bindParam(':path', $targetFilePath, PDO::PARAM_STR);

            if ($stmt->execute()) {
                echo "Методичну розробку успішно додано!";
            } else {
                echo "Помилка додавання методичної розробки до бази даних.";
            }
        } else {
            echo "Помилка завантаження файлу методичної розробки.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Додати методичну розробку</title>
</head>
<body>
    <h1>Додати методичну розробку</h1>
    <form action="add_method_developing.php" method="POST" enctype="multipart/form-data">
        <label for="title">Назва розробки:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="author">Автор:</label>
        <input type="text" id="author" name="author" required><br><br>

        <label for="description">Опис:</label><br>
        <textarea id="description" name="description" rows="5" cols="50" required></textarea><br><br>

        <label for="subject">Предмет:</label>
        <input type="text" id="subject" name="subject" required><br><br>

        <label for="year">Рік створення:</label>
        <input type="number" id="year" name="year" required><br><br>

        <label for="format">Формат:</label>
        <input type="text" id="format" name="format" required><br><br>

        <label for="method_file">Файл розробки:</label>
        <input type="file" id="method_file" name="method_file" required><br><br>

        <button type="submit">Додати розробку</button>
    </form>

    <!-- Кнопка для переходу на сторінку з усіма розробками -->
    <form action="method_developing.php" method="get" style="margin-top: 20px;">
        <button type="submit">Переглянути всі розробки</button>
    </form>
</body>
</html>
