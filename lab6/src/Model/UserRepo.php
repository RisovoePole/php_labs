<?php 

namespace App\Model;

use App\Model\User;

class UserRepo{
    /** @var User[] */
    private array $userList = [];

    public function findUserByName(string $name): User {
        return array_find($this->userList, fn($user)=>$user->getName() === $name);
    }

    public function findUserByAvatar($avatar): User {
        return array_find($this->userList, fn($user)=>$user->getAvatar() === $avatar);
    }

    public function findUserByHashIP($hashIP): User {
        return array_find($this->userList, fn($user)=>$user->getHashIP() === $hashIP);
    }
}