<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{font-family: Arial, Helvetica, sans-serif; margin:20px}
        form{max-width:700px}
        label{display:block;margin-top:10px}
        input[type=text], input[type=date], textarea, select{width:100%;padding:8px;box-sizing:border-box}
        table{border-collapse:collapse;width:100%;margin-top:20px}
        th,td{border:1px solid #ddd;padding:8px}
        th{background:#f4f4f4}
        .success{color:green}
        .errors{color:red}
    </style>
</head>
<body>
    <h1>Добавить рецепт</h1>
    <?php if(isset($_GET['success'])): ?>
        <div class="success">Запись успешно сохранена.</div>
    <?php endif; ?>
    <?php if(isset($_GET['errors'])): ?>
        <div class="errors"><?= htmlspecialchars($_GET['errors']) ?></div>
    <?php endif; ?>

    <form action="logic.php" method="post" novalidate>
        <label for="title">Название (обязательно)</label>
        <input type="text" id="title" name="title" required minlength="2" maxlength="100">

        <label for="category">Категория</label>
        <select id="category" name="category">
            <option value="">-- выберите --</option>
            <option value="breakfast">Завтрак</option>
            <option value="lunch">Обед</option>
            <option value="dinner">Ужин</option>
            <option value="dessert">Десерт</option>
        </select>

        <label for="date">Дата (YYYY-MM-DD)</label>
        <input type="date" id="date" name="date" required>

        <label for="ingredients">Ингредиенты (обязательно)</label>
        <textarea id="ingredients" name="ingredients" rows="4" required minlength="5"></textarea>

        <label for="instructions">Инструкция (обязательно)</label>
        <textarea id="instructions" name="instructions" rows="6" required minlength="10"></textarea>

        <button type="submit" style="margin-top:10px">Сохранить</button>
    </form>

    <p><a href="list.php">Посмотреть все записи</a></p>
</body>
</html>