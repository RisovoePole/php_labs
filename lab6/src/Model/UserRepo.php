<?php 

namespace App\Model;

use App\Model\User;

class UserRepo{
    /** @var User[] */
    private array $userList = [];

    public function getAllUsers():array{
        return $this->userList;
    }

    public function findUserByName(string $name): ?User {
        return array_find($this->userList, fn($user)=>$user->getName() === $name);
    }

    public function findUserByAvatar($avatar): ?User {
        return array_find($this->userList, fn($user)=>$user->getAvatar() === $avatar);
    }

    public function findUserByUUID(string $uuid): ?User {
        return array_find($this->userList, fn($user)=>$user->getUUID() === $uuid);
    }

    public function addUser(string $name, $avatar, string $uuid): string{

        $name = trim($name);

        $nameLength = mb_strlen($name);
        if($nameLength > 20){
            http_response_code(406);
            return 'name is too long';
        }

        if($nameLength < 3){
            http_response_code(406);
            return 'name is too short';
        }

        foreach($this->userList as $user){
            similar_text($user->getName(), $name, $percent);
            if($percent > 90)
                http_response_code(409);
                return 'name is too similar to ' . $user->getName();
        }

        $this->userList[] = new User($uuid, $name, $avatar);
        return 'no errors';
    }
}