<?php


require 'vendor/autoload.php';
require_once 'container.php';

use App\Controllers\Request;

$container = \App\Container::getInstance();

$uri = $_SERVER['REQUEST_URI'] ?? '/'; 
$url = parse_url($uri, PHP_URL_PATH);   // /page?x=1&y=2 -> /page


$body = $_POST;
// если JSON
if (str_contains($_SERVER['CONTENT_TYPE'] ?? '', 'application/json')) {
    $body = json_decode(file_get_contents('php://input'), true) ?? [];
} 

$routes = require 'routes.php'; //получаем список эдпоинтов
foreach ($routes as $pattern => $handler) { // парсим как ключ значение эдпоинт(с regex) => класс с названием метода
/*
 проверяем по regex выражению из ендпоинта - подходит ли,
 и сохраняем всё, что подошло(весь uri и все конкретные вхождения regex) в массив $matches
*/  
if (preg_match("#^$pattern$#", $url, $matches)) { 
        [$controller, $method] = explode('@', $handler); //разделяем контроллер на его класс и метода
        $obj = $container->get($controller);// создаём объект класса контроллера
        $params = array_slice($matches, 1); // передаём весь ассоциативный список имя параметра -> значение
        
        //create request
        $request = new Request();
        $request->query = $_GET;
        $request->body = $body;
        $request->params = $params;
        $request->method = $_SERVER['REQUEST_METHOD'];


        $obj->$method($request); //вызываем метод с распакованными параметрами
        exit;
    }
}

http_response_code(404);
echo "404 - Route not found: $url | Method: " . $_SERVER['REQUEST_METHOD'];
exit;