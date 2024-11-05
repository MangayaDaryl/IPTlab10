<?php

require 'vendor/autoload.php';
require 'init.php';


global $conn;

try {

  
    $router = new \Bramus\Router\Router();

  
    $router->get('/register', 'RegistrationController@showRegistrationForm');
    $router->post('/register', 'RegistrationController@register');
    $router->get('/login', 'LoginController@showLoginForm');
    $router->post('/login', 'LoginController@login');
    
   
    $router->run();

} catch (Exception $e) {

    echo json_encode([
        'error' => $e->getMessage()
    ]);

}
