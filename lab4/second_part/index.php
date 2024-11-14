<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>lab4v2</title>
</head>
<body>
    <form method="post" action="">
        <label for="k">Введіть кількість двійок:</label>
        <input type="number" name="k" id="k" required>
        <button type="submit">Відправити</button>
    </form>

    <?php
    function getPhrase($k) {
        if ($k < 0) {
            return "Число повинно бути невід'ємним.";
        }

        if ($k % 10 == 1 && $k % 100 != 11) {
            $word = "двійку";
        } elseif (in_array($k % 10, [2, 3, 4]) && !in_array($k % 100, [12, 13, 14])) {
            $word = "двійки";
        } else {
            $word = "двійок";
        }

        return "На парі викладач поставив студентам $k $word.";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $k = (int)$_POST['k'];
        echo "<p>" . getPhrase($k) . "</p>";
    }
    ?>
</body>
</html>
