<?php

namespace App\Controllers;

use App\Model\UserService;
use App\Views\View;

class ControllerRegistration {

    public function __construct(
        private UserService $UserService,
        private View $View
    )
    {
    }

    public function showForm(Request $request){
        $this->View->render('register');
    }

    public function register(Request $request): void { 
        $userName = $request->get('userName','');
        $uuid = bin2hex(random_bytes(16));
        
        $this->UserService->addUser($userName, null, $uuid);
    }

}