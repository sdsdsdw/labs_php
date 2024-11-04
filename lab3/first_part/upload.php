<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $author = $_POST['author'];
    $title = $_POST['title'];
    $publisher = $_POST['publisher'];
    $pages = $_POST['pages'];
    $format = $_POST['format'];
    
    $file = $_FILES['file'];

    if ($file['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $file['tmp_name'];
        $fileName = basename($file['name']);
        $fileSize = $file['size'];
        $fileType = $file['type'];
        
        $allowedFormats = ['application/pdf', 'application/epub+zip', 'application/x-mobipocket-ebook'];

        if (in_array($fileType, $allowedFormats)) {
            $uploadDir = 'uploads/';
            $destPath = $uploadDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                echo "Файл успішно завантажено!<br>";
                echo "Інформація про книгу:<br>";
                echo "Автор: " . htmlspecialchars($author) . "<br>";
                echo "Назва: " . htmlspecialchars($title) . "<br>";
                echo "Видавництво: " . htmlspecialchars($publisher) . "<br>";
                echo "Кількість сторінок: " . htmlspecialchars($pages) . "<br>";
                echo "Формат файлу: " . htmlspecialchars($format) . "<br>";
                echo "Шлях до файлу: " . htmlspecialchars($destPath) . "<br>";
            } else {
                echo "Помилка під час переміщення файлу.";
            }
        } else {
            echo "Невірний формат файлу.";
        }
    } else {
        echo "Помилка під час завантаження файлу.";
    }
}
