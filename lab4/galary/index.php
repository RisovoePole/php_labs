<?php

/**
 * Выводит список div-ов с классом `photo-card` Для всех элементов из папки images. 
 *
 * @param string $dir - путь до папки, из которой будут взяты файлы (например "path/to/images/").
 * @return string HTML разметка.
 */
function printImages(string $dir = "images/"): string
{
    $files = scandir($dir);
    if ($files === false) {
        return "<h2>ERROR 500</h2><br>Directory not found.";
    }

    $result = "<div class=\"photo-grid\">";

    for ($i = 0; $i < count($files); $i++) {
        if (($files[$i] != ".") && ($files[$i] != "..")) {
            $path = $dir . $files[$i];
            $result .= "<div class=\"photo-card\">\n";
            $result .= "\t<img src=\"{$path}\" alt=\"{$files[$i]}\">\n";
            $result .= "</div>\n";
        }
    }

    $result.="</div>";
    return $result;
}

?>


<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minimalist Gallery</title>
    <style>
        /* Базовые стили для чистого вида */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100-vh;
            color: #333;
            background-color: #f9f9f9;
        }

        /* Хедер */
        header {
            padding: 2rem;
            text-align: center;
            background: #fff;
            border-bottom: 1px solid #eee;
        }

        h1 {
            margin: 0;
            font-weight: 300;
            letter-spacing: 1px;
        }

        /* Сетка для фоток (вместо старых таблиц — это удобнее) */
        main {
            flex: 1;
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .photo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .photo-card {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease;
        }

        .photo-card:hover {
            transform: translateY(-5px);
        }

        .photo-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            /* Чтобы фотки не сплющивались */
            display: block;
        }

        /* Футер */
        footer {
            padding: 1.5rem;
            text-align: center;
            font-size: 0.9rem;
            color: #888;
            border-top: 1px solid #eee;
            background: #fff;
        }
    </style>
</head>

<body>

    <header>
        <h1>MY GALLERY</h1>
        <p><a href="https://www.minecraft.net/en-us/articles">Minecraft News</a></p>
    </header>

    <main>
        <?= printImages() ?>    
    </main>

    <footer>
        &copy; 2026 Minimalist Concept USM
    </footer>

</body>

</html>