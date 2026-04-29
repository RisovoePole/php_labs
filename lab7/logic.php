<?php
/**
 * Handle POSTed form data: validate and append to JSONL storage.
 */

require_once __DIR__ . '/Validator.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo 'Method not allowed';
    exit;
}

$data = [
    'title' => $_POST['title'] ?? '',
    'category' => $_POST['category'] ?? '',
    'date' => $_POST['date'] ?? '',
    'ingredients' => $_POST['ingredients'] ?? '',
    'instructions' => $_POST['instructions'] ?? '',
    'created_at' => date('c'),
];

$validator = new Validator();
$errors = $validator->validate($data);

if (!empty($errors)) {
    $err = implode('; ', array_map(function($k, $v){return "$k: $v";}, array_keys($errors), $errors));
    $params = ['errors' => $err];
    header('Location: index.php?' . http_build_query($params));
    exit;
}

$storageDir = __DIR__ . '/data';
if (!is_dir($storageDir)) {
    mkdir($storageDir, 0755, true);
}
$file = $storageDir . '/recipes.jsonl';

$line = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents($file, $line . PHP_EOL, FILE_APPEND | LOCK_EX);

header('Location: index.php?success=1');
exit;
