<?php

namespace App\Controllers;

use App\Models\User;
use App\Controller;

class RegistrationController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function showRegistrationForm()
    {
        $this->view('registration-form');
    }

    public function register()
    {
        $errors = $this->validate($_POST);

        if (!empty($errors)) {
            $this->view('registration-form', ['errors' => $errors]);
            return;
        }

        $data = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'password' => $_POST['password']
        ];

        if ($this->userModel->register($data)) {
            echo "Successful Registration. <a href='/login'>Proceed to Login</a>";
        } else {
            echo "Registration failed. Please try again.";
        }
    }

    private function validate($data)
    {
        $errors = [];

        if (empty($data['username'])) $errors[] = "Username is required.";
        if (empty($data['email'])) $errors[] = "Email address is required.";
        if (empty($data['password']) || empty($data['password_confirmation'])) $errors[] = "Password and confirmation are required.";
        elseif ($data['password'] !== $data['password_confirmation']) $errors[] = "Passwords do not match.";
        elseif (strlen($data['password']) < 8 || !preg_match('/\d/', $data['password']) || !preg_match('/[^\da-zA-Z]/', $data['password'])) {
            $errors[] = "Password must be at least 8 characters long, contain at least one numeric, and one special character.";
        }

        return $errors;
    }
}
