<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $error = "Псевдонім уже використовується. Виберіть інший.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (username, first_name, last_name, email, address) 
                                VALUES (:username, :first_name, :last_name, :email, :address)");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':first_name', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $success = "Реєстрація успішна! Тепер ви можете вибрати свій акаунт на сторінці інформації.";
        } else {
            $error = "Сталася помилка під час реєстрації. Спробуйте ще раз.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Реєстрація</title>
</head>
<body>
    <h1>Реєстрація</h1>
    
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <p style="color: green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <form action="index.php" method="POST">
        <label for="username">Псевдонім:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="first_name">Ім'я:</label>
        <input type="text" id="first_name" name="first_name" required><br><br>

        <label for="last_name">Прізвище:</label>
        <input type="text" id="last_name" name="last_name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="address">Адреса:</label>
        <textarea id="address" name="address"></textarea><br><br>

        <button type="submit">Зареєструватися</button>
    </form>

    <p><a href="userinfo.php">Перейти до вибору користувача</a></p>
</body>
</html>
