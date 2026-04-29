<?php
/**
 * Read JSONL file and display records in an HTML table with sorting.
 */

$file = __DIR__ . '/data/recipes.jsonl';
$items = [];
if (is_file($file)) {
    $fh = fopen($file, 'r');
    while (($line = fgets($fh)) !== false) {
        $obj = json_decode(trim($line), true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($obj)) {
            $items[] = $obj;
        }
    }
    fclose($fh);
}

$sort = $_GET['sort'] ?? '';
$order = strtolower($_GET['order'] ?? 'asc') === 'desc' ? 'desc' : 'asc';

if ($sort) {
    usort($items, function($a, $b) use ($sort, $order) {
        $va = $a[$sort] ?? '';
        $vb = $b[$sort] ?? '';
        // For date-like fields, compare timestamps
        if (in_array($sort, ['date', 'created_at'], true)) {
            $ta = strtotime($va) ?: 0;
            $tb = strtotime($vb) ?: 0;
            if ($ta === $tb) return 0;
            return ($order === 'asc') ? ($ta < $tb ? -1 : 1) : ($ta > $tb ? -1 : 1);
        }
        if ($va == $vb) return 0;
        return ($order === 'asc') ? (($va < $vb) ? -1 : 1) : (($va > $vb) ? -1 : 1);
    });
}

function sortLink($field, $label) {
    $current = $_GET['sort'] ?? '';
    $order = ($_GET['order'] ?? 'asc');
    $next = ($current === $field && $order === 'asc') ? 'desc' : 'asc';
    $q = ['sort' => $field, 'order' => $next];
    return '<a href="?' . http_build_query($q) . '">' . htmlspecialchars($label) . '</a>';
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Список рецептов</title>
    <style>
        body{font-family:Arial;margin:20px}
        table{border-collapse:collapse;width:100%}
        th,td{border:1px solid #ddd;padding:8px}
        th{background:#f4f4f4}
    </style>
</head>
<body>
    <h1>Сохранённые записи</h1>
    <p><a href="index.php">Добавить запись</a></p>
    <table>
        <thead>
            <tr>
                <th><?= sortLink('title', 'Название') ?></th>
                <th><?= sortLink('category', 'Категория') ?></th>
                <th><?= sortLink('date', 'Дата') ?></th>
                <th>Ингредиенты</th>
                <th>Инструкция</th>
                <th><?= sortLink('created_at', 'Создано') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($items)): ?>
            <tr><td colspan="6">Нет записей.</td></tr>
        <?php else: foreach ($items as $it): ?>
            <tr>
                <td><?= htmlspecialchars($it['title'] ?? '') ?></td>
                <td><?= htmlspecialchars($it['category'] ?? '') ?></td>
                <td><?= htmlspecialchars($it['date'] ?? '') ?></td>
                <td><?= nl2br(htmlspecialchars($it['ingredients'] ?? '')) ?></td>
                <td><?= nl2br(htmlspecialchars($it['instructions'] ?? '')) ?></td>
                <td><?= htmlspecialchars($it['created_at'] ?? '') ?></td>
            </tr>
        <?php endforeach; endif; ?>
        </tbody>
    </table>
</body>
</html>
