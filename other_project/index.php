<?php

require 'vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'] ?? '/'; 
$url = parse_url($uri, PHP_URL_PATH);   // /index.php/page → /page

$routes = require 'routes.php';//получаем список эдпоинтов
foreach ($routes as $pattern => $handler) { // парсим как ключ значение эдпоинт(с regex) => класс с названием метода
/*
 проверяем по regex выражению из ендпоинта - подходит ли,
 и сохраняем всё, что подошло(весь uri и все конкретные вхождения regex) в массив $matches
*/  
if (preg_match("#^$pattern$#", $url, $matches)) { 
        [$controller, $method] = explode('@', $handler); //разделяем контроллер на его класс и метода
        $obj = new $controller();// создаём объект класса контроллера
        $params = array_slice($matches, 1); // передаём весь ассоциативный список имя параметра -> значение
        $obj->$method(...$params); //вызываем метод с распакованными параметрами
        exit;
    }
}