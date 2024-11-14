<?php
include '../third_part/header_login.inc';
include '../third_part/db_connection.php';

if (!isset($_SESSION['user_id'])) {
    echo "Ви повинні увійти в систему для додавання програм.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['title']) || empty($_POST['developer']) || empty($_POST['description']) ||
        empty($_POST['version']) || empty($_POST['release_year']) || empty($_POST['platform']) || 
        empty($_POST['format']) || empty($_FILES['program_file']['name'])) {
        
        echo "Всі поля мають бути заповнені.";
    } else {
        $title = $_POST['title'];
        $developer = $_POST['developer'];
        $description = $_POST['description'];
        $version = $_POST['version'];
        $release_year = $_POST['release_year'];
        $platform = $_POST['platform'];
        $format = $_POST['format'];
        $uploadDir = 'programs/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = basename($_FILES['program_file']['name']);
        $targetFilePath = $uploadDir . $fileName;

        if (file_exists($targetFilePath)) {
            echo "Файл з такою назвою вже існує. Будь ласка, перейменуйте файл.";
        } elseif (move_uploaded_file($_FILES['program_file']['tmp_name'], $targetFilePath)) {
            $stmt = $pdo2->prepare("INSERT INTO programs (title, developer, description, version, release_year, platform, format, path) 
                                    VALUES (:title, :developer, :description, :version, :release_year, :platform, :format, :path)");
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':developer', $developer, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':version', $version, PDO::PARAM_STR);
            $stmt->bindParam(':release_year', $release_year, PDO::PARAM_INT);
            $stmt->bindParam(':platform', $platform, PDO::PARAM_STR);
            $stmt->bindParam(':format', $format, PDO::PARAM_STR);
            $stmt->bindParam(':path', $targetFilePath, PDO::PARAM_STR);

            if ($stmt->execute()) {
                echo "Програму успішно додано до бібліотеки!";
            } else {
                echo "Помилка додавання програми до бази даних.";
            }
        } else {
            echo "Помилка завантаження файлу програми.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Додати програму</title>
</head>
<body>
    <h1>Додати програму до бібліотеки</h1>
    <form action="addprogram.php" method="POST" enctype="multipart/form-data">
        <label for="title">Назва програми:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="developer">Розробник:</label>
        <input type="text" id="developer" name="developer" required><br><br>

        <label for="description">Опис:</label><br>
        <textarea id="description" name="description" rows="5" cols="50" required></textarea><br><br>

        <label for="version">Версія:</label>
        <input type="text" id="version" name="version" required><br><br>

        <label for="release_year">Рік випуску:</label>
        <input type="number" id="release_year" name="release_year" required><br><br>

        <label for="platform">Платформа:</label>
        <input type="text" id="platform" name="platform" required><br><br>

        <label for="format">Формат:</label>
        <input type="text" id="format" name="format" required><br><br>

        <label for="program_file">Файл програми:</label>
        <input type="file" id="program_file" name="program_file" required><br><br>

        <button type="submit">Додати програму</button>
    </form>

    <!-- Кнопка для переходу на сторінку з усіма програмами -->
    <form action="programs.php" method="get" style="margin-top: 20px;">
        <button type="submit">Переглянути всі програми</button>
    </form>
</body>
</html>
