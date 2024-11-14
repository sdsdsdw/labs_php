<?php
$dsn1 = 'mysql:host=localhost;dbname=profiles;charset=utf8mb4';
$username1 = 'root';
$password1 = '';

$dsn2 = 'mysql:host=localhost;dbname=portal;charset=utf8mb4';
$username2 = 'root';
$password2 = '';

try {
    $pdo1 = new PDO($dsn1, $username1, $password1);
    $pdo1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo2 = new PDO($dsn2, $username2, $password2);
    $pdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
