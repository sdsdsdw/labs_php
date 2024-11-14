<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $message = htmlspecialchars($_POST['message']);
    
    $date = date("Y-m-d H:i:s");
    $entry = "[$date] $username: $message\n";
    
    file_put_contents("messages.txt", $entry, FILE_APPEND | LOCK_EX);
    
    header("Location: view_messages.php");
    exit();
} else {
    echo "Неправильний метод запиту.";
}
?>
