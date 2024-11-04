<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lab2</title>
</head>
<body>
    <?php
        function calculateDistance($x1, $y1, $x2, $y2) {
            return sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2));
        }

        $x1 = 1;
        $y1 = 1;
        $x2 = 4;
        $y2 = 5;

        echo "Відстань між точками: " . calculateDistance($x1, $y1, $x2, $y2) . "\n";
    ?>

</body>
</html>
