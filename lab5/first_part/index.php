<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lab5v1</title>
</head>
<body>
    <form method="POST" action="">
        <label>Логін: <input type="text" name="username" required></label><br>
        <label>Пароль: <input type="password" name="password" required></label><br>
        <input type="submit" value="Зареєструватися">
    </form>

    <?php
    function loadUsers($filename) {
        $users = [];
        if (file_exists($filename)) {
            $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                list($username, $password) = explode(":", $line);
                $users[$username] = $password;
            }
        }
        return $users;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        if ($username === '' || $password === '') {
            echo "Логін та пароль не можуть бути порожніми!";
        } else {
            $users = loadUsers('users.txt');
            
            if (isset($users[$username])) {
                echo "Такий логін уже існує. Виберіть інший логін.";
            } else {
                $newEntry = $username . ":" . $password;
                file_put_contents('users.txt', $newEntry . "\n", FILE_APPEND);
            }
        }
    }
    ?>
</body>
</html>
