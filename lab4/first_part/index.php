<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>lab4v1</title>
</head>
<body>
    <h2>Введіть ціле невід’ємне число</h2>
    <form method="post">
        <input type="text" name="number" required placeholder="Введіть ціле число">
        <button type="submit">Підрахувати цифри</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["number"])) {
            $n = $_POST["number"];

            function countDigits($n) {
                return strlen((string)$n);
            }

            if (is_numeric($n) && intval($n) == $n && $n >= 0) {
                echo "<p>Кількість цифр у числі $n: " . countDigits($n) . "</p>";
            } else {
                echo "<p>Помилка: введіть ціле невід’ємне число.</p>";
            }
        }
    }
    ?>
</body>
</html>
