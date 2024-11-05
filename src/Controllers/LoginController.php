<?php

namespace App\Controllers;

use App\Models\User;
use App\Controller;

class LoginController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function showLoginForm()
    {
        $this->view('login-form');
    }

    public function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->userModel->login($username, $password);

        if ($user) {
            echo "Login successful! Welcome, " . htmlspecialchars($user['username']) . ".";
            // Here, you would typically start a session and redirect the user
        } else {
            echo "Invalid username or password.";
        }
    }
}
