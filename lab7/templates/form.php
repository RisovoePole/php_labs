<?php
/**
 * Template for recipe creation form (native PHP).
 * Variables passed:
 * - $success: Success message from GET param
 * - $errors: Error messages from GET param
 */
?>
<h2>Добавить новый рецепт</h2>

<?php if ($success ?? false): ?>
    <div class="success">✓ Запись успешно сохранена!</div>
<?php endif; ?>

<?php if (!empty($errors ?? '')): ?>
    <div class="error">✕ Ошибка: <?= htmlspecialchars($errors) ?></div>
<?php endif; ?>

<form action="index.php?action=add" method="post" style="max-width: 600px;">
    <div style="margin-bottom: 15px;">
        <label for="title" style="display: block; margin-bottom: 5px; font-weight: bold;">Название *</label>
        <input type="text" id="title" name="title" required minlength="2" maxlength="100" 
               style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="category" style="display: block; margin-bottom: 5px; font-weight: bold;">Категория</label>
        <select id="category" name="category" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            <option value="">-- выберите --</option>
            <option value="breakfast">🌅 Завтрак</option>
            <option value="lunch">☀️ Обед</option>
            <option value="dinner">🌙 Ужин</option>
            <option value="dessert">🍰 Десерт</option>
        </select>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="date" style="display: block; margin-bottom: 5px; font-weight: bold;">Дата (YYYY-MM-DD) *</label>
        <input type="date" id="date" name="date" required 
               style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="ingredients" style="display: block; margin-bottom: 5px; font-weight: bold;">Ингредиенты *</label>
        <textarea id="ingredients" name="ingredients" rows="5" required minlength="5"
                  style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-family: monospace;"></textarea>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="instructions" style="display: block; margin-bottom: 5px; font-weight: bold;">Инструкция *</label>
        <textarea id="instructions" name="instructions" rows="6" required minlength="10"
                  style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-family: monospace;"></textarea>
    </div>

    <button type="submit" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">
        Сохранить рецепт
    </button>
</form>
