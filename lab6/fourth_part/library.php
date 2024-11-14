<?php
include '../third_part/header_login.inc';
include '../third_part/db_connection.php';

if (!isset($_SESSION['user_id'])) {
    echo "Ви повинні увійти в систему для перегляду бібліотеки.";
    exit;
}

$stmt = $pdo2->prepare("
    SELECT id, title, author, publishing, year, n_pages, format, path 
    FROM library
");
$stmt->execute();

?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Бібліотека</title>
</head>
<body>
    <h1>Бібліотека</h1>

    <?php if ($stmt->rowCount() > 0): ?>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>Id</th>
                <th>Назва книги</th>
                <th>Автор</th>
                <th>Видавництво</th>
                <th>Рік видання</th>
                <th>Кількість сторінок</th>
                <th>Формат</th>
                <th>Файл</th>
            </tr>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars($row['author']) ?></td>
                    <td><?= htmlspecialchars($row['publishing']) ?></td>
                    <td><?= htmlspecialchars($row['year']) ?></td>
                    <td><?= htmlspecialchars($row['n_pages']) ?></td>
                    <td><?= htmlspecialchars($row['format']) ?></td>
                    <td><a href="<?= htmlspecialchars($row['path']) ?>" target="_blank">Завантажити</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Немає книг у бібліотеці.</p>
    <?php endif; ?>

    <br>
    <a href="addbook.php">Додати нову книгу</a>
</body>
</html>
