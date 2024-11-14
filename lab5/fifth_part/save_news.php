<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    
    $date = date("Y-m-d H:i:s");
    $entry = "[$date]\n$title\n$content\n---\n";
    
    file_put_contents("news.txt", $entry, FILE_APPEND | LOCK_EX);
    
    header("Location: view_news.php");
    exit();
} else {
    echo "Неправильний метод запиту.";
}
?>
