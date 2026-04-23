<?php
namespace App;

use ReflectionClass;

class Container {
    private static ?self $instance = null;  // ← Singleton контейнер!
    private array $services = [];
    
    private function __construct() {}  // Приватный!
    
    public static function getInstance(): self {
        return self::$instance ??= new self();
    }
    
    public function get(string $id): object {
        return $this->services[$id] ?? $this->resolve($id);
    }
    
    public function set(string $id, object $service): void {
        $this->services[$id] = $service;
    }
    
    private function resolve(string $id): object {
        // Автовайринг через Reflection...
        $reflector = new ReflectionClass($id);
        $constructor = $reflector->getConstructor();

        $obj = null;
        if (!$constructor) {
            $this->set($id, new $id());
        } else {
        
            $deps = array_map(function($param) {
                $type = $param->getType()?->getName();
                return $type ? $this->get($type) : $param->getDefaultValue();
            }, $constructor->getParameters());
            
            $this->set($id, $reflector->newInstanceArgs($deps));
        }
        return $this->get($id);
    }
}