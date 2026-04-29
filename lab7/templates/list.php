<?php
/**
 * Template for recipe list display (native PHP).
 * 
 * Variables passed:
 * - $recipes: Array of recipe arrays
 * - $sort: Current sort field
 * - $order: Current sort order (asc/desc)
 */
?>
<h2>Все сохранённые рецепты</h2>

<?php if (empty($recipes)): ?>
    <p style="color: #666; font-style: italic;">Рецептов не найдено. <a href="index.php?page=form">Добавьте первый рецепт</a></p>
<?php else: ?>
    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr style="background: #f0f0f0;">
                <th style="text-align: left; padding: 10px; border: 1px solid #ddd;">
                    <a href="index.php?page=list&sort=title&order=<?= ($sort === 'title' && $order === 'asc') ? 'desc' : 'asc' ?>">
                        Название <?= ($sort === 'title') ? (($order === 'asc') ? '↑' : '↓') : '' ?>
                    </a>
                </th>
                <th style="text-align: left; padding: 10px; border: 1px solid #ddd;">
                    <a href="index.php?page=list&sort=category&order=<?= ($sort === 'category' && $order === 'asc') ? 'desc' : 'asc' ?>">
                        Категория <?= ($sort === 'category') ? (($order === 'asc') ? '↑' : '↓') : '' ?>
                    </a>
                </th>
                <th style="text-align: left; padding: 10px; border: 1px solid #ddd;">
                    <a href="index.php?page=list&sort=date&order=<?= ($sort === 'date' && $order === 'asc') ? 'desc' : 'asc' ?>">
                        Дата <?= ($sort === 'date') ? (($order === 'asc') ? '↑' : '↓') : '' ?>
                    </a>
                </th>
                <th style="text-align: left; padding: 10px; border: 1px solid #ddd;">Ингредиенты</th>
                <th style="text-align: left; padding: 10px; border: 1px solid #ddd;">Инструкция</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recipes as $recipe): ?>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px; border: 1px solid #ddd;"><strong><?= htmlspecialchars($recipe['title'] ?? '') ?></strong></td>
                    <td style="padding: 10px; border: 1px solid #ddd;"><?= htmlspecialchars($recipe['category'] ?? '') ?></td>
                    <td style="padding: 10px; border: 1px solid #ddd;"><?= htmlspecialchars($recipe['date'] ?? '') ?></td>
                    <td style="padding: 10px; border: 1px solid #ddd; font-size: 0.9em;"><pre style="margin: 0; white-space: pre-wrap;"><?= htmlspecialchars($recipe['ingredients'] ?? '') ?></pre></td>
                    <td style="padding: 10px; border: 1px solid #ddd; font-size: 0.9em;"><pre style="margin: 0; white-space: pre-wrap;"><?= htmlspecialchars($recipe['instructions'] ?? '') ?></pre></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p style="margin-top: 15px; color: #666;">Всего записей: <strong><?= count($recipes) ?></strong></p>
<?php endif; ?>
