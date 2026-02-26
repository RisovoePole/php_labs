<?php

declare(strict_types=1);

include __DIR__ . '/transactions.php';
require __DIR__ . '/functions.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lab4</title>
    <style>
        body {
        margin: 0;
        height: 100vh;
        display: flex;
        justify-content: center;   /* по горизонтали */
        align-items: center;       /* по вертикали */
        background: #878484ff;
        font-family: system-ui, sans-serif;
        }

        table {
        border-collapse: collapse;
        min-width: 260px;
        background: #ffffff;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.52);
        }

        th, td {
        padding: 10px 16px;
        border-bottom: 1px solid #eeeeee;
        text-align: left;
        font-size: 14px;
        color: #333333;
        }

        th {
        font-weight: 600;
        background: #1d7ce9ff;
        }

        tr:last-child td {
        border-bottom: none;
        }
    </style>
</head>
<body>
<table border='1'>
<thead>
    <tr>
        <!-- Заголовки столбцов -->
       <?= show_header_table($transactions[0]); ?>
    </tr>
</thead>

<tbody>
<!-- Вывод студентов -->
    <?= show_body_table($transactions); ?>
</tbody>

</table>

<?= calculateTotalAmount($transactions) ?>

</body>
</html>