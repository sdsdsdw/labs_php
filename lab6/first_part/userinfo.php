<?php
include 'db_connection.php';

$query = $pdo->query("SELECT username FROM users");
$usernames = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Інформація про користувача</title>
</head>
<body>
    <h1>Виберіть користувача</h1>
    <form action="userinfo.php" method="POST">
        <label for="username">Псевдонім:</label>
        <select name="username" id="username" required>
            <?php foreach ($usernames as $user): ?>
                <option value="<?= htmlspecialchars($user['username']) ?>">
                    <?= htmlspecialchars($user['username']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Отримати інформацію</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['username'])) {
        $username = $_POST['username'];

        $stmt = $pdo->prepare("SELECT first_name, last_name, email, 
                            address FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo "<h2>Інформація про користувача</h2>";
            echo "<p><strong>Ім'я:</strong> " . htmlspecialchars($user['first_name']) . "</p>";
            echo "<p><strong>Прізвище:</strong> " . htmlspecialchars($user['last_name']) . "</p>";
            echo "<p><strong>Email:</strong> " . htmlspecialchars($user['email']) . "</p>";
            echo "<p><strong>Адреса:</strong> " . htmlspecialchars($user['address']) . "</p>";
        } else {
            echo "<p>Користувача з таким псевдонімом не знайдено.</p>";
        }
    }
    ?>
</body>
</html>
