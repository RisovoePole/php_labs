<?php

namespace App\Controllers;

class Request{
    public array $query;
    public array $body;
    public array $params;
    public string $method;

    public function get(string $key, $default = null){
        return $this->body[$key] ?? $this->query[$key] ?? $default;
    }
}