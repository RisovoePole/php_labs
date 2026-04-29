<?php
/**
 * Main entry point - Twig templating version.
 * 
 * Handles routing between form display, list display, and form submission using Twig.
 */

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/RecipeRepository.php';
require_once __DIR__ . '/src/Validator.php';
require_once __DIR__ . '/src/TwigFilters.php';

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$page = $_GET['page'] ?? 'form';
$action = $_GET['action'] ?? '';

$repository = new RecipeRepository();
$validator = new Validator();

// Initialize Twig
$loader = new FilesystemLoader(__DIR__ . '/templates_twig');
$twig = new Environment($loader, ['debug' => false]);

// Register custom filters
$twig->addFilter(new \Twig\TwigFilter('recipe_category_icon', [TwigFilters::class, 'recipeCategoryIcon']));

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
        header('Location: index-twig.php?page=form&errors=' . urlencode($errStr));
        exit;
    }

    $repository->add($data);
    header('Location: index-twig.php?page=form&success=1');
    exit;
}

// Prepare variables for Twig
$success = isset($_GET['success']);
$errors = $_GET['errors'] ?? '';

if ($page === 'list') {
    $recipes = $repository->getAll();
    $sort = $_GET['sort'] ?? 'created_at';
    $order = $_GET['order'] ?? 'desc';
    $recipes = $repository->sort($recipes, $sort, $order);
    
    echo $twig->render('list.html.twig', [
        'recipes' => $recipes,
        'sort' => $sort,
        'order' => $order,
    ]);
} else {
    echo $twig->render('form.html.twig', [
        'success' => $success,
        'errors' => $errors,
    ]);
}
