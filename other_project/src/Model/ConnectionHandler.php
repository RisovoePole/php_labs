<?php

namespace App\Model;

class ConnectionHandler{
    private $hashConnections = [];
// TODO поменять логику - удалить тут и вызывать repo
    public function findConn(string $hashIP): bool{
        return in_array($hashIP, $this->hashConnections); 
    }

    public function addConn(string $hashIP): bool{
        if (!$this->findConn($hashIP)){
            $this->hashConnections[] = $hashIP;
            return true;
        } else {
            return false;
        }
    }
}