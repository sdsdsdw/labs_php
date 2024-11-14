<?php 
include 'db_connection.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Будь ласка, заповніть усі поля.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo1->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

        try {
            $stmt->execute();
            header("Location: login.php");
            exit;
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $error = "Це ім'я користувача вже зайнято.";
            } else {
                $error = "Сталася помилка: " . $e->getMessage();
            }
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
    <form action="register.php" method="POST">
        <label for="username">Логін:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Зареєструватися</button>
    </form>
    <p>Уже є обліковий запис? <a href="login.php">Увійти</a></p>
</body>
</html>
