<?php

namespace App\Models;

use PDO;
use App\Core\Model;

class User extends Model
{
    public function register($data)
    {
        $query = "INSERT INTO users (username, email, first_name, last_name, password) 
                  VALUES (:username, :email, :first_name, :last_name, :password)";
        $stmt = $this->db->prepare($query);
        
        return $stmt->execute([
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':first_name' => $data['first_name'],
            ':last_name' => $data['last_name'],
            ':password' => password_hash($data['password'], PASSWORD_BCRYPT)
        ]);
    }

    public function login($username, $password)
    {
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }
}
