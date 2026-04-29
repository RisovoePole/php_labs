<?php
/**
 * Main entry point - native PHP templating version.
 * 
 * Handles routing between form display, list display, and form submission.
 */

require_once __DIR__ . '/src/RecipeRepository.php';
require_once __DIR__ . '/src/Validator.php';

$page = $_GET['page'] ?? 'form';
$action = $_GET['action'] ?? '';

$repository = new RecipeRepository();
$validator = new Validator();

// Handle form submission (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'add') {
    $data = [
        'title' => $_POST['title'] ?? '',
        'category' => $_POST['category'] ?? '',
        'date' => $_POST['date'] ?? '',
        'ingredients' => $_POST['ingredients'] ?? '',
        'instructions' => $_POST['instructions'] ?? '',
        'created_at' => date('c'),
    ];

    $errors = $validator->validate($data);

    if (!empty($errors)) {
        $errStr = implode('; ', array_map(fn($k, $v) => "$k: $v", array_keys($errors), $errors));
        header('Location: index.php?page=form&errors=' . urlencode($errStr));
        exit;
    }

    $repository->add($data);
    header('Location: index.php?page=form&success=1');
    exit;
}

// Prepare variables for templates
$success = isset($_GET['success']);
$errors = $_GET['errors'] ?? '';

if ($page === 'list') {
    $recipes = $repository->getAll();
    $sort = $_GET['sort'] ?? 'created_at';
    $order = $_GET['order'] ?? 'desc';
    $recipes = $repository->sort($recipes, $sort, $order);
    
    ob_start();
    include __DIR__ . '/templates/list.php';
    $content = ob_get_clean();
    $title = 'Список рецептов';
} else {
    ob_start();
    include __DIR__ . '/templates/form.php';
    $content = ob_get_clean();
    $title = 'Добавить рецепт';
}

include __DIR__ . '/templates/layout.php';