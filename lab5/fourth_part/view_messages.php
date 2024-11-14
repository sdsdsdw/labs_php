<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Форум - Повідомлення</title>
</head>
<body>
    <h2>Повідомлення форуму</h2>
    <a href="index.php">Додати нове повідомлення</a>
    <hr>

    <?php
    $filename = "messages.txt";
    
    if (file_exists($filename)) {
        $messages = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        foreach ($messages as $msg) {
            echo "<p>" . nl2br(htmlspecialchars($msg)) . "</p><hr>";
        }
    } else {
        echo "<p>Повідомлень ще немає.</p>";
    }
    ?>
</body>
</html>
