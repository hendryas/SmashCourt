<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $username = $this->sessionData['username'] ?? 'Guest';

        $data = [
            'username' => $username
        ];

        return redirect()->to('/auth/login');
    }
}
