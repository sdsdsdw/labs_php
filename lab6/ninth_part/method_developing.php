<?php
include '../third_part/header_login.inc';
include '../third_part/db_connection.php';

if (!isset($_SESSION['user_id'])) {
    echo "Ви повинні увійти в систему для перегляду методичних розробок.";
    exit;
}

$stmt = $pdo2->query("SELECT id, title, author, description, subject, year, format, path FROM method_developing");
$methods = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Методичні розробки</title>
</head>
<body>
    <h1>Список методичних розробок</h1>
    <table border="1" cellpadding="10">
        <tr>
            <th>Id</th>
            <th>Назва</th>
            <th>Автор</th>
            <th>Опис</th>
            <th>Предмет</th>
            <th>Рік</th>
            <th>Формат</th>
            <th>Файл</th>
        </tr>
        <?php foreach ($methods as $method): ?>
            <tr>
                <td><?php echo htmlspecialchars($method['id']); ?></td>
                <td><?php echo htmlspecialchars($method['title']); ?></td>
                <td><?php echo htmlspecialchars($method['author']); ?></td>
                <td><?php echo htmlspecialchars($method['description']); ?></td>
                <td><?php echo htmlspecialchars($method['subject']); ?></td>
                <td><?php echo htmlspecialchars($method['year']); ?></td>
                <td><?php echo htmlspecialchars($method['format']); ?></td>
                <td><a href="<?php echo htmlspecialchars($method['path']); ?>">Завантажити</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="add_method_developing.php">Додати нову розробку</a>
</body>
</html>
