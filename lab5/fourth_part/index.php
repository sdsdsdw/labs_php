<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>lab5v4</title>
</head>
<body>
    <h2>Додати нове повідомлення</h2>
    <form action="save_message.php" method="POST">
        <label for="username">Ім'я:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="message">Повідомлення:</label><br>
        <textarea id="message" name="message" rows="4" required></textarea><br><br>
        
        <input type="submit" value="Надіслати">
    </form>
    <br>
    <a href="view_messages.php">Переглянути всі повідомлення</a>
</body>
</html>
