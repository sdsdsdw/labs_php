<?php
include '../third_part/header_login.inc';
include '../third_part/db_connection.php';

if (!isset($_SESSION['user_id'])) {
    echo "Ви повинні увійти в систему для перегляду статей.";
    exit;
}

$stmt = $pdo2->prepare("
    SELECT id, title, author, description, magazine, year, n_pages, format, path 
    FROM articles
");
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Статті бібліотеки</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        tr:hover {background-color: #f5f5f5;}
    </style>
</head>
<body>
    <h1>Список статей у бібліотеці</h1>

    <?php if ($stmt->rowCount() > 0): ?>
        <table>
            <tr>
                <th>Id</th>
                <th>Назва статті</th>
                <th>Автор</th>
                <th>Опис</th>
                <th>Журнал</th>
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
                    <td><?= nl2br(htmlspecialchars($row['description'])) ?></td>
                    <td><?= htmlspecialchars($row['magazine']) ?></td>
                    <td><?= htmlspecialchars($row['year']) ?></td>
                    <td><?= htmlspecialchars($row['n_pages']) ?></td>
                    <td><?= htmlspecialchars($row['format']) ?></td>
                    <td><a href="<?= htmlspecialchars($row['path']) ?>" target="_blank">Завантажити</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Немає статей у бібліотеці.</p>
    <?php endif; ?>

    <br>
    <a href="addarticle.php">Додати нову статтю</a>
</body>
</html>
