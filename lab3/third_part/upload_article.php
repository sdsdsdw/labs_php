<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $author = $_POST['author'];
    $description = $_POST['description'];
    $journal = $_POST['journal'];
    $pages = $_POST['pages'];
    $year = $_POST['year'];
    $format = $_POST['format'];

    $targetDir = "uploads/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    $allowedFormats = array('pdf', 'doc', 'docx');
    if (in_array($fileType, $allowedFormats)) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            echo "<h2>Стаття успішно завантажена!</h2>";
            echo "<p><strong>Автор:</strong> $author</p>";
            echo "<p><strong>Опис:</strong> $description</p>";
            echo "<p><strong>Журнал:</strong> $journal</p>";
            echo "<p><strong>Кількість сторінок:</strong> $pages</p>";
            echo "<p><strong>Рік видання:</strong> $year</p>";
            echo "<p><strong>Формат файлу:</strong> $format</p>";
            echo "<p><strong>Файл:</strong> <a href='" . $targetFilePath . "'>Завантажений файл</a></p>";
        } else {
            echo "<h2>Виникла помилка при завантаженні файлу. Спробуйте ще раз.</h2>";
        }
    } else {
        echo "<h2>Недопустимий формат файлу. Будь ласка, завантажте файл у форматі PDF, DOC або DOCX.</h2>";
    }
} else {
    echo "<h2>Форма не була відправлена.</h2>";
}

