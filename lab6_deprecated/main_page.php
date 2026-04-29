<?php
require_once __DIR__ . '/logic.php';  
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Минималистичный Блог</title>
    <style>
        :root {
            --bg: #f9f9f9;
            --card: #ffffff;
            --text: #333;
            --accent: #4a90e2;
            --border: #ececec;
            --gray: #888;
        }

        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background-color: var(--bg);
            color: var(--text);
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Header & Filters */
        header {
            width: 100%;
            padding: 20px;
            background: var(--card);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 10;
            display: flex;
            justify-content: center;
        }

        .search-bar {
            display: flex;
            gap: 10px;
            max-width: 800px;
            width: 100%;
        }

        input, select, textarea {
            padding: 10px;
            border: 1px solid var(--border);
            border-radius: 8px;
            outline: none;
        }

        .btn {
            background: var(--accent);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        /* Main Layout */
        .container {
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 30px;
            max-width: 1100px;
            width: 100%;
            padding: 40px 20px;
        }

        /* Sidebar Registration */
        .sidebar {
            background: var(--card);
            padding: 20px;
            border-radius: 12px;
            height: fit-content;
            border: 1px solid var(--border);
        }

        .sidebar h3 { margin-top: 0; font-size: 18px; }

        .form-group { margin-bottom: 15px; display: flex; flex-direction: column; }
        .form-group label { font-size: 12px; margin-bottom: 5px; color: var(--gray); }

        /* Feed */
        .feed {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .feed-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .post-card {
            background: var(--card);
            padding: 25px;
            border-radius: 12px;
            border: 1px solid var(--border);
            transition: transform 0.2s;
        }

        .post-card:hover { transform: translateY(-2px); }

        .post-title { font-size: 20px; font-weight: 700; margin: 0 0 10px 0; color: var(--accent); }
        .post-meta { font-size: 13px; color: var(--gray); margin-bottom: 15px; }

        .tag {
            display: inline-block;
            background: #f0f4f8;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            margin-right: 5px;
        }

        .rating {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            font-weight: bold;
        }
        .up { color: #27ae60; }
        .down { color: #eb5757; }
    </style>
</head>
<body>

    <header>
        <div class="search-bar">
            <input type="text" placeholder="Поиск по названию или тегам..." style="flex-grow: 1;">
            <select>
                <option>Сначала новые</option>
                <option>По рейтингу</option>
            </select>
        </div>
    </header>

    <main class="container">
        <aside class="sidebar">
            <h3>Профиль</h3>
            <div class="form-group">
                <label>Имя (обязательно)</label>
                <input type="text" placeholder="Введите имя" required>
            </div>
            <div class="form-group">
                <label>Возраст</label>
                <input type="number" placeholder="25">
            </div>
            <div class="form-group">
                <label>О себе</label>
                <textarea rows="3" placeholder="Краткая информация"></textarea>
            </div>
            <button class="btn" style="width: 100%;">Сохранить</button>
        </aside>

        <section class="feed">
            <div class="feed-header">
                <h2>Лента постов</h2>
                <a href="create.html" class="btn">+ Создать пост</a>
            </div>

            <article class="post-card">
                <div class="post-meta">Опубликовано: 23.04.2026 • Автор: <b>Alex</b></div>
                <h2 class="post-title"><a href="post.html" style="text-decoration: none; color: inherit;">Как выучить CSS за вечер?</a></h2>
                <div>
                    <span class="tag">Образование</span>
                    <span class="tag">IT</span>
                </div>
                <div class="rating">
                    <span class="up">▲ 142</span>
                    <span class="down">▼ 12</span>
                </div>
            </article>
        </section>
    </main>

</body>
</html>