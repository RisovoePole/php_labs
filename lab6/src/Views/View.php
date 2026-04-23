<?php
namespace App\Views;

class View {
    public function render($file, $data = []) {
        extract($data);  // $data -> переменные
        include __DIR__ . "/{$file}.php";
    }
}