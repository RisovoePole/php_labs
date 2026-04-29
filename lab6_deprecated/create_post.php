<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <style>
    .create-container {
        max-width: 600px;
        width: 100%;
        background: white;
        padding: 40px;
        margin: 50px auto;
        border-radius: 12px;
        border: 1px solid var(--border);
    }
    </style>
</head>
<body>
    <div class="create-container">
    <h2>Новая публикация</h2>
    <form>
        <div class="form-group">
            <label>Название поста (title)</label>
            <input type="text" placeholder="О чем вы думаете?" required>
        </div>
        
        <div class="form-group">
            <label>Ваше имя (user_name)</label>
            <input type="text" value="Alex" disabled> </div>

        <div class="form-group">
            <label>Теги (tags - enum)</label>
            <select multiple style="height: 100px;">
                <option value="tech">Технологии</option>
                <option value="life">Жизнь</option>
                <option value="news">Новости</option>
                <option value="art">Искусство</option>
            </select>
            <small style="color: var(--gray); margin-top: 5px;">Зажмите Ctrl, чтобы выбрать несколько</small>
        </div>

        <div class="form-group">
            <label>Текст поста (body)</label>
            <textarea rows="10" placeholder="Напишите здесь что-нибудь вдохновляющее..."></textarea>
        </div>

        <div class="form-group">
            <label>Дата (created_at)</label>
            <input type="text" value="23.04.2026 14:45" readonly>
        </div>

        <div style="display: flex; gap: 10px; margin-top: 20px;">
            <button type="submit" class="btn">Опубликовать</button>
            <a href="index.html" style="color: var(--gray); text-decoration: none; padding: 10px;">Отмена</a>
        </div>
    </form>
</div>
</body>
</html>