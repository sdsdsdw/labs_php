<?php
$file = 'views.json';

$views = ['today' => 0, 'total' => 0];

if (file_exists($file)) {
    $views = json_decode(file_get_contents($file), true);
}

$today = date('Y-m-d');

if (!isset($views['lastDate']) || $views['lastDate'] != $today) {
    $views['today'] = 0;
    $views['lastDate'] = $today;
}
$views['today']++;
$views['total']++;

file_put_contents($file, json_encode($views));

echo "Перегляди сьогодні: " . $views['today'] . "<br>";
echo "Загальна кількість переглядів: " . $views['total'];
?>
