<?php

namespace App\Controllers;

use App\Model\ConnectionHandler;  

class ControllerIP {
    public function getHashIp(?string $realIP): void {  
        if (!$realIP) return;
        
        $handler = new ConnectionHandler();
        $handler->addConn(hash('sha256', $realIP));
    }
}