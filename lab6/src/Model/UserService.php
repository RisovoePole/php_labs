<?php

namespace App\Model;

use App\Views\View;

class UserService{

public function __construct(
    private UserRepo $UserRepo,
    private View $View
)
{}
  
    public function addUser(string $name, $avatar, string $uuid){
        $errors = $this->UserRepo->addUser($name, $avatar, $uuid);
        
        $this->View->render('afterReg', ['name' => $name, 'uuid'=> $uuid, 'errors'=>$errors, 'userList'=>$this->UserRepo->getAllUsers()]);
    }
}