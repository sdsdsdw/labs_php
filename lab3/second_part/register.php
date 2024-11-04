<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $region = $_POST['region'];
    $city = $_POST['city'];
    $street = $_POST['street'];

    if ($password !== $confirm_password) {
        echo "<script>alert('Паролі не співпадають! Спробуйте ще раз.');</script>";
        echo "<a href='index.html'>Повернутися до форми реєстрації</a>";
    } else {
        echo "<h2>Реєстрація успішна!</h2>";
        echo "<p>Дякуємо, $first_name, за реєстрацію!</p>";
        echo "<p>Ваші дані:</p>";
        echo "<ul>";
        echo "<li>Псевдонім: $nickname</li>";
        echo "<li>Ім'я: $first_name</li>";
        echo "<li>Прізвище: $last_name</li>";
        echo "<li>Email: $email</li>";
        echo "<li>Країна: $country</li>";
        echo "<li>Область: $region</li>";
        echo "<li>Місто (село): $city</li>";
        echo "<li>Вулиця: $street</li>";
        echo "</ul>";
    }
}

