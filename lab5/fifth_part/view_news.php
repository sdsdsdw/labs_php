<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Новини</title>
</head>
<body>
    <h2>Останні новини</h2>
    <a href="index.php">Додати новину</a>
    <hr>

    <?php
    $filename = "news.txt";
    $max_news_count = 5;
    
    if (file_exists($filename)) {
        $news = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $news_entries = array_reverse(array_chunk($news, 4));

        $displayed_count = 0;
        foreach ($news_entries as $entry) {
            if ($displayed_count >= $max_news_count) break;

            echo "<p><strong>" . htmlspecialchars($entry[1]) . "</strong><br>";
            echo "<em>" . htmlspecialchars($entry[0]) . "</em><br>";
            echo htmlspecialchars($entry[2]) . "</p><hr>";
            
            $displayed_count++;
        }
    } else {
        echo "<p>Новин ще немає.</p>";
    }
    ?>
</body>
</html>