<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма реєстрації</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h2 class="title">Реєстрація користувача</h2>

<div class="form-container">
    <form action="register.php" method="POST">
        <label for="nickname">Псевдонім:</label>
        <input type="text" id="nickname" name="nickname" required>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm_password">Підтвердження пароля:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <label for="first_name">Ім'я:</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="last_name">Прізвище:</label>
        <input type="text" id="last_name" name="last_name" required>

        <label for="email">Email адреса:</label>
        <input type="email" id="email" name="email" required>

        <label for="country">Країна:</label>
        <select id="country" name="country" required>
            <option value="Україна">Україна</option>
            <option value="Польща">Польща</option>
            <option value="Німеччина">Німеччина</option>
            <option value="Франція">Франція</option>
            <option value="США">США</option>
        </select>

        <label for="region">Область:</label>
        <input type="text" id="region" name="region" required>

        <label for="city">Місто (село):</label>
        <input type="text" id="city" name="city" required>

        <label for="street">Вулиця:</label>
        <input type="text" id="street" name="street" required>

        <input type="submit" value="Зареєструватися">
    </form>
</div>

</body>
</html>
