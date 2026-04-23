<?php

namespace App\Model;

class User {
    public function __construct(
        private string $uuid,
        private string $userName,
        private $userAvatar
    ){}

    public function getUUID(){
        return $this->uuid;
    }

    public function getName(){
        return $this->userName;
    }

    public function getAvatar(){
        return $this->userAvatar;
    }
}