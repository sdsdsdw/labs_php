<?php
include '../third_part/header_login.inc';
include '../third_part/db_connection.php';

if (!isset($_SESSION['user_id'])) {
    echo "Ви повинні увійти в систему для перегляду програм.";
    exit;
}

$stmt = $pdo2->query("SELECT id, title, developer, description, version, release_year, platform, format, path FROM programs");
$programs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Програми в бібліотеці</title>
</head>
<body>
    <h1>Список програм</h1>
    <table border="1" cellpadding="10">
        <tr>
            <th>Id</th>
            <th>Назва</th>
            <th>Розробник</th>
            <th>Опис</th>
            <th>Версія</th>
            <th>Рік випуску</th>
            <th>Платформа</th>
            <th>Формат</th>
            <th>Файл</th>
        </tr>
        <?php foreach ($programs as $program): ?>
            <tr>
                <td><?php echo htmlspecialchars($program['id']); ?></td>
                <td><?php echo htmlspecialchars($program['title']); ?></td>
                <td><?php echo htmlspecialchars($program['developer']); ?></td>
                <td><?php echo htmlspecialchars($program['description']); ?></td>
                <td><?php echo htmlspecialchars($program['version']); ?></td>
                <td><?php echo htmlspecialchars($program['release_year']); ?></td>
                <td><?php echo htmlspecialchars($program['platform']); ?></td>
                <td><?php echo htmlspecialchars($program['format']); ?></td>
                <td><a href="<?php echo htmlspecialchars($program['path']); ?>">Завантажити</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="addprogram.php">Додати нову програму</a>
</body>
</html>
