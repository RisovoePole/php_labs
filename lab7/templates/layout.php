<?php
/**
 * Main layout template for native PHP templating.
 * 
 * Variables passed:
 * - $title: Page title
 * - $content: Main page content
 */
?><!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Рецепты') ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, Helvetica, sans-serif; background: #f5f5f5; }
        .container { max-width: 1000px; margin: 0 auto; padding: 20px; }
        header { background: #333; color: white; padding: 20px 0; margin-bottom: 30px; }
        header h1 { margin-bottom: 10px; }
        nav a { color: #fff; margin-right: 15px; text-decoration: none; }
        nav a:hover { text-decoration: underline; }
        .content { background: white; padding: 20px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .success { color: #155724; background: #d4edda; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .error { color: #721c24; background: #f8d7da; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        footer { text-align: center; padding: 20px; color: #666; margin-top: 30px; }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Сборник рецептов</h1>
            <nav>
                <a href="index.php?page=form">Добавить рецепт</a>
                <a href="index.php?page=list">Все рецепты</a>
            </nav>
        </div>
    </header>
    <div class="container">
        <div class="content">
            <?= $content ?? '' ?>
        </div>
    </div>
    <footer>
        <p>&copy; 2026 Лабораторная работа №7 - Шаблонизация в PHP</p>
    </footer>
</body>
</html>
