
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lab5v2</title>
</head>
<body>
    <form method="POST" action="">
        <label>Ваш вибір:</label><br>
        <label><input type="radio" name="vote" value="так"> Так</label><br>
        <label><input type="radio" name="vote" value="ні"> Ні</label><br>
        <label><input type="radio" name="vote" value="утримався"> Утримався</label><br>
        <input type="submit" value="Проголосувати">
    </form>

    <h3>Результати голосування:</h3>
    <ul>
        <li>Так: <?= $votes['так'] ?></li>
        <li>Ні: <?= $votes['ні'] ?></li>
        <li>Утримався: <?= $votes['утримався'] ?></li>
    </ul>

    <?php
    $file = 'votes.txt';

    $votes = ['так' => 0, 'ні' => 0, 'утримався' => 0];

    if (file_exists($file)) {
        $votes = json_decode(file_get_contents($file), true);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $choice = $_POST['vote'] ?? '';
        if (isset($votes[$choice])) {
            $votes[$choice]++;
            file_put_contents($file, json_encode($votes));
        }
    }
    ?>

</body>
</html>
