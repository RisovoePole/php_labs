<?php

declare(strict_types=1);

include __DIR__ . '/transactions.php';
require __DIR__ . '/functions.php';

$transactions = sortByDate($transactions);
$transactions = sortByAmount($transactions);
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
            background: #878484ff;
            font-family: system-ui, sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            /* по горизонтали */
            align-items: center;
            /* по вертикали */
            min-height: 100vh;
            /* на весь экран */
        }

        table {
            border-collapse: collapse;
            min-width: 260px;
            background: #ffffff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.52);
        }

        th,
        td {
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
    <div class="container">
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
                <tr>
                    <td></td>
                    <td></td>
                    <td><?= calculateTotalAmount($transactions) ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>

        </table>
    </div>

</body>

</html>