<?php

$a = 0;
$b = 0;

echo "loop FOR:\n";

for ($i = 0; $i <= 5; $i++) {
   $a += 10;
   $b += 5;

   echo "Now, a = $a, b = $b\n";
}

echo "\nEnd of the loop: a = $a, b = $b\n\n";

echo "loop WHILE:\n";

# обнуляем переменные
$a = 0;
$b = 0;
$i = 0;

while ($i<=5) {
    $a += 10;
    $b += 5;

    echo "Now, a = $a, b = $b\n";

    $i++;
}

echo "\nEnd of the loop: a = $a, b = $b\n\n";

echo "loop DO - WHILE:\n";
# обнуляем переменные
$a = 0;
$b = 0;
$i = 0;

do  {
    $a += 10;
    $b += 5;

    echo "Now, a = $a, b = $b\n";

    $i++;
} while ($i<=5);

echo "\nEnd of the loop: a = $a, b = $b\n\n";