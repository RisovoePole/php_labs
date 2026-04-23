<?php

namespace App\Model;

class User {
    public function __construct(
        private string $hashIP,
        private string $userName,
        private $userAvatar
    ){}
        

    public function getHashIP(){
        return $this->hashIP;
    }

    public function getName(){
        return $this->userName;
    }

    public function getAvatar(){
        return $this->userAvatar;
    }
}